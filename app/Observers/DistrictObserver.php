<?php

namespace App\Observers;

use App\Models\District;
use Illuminate\Support\Str;

class DistrictObserver
{
	public function creating(District $district): void
	{
		$district->slug = Str::slug($district->name);
	}

	public function updating(District $district): void
	{
		$district->slug = Str::slug($district->name);
	}
}
