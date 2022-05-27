@extends('admin.layouts.dashboard')

@if ($adword->id)
    @section('title', $adword->name) 
@else
    @section('title', 'Yeni Reklam Ekle')
@endif

@section('content')
 

<div class="p-4">
    <form action="" method="post">
        @csrf

        <x-input-heading 
            name="title" 
            :value="$adword->title" 
            placeholder="Bir isim belirleyin"  
            button_label="BİLGİLERİ KAYDET" 
        />

 

        <div class="mt-4">
            <x-select :items="\App\Models\Adword::getAdwordTypeList()" name="type_id" :value="$adword->type_id" item_value="id" item_text="text" label="Gösterileceği Yer"/>
        </div>

        <div class="mt-4">
            <div class="fileman" data-name="images" data-label="Fotoğraf" data-files="{{json_encode($adword->images)}}" data-limit="20" data-mime="image/*"></div>
        </div>
        <div class="mt-4">
            <x-input-text  name="target_url" :value="$adword->target_url" label="Görsele tıklanınca gidilecek url" />   
        </div>

        <div class="mt-4"> 
            <label class="text-sm font-semibold text-gray-500">HTML KOD</label> 
            <textarea  
            class="block w-full border-gray-300 rounded" 
            placeholder="HTML/Script kodlarını buraya yapıştırın" 
            name="html_code"  
            >{{$adword->html_code}}</textarea>
        </div>

        <div class="mt-4">  
            <x-input-checkbox label="Bu reklam görüntülenebilir" name="is_active" :value="$adword->is_active" />
        </div>


 


        <x-button type="submit" label="BİLGİLERİ KAYDET" centered offset />

    </form>
</div>





@endsection
