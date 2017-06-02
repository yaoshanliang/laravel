<!DOCTYPE html>
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

    <script>
        siteUrl = '<?php echo url(''); ?>';
    </script>
</head>

<body class="login">
<div>
    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <form class="form-horizontal" method="POST" action="{{ url('/web/auth/login') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <h4>{{ config('project.name') }} {{ config('project.web_name') }}</h4><br/><br/>
                    <div class="x_panel"><br/><br/>
                        @if (count($errors) > 0)
                            <div class="alert alert-danger danger-warning">
                                <strong>Whoops!</strong> There were some problems with your input.
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">账号: <span class="required"></span></label>
                            <div class="col-md-7 col-sm-6 col-xs-12">
                                <input type="text" name="account" required="required" class="form-control col-md-7 col-xs-12" value="{{ old('account') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">密码: <span class="required"></span></label>
                            <div class="col-md-7 col-sm-6 col-xs-12">
                                <input type="password" name="password" required="required" class="form-control col-md-7 col-xs-12" value="{{ old('password') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"></label>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <button type="submit" class="btn btn-primary">登录</button>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
</body>
<script src="{{ asset('admin-assets/js/lib.js') }}"></script>
<script src="{{ asset(elixir('admin-assets/js/admin.js')) }}"></script>
</html>
