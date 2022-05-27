

<div class="relative rounded-b bg-slate-100"> 
    <div class="p-2 font-bold text-center rounded-t bg-amber-400">
        SEKTÖRLER
    </div>
    
    <div class="">
        @foreach (\App\Models\Category::orderBy('name','ASC')->limit(10)->get() as $category)
            <div class="flex w-full px-2 py-1 ">
                <a href="{{route('businesses.by_categories',$category)}}" title="{{$category->name}}" class="flex items-center">  
                    <x-icon name="layer-group" class="w-3 h-3 mr-2"/>
                    <span>{{$category->name}}</span>
                </a>
            </div>
        @endforeach 
    </div>
  
    <div class="p-2">
        <a href="{{route('business_categories')}}" title="{{__('app.view_all')}}" 
        class="relative block py-2 text-sm font-semibold text-center rounded bg-amber-400">{{__('app.view_all')}}</a>
    </div>
</div>