<nav class="hidden border-b border-slate-100 md:block">
    <div class="max-w-screen-xl mx-auto">
        <div class="flex justify-between w-full text-xs font-semibold text-gray-500 uppercase"> 
            @foreach (\App\Models\District::all() as $district)
            <div class="">
                <a 
                href="{{ route('posts.by_district',$district) }}"
                title="{{$district->name}}"
                hreflang="{{app()->getLocale()}}"
                class="block py-1 hover:text-gray-700" >{{$district->name}}</a>
            </div>
            @endforeach
        </div>
    </div>
</nav>