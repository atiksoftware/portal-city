<div class="fixed top-0 left-0 z-50 hidden w-full h-screen bg-white bg-opacity-95 mobile-menu">
    <div class="flex items-center justify-between">
        <div class="p-2">
            <img src="{{url('/storage/defaults/app_logo.svg')}}" alt="{{\App\Models\Settings::get('SITE_NAME')}}" class="h-12">
        </div>
        <div class="flex p-2">
            <button class="block text-slate-900 mobile-menu-close"> 
                <svg class="w-10 h-10" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,16.41 16.41,20 12,20M12,2C6.47,2 2,6.47 2,12C2,17.53 6.47,22 12,22C17.53,22 22,17.53 22,12C22,6.47 17.53,2 12,2M14.59,8L12,10.59L9.41,8L8,9.41L10.59,12L8,14.59L9.41,16L12,13.41L14.59,16L16,14.59L13.41,12L16,9.41L14.59,8Z" />
                </svg>
            </button>
        </div>
    </div>
    <div class="grid grid-cols-1 mt-8 font-bold uppercase">
        <div>
            <a class="block py-2 text-center rounded " href="{{route('home')}}" title="{{\App\Models\Settings::get('SITE_NAME')}}" hreflang="{{app()->getLocale()}}">{{__('app.home_page')}}</a>
        </div>
        <div >
            <a class="block py-2 text-center rounded " href="{{route('businesses')}}" title="{{__('app.businesses')}}" hreflang="{{app()->getLocale()}}">{{__('app.businesses')}}</a>
        </div>
        <div >
            <a class="block py-2 text-center rounded " href="{{route('persons')}}" title="{{__('app.persons')}}" hreflang="{{app()->getLocale()}}">{{__('app.persons')}}</a>
        </div>
        @foreach (\App\Models\Category::where('type_id',1)->get() as $category)
        <div >
            <a 
                href="{{ route('posts.by_category',$category) }}"
                title="{{$category->name}}"
                hreflang="{{app()->getLocale()}}"
                class="block py-2 text-center rounded "
            >{{$category->name}}</a>
        </div>
        @endforeach
    </div>
</div>