<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('project.name') }}{{ config('project.admin_name') }}</title>

    <link rel="stylesheet" href="{{ asset('admin-assets/css/lib.css') }}">
    <link rel="stylesheet" href="{{ asset(elixir('admin-assets/css/admin.css')) }}">
</head>

<body class="login">
    <div>
        @yield('content')
    </div>
</body>
<script src="{{ asset('admin-assets/js/lib.js') }}"></script>
</html>
