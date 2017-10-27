<div class="layui-header">
    <div class="layui-logo">{{ config('project.admin_name') }}</div>
    <ul class="layui-nav layui-layout-right">
        <li class="layui-nav-item">
            <a href="javascript:;">{{ auth('admin')->user()->role_name }}</a>
        </li>

        <li class="layui-nav-item">
            <a href="javascript:;">{{ auth('admin')->user()->account }}</a>
            <dl class="layui-nav-child">
                <dd><a href='{{ url('/admin/self/info') }}'><i class="pull-right"></i>个人信息</a></dd>
                <dd><a href='{{ url('/admin/self/password') }}'><i class="pull-right"></i>修改密码</a></dd>
                <dd><a href='{{ url('/admin/auth/logout') }}'><i class="fa fa-sign-out pull-right"></i>退出</a></dd>
            </dl>
        </li>
    </ul>
</div>
