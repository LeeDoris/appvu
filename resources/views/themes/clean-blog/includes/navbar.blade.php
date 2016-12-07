<!-- Navigation -->
<nav class="navbar navbar-default navbar-custom navbar-fixed-top">
    <div class="cd-main-header container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                Menu <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" style="font-size: 24px;" href="{{route('web.home')}}">LiDoris</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="cd-main-nav-wrapper collapse navbar-collapse">
            <ul class=" nav navbar-nav navbar-left">
                @foreach(\App\Category::all() as $category)
                    <li>
                        <a href="{{route('web.category', $category->name)}}">{{$category->name}}</a>
                    </li>
                @endforeach
                <li>
                    <a href="/{{ Config::get('chatter.routes.home') }}">Forums &nbsp;<i class="fa fa-comments"></i></a>
                </li>
                <li>
                    <a href="">SUBMIT YOURS &nbsp;<i class="fa fa-pencil-square-o"></i></a>
                </li>
            </ul>
            <ul class="cd-main-nav nav navbar-nav navbar-right menu">
                <li>
                    <a href="#search" class="cd-search-trigger cd-text-replace"><i class="fa fa-search"></i></a>
                </li>
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">LOGIN &nbsp;<i class="fa fa-sign-in"></i></a></li>
                    <li><a href="{{ url('/register') }}">Register <i class="fa fa-btn fa-user"></i></a></li>
                @else
                    <li class="dropdown" id="nav-mark-btn" >
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" id="mark-info" style="padding: 0px">
                            <li><a href="{{ url('/dashboard/home') }}">Dashboard <i class="fa fa-dashboard"></i> </a> </li>
                            <li><a href="{{ url('/logout') }}">Logout &nbsp;<i class="fa fa-btn fa-sign-out"></i></a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
        <a href="#0" class="cd-nav-trigger cd-text-replace"></a>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
<div id="search" class="cd-main-search">
    <form>
        <input type="search" placeholder="Search...">

        {{--<div class="cd-select">--}}
            {{--<span>in</span>--}}
            {{--<select name="select-category">--}}
                {{--<option value="all-categories">all Categories</option>--}}
                {{--<option value="category1">Category 1</option>--}}
                {{--<option value="category2">Category 2</option>--}}
                {{--<option value="category3">Category 3</option>--}}
            {{--</select>--}}
            {{--<span class="selected-value">all Categories</span>--}}
        {{--</div>--}}
    </form>

    <div class="cd-search-suggestions">
        <div class="news">
            {{--<h3>News</h3>--}}
            <ul>
                <li>
                    <a class="image-wrapper" href="#0"><img src="img/placeholder.png" alt="News image"></a>
                    <h4><a class="cd-nowrap" href="#0">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</a></h4>
                    <time datetime="2016-01-12">Feb 03, 2016</time>
                </li>

                <li>
                    <a class="image-wrapper" href="#0"><img src="img/placeholder.png" alt="News image"></a>
                    <h4><a class="cd-nowrap" href="#0">Incidunt voluptatem adipisci voluptates fugit beatae culpa eum, distinctio, assumenda est ad</a></h4>
                    <time datetime="2016-01-12">Jan 28, 2016</time>
                </li>

                <li>
                    <a class="image-wrapper" href="#0"><img src="img/placeholder.png" alt="News image"></a>
                    <h4><a class="cd-nowrap" href="#0">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, esse.</a></h4>
                    <time datetime="2016-01-12">Jan 12, 2016</time>
                </li>
            </ul>
        </div> <!-- .news -->

        {{--<div class="quick-links">--}}
            {{--<h3>Quick Links</h3>--}}
            {{--<ul>--}}
                {{--<li><a href="#0">Find a store</a></li>--}}
                {{--<li><a href="#0">Accessories</a></li>--}}
                {{--<li><a href="#0">Warranty info</a></li>--}}
                {{--<li><a href="#0">Support</a></li>--}}
                {{--<li><a href="#0">Contact us</a></li>--}}
            {{--</ul>--}}
        {{--</div> <!-- .quick-links -->--}}
    </div> <!-- .cd-search-suggestions -->

    <a href="#0" class="close cd-text-replace">Close Form</a>
</div>
<div class="cd-cover-layer"></div>
