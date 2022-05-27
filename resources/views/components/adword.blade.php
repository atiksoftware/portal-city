@props([
    'adword' => null,
])

 
@if ($adword != null && $adword->is_active) 
    @if ($adword->type_id == 'BOTTOM_OF_HEADER')
        @if ($adword->html) 
            {!! $adword->html !!}
        @else 
            <a href="{{$adword->target_url}}" target="_blank">
                <img src="{{$adword->image->image}}" alt="" class="w-full rounded">
            </a>
        @endif
    @endif

    @if ($adword->type_id == 'BOTTOM_OF_HEADER_SLIDER')
    <div class="relative mt-2 overflow-hidden rounded swiper adword_slider h-52 ">   
        <div class="swiper-wrapper"> 
            @foreach ($adword->images as $image)
            <div class="swiper-slide ">
                <a href="{{$image->image}}" alt="{{$adword->title}}" data-pswp-width="{{$image->width}}" data-pswp-height="{{$image->height}}">
                    <img src="{{$image->image}}" alt="{{$adword->title}}" loading="lazy" class="object-contain w-auto h-52" width="{{$image->width}}" height="{{$image->height}}" >
                </a> 
            </div> 
            @endforeach 
        </div> 
        @include("vendor.swiper.arrows")
    </div>
    @endif
    
    @if ($adword->type_id == 'STICKER_LEFT')
        @if ($adword->html)
            {!! $adword->html !!}
        @else
            <a href="{{$adword->target_url}}" target="_blank">
                <img src="{{$adword->image->image}}" alt="" class="w-full rounded">
            </a>
        @endif
    @endif
    @if ($adword->type_id == 'STICKER_RIGHT')
        @if ($adword->html)
            {!! $adword->html !!}
        @else
            <a href="{{$adword->target_url}}" target="_blank">
                <img src="{{$adword->image->image}}" alt="" class="w-full rounded">
            </a>
        @endif
    @endif
    @if ($adword->type_id == 'RIGHT_SIDE_BAR_1')
        @if ($adword->html)
            {!! $adword->html !!}
        @else
            <a href="{{$adword->target_url}}" target="_blank">
                <img src="{{$adword->image->image}}" alt="" class="w-full rounded">
            </a>
        @endif
    @endif
    @if ($adword->type_id == 'RIGHT_SIDE_BAR_2')
        @if ($adword->html)
            {!! $adword->html !!}
        @else
            <a href="{{$adword->target_url}}" target="_blank">
                <img src="{{$adword->image->image}}" alt="" class="w-full rounded">
            </a>
        @endif
    @endif


    @if ($adword->type_id == 'POST_INTEXT')
        <div class="float-left w-1/2 mr-4 lg:w-1/3 bg-slate-200">
            @if ($adword->html)
                {!! $adword->html !!}
            @else
                <a href="{{$adword->target_url}}" target="_blank">
                    <img src="{{$adword->image->image}}" alt="" class="w-full rounded">
                </a>
            @endif
        </div> 
    @endif


    @if ($adword->type_id == 'POST_UNDERCOVER')
        <div class="mt-4 text-center">
            @if ($adword->html)
                {!! $adword->html !!}
            @else
                <a href="{{$adword->target_url}}" target="_blank">
                    <img src="{{$adword->image->image}}" alt="" class="max-w-full mx-auto rounded">
                </a>
            @endif
        </div> 
    @endif

    
@endif