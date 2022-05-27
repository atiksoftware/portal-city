@extends('app.layouts.fullpage')

@section('title', __('app.my_personal_page'))
 
@section('content')

 
<div class="p-4">
    <form action="" method="post">
        @csrf

        <x-input-heading 
            name="name" 
            :value="$person->name" 
            placeholder="Bir isim belirleyin" 
            :slug="$person->public_link"
            button_label="BİLGİLERİ KAYDET" 
        />

      

        <div class="grid grid-cols-1 gap-4 mt-6 md:grid-cols-4">
            <x-input-text name="email" :value="$person->email" label="E-Mail" />
            <x-input-text name="phone" :value="$person->phone" label="Telefon" />
            <x-input-text name="website" :value="$person->website" label="Web Site" />

            <x-select :items="\App\Models\District::all()" name="district_id" :value="$person->district_id" item_value="id" item_text="name" label="Bağlı Olduğu İlçe"/>
 

            <x-input-text name="job_title" :value="$person->job_title" label="Meslek" />
            <x-input-text name="company_name" :value="$person->company_name" label="Çalıştığı Firma Adı" />
 
        </div> 
 

        <x-divider /> 


        <div class="mt-4 md:flex"> 
            <div class="fileman" data-name="profile_images" data-label="Profil Fotoğrafı" data-files="{{json_encode($person->profile_images)}}" data-mime="image/*"></div>
            <div class="fileman" data-name="cover_images" data-label="Kapak Fotoğrafları" data-limit="10" data-files="{{json_encode($person->cover_images)}}" data-mime="image/*"></div>
        </div>


        <x-divider /> 
 

        <div class="blockman" data-blocks="{{json_encode($person->blocks)}}"></div>

      
        

        <x-divider /> 

        <div class="grid grid-cols-1 gap-4 mt-4 md:grid-cols-4">

            <x-input-text name="facebook_link" :value="$person->facebook_link" label="Facebook Link" />
            <x-input-text name="twitter_link" :value="$person->twitter_link" label="Twitter Link" />
            <x-input-text name="instagram_link" :value="$person->instagram_link" label="Instagram Link" />
            <x-input-text name="linkedin_link" :value="$person->linkedin_link" label="Linkedin Link" />
            <x-input-text name="youtube_link" :value="$person->youtube_link" label="Youtube Link" />
            <x-input-text name="tiktok_link" :value="$person->tiktok_link" label="TikTok Link" />
            <x-input-text name="github_link" :value="$person->github_link" label="Github Link" />
 
        </div> 
 

        <x-button type="submit" label="BİLGİLERİ KAYDET" centered offset /> 

    </form>
</div>



@endsection
