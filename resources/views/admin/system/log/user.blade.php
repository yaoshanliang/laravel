@extends('admin.common.common')

@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>
                        用户日志
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
                                    <a id="refresh" href='javascript:void(0);' class="btn btn-outline btn-default" onclick='return refresh();'>刷新</a>

                                    <input type="text" id="search" class="form-control search" placeholder="来源/用户ID/请求方式/请求地址/请求参数/返回码/返回消息/返回数据/用户IP">
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
            var ajaxUrl = siteUrl + '/admin/system/log/user/lists';
            var columns = [
                {"data": "id"},
                {"data": "guard"},
                {"data": "user_id"},
                {"data": "request_method"},
                {"data": "request_url"},
                {
                    "data": "request_params",
                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
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
                        if (((sData != '' ) && (sData.indexOf("\"") != 0))) {
                            $(nTd).JSONView(sData.replace(/#/g, '# '), { collapsed: true });
                        }
                    }
                },
                {"data": "user_ip"},
                {"data": "created_at"},
                {
                    "data": "id",
                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                        html = "<a href='javascript:void(0);' onclick='return detailsModal(" + JSON.stringify(oData) + ");'>详细</a> ";
                        $(nTd).html(html);
                    }
                }];

            function detailsModal(data) {
                $('#details_modal_user_agent').text(data.user_agent);
                $('#details_modal_server_ip').text(data.server_ip);
                $('#details_modal_request_time_float').text(data.request_time_float);
                $('#details_modal_pushed_time_float').text(data.pushed_time_float);
                $('#details_modal_poped_time_float').text(data.poped_time_float);
                $('#details_modal_created_time_float').text(data.created_time_float);

                $("#details_modal").modal('show');
            }
    </script>

        <!-- Modal -->
        <div class="modal fade" id="details_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width:450px; margin-top:40px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h5 class="modal-title" id="modal_title">详细</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="col-md-3"><p>user agent</p></div>
                                    <div class="col-md-9">
                                        <p id="details_modal_user_agent"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="col-md-3"><p>服务器IP</p></div>
                                    <div class="col-md-9">
                                        <p id="details_modal_server_ip"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="col-md-3"><p>请求时间</p></div>
                                    <div class="col-md-9">
                                        <p id="details_modal_request_time_float"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="col-md-3"><p>响应时间</p></div>
                                    <div class="col-md-9">
                                        <p id="details_modal_pushed_time_float"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="col-md-3"><p>处理时间</p></div>
                                    <div class="col-md-9">
                                        <p id="details_modal_poped_time_float"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="col-md-3"><p>写库时间</p></div>
                                    <div class="col-md-9">
                                        <p id="details_modal_created_time_float"></p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <div class="col-md-5 col-md-offset-3">
                                <button type="button" class="btn btn-default btn-block" data-dismiss="modal">关闭</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <script>
            function refresh() {
                table.draw();
            }
            $('.btn-outline').mouseleave(function(){$('.btn-outline').css({'background-color': 'transparent'});})
            $('.btn-outline').mouseenter(function(){$('.btn-outline').css({'background-color': '#e6e6e6'});})
        </script>

@endsection