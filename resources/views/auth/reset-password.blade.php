@extends('auth.layout')
 

@section('title', __('app.forgot_password'))

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
<form method="POST" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $request->route('token') }}">
    <div class="space-y-4 ">
        <div>
            <label for="" class="text-sm">{{__('app.email')}}</label>
            <input type="email" name="email" value="{{Request::old('email') ?? $request->email}}" class="w-full rounded border-slate-400" required>
        </div>
        <div>
            <label for="" class="text-sm">{{__('app.password')}}</label>
            <input type="password" name="password" class="w-full rounded border-slate-400" required autofocus>
        </div>
        <div>
            <label for="" class="text-sm">{{__('app.password_confirmation')}}</label>
            <input type="password" name="password_confirmation" class="w-full rounded border-slate-400" required>
        </div> 
        

        <div class="flex justify-end">
            <button type="submit" class="w-full px-4 py-2 font-semibold text-center text-white bg-blue-500 rounded cursor-pointer hover:bg-blue-600">
                {{__('app.reset_password')}}
            </button>
        </div> 
    </div>
</form>


@endsection
