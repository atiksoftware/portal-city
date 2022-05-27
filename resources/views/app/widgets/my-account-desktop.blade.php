@if (Auth::check())
<div class="relative ml-3">
    <div class="flex items-center p-2 rounded cursor-pointer hover:text-black hover:bg-slate-100 my-account-dropdown">
        <div class="mr-2 text-xs max-w-[160px] overflow-hidden overflow-ellipsis whitespace-nowrap">{{Auth::user()->fullname}}</div> 
        <div class="flex text-sm bg-gray-800 rounded-full "> 
            <img class="w-8 h-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
        </div>
    </div> 
    <div class="absolute right-0 z-10 hidden w-48 py-1 mt-2 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
        <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-rose-500 hover:text-white">{{__('app.my_profile')}}</a>
        <a href="{{ route('my-person') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-rose-500 hover:text-white">{{__('app.my_personal_page')}}</a>
        <a href="{{ route('my-business') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-rose-500 hover:text-white" >{{__('app.my_business_page')}}</a>
        <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-rose-500 hover:text-white">{{__('app.sign_out')}}</a>
    </div>
</div>
@else
<a href="{{ route('login') }}" title="{{__('app.user_login')}}" class="px-4 py-2 text-sm font-semibold text-white rounded bg-rose-500 hover:bg-rose-600">{{__('app.user_login')}}</a>
@endif