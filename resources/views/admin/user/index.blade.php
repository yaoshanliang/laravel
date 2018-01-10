@extends('admin.common.common')

@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>
                        用户管理
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
                                    <a href="javascript:void(0);" class="btn btn-primary" onclick="return createUserModal();">添加</a>

                                    <input type="text" id="search" class="form-control search" placeholder="账号/姓名/电话/邮箱">
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
                                        <th>账号</th>
                                        <th>姓名</th>
                                        <th>手机</th>
                                        <th>邮箱</th>
                                        <th>创建时间</th>
                                        <th>更新时间</th>
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
            var ajaxUrl = siteUrl + '/admin/user/lists';
            var columns = [
                {"data": "id"},
                {"data": "account"},
                {"data": "realname"},
                {"data": "phone"},
                {"data": "email"},
                {"data": "created_at"},
                {"data": "updated_at"},
                {
                    "data": "id",
                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                        html = "<a href='javascript:void(0);' onclick='return editUserModal(" + JSON.stringify(oData) + ");'>修改</a> ";
                        html += "<a href='javascript:void(0);' onclick='return alertModal(deleteUser,{id:" + sData + "});'>删除</a> ";
                        $(nTd).html(html);
                    }
                }];

            function createUserModal()
            {
                $('#create_user_modal_account').val('');
                $('#create_user_modal_realname').val('');
                $('#create_user_modal_phone').val('');
                $('#create_user_modal_email').val('');
                $('#create_user_modal_password').val('');
                $('#create_user_modal_password_confirmation').val('');

                $("#create_user_modal").modal('show');
            }

            function editUserModal(data)
            {
                $('#edit_user_modal_id').val(data.id);
                $('#edit_user_modal_account').val(data.account);
                $('#edit_user_modal_realname').val(data.realname);
                $('#edit_user_modal_phone').val(data.phone);
                $('#edit_user_modal_email').val(data.email);

                $("#edit_user_modal").modal('show');
            }
        </script>

        <!-- Modal -->
        <div class="modal fade" id="create_user_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                    <label class="control-label col-md-3">账号<span class="required">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="create_user_modal_account">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label col-md-3">姓名</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="create_user_modal_realname">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label col-md-3">手机</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="create_user_modal_phone">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label col-md-3">邮箱</label>
                                    <div class="col-md-9">
                                        <input type="email" class="form-control" id="create_user_modal_email">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label col-md-3">密码<span class="required">*</span></label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" id="create_user_modal_password">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label col-md-3">确认密码<span class="required">*</span></label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" id="create_user_modal_password_confirmation">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <div class="col-md-5 col-md-offset-1">
                                <button type="button" class="btn btn-primary btn-block" onclick="return createUser();">确认</button>
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
        <div class="modal fade" id="edit_user_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width:450px; margin-top:40px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h5 class="modal-title" id="modal_title">修改</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-horizontal">
                            <input type="hidden" id="edit_user_modal_id">

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label col-md-3">账号<span class="required">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="edit_user_modal_account">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label col-md-3">姓名</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="edit_user_modal_realname">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label col-md-3">手机</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="edit_user_modal_phone">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label col-md-3">邮箱</label>
                                    <div class="col-md-9">
                                        <input type="email" class="form-control" id="edit_user_modal_email">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <div class="col-md-5 col-md-offset-1">
                                <button type="button" class="btn btn-primary btn-block" onclick="return editUser();">确认</button>
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
            function createUser() {
                var data = {
                    'account': $('#create_user_modal_account').val(),
                    'realname': $('#create_user_modal_realname').val(),
                    'phone': $('#create_user_modal_phone').val(),
                    'email': $('#create_user_modal_email').val(),
                    'password': $('#create_user_modal_password').val(),
                    'password_confirmation': $('#create_user_modal_password_confirmation').val()
                };
                ajax('/admin/user', 'POST', data, successCallback = function () {
                    $("#create_user_modal").modal('hide');
                });
            }

            function editUser() {
                var data = {
                    'id': $('#edit_user_modal_id').val(),
                    'account': $('#edit_user_modal_account').val(),
                    'realname': $('#edit_user_modal_realname').val(),
                    'phone': $('#edit_user_modal_phone').val(),
                    'email': $('#edit_user_modal_email').val()
                };
                ajax('/admin/user', 'PUT', data, successCallback = function () {
                    $("#edit_user_modal").modal('hide');
                });
            }

            function deleteUser(data) {
                ajax('/admin/user', 'DELETE', data);
            }
        </script>
@endsection