<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>LiDoris Blog</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="{{ asset('css/customer.css') }}" rel="stylesheet">
    <link href="{{ asset('css/clean-blog.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href='{{ asset('css/latin.css') }}' rel='stylesheet' type='text/css'>
    <link href='{{ asset('css/lato.css') }}' rel='stylesheet' type='text/css'>
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href='{{ asset('css/lora.css') }}' rel='stylesheet' type='text/css'>
    <link href='{{ asset('css/open.css') }}' rel='stylesheet' type='text/css'>

    <!-- Favicons -->
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('img/apple-touch-icon.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('img/apple-touch-icon-72.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('img/apple-touch-icon-114.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('img/apple-touch-icon-144.png') }}">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->


    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="{{ asset('js/html5shiv.js') }}"></script>
    <script src="{{ asset('js/respond.min.js') }}"></script>
    <![endif]-->

</head>

<body>

@include('themes.clean-blog.includes.navbar')

<!-- Page Header -->
@yield("header")

<!-- Main Content -->
<div class="container">
    <div class="row">
        @yield("content")
        @section('sidebar')

        @show
    </div>
</div>

@include('themes.clean-blog.includes.footer')
@include('themes.clean-blog.includes.scripts')


</body>

</html>
