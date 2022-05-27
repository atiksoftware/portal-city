<?php

namespace App\Transporter;

use App\Models\Tag;
use App\Models\Block;
use App\Models\Inode;
use App\Models\Business;
use Illuminate\Support\Facades\App;

class BusinessManager
{
	public $userManager;

	public $businessCategoryManager;

	public $list = [];

	public function run(): void
	{
		$this->removeAll();

		$rows = Helper::getCollection('firmalar');
		if (!App::environment('production')) {
			$rows = \array_slice($rows, 0, 50);
		}
		$count = \count($rows);

		foreach ($rows as $i => $row) {
			Helper::info($i . '/' . $count . ' - ' . $row['name']);
			$this->import($row);
		}
	}

	public function removeAll(): void
	{
		foreach (Business::all() as $item) {
			$item->delete();
		}
	}

	public function import($row): void
	{
		$business = new Business();
		$business->name = $row['name'];
		$business->email = $row['email'] ?? null;
		$business->phone = Helper::getPhoneNumber($row['phone'] ?? null);
		$business->address = $row['address'] ?? null;
		$business->fax = Helper::getPhoneNumber($row['fax'] ?? null);
		$business->website = $row['site'] ?? null;

		if (isset($row['location'])) {
			$business->location_lat = (float) ($row['location']['lat'] ?? 0);
			$business->location_lng = (float) ($row['location']['lng'] ?? 0);
			$business->location_heading = (float) ($row['location']['heading'] ?? 0);
			$business->location_pitch = (float) ($row['location']['pitch'] ?? 0);
			if (isset($row['location']['active'])) {
				$business->location_show_map = 1 === (int) ($row['location']['active']['map'] ?? 0);
				$business->location_show_view = 1 === (int) ($row['location']['active']['street'] ?? 0);
			}
		}

		if (isset($row['ilce']) && !empty($row['ilce'])) {
			$business->district_id = Helper::getDistrictId($row['ilce']);
		}

		if (isset($row['categorie']) && !empty($row['categorie'])) {
			if (\is_array($row['categorie']) && \count($row['categorie']) > 0) {
				if (isset($this->business_categories[$row['categorie'][0]])) {
					$business->category_id = $this->business_categories[$row['categorie'][0]]->id;
				}
			}
		}
		if (isset($row['worktime']) && !empty($row['worktime'])) {
			$wts = explode('-', $row['worktime']);
			if (2 === \count($wts)) {
				$business->working_start_at = $wts[0];
				$business->working_end_at = $wts[1];
			}
		}

		if (isset($row['id_user']) && !empty($row['id_user'])) {
			if (isset($this->userManager->list[$row['id_user']])) {
				$business->user_id = $this->userManager->list[$row['id_user']]->id;
			}
		}

		if (isset($row['counter']) && !empty($row['counter'])) {
			$business->view_count = (int) $row['counter'];
		}

		$business->save();

		if (isset($row['images']['profile']) && !empty($row['images']['profile'])) {
			foreach ($row['images']['profile'] as $url) {
				$inode = Helper::getInode($url);
				$business->profile_images()->attach($inode->id);
			}
		} else {
			$business->profile_images()->attach(Inode::where('uuid', 'business_profile_image')->first()->id);
		}

		if (isset($row['images']['list']) && !empty($row['images']['list'])) {
			foreach ($row['images']['list'] as $url) {
				$inode = Helper::getInode($url);
				$business->cover_images()->attach($inode->id);
			}
		} else {
			$business->profile_images()->attach(Inode::where('uuid', 'business_cover_image')->first()->id);
		}

		if (isset($row['tags']) && !empty($row['tags'])) {
			foreach ($row['tags'] as $tagName) {
				$tag = Tag::firstOrCreate(['name' => $tagName]);
				$business->tags()->attach($tag->id);
			}
		}

		foreach ($row['values'] as $vkey => $value) {
			$type = $value['type'];
			if ('text' === $type) {
				$block = new Block();
				$block->type_id = 1;
				$text = $value['text'];
				if (empty(strip_tags($text))) {
					continue;
				}
				$text = Helper::clearText($text);

				$block->content = $text;
				$block->save();
				$business->blocks()->attach($block->id);
			}
			if ('image' === $type) {
				$title = $value['title'] ?? '';
				$block = new Block();
				$block->type_id = 2;
				$block->content = $title;
				$block->save();
				if (isset($value['list'])) {
					$inodes = [];
					foreach ($value['list'] as $url) {
						$inode = Helper::getInode($url);
						$inodes[] = $inode->id;
					}
					$block->images()->attach($inodes);
				}
				$business->blocks()->attach($block->id);
			}
		}
	}
}
