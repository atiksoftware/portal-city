@extends('admin.layouts.dashboard')

@if ($category->id)
    @section('title', $category->name) 
@else
    @section('title', 'Yeni Kategori Ekle')
@endif

@section('content')
 

<div class="p-4">
    <form action="" method="post">
        @csrf

        <x-input-heading 
            name="name" 
            :value="$category->name" 
            placeholder="Bir isim belirleyin" 
            :slug="$category->public_link" 
        />


        <x-button type="submit" label="BİLGİLERİ KAYDET" centered offset />
    </form>
</div>





@endsection
