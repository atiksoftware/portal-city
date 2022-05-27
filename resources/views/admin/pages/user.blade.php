@extends('admin.layouts.dashboard')

@if ($user->id)
    @section('title', $user->fullname) 
@else
    @section('title', 'Yeni Kullanıcı Ekle')
@endif

@section('content')

{{-- <div class="px-4 py-2 m-4 text-sm font-semibold text-blue-500 bg-blue-100 rounded">
   İçerik başarılı bir şekilde kaydedilmiştir
</div> --}}

<div class="p-4">
    <form action="" method="post">
        @csrf
        <div class="grid grid-cols-3 gap-4 mt-4">

            <x-input-text label="E-Mail" name="email" value="{{Request::old('email') ?? $user->email}}" />
            <x-input-text label="Adı" name="firstname" value="{{Request::old('firstname') ?? $user->firstname}}" />
            <x-input-text label="Soyadı" name="lastname" value="{{Request::old('lastname') ?? $user->lastname}}" />

            @php
                $user_types = [
                    (object)['id' => '0', 'text' => 'Normal Kullanıcı'], 
                    (object)['id' => '1', 'text' => 'ADMIN KULLANICISI'],
                ];
            @endphp
            <x-select :items="$user_types" item_value="id" item_text="text" :value="Request::old('is_admin') ?? $user->is_admin" label="Kullanıcı Türü" name="is_admin"/>

            @php
                $active_types = [
                    (object)['id' => '0', 'text' => 'Pasif - Erişime Kapalı'], 
                    (object)['id' => '1', 'text' => 'Aktif - Erişime Açık'],
                ];
            @endphp
            <x-select :items="$active_types" item_value="id" item_text="text" :value="Request::old('is_active') ?? $user->is_active" label="Hesap Durumu" name="is_active"/>
 
            @if (!$user->id)
            <x-input-text label="Şifre" name="password" type="password" />
            @endif
        </div>
 
        <x-button  label="Bilgileri Kaydet" icon="floppy-disk" centered offset name="submit" value="informations"/>
  
    </form>
    
    @if ($user->id)
        <x-divider />
        <form action="" method="post">
            @csrf
            <div class="grid max-w-full grid-cols-1 gap-4 mt-4 w-96">
                <x-input-text label="Şifre" name="password" type="password" />
                <x-input-text label="Şifre Tekrar" name="password_confirmation" type="password" />
                
                <x-button  label="Şifreyi Değiştir" centered   name="submit" value="password"/> 
            </div> 
        </form>
    @endif
    
    @if ($user->id)
        <x-divider /> 
        
        <div class="grid grid-cols-1 gap-4">
            <div>
                <div class="font-bold">FİRMALAR</div>
                <div class="pl-4"> 
                    @foreach ($user->businesses as $business)
                        <div>
                            <a href="{{route('admin.businesses.edit',['id' => $business->id])}}" class="hover:text-rose-500">{{$business->name}}</a>
                        </div> 
                    @endforeach
                </div> 
            </div>
            <div>
                <div class="font-bold">KİŞİLER</div>
                <div class="pl-4"> 
                    @foreach ($user->persons as $person)
                        <div>
                            <a href="{{route('admin.persons.edit',['id' => $person->id])}}" class="hover:text-rose-500">{{$person->name}}</a>
                        </div> 
                    @endforeach
                </div> 
            </div>
        </div>
    @endif

</div>





@endsection
