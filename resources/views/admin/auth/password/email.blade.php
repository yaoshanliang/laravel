@extends('admin.auth.common.common')

@section('content')
    <div class="login">
        <div>
            <div class="login_wrapper">
                <div class="animate form login_form">
                    <section class="login_content">
                        <form method="post" action="{{ url('/admin/auth/password') }}">
                            {{ csrf_field() }}
                            <h1>忘记密码</h1>

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

                            <div>
                                <input type="text" class="form-control" placeholder="邮箱" required="required" name="email">
                            </div>
                            <div>
                                <button type="submit" class="btn btn-default">发送验证邮件</button>
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