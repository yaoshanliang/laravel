@extends('admin.auth.common.common')

@section('content')
    <div class="login">
        <div>
            <div class="login_wrapper">
                <div class="animate form login_form">
                    <section class="login_content">
                        <form method="post" action="{{ url('/admin/auth/login') }}">
                            {{ csrf_field() }}
                            <h1>{{ config('project.name') }}{{ config('project.admin_name') }}</h1>

                            @include('admin.components.tip')

                            <div>
                                <input type="text" class="form-control" placeholder="账号" required="required" name="account">
                            </div>
                            <div>
                                <input type="password" class="form-control" placeholder="密码" required="required" name="password">
                            </div>
                            <div>
                                <button type="submit" class="btn btn-default">登录</button>
                                <a class="reset_pass" href="{{ url('/admin/auth/password/email') }}">忘记密码</a>
                            </div>

                            <div class="clearfix"></div>

                            <div class="separator">

                            </div>
                        </form>
                    </section>
                </div>

            </div>
        </div>
    </div>
@endsection