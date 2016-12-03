@extends('themes.clean-blog.layouts.default')

@section('header')
    <header class="intro-header" style="background-image: url({{ $post->image_url or 'http://lorempixel.com/400/200'}})">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="post-heading">
                        <h1>{{$post->title}}</h1>
                        <h2 class="subheading">{{$post->description}}</h2>
                        <span class="meta">Posted by <a href="#">{{$post->owner->name}}</a> {{$post->moderated_at->diffForHumans()}}</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

@endsection

@section('content')
    <!-- Post Content -->
    <article>
        <div class="container">
            <div class="row">
                <div class=" col-lg-8  col-md-8 col-sm-8 col-xs-12">
                    <div class="artbox" style="padding: 30px;">
                        {!! ParsedownExtra::instance()->parse($post->content) !!}
                        <hr />
                        @include('themes.clean-blog.partials.comment')
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    @include('themes.clean-blog.partials.sidebar-list')
                </div>
            </div>
        </div>
    </article>
@endsection