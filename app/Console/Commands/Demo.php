<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Transporter\PostManager;
use App\Transporter\UserManager;
use App\Transporter\AdwordManager;
use App\Transporter\PersonManager;
use App\Transporter\BusinessManager;
use App\Transporter\BusinessCategoryManager;

class Demo extends Command
{
	protected $signature = 'demo';

	protected $description = 'Command description';

	public function __construct()
	{
		parent::__construct();
	}

	public function handle()
	{
		// $userManager = new UserManager();
		// $userManager->run();

		// $businessCategoryManager = new BusinessCategoryManager();
		// $businessCategoryManager->run();

		// $businessManager = new BusinessManager();
		// $businessManager->userManager = $userManager;
		// $businessManager->businessCategoryManager = $businessCategoryManager;
		// $businessManager->run();

		// $personManager = new PersonManager();
		// $personManager->userManager = $userManager;
		// $personManager->run();

		// $postManager = new PostManager();
		// $postManager->userManager = $userManager;
		// $postManager->run();

		$adwordManager = new AdwordManager();
		$adwordManager->run();

		// $this->importPersons();

		// $this->importBusinessCategories();
		// $this->importBusinesses();

		// $this->importPosts();

		return 0;
	}
}
