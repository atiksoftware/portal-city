<?php

namespace App\Observers;

use App\Models\Business;
use Illuminate\Support\Str;
use App\Helpers\StaticCacheHelper;

class BusinessObserver
{
	public function saving(Business $business): void
	{
		// $business->slug = Str::slug($business->name);

		$this->calculatePercentage($business);
	}

	public function saved(Business $business): void
	{
		StaticCacheHelper::clearBusiness($business);
	}

	public function deleting(Business $business): void
	{
		$business->profile_images()->detach();
		$business->cover_images()->detach();
		$business->tags()->detach();

		$blocks = $business->blocks;
		$business->blocks()->detach();
		foreach ($blocks as $block) {
			$block->delete();
		}
	}

	public function calculatePercentage(Business $business): void
	{
		$fill_count = 0;
		$fill_count += $business->name ? 1 : 0;
		$fill_count += $business->phone ? 1 : 0;
		$fill_count += $business->fax ? 1 : 0;
		$fill_count += $business->email ? 1 : 0;
		$fill_count += $business->website ? 1 : 0;

		$fill_count += $business->address ? 1 : 0;
		$fill_count += $business->zip ? 1 : 0;

		$fill_count += $business->district_id ? 1 : 0;
		$fill_count += $business->category_id ? 1 : 0;

		if ($business->google_maps_link) {
			++$fill_count;
		}

		$fill_count += $business->working_start_at ? 1 : 0;
		$fill_count += $business->working_end_at ? 1 : 0;

		$fill_count += $business->min_price ? 1 : 0;
		$fill_count += $business->max_price ? 1 : 0;
		$fill_count += $business->currency ? 1 : 0;

		$fill_count += $business->contact_person_name ? 1 : 0;

		$fill_count_max = 16;
		$business->fill_percentage = $fill_count / $fill_count_max * 100;
	}
}
