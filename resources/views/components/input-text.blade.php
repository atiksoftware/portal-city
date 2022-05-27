@props([
    'type' => 'text',
    'name' => '',
    'value' => '',
    'label' => '',
    'placeholder' => '',
    'autocomplete' => true,
    'maxlength' => '',
    'readonly' => false,
])


<div>
    @if ($label != '')
    <label class="text-sm font-semibold text-gray-500">{{$label}}</label>
    @endif
    <input 
    type="{{$type}}" 
    class="block w-full border-gray-300 rounded" 
    placeholder="{{$placeholder}}" 
    name="{{$name}}" 
    value="{{$value}}"
    @if (!$autocomplete)
        autocomplete="off" 
    @endif
    @if ($maxlength)
        maxlength="{{$maxlength}}" 
    @endif
    @if ($readonly)
        readonly
    @endif
    >
</div> 