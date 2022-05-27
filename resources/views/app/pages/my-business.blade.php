@extends('app.layouts.fullpage')

@section('title', __('app.my_business_page'))
 
@section('content')
 


<div class="p-4">
    <form action="" method="post">
        @csrf
        
        <x-input-heading 
            name="name" 
            :value="$business->name" 
            placeholder="Bir isim belirleyin" 
            :slug="$business->public_link"
            button_label="BİLGİLERİ KAYDET" 
        />

 

        <div class="grid grid-cols-1 gap-4 mt-4 md:grid-cols-4">

            <x-input-text name="email" :value="$business->email" label="E-Mail" />
            <x-input-text name="phone" :value="$business->phone" label="Telefon" />
            <x-input-text name="fax" :value="$business->fax" label="Fax" />
            <x-input-text name="website" :value="$business->website" label="Web Site" />
 
        </div>
        
        <div class="grid grid-cols-1 gap-4 mt-4 md:grid-cols-12">

            <div class="lg:col-span-2 md:col-span-6">
                <x-select :items="\App\Models\District::all()" name="district_id" :value="$business->district_id" item_value="id" item_text="name" label="Bağlı Olduğu İlçe"/>
            </div>
            <div class="lg:col-span-2 md:col-span-6">
                <x-select :items="\App\Models\Category::where('type_id',2)->orderBy('name','ASC')->get()" name="category_id" :value="$business->category_id" item_value="id" item_text="name" label="Kategori"/>
            </div>
 
            <div class="lg:col-span-7 md:col-span-10">
                <x-input-text name="address" :value="$business->address" label="Address" />
            </div>
            <div class="lg:col-span-1 md:col-span-2">
                <x-input-text name="zip" :value="$business->zip" label="ZIP" />
            </div>
        </div> 

        <x-divider />

        <div class="items-end lg:flex">
            <div class="items-end md:flex">
                <h2 class="text-sm font-semibold leading-10 text-gray-500 whitespace-nowrap md:mr-4">Çalışma Saatleri :</h2>
                <div class="flex w-full space-x-4 md:w-auto"> 
                    <div class="flex-1">
                        <x-input-text type="time" name="working_start_at" :value="$business->working_start_at" label="Başlangıç" maxlength="5"/> 
                    </div>
                    <div class="flex-1">
                        <x-input-text type="time" name="working_end_at" :value="$business->working_end_at" label="Bitiş" maxlength="5"/>   
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-12 gap-4 mt-4 lg:mt-0 lg:ml-4">
                <label class="block col-span-12 md:col-span-6 lg:col-span-8">
                    <x-input-text name="google_maps_link" :value="$business->google_maps_link" label="Google Harita Linki" />  
                </label>
                <label class="block col-span-6 md:col-span-3 lg:col-span-2">
                    <x-input-text name="location_lat" :value="$business->lat" label="LAT" />  
                </label>
                <label class="block col-span-6 md:col-span-3 lg:col-span-2">
                    <x-input-text name="location_lng" :value="$business->lng" label="LNG" />  
                </label>
            </div>
        </div>

        <x-divider />



        <div class="items-end lg:flex">
            <div class="items-end md:flex">
                <h2 class="text-sm font-semibold leading-10 text-gray-500 whitespace-nowrap">Fiyat Ortalaması :</h2>
                <div class="flex w-auto space-x-4 md:ml-4"> 
                    <x-input-text type="number" name="min_price" :value="$business->min_price" label="Min Fiyat" placeholder="15"/>   
                    <x-input-text type="number" name="max_price" :value="$business->max_price" label="Max Fiyat" placeholder="15"/>   
                    <x-input-text  name="currency" :value="$business->currency" label="Para Birimi" placeholder="TRY"/>    
                </div>
            </div>
            <div class="flex-1 mt-4 lg:mt-0 lg:ml-4">
                <div class="">
                    <x-input-text  name="contact_person_name" :value="$business->contact_person_name" label="Yetkili Kişi Adı"  />    
                </div> 
            </div>
        </div>


        <x-divider />


        <div class="mt-4 md:flex"> 
            <div class="fileman" data-name="profile_images" data-label="Profil Fotoğrafı" data-files="{{json_encode($business->profile_images)}}" data-mime="image/*"></div>
            <div class="fileman" data-name="cover_images" data-label="Kapak Fotoğrafları" data-limit="10" data-files="{{json_encode($business->cover_images)}}" data-mime="image/*"></div>
        </div>


        <x-divider />
 

        <div class="blockman" data-blocks="{{json_encode($business->blocks)}}"></div>

      
        

        <x-divider />
        
        <x-input-text  name="youtube_link" :value="$business->youtube_link" label="Youtube Tanıtım Videosu Linki" />    
        
 

        <x-button type="submit" label="BİLGİLERİ KAYDET" centered offset />

    </form>
</div>

@endsection
