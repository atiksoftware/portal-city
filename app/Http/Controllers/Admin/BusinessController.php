<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Block;
use App\Models\Inode;
use App\Models\Business;
use App\Helpers\ToastHelper;
use Illuminate\Http\Request;
use App\Helpers\RemoveHelper;
use App\Http\Controllers\Controller;

class BusinessController extends Controller
{
	public function index(Request $request)
	{
		$records = [];

		$search = $request->input('search');

		if (null !== $search) {
			$records = Business::where('name', 'like', '%' . $search . '%')
				->orderBy('name', 'ASC')
				->paginate(50);
		} else {
			$records = Business::orderBy('name', 'ASC')
				->paginate(50);
		}

		return view('admin.pages.businesses', [
			'businesses' => $records,
		]);
	}

	public function edit(Request $request, $id = null)
	{
		$business = new Business();
		if (null !== $id) {
			$business = Business::with([
				'blocks',
				'blocks.images',
			])->find($id);
		}

		return view('admin.pages.business', [
			'business' => $business,
		]);
	}

	public function save(Request $request, $id = null)
	{
		// validate the request
		$this->validate($request, [
			'name' => 'required|max:255',
		], [
			'name.required' => 'Bir ad girmelisiniz.',
		]);

		$business = new Business();
		if (null !== $id) {
			$business = Business::find($id);
			foreach ($business->blocks as $block) {
				$block->images()->detach();
				$business->blocks()->detach($block);
				$block->delete();
			}
			ToastHelper::info('Firma bilgileri kaydedildi.');
		} else {
			ToastHelper::success('Yeni firma eklendi.');
		}

		$business->user_id = $request->input('user_id');

		$business->name = $request->input('name');
		$business->email = $request->input('email');
		$business->phone = $request->input('phone');
		$business->fax = $request->input('fax');
		$business->website = $request->input('website');
		$business->address = $request->input('address');
		$business->working_start_at = $request->input('working_start_at');
		$business->working_end_at = $request->input('working_end_at');
		$business->google_maps_link = $request->input('google_maps_link');
		$business->location_lat = $request->input('lat');
		$business->location_lng = $request->input('lng');

		$business->district_id = $request->input('district_id');
		$business->category_id = $request->input('category_id') ?? null;

		$business->min_price = $request->input('min_price');
		$business->max_price = $request->input('max_price');
		$business->currency = $request->input('currency');

		$business->contact_person_name = $request->input('contact_person_name');

		$business->youtube_link = $request->input('youtube_link');

		$business->save();

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

				$business->blocks()->attach($block->id);
			}
		}

		$request_profile_images = $request->input('profile_images');
		$business->profile_images()->detach();
		if (null !== $request_profile_images) {
			$business->profile_images()->attach($request_profile_images);
		} else {
			$business->profile_images()->attach(Inode::where('uuid', 'business_profile_image')->first()->id);
		}

		$request_cover_images = $request->input('cover_images');
		$business->cover_images()->detach();
		if (null !== $request_cover_images) {
			$business->cover_images()->attach($request_cover_images);
		} else {
			$business->cover_images()->attach(Inode::where('uuid', 'business_cover_image')->first()->id);
		}

		$business->tags()->detach();
		$tags = $request->input('tags');
		if (\is_string($tags)) {
			if (strstr($tags, '[')) {
				$tags = array_map(function ($tag) {
					return $tag->value;
				}, json_decode($tags));
			} else {
				$tags = explode(',', $tags);
			}
			foreach ($tags as $tagName) {
				$tag = Tag::firstOrCreate(['name' => $tagName]);
				$business->tags()->attach($tag->id);
			}
		}

		return redirect('/admin/businesses/edit/' . $business->id);
	}

	public function remove(Request $request, Business $business)
	{
		RemoveHelper::hook();

		return view('admin.pages.remove', [
			'name' => $business->name,
		]);
	}

	public function destroy(Request $request, Business $business)
	{
		$business->delete();

		ToastHelper::warning($business->name . ' silindi.');

		return RemoveHelper::goBack('admin.businesses');
	}
}
