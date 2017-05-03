@extends('admin.common.common')

@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>
                        组件示例
                    </h3>
                </div>
            </div>
            <div class="clearfix"></div>

            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            Tip: 后台大部分组件参考:<a target="_blank" href="https://colorlib.com/polygon/gentelella/index.html">gentelella</a>,额外组件示例如下:
                        </div>
                    </div>
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>富文本编辑器 <small><a target="_blank" href="http://ueditor.baidu.com/website/onlinedemo.html">UEditor</a></small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Settings 1</a>
                                        </li>
                                        <li><a href="#">Settings 2</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br>
                            <!-- 加载编辑器的容器 -->
                            <script id="container" name="content" type="text/plain" style="width:1024px;height:300px;">这里写你的初始化内容</script>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col-lg-6 -->
        </div>

    </div>

    <!-- 配置文件 -->
    <script type="text/javascript" src="{{ asset('admin-assets/vendor/ueditor/ueditor.config.js') }}"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="{{ asset('admin-assets/vendor/ueditor/ueditor.all.min.js') }}"></script>
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('container');
    </script>
@endsection