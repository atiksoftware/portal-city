<?php

namespace App\Http\Controllers\App;

use App\Models\Block;
use App\Models\Inode;
use App\Models\Person;
use App\Helpers\ToastHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MyPersonController extends Controller
{
	public function index(Request $request)
	{
		$person = Person::MyPerson();

		return view('app.pages.my-person', [
			'person' => $person,
		]);
	}

	public function save(Request $request)
	{
		$this->validate($request, [
			'name' => 'required|max:255',
		], [
			'name.required' => 'Bir ad girmelisiniz.',
		]);
		$person = Person::MyPerson();
		foreach ($person->blocks as $block) {
			$block->images()->detach();
			$person->blocks()->detach($block);
			$block->delete();
		}
		ToastHelper::info('Kişi bilgileri güncellendi.');

		$person->name = $request->input('name');
		$person->email = $request->input('email');
		$person->phone = $request->input('phone');
		$person->website = $request->input('website');

		$person->district_id = $request->input('district_id');

		$person->facebook_link = $request->input('facebook_link');
		$person->twitter_link = $request->input('twitter_link');
		$person->instagram_link = $request->input('instagram_link');
		$person->linkedin_link = $request->input('linkedin_link');
		$person->youtube_link = $request->input('youtube_link');
		$person->tiktok_link = $request->input('tiktok_link');
		$person->github_link = $request->input('github_link');

		$person->job_title = $request->input('job_title');
		$person->company_name = $request->input('company_name');

		$person->save();

		$blockItems = $request->input('blocks');
		if (null !== $blockItems) {
			foreach ($blockItems as $item) {
				$type_id = (int) $item['type_id'];
				$content = $item['content'] ?? '';
				$block = new Block();
				$block->type_id = $type_id;
				$block->content = $content;
				$block->save();

				if (2 === $type_id) {
					if (isset($item['images'])) {
						$image_ids = array_values($item['images']);
						if (\count($image_ids) > 0) {
							$block->images()->attach($image_ids);
						}
					}
				}

				$person->blocks()->attach($block->id);
			}
		}

		$request_profile_images = $request->input('profile_images');
		$person->profile_images()->detach();
		if (null !== $request_profile_images) {
			$person->profile_images()->attach($request->input('profile_images'));
		} else {
			$person->profile_images()->attach(Inode::where('uuid', 'person_profile_image')->first()->id);
		}

		$request_cover_images = $request->input('cover_images');
		$person->cover_images()->detach();
		if (null !== $request_cover_images) {
			$person->cover_images()->attach($request->input('cover_images'));
		} else {
			$person->cover_images()->attach(Inode::where('uuid', 'person_cover_image')->first()->id);
		}

		return redirect()->route('my-person');
	}
}
