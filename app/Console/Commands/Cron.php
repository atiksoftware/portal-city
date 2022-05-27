<?php

namespace App\Console\Commands;

use App\Helpers\CurrencyHelper;
use App\Helpers\WeatherHelper;
use Illuminate\Console\Command;

class Cron extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'cron:sync';

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

	public function handle()
	{
		CurrencyHelper::sync();
		WeatherHelper::sync();

		return 0;
	}
}
