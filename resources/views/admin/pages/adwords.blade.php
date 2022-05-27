@extends('admin.layouts.dashboard')
 
@section('title', 'Reklamlar')
 
@section('content')
    
 
     
    <x-admin-search name="adwords" />




    <div class="grid grid-cols-1 divide-y divide-dashed">
        @foreach($adwords as  $adword)
        <div class="p-2 px-4 md:flex">
            
            <div class="flex items-center flex-1">
                <span>{{$adword->title}}</span>
            </div>

   
            <div class="flex justify-between mt-4 space-x-3 text-xs text-right md:mt-0 md:ml-4 md:items-center"> 
                <div class=""><a href="{{route('admin.adwords.remove',$adword)}}" class="block px-3 py-2 text-white rounded bg-rose-500 hover:bg-rose-600">Sil</a></div>
                <div class=""><a href="{{route('admin.adwords.edit',['id' => $adword->id])}}" class="block px-3 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">Düzenle</a></div> 
            </div> 
        </div>
        @endforeach
    </div>



 

    <div class="m-6 ">
        <x-admin-pagination :records="$adwords" />
    </div>




@endsection