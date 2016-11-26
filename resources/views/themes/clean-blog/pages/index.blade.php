@extends('themes.clean-blog.layouts.default')

@section("header")
    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('img/home-bg.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1>Vuedo</h1>
                        <hr class="small">
                        <span class="subheading">A Clean Blog Theme by Start Bootstrap</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection

@section('content')
    <div class="posts-block col-lg-8 col-md-8 col-sm-8 col-xs-12">
            @include('themes.clean-blog.partials.posts-list', $posts)
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="sidebar boxed">
            <div class="row" style="margin-top: 30px;">
                <div class="col-xs-10  col-xs-offset-1">
                    <div class="widget featured">
                        <h6 class="title">Contact Us</h6>
                        <div class="featured-introduce">
                            <h5>Have you created or seen something awesome related to PHP or Java? Submit it here to
                                share it with us!</h5>
                            <a href="" class="btn btn-default btn-default--transparent"
                               style="border-radius: 4px; font-size: 14px;font-weight: 400;padding: 8px 16px;">
                                Submit Yours
                                <i class="fa fa-pencil-square-o"></i>
                            </a>
                        </div>
                    </div>
                    <div class="widget category">
                        <h6 class="title">Category</h6>
                        <ul class="category-list slide">
                            @foreach(\App\Category::all() as $category)
                                <li>
                                    <a href="{{route('web.category', $category->name)}}">{{$category->name}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection