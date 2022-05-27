<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class PostFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition()
	{
		$title = $this->faker->sentence;
		$slug = Str::slug($title);

		return [
			'title' => $title,
			'slug' => $slug,

			'district_id' => null,
			'category_id' => null,

			'summary' => $this->faker->sentence,
			'content' => $this->faker->paragraph,
		];
	}
}
