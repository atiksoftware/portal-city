@extends('auth.layout')
 

@section('title', __('app.forgot_password'))

@section('description',  __('app.fill_informations'))

@section('content')
@if ($errors->any())
    <div class="p-4 mt-6 mb-6 rounded bg-rose-50">  
        <ul class="text-sm text-red-600 list-disc list-inside ">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session('status'))
    <div class="p-4 mt-6 mb-6 rounded bg-emerald-100">
        <div class="font-medium text-emerald-600">
            {{session('status')}}
        </div> 
    </div>
@else
<form method="POST" action="{{ route('password.email') }}">
    @csrf
    <div class="space-y-4 ">
        <div>
            <label class="text-sm">{{__('app.email')}}</label>
            <input type="email" name="email" class="w-full rounded border-slate-400" value="{{Request::old('email')}}" required autofocus>
        </div>
        
        <x-g-recaptcha />

        <div class="flex justify-end">
            <button type="submit" class="w-full px-4 py-2 font-semibold text-center text-white bg-blue-500 rounded cursor-pointer hover:bg-blue-600">
                {{__('app.continue')}}
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
@endif

@endsection
