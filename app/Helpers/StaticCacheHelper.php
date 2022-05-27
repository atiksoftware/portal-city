<?php

namespace App\Helpers;

use App\Models\Post;
use App\Models\Person;
use App\Models\Business;
use Atiksoftware\StaticCache\Cache;
use Illuminate\Support\Facades\App;

class StaticCacheHelper
{
	public static $cache;

	public static function clear($path): void
	{
		if (null === self::$cache) {
			self::$cache = App::make(Cache::class);
		}
		self::$cache->clear($path);
	}

	public static function forget($path): void
	{
		if (null === self::$cache) {
			self::$cache = App::make(Cache::class);
		}
		self::$cache->forget($path);
	}

	public static function clearHome(): void
	{
		self::clear('__index*');
	}

	public static function clearPersons(): void
	{
		self::clearHome();
		self::clear('kimkimdir.html');
	}

	public static function clearPerson(Person $person): void
	{
		self::clearPersons();
		self::clear('kimkimdir/' . $person->slug);
	}

	public static function clearBusinesses(): void
	{
		self::clearHome();
		self::clear('firmalar*');
	}

	public static function clearBusiness(Business $business): void
	{
		self::clearBusinesses();
		self::clear('firma/' . $business->slug);
	}

	public static function clearPosts(): void
	{
		self::clearHome();
		self::clear('haberler*');
	}

	public static function clearPost(Post $post): void
	{
		self::clearHome();
		self::clearPosts();
		self::clearRss();
		self::clear('haber/' . $post->slug);
	}

	public static function clearSitemaps(): void
	{
		self::clear('sitemap*');
	}

	public static function clearRss(): void
	{
		self::clear('rss*');
	}

	public static function clearAll(): void
	{
		self::clear('*');
	}
}
