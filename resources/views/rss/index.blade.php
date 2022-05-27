<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0" 
    xmlns:media="http://search.yahoo.com/mrss/" 
    xmlns:fn="http://www.w3.org/2004/10/xpath-functions"
    xmlns:atom="http://www.w3.org/2005/Atom" 
    xmlns:y="http://www.yahoo.com/y-namespace"
	xmlns:dc="http://purl.org/dc/elements/1.1/">
    <channel>
        <title>{{\App\Models\Settings::get('SITE_NAME')}}</title>
        <link>{{url('/')}}</link>
        <description>{{\App\Models\Settings::get('SITE_DESCRIPTION')}}</description>
        <language>{{config('app.locale')}}</language>
        <atom:link xmlns:atom="http://www.w3.org/2005/Atom" href="{{url()->current()}}" rel="self" type="application/rss+xml" />
        <copyright>{{__('app.copyright')}}</copyright>
        <category>News</category>
        @if (count($posts) > 0)
        <lastBuildDate>{{$posts[0]->updated_at->toRfc822String()}}</lastBuildDate>
        @endif
        <ttl>1</ttl>
        <generator>{{\App\Models\Settings::get('SITE_NAME')}}</generator>
        <image>
            <title>{{\App\Models\Settings::get('SITE_NAME')}}</title>
            <link>{{url('/')}}</link>
            <url>{{url('/storage/defaults/app_logo.svg')}}</url>
            <width>579</width>
            <height>130</height>
        </image>
        @foreach ($posts as $post)
        <item>
            <post-id>{{$post->id}}</post-id>
            <title><![CDATA[{{$post->title}}]]></title>
            <description><![CDATA[{{$post->summary}}]]></description>
            <link>{{$post->public_link}}</link>
            <guid>{{$post->public_link}}</guid>
            <pubDate>{{$post->updated_at->toRfc822String()}}</pubDate>
            @if ($post->featured_image)
                <image>{{$post->featured_image->image}}</image>
                <media:content url="{{$post->featured_image->image}}" type="image/webp" medium="image" />
                <media:thumbnail url="{{$post->featured_image->image}}" />
                <enclosure url="{{$post->featured_image->image}}" length="50000" type="image/webp" /> 
            @endif
            @if ($post->user)
            <dc:creator><![CDATA[{{$post->user->fullname}}]]></dc:creator>
            @endif
            @if ($post->category)
            <category><![CDATA[{{$post->category->name}}]]></category>
            @endif
        </item>
        @endforeach
    </channel>
</rss>
