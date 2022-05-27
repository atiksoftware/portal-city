@extends('app.layouts.sidepage')

@section('title', __('app.person.title', [
    'name' => $person->name
])) 

@section('header')
    <x-metadata  
        type="person"
        :title="$person->name" 
        :image="$person->profile_image ? $person->profile_image->image : null"
        :firstname="$person->firstname"
        :lastname="$person->lastname"
        
    />
@endsection

@section('structured_data')
{!!$person->structured_data!!}
@endsection

@section('itemscopes','itemscope itemtype="https://schema.org/Person"')


@section('content_side')
    <div class="relative overflow-hidden shadow-lg md:rounded swiper images_slider h-80"> 
        <div class="swiper-wrapper"> 
            @foreach ($person->cover_images as $cover_image)
            <div class="swiper-slide">
                <a href="{{$cover_image->link}}" title="{{$person->name}}" data-pswp-width="{{$cover_image->width}}" data-pswp-height="{{$cover_image->height}}" class="w-full h-full">
                    <img src="{{$cover_image->link}}" alt="{{$person->name}}" class="object-cover w-full h-80 ">
                </a>
            </div> 
            @endforeach
        </div> 
        @include("vendor.swiper.arrows")
    </div>

    <div class=" -mt-20 p-2 bg-slate-200 w-44 h-44 rounded-full mx-auto z-[1] relative shadow-lg">
        <img src="{{$person->profile_image->image }}" alt="{{$person->name}}" class="object-cover w-full h-full rounded-full " itemprop="image">
    </div>

    <h1 class="block text-4xl font-bold text-center" itemprop="name">{{$person->name}}</h1>


    <div class="px-4 md:px-0">
        @foreach ($person->blocks as $block) 
            <div> 
                @if ($block->type_id == 1)
                    <div class="mt-4 text-justify">
                        {!!$block->content!!}
                    </div>
                @endif
                @if ($block->type_id == 2 && $block->images->count() > 0)
                    <div class="mt-4">
                        <div class="swiper images_slider !h-64 overflow-hidden">
                            <div class="swiper-wrapper">
                                @foreach ($block->images as $image) 
                                    <div class="swiper-slide !w-64 !h-64 !bg-transparent shadow rounded-lg">
                                        <a href="{{$image->link}}" title="{{$person->name}}" data-pswp-width="{{$image->width}}" data-pswp-height="{{$image->height}}" class="w-full h-full">
                                            <img src="{{$image->link}}" alt="{{$person->name}}" class="object-cover w-full h-full border-4 rounded-lg border-amber-400">
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
@endsection

@section('right')
    <div class="grid grid-cols-1 gap-4">
        <div>
            @include('app.widgets.business_list')
        </div>
        
        <div>
            @include('app.widgets.business_category_list')
        </div>
    </div>
@endsection


