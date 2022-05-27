@props([ 
    'name' => '',
    'value' => '',
    'label' => '',  
    'placeholder' => '',  
    'items' => [],

    'item_value' => '',
    'item_text' => '',
])


<div>
    @if ($label != '')
    <label class="text-sm font-semibold text-gray-500">{{$label}}</label>
    @endif 
 
    <select class="block w-full border-gray-300 rounded" 
    placeholder="{{$placeholder}}" 
    name="{{$name}}" 
    value="{{$value}}"
    >
    @foreach ($items as $item)
        <option  
            value="{{$item->$item_value}}"  
            @if ( $item->$item_value ==  $value) selected @endif
        >
        {{$item->$item_text}}
        </option>
    @endforeach 
    </select>
</div> 
 