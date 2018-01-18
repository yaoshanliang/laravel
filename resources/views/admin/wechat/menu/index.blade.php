@extends('admin.common.common')

@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>
                        一级菜单设置
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
                                    {{--<a href="{{$url}}" class="btn btn-primary" style="margin-left: 50px;">刷新公众号菜单</a>--}}
                                    <span style="color: red;">
                                        (添加或修改后请点击此按钮)
                                    </span>

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
            var ajaxUrl = siteUrl + '/admin/wechat/menu/lists';
            var columns = [
                {"data": "id"},
                {"data": "title"},
                {"data": "url"},
                {"data": "sort"},
                {"data": "created_at"},
                {
                    "data": "id",
                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                        html = "<a href='javascript:void(0);' onclick='return editMenuModal(" + JSON.stringify(oData) + ");'>修改</a> ";
                        html += "<a href='javascript:void(0);' onclick='return subMenuModal({id:" + sData + "});'>查看子菜单</a> ";
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
                var sub_check = data.has_sub;
                if(sub_check == 1) {
                    $('#edit_sub2').prop("checked",true);
                    $('#edit_url').css('display', 'none');
                } else {
                    $('#edit_sub1').prop("checked",true);
                    $('#edit_url').css('display', 'block');
                }
                $('#edit_menu_modal_url').val(data.url);
                $("#edit_menu_modal").modal('show');
            }

            function subMenuModal(data)
            {
                window.location.href = "/admin/wechat/menu/sub/"+data.id
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
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label col-md-3">子菜单</label>
                                    <div class="col-md-9">
                                        <label class="radio-inline">
                                            <input type="radio" name="sub_check" value="0" checked id="sub1"> 不含
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="sub_check" value="1" id="sub2"> 含
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" id="add_value">
                                <div class="col-md-12">
                                    <label class="control-label col-md-3">url地址</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="create_menu_modal_value">
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
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label col-md-3">子菜单</label>
                                    <div class="col-md-9">
                                        <label class="radio-inline">
                                            <input type="radio" name="edit_sub_check" value="0" id="edit_sub1"> 不含
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="edit_sub_check" value="1" id="edit_sub2"> 含
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" id="edit_url">
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
            //            $('#sub1').click(function(){
            //                $("#add_value").css('display', 'block');
            //            });
            //            $('#sub2').click(function(){
            //                $("#add_value").css('display', 'none');
            //            });

            $("input[name='sub_check']").click(function(){
                var check = $("input[name='sub_check']:checked").val();
                if (check == 1) {
                    $("#add_value").css('display', 'none');
                } else {
                    $("#add_value").css('display', 'block');
                }
            });

            $('#edit_sub1').click(function(){
                $("#edit_value").css('display', 'block');
            });
            $('#edit_sub2').click(function(){
                $("#edit_value").css('display', 'none');
            });

            function createMenu() {
                var data = {
                    'title': $('#create_menu_modal_title').val(),
                    'sort': $('#create_menu_modal_sort').val(),
                    'has_sub': $("input[name='sub_check']:checked").val(),
                    'url': $('#create_menu_modal_value').val()
                };

                ajax('/admin/wechat/menu', 'POST', data, successCallback = function () {
                    $("#create_menu_modal").modal('hide');
                });
            }

            function editMenu() {
                var data = {
                    'id': $('#edit_menu_modal_id').val(),
                    'title': $('#edit_menu_modal_title').val(),
                    'sort': $('#edit_menu_modal_sort').val(),
                    'has_sub': $("input[name='edit_sub_check']:checked").val(),
                    'url': $('#edit_menu_modal_url').val()
                };
                ajax('/admin/wechat/menu', 'PUT', data, successCallback = function () {
                    $("#edit_menu_modal").modal('hide');
                });
            }

            function deleteMenu(data) {
                ajax('/admin/wechat/menu', 'DELETE', data);
            }
        </script>
@endsection