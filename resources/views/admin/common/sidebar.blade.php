<div class="col-md-3 left_col menu_fixed">
    <div class="left_col scroll-view">

        <div class="navbar nav_title">
            <a href="{{ url('') }}" class="site_title">{{ config('project.admin_name') }}</a>
        </div>

        <div class="clearfix"></div>
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

            <div class="menu_section">
                <ul class="nav side-menu">
                    <li><a href="{{ url('admin/index') }}"><i class="fa fa-home"></i>系统首页</a></li>
                    <li><a href="{{ url('admin/user') }}"><i class="fa fa-user"></i>前台用户</a></li>
                    <li>
                        <a><i class="fa fa-user-plus"></i>后台账户<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            @if (hasAdminPermission('getAdminAccount'))
                                <li><a href="{{ url('admin/admin/account') }}">账户</a></li>
                            @endif
                            @if (hasAdminPermission('getAdminRole'))
                                <li><a href="{{ url('admin/admin/role') }}">角色</a></li>
                            @endif
                        </ul>
                    </li>
                    <li>
                        <a><i class="fa fa-gear"></i>系统管理<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ url('admin/system/log/user') }}">用户日志</a></li>
                            <li><a href="{{ url('admin/system/log/error') }}">系统日志</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>