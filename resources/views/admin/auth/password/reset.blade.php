@extends('admin.auth.common.common')

@section('content')
    <div class="login">
        <div>
            <div class="login_wrapper">
                <div class="animate form login_form">
                    <section class="login_content">
                        <form method="put" action="{{ url('/admin/auth/password/reset') }}">
                            {{ csrf_field() }}
                            <h1>重置密码</h1>

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

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div>
                                <input type="text" class="form-control" placeholder="邮箱" required="required" name="email" value="{{ $email }}">
                            </div>

                            <div>
                                <input type="text" class="form-control" placeholder="密码" required="required" name="password">
                            </div>

                            <div>
                                <input type="text" class="form-control" placeholder="确认密码" required="required" name="password_confirmed">
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