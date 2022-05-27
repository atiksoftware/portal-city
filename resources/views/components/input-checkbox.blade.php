@props([
    'name' => '',
    'value' => false,
    'label' => '',
    'checkbox_id' => 'checkbox-' . Str::random(10),
]) 
<div>
    <input 
        class="float-left w-4 h-4 mt-1 mr-2 align-top transition duration-200 bg-white bg-center bg-no-repeat bg-contain border border-gray-300 rounded-sm appearance-none cursor-pointer form-check-input checked:bg-blue-600 checked:border-blue-600 focus:outline-none" 
        type="checkbox" 
        name="{{$name}}"
        value="1" 
        id="{{$checkbox_id}}"  
        @if ($value) checked @endif 
        >
    <label class="inline-block text-gray-800 form-check-label" for="{{$checkbox_id}}">
        {{$label}}
    </label>
  </div>