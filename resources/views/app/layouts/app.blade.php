<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta name="robots" content="index, follow">
	<meta http-equiv="content-language" content="tr" />
	<meta http-equiv="pragma" content="no-cache" />
	<meta http-equiv="cache-control" content="no-store; no-cache; must-revalidate; max-stale=0; post-check=0; pre-check=0; max-age=0" />

    
    <link rel="canonical" href="{{ url()->current() }}"> 

    <title>@yield('title',\App\Models\Settings::get('SITE_NAME'))</title> 
    <meta name="description" content="@yield('description',\App\Models\Settings::get('SITE_DESCRIPTION'))">
    {{-- <meta name="keywords" content="@yield('keywords',\App\Models\Settings::get('SITE_KEYWORDS'))"> --}}

    <meta name="author" content="{{\App\Models\Settings::get('SITE_AUTHOR')}}">
    <meta name="publisher" content="{{\App\Models\Settings::get('SITE_NAME')}}">

	<meta name="google-site-verification" content="{{\App\Models\Settings::get('GOOGLE_SITE_VERIFICATION')}}" />
	<meta name="yandex-verification" content="{{\App\Models\Settings::get('YANDEX_SITE_VERIFICATION')}}" />

 
    @yield('header')
 
    @if (\App\Models\Settings::get('INLINE_CSS')) 
        <style>{!! file_get_contents(public_path('css/app.css')) !!}</style>
    @else 
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @endif
</head>

<body class="">
 
    <div >

        @include('app.layouts.header') 
        
         

        <div class="max-w-screen-xl mx-auto mb-4 sm:mt-4">

            @yield('prepend')
            
            @yield('content')

            @yield('append')
  
        </div>


        

        @include('app.layouts.footer') 

    </div>


</body>

@if (Auth::check()) 
    @if (\App\Models\Settings::get('INLINE_JS')) 
    <script>{!! file_get_contents(public_path('js/editor.js')) !!}</script>
    @else 
    <script src="{{ asset('js/editor.js') }}"></script>
    @endif
@endif

@if (\App\Models\Settings::get('INLINE_JS')) 
<script>{!! file_get_contents(public_path('js/app.js')) !!}</script>
@else 
<script src="{{ asset('js/app.js') }}"></script>
@endif


@if (\App\Models\Settings::get('GOOGLE_ANALYTICS_ENABLED') )
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-107293941-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){ dataLayer.push(arguments); }
  gtag('js', new Date());
  gtag('config', '{{\App\Models\Settings::get('GOOGLE_ANALYTICS_ID')}}');
</script>
@endif 
@if (\App\Models\Settings::get('YANDEX_METRICA_ENABLED') )
<script type="text/javascript" > (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter{{\App\Models\Settings::get('YANDEX_METRICA_ID')}} = new Ya.Metrika({ id:{{\App\Models\Settings::get('YANDEX_METRICA_ID')}}, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true, trackHash:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script>
@endif 




</html>
