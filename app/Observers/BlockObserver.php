<?php

namespace App\Observers;

use App\Models\Block;

class BlockObserver
{
	public function deleting(Block $block): void
	{
		$block->images()->detach();
	}
}
