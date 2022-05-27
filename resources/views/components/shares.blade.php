<div class="flex items-center ml-auto">
    <span >Paylaş</span>

    @foreach (App\Helpers\ShareHelper::getItems() as $item)
        <a 
            href=""
            title="{{$item['title']}}"
            class="flex items-center justify-center ml-1 rounded text-slate-600 hover:text-white w-7 h-7 bg-amber-400 hover:bg-rose-400"
        >
            <x-icon :name="$item['icon']" class="w-5 h-5 " /> 
        </a>
    @endforeach
 
</div>