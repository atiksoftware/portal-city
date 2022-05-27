

<div class="relative rounded-b bg-slate-100"> 
    <div class="p-2 font-semibold text-center rounded-t bg-amber-400">
        {{__('app.businesses.widget_title')}}
    </div>
    
    <div class="grid grid-cols-1 divide-y divide-dashed">  
        @foreach (\App\Models\Business::inRandomOrder()->limit(7)->with(['cover_images','profile_images'])->get() as $business)
            <div class="flex w-full p-2 ">
                <div class="w-16">
                    <a href="{{$business->public_link}}" title="{{$business->name}}">
                        @if ($business->cover_images->count() > 0)
                            <img src="{{$business->cover_images->first()->image}}" alt="{{$business->name}}" class="object-cover w-16 h-12 rounded">
                        @else
                            <img src="{{$business->profile_image->image}}" alt="{{$business->name}}" class="object-cover w-16 h-12 rounded">
                        @endif
                    </a>
                </div>
                <div class="flex-1 min-w-0 ml-2">
                    <div class="w-full font-semibold text-rose-500">
                        <a 
                            href="{{$business->public_link}}" 
                            title="{{$business->name}}"
                            class="block overflow-hidden whitespace-nowrap text-ellipsis">
                            {{$business->name}}
                        </a>
                    </div>
                    <div class="overflow-hidden text-xs whitespace-nowrap text-ellipsis ">{{$business->address}}</div>
                </div>
            </div>
        @endforeach  
    </div>
  
    <div class="p-2">
        <a href="{{route('businesses')}}" title="{{__('app.view_all')}}" class="relative block py-2 text-sm font-semibold text-center rounded bg-amber-400">{{__('app.view_all')}}</a>
    </div>
</div>

 