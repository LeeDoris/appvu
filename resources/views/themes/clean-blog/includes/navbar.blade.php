<!-- Navigation -->
<nav class="navbar navbar-default navbar-custom navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                Menu <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" style="font-size: 24px;" href="{{route('web.home')}}">LiDoris</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-left">
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
            <ul class="nav navbar-nav navbar-right menu">
                <li>
                    <a href=""><i class="fa fa-search"></i></a>
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
                            <li><a href="{{ url('/dashboard') }}">Dashboard <i class="fa fa-dashboard"></i> </a> </li>
                            <li><a href="{{ url('/logout') }}">Logout &nbsp;<i class="fa fa-btn fa-sign-out"></i></a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
