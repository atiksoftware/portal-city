@props([
    'placeholder' => 'Aramak için buraya yazın',
    'value' => '',
])
<form action="" method="get" autocomplete="off"> 
    <input 
        type="text" 
        name="search" 
        class="w-full p-2 text-2xl font-bold text-center bg-transparent border-0 border-b border-dashed lg:text-4xl focus:ring-0 focus:outline-none"
        placeholder="{{$placeholder}}" 
        value="{{$value}}" 
        autocomplete="off"
    > 
</form>