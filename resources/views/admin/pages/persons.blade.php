@extends('admin.layouts.dashboard')
 
@section('title', 'Kişiler')
 
@section('content')
    
 
    
    <x-admin-search name="persons" />  


    <div class="grid grid-cols-1 divide-y divide-dashed">
        @foreach($persons as  $person)
        <div class="p-2 px-4 md:flex">
            
            <div class="flex flex-1">
                <div class="flex">
                    <div class="items-center justify-center hidden w-10 text-xs md:flex">
                        <span>{{$person->id}}</span>
                    </div>
                    <div class="md:ml-2">
                        @if ($person->profile_image) 
                        <img class="object-cover w-16 h-16 rounded" src="{{$person->profile_image->image}}" alt="">
                        @endif
                    </div>
                </div> 
                <div class="flex-1 ml-2 md:ml-4">
                    <div class="text-sm font-semibold">
                        <a href="{{$person->public_link}}" class="hover:text-rose-500">{{$person->name}}</a>
                    </div>
                    <div class="text-xs text-gray-400">
                        @if ($person->district) 
                            {{$person->district->name}} 
                        @endif
                    </div>
                </div>
            </div>

            <div class="flex items-end justify-between mt-2 md:items-center md:mt-0">
				<div class="flex flex-col justify-center md:ml-4 ">
					<div class="text-xs leading-none md:text-sm">
						{{$person->created_at->format('d.m.Y H:i')}}
					</div>
					<div class="text-xs leading-none text-gray-400">
						{{ $person->created_at->diffForHumans() }}
					</div>
				</div>

				<div class="flex justify-between space-x-3 text-xs text-right md:ml-4 md:items-center"> 
					<div class=""><a href="{{route('admin.persons.remove',$person)}}" class="block px-3 py-2 text-white rounded bg-rose-500 hover:bg-rose-600">Sil</a></div>
					<div class=""><a href="{{route('admin.persons.edit',['id' => $person->id])}}" class="block px-3 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">Düzenle</a></div> 
				</div> 
            </div> 
        </div>
        @endforeach
    </div>
 

    <div class="m-6 ">
        <x-admin-pagination :records="$persons" /> 
    </div>

 




@endsection