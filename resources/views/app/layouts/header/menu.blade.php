<nav>
    <div class="hidden max-w-screen-xl mx-auto md:block">
        <div class="flex items-center justify-between">
            <div class="flex space-x-2 text-sm font-bold uppercase">
                <div>
                    <a class="block px-2 py-2 my-3 rounded hover:bg-amber-300" href="{{route('home')}}" title="{{\App\Models\Settings::get('SITE_NAME')}}" hreflang="{{app()->getLocale()}}">{{__('app.home_page')}}</a>
                </div>
                <div >
                    <a class="block px-2 py-2 my-3 rounded hover:bg-amber-300" href="{{route('businesses')}}" title="{{__('app.businesses')}}" hreflang="{{app()->getLocale()}}">{{__('app.businesses')}}</a>
                </div>
                <div >
                    <a class="block px-2 py-2 my-3 rounded hover:bg-amber-300" href="{{route('persons')}}" title="{{__('app.persons')}}" hreflang="{{app()->getLocale()}}">{{__('app.persons')}}</a>
                </div>
                @foreach (\App\Models\Category::where('type_id',1)->get() as $category)
                <div >
                    <a 
                        href="{{ route('posts.by_category',$category) }}"
                        title="{{$category->name}}"
                        hreflang="{{app()->getLocale()}}"
                        class="block px-2 py-2 my-3 rounded hover:bg-amber-300"
                    >{{$category->name}}</a>
                </div>
                @endforeach
            </div>
            <div>
                <x-my-account platform="desktop" /> 
            </div>
        </div>
    </div>
    {{-- @if (Auth::check())
    <div class="relative ml-3">
        <div class="flex items-center p-2 rounded cursor-pointer hover:bg-slate-100 user-menu-open">
            <div class="mr-2 text-xs max-w-[160px] overflow-hidden overflow-ellipsis whitespace-nowrap">{{Auth::user()->fullname}}</div> 
            <div class="flex text-sm bg-gray-800 rounded-full "> 
                <img class="w-8 h-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
            </div>
        </div> 
        <div class="absolute right-0 z-10 hidden w-48 py-1 mt-2 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
            <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-rose-500 hover:text-white">Profilim</a>
            <a href="{{ route('my-person') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-rose-500 hover:text-white">Kişisel Sayfam</a>
            <a href="{{ route('my-business') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-rose-500 hover:text-white" >İşletme Sayfam</a>
            <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-rose-500 hover:text-white">Sign out</a>
        </div>
    </div>
    @else
    <a href="{{ route('login') }}" title="{{__('app.user_login')}}" class="px-4 py-2 text-sm font-semibold text-white rounded bg-rose-500 hover:bg-rose-600">{{__('app.user_login')}}</a>
    @endif --}}
</nav>