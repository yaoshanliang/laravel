<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('project.name') }}{{ config('project.admin_name') }}</title>


    <link rel="stylesheet" href="{{ asset('admin-assets/css/lib.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/css/admin.css') }}">

    <script src="{{ asset('admin-assets/js/lib.js') }}"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Scripts -->
    <script>
        siteUrl = '<?php echo url(''); ?>';
        siteName = '{{ config('project.name') }}';
    </script>
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            @include('admin.common.sidebar')
            @include('admin.common.navbar')
            @yield('content')

            @include('admin.components.alert')
        </div>
    </div>
</body>
<script src="{{ asset('admin-assets/js/admin.js') }}"></script>
</html>
