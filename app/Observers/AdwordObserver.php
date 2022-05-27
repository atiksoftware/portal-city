<?php

namespace App\Observers;

use App\Models\Adword;

class AdwordObserver
{
	public function deleting(Adword $adword): void
	{
		$adword->images()->detach();
	}
}
