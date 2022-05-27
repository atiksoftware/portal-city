<?php

namespace App\Helpers;

class ShareHelper
{
	public static function getItems()
	{
		$items = [];

		$items[] = [
			'title' => 'Facebook',
			'icon' => 'facebook-square',
		];

		$items[] = [
			'title' => 'Twitter',
			'icon' => 'twitter-square',
		];

		$items[] = [
			'title' => 'Linkedin',
			'icon' => 'linkedin',
		];
		$items[] = [
			'title' => 'E-Mail',
			'icon' => 'envelope',
		];
		$items[] = [
			'title' => 'Whatsapp',
			'icon' => 'whatsapp',
		];

		return $items;
	}
}
