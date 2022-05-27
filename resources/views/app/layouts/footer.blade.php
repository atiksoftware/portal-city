<div class="max-w-screen-xl mx-auto mb-10 sm:mt-4">
    <div>
        @include('app.includes.persons_slider')
    </div>
</div>


<div class="p-2 text-white bg-gray-700 md:p-4">
    <img src="{{url('/storage/defaults/app_logo.svg')}}" alt="{{\App\Models\Settings::get('SITE_NAME')}}" class="h-16 mx-auto my-4 ">

    <div class="max-w-screen-xl mx-auto mb-10 text-sm sm:mt-4 md:text-base">
        <div class="grid gap-4 md:grid-cols-3"> 
            <div>
                <div class="font-bold text-center uppercase text-amber-400">
                    {{__('app.contact_informations')}}
                </div>
                <div class="mt-4 text-center">
                    <div>{{__('app.phone')}}: <a href="tel:{{App\Models\Settings::get('CONTACT_PHONE')}}" title="{{__('contact_phone_title')}}">{{App\Models\Settings::get('CONTACT_PHONE')}}</a></div>
                    <div>{{__('app.email')}}: <a href="mailto:{{App\Models\Settings::get('CONTACT_EMAIL')}}" title="{{__('contact_phone_title')}}">{{App\Models\Settings::get('CONTACT_EMAIL')}}</a></div>
                </div>
            </div>

            <div>
                <div class="font-bold text-center uppercase text-amber-400">
                    {{__('app.sitemap')}}
                </div>
                <div class="grid grid-cols-3 mt-4">
                    @foreach (\App\Models\District::all() as $district)
                    <a 
                    href="{{ route('posts.by_district',$district) }}"
                    title="{{$district->name}}"
                    class="block py-1 text-center uppercase hover:text-amber-400" >{{$district->name}}</a>
                    @endforeach
                </div>
            </div>

            <div>
                <div class="font-bold text-center uppercase text-amber-400">
                    {{__('app.categories')}}
                </div>
                <div class="grid grid-cols-3 mt-4">
                    @foreach (\App\Models\Category::where('type_id',1)->get() as $category)
                    <div class="ml-6">
                        <a 
                            href="{{ route('posts.by_category',$category) }}"
                            title="{{$category->name}}"
                            class="block py-1 text-center uppercase hover:text-amber-400"
                        >{{$category->name}}</a>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
        <div class="mt-6 text-center text-amber-400">
            {!!__('app.footnote',[
                'email' => '<a href="mailto:'.App\Models\Settings::get('CONTACT_EMAIL').'" title="'.__('contact_phone_title').'" class="text-lg font-semibold">'.App\Models\Settings::get('CONTACT_EMAIL').'</a> '
            ])!!} 
        </div>
    </div>
</div>

<div class="p-2 md:p-4">
    <div class="grid md:grid-cols-3">
        <div>
            
        </div>
        <div class="text-center">
            {{__('app.copyright')}} 
        </div>
        <div class="text-right">
            <a href="https://ajans360.com" rel="muse" title="Ajans360" target="_blank" class="inline-block ml-auto ">
                <img src="{{url('/storage/defaults/360.svg')}}" alt="Ajans360" class="h-5 " title="Ajans360"> 
            </a> 
        </div>
    </div>
</div>