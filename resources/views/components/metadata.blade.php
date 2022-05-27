@props([ 
    'id' => null,
    'type' => 'website',
    'title' => '',
    'description' => '',
    'tags' => '',
    'category' => '',
    'author' => '',
    'image' => '',  
    'firstname' => '',
    'lastname' => '',
])

<meta property="og:url" content="{{url()->current()}}" />
<meta property="og:title" content="{{$title}}" />
<meta property="og:description" content="{{$description}}" />
<meta property="og:image" content="{{$image}}" />
<meta property="og:type" content="{{$type}}" />
@if ($type == 'profile')
<meta property="profile:first_name" content="{{$firstname}}">
<meta property="profile:last_name" content="{{$lastname}}">
@endif

<meta name="twitter:url" content="{{url()->current()}}" />
<meta name="twitter:title" content="{{$title}}" />
<meta name="twitter:description" content="{{$description}}" />
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="@{{\App\Models\Settings::get('TWITTER_USERNAME')}}" />
<meta name="twitter:creator" content="@{{\App\Models\Settings::get('TWITTER_USERNAME')}}" />
<meta name="twitter:image" content="{{$image}}" />

@if ($type == 'article')
<meta property="creators" content="{{$author}}" />
<meta property="article:id" content="{{$id}}" />
<meta property="article:author" content="{{$author}}" />
<meta property="article:section" content="{{$category}}" />
<meta property="article:section:type" content="Detail Page" />
<meta property="article:section:list" content="{{$category}}" />
<meta property="article:tag" content="{{implode(',',$tags)}}" />
@endif

<link rel="image_src" href="{{$image}}" />
<meta name="rating" content="general">
<meta name="copyright" content="{{__('app.copyright')}}">