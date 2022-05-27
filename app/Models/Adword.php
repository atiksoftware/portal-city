<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adword extends Model
{
	protected $attributes = [
		'title' => '', // [type:string, nullable]
		'type_id' => '', // [type:string, length:32, nullable]
		'html_code' => '', // [type:string, dbType:text, nullable]
		'target_url' => '', // [type:string, nullable]
		'is_active' => true, // [type:boolean]
		'view_count' => 0, // [type:integer]
	];

	protected $casts = [
		'title' => 'string',
		'type_id' => 'string',
		'html_code' => 'string',
		'target_url' => 'string',
		'is_active' => 'boolean',
		'view_count' => 'integer',
	];

	protected $appends = [];

	protected $guarded = [];

	protected $hidden = [];

	public static function getAdwordTypeList()
	{
		return [
			(object) [
				'id' => 'BOTTOM_OF_HEADER',
				'text' => 'Ana Sayfa - Header Altında',
			],
			(object) [
				'id' => 'BOTTOM_OF_HEADER_SLIDER',
				'text' => 'Ana Sayfa - Header Altında Slider Şeklinde',
			],
			(object) [
				'id' => 'HOME_TOP_OF_CINEMAS',
				'text' => 'Ana Sayfa - Sinemalar Üstü Yatay Reklam',
			],
			(object) [
				'id' => 'HOME_BUTTOM_OF_CINEMAS',
				'text' => 'Ana Sayfa - Sinemalar Altı Yatay Reklam',
			],
			(object) [
				'id' => 'STICKER_LEFT',
				'text' => 'Sol Kule Reklam',
			],
			(object) [
				'id' => 'STICKER_RIGHT',
				'text' => 'Sağ Kule Reklam',
			],
			(object) [
				'id' => 'RIGHT_SIDE_BAR_1',
				'text' => 'Sağ taraf 1. reklam',
			],
			(object) [
				'id' => 'RIGHT_SIDE_BAR_2',
				'text' => 'Sağ taraf 2. reklam',
			],
			(object) [
				'id' => 'POST_INTEXT',
				'text' => 'Haber Metin İçi',
			],
			(object) [
				'id' => 'POST_UNDERCOVER',
				'text' => 'Haber Kapak Fotoğrafı Altında',
			],
		];
	}

	public function images()
	{
		return $this->belongsToMany(Inode::class, 'adword_images', 'adword_id', 'inode_id');
	}

	public function getImageAttribute()
	{
		return $this->images->first();
	}

	public static $cache = [];

	public static $cache_loaded = false;

	public static function getByTypeId($type_id)
	{
		if (false === self::$cache_loaded) {
			foreach (self::where('is_active', true)->get() as $adword) {
				if (!isset(self::$cache[$adword->type_id])) {
					self::$cache[$adword->type_id] = [];
				}
				self::$cache[$adword->type_id][] = $adword;
			}
			self::$cache_loaded = true;
		}

		// return random item in array
		if (isset(self::$cache[$type_id])) {
			return self::$cache[$type_id][array_rand(self::$cache[$type_id])];
		}

		return null;
	}
}
