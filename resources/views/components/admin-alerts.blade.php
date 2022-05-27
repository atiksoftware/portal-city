
@if(count($errors) > 0 )
<div class="container grid grid-cols-1 mx-auto mt-2 mb-10 sm:mt-4">
    @foreach($errors->all() as $error)
    <div class="flex items-center p-2 text-white bg-rose-500">
        <svg class="h-4" viewBox="0 0 24 24">
            <path fill="currentColor" d="M13,13H11V7H13M13,17H11V15H13M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z" />
        </svg>
        <div class="inline-block ml-2 text-sm align-middle">
            {{$error}}
        </div> 
    </div>
    @endforeach 
</div>
@endif


@foreach (\App\Helpers\ToastHelper::get() as $toast)
<div class="hidden toast" data-type="{{$toast['type']}}" data-message="{{$toast['text']}}" ></div> 
@endforeach  