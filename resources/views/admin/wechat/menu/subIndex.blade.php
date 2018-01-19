@extends('admin.common.common')

@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>
                        二级菜单设置
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
                                    <a href="javascript:void(0);" class="btn btn-primary" onclick="return createMenuModal();">添加</a>

                                    <input type="text" id="search" class="form-control search" placeholder="菜单名">
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
                                        <th>菜单名</th>
                                        <th>url</th>
                                        <th>顺序</th>
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
            var ajaxUrl = siteUrl + '/admin/wechat/menu/sublists/' + "{{ $pid }}";
            var columns = [
                {"data": "id"},
                {"data": "title"},
                {"data": "url",
                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                        html = "<span style='word-break:break-all; width:200px;'>" + oData.url + "</span>";
                        $(nTd).html(html);

                    }},
                {"data": "sort"},
                {"data": "created_at"},
                {
                    "data": "id",
                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                        html = "<a href='javascript:void(0);' onclick='return editMenuModal(" + JSON.stringify(oData) + ");'>修改</a> ";
                        html += "<a href='javascript:void(0);' onclick='return alertModal(deleteMenu,{id:" + sData + "});'>删除</a> ";
                        $(nTd).html(html);
                    }
                }];

            function createMenuModal()
            {
                $('#create_menu_modal_title').val('');
                $('#create_menu_modal_url').val('');
                $("#create_menu_modal").modal('show');
            }

            function editMenuModal(data)
            {
                $('#edit_menu_modal_id').val(data.id);
                $('#edit_menu_modal_title').val(data.title);
                $('#edit_menu_modal_sort').val(data.sort);
                $('#edit_menu_modal_url').val(data.url);
                $("#edit_menu_modal").modal('show');
            }
        </script>

        <!-- Modal -->
        <div class="modal fade" id="create_menu_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                    <label class="control-label col-md-3">菜单名</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="create_menu_modal_title">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label col-md-3">顺序<span class="required">*</span></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select class="select2_single form-control" tabindex="-1" id="create_menu_modal_sort">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" id="add_value">
                                <div class="col-md-12">
                                    <label class="control-label col-md-3">url地址</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="create_menu_modal_url">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <div class="col-md-5 col-md-offset-1">
                                <button type="button" class="btn btn-primary btn-block" onclick="return createMenu();">确认</button>
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
        <div class="modal fade" id="edit_menu_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width:450px; margin-top:40px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h5 class="modal-title" id="modal_title">修改</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-horizontal">
                            <input type="hidden" id="edit_menu_modal_id">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label col-md-3">菜单名</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="edit_menu_modal_title">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label col-md-3">顺序<span class="required">*</span></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select class="select2_single form-control" tabindex="-1" id="edit_menu_modal_sort">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" id="edit_value">
                                <div class="col-md-12">
                                    <label class="control-label col-md-3">url地址</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="edit_menu_modal_url">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <div class="col-md-5 col-md-offset-1">
                                <button type="button" class="btn btn-primary btn-block" onclick="return editMenu();">确认</button>
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
            function createMenu() {
                var data = {
                    'pid': "{{$pid}}",
                    'title': $('#create_menu_modal_title').val(),
                    'sort': $('#create_menu_modal_sort').val(),
                    'url': $('#create_menu_modal_url').val()
                };

                ajax('/admin/wechat/menu/sub', 'POST', data, successCallback = function () {
                    $("#create_menu_modal").modal('hide');
                });
            }

            function editMenu() {
                var data = {
                    'id': $('#edit_menu_modal_id').val(),
                    'title': $('#edit_menu_modal_title').val(),
                    'sort': $('#edit_menu_modal_sort').val(),
                    'url': $('#edit_menu_modal_url').val()
                };
                ajax('/admin/wechat/menu/sub', 'PUT', data, successCallback = function () {
                    $("#edit_menu_modal").modal('hide');
                });
            }

            function deleteMenu(data) {
                ajax('/admin/wechat/menu/sub', 'DELETE', data);
            }
        </script>
@endsection