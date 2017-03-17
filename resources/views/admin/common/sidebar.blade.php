<div class="col-md-3 left_col menu_fixed">
    <div class="left_col scroll-view">

        <div class="navbar nav_title">
            <a href="{{ url('') }}" class="site_title">{{ config('project.admin_name') }}</a>
        </div>

        <div class="clearfix"></div>
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

            <div class="menu_section">
                <ul class="nav side-menu">
                    <li><a href="{{ url('admin') }}"><i class="fa fa-home"></i>系统首页</a></li>
                    <li><a href="{{ url('admin/user') }}"><i class="fa fa-user"></i>用户</a></li>
                    <li><a href="{{ url('admin/admin') }}"><i class="fa fa-user-plus"></i>管理员</a></li>
                    <li><a href="{{ url('admin/adminrole') }}"><i class="fa fa-user-plus"></i>管理员角色</a></li>
                    <li><a href="{{ url('admin/log') }}"><i class="fa fa-file-o"></i>日志</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>