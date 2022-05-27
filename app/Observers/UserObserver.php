<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
	public function deleting(User $user): void
	{
		$businesses = $user->businesses()->get();
		foreach ($businesses as $business) {
			$business->user_id = null;
			$business->save();
		}

		$persons = $user->persons()->get();
		foreach ($persons as $person) {
			$person->user_id = null;
			$person->save();
		}

		$posts = $user->posts()->get();
		foreach ($posts as $post) {
			$post->user_id = null;
			$post->save();
		}
	}
}
