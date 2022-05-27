@extends('admin.layouts.dashboard')

@section('title', 'Ayarlar') 

@section('content')
 

<div class="p-4">
    <form action="" method="post">
        @csrf
        <div class="grid grid-cols-1 gap-4"> 

            @foreach (App\Models\Settings::$groups as $group_id => $group)
                <div>
                    <h2 class="text-lg font-bold text-rose-500">{{$group['title']}}</h2>
                    <p class="text-sm text-slate-400">{{$group['description']}}</p>
                    
                    <div class="grid grid-cols-1 gap-4 mt-4 ml-4 lg:ml-8"> 
                    @foreach (App\Models\Settings::getAll() as $setting) 
                        @if ($setting['group_id'] == $group_id)
                            @if ($setting['type'] == 'string')
                                <x-input-text :label="$setting['title']" :name="$setting['name']" :value="App\Models\Settings::get($setting['name'])" />
                            @endif
                            @if ($setting['type'] == 'boolean')
                                <x-input-checkbox :label="$setting['title']" :name="$setting['name']" :value="App\Models\Settings::get($setting['name'])" />
                            @endif 
                        @endif
                    @endforeach
                    </div>
                </div>
            @endforeach

            {{-- <x-input-text label="Site Name" name="site_name" :value="$settings['site_name'] ?? ''" />
            <x-input-text label="Site Description" name="site_description" :value="$settings['site_description'] ?? ''" />
            <x-input-text label="Site Keywords" name="site_keywords" :value="$settings['site_keywords'] ?? ''" />
            <x-input-text label="Site Author" name="site_author" :value="$settings['site_author'] ?? ''" />
            
            <x-input-text label="Google Site Verification" name="google_site_verification" :value="$settings['google_site_verification'] ?? ''" />
            <x-input-text label="Google AD Client ID" name="google_ad_client" :value="$settings['google_ad_client'] ?? ''" />
            <x-input-text label="Google GTAG Code" name="google_gtag" :value="$settings['google_gtag'] ?? ''" />

            <x-input-text label="Yandex Verification" name="yandex_verification" :value="$settings['yandex_verification'] ?? ''" />
            <x-input-text label="Yandex Metrica ID" name="yandex_metrica_id" :value="$settings['yandex_metrica_id'] ?? ''" />
            
            <x-input-text label="City Name" name="city_name" :value="$settings['city_name'] ?? ''" />
            <x-input-text label="Contact Phone" name="contact_phone" :value="$settings['contact_phone'] ?? ''" />
            <x-input-text label="Contact E-Mail" name="contact_email" :value="$settings['contact_email'] ?? ''" />
            <x-input-text label="Cinema Module" name="cinema_module" :value="$settings['cinema_module'] ?? ''" />
            
            <x-input-text label="Facebook Link" name="facebook_link" :value="$settings['facebook_link'] ?? ''" />
            <x-input-text label="Twitter Link" name="twitter_link" :value="$settings['twitter_link'] ?? ''" />
            <x-input-text label="Instagram Link" name="instagram_link" :value="$settings['instagram_link'] ?? ''" />
            <x-input-text label="Twitter Username" name="twitter_username" :value="$settings['twitter_username'] ?? ''" />

            <x-input-text label="Manşet Haber Sayısı" name="posts_headlines_count" :value="$settings['posts_headlines_count'] ?? ''" />
            <x-input-text label="1.Grup Haber Sayısı" name="posts_group_1_count" :value="$settings['posts_group_1_count'] ?? ''" />
            <x-input-text label="2.Grup Haber Sayısı" name="posts_group_2_count" :value="$settings['posts_group_2_count'] ?? ''" /> 
            <x-input-text label="Google Maps Api Key" name="google_maps_api_key" :value="$settings['google_maps_api_key'] ?? ''" /> 

            <div class="mt-4">
                <x-input-checkbox label="Inline CSS" name="inline_css" :value="$settings['inline_css'] ?? false" />
                <x-input-checkbox label="Inline JS" name="inline_js" :value="$settings['inline_js'] ?? false" />
            </div> --}}
    
        </div>
        <x-button  label="Bilgileri Kaydet" icon="floppy-disk" centered offset  />
  
    </form> 
</div>





@endsection
