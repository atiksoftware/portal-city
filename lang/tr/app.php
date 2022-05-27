<?php

use App\Models\Settings;
use Illuminate\Support\Str;
use Atiksoftware\Gramer\Iyelik;

return [
	'home_page' => 'ANA SAYFA',
	'persons' => 'KİM KİMDİR?',
	'persons.title' => \Atiksoftware\Gramer\Iyelik::Ek(Settings::get('CITY_NAME'), 'de') . ' Kim Kimdir? | ' . Settings::get('SITE_NAME'),
	'person.title' => ':name kimdir, hakkında bilgi | ' . Settings::get('SITE_NAME'),

	'businesses' => 'FİRMALAR',
	'businesses.title' => Settings::get('CITY_NAME') . ' Firmaları, ' . Settings::get('CITY_NAME') . ' Şirketleri,' . Settings::get('CITY_NAME') . ' İşletmeleri | ' . Settings::get('SITE_NAME'),
	'business_title' => ':name - :phone / :category | ' . Settings::get('SITE_NAME'),
	'businesses.widget_title' => Str::upper(Iyelik::Ek(Settings::get('CITY_NAME'), 'de')) . ' HANGİ FİRMALAR VAR?',
	'business_phone_title' => ':name firmasının telefon numarası',
	'business_email_title' => ':name firmasının e-posta adresi',
	'business_website_title' => ':name firmasının web sitesi',

	'posts.widget_title' => 'HABERLER',
	'posts.title' => Settings::get('CITY_NAME') . ' Haberleri | ' . Settings::get('SITE_NAME'),
	'posts.title.searched' => ':search için arama sonuçları | ' . Settings::get('SITE_NAME'),
	'posts.title.by_category' => Settings::get('CITY_NAME') . ' :category Haberleri | ' . Settings::get('SITE_NAME'),
	'posts.title.by_district' => Settings::get('CITY_NAME') . ' :district Haberleri | ' . Settings::get('SITE_NAME'),
	'posts.title.by_user' => ':fullname Haberleri | ' . Settings::get('SITE_NAME'),
	'post_title' => ':title | ' . Settings::get('SITE_NAME'),

	'persons.widget_title' => Str::upper(Iyelik::Ek(Settings::get('CITY_NAME'), 'de')) . ' KİMLER VAR?',

	'view_all' => 'Tümünü Gör',

	'cinemas_widget_title' => 'SİNEMALARDA HANGİ FİLMLER VAR?',

	'user_login' => 'Kullanıcı Girişi',
	'my_profile' => 'Profilim',
	'sign_out' => 'Çıkış Yap',
	'my_personal_page' => 'Kişisel Sayfam',
	'my_business_page' => 'İşletme Sayfam',

	'contact_informations' => 'İletişim Bilgileri',
	'contact_phone_title' => Settings::get('SITE_NAME') . ' iletişim numarası',
	'contact_email_title' => Settings::get('SITE_NAME') . ' iletişim e-postası',
	'phone' => 'Telefon',
	'email' => 'E-posta',
	'address' => 'Adres',
	'website' => 'Web Sitesi',
	'working_hours' => 'Çalışma Saatleri',
	'tags' => 'Etiketler',

	'sitemap' => 'Site Haritası',
	'categories' => 'Kategoriler',
	'footnote' => 'Reklam ve önerileriniz için :email adresine mail atabilirsiniz',
	'copyright' => '© ' . date('Y') . ' ' . Settings::get('SITE_NAME') . '. Tüm hakları saklıdır.',

	'previous_page' => 'Önceki Sayfa',
	'next_page' => 'Sonraki Sayfa',
	'page_number' => ':page. Sayfa',
	'paginator_showing_text' => ':total kayıttan :from ile :to arası gösteriliyor',

	'hello' => 'Merhaba',
	'business_ownership_note' => 'Bu kayıtlı firmanın sahibi sizseniz ve firma bilgilerinizi güncellemek istiyorsanız, lütfen <a href="mailto://:email">:email</a> adresine mail atınız.',

	'firstname' => 'Ad',
	'lastname' => 'Soyad',
	'password' => 'Şifre',
	'password_confirmation' => 'Şifre (Tekrar)',
	'create_account' => 'Hesap Oluştur',
	'create_new_account' => 'Yeni Bir Hesap Oluştur',
	'register' => 'Kayıt Ol',
	'login' => 'Giriş Yap',
	'has_account' => 'Zaten bir hesabın var mı?',
	'hasnt_account' => 'Hesabın yok mu?',
	'oops' => 'Oops! Bir şeyler yanlış gitti.',
	'fill_informations' => 'Devam etmek için bilgileri doldurun.',
	'forgot_password' => 'Şifremi Unuttum',
	'continue' => 'Devam Et',
	'reset_password' => 'Şifreyi Sıfırla',
];
