<div class="flex w-full py-1 bg-amber-300">
    <div class="flex-1 h-10 bg-white "></div>
    <div class="flex items-center max-w-screen-xl w-320">
        <div class="flex items-center h-10 bg-white rounded-r-lg text-rose-500">
            <div class="flex items-center px-2 animate-pulse md:px-0">
                <div>
                    <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M21 6.5C21 8.43 19.43 10 17.5 10S14 8.43 14 6.5 15.57 3 17.5 3 21 4.57 21 6.5M19 11.79C18.5 11.92 18 12 17.5 12C14.47 12 12 9.53 12 6.5C12 5.03 12.58 3.7 13.5 2.71C13.15 2.28 12.61 2 12 2C10.9 2 10 2.9 10 4V4.29C7.03 5.17 5 7.9 5 11V17L3 19V20H21V19L19 17V11.79M12 23C13.11 23 14 22.11 14 21H10C10 22.11 10.9 23 12 23Z" />
                    </svg>
                </div>
                <div class="hidden px-2 font-bold md:block">
                    SON DAKİKA
                </div> 
            </div>
        </div>
        <div class="ml-2 text-xs leading-4 md:ml-4 md:text-sm">
            <div class="h-10 overflow-hidden swiper breakings">
                <div class="swiper-wrapper" id="breaking">
                    @foreach (\App\Models\Post::latest()->take(5)->get() as $item)
                    <div class="flex items-center h-10 font-semibold swiper-slide">
                        <a href="{{$item->public_link}}" title="{{$item->title}}">{{$item->title}}</a>
                    </div>
                    @endforeach
                </div>
            </div>
            
        </div>
    </div>
    <div class="flex-1"></div>
</div>