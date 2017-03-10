@extends('admin.common.common')

@section('content')
    <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>
                            管理员设置
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
                                        <a href="javascript:void(0);" class="btn btn-primary" onclick="return createAdminModal();">添加</a>

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
                                            <th>电话</th>
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
        var columnDefs_targets = [0, 1, 2];
        var invisible_columns = [];
        var order = [];
        var ajax_url = site_url + '/admin/admin/lists';
        var html = '';
        var columns = [
            {"data": "id"},
            {"data": "account"},
            {"data": "name"},
            {"data": "phone"},
            {"data": "email"},
            {"data": "created_at"},
            {"data": "updated_at"},
            {
                "data": "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    html += "<a href='javascript:void(0);' onclick='return alertModal(setAdminStatus,{admin_id:" + sData + ", status:0});'>取消封号</a>";
                    $(nTd).html(html);
                }
            }];
        function createAdminModal()
        {
            $("input[name=account]").val('');
            $("input[name=password]").val('');
            $("input[name=password_confirmation]").val('');

            $("#create_admin_modal").modal('show');
        }
    </script>

    <!-- Modal -->
    <div class="modal fade" id="admin_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width:450px; margin-top:40px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h5 class="modal-title" id="myModalLabel">添加</h5>
                </div>
                <div class="modal-body">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label col-md-3">账号<span class="required">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="admin_modal_account">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label col-md-3">姓名</label>
                                <div class="col-md-9">
                                <input type="text" class="form-control" name="admin_modal_name">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label col-md-3">电话</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="admin_modal_phone">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label col-md-3">邮箱</label>
                                <div class="col-md-9">
                                    <input type="email" class="form-control" name="admin_modal_email">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label col-md-3">密码<span class="required">*</span></label>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" name="admin_modal_password">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label col-md-3">确认密码<span class="required">*</span></label>
                                <div class="col-md-9">
                                <input type="password" class="form-control" name="admin_modal_password_confirmation">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <div class="col-md-5 col-md-offset-1">
                            <button type="button" class="btn btn-primary btn-block" onclick="return createOrEditAdmin();">确认</button>
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
        function createOrEditAdmin() {
            var data = {
                'account': $('create_admin_account').val(),
                'name': $('create_admin_name').val(),
                'phone': $('create_admin_phone').val(),
                'email': $('create_admin_email').val(),
                'password': $('create_admin_password').val(),
                'password_confirmation': $('create_admin_password_confirmation').val()

            };
            ajax('/admin/admin', 'POST', data, successCallback = function () {
                alert(2);
            }
            );
        }
    </script>
@endsection