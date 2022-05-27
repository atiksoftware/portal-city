
<div class="flex items-center justify-between bg-teal-500 rounded">
    <div class="px-3 text-sm font-semibold leading-8 text-white">
        <h2>{{__('app.cinemas_widget_title')}}</h2>
    </div> 
</div>
<div class="swiper widget_cinemas rounded shadow-lg relative h-[272px] overflow-hidden mt-2"> 
    <div class="swiper-wrapper"> 
        @foreach (App\Models\Cinema::getAll() as $cinema)
        <div class="swiper-slide">
            <a href="{{$cinema->image_url}}" title="{{$cinema->film_name}}" data-pswp-width="600" data-pswp-height="800" class="relative w-full h-full">
                <img src="{{$cinema->image_url}}" alt="{{$cinema->film_name}}" class="w-full h-[272px] object-cover rounded">
                <div class="absolute py-2 text-xs font-semibold text-center bg-white rounded bottom-1 left-1 right-1 bg-opacity-80 hover:bg-opacity-100">
                    {{$cinema->film_name}}
                </div>
            </a>
        </div> 
        @endforeach 
    </div> 
    @include("vendor.swiper.arrows")
</div>