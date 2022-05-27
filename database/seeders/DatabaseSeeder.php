<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\District;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{
		// \App\Models\User::factory(10)->create();

		District::create(['name' => 'Bolu']);
		District::create(['name' => 'Gerede']);
		District::create(['name' => 'Dörtdivan']);
		District::create(['name' => 'Yeniçağa']);
		District::create(['name' => 'Mengen']);
		District::create(['name' => 'Seben']);
		District::create(['name' => 'Kıbrıscık']);
		District::create(['name' => 'Mudurnu']);
		District::create(['name' => 'Göynük']);

		Category::create(['name' => 'Haber', 'type_id' => 1]);
		Category::create(['name' => 'Ekonomi', 'type_id' => 1]);
		Category::create(['name' => 'Spor', 'type_id' => 1]);
		Category::create(['name' => 'Magazin', 'type_id' => 1]);
		Category::create(['name' => 'Sağlık', 'type_id' => 1]);
		Category::create(['name' => 'Yaşam', 'type_id' => 1]);
		Category::create(['name' => 'Video Haber', 'type_id' => 1]);

		// add 300 Posts with faker
		// \App\Models\Post::factory(300)->create();

		$this->call(InodeSeeder::class);
		$this->call(SettingsSeeder::class);
	}
}
