@props([ 
    'name' => '',
    'value' => '',
    'placeholder' => '',
    'slug' => '',

    'button_label' => '',
    'button_name' => '',
    'button_value' => '',
])


<div class="flex flex-col w-full md:flex-row">

    <div class="flex-1 order-last mt-4 md:order-none md:mt-0">
        <input 
            type="text" 
            name="{{$name}}" 
            class="w-full p-2 text-4xl font-bold leading-normal border-0 focus:ring-0 focus:outline-none"
            placeholder="{{$placeholder}}" 
            value="{{ $value }}"
            autocomplete="off"
        />
        
        @if ($slug != null)
            <div class="px-2 text-xs text-slate-400 md:text-sm">{{ $slug }}</div>
        @endif
    </div>

    
    @if ($button_label)
        <div class="">
            <x-button :label="$button_label" icon="floppy-disk" size="sm" centered :name="$button_name" :value="$button_value"/>
        </div>
    @endif
</div>

