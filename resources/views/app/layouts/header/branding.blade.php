
<div class="flex items-center justify-between border-b md:hidden">
    <div class="p-2">
        <a href="{{url('/')}}" title="{{\App\Models\Settings::get('SITE_NAME')}}">
            <img src="{{url('/storage/defaults/app_logo.svg')}}" alt="{{\App\Models\Settings::get('SITE_NAME')}}" title="{{\App\Models\Settings::get('SITE_NAME')}}" class="h-12">
        </a>
    </div>
    <div class="flex items-center p-2">
        <a href="{{route('profile')}}" title="{{__('app.my_profile')}}" class="mr-2 rounded-full text-rose-500 active:opacity-75">
            <svg class="w-8 h-8" viewBox="0 0 24 24">
                <path fill="currentColor" d="M12,19.2C9.5,19.2 7.29,17.92 6,16C6.03,14 10,12.9 12,12.9C14,12.9 17.97,14 18,16C16.71,17.92 14.5,19.2 12,19.2M12,5A3,3 0 0,1 15,8A3,3 0 0,1 12,11A3,3 0 0,1 9,8A3,3 0 0,1 12,5M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12C22,6.47 17.5,2 12,2Z" />
            </svg>
        </a>
        <button class="block rounded-full text-amber-400 active:opacity-75 mobile-menu-open">
            <svg class="w-10 h-10" viewBox="0 0 24 24">
                <path fill="currentColor" d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,10.5A1.5,1.5 0 0,0 10.5,12A1.5,1.5 0 0,0 12,13.5A1.5,1.5 0 0,0 13.5,12A1.5,1.5 0 0,0 12,10.5M6.5,10.5A1.5,1.5 0 0,0 5,12A1.5,1.5 0 0,0 6.5,13.5A1.5,1.5 0 0,0 8,12A1.5,1.5 0 0,0 6.5,10.5M17.5,10.5A1.5,1.5 0 0,0 16,12A1.5,1.5 0 0,0 17.5,13.5A1.5,1.5 0 0,0 19,12A1.5,1.5 0 0,0 17.5,10.5Z" />
            </svg>
        </button>
    </div>
</div>


@include('app.layouts.header.mobile-menu')




<div class="border-b border-slate-100">
    <div class="max-w-screen-xl mx-auto md:my-2">
        <div class="flex w-full md:justify-between">
            <div class="hidden md:block">
                <a href="{{url('/')}}">
                    <img src="{{url('/storage/defaults/app_logo.svg')}}" alt="{{\App\Models\Settings::get('SITE_NAME')}}" title="{{\App\Models\Settings::get('SITE_NAME')}}" class="h-12">
                </a>
            </div>

            <div class="flex flex-1 px-2 py-2 md:py-0 md:flex-none md:px-0 bg-slate-100 md:bg-white">

                @include('app.includes.currencies')
                
                @include('app.includes.weather') 

            </div>

        </div> 
    </div>
</div>