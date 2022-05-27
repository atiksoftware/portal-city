@props([ 
    'label' => '', 
    'name' => '',
    'value' => '',
])


<div class="input-tags">
    @if ($label != '')
    <label class="text-sm font-semibold text-gray-500">{{$label}}</label>
    @endif

    <input name="{{$name}}" value="{{$value}}">
</div>