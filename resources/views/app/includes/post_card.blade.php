<div>
    <a href="{{route('post',$post)}}" title="{{$post->title}}" class="relative block transition-all hover:scale-110">
        @if ($post->featured_image) 
        <img src="{{$post->featured_image->image}}" alt="{{$post->title}}" title="{{$post->title}}" width="{{$post->featured_image->width}}px" height="{{$post->featured_image->height}}px" loading="lazy" class="w-full rounded shadow ">
        @endif
        @if ($post->category != null)
            <div class="absolute px-2 py-1 text-xs text-white rounded top-1 right-1 bg-rose-500">
                {{$post->category->name}}
            </div>
        @endif
        <div class="absolute px-2 py-2 text-xs font-semibold text-center bg-white rounded bg-opacity-80 bottom-1 left-1 right-1">
            <h3 class="overflow-hidden whitespace-nowrap text-ellipsis">{{$post->title}}</h3>
        </div>
    </a>
</div>