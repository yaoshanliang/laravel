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

                    <div class="title_right">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                            <div class="input-group">

                            </div>
                        </div>
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
                                    <div class="input-group custom-search-form pull-right">
                                        <a href="javascript:void(0);" onclick='return createAdmin();' class="btn btn-primary">创建管理员</a>
                                    </div>
                                    {{ csrf_field() }}
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
        $('title').html('管理员设置 - ' + site_name);
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
                    var userId = <?php echo auth()->guard('admin')->user()->id;?>;
                    var html = '';
                    if (userId != sData) {
                        if (oData.role_id == 0) {
                            html = "<a href='javascript:void(0);' onclick='return alertModal(setAdminRole,{admin_id:" + sData + ", role_id:1});'>设为高级管理员</>  ";
                        } else {
                            html = "<a href='javascript:void(0);' onclick='return alertModal(setAdminRole,{admin_id:" + sData + ", role_id:0});'>设为普通管理员</a>  "
                        }
                        if (oData.status == 0) {
                            html += "<a href='javascript:void(0);' onclick='return alertModal(setAdminStatus,{admin_id:" + sData + ", status:1});'>封号</a>";
                        } else {
                            html += "<a href='javascript:void(0);' onclick='return alertModal(setAdminStatus,{admin_id:" + sData + ", status:0});'>取消封号</a>";
                        }
                    }
                    $(nTd).html(html);
                }
            }];
        function createAdmin()
        {
            $("input[name=account]").val('');
            $("input[name=password]").val('');
            $("input[name=password_confirmation]").val('');

            $("#create_admin_modal").modal('show');
        }
    </script>

    <!-- Modal -->
    <div class="modal fade" id="create_admin_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width:400px; margin-top:40px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h5 class="modal-title" id="myModalLabel">创建管理员信息</h5>
                </div>
                <div class="modal-body">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="account" placeholder="账号">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="password" class="form-control" name="password" placeholder="密码">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="password" class="form-control" name="password_confirmation" placeholder="确认密码">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-primary btn-block" onClick="return confirmCreateAdmin();">确认</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection