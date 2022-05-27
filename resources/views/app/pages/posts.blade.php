@extends('app.layouts.fullpage')

 
@section('title',  $title)
@section('description',  $description)

@section('prepend')
    @include('app.includes.global_title_description',['title'=>$title,'description'=>$description])
@endsection


@section('content_side')




<x-search-filter :value="$search"/>

<div class="my-10"></div>

<div class="grid grid-cols-2 gap-4 mx-4 md:grid-cols-3 lg:grid-cols-5 md:mx-0">
    {{-- @foreach ($posts as $post)
        
    <div class="transition-all hover:scale-105">
        <a href="{{route('post',$post)}}" title="{{$post->title}}" class="block h-32 mx-auto ">
            @if ($post->featured_image)
                <img src="{{$post->featured_image->image}}" alt="{{$post->title}}" class="object-cover w-full h-full transition-all rounded shadow-md hover:shadow-lg hover:shadow-slate-400">
            @endif
        </a>
    </div>
    @endforeach --}}
    @foreach ($posts as $post)
        @include('app.includes.post_card',['post'=>$post]) 
    @endforeach
</div>

<div class="mx-2 my-6 md:mx-0">
    {{ $posts->links('pagination::tailwind') }}
</div>


@endsection
