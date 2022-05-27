@extends('admin.layouts.dashboard')
 
@section('title', 'Haberler')
 
@section('content')
    
 
    
    <x-admin-search name="posts" />  



    <div class="grid grid-cols-1 divide-y divide-dashed">
        @foreach($posts as  $post)
        <div class="p-2 px-4 md:flex">
            
            <div class="flex flex-1">
                <div class="flex">
                    <div class="items-center justify-center hidden w-10 text-xs md:flex">
                        <span>{{$post->id}}</span>
                    </div>
                    <div class="md:ml-2">
                        @if ($post->featured_image) 
                        <img class="object-cover w-16 h-10 rounded" src="{{$post->featured_image->image}}" alt="">
                        @endif
                    </div>
                </div> 
                <div class="flex-1 ml-2 md:ml-4">
                    <div class="text-xs md:text-sm">
                        <a href="{{$post->public_link}}" class="hover:text-rose-500">{{$post->title}}</a>
                    </div>
                    <div class="text-xs text-gray-400">
                        @if ($post->user != null)
                        {{$post->user->fullname}}
                        @endif 
                    </div>
                </div>
            </div>

            <div class="flex items-end justify-between mt-2 md:items-center md:mt-0">
				<div class="flex flex-col justify-center md:ml-4 ">
					<div class="text-xs leading-none md:text-sm">
						{{$post->created_at->format('d.m.Y H:i')}}
					</div>
					<div class="text-xs leading-none text-gray-400">
						{{ $post->created_at->diffForHumans() }}
					</div>
				</div>

				<div class="flex justify-between space-x-3 text-xs text-right md:ml-4 md:items-center"> 
					<div class=""><a href="{{route('admin.posts.remove',$post)}}" class="block px-3 py-2 text-white rounded bg-rose-500 hover:bg-rose-600">Sil</a></div>
					<div class=""><a href="{{route('admin.posts.edit',['id' => $post->id])}}" class="block px-3 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">Düzenle</a></div> 
				</div> 
            </div> 
        </div>
        @endforeach
    </div>



 

    <div class="m-6 ">
        <x-admin-pagination :records="$posts" />
    </div>

 




@endsection