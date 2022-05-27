@extends('auth.layout')
 
@section('title', __('app.register'))

@section('description',  __('app.fill_informations'))

@section('content')
@if ($errors->any())
    <div class="p-4 mt-8 rounded bg-rose-50">
        <div class="font-medium text-red-600">
            {{__('app.oops')}}
        </div>

        <ul class="mt-3 text-sm text-red-600 list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="mt-8 space-y-4"> 
        <div>
            <label for="" class="text-sm">{{__('app.firstname')}}</label>
            <input type="text" name="firstname" value="{{Request::old('firstname')}}" class="w-full rounded border-slate-400" required autofocus>
        </div>
        <div>
            <label for="" class="text-sm">{{__('app.lastname')}}</label>
            <input type="text" name="lastname" value="{{Request::old('lastname')}}" class="w-full rounded border-slate-400" required>
        </div>
        <div>
            <label for="" class="text-sm">{{__('app.email')}}</label>
            <input type="email" name="email" value="{{Request::old('email')}}" class="w-full rounded border-slate-400" required>
        </div>
        <div>
            <label for="" class="text-sm">{{__('app.password')}}</label>
            <input type="password" name="password" class="w-full rounded border-slate-400" required>
        </div>
        <div>
            <label for="" class="text-sm">{{__('app.password_confirmation')}}</label>
            <input type="password" name="password_confirmation" class="w-full rounded border-slate-400" required>
        </div> 

        <x-g-recaptcha />


        <div class="flex justify-end">
            <button type="submit" class="w-full px-4 py-2 font-semibold text-center text-white bg-blue-500 rounded cursor-pointer hover:bg-blue-600">
                {{__('app.create_account')}}
            </button>
        </div>

        <div>
            <div class="text-sm text-center text-slate-400">{{__('app.has_account')}}</div> 
            <a href="{{ route('login') }}" class="block w-full px-4 py-2 mt-4 font-semibold text-center rounded cursor-pointer bg-slate-300 hover:bg-slate-400 hover:text-white">
                {{__('app.login')}}
            </a>
        </div>
    </div>
</form>


@endsection
