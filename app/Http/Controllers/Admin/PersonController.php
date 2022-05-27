<?php

namespace App\Http\Controllers\Admin;

use App\Models\Block;
use App\Models\Inode;
use App\Models\Person;
use App\Helpers\ToastHelper;
use Illuminate\Http\Request;
use App\Helpers\RemoveHelper;
use App\Http\Controllers\Controller;

class PersonController extends Controller
{
	public function index(Request $request)
	{
		$records = [];

		$search = $request->input('search');

		if (null !== $search) {
			$records = Person::where('name', 'like', '%' . $search . '%')
				->orderBy('name', 'ASC')
				->paginate(50);
		} else {
			$records = Person::orderBy('name', 'ASC')
				->paginate(50);
		}

		return view('admin.pages.persons', [
			'persons' => $records,
		]);
	}

	public function edit(Request $request, $id = null)
	{
		$person = new Person();
		if (null !== $id) {
			$person = Person::with([
				// 'blocks',
				// 'blocks.images',
			])->find($id);
		}

		return view('admin.pages.person', [
			'person' => $person,
		]);
	}

	public function save(Request $request, $id = null)
	{
		$this->validate($request, [
			'name' => 'required|max:255',
		], [
			'name.required' => 'Bir ad girmelisiniz.',
		]);
		$person = new Person();
		if (null !== $id) {
			$person = Person::find($id);
			foreach ($person->blocks as $block) {
				$block->images()->detach();
				$person->blocks()->detach($block);
				$block->delete();
			}
			ToastHelper::info('Kişi bilgileri güncellendi.');
		} else {
			ToastHelper::success('Yeni kişi kaydedildi.');
		}

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

		return redirect('/admin/persons/edit/' . $person->id);
	}

	public function remove(Request $request, Person $person)
	{
		RemoveHelper::hook();

		return view('admin.pages.remove', [
			'name' => $person->name,
		]);
	}

	public function destroy(Request $request, Person $person)
	{
		$person->delete();

		ToastHelper::warning($person->name . ' silindi.');

		return RemoveHelper::goBack('admin.persons');
	}
}
