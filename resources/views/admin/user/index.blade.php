@extends('admin.common.common')

@section('content')
    <fieldset class="layui-elem-field layui-field-title">
        <legend>前台用户</legend>
    </fieldset>
    <div class="demoTable">
        <div class="layui-inline">
            <input class="layui-input" name="id" id="demoReload" autocomplete="off">
        </div>
        <button class="layui-btn" data-type="reload">搜索</button>
    </div>
    <table id="demo"></table>

    <script>
        layui.use('table', function(){
            var table = layui.table.render({ //其它参数在此省略
                elem: '#demo' //指定原始表格元素选择器（推荐id选择器）
                //,height: 315 //容器高度
                ,url: siteUrl + '/admin/user/lists'
                ,page: true
                ,limits: [5, 10, 50, 100]
                ,limit: 10 //默认采用60
                ,even: true //开启隔行背景
                ,cols:  [[ //标题栏
                    {checkbox: true}
                    ,{field: 'id', title: 'ID', width: 100, sort: true}
                    ,{field: 'account', title: '账户', width: 100}
                    ,{field: 'name', title: '姓名', width: 100}
                    ,{field: 'phone', title: '手机', width: 100}
                    ,{field: 'email', title: '邮箱', width: 100}
                    ,{title: '操作', width: 300, toolbar: '#barDemo'} //这里的toolbar值是模板元素的选择器
                ]]
                ,done: function(res, curr, count){
                    //如果是异步请求数据方式，res即为你接口返回的信息。
                    //如果是直接赋值的方式，res即为：{data: [], count: 99} data为当前页数据、count为数据总长度
                    console.log(res);

                    //得到当前页码
                    console.log(curr);

                    //得到数据总量
                    console.log(count);
                }
                ,initSort: {
                    field: 'id' //排序字段，对应 cols 设定的各字段名
                    ,type: 'desc' //排序方式  asc: 升序、desc: 降序、null: 默认排序
                }
            });

            var $ = layui.$, active = {
                reload: function(){
                    var demoReload = $('#demoReload');

                    table.reload({
                        where: {
                            search: demoReload.val()
                        }
                    });
                }
            };

            $('.demoTable .layui-btn').on('click', function(){
                var type = $(this).data('type');
                active[type] ? active[type].call(this) : '';
            });
        });
    </script>

    <script type="text/html" id="barDemo">
        <a class="layui-btn layui-btn-mini" lay-event="detail">查看</a>
        <a class="layui-btn layui-btn-mini" lay-event="edit">编辑</a>
        <a class="layui-btn layui-btn-danger layui-btn-mini" lay-event="del">删除</a>

    </script>
@endsection

        <script>


            function createUserModal()
            {
                $('#create_user_modal_account').val('');
                $('#create_user_modal_name').val('');
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
                $('#edit_user_modal_name').val(data.name);
                $('#edit_user_modal_phone').val(data.phone);
                $('#edit_user_modal_email').val(data.email);

                $("#edit_user_modal").modal('show');
            }
        </script>

{{--
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
                                        <input type="text" class="form-control" id="create_user_modal_name">
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
                                        <input type="text" class="form-control" id="edit_user_modal_name">
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
--}}

        <script>
            function createUser() {
                var data = {
                    'account': $('#create_user_modal_account').val(),
                    'name': $('#create_user_modal_name').val(),
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
                    'name': $('#edit_user_modal_name').val(),
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