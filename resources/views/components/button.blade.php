@props([
    'type' => 'submit',
    'name' => 'submit',
    'value' => 'submit',
    'label' => 'Press',
    'color' => 'primary',
    'size' => 'md',
    'centered' => false,
    'block' => false,
    'uppercase' => true,
    'rounded' => true,
    'offset' => false,
    'icon' => '',
    'icon_class' => 'h-5 mr-4', 
])
 
 
    <button type="submit"
        name="{{$name}}"
        value="{{$value}}"
        class="
        @if ($color == 'primary')
        text-white bg-blue-600 hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800
        @endif
        @if ($color == 'danger')
        text-white bg-rose-600 hover:bg-rose-700 focus:bg-rose-700 active:bg-rose-800
        @endif
        @if ($color == 'success')
        text-white bg-emerald-600 hover:bg-emerald-700 focus:bg-emerald-700 active:bg-emerald-800
        @endif

        @if ($block )
        w-full
        @endif

        @if ($size == 'xs' )
        px-4 py-2 text-xs
        @endif
        @if ($size == 'sm' )
        px-6 py-3 text-xs
        @endif
        @if ($size == 'md' )
        px-8 py-4 text-xs
        @endif
        @if ($size == 'lg' )
        px-10 py-5 text-xs
        @endif

        @if ($uppercase  )
        uppercase
        @endif

        @if ($rounded  )
        rounded
        @endif
        @if ($centered  )
        mx-auto
        @endif
        @if ($offset  )
        mt-8
        @endif
        
        flex items-center justify-center font-medium leading-tight transition duration-150 ease-in-out   shadow-md   hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg">

        @if ($icon)
        <x-icon :name="$icon" :class="$icon_class" />
        @endif

        <span>{{ $label }}</span>
    </button> 