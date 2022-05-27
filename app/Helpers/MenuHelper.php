<?php

namespace App\Helpers;

class MenuHelper
{
	public static function getAdminMenuItems()
	{
		$items = [];

		$items[] = [
			'title' => 'Haberler',
			'url' => route('admin.posts'),
			'is_active' => request()->is('admin/posts*'),
		];

		$items[] = [
			'title' => 'Kişiler',
			'url' => route('admin.persons'),
			'is_active' => request()->is('admin/persons*'),
		];

		$items[] = [
			'title' => 'Firmalar',
			'url' => route('admin.businesses'),
			'is_active' => request()->is('admin/businesses*'),
		];

		$items[] = [
			'title' => 'Firma Kategorileri',
			'url' => route('admin.business_categories'),
			'is_active' => request()->is('admin/business_categories*'),
		];
		$items[] = [
			'title' => 'Reklamlar',
			'url' => route('admin.adwords'),
			'is_active' => request()->is('admin/adwords*'),
		];
		$items[] = [
			'title' => 'Kullanıcılar',
			'url' => route('admin.users'),
			'is_active' => request()->is('admin/users*'),
		];
		$items[] = [
			'title' => 'Settings',
			'url' => route('admin.settings'),
			'is_active' => request()->is('admin/settings*'),
		];

		return $items;
	}
}
