<?php

namespace App\Models;

class Settings
{
	public static $groups = [
		'site_settings' => [
			'title' => 'Site Ayarları',
			'description' => 'Site ayarlarını buradan yapabilirsiniz.',
		],
		'metatag_settings' => [
			'title' => 'Meta Tag Ayarları',
			'description' => 'Meta tag ayarlarını buradan yapabilirsiniz. {name} etiketi kullanabilirsiniz',
		],
		'contact_settings' => [
			'title' => 'İletişim Ayarları',
			'description' => 'İletişim ayarlarını buradan yapabilirsiniz.',
		],
		'homepage_settings' => [
			'title' => 'Anasayfa Ayarları',
			'description' => 'Anasayfa ayarlarını buradan yapabilirsiniz.',
		],
		'search_engine_settings' => [
			'title' => 'Arama Motoru Ayarları',
			'description' => 'Arama motoru ayarlarını buradan yapabilirsiniz.',
		],
		'asset_settings' => [
			'title' => 'Dosya Ayarları',
			'description' => 'Dosya ayarlarını buradan yapabilirsiniz.',
		],
	];

	public static $props = [
		'SITE_NAME' => [
			'value' => '',
			'type' => 'string',
			'group_id' => 'site_settings',
		],
		'SITE_TITLE' => [
			'value' => '',
			'type' => 'string',
			'group_id' => 'site_settings',
		],
		'SITE_DESCRIPTION' => [
			'value' => '',
			'type' => 'string',
			'group_id' => 'site_settings',
		],
		'SITE_KEYWORDS' => [
			'value' => '',
			'type' => 'string',
			'group_id' => 'site_settings',
		],
		'SITE_AUTHOR' => [
			'value' => '',
			'type' => 'string',
			'group_id' => 'site_settings',
		],
		'CITY_NAME' => [
			'value' => '',
			'type' => 'string',
			'group_id' => 'site_settings',
		],
		'CONTACT_PHONE' => [
			'value' => '',
			'type' => 'string',
			'group_id' => 'contact_settings',
		],
		'CONTACT_EMAIL' => [
			'value' => '',
			'type' => 'string',
			'group_id' => 'contact_settings',
		],
		'FACEBOOK_LINK' => [
			'value' => '',
			'type' => 'string',
			'group_id' => 'contact_settings',
		],
		'TWITTER_LINK' => [
			'value' => '',
			'type' => 'string',
			'group_id' => 'contact_settings',
		],
		'INSTAGRAM_LINK' => [
			'value' => '',
			'type' => 'string',
			'group_id' => 'contact_settings',
		],
		'TWITTER_USERNAME' => [
			'value' => '',
			'type' => 'string',
			'group_id' => 'contact_settings',
		],

		'POST_HEADLINES_COUNT' => [
			'value' => 12,
			'type' => 'integer',
			'title' => 'Manşet Haberleri Sayısı',
			'group_id' => 'homepage_settings',
		],
		'POST_GROUP_1_COUNT' => [
			'value' => 18,
			'type' => 'integer',
			'title' => '1. Grup Haber Sayısı',
			'group_id' => 'homepage_settings',
		],
		'POST_GROUP_2_COUNT' => [
			'value' => 18,
			'type' => 'integer',
			'title' => '2. Grup Haber Sayısı',
			'group_id' => 'homepage_settings',
		],
		'CINAMA_MODULE' => [
			'value' => '',
			'type' => 'string',
			'group_id' => 'homepage_settings',
		],

		'GOOGLE_SITE_VERIFICATION' => [
			'value' => '',
			'type' => 'string',
			'group_id' => 'search_engine_settings',
		],
		'GOOGLE_ANALYTICS_ID' => [
			'value' => '',
			'type' => 'string',
			'group_id' => 'search_engine_settings',
		],
		'GOOGLE_ANALYTICS_ENABLED' => [
			'value' => false,
			'type' => 'boolean',
			'group_id' => 'search_engine_settings',
		],
		'YANDEX_SITE_VERIFICATION' => [
			'value' => '',
			'type' => 'string',
			'group_id' => 'search_engine_settings',
		],
		'YANDEX_METRICA_ID' => [
			'value' => '',
			'type' => 'string',
			'group_id' => 'search_engine_settings',
		],
		'YANDEX_METRICA_ENABLED' => [
			'value' => false,
			'type' => 'boolean',
			'group_id' => 'search_engine_settings',
		],
		'GOOGLE_MAPS_API_KEY' => [
			'value' => '',
			'type' => 'string',
			'group_id' => 'search_engine_settings',
		],
		'GOOGLE_MAPS_API_ENABLED' => [
			'value' => false,
			'type' => 'boolean',
			'group_id' => 'search_engine_settings',
		],
		'GOOGLE_RECAPTCHA_KEY' => [
			'value' => '',
			'type' => 'string',
			'group_id' => 'search_engine_settings',
		],
		'GOOGLE_RECAPTCHA_SECRET' => [
			'value' => '',
			'type' => 'string',
			'group_id' => 'search_engine_settings',
		],
		'GOOGLE_RECAPTCHA_ENABLED' => [
			'value' => false,
			'type' => 'boolean',
			'group_id' => 'search_engine_settings',
		],

		'INLINE_CSS' => [
			'value' => false,
			'type' => 'boolean',
			'title' => 'CSS kodlarını kaynak içine yerleştir',
			'group_id' => 'asset_settings',
		],
		'INLINE_JS' => [
			'value' => false,
			'type' => 'boolean',
			'title' => 'JS kodlarını kaynak içine yerleştir',
			'group_id' => 'asset_settings',
		],

		// METATAGS
		'POSTS_TITLE' => [
			'value' => '',
			'type' => 'string',
			'title' => 'Haberler sayfası başlığı',
			'group_id' => 'metatag_settings',
		],
		'POSTS_DESCRIPTION' => [
			'value' => '',
			'type' => 'string',
			'title' => 'Haberler sayfası açıklaması',
			'group_id' => 'metatag_settings',
		],
		'POSTS_SEARCH_TITLE' => [
			'value' => '',
			'type' => 'string',
			'title' => 'Haberler sayfası arama sonuçları başlığı. {0} arama terimi',
			'group_id' => 'metatag_settings',
		],
		'POSTS_SEARCH_DESCRIPTION' => [
			'value' => '',
			'type' => 'string',
			'title' => 'Haberler sayfası arama sonuçları açıklaması. {0} arama terimi',
			'group_id' => 'metatag_settings',
		],
		'POSTS_CATEGORY_TITLE' => [
			'value' => '',
			'type' => 'string',
			'title' => 'Haberler sayfası kategori başlığı. {0} kategori adı',
			'group_id' => 'metatag_settings',
		],
		'POSTS_CATEGORY_DESCRIPTION' => [
			'value' => '',
			'type' => 'string',
			'title' => 'Haberler sayfası kategori açıklaması. {0} kategori adı',
			'group_id' => 'metatag_settings',
		],
		'POSTS_CATEGORY_SEARCH_TITLE' => [
			'value' => '',
			'type' => 'string',
			'title' => 'Haberler sayfası kategori arama sonuçları başlığı. {0} arama sonuçları',
			'group_id' => 'metatag_settings',
		],
		'POSTS_CATEGORY_SEARCH_DESCRIPTION' => [
			'value' => '',
			'type' => 'string',
			'title' => 'Haberler sayfası kategori arama sonuçları açıklaması. {0} arama sonuçları',
			'group_id' => 'metatag_settings',
		],
		'POSTS_TAG_TITLE' => [
			'value' => '',
			'type' => 'string',
			'title' => 'Haberler sayfası etiket başlığı. {0} etiket adı',
			'group_id' => 'metatag_settings',
		],
		'POSTS_TAG_DESCRIPTION' => [
			'value' => '',
			'type' => 'string',
			'title' => 'Haberler sayfası etiket açıklaması. {0} etiket adı',
			'group_id' => 'metatag_settings',
		],
		'POSTS_DISTRICT_TITLE' => [
			'value' => '',
			'type' => 'string',
			'title' => 'Haberler sayfası ilçe haberleri başlığı. {0} ilçe adı',
			'group_id' => 'metatag_settings',
		],
		'POSTS_DISTRICT_DESCRIPTION' => [
			'value' => '',
			'type' => 'string',
			'title' => 'Haberler sayfası ilçe haberleri açıklaması. {0} ilçe adı',
			'group_id' => 'metatag_settings',
		],
		'POSTS_USER_TITLE' => [
			'value' => '',
			'type' => 'string',
			'title' => 'Haberler sayfası yazar sonuçları başlığı. {0} yazar adı',
			'group_id' => 'metatag_settings',
		],
		'POSTS_USER_DESCRIPTION' => [
			'value' => '',
			'type' => 'string',
			'title' => 'Haberler sayfası yazar sonuçları açıklaması. {0} yazar adı',
			'group_id' => 'metatag_settings',
		],

		'PERSONS_TITLE' => [
			'value' => '',
			'type' => 'string',
			'title' => 'Kişiler sayfası başlığı',
			'group_id' => 'metatag_settings',
		],
		'PERSONS_DESCRIPTION' => [
			'value' => '',
			'type' => 'string',
			'title' => 'Kişiler sayfası açıklaması',
			'group_id' => 'metatag_settings',
		],
		'PERSONS_SEARCH_TITLE' => [
			'value' => '',
			'type' => 'string',
			'title' => 'Kişiler sayfası arama sonuçları başlığı. {0} arama terimi',
			'group_id' => 'metatag_settings',
		],
		'PERSONS_SEARCH_DESCRIPTION' => [
			'value' => '',
			'type' => 'string',
			'title' => 'Kişiler sayfası arama sonuçları açıklaması. {0} arama terimi',
			'group_id' => 'metatag_settings',
		],

		'BUSINESSES_TITLE' => [
			'value' => '',
			'type' => 'string',
			'title' => 'Firmalar sayfası başlığı',
			'group_id' => 'metatag_settings',
		],
		'BUSINESSES_DESCRIPTION' => [
			'value' => '',
			'type' => 'string',
			'title' => 'Firmalar sayfası açıklaması',
			'group_id' => 'metatag_settings',
		],
		'BUSINESSES_SEARCH_TITLE' => [
			'value' => '',
			'type' => 'string',
			'title' => 'Firmalar sayfası arama sonuçları başlığı. {0} arama terimi',
			'group_id' => 'metatag_settings',
		],
		'BUSINESSES_SEARCH_DESCRIPTION' => [
			'value' => '',
			'type' => 'string',
			'title' => 'Firmalar sayfası arama sonuçları açıklaması. {0} arama terimi',
			'group_id' => 'metatag_settings',
		],
		'BUSINESSES_TAG_TITLE' => [
			'value' => '',
			'type' => 'string',
			'title' => 'Firmalar sayfası etiket başlığı. {0} etiket adı',
			'group_id' => 'metatag_settings',
		],
		'BUSINESSES_TAG_DESCRIPTION' => [
			'value' => '',
			'type' => 'string',
			'title' => 'Firmalar sayfası etiket açıklaması. {0} etiket adı',
			'group_id' => 'metatag_settings',
		],
	];

