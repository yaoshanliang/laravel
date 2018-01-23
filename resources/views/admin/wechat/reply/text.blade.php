@extends('admin.common.common')

@section('content')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <ul class="nav nav-tabs">
                    <li role="presentation" class="active"><a href="{{url('/admin/wechat/reply/0')}}">文本回复</a></li>
                    <li role="presentation"><a href="{{url('/admin/wechat/reply/1')}}">图文回复</a></li>
                </ul>
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
                                    <a href="javascript:void(0);" class="btn btn-primary" onclick="return createTextReplyModal();">添加</a>

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
                                        <th>关键字</th>
                                        <th>回复内容</th>
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
            var ajaxUrl = siteUrl + '/admin/wechat/reply/lists/' + "{{$type}}";
            var columns = [
                {"data": "id"},
                {"data": "keyword"},
                {"data": "content"},
                {"data": "created_at"},
                {
                    "data": "id",
                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                        html = "<a href='javascript:void(0);' onclick='return editTextReplyModal(" + JSON.stringify(oData) + ");'>修改</a> ";
                        html += "<a href='javascript:void(0);' onclick='return alertModal(deleteTextReply,{id:" + sData + "});'>删除</a> ";
                        $(nTd).html(html);
                    }
                }];

            function createTextReplyModal()
            {
                $('#create_TextReply_modal_name').val('');

                $("#create_TextReply_modal").modal('show');
            }

            function editTextReplyModal(data)
            {
                $('#edit_TextReply_modal_id').val(data.id);
                $('#edit_TextReply_modal_keyword').val(data.keyword);
                $('#edit_TextReply_modal_content').val(data.content);
                $("#edit_TextReply_modal").modal('show');
            }
        </script>

        <!-- Modal -->
        <div class="modal fade" id="create_TextReply_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                    <label class="control-label col-md-3">关键字</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="create_TextReply_modal_keyword">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label col-md-3">回复内容</label>
                                    <div class="col-md-9">
                                        <!--<input type="text" class="form-control" id="create_TextReply_modal_name">-->
                                        <textarea id="create_TextReply_modal_content" style="width: 260px;height: 200px;resize: none;overflow-y:hidden;overflow-x:hidden"></textarea>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <div class="col-md-5 col-md-offset-1">
                                <button type="button" class="btn btn-primary btn-block" onclick="return createTextReply();">确认</button>
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
        <div class="modal fade" id="edit_TextReply_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width:450px; margin-top:40px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h5 class="modal-title" id="modal_title">修改</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-horizontal">
                            <input type="hidden" id="edit_TextReply_modal_id">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label col-md-3">关键字</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="edit_TextReply_modal_keyword" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label col-md-3">回复内容</label>
                                    <div class="col-md-9">
                                        <!--<input type="text" class="form-control" id="edit_TextReply_modal_content">-->
                                        <textarea id="edit_TextReply_modal_content" style="width: 260px;height: 200px;resize: none;overflow-y:hidden;overflow-x:hidden"></textarea>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <div class="col-md-5 col-md-offset-1">
                                <button type="button" class="btn btn-primary btn-block" onclick="return editTextReply();">确认</button>
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
            function createTextReply() {
                var data = {
                    'keyword': $('#create_TextReply_modal_keyword').val(),
                    'content': $('#create_TextReply_modal_content').val()
                };
                console.log(data);
                ajax('/admin/wechat/reply/text', 'POST', data, successCallback = function () {
                    $("#create_TextReply_modal").modal('hide');
                });
            }

            function editTextReply() {
                var data = {
                    'id': $('#edit_TextReply_modal_id').val(),
                    'keyword': $('#edit_TextReply_modal_keyword').val(),
                    'content': $('#edit_TextReply_modal_content').val(),
                };
                ajax('/admin/wechat/reply/text', 'PUT', data, successCallback = function () {
                    $("#edit_TextReply_modal").modal('hide');
                });
            }

            function deleteTextReply(data) {
                ajax('/admin/wechat/reply', 'DELETE', data);
            }
        </script>
@endsection