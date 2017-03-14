@extends('admin.auth.common.common')

@section('content')
    <div class="login">
        <div>
            <div class="login_wrapper">
                <div class="animate form login_form">
                    <section class="login_content">
                        <form method="post" action="{{ url('/admin/auth/password/reset') }}">
                            {{ csrf_field() }}
                            <h1>重置密码</h1>

                            @include('admin.components.tip')

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div>
                                <input type="text" class="form-control" placeholder="邮箱" required="required" name="email" value="{{ $email }}" readonly>
                            </div>

                            <div>
                                <input type="password" class="form-control" placeholder="新密码" required="required" name="password">
                            </div>

                            <div>
                                <input type="password" class="form-control" placeholder="确认密码" required="required" name="password_confirmation">
                            </div>

                            <div>
                                <button type="submit" class="btn btn-default">确认重置</button>
                                <a class="reset_pass" href="{{ url('/admin/auth/login') }}">返回登录</a>
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