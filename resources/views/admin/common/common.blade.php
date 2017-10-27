<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('project.name') }}{{ config('project.admin_name') }}</title>

    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/layui/css/layui.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/css/admin.css') }}">

    {{--<script src="{{ asset('admin-assets/js/lib.js') }}"></script>--}}

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script>
        siteUrl = '<?php echo url(''); ?>';
        siteName = '{{ config('project.name') }}';
    </script>
</head>
<body class="layui-layout-body">
    <div class="layui-layout layui-layout-admin">
        @include('admin.common.navbar')
        @include('admin.common.sidebar')

        <div class="layui-body">
            @yield('content')
        </div>

        @include('admin.common.footer')
    </div>
</body>
<script src="{{ asset('admin-assets/vendor/layui/layui.all.js') }}"></script>
<script src="{{ asset('admin-assets/js/admin.js') }}"></script>
</html>