<?php

namespace App\Transporter;

use App\Models\Block;
use App\Models\Inode;
use App\Models\Person;
use Illuminate\Support\Facades\App;

class PersonManager
{
	public $userManager;

	public $list = [];

	public function run(): void
	{
		$this->removeAll();

		$rows = Helper::getCollection('kimkimdir');
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
		foreach (Person::all() as $item) {
			$item->delete();
		}
	}

	public function import($row): void
	{
		Helper::info($row['name']);

		$person = new Person();
		$person->name = $row['name'];
		$person->email = $row['email'];
		$person->is_active = true;
		if (isset($row['phone']) && '' !== $row['phone']) {
			$person->phone = Helper::getPhoneNumber($row['phone']);
		}
		$person->district_id = Helper::getDistrictId($row['ilce']);

		$created_at = \Carbon\Carbon::now();
		if (isset($row['date']['edit'])) {
			$created_at = \Carbon\Carbon::createFromTimestamp($row['date']['edit']);
		}
		$person->created_at = $created_at;
		$person->updated_at = $created_at;

		if (isset($row['id_user']) && !empty($row['id_user'])) {
			if (isset($this->userManager->list[$row['id_user']])) {
				$person->user_id = $this->userManager->list[$row['id_user']]->id;
			}
		}

		if (isset($row['counter']) && !empty($row['counter'])) {
			$person->view_count = (int) $row['counter'];
		}

		$person->save();

		if (isset($row['images']['profile']) && !empty($row['images']['profile'])) {
			foreach ($row['images']['profile'] as $url) {
				$inode = Helper::getInode($url);
				$person->profile_images()->attach($inode->id);
			}
		} else {
			$person->profile_images()->attach(Inode::where('uuid', 'person_profile_image')->first()->id);
		}

		if (isset($row['images']['list']) && !empty($row['images']['list'])) {
			foreach ($row['images']['list'] as $url) {
				$inode = Helper::getInode($url);
				$person->cover_images()->attach($inode->id);
			}
		} else {
			$person->profile_images()->attach(Inode::where('uuid', 'person_cover_image')->first()->id);
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
				$person->blocks()->attach($block->id);
			}
			if ('image' === $type) {
				$title = $row['valus'][$vkey]['title'];
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
				$person->blocks()->attach($block->id);
			}
		}
	}
}
