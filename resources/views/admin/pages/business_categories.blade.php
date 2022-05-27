@extends('admin.layouts.dashboard')
 
@section('title', 'Posts')
 
@section('content')
    
 
    
    <x-admin-search name="business_categories" />
 






    <div class="grid grid-cols-1 divide-y divide-dashed">
        @foreach($categories as  $category)
        <div class="p-2 px-4 md:flex">
            
            <div class="flex items-center flex-1">
                <a href="{{$category->public_link}}" class="hover:text-rose-500">{{$category->name}}</a>
            </div>

   
            <div class="flex justify-between mt-4 space-x-3 text-xs text-right md:mt-0 md:ml-4 md:items-center"> 
                <div class=""><a href="{{route('admin.business_categories.remove',$category)}}" class="block px-3 py-2 text-white rounded bg-rose-500 hover:bg-rose-600">Sil</a></div>
                <div class=""><a href="{{route('admin.business_categories.edit',['id' => $category->id])}}" class="block px-3 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">Düzenle</a></div> 
            </div> 
        </div>
        @endforeach
    </div>








 

    <div class="m-6 ">
        <x-admin-pagination :records="$categories" />
    </div>

 




@endsection