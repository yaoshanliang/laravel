@extends('admin.common.common')

@section('content')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>
                        系统配置
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
                                    <a href="javascript:void(0);" class="btn btn-primary" onclick="return createConfigModal();">添加</a>

                                    <input type="text" id="search" class="form-control search" placeholder="关键字">
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
                                        <th>key</th>
                                        <th>value</th>
                                        <th>描述</th>
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

        <script>
            var datatable_id = 'admin_index';
            var columnDefsTargets = [];
            var invisibleColumns = [];
            var order = [0, 'desc'];
            var ajaxUrl = siteUrl + '/admin/system/config/lists';
            var columns = [
                {"data": "id"},
                {"data": "key"},
                {"data": "value"},
                {"data": "description"},
                {"data": "created_at"},
                {
                    "data": "id",
                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                        html = "<a href='javascript:void(0);' onclick='return editConfigModal(" + JSON.stringify(oData) + ");'>修改</a> ";
                        html += "<a href='javascript:void(0);' onclick='return alertModal(deleteConfig,{id:" + sData + "});'>删除</a> ";
                        $(nTd).html(html);
                    }
                }];

            function createConfigModal()
            {
                $('#create_config_modal_keyword').val('');
                $('#create_config_modal_value').val('');
                $('#create_config_modal_description').val('');

                $("#create_config_modal").modal('show');
            }

            function editConfigModal(data)
            {
                $('#edit_config_modal_id').val(data.id);
                $('#edit_config_modal_keyword').val(data.key);
                $('#edit_config_modal_value').val(data.value);
                $('#edit_config_modal_description').val(data.description);
                $("#edit_config_modal").modal('show');
            }
        </script>

        <!-- Modal -->
        <div class="modal fade" id="create_config_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width:450px; margin-top:40px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h5 class="modal-title" id="modal_title">添加</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-horizontal">

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label col-md-3">key</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="create_config_modal_keyword">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label col-md-3">value</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="create_config_modal_value">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label col-md-3">描述</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="create_config_modal_description">
                                        {{--<textarea id="create_config_modal_description" style="width: 260px;height: 200px;resize: none;overflow-y:hidden;overflow-x:hidden"></textarea>--}}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <div class="col-md-5 col-md-offset-1">
                                <button type="button" class="btn btn-primary btn-block" onclick="return createConfig();">确认</button>
                            </div>
                            <div class="col-md-5 col-md-offset-">
                                <button type="button" class="btn btn-default btn-block" data-dismiss="modal">取消</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <!-- Modal -->
        <div class="modal fade" id="edit_config_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width:450px; margin-top:40px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h5 class="modal-title" id="modal_title">修改</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-horizontal">
                            <input type="hidden" id="edit_config_modal_id">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label col-md-3">key</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="edit_config_modal_keyword">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label col-md-3">value</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="edit_config_modal_value">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label col-md-3">描述</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="edit_config_modal_description">
                                        {{--<textarea id="edit_config_modal_description" style="width: 260px;height: 200px;resize: none;overflow-y:hidden;overflow-x:hidden"></textarea>--}}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <div class="col-md-5 col-md-offset-1">
                                <button type="button" class="btn btn-primary btn-block" onclick="return editConfig();">确认</button>
                            </div>
                            <div class="col-md-5 col-md-offset-">
                                <button type="button" class="btn btn-default btn-block" data-dismiss="modal">取消</button>
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
            function createConfig() {
                var data = {
                    'key': $('#create_config_modal_keyword').val(),
                    'value': $('#create_config_modal_value').val(),
                    'description': $('#create_config_modal_description').val()
                };
                console.log(data);
                ajax('/admin/system/config', 'POST', data, successCallback = function () {
                    $("#create_config_modal").modal('hide');
                });
            }

            function editConfig() {
                var data = {
                    'id': $('#edit_config_modal_id').val(),
                    'key': $('#edit_config_modal_keyword').val(),
                    'value': $('#edit_config_modal_value').val(),
                    'description': $('#edit_config_modal_description').val(),
                };
                ajax('/admin/system/config', 'PUT', data, successCallback = function () {
                    $("#edit_config_modal").modal('hide');
                });
            }

            function deleteConfig(data) {
                ajax('/admin/system/config', 'DELETE', data);
            }
        </script>
@endsection