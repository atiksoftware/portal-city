<?php

namespace App\Transporter;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Inode;
use Illuminate\Support\Facades\App;

class PostManager
{
	public $userManager;

	public $list = [];

	public function run(): void
	{
		$this->removeAll();

		$rows = Helper::getCollection('haberler');
		if (!App::environment('production')) {
			$rows = \array_slice($rows, 0, 150);
		}
		$count = \count($rows);

		foreach ($rows as $i => $row) {
			Helper::info($i . '/' . $count . ' - ' . $row['title']);
			$this->import($row);
		}
	}

	public function removeAll(): void
	{
		foreach (Post::all() as $item) {
			$item->delete();
		}
	}

	public function import($row): void
	{
		$post = new Post();
		$post->title = $row['title'];
		$post->summary = $row['description'];
		$text = $row['text'];
		if (empty(strip_tags($text))) {
			return;
		}
		$text = Helper::clearText($text);
		$post->content = $text;

		$post->district_id = Helper::getDistrictId($row['ilce']);

		if (isset($row['categories']) && !empty($row['categories'])) {
			$post->category_id = Helper::getCategoryId($row['categories'][0]);
		}
		if (isset($row['counter']) && !empty($row['counter'])) {
			$post->view_count = (int) $row['counter'];
		}

		if (isset($row['id_user']) && !empty($row['id_user'])) {
			if (isset($this->userManager->list[$row['id_user']])) {
				$post->user_id = $this->userManager->list[$row['id_user']]->id;
			}
		}

		$post->save();

		if (isset($row['images']['cuff']) && !empty($row['images']['cuff'])) {
			foreach ($row['images']['cuff'] as $url) {
				$inode = Helper::getInode($url);
				$post->featured_images()->attach($inode->id);
			}
		} else {
			$post->featured_images()->attach(Inode::where('uuid', 'post_cover_image')->first()->id);
		}
		if (isset($row['images']['list']) && !empty($row['images']['list'])) {
			foreach ($row['images']['list'] as $url) {
				$inode = Helper::getInode($url);
				$post->gallery_images()->attach($inode->id);
			}
		}

		if (isset($row['tags']) && !empty($row['tags'])) {
			foreach ($row['tags'] as $tagName) {
				$tag = Tag::firstOrCreate(['name' => $tagName]);
				$post->tags()->attach($tag->id);
			}
		}
	}
}
