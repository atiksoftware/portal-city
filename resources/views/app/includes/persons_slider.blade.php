
<div class="mx-4 md:mx-0">
    <div class="flex items-center justify-between rounded bg-amber-400">
        <div class="px-3 text-sm font-semibold">
            <h2>{{__('app.persons.widget_title')}}</h2>
        </div>
        <div class="text-sm font-semibold">
            <a href="{{route('persons')}}" title="{{__('app.view_all')}}" class="block px-2 py-1 m-1 bg-white rounded">{{__('app.view_all')}}</a>
        </div>
    </div>
    <div class="relative mt-2 overflow-hidden rounded swiper widget_persons h-52"> 
        <div class="swiper-wrapper"> 
            @foreach (\App\Models\Person::inRandomOrder()->limit(10)->where('is_active',true)->with(['profile_images'])->get() as $person)
            <div class="swiper-slide">
                <a href="{{$person->public_link}}" title="{{$person->name}}" class="relative block ">
                    <div class="relative w-full overflow-hidden transition-all rounded shadow h-52">
                        @if ($person->profile_image)
                        <img src="{{$person->profile_image->image}}" alt="{{$person->name}}" title="{{$person->name}}" loading="lazy" class="object-cover w-full h-full max-w-xs ">
                        @endif
                        <div class="absolute py-2 text-xs font-semibold text-center bg-white rounded bottom-1 left-1 right-1 bg-opacity-80 hover:bg-opacity-100">
                            <h3>{{$person->name}}</h3>
                        </div>
                    </div>
                </a>
            </div> 
            @endforeach 
        </div> 
        @include("vendor.swiper.arrows")
    </div>
</div>