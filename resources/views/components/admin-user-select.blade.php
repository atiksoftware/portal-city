@props([
    'label' => '',
    'name' => '',
    'value' => '',
    'placeholder' => 'Bir kullanıcı seçiniz',
])
 

<div class="relative selecting">
    <label class="text-sm font-semibold text-gray-500">{{$label}}</label>
    <input type="hidden" name="{{$name}}" value="{{$value}}" />

    <div class="w-full border border-gray-300 rounded min-h-[40px] cursor pointer flex items-center hover:bg-slate-100 cursor-pointer">
        <div class="flex-1 px-1">
            <div class="flex items-center">
                <img class="w-8 h-8 rounded opacity-0" src="" alt="">
                <div class="flex-1 mx-2">
                    <div class="text-xs font-semibold "></div>
                    <div class="text-xs leading-none text-slate-400"></div>
                </div>
            </div>
        </div>
        <div>
            <x-icon name="caret-down" class="w-4 h-4 mx-2 text-slate-500"/>
        </div>
    </div>

    <div style="display:none" class="absolute z-30 left-0 right-0 -translate-y-[2px] bg-white border border-t-0 border-gray-300 shadow-lg top-full">
        <div class="relative pb-0">
            {{-- <input type="text" name="" id="" class="w-full px-2 py-1 text-sm border-gray-300 focus:border-gray-500 focus:ring-0"> --}}
            <input type="text" name="listing-filter-input" placeholder="Buraya yazarak filtreleyin" class="w-full p-1 text-sm font-semibold border-0 border-b border-dashed focus:ring-0" autocomplete="off">

            <div class="absolute top-0 bottom-0 right-0 flex items-center hidden px-2 cursor-pointer text-slate-500 hover:text-slate-800">
                <x-icon name="xmark" class="w-4 h-4 "/>
            </div>
        </div>
        <div class="grid grid-cols-1 overflow-y-auto divide-y max-h-80">
            @foreach (App\Models\User::all() as $user) 
            <div class="px-1 py-1 cursor-pointer hover:bg-slate-200">
                <div class="flex items-center" data-value="{{$user->id}}">
                    <img class="w-8 h-8 rounded" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=2&amp;w=256&amp;h=256&amp;q=80" alt="">
                    <div class="flex-1 mx-2">
                        <div class="text-xs font-semibold ">{{$user->fullname}}</div>
                        <div class="text-xs leading-none text-slate-400">{{$user->email}}</div>
                    </div>
                </div>
            </div>
            @endforeach 
        </div>
    </div>
</div>