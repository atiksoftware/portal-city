<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class Fix extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'fix';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description';

	/**
	 * Create a new command instance.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	public function getModelTablePath($table_name)
	{
		$migrations_path = database_path('migrations');
		// find file which filename contains table name
		$files = File::allFiles($migrations_path);
		foreach ($files as $file) {
			$filename = $file->getFilename();
			if (false !== strpos($filename, $table_name)) {
				return $file->getPathname();
			}
		}

		return null;
	}

	public function getAvailableModels()
	{
		$models = [];
		$modelsPath = app_path('Models');
		$modelFiles = File::allFiles($modelsPath);
		foreach ($modelFiles as $modelFile) {
			$modelNamespace = '\\App\\Models\\' . $modelFile->getFilenameWithoutExtension();
			$modelClass = new $modelNamespace();
			if (!method_exists($modelClass, 'getTable')) {
				continue;
			}
			$model = [
				'name' => $modelFile->getFilenameWithoutExtension(),
				'path' => $modelFile->getPathname(),
				'class' => $modelClass,
				'table_name' => $modelClass->getTable(),
				'table_path' => $this->getModelTablePath($modelClass->getTable()),
			];
			$models[] = $model;
		}

		return $models;
	}

	public function getSourceCode($file_path)
	{
		$file_content = File::get($file_path);

		return explode("\n", $file_content);
	}

	public function findFieldInSourceCode($field, $source_code)
	{
		$come_across_attributes = false;
		foreach ($source_code as $line_number => $line) {
			if (false !== strpos($line, 'protected $attributes = [')) {
				$come_across_attributes = true;
			}
			if (!$come_across_attributes) {
				continue;
			}
			if (false !== strpos($line, '"' . $field . '"') || false !== strpos($line, "'" . $field . "'")) {
				return $line;
			}
		}

		return '';
	}

	public function getLineNumber($field, $source_code, $start_from = 0)
	{
		if ($start_from < 0) {
			return -1;
		}
		for ($i = $start_from; $i < \count($source_code); ++$i) {
			if (false !== strpos($source_code[$i], $field)) {
				return $i;
			}
		}

		return -1;
	}

	public function parseAttributeLine($line)
	{
		$line = trim($line);
		// echo $line . "\n";
		$comment = '';
		if (false !== strpos($line, '//')) {
			$comment = trim(substr($line, strpos($line, '//')));
		}
		$attribute = [
			'name' => '',
			'type' => 'string',
			'dbDype' => 'string',
			'castType' => 'string',
			'length' => 0,
			'model' => null,
			'enum' => null,
			'foreignId' => null,
			'foreignTable' => null,
			'cascade' => true,
			'onDelete' => 'cascade',
			'onUpdate' => 'cascade',
			'nullable' => null,
			'index' => null,
			'unique' => null,
			'unsigned' => null,
			'arrayType' => 'index',
			'default' => null,
			'comment' => null,
			'castable' => true,
		];
		$name = trim(substr($line, 0, strpos($line, '=>')));
		$name = trim(substr($name, 1, \strlen($name) - 2));
		$attribute['name'] = $name;

		// get section between square brackets in comment by regex
		preg_match('/\[(.*)\]/', $comment, $matches);
		$section = $matches[1];
		$section = trim($section);
		$section = trim($section, '[]');
		$seperator = ',';
		if (false !== strpos($section, '|')) {
			$seperator = '|';
		}
		$section = explode($seperator, $section);
		$section = array_map('trim', $section);
		foreach ($section as $blok) {
			$blok = explode(':', $blok);
			$blok = array_map('trim', $blok);
			$key = $blok[0];
			$value = isset($blok[1]) ? $blok[1] : true;
			if ('len' === $key || 'size' === $key) {
				$key = 'length';
			}
			if ('def' === $key) {
				$key = 'default';
			}
			if ('class' === $key) {
				$key = 'model';
			}
			$attribute[$key] = $value;
		}
		// get description from comment by regex (after square brackets)
		preg_match('/\[.*\](.*)/', $comment, $matches);
		$attribute['comment'] = trim($matches[1]);

		return $attribute;
	}

	public function parseModel($model)
	{
		$class = $model['class'];
		$source_code = $this->getSourceCode($model['path']);
		$translatable_fields = [];
		if (method_exists($class, 'getTranslatableAttributes')) {
			$translatable_fields = $class->getTranslatableAttributes();
		}
		$attribute_fields = array_keys($class->getAttributes());
		$attributes = [];
		foreach ($attribute_fields as $field) {
			$field_line = $this->findFieldInSourceCode($field, $source_code);
			$attributes[] = $this->parseAttributeLine($field_line);
		}

		return [
			'source_code' => $source_code,
			'translatable_fields' => $translatable_fields,
			'attribute_fields' => $attribute_fields,
			// 'field_line' => $field_line,
			'attributes' => $attributes,
			'class' => $model['class'],
			'path' => $model['path'],
			'name' => $model['name'],
			'table_name' => $model['table_name'],
			'table_path' => $model['table_path'],
		];
	}

	public function buildModel($model): void
	{
		$casts = [];
		$casts[] = "\tprotected \$casts = [";
		foreach ($model['attributes'] as $attribute) {
			$type = $attribute['castType'] ?? $attribute['type'];
			if ($attribute['enum']) {
				$type = $attribute['enum'] . '::class';
			} else {
				$type = "'" . $attribute['type'] . "'";
			}

			$casts[] = "\t\t'" . $attribute['name'] . "' => " . $type . ',';
		}
		$casts[] = "\t];";

		$source_code = $model['source_code'];

		$attribute_start_at = $this->getLineNumber('protected $attributes = [', $source_code);
		$attribute_end_at = $this->getLineNumber('];', $source_code, $attribute_start_at);

		$casts_start_at = $this->getLineNumber('protected $casts = [', $source_code);
		$casts_end_at = $this->getLineNumber('];', $source_code, $casts_start_at);

		if (-1 === $casts_start_at) {
			$this->error('Model ' . $model['name'] . ' does not have casts');

			return;
		}

		$source_code_left = \array_slice($source_code, 0, $casts_start_at);
		$source_code_right = \array_slice($source_code, $casts_end_at + 1);
		$source_code = array_merge($source_code_left, $casts, $source_code_right);
		$buffer = implode("\n", $source_code);
		// echo $buffer;
		File::put($model['path'], $buffer);
	}

	public function buildModelTable($model): void
	{
		$source_code = $this->getSourceCode($model['table_path']);
		if (-1 !== $this->getLineNumber('ignore this table', $source_code)) {
			$this->warn('Model ' . $model['name'] . ' does not have table');

			return;
		}

		$start_at = $this->getLineNumber('Schema::create(\'' . $model['table_name'] . '\'', $source_code);
		$end_at = $this->getLineNumber('});', $source_code, $start_at);

		if (-1 === $start_at) {
			$this->error('Model ' . $model['name'] . ' does not have table');

			return;
		}
		$cols = [];
		$cols[] = '$table->id();';
		foreach ($model['translatable_fields'] as $field) {
			$cols[] = '$table->json(\'' . $field . '\')->default(\'{}\');';
		}
		foreach ($model['attributes'] as $attribute) {
			$col = '$table';
			if (null !== $attribute['model']) {
				$col .= '->foreignId(\'' . $attribute['name'] . '\')';
				if ($attribute['nullable']) {
					$col .= '->nullable()';
				}
				if ($attribute['foreignId'] && $attribute['foreignTable']) {
					$col .= '->references(\'' . $attribute['foreignId'] . '\')';
					$col .= '->on(\'' . $attribute['foreignTable'] . '\')';
				} else {
					$col .= '->constrained()';
				}
				if ($attribute['cascade']) {
					$col .= '->onDelete(\'cascade\')';
					$col .= '->onUpdate(\'cascade\')';
				} else {
					if ($attribute['onDelete']) {
						$col .= '->onDelete(\'' . $attribute['onDelete'] . '\')';
					}
					if ($attribute['onUpdate']) {
						$col .= '->onUpdate(\'' . $attribute['onUpdate'] . '\')';
					}
				}
			} elseif (null !== $attribute['enum']) {
				$enumNamespace = '\\App\\Enums\\' . $attribute['enum'];
				$type = \gettype($enumNamespace::cases()[0]->value);
				$values = array_map(function ($case) use ($type) {
					if ('string' === $type) {
						return "'" . $case->value . "'";
					}

					return $case->value;
				}, $enumNamespace::cases());
				$col .= '->enum(\'' . $attribute['name'] . '\', [' . implode(', ', $values) . '])';
			} else {
				$type = $attribute['dbType'] ?? $attribute['type'];

				$col .= '->' . $type . '(\'' . $attribute['name'] . '\'' . ($attribute['length'] ? ", {$attribute['length']}" : '') . ')';
				if ($attribute['nullable']) {
					$col .= '->nullable()';
				}
				if ($attribute['default']) {
					if ('string' === $attribute['type']) {
						$col .= '->default(\'' . $attribute['default'] . '\')';
					} else {
						$col .= '->default(' . $attribute['default'] . ')';
					}
				} else {
					if ('json' === $type) {
						if ('index' === $attribute['arrayType']) {
							$col .= '->default(\'[]\')';
						} else {
							$col .= '->default(\'{}\')';
						}
					}
				}

				if ($attribute['index']) {
					$col .= '->index()';
				}
				if ($attribute['unique']) {
					$col .= '->unique()';
				}
				if ($attribute['unsigned']) {
					$col .= '->unsigned()';
				}
			}
			if ($attribute['comment']) {
				$col .= '->comment(\'' . $attribute['comment'] . '\')';
			}
			$cols[] = $col . ';';
		}
		if ($model['class']->timestamps) {
			$cols[] = '$table->timestamps();';
		}

		$cols = array_map(function ($col) {
			return "\t\t\t" . $col;
		}, $cols);

		$source_code_left = \array_slice($source_code, 0, $start_at + 1);
		$source_code_right = \array_slice($source_code, $end_at);
		$source_code = array_merge($source_code_left, $cols, $source_code_right);

		$buffer = implode("\n", $source_code);

		// echo $buffer;
		File::put($model['table_path'], $buffer);
	}

	public function handle()
	{
		// $this->info('This will appear in console');
		// $this->error('This error will appear in console');
		// $this->line('This line will appear in console');

		$models = $this->getAvailableModels();

		// log models count
		$this->info(database_path('migrations'));
		$this->info('Models count: ' . \count($models));

		// log models's table names
		$this->info('Models table names:');

		foreach ($models as $model) {
			$parsed_model = $this->parseModel($model);
			$this->buildModel($parsed_model);
			$this->buildModelTable($parsed_model);
			// exit;
			// log translatable_fields
			$this->warn('Model: ' . $model['name']);
			$this->info('Model builded');
			$this->info('Model table builded');
			// $this->info('Translatable fields: ' . \count($parsed_model['translatable_fields']) . ' - ' . implode(', ', $parsed_model['translatable_fields']));

			// // log attribute_fields
			// $this->info('Attribute fields: ' . \count($parsed_model['attribute_fields']) . ' - ' . implode(', ', $parsed_model['attribute_fields']));
		}

		// $this->info(base_path());

		return 0;
	}
}
