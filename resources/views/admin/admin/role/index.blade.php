@extends('admin.common.common') 

@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>
                        管理员角色
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

                                    @if (hasAdminPermission('createAdminRole'))
                                        <a href="javascript:void(0);" class="btn btn-primary" onclick="return createAdminRoleModal();">添加</a>
                                    @endif

                                    <input type="text" id="search" class="form-control search" placeholder="角色">
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
                                        <th>角色key</th>
                                        <th>角色名称</th>
                                        <th>备注</th>
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
            var ajaxUrl = "{{ route('getAdminRoleLists') }}";
            var columns = [
                {"data": "id"},
                {"data": "key"},
                {"data": "name"},
                {"data": "comment"},
                {"data": "created_at"},
                {"data": "updated_at"},
                {
                    "data": "id",
                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                        var html  = '';

                        @if (config('project.admin.permission_open'))
                            html += "<a href='javascript:void(0);' onclick='return updateAdminPermissionModal(" + JSON.stringify(oData) + ");'>权限</a> ";
                        @endif
                        @if (hasAdminPermission('updateAdminRole'))
                            html += "<a href='javascript:void(0);' onclick='return editAdminRoleModal(" + JSON.stringify(oData) + ");'>修改</a> ";
                        @endif
                        @if (hasAdminPermission('deleteAdminRole'))
                            html += "<a href='javascript:void(0);' onclick='return alertModal(deleteAdminRole,{id:" + sData + "});'>删除</a> ";
                        @endif

                        $(nTd).html(html);
                    }
                }];

            function createAdminRoleModal()
            {
                $('#create_admin_role_modal_key').val('');
                $('#create_admin_role_modal_name').val('');
                $('#create_admin_role_modal_comment').val('');

                $("#create_admin_role_modal").modal('show');
            }

            function editAdminRoleModal(data)
            {
                $('#edit_admin_role_modal_id').val(data.id);
                $('#edit_admin_role_modal_key').val(data.key);
                $('#edit_admin_role_modal_name').val(data.name);
                $('#edit_admin_role_modal_comment').val(data.comment);

                $("#edit_admin_role_modal").modal('show');
            }

            function updateAdminPermissionModal(data)
            {
                
                $('#update_admin_permission_modal_id').val(data.id);
                $("#update_admin_permission_modal").modal('show');

                console.log(data);
                if( data['is_all_permissions'] == 1){
                    $('#update_admin_permission_modal_is_all_permissions').attr("checked", true);
                    $('.selectTitle').find('input').attr("checked", true);


                }
                    var newData = data['permissions'].split(",");
                    console.log(<?php echo json_encode(config('project.admin.permissions')); ?>);

                    @foreach(config('project.admin.permissions') as $key => $value)

                        name = '{{$key}}';
                        @foreach($value as $k => $v)
                            value = '{{$v}}';
                            $.each(newData, function($ke, $va){
                                var newD = $va.replace(/(\[)|(\])|(\")/g,"");
                                if(newD == value){
                                    $('.' + value + '').prop('checked', true);
                                }
                                administrators = document.getElementsByName('管理员模块'); 
                                allCount = administrators.length; 
                                checkedCount = $("input[name=管理员模块]:checkbox:checked").length;
                                if(allCount == checkedCount){
                                    $('.管理员模块').prop('checked', true);
                                }

                                roleModule = document.getElementsByName('角色模块'); 
                                allCountRole = roleModule.length; 
                                checkedCountRole = $("input[name=角色模块]:checkbox:checked").length;
                                if(allCountRole == checkedCountRole){
                                    $('.角色模块').prop('checked', true);
                                } 

                               
                            })
                        @endforeach
                    @endforeach
                }

            function checkAll(){
                if ( $('#update_admin_permission_modal_is_all_permissions').prop("checked")) {  
                    $(".form-group").find('input').each(function() {  
                        $(this).prop("checked", true);  
                    })
                } else {  
                    $(".form-group").find('input').each(function() {  
                        $(this).prop("checked", false);  
                    });  
                }  
            }
            
            // function checkTitle(){

                // console.log($(this).attr('type'));
                // $('.管理员模块').click(function(){
            
                // if ( $('.管理员模块').prop("checked")) {  
                //     $("input[name=管理员模块]").each(function() {  
                //         $(this).prop("checked", true);  
                //     })
                // } else {  
                //     $("input[name=管理员模块]").each(function() {  
                //         $(this).prop("checked", false);  
                //     });  
                // } 
                // })

                // $('.角色模块').click(function(){
                // if ( $('.角色模块').prop("checked")) {  
                //     $("input[name=角色模块]").each(function() {  
                //         $(this).prop("checked", true);  
                //     })
                // } else {  
                //     $("input[name=角色模块]").each(function() {  
                //         $(this).prop("checked", false);  
                //     });  
                // }
                // })
                
                // if($(".管理员模块").prop("checked") && $(".角色模块").prop("checked")){
                //     $('#update_admin_permission_modal_is_all_permissions').prop("checked",true);
                // } else {
                //     $('#update_admin_permission_modal_is_all_permissions').prop("checked",false);
                // } 
            // }

            function checkList(){ 
                var ll =  0; 
                for(var i = 0; i < allCount; i++){ 
                    if(administrators[i].checked == true){ 
                        ll++  
                    } 
                } 
                $(".管理员模块").prop("checked", ll == allCount ? true :false);

                var ls =  0; 
                for(var j = 0; j < allCountRole; j++){ 
                    if(roleModule[j].checked == true){ 
                        ls++ 
                    } 
                } 
                $(".角色模块").prop("checked", ls == allCountRole ? true :false);

                if($(".管理员模块").prop("checked") && $(".角色模块").prop("checked")){
                    $('#update_admin_permission_modal_is_all_permissions').prop("checked",true);
                }else{
                    $('#update_admin_permission_modal_is_all_permissions').prop("checked",false);
                }

            }
        </script>

        <script type="text/javascript">
            $(function(){
                $('.管理员模块').click(function(){
                if ( $('.管理员模块').prop("checked")) {  
                    $("input[name=管理员模块]").each(function() {  
                        $(this).prop("checked", true);  
                    })
                } else {  
                    $("input[name=管理员模块]").each(function() {  
                        $(this).prop("checked", false);  
                    });  
                } 
                checkTitle()
                })

                $('.角色模块').click(function(){
                if ( $('.角色模块').prop("checked")) {  
                    $("input[name=角色模块]").each(function() {  
                        $(this).prop("checked", true);  
                    })
                } else {  
                    $("input[name=角色模块]").each(function() {  
                        $(this).prop("checked", false);  
                    });  
                }
                checkTitle()
                })
                

                function checkTitle(){
                if($(".管理员模块").prop("checked") && $(".角色模块").prop("checked")){
                    $('#update_admin_permission_modal_is_all_permissions').prop("checked",true);
                } else {
                    $('#update_admin_permission_modal_is_all_permissions').prop("checked",false);
                }
                } 
               
            })
        </script>

        <script>
            $(function () { $('#update_admin_permission_modal').modal('hide')});

        </script>

        <script>

            $(function () { $('#update_admin_permission_modal').on('hide.bs.modal', function () {
                    window.location.reload();
            })

        });

        </script>

        <!-- Modal -->
        <div class="modal fade" id="create_admin_role_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                    <label class="control-label col-md-3">角色key<span class="required">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="create_admin_role_modal_key">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label col-md-3">角色名称<span class="required">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="create_admin_role_modal_name">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label col-md-3">备注</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="create_admin_role_modal_comment">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <div class="col-md-5 col-md-offset-1">
                                <button type="button" class="btn btn-primary btn-block" onclick="return createAdminRole();">确认</button>
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
        <div class="modal fade" id="edit_admin_role_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width:450px; margin-top:40px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h5 class="modal-title" id="modal_title">修改</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-horizontal">
                            <input type="hidden" id="edit_admin_role_modal_id">

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label col-md-3">角色key<span class="required">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="edit_admin_role_modal_key">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label col-md-3">角色名称<span class="required">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="edit_admin_role_modal_name">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label col-md-3">备注</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="edit_admin_role_modal_comment">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <div class="col-md-5 col-md-offset-1">
                                <button type="button" class="btn btn-primary btn-block" onclick="return editAdminRole();">确认</button>
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
        <div class="modal fade" id="update_admin_permission_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width:450px; margin-top:40px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h5 class="modal-title" id="modal_title">权限</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-horizontal">
                            <input type="hidden" id="update_admin_permission_modal_id">

                            <div class="form-group">
                                <div class="col-md-12 col-md-offset-2">
                                    <input type="checkbox" id="update_admin_permission_modal_is_all_permissions" value="1" onclick="checkAll()">
                                    全部
                                </div>
                            </div>

                            @foreach(config('project.admin.permissions') as $key => $value)
                                <div class="form-group">
                                    <div class="col-md-12 col-md-offset-2 selectTitle">
                                        <input type="checkbox" class="{{$key}}" >
                                        {{ $key }}
                                          <div class="col-md-11 col-md-offset-1">
                                        @foreach($value as $k => $v)
                                          
                                                <input type="checkbox" value="{{ $v }}" name="{{$key}}" onclick="checkList()" class="{{ $v }}">
                                                {{ $k }}<br>
                                          
                                    @endforeach
                                      </div>
                                    </div>

                                    
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <div class="col-md-5 col-md-offset-1">
                                <button type="button" class="btn btn-primary btn-block" onclick="return updateAdminPermission();">确认</button>
                            </div>
                            <div class="col-md-5">
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
            function createAdminRole() {
                var data = {
                    'key': $('#create_admin_role_modal_key').val(),
                    'name': $('#create_admin_role_modal_name').val(),
                    'comment': $('#create_admin_role_modal_comment').val(),
                };
                ajax("{{ route('createAdminRole') }}", 'POST', data, successCallback = function () {
                    $("#create_admin_role_modal").modal('hide');
                });
            }

            function editAdminRole() {
                var data = {
                    'id': $('#edit_admin_role_modal_id').val(),
                    'key': $('#edit_admin_role_modal_key').val(),
                    'name': $('#edit_admin_role_modal_name').val(),
                    'comment': $('#edit_admin_role_modal_comment').val(),
                };
                ajax("{{ route('updateAdminRole') }}", 'PUT', data, successCallback = function () {
                    $("#edit_admin_role_modal").modal('hide');
                });
            }

            function deleteAdminRole(data) {
                ajax("{{ route('deleteAdminRole') }}", 'DELETE', data);
            }

            function updateAdminPermission() {
                var permissions = [];
                var data = {
                    'id': $('#update_admin_permission_modal_id').val(),
                    'is_all_permissions': $('#update_admin_permission_modal_is_all_permissions').val(),
                    'permissions': permissions
                };
                ajax("{{ route('updateAdminPermission') }}", 'PUT', data, successCallback = function () {
                    $("#update_admin_permission_modal").modal('hide');
                });
            }
        </script>
@endsection