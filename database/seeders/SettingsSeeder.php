<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
	public function run(): void
	{
		// Settings::write('site_name', 'Boludabolu', 'string');
		// Settings::write('site_description', 'Bolu\'nun güncel haber ve gazete sitesi boludabolu.com da firmalarınızı bulabilir, kimkimdir ile kişileri tanıyabilir veya tanıtabilirsiniz', 'string');
		// Settings::write('site_keywords', 'bolu,gazete,haber,kimkimdir,firma,tv,rehber,sektör,habercilik,adres,telefon,iletişim,harita,hakkında,gerede,dörtdivan,yeniçağa,seben,mengen,göynük,mudurnu,kıbrıscık', 'string');
		// Settings::write('site_author', 'Rasim ÖZDEMİR', 'string');

		// Settings::write('google_site_verification', 'GRxdg8_Mp4xg7RWVgNRmM51PSSfq9OpptW3u2r3XAHE', 'string');
		// Settings::write('google_ad_client', 'ca-pub-8080290127916029', 'string');
		// Settings::write('google_gtag', 'UA-107293941-1', 'string');

		// Settings::write('yandex_verification', '65ca730ea3ba7de5', 'string');
		// Settings::write('yandex_metrica_id', '46874961', 'string');

		// Settings::write('city_name', 'Bolu', 'string');

		// Settings::write('contact_phone', '+905530697879', 'string');

		// Settings::write('contact_email', 'info@boludabolu.com', 'string');

		// Settings::write('cinema_module', 'cinemapink:177', 'string');

		// Settings::write('facebook_link', 'https://www.facebook.com/boludabolu', 'string');
		// Settings::write('twitter_link', 'https://twitter.com/boludabolu', 'string');
		// Settings::write('instagram_link', 'https://www.instagram.com/boluda_bolu/', 'string');

		// Settings::write('twitter_username', 'boludabolu', 'string');

		// Settings::write('posts_headlines_count', '12', 'integer');
		// Settings::write('posts_group_1_count', '18', 'integer');
		// Settings::write('posts_group_2_count', '18', 'integer');

		// Settings::write('inline_css', false, 'boolean');
		// Settings::write('inline_js', false, 'boolean');

		// Settings::write('google_maps_api_key', '', 'string');
		// Settings::write('google_recaptcha_key', '', 'string');
		// Settings::write('google_recaptcha_secret', '', 'string');

		Settings::set('SITE_NAME', 'Boludabolu');
		Settings::set('SITE_TITLE', 'Boludabolu Bolu haber, gazete, firma ve kişi rehberi');
		Settings::set('SITE_DESCRIPTION', 'Bolu\'nun güncel haber ve gazete sitesi boludabolu.com da firmalarınızı bulabilir, kimkimdir ile kişileri tanıyabilir veya tanıtabilirsiniz');
		Settings::set('SITE_KEYWORDS', 'bolu,gazete,haber,kimkimdir,firma,tv,rehber,sektör,habercilik,adres,telefon,iletişim,harita,hakkında,gerede,dörtdivan,yeniçağa,seben,mengen,göynük,mudurnu,kıbrıscık');
		Settings::set('SITE_AUTHOR', 'Rasim ÖZDEMİR');

		Settings::set('CITY_NAME', 'Bolu');
		Settings::set('CONTACT_PHONE', '+905530697879');
		Settings::set('CONTACT_EMAIL', 'info@boludabolu.com');

		Settings::set('CINAMA_MODULE', 'cinemapink:177');

		Settings::set('FACEBOOK_LINK', 'https://www.facebook.com/boludabolu');
		Settings::set('TWITTER_LINK', 'https://twitter.com/boludabolu');
		Settings::set('INSTAGRAM_LINK', 'https://www.instagram.com/boluda_bolu/');

		Settings::set('TWITTER_USERNAME', 'boludabolu');

		Settings::set('POSTS_HEADLINES_COUNT', 12);
		Settings::set('POSTS_GROUP_1_COUNT', 18);
		Settings::set('POSTS_GROUP_2_COUNT', 18);

		Settings::set('GOOGLE_SITE_VERIFICATION', 'GRxdg8_Mp4xg7RWVgNRmM51PSSfq9OpptW3u2r3XAHE');
		Settings::set('GOOGLE_ANALYTICS_ID', 'UA-107293941-1');
		Settings::set('GOOGLE_ANALYTICS_ENABLED', true);

		Settings::set('YANDEX_SITE_VERIFICATION', '65ca730ea3ba7de5');
		Settings::set('YANDEX_METRICA_ID', '46874961');
		Settings::set('YANDEX_METRICA_ENABLED', true);

		Settings::set('GOOGLE_MAPS_API_KEY', '');
		Settings::set('GOOGLE_RECAPTCHA_KEY', '6Ld9m7MfAAAAAJLGMrxtdzGyJ7CQOeG2iDoehZFM');
		Settings::set('GOOGLE_RECAPTCHA_SECRET', '6Ld9m7MfAAAAAKEeaMYPPjV3HRBDkaXTTuNIGgEU');
		Settings::set('GOOGLE_RECAPTCHA_ENABLED', true);

		Settings::set('INLINE_CSS', false);
		Settings::set('INLINE_JS', false);
	}
}
