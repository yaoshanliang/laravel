<div class="top_nav">
    <div class="nav_menu">
        <nav>
            <div class="nav toggle">
                <a style="color:#5A738E" id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">

                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        {{ auth('admin')->user()->account }}
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li><a href='javascript:void(0);' onclick='return alertModal(confirmLogout, {}, "确定要退出登录?");'><i class="fa fa-sign-out pull-right"></i>退出</a></li>
                    </ul>
                </li>
                <li class="">
                    <a class="user-profile">
                        {{ auth('admin')->user()->role_name }}

                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>