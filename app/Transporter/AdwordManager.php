<?php

namespace App\Transporter;

use App\Models\Adword;

class AdwordManager
{
	public $list = [];

	public function run(): void
	{
		$this->removeAll();

		$rows = Helper::getCollection('adwords');
		$count = \count($rows);

		foreach ($rows as $i => $row) {
			Helper::info($i . '/' . $count . ' - ' . $row['name']);
			$this->import($row);
		}
	}

	public function removeAll(): void
	{
		foreach (Adword::all() as $item) {
			$item->delete();
		}
	}

	public function import($row): void
	{
		$adword = new Adword();
		$adword->title = $row['name'];
		$adword->html_code = $row['html'];

		switch ($row['area']) {
				case 'right_col_1':
					$adword->type_id = 'RIGHT_SIDE_BAR_1';
					break;
				case 'right_col_2':
					$adword->type_id = 'RIGHT_SIDE_BAR_2';
					break;
				case 'header':
					if ('slider' === $row['html']) {
						$adword->type_id = 'BOTTOM_OF_HEADER_SLIDER';
					} else {
						$adword->type_id = 'BOTTOM_OF_HEADER';
					}
					break;
				case 'haber_detay_intext':
					$adword->type_id = 'POST_INTEXT';
					break;
				case 'haber_detay_bottom_topimage':
					$adword->type_id = 'POST_UNDERCOVER';
					break;
				case 'kule_left':
					$adword->type_id = 'STICKER_LEFT';
					break;
				case 'kule_right':
					$adword->type_id = 'STICKER_RIGHT';
					break;
				case 'index_sinemalar_top':
					$adword->type_id = 'HOME_TOP_OF_CINEMAS';
					break;
				case 'index_sinemalar_bottom':
					$adword->type_id = 'HOME_BUTTOM_OF_CINEMAS';
					break;
			}

		$adword->is_active = 1 === $row['active'] ? true : false;
		if ('POST_UNDERCOVER' === $adword->type_id) {
			$adword->is_active = false;
		}
		$adword->save();

		foreach ($row['images']['list'] as $url) {
			$inode = Helper::getInode($url);
			$adword->images()->attach($inode->id);
		}

		Adword::create([
			'title' => $row['name'],
			'html_code' => $row['html'],
		]);
	}
}
