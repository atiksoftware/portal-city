<?php

namespace App\Observers;

use App\Models\Business;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryObserver
{
	// public function creating(Category $category): void
	// {
	// 	$category->slug = Str::slug($category->name);
	// }

	// public function updating(Category $category): void
	// {
	// 	$category->slug = Str::slug($category->name);
	// }

	public function saving(Category $category): void
	{
		$category->slug = Str::slug($category->name);
		if (null === $category->content) {
			$category->content = '';
		}
	}

	public function deleting(Category $category): void
	{
		if (1 === $category->type_id) {
		}

		if (2 === $category->type_id) {
			// set category_id as null which Business has category_id
			$businesses = Business::where('category_id', $category->id)->get();
			foreach ($businesses as $business) {
				$business->category_id = null;
				$business->save();
			}
		}
	}
}
