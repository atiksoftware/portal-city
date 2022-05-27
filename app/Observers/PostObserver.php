<?php

namespace App\Observers;

use App\Helpers\StaticCacheHelper;
use App\Models\Post;
use Illuminate\Support\Str;

class PostObserver
{
	public function saving(Post $post): void
	{
		// $post->slug = Str::slug($post->title);

		if (null === $post->summary) {
			$post->summary = '';
		}

		if (null === $post->content) {
			$post->content = '';
		}
	}

	public function saved(Post $post): void
	{
		StaticCacheHelper::clearPost($post);
	}

	public function deleting(Post $post): void
	{
		$post->featured_images()->detach();
		$post->gallery_images()->detach();
		$post->tags()->detach();
	}
}
