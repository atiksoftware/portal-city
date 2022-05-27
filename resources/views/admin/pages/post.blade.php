@extends('admin.layouts.dashboard')

@if ($post->id)
    @section('title', $post->title) 
@else
    @section('title', 'Yeni Haber Ekle')
@endif

@section('content')
 

<div class="p-4">
    <form action="" method="post">
        @csrf

        <x-input-heading 
            name="title" 
            :value="Request::old('title') ?? $post->title" 
            placeholder="Haber için bir başlık giriniz" 
            :slug="$post->public_link"
            button_label="BİLGİLERİ KAYDET" 
        />

 

        <div class="mt-4">
            <textarea name="content" class="hidden textman" placeholder="Haber metnini buraya girin">{{Request::old('content') ?? $post->content}}</textarea>
        </div>

        <div class="grid grid-cols-1 gap-4 mt-4 md:grid-cols-4">
            <div class="col-span-3">
                <x-input-text name="summary" :value="Request::old('summary') ?? $post->summary" label="Haber Özeti" />
            </div>
            <div class="col-span-1">
                <x-input-text name="youtube_link" :value="Request::old('youtube_link') ?? $post->youtube_link" label="Youtube Video Link" />
            </div> 
            <div class="md:col-span-4"> 
                <x-input-tags name="tags" value="{{Request::old('tags') ?? implode(',',$post->tags->pluck('name')->toArray())}}"  label="Etiketler" />
            </div> 
        </div>

        <div class="my-6 border-t-2 border-dashed"></div>

        <div class="grid grid-cols-1 gap-4 mt-4 md:grid-cols-2">

            <div class="fileman" data-name="featured_images" data-label="Kapak Fotoğrafı" data-files="{{json_encode($post->featured_images)}}" data-mime="image/*"></div>
            <div class="fileman" data-name="gallery_images" data-label="Fotoğraf Galerisi" data-limit="10" data-files="{{json_encode($post->gallery_images)}}" data-mime="image/*"></div>
 

        </div>

        <div class="my-6 border-t-2 border-dashed"></div>

        <div class="grid grid-cols-2 gap-4">
            <x-select :items="\App\Models\District::all()" name="district_id" :value="Request::old('district_id') ?? $post->district_id" item_value="id" item_text="name" label="Bağlı Olduğu İlçe"/>
            <x-select :items="\App\Models\Category::where('type_id',1)->get()" name="category_id" :value="Request::old('category_id') ?? $post->category_id" item_value="id" item_text="name" label="Kategori"/>
               
        </div>



        {{-- <div class="my-6 border-t-2 border-dashed"></div>

        <div>
            <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" checked=""
                    class="text-indigo-600 border-gray-300 rounded shadow-sm focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50">
                <span class="ml-2">Manşete Ekle</span>
            </label>
            <label class="inline-flex items-center ml-4 cursor-pointer">
                <input type="checkbox" checked=""
                    class="text-indigo-600 border-gray-300 rounded shadow-sm focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50">
                <span class="ml-2">Manşete Ekle</span>
            </label>
        </div>
        <div>
            <label class="block">
                <span class="text-xs text-gray-700">Manşet Numarası</span>
                <input type="number" min="1" max="20" class="block w-32 px-2 py-1 text-sm" placeholder="">
            </label>
        </div> --}}



        <x-button type="submit" label="BİLGİLERİ KAYDET" centered offset />

    </form>
</div>





@endsection
