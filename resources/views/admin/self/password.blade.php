@extends('admin.common.common')

@section('content')
    <fieldset class="layui-elem-field layui-field-title">
        <legend>修改密码</legend>
    </fieldset>
    <form class="layui-form" method="post" action="{{ url('/admin/self/password') }}">

        {{ csrf_field() }}

        <div class="layui-form-item">
            <label class="layui-form-label">密码</label>
            <div class="layui-col-md4">
                <input type="password" class="layui-input" name="password">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">确认密码</label>
            <div class="layui-col-md4">
                <input type="password" class="layui-input" name="password_confirmation">
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
@endsection