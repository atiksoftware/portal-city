@extends('auth.layout')
 

@section('title', __('app.login'))

@section('description',  __('app.fill_informations'))

@section('content')

<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="space-y-4 ">
        <div>
            <label class="text-sm">{{__('app.email')}}</label>
            <input type="email" name="email" class="w-full rounded border-slate-400" value="{{Request::old('email')}}" required autofocus>
        </div>
        <div>
            <label class="text-sm">{{__('app.password')}}</label>
            <input type="password" name="password" class="w-full rounded border-slate-400" required>
        </div>

        @if (Route::has('password.request'))
        <div>
            <a href="{{ route('password.request') }}" class="text-sm font-semibold text-rose-500">{{__('app.forgot_password')}}</a>
        </div>
        @endif

        <div class="flex justify-end">
            <button type="submit" class="w-full px-4 py-2 font-semibold text-center text-white bg-blue-500 rounded cursor-pointer hover:bg-blue-600">
                {{__('app.login')}}
            </button>
        </div>

        <div>
            <div class="text-sm text-center text-slate-400">{{__('app.hasnt_account')}}</div> 
            <a href="{{ route('register') }}" class="block w-full px-4 py-2 mt-4 font-semibold text-center rounded cursor-pointer bg-slate-300 hover:bg-slate-400 hover:text-white">
                {{__('app.create_new_account')}}
            </a>
        </div>
    </div>
</form>


@endsection
