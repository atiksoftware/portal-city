<?php

namespace App\Transporter;

use App\Models\Category;

class BusinessCategoryManager
{
	public $list = [];

	public function run(): void
	{
		$this->removeAll();

		$rows = Helper::getCollection('firmalar_kategoriler');

		foreach ($rows as $row) {
			$this->import($row);
		}
	}

	public function removeAll(): void
	{
		foreach (Category::where('type_id', 2)->get() as $item) {
			$item->delete();
		}
	}

	public function import($row): void
	{
		$text = $row['text'] ?? '';
		if (empty(strip_tags($text))) {
			return;
		}

		$text = Helper::clearText($text);

		Helper::info($row['name']);

		$this->list[$row['_id']] = Category::create([
			'name' => $row['name'],
			'type_id' => 2,
			'content' => $text,
		]);
	}
}
