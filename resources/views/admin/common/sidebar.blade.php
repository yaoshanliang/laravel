<div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
        <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
        <ul class="layui-nav layui-nav-tree"  lay-filter="test">
            <li class="layui-nav-item"><a href="{{ url('admin/index') }}">系统首页</a></li>
            <li class="layui-nav-item"><a href="{{ url('admin/user') }}">前台用户</a></li>
            <li class="layui-nav-item"><a href="{{ url('admin/admin') }}">后台账户</a></li>
            <li class="layui-nav-item">
                <a class="" href="javascript:;">文件管理</a>
                <dl class="layui-nav-child">
                    <dd><a href="{{ url('admin/file/image') }}">图片</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item">
                <a href="javascript:;">系统管理</a>
                <dl class="layui-nav-child">
                    <dd><a href="{{ url('admin/system/log/user') }}">用户日志</a></dd>
                    <dd><a href="{{ url('admin/system/log/error') }}">系统日志</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item">
                <a href="javascript:;">组件管理</a>
                <dl class="layui-nav-child">
                    <dd><a href="{{ url('admin/example') }}">组件示例</a></dd>
                </dl>
            </li>
        </ul>
    </div>
</div>