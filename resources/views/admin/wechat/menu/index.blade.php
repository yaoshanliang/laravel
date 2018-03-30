@extends('admin.common.common')

@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>
                        菜单设置
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
                                    <a href="javascript:void(0);" class="btn btn-primary" onclick="return createMenu1Modal();">添加一级菜单</a>
                                    <a href="javascript:void(0);" class="btn btn-primary" onclick="return createMenu2Modal();" style="margin-left: 20px;">添加二级菜单</a>
                                    <a onclick="return syncMenu();" class="btn btn-primary" style="margin-left: 30px;">同步至公众号</a>
                                    <span style="color: red;">
                                        (添加或修改后请点击此按钮)
                                    </span>
                                </div>

                                <table id="admin_index" class="table table-striped table-bordered table-hover datatable-example" style="width:100%;" border="0px">
                                    <thead>
                                    <tr>
                                        <th>菜单名</th>
                                        <th>值</th>
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
            var columnDefsTargets = [0,1,2,3,4];
            var invisibleColumns = [];
            var order = [];
            var datatable_default_length = 20;
            var ajaxUrl = siteUrl + '/admin/wechat/menu/lists';
            var columns = [
                {
                    "data": "name",
                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                        if (oData['pid'] != 0) {
                            $(nTd).html('&emsp;&emsp;&emsp;&emsp;' + sData);
                        } else {
                            $(nTd).html(sData);
                        }
                    }
                },
                {
                    "data": "value",
                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                        if (sData.length > 60) {
                            $(nTd).html(sData.substr(0, 60) + '...');
                        } else {
                            $(nTd).html(sData);
                        }
                    }
                },
                {"data": "sort"},
                {"data": "created_at"},
                {
                    "data": "id",
                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                        if (oData['pid'] == 0) {
                            html = "<a href='javascript:void(0);' onclick='return editMenu1Modal(" + JSON.stringify(oData) + ");'>修改</a> ";
                            html += "<a href='javascript:void(0);' onclick='return alertModal(deleteMenu1,{id:" + sData + "});'>删除</a> ";
                        } else {
                            html = "<a href='javascript:void(0);' onclick='return editMenu2Modal(" + JSON.stringify(oData) + ");'>修改</a> ";
                            html += "<a href='javascript:void(0);' onclick='return alertModal(deleteMenu2,{id:" + sData + "});'>删除</a> ";
                        }
                        $(nTd).html(html);
                    }
                }];

            function createMenu1Modal() {
                $('#menu_level_1_type').css('display', 'none');
                $('#menu_level_1_value').css('display', 'none');

                $("#create_menu_1_modal").modal('show');
            }

            function createMenu2Modal() {
                $("#create_menu_2_modal").modal('show');
            }

            function editMenu1Modal(data)
            {
                $('#edit_menu_level_1_id').val(data.id);
                $('#edit_menu_level_1_name').val(data.name);
                $('#edit_menu_level_1_sort').val(data.sort);
                $("input[name='edit_menu_level_1_sub_check'][value=" + data.has_sub + "]").prop("checked",true);
                var sub_check = data.has_sub;
                if(sub_check == 1) {
                    $('#edit_menu_level_1_type').css('display', 'none');
                    $('#edit_menu_level_1_value').css('display', 'none');
                } else {
                    $('#edit_menu_level_1_type').css('display', 'block');
                    $('#edit_menu_level_1_value').css('display', 'block');
                }

                $("input[name='edit_menu_level_1_type_radio'][value=" + data.type + "]").prop("checked",true);
                $('#edit_menu_level_1_value_text').val(data.value);

                $("#edit_menu_1_modal").modal('show');
            }

            function editMenu2Modal(data)
            {
                $('#edit_menu_level_2_id').val(data.id);
                $('#edit_menu_level_2_name').val(data.name);
                $('#edit_menu_level_2_parent').val(data.pid);
                $('#edit_menu_level_2_sort').val(data.sort);

                $("input[name='edit_menu_level_2_type_radio'][value=" + data.type + "]").prop("checked",true);
                $('#edit_menu_level_2_value_text').val(data.value);

                $("#edit_menu_2_modal").modal('show');
            }
        </script>

        <!-- Modal -->
        <div class="modal fade" id="create_menu_1_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width:450px; margin-top:40px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h5 class="modal-title" id="modal_title">添加一级菜单</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label col-md-3">顺序<span class="required">*</span></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select class="select2_single form-control" tabindex="-1" id="menu_level_1_sort">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label col-md-3">菜单名</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="menu_level_1_name">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" id="menu_level_1_has_sub">
                                <div class="col-md-12">
                                    <label class="control-label col-md-3">有无子菜单</label>
                                    <div class="col-md-9">
                                        <label class="radio-inline">
                                            <input type="radio" name="menu_level_1_sub_check" value="1" checked id="menu_level_1_has_sub_has"> 含
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="menu_level_1_sub_check" value="0" id="menu_level_1_has_sub_not"> 不含
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" id="menu_level_1_type">
                                <div class="col-md-12">
                                    <label class="control-label col-md-3">菜单类型</label>
                                    <div class="col-md-9">
                                        <label class="radio-inline">
                                            <input type="radio" name="menu_level_1_type_radio" value="0" checked> 跳转网页
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="menu_level_1_type_radio" value="1"> 发送消息
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="menu_level_1_type_radio" value="2"> 跳转小程序
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" id="menu_level_1_value">
                                <div class="col-md-12">
                                    <label class="control-label col-md-3">url地址或关键字</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="menu_level_1_value_text">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <div class="col-md-5 col-md-offset-1">
                                <button type="button" class="btn btn-primary btn-block" onclick="return createMenu1();">确认</button>
                            </div>
                            <div class="col-md-5 col-md-offset-0">
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
        <div class="modal fade" id="create_menu_2_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width:450px; margin-top:40px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h5 class="modal-title" id="modal_title">添加二级菜单</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label col-md-3">父级菜单</label>
                                    <div class="col-md-9">
                                        <select class="select2_single form-control" tabindex="-1" id="menu_level_2_parent">
                                            @foreach($level1 as $v)
                                                <option value="{{ $v->id }}">{{ $v->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label col-md-3">顺序<span class="required">*</span></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select class="select2_single form-control" tabindex="-1" id="menu_level_2_sort">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label col-md-3">菜单名</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="menu_level_2_name">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label col-md-3">菜单类型</label>
                                    <div class="col-md-9">
                                        <label class="radio-inline">
                                            <input type="radio" name="menu_level_2_type_radio" value="0" checked> 跳转网页
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="menu_level_2_type_radio" value="1"> 发送消息
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="menu_level_2_type_radio" value="2"> 跳转小程序
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" id="menu_level_2_value">
                                <div class="col-md-12">
                                    <label class="control-label col-md-3">url地址或关键字</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="menu_level_2_value_text">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <div class="col-md-5 col-md-offset-1">
                                <button type="button" class="btn btn-primary btn-block" onclick="return createMenu2();">确认</button>
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
        <div class="modal fade" id="edit_menu_1_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width:450px; margin-top:40px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h5 class="modal-title" id="modal_title">修改一级菜单</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-horizontal">
                            <input type="hidden" id="edit_menu_level_1_id">

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label col-md-3">顺序<span class="required">*</span></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select class="select2_single form-control" tabindex="-1" id="edit_menu_level_1_sort">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label col-md-3">菜单名</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="edit_menu_level_1_name">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label col-md-3">有无子菜单</label>
                                    <div class="col-md-9">
                                        <label class="radio-inline">
                                            <input type="radio" name="edit_menu_level_1_sub_check" value="1" id="edit_menu_level_1_has_sub_has"> 含
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="edit_menu_level_1_sub_check" value="0" id="edit_menu_level_1_has_sub_not"> 不含
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" id="edit_menu_level_1_type">
                                <div class="col-md-12">
                                    <label class="control-label col-md-3">菜单类型</label>
                                    <div class="col-md-9">
                                        <label class="radio-inline">
                                            <input type="radio" name="edit_menu_level_1_type_radio" value="0" checked> 跳转网页
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="edit_menu_level_1_type_radio" value="1"> 发送消息
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="edit_menu_level_1_type_radio" value="2"> 跳转小程序
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" id="edit_menu_level_1_value">
                                <div class="col-md-12">
                                    <label class="control-label col-md-3">url地址或关键字</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="edit_menu_level_1_value_text">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <div class="col-md-5 col-md-offset-1">
                                <button type="button" class="btn btn-primary btn-block" onclick="return editMenu1();">确认</button>
                            </div>
                            <div class="col-md-5 col-md-offset-0">
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
        <div class="modal fade" id="edit_menu_2_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width:450px; margin-top:40px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h5 class="modal-title" id="modal_title">修改二级菜单</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-horizontal">
                            <input type="hidden" id="edit_menu_level_2_id">

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label col-md-3">父级菜单</label>
                                    <div class="col-md-9">
                                        <select class="select2_single form-control" tabindex="-1" id="edit_menu_level_2_parent">
                                            @foreach($level1 as $v)
                                                <option value="{{ $v->id }}">{{ $v->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label col-md-3">顺序<span class="required">*</span></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select class="select2_single form-control" tabindex="-1" id="edit_menu_level_2_sort">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label col-md-3">菜单名</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="edit_menu_level_2_name">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label col-md-3">菜单类型</label>
                                    <div class="col-md-9">
                                        <label class="radio-inline">
                                            <input type="radio" name="edit_menu_level_2_type_radio" value="0"> 跳转网页
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="edit_menu_level_2_type_radio" value="1"> 发送消息
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="edit_menu_level_2_type_radio" value="2"> 跳转小程序
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" id="menu_level_2_value">
                                <div class="col-md-12">
                                    <label class="control-label col-md-3">url地址或关键字</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="edit_menu_level_2_value_text">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <div class="col-md-5 col-md-offset-1">
                                <button type="button" class="btn btn-primary btn-block" onclick="return editMenu2();">确认</button>
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
            $("input[name='menu_level_1_sub_check']").click(function(){
                var check = $("input[name='menu_level_1_sub_check']:checked").val();
                if (check == 1) {
                    $('#menu_level_1_type').css('display', 'none');
                    $('#menu_level_1_value').css('display', 'none');
                } else {
                    $('#menu_level_1_type').css('display', 'block');
                    $('#menu_level_1_value').css('display', 'block');
                }
            });
            $("input[name='edit_menu_level_1_sub_check']").click(function(){
                var check = $("input[name='edit_menu_level_1_sub_check']:checked").val();
                if (check == 1) {
                    $('#edit_menu_level_1_type').css('display', 'none');
                    $('#edit_menu_level_1_value').css('display', 'none');
                } else {
                    $('#edit_menu_level_1_type').css('display', 'block');
                    $('#edit_menu_level_1_value').css('display', 'block');
                }
            });

            function createMenu1() {
                var data = {
                    'name': $('#menu_level_1_name').val(),
                    'sort': $('#menu_level_1_sort').val(),
                    'has_sub': $("input[name='menu_level_1_sub_check']:checked").val(),
                    'menu_type': $("input[name='menu_level_1_type_radio']:checked").val(),
                    'value': $('#menu_level_1_value_text').val()
                };
                console.log(data);
                ajax('/admin/wechat/menu', 'POST', data, successCallback = function () {
                    $("#create_menu_1_modal").modal('hide');
                    window.location.reload();
                });
            }

            function createMenu2() {
                var data = {
                    'pid': $("#menu_level_2_parent").val(),
                    'name': $('#menu_level_2_name').val(),
                    'sort': $('#menu_level_2_sort').val(),
                    'has_sub': 0,
                    'menu_type': $("input[name='menu_level_2_type_radio']:checked").val(),
                    'value': $('#menu_level_2_value_text').val()
                };
                console.log(data);
                ajax('/admin/wechat/menu/sub', 'POST', data, successCallback = function () {
                    $("#create_menu_2_modal").modal('hide');
                    window.location.reload();
                });
            }

            function editMenu1() {
                var data = {
                    'id': $('#edit_menu_level_1_id').val(),
                    'name': $('#edit_menu_level_1_name').val(),
                    'sort': $('#edit_menu_level_1_sort').val(),
                    'has_sub': $("input[name='edit_menu_level_1_sub_check']:checked").val(),
                    'menu_type': $("input[name='edit_menu_level_1_type_radio']:checked").val(),
                    'value': $('#edit_menu_level_1_value_text').val()
                };
                ajax('/admin/wechat/menu', 'PUT', data, successCallback = function () {
                    $("#edit_menu_1_modal").modal('hide');
                    window.location.reload();
                });
            }

            function editMenu2() {
                var data = {
                    'id': $('#edit_menu_level_2_id').val(),
                    'pid': $("#edit_menu_level_2_parent").val(),
                    'name': $('#edit_menu_level_2_name').val(),
                    'sort': $('#edit_menu_level_2_sort').val(),
                    'has_sub': 0,
                    'menu_type': $("input[name='edit_menu_level_2_type_radio']:checked").val(),
                    'value': $('#edit_menu_level_2_value_text').val()
                };
                ajax('/admin/wechat/menu/sub', 'PUT', data, successCallback = function () {
                    $("#edit_menu_2_modal").modal('hide');
                    window.location.reload();
                });
            }

            function deleteMenu1(data) {
                ajax('/admin/wechat/menu', 'DELETE', data);
            }

            function deleteMenu2(data) {
                ajax('/admin/wechat/menu/sub', 'DELETE', data);
            }

            function syncMenu() {
                ajax('/web/menu', 'GET');
            }
        </script>
@endsection