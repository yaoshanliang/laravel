<div class="col-md-3 left_col menu_fixed">
    <div class="left_col scroll-view">

        <div class="navbar nav_title" style="border: 0;">
            <a href="admin" class="site_title">后台管理系统</a>
        </div>

        <div class="clearfix"></div>
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

            <div class="menu_section">
                <ul class="nav side-menu">
                    <li><a href="{{ url('admin') }}"><i class="fa fa-home"></i>系统首页</a></li>
                    <li><a href="{{ url('admin/bulletin') }}"><i class="fa fa-bullhorn"></i>公告管理</a></li>
                    <li><a href="{{ url('admin/unit') }}"><i class="fa fa-bank"></i>单位管理</a></li>
                    <li><a href="{{ url('admin/user') }}"><i class="fa fa-user"></i>公务员管理</a></li>
                    <li><a href="{{ url('admin/course') }}"><i class="fa fa-film"></i>课程管理</a></li>
                    <li><a href="{{ url('admin/question') }}"><i class="fa fa-reorder"></i>题库管理</a></li>
                    <li><a href="{{ url('admin/exam') }}"><i class="fa fa-book"></i>考试管理</a></li>
                    <li><a href="{{ url('admin/rank/exam') }}"><i class="fa fa-search-minus"></i>成绩查看</a></li>
                    <li><a href="{{ url('admin/link') }}"><i class="fa fa-share-alt"></i>友情链接设置</a></li>
                    <li><a href="{{ url('admin/admin')}}"><i class="fa fa-user-plus"></i>管理员设置</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>