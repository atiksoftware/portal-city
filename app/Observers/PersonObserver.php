<?php

namespace App\Observers;

use App\Models\Person;
use Illuminate\Support\Str;
use App\Helpers\StaticCacheHelper;

class PersonObserver
{
	public function saving(Person $person): void
	{
		// $person->slug = Str::slug($person->name);

		$this->calculatePercentage($person);
	}

	public function saved(Person $person): void
	{
		StaticCacheHelper::clearPerson($person);
	}

	public function deleting(Person $person): void
	{
		$person->profile_images()->detach();
		$person->cover_images()->detach();

		$blocks = $person->blocks;
		$person->blocks()->detach();
		foreach ($blocks as $block) {
			$block->delete();
		}
	}

	public function calculatePercentage(Person $person): void
	{
		$fill_count = 0;
		$fill_count += $person->name ? 1 : 0;
		$fill_count += $person->phone ? 1 : 0;
		$fill_count += $person->email ? 1 : 0;
		$fill_count += $person->website ? 1 : 0;
		$fill_count += $person->district_id ? 1 : 0;

		if ($person->facebook_link || $person->twitter_link || $person->instagram_link || $person->linkedin_link || $person->youtube_link || $person->tiktok_link || $person->github_link) {
			++$fill_count;
		}

		$fill_count += $person->job_title ? 1 : 0;
		$fill_count += $person->company_name ? 1 : 0;

		$fill_count_max = 8;
		$person->fill_percentage = $fill_count / $fill_count_max * 100;
	}
}
