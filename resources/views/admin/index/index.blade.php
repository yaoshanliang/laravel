@extends('admin.common.common')

@section('content')
    <div class="right_col" role="main">

        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>
                        系统首页
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
                            <div class="x_content">
                                <h4>实时数据:</h4>
                                <p class="font-gray-dark">
                                    当前系统时间: <label id="time">loading</label><br>
                                </p>
                                <br/><br/>

                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-body">

                        </div>
                    </div>

                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-6 -->
        </div>
    </div>

@endsection