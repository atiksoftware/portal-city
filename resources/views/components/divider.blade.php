@props([
    'weight' => 2,
    'margin' => 6,
])


<div class="
@switch($weight) 
    @case(2)
        border-t-2
        @break 
    @default
    border-t-1
@endswitch
@switch($margin) 
    @case(6)
        my-6
        @break  
@endswitch
border-dashed "></div>