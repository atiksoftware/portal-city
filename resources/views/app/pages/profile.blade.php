@extends('app.layouts.fullpage')

@section('title', __('app.my_profile'))
 
@section('content')

 
<div class="md:flex md:justify-center">
    <a href="{{route('my-person')}}" class="block px-4 py-2 mx-2 mt-4 text-center border rounded text-emerald-600 border-emerald-600 md:mt-0 hover:bg-emerald-600 hover:text-white active:bg-emerald-600 active:text-white "><span>Kişisel Sayfamı Düzenle</span></a>
    <a href="{{route('my-business')}}" class="block px-4 py-2 mx-2 mt-4 text-center border rounded text-emerald-600 border-emerald-600 md:mt-0 hover:bg-emerald-600 hover:text-white active:bg-emerald-600 active:text-white"><span>İşletme Sayfamı Düzenle</span></a>
</div>


<div class="p-4">
    <form action="" method="post">
        @csrf
        <div class="grid gap-4 mt-4 md:grid-cols-3">

            <x-input-text label="E-Mail" name="email" value="{{Request::old('email') ?? $user->email}}" readonly/>
            <x-input-text label="Adı" name="firstname" value="{{Request::old('firstname') ?? $user->firstname}}" />
            <x-input-text label="Soyadı" name="lastname" value="{{Request::old('lastname') ?? $user->lastname}}" />

           
        </div>
 
        <x-button  label="Bilgileri Kaydet" icon="floppy-disk" centered offset name="submit" value="informations"/>
  
    </form>
    
    @if ($user->id) 
        <form action="" method="post">
            @csrf
            <div class="grid max-w-full grid-cols-1 gap-4 mt-4 md:w-96">
                <x-input-text label="Şifre" name="password" type="password" />
                <x-input-text label="Şifre Tekrar" name="password_confirmation" type="password" />
                
                <x-button  label="Şifreyi Değiştir" centered   name="submit" value="password"/> 
            </div> 
        </form>
    @endif

    <div class="text-center">
        <a href="{{ route('logout') }}" class="px-8 py-4 mx-auto mt-8 text-xs font-medium leading-tight text-white uppercase transition duration-150 rounded bg-rose-500 hover:bg-rose-600 focus:bg-rose-600 active:bg-rose-600 ease-in-outshadow-md hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg">Sign out</a>

    </div>
</div>



@endsection
