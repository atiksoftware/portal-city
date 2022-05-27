@extends('app.layouts.sidepage')

@section('title', __('app.post_title',['title'=>$post->title]))

@section('header')
    <x-metadata 
        type="article"
        :title="$post->title"
        :description="$post->summary"
        :tags="$post->tags->pluck('name')->toArray()"
        :category="$post->category ? $post->category->name : null"
        :author="$post->user ? $post->user->fullname : null"
        :image="$post->featured_image ? $post->featured_image->image : null"
    />
@endsection

@section('structured_data')
{!!$post->structured_data!!}
@endsection


@section('content_side') 
    <div class="p-2 mx-4 mt-4 border-l-4 border-rose-500 lg:mx-0 lg:mt-0">
        <h1 class="text-lg font-bold lg:text-xl ">{{$post->title}}</h1>
    </div>

    <div class="mx-4 mt-4 font-semibold lg:mx-0">
        {{$post->summary}}
    </div>

    <div class="relative mt-4 overflow-hidden shadow-lg lg:rounded "> 
        @if ($post->youtube_link)
        <iframe class="w-full h-96" src="{{$post->youtube_embed_link}}?autoplay=1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        @else
        <img src="{{$post->featured_image->image}}" alt="{{$post->title}}" class="object-cover w-full " width="{{$post->featured_image->width}}" height="{{$post->featured_image->height}}">
        @endif
        
    </div>

    <div class="justify-between w-full mt-2 text-xs text-gray-500 rounded md:text-sm md:mt-4 md:flex">
        <div class="flex mx-2 md:mx-0 "> 
            @if ($post->category) 
            <div class="flex items-center hover:text-rose-500">
                <x-icon name="dots-vertical-circle" class="w-4 h-4 mr-1 " /> 
                <a href="{{route('posts.by_category',$post->category)}}" title="{{$post->category->name}}">{{$post->category->name}}</a>
            </div>
            @endif
            <div class="flex items-center ml-4">
                <x-icon name="calendar-range" class="w-4 h-4 mr-1 text-slate-400" />  
                <span>{{$post->created_at->format('d.m.Y H:i')}}</span>
            </div>
            <div class="items-center hidden ml-4 md:flex">
                <x-icon name="eye" class="w-4 h-4 mr-1 text-slate-400" />  
                <span>{{$post->view_count}}</span>
            </div>
            @if ($post->user != null) 
            <div class="flex items-center ml-4 hover:text-rose-500">
                <x-icon name="user-pen" class="w-4 h-4 mr-1 text-slate-400" />  
                <a href="{{route('posts.by_user',$post->user)}}" title="{{$post->user->fullname}}">{{$post->user->fullname}}</a>
            </div>
            @endif
        </div>
        <div class="mx-2 mt-2 md:mx-0 md:mt-0">
            <x-shares />
        </div>

    </div>
    


    <div class="mx-4 lg:mx-0">
        @if ($post->gallery_images->count() > 0) 
        <div class="h-40 mt-4 overflow-hidden swiper images_slider">
            <div class="swiper-wrapper">
                @foreach ($post->gallery_images as $image) 
                    <div class="swiper-slide">
                        <a href="{{$image->link}}" title="{{$post->title}}" data-pswp-width="{{$image->width}}" data-pswp-height="{{$image->height}}" class="h-full ">
                            <img src="{{$image->link}}" alt="{{$post->title}}" class="h-full border-4 rounded-lg border-amber-400" width="{{$image->width}}" height="{{$image->height}}">
                        </a>
                    </div>
                @endforeach 
            </div>
        </div>
        @endif
        
        <x-adword :adword="\App\Models\Adword::getByTypeId('POST_UNDERCOVER')" />

        <div class="mt-4 text-justify">

            <x-adword :adword="\App\Models\Adword::getByTypeId('POST_INTEXT')" />
            
            {!!$post->content!!}
        </div>

        
    </div>

    <div class="mx-4 mt-4 md:mx-0">
        <x-tags routename="posts.by_tags" :tags="$post->tags" />
    </div>

@endsection 
 


