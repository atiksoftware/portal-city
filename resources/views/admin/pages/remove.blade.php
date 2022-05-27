@extends('admin.layouts.dashboard')
 
@section('title', 'Posts')
 
@section('content')
    


    <div class="px-10 py-20">

        <div class="text-center">
            <div>
                <span class="font-bold text-rose-500">{{$name}}</span> <span>isimli içeriği kalıcı olarak silmek istediğine emin misin?</span>
            </div>
            <div class="mt-4 font-bold text-orange-500">
                Bu işlem geri alınamaz.
            </div>
        </div>

        <div>
            <form action="" method="POST">
                @csrf
                <button type="submit" class="flex items-center px-6 py-3 mx-auto mt-10 text-white rounded bg-rose-500 hover:bg-rose-600">
                    <svg class="h-4 mr-4" viewBox="0 0 448 512"><path fill="currentColor" d="M432 32H320l-11.58-23.16C305.7 3.424 300.2 0 294.1 0H153.9C147.8 0 142.3 3.424 139.6 8.844L128 32H16C7.164 32 0 39.16 0 48v32C0 88.84 7.164 96 16 96h416C440.8 96 448 88.84 448 80v-32C448 39.16 440.8 32 432 32zM32 464C32 490.5 53.5 512 80 512h288c26.5 0 48-21.5 48-48V128H32V464zM143 256.1c-9.375-9.375-9.375-24.56 0-33.94s24.56-9.375 33.94 0l47.03 47.03l47.03-47.03c9.375-9.375 24.56-9.375 33.94 0s9.375 24.56 0 33.94L257.9 304l47.03 47.03c9.375 9.375 9.375 24.56 0 33.94c-9.381 9.379-24.56 9.371-33.94 0l-47.03-47.03l-47.03 47.03c-9.381 9.379-24.56 9.371-33.94 0c-9.375-9.375-9.375-24.56 0-33.94L190.1 304L143 256.1z"/></svg>
                    <span>İçeriği Kalıcı Olarak Sil</span>
                </button>
            </form>
        </div>

    </div>



@endsection