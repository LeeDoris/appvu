@if( count($posts) == 0 )
    <div class="post-preview">
        <h2 class="post-title">
            Whoops, there are no posts here yet :/
        </h2>
    </div>
@endif
{{--@foreach($posts as $post)--}}
    {{--<div class="post-preview">--}}
        {{--<a href="{{route('web.post', $post->slug)}}">--}}
            {{--<h2 class="post-title">--}}
                {{--{{ $post->title }}--}}
            {{--</h2>--}}
            {{--<h3 class="post-subtitle">--}}
                {{--{{ $post->description }}--}}
            {{--</h3>--}}
        {{--</a>--}}
        {{--<p class="post-meta">Posted by <a href="#">{{$post->owner->name}}</a> {{$post->moderated_at->diffForHumans()}}</p>--}}
    {{--</div>--}}
    {{--<hr>--}}
{{--@endforeach--}}

@foreach($posts as $post)
<article class="clearfix blogpost object-non-visible">
    <div class="overlay-container">
        <img src="{{ $post->image_url or 'http://lorempixel.com/400/200'}}" alt="" width="748px" height="462" style="border-top-right-radius: 6px;
        border-top-left-radius: 6px;">
    </div>
    <div class="blogpost-body">
        <div class="post-info">
            <span class="day">{{ $post->created_at->format('d') }}</span>
            <span class="month">{{ $post->created_at->format('M Y') }}</span>
        </div>
        <div class="blogpost-content">
            <header>
                <h2 class="title"><a href="{{route('web.post', $post->slug)}}">{{ $post->title }}</a></h2>
                <div class="submitted"><i class="fa fa-user pr-5"></i> by <a href="javascript:;">{{$post->owner->name}}</a></div>
            </header>
            <p>{{ $post->description }}</p>
        </div>
    </div>
    <footer class="clearfix">
        <ul class="links pull-left">
            <li><i class="fa fa-comment-o pr-5"></i> <a href="{{route('web.post', $post->slug)}} #chatter">Comment</a> </li>
        </ul>
        <a class="pull-right link" href="{{route('web.post', $post->slug)}}"><span>Read more</span></a>
    </footer>
</article>
@endforeach


{{ $posts->render() }}