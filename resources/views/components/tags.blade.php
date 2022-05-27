@props([
    'routename' => '',
    'tags' => [],
]) 


<div class="text-sm">
    <span class="font-semibold">{{__('app.tags')}}:</span>
    @foreach ($tags as $tag) 
        <a href="{{route($routename, $tag)}}" class="inline-block px-3 py-1 mb-1 text-xs rounded bg-slate-200 hover:bg-slate-300">{{$tag->name}}</a>
    @endforeach
</div>