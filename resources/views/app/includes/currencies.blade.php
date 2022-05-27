<div class="flex items-center flex-1 space-x-6 md:flex-none" id="currencies">
    @foreach (App\Models\Currency::getAll() as $currency)
    <div class=" @if(!$loop->first) hidden md:block @endif" data-currency="{{$currency->code}}">
        <div class="flex items-center">

            <div class="flex items-center justify-center w-8 h-8 text-gray-500">
                <x-icon :name="$currency->code" class="w-7 h-7"/>
            </div>  
        
            <div class="ml-2">
                <div class="flex items-center">
                    
                    <span class="text-xs">{{$currency->name}}</span>
        
                    <x-icon name="caret-up" class="hidden h-4 ml-1 text-emerald-500" data-property="caret_up"/>
                    <x-icon name="caret-down" class="hidden h-4 ml-1 text-rose-500" data-property="caret_down"/>
          
                    
                </div>
                <div class="text-sm font-bold" data-property="value">{{number_format($currency->price, 2, ",", ".")}}</div>
            </div>
        </div>
    </div>
    @endforeach 
</div>