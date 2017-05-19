@extends('admin.auth.common.common')

@section('content')
    <div class="login">
        <div>
            <div class="login_wrapper">
                <div class="animate form login_form">
                    <section class="login_content">
                        <form class="form-horizontal" method="post" action="{{ url('/admin/auth/login') }}">
                            {{ csrf_field() }}
                            <h3>{{ config('project.name') }}{{ config('project.admin_name') }}</h3><br/><br/>
                            <div class="x_panel"><br/><br/>
                                @include('admin.components.tip')

                                <div class="form-group">
                                    <label class="control-label col-md-3">账号:</label>
                                    <div class="col-md-7">
                                        <input type="text" name="account" class="form-control" value="{{ old('account') }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">密码:</label>
                                    <div class="col-md-7">
                                        <input type="password" name="password" class="form-control" value="{{ old('password') }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">验证码: <span class="required"></span></label>
                                    <div class="col-md-4">
                                        <input type="text" name="captcha" class="form-control"value="">
                                    </div>
                                    <div class="col-md-3">
                                        <img id="captcha" class="captcha" src="<?php echo $builder->inline(); ?>" onclick="regenerateCaptcha();"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3"></label>
                                    <div class="col-md-7">
                                        <button type="submit" class="btn btn-primary btn-block">登录</button>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3"></label>
                                    <div class="col-md-7">
                                        <a class="reset_pass" href="{{ url('/admin/auth/password/email') }}">忘记密码</a>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </form>

                    </section>
                </div>

            </div>
        </div>
    </div>
    <script>
        function regenerateCaptcha() {
            $.ajax({
                url: siteUrl + '/admin/auth/captcha',
                type: 'GET',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $("#captcha").attr("src", data);
                    $("input[name=captcha]").val('');
                }
            });
        }
    </script>
@endsection