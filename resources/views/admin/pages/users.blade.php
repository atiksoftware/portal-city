@extends('admin.layouts.dashboard')
 
@section('title', 'Kullanıcılar')
 
@section('content')
    
 
    <x-admin-search name="users" />
 


    <div class="grid grid-cols-1 divide-y divide-dashed">
        @foreach($users as  $user)
        <div class="p-2 px-4 md:flex">
            
            <div class="flex flex-1">
                <div class="flex">
                    <div class="items-center justify-center hidden w-10 text-xs md:flex">
                        <span>{{$user->id}}</span>
                    </div>
                    <div class="md:ml-2">
                        <img class="object-cover w-16 h-16 rounded" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                    </div>
                </div> 
                <div class="flex-1 ml-2 md:ml-4">
                    <div class="text-sm font-semibold">
                        <a >{{$user->fullname}}</a>
                    </div>
                    <div class="text-xs text-gray-400"> 
                            {{$user->email}}  
                    </div>
                </div>
            </div>

            <div class="flex items-end justify-between mt-2 md:items-center md:mt-0">
				<div class="flex flex-col justify-center md:ml-4 ">
					<div class="text-xs leading-none md:text-sm">
						{{$user->created_at->format('d.m.Y H:i')}}
					</div>
					<div class="text-xs leading-none text-gray-400">
						{{ $user->created_at->diffForHumans() }}
					</div>
				</div>

				<div class="flex justify-between space-x-3 text-xs text-right md:ml-4 md:items-center"> 
					<div class=""><a href="{{route('admin.users.remove',$user)}}" class="block px-3 py-2 text-white rounded bg-rose-500 hover:bg-rose-600">Sil</a></div>
					<div class=""><a href="{{route('admin.users.edit',['id' => $user->id])}}" class="block px-3 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">Düzenle</a></div> 
				</div> 
            </div> 
        </div>
        @endforeach
    </div>
 

    <div class="m-6 ">
        <x-admin-pagination :records="$users" />
    </div>

 




@endsection