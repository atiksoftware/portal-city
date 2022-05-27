@extends('app.layouts.fullpage')

@section('title', __('app.businesses.title'))
 
@section('content')

<x-search-filter :value="$search"/>




<div class="my-10"></div>

<div class="grid grid-cols-1 md:gap-4 md:grid-cols-2">
    @foreach ($businesses as $business)
        
    <div class="flex w-full p-4 bg-white md:rounded md:shadow-lg">
        <div >
            <a href="{{route('business',$business)}}" title="{{ $business->name }}" class="block w-20 h-20 mx-auto md:w-40 md:h-40 bg-slate-200">
                @if ($business->profile_image) 
                <img src="{{$business->profile_image->image}}" alt="{{ $business->name }}" class="object-contain w-full h-full rounded ">
                @endif
            </a>
        </div>
        <div class="flex-1 ml-4">
            <div class="font-bold text-rose-500">
                <a href="{{route('business',$business)}}" title="{{ $business->name }}">{{ $business->name }}</a>
            </div>
            <div class="my-2 border-t"></div>
            <div class="text-xs md:text-sm ">
                <div >
                    <span class="font-semibold">Adres:</span> 
                    <span>{{$business->address}}</span>
                </div>
                <div class="grid w-full grid-cols-2">
                    @if ($business->phone)
                    <div class="col-span-2 md:col-span-1">
                        <span class="font-semibold">Telefon:</span> 
                        <a href="tel:{{$business->phone}}" title="{{__('app.business_phone_title',['name' => $business->name])}}">{{$business->phone_formated}}</a>
                    </div>
                    @endif
                    @if ($business->fax)
                    <div class="col-span-2 md:col-span-1">
                        <span class="font-semibold">Fax:</span> 
                        <span>{{$business->fax}}</span>
                    </div>
                    @endif
                </div> 
                @if ($business->email)
                <div> 
                    <span class="font-semibold">E-posta:</span> 
                    <a href="mailto:{{$business->email}}" title="{{__('app.business_email_title',['name' => $business->name])}}">{{$business->email}}</a>
                </div>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="mx-2 my-6 md:mx-0">
    {{ $businesses->links('pagination::tailwind') }}
</div>


@endsection
