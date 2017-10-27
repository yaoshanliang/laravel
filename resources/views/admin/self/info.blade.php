@extends('admin.common.common')

@section('content')
    <fieldset class="layui-elem-field layui-field-title">
        <legend>个人信息</legend>
    </fieldset>
    <form class="layui-form" method="post" action="{{ url('/admin/self/info') }}">

        {{ csrf_field() }}

        <div class="layui-form-item">
            <label class="layui-form-label">账号</label>
            <div class="layui-col-md4">
                <input type="text" class="layui-input" name="account" value="{{ $info->account }}">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">姓名</label>
            <div class="layui-col-md4">
                <input type="text" class="layui-input" name="name" value="{{ $info->name }}">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">手机</label>
            <div class="layui-col-md4">
                <input type="text" class="layui-input" name="phone" value="{{ $info->phone }}">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">邮箱</label>
            <div class="layui-col-md4">
                <input type="text" class="layui-input" name="email" value="{{ $info->email }}">
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