	public static $cache = [];

	public static function getAll()
	{
		if (empty(self::$cache)) {
			self::$cache = self::$props;

			$options = Option::all();
			foreach ($options as $option) {
				$name = $option->name;
				$value = $option->value;
				if (!\array_key_exists($name, self::$props)) {
					$option->delete();
					continue;
				}
				self::$cache[$name]['value'] = $value;
			}
			foreach (self::$cache as $key => $value) {
				self::$cache[$key]['name'] = $key;
				if (!isset(self::$cache[$key]['title'])) {
					self::$cache[$key]['title'] = ucfirst(str_replace('_', ' ', $key));
				}
			}
		}

		return self::$cache;
	}

	public static function get($key)
	{
		$settings = self::getAll();
		if (\array_key_exists($key, $settings)) {
			$value = $settings[$key]['value'];
			$type = $settings[$key]['type'];
			switch ($type) {
				case 'string':
					return $value;
					break;
				case 'integer':
					return (int) $value;
					break;
				case 'boolean':
					return 1 === (int) $value;
					break;
				case 'array':
					return json_decode($value, true);
					break;
				default:
					return $value;
					break;
			}
		}

		return null;
	}

	public static function set($key, $value): void
	{
		$settings = self::getAll();
		if (\array_key_exists($key, $settings)) {
			$type = $settings[$key]['type'];
			switch ($type) {
				case 'string':
					$value = $value;
					break;
				case 'integer':
					$value = $value;
					break;
				case 'boolean':
					$value = $value ? '1' : '0';
					break;
				case 'array':
					$value = json_encode($value);
					break;
			}
			if (null === $value) {
				$value = '';
			}
			$settings[$key]['value'] = $value;
			self::$cache = $settings;
			$option = Option::where('name', $key)->first();
			if (null === $option) {
				$option = new Option();
				$option->name = $key;
			}
			$option->value = $value;
			$option->save();
		}
	}
}
