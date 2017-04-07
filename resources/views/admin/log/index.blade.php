@extends('admin.common.common')

@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>
                        日志
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
                            <div class="dataTable_wrapper">
                                <br />

                                <div class="input-group custom-search-form">
                                    <input type="text" id="search" class="form-control search" placeholder="">
                                    <span class="input-group-btn">
                                            <button class="btn btn-default" type="button">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </span>
                                </div>

                                <table id="admin_index" class="table table-striped table-bordered table-hover datatable-example" style="width:100%;" border="0px">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>来源</th>
                                        <th>用户ID</th>
                                        <th>请求方式</th>
                                        <th>请求地址</th>
                                        <th>请求参数</th>
                                        <th>返回码</th>
                                        <th>返回消息</th>
                                        <th>返回数据</th>
                                        <th>用户IP</th>
                                        <th>创建时间</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                    </div>

                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-6 -->
        </div>

        <script src="{{ asset('admin-assets/vendor/jsonview/jsonview.js') }}"></script>
        <link href="{{ asset('admin-assets/vendor/jsonview/jsonview.css') }}" rel="stylesheet">
        <script>
            var datatable_id = 'admin_index';
            var columnDefsTargets = [];
            var invisibleColumns = [];
            var order = [0, 'desc'];
            var ajaxUrl = site_url + '/admin/log/lists';
            var columns = [
                {"data": "id"},
                {"data": "guard"},
                {"data": "user_id"},
                {"data": "request_method"},
                {"data": "request_url"},
                {
                    "data": "request_params",
                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                        // $(nTd).html(sData.replace(/,/g, ', '));
                        if (((sData != '' ) && (sData.indexOf("\"") != 0))) {
                            $(nTd).JSONView(sData, { collapsed: true });
                        }
                    }
                },
                {"data": "response_code"},
                {"data": "response_message"},
                {
                    "data": "response_data",
                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                        // console.log(sData.indexOf("\""));
                        if (((sData != '' ) && (sData.indexOf("\"") != 0))) {
                            $(nTd).JSONView(sData.replace(/#/g, '# '), { collapsed: true });
                        }

                        // $(nTd).html(sData.replace(/,/g, ', ').replace(/#/g, '# '));
                        // $(nTd).JSONView(sData.replace(/,/g, ', ').replace(/#/g, '# '));
                    }
                },
                {"data": "user_ip"},
                {"data": "created_at"},
                {
                    "data": "id",
                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                        html = "<a href='javascript:void(0);' onclick='return editUserModal(" + JSON.stringify(oData) + ");'>修改</a> ";
                        html += "<a href='javascript:void(0);' onclick='return alertModal(deleteUser,{id:" + sData + "});'>删除</a> ";
                        $(nTd).html(html);
                    }
                }];
    </script>

@endsection