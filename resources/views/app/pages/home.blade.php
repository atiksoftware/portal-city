@extends('app.layouts.sidepage') 
 
@section('title', App\Models\Settings::get('SITE_TITLE'))


@section('prepend')
    @include('app.includes.global_title_description',['title'=>$title,'description'=>$description])
 

    @php
        $BOTTOM_OF_HEADER = \App\Models\Adword::getByTypeId('BOTTOM_OF_HEADER');
        $BOTTOM_OF_HEADER_SLIDER = \App\Models\Adword::getByTypeId('BOTTOM_OF_HEADER_SLIDER');
    @endphp

    @if ($BOTTOM_OF_HEADER) 
    <div class="mt-4">
        <x-adword :adword="\App\Models\Adword::getByTypeId('BOTTOM_OF_HEADER')" />
    </div>
    @endif

    @if ($BOTTOM_OF_HEADER_SLIDER) 
    <div class="mt-4">
        <x-adword :adword="\App\Models\Adword::getByTypeId('BOTTOM_OF_HEADER_SLIDER')" />
    </div>
    @endif

    <div class="mt-4 mb-4 ">
        @include('app.includes.persons_slider')
    </div>
@endsection




@section('content_side')

    <div class="mx-4 md:mx-0"> 
        <div class="relative overflow-hidden bg-black rounded-t swiper home_headlines h-72 md:h-119 "> 
            <div class="swiper-wrapper"> 
                @foreach ($headlines as $headline)
                @if ($headline->featured_image) 
                    <div class="swiper-slide">
                        <a href="{{route('post',$headline)}}" title="{{$headline->title}}">
                            <img src="{{$headline->featured_image->image}}" alt="{{$headline->title}}" title="{{$headline->title}}" loading="lazy" class="object-cover w-full h-119 ">
                        </a>
                    </div> 
                @endif
                @endforeach
            </div> 
            @include("vendor.swiper.arrows") 
        </div>
        <div class="flex">
            @for ($i = 0; $i < 12; $i++)
                <div data-index="{{$i}}" class="flex-1 leading-loose text-center text-black cursor-pointer bg-amber-400 hover:text-white hover:bg-rose-500">
                    {{$i + 1}}
                </div>
            @endfor
        </div>
    </div>

    <div class="flex items-center justify-between mt-4 rounded bg-amber-400 lg:mt-8">
        <div class="px-3 text-sm font-semibold">
            <h2>{{__('app.posts.widget_title')}}</h2>
        </div>
        <div class="text-sm font-semibold">
            <a href="{{route('persons')}}" title="{{__('app.view_all')}}" class="block px-2 py-1 m-1 bg-white rounded">{{__('app.view_all')}}</a>
        </div>
    </div>
    <div class="grid grid-cols-2 gap-2 mx-4 mt-4 md:gap-4 md:grid-cols-3 md:mx-0">
        @foreach ($items_1 as $post)
            @include('app.includes.post_card',['post'=>$post]) 
        @endforeach
    </div>


    <div class="mx-4 mt-4 md:mx-0">
        @include('app.includes.cinemas_slider')
    </div>


    <div class="flex items-center justify-between mt-4 rounded bg-amber-400 lg:mt-8">
        <div class="px-3 text-sm font-semibold">
            <h2>{{__('app.posts.widget_title')}}</h2>
        </div>
        <div class="text-sm font-semibold">
            <a href="{{route('persons')}}" title="{{__('app.view_all')}}" class="block px-2 py-1 m-1 bg-white rounded">{{__('app.view_all')}}</a>
        </div>
    </div>
    <div class="grid grid-cols-2 gap-2 mx-4 mt-4 md:gap-4 md:grid-cols-3 md:mx-0">
        @foreach ($items_2 as $post)
            @include('app.includes.post_card',['post'=>$post]) 
        @endforeach
    </div>

         
@endsection 

