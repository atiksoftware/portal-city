@extends('app.layouts.app')

@section('title', __('app.persons.title'))

@section('content')



<form action="" method="get" autocomplete="off"> 
    <input type="text" name="search" class="w-full p-2 text-4xl font-bold text-center bg-transparent border-0 border-b border-dashed focus:ring-0 focus:outline-none"
            placeholder="İsime göre arayın" value="{{$search}}" autocomplete="off">

</form>

<div class="my-10"></div>

<div class="grid grid-cols-3 gap-4 mx-4 md:grid-cols-5 md:mx-0">
    @foreach ($persons as $person)
        
    <div>
        <div class="text-center">
            <a 
                href="{{route('person',$person)}}" 
                title="{{$person->name}}"
                class="block w-24 h-24 mx-auto sm:w-32 sm:h-32 md:w-40 md:h-40">
                @if ($person->profile_image) 
                <img src="{{$person->profile_image->image}}" alt="{{$person->name}}" class="object-cover w-full h-full transition-all rounded-full shadow-md hover:shadow-lg hover:shadow-slate-400">
                @endif
            </a>
        </div>
        <div class="mt-2 text-xs font-bold text-center text-rose-500 md:text-base">
            <a href="{{route('person',$person)}}" title="{{ $person->name }}">{{ $person->name }}</a>
        </div>
    </div>
    @endforeach
</div>

<div class="mx-2 my-6 md:mx-0">
    {{ $persons->links('pagination::tailwind') }}
</div>


@endsection
