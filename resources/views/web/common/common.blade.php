<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('project.name') }}{{ config('project.web_name') }}</title>


    <link rel="stylesheet" href="{{ asset('web-assets/css/lib.css') }}">
    <link rel="stylesheet" href="{{ asset('web-assets/css/web.css') }}">

    <script src="{{ asset('web-assets/js/lib.js') }}"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Scripts -->
    <script>
        siteUrl = '<?php echo url(''); ?>';
    </script>
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            @include('web.common.sidebar')
            @include('web.common.navbar')
            @yield('content')
        </div>
    </div>
</body>
<script src="{{ asset('web-assets/js/web.js') }}"></script>
</html>
