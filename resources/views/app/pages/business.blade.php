@extends('app.layouts.sidepage')


@section('title', __('app.business_title', [
    'name' => $business->name,
    'category' => $business->category ? $business->category->name : '',
    'phone' => $business->phone_truncated
])) 

@section('header')
    <x-metadata   
        :title="$business->name" 
        :image="$business->profile_image ? $business->profile_image->image : null" 
    />
@endsection

@section('structured_data')
{!!$business->structured_data!!}
@endsection


@section('itemscopes','itemscope itemtype="https://schema.org/LocalBusiness"')
  

@section('content_side')
    <div class="relative overflow-hidden shadow-lg md:rounded swiper images_slider h-60 md:h-80"> 
        <div class="swiper-wrapper"> 
            @foreach ($business->cover_images as $cover_image)
            <div class="swiper-slide">
                <a href="{{$cover_image->link}}" title="{{$business->name}}" data-pswp-width="{{$cover_image->width}}" data-pswp-height="{{$cover_image->height}}" class="w-full h-full">
                    <img src="{{$cover_image->link}}" alt="{{$business->name}}" class="object-cover w-full h-60 md:h-80 " itemprop="photo">
                </a>
            </div> 
            @endforeach
        </div> 
        @include("vendor.swiper.arrows")
    </div>

    <div class=" -mt-20 p-2 bg-white md:bg-slate-200 w-36 md:w-44 h-36 md:h-44 rounded-full mx-auto z-[1] relative  shadow-lg">
        @if ($business->profile_image) 
        <img src="{{$business->profile_image->link }}" alt="{{$business->name}}" class="object-cover w-full h-full rounded-full " itemprop="image">
        @endif
    </div>

    <h1 class="block text-xl font-bold text-center md:text-4xl" itemprop="name">{{$business->name}}</h1>

    <div class="px-4 mt-4 text-xs md:text-sm md:px-0 ">
        @if ($business->phone)
        <div>
            <span class="font-bold text-rose-500">{{__('app.phone')}}:</span>
            <a class="" itemprop="telephone" href="tel:{{$business->phone}}" title="{{__('app.business_phone_title',['name' => $business->name])}}">{{ $business->phone_formated }}</a>
        </div>
        @endif
        @if ($business->email)
        <div>
            <span class="font-bold text-rose-500">{{__('app.email')}}:</span>
            <a class="" itemprop="email" href="mailto:{{$business->email}}" title="{{__('app.business_email_title',['name' => $business->name])}}">{{ $business->email }}</a>
        </div>
        @endif
        @if ($business->website)
        <div>
            <span class="font-bold text-rose-500">{{__('app.website')}}:</span>
            <a class="" itemprop="url" target="_blank" href="{{$business->website}}" title="{{__('app.business_website_title',['name' => $business->name])}}">{{ $business->website }}</a>
        </div>
        @endif
        @if ($business->address)
        <div>
            <span class="font-bold text-rose-500">{{__('app.address')}}:</span>
            <span class="" itemprop="address">{{ $business->address }}</span>
        </div>
        @endif
        @if ($business->working_start_at && $business->working_end_at)
        <div>
            <span class="font-bold text-rose-500">{{__('app.working_hours')}}:</span>
            <span class="" itemprop="openingHours">{{$business->working_start_at}}-{{$business->working_end_at}}</span> 
        </div>
        @endif
        @if ($business->price_range)
        <meta itemprop="priceRange" content="{{$business->price_range}}">
        @endif
    </div>
 
    <x-divider  />

    <div class="">
        @foreach ($business->blocks as $block) 
            <div> 
                @if ($block->type_id == 1)
                    <div class="px-4 mt-4 text-justify md:px-0">
                        {!!$block->content!!}
                    </div>
                @endif
                @if ($block->type_id == 2 && $block->images->count() > 0)
                    <div class="mt-4">
                        @if ($block->content)
                        <div class="flex items-center mb-4">
                            <div class="flex-1 border-t-2 border-dashed border-y-amber-400"></div>
                            <div class="mx-4 text-lg font-bold text-amber-500">{{$block->content}}</div>
                            <div class="flex-1 border-t-2 border-dashed border-y-amber-400"></div>
                        </div>
                        @endif
                        <div class="swiper images_slider !h-52 md:!h-64 overflow-hidden">
                            <div class="swiper-wrapper">
                                @foreach ($block->images as $image) 
                                    <div class="swiper-slide !w-52 md:!w-64 !h-52 md:!h-64 !bg-transparent shadow rounded-lg">
                                        <a href="{{$image->link}}" title="{{$business->name}}" data-pswp-width="{{$image->width}}" data-pswp-height="{{$image->height}}" class="w-full h-full">
                                            <img src="{{$image->image}}" alt="{{$business->name}}" class="object-cover w-full h-full border-4 rounded-lg border-amber-400">
                                        </a>
                                    </div>
                                @endforeach 
                            </div>
                        </div>
                    </div>
                @endif 
            </div> 
        @endforeach
    </div> 

    <div class="p-4 mx-4 mt-4 text-sm border border-dashed rounded md:mx-0 border-emerald-400 bg-emerald-100">
        <div class="italic font-semibold">{{__('app.hello')}}</div>
        <div class="italic " >{!!__('app.business_ownership_note',[
            'email' => \App\Models\Settings::get('CONTACT_EMAIL'),
        ])!!}</div>
    </div>

    <div class="mx-4 mt-4 md:mx-0">
        <iframe class="w-full border h-52" src="{{$business->location_iframe_url}}" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe> 
    
    </div>
   
    <div class="mx-4 mt-4 md:mx-0">
        <x-tags routename="businesses.by_tags" :tags="$business->tags" />
    </div>
@endsection
 