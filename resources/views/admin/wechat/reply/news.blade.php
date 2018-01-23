@extends('admin.common.common')

@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <ul class="nav nav-tabs">
                    <li role="presentation"><a href="{{url('/admin/wechat/reply/0')}}">文本回复</a></li>
                    <li role="presentation" class="active"><a href="{{url('/admin/wechat/reply/1')}}">图文回复</a></li>
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
                                    <a href="javascript:void(0);" class="btn btn-primary" onclick="return uploadModal();">添加单图文</a>

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
                                        <th>图文标题</th>
                                        <th>图文封面</th>
                                        <th>图文简介</th>
                                        <th>图文链接地址</th>
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
                {"data": "title"},
                {
                    "data": "id",
                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                        html = "<a target='_blank' href=" + siteUrl + '/' + oData.file_path + "><img style='width:100px;' src='"+ siteUrl + '/' +  oData.image + "'/></a>";
                        $(nTd).html(html);
                    }
                },
                {"data": "content"},
                {"data": "link"},
                {"data": "created_at"},
                {
                    "data": "id",
                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                        html = "<a href='javascript:void(0);' onclick='return editFileModal(" + JSON.stringify(oData) + ");'>修改</a> ";
                        html += "<a href='javascript:void(0);' onclick='return alertModal(deleteAdminFile,{id:" + sData + "});'>删除</a> ";
                        $(nTd).html(html);
                    }
                }];
            //            $("#image_preview").attr('src', siteUrl + '/admin-assets/images/local_upload.png');

            function uploadModal()
            {
                $("#image_preview").attr('src',siteUrl + '/admin-assets/images/local_upload.png');
                $("#create_imgreply_modal_pic").attr('src', '');
                $("#create_imgreply_modal_keyword").val('');
                $("#create_imgreply_modal_title").val('');
                $("#create_imgreply_modal_content").val('');
                $("#create_imgreply_modal_link").val('');
                $("#upload_modal").modal('show');
            }


            function editFileModal(data)
            {
                $('#edit_imgreply_modal_id').val(data.id);
                $('#edit_imgreply_modal_keyword').val(data.keyword);
                $('#edit_imgreply_modal_title').val(data.title);
                $('#edit_imgreply_modal_content').val(data.content);
                $('#edit_imgreply_modal_pic').val(data.image);
                $('#edit_image_preview').attr('src',siteUrl + '/' + data.image);
                $('#edit_imgreply_modal_link').val(data.link);

                $("#edit_upload_modal").modal('show');
            }
        </script>

        <!-- Modal -->
        <div class="modal fade" id="upload_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width:450px; margin-top:40px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h5 class="modal-title" id="modal_title">添加单图文</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-horizontal">
                            <form id="form-for-upload"  class="form-horizontal form-label-left" enctype="multipart/form-data">
                                <div class="col-md-12">
                                    <div class="col-md-12" style="margin-top: 10px;">
                                        <label class="control-label col-md-3">关键字<span class="required">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" id="create_imgreply_modal_keyword">
                                        </div>
                                    </div>

                                    <div class="col-md-12" style="margin-top: 10px;">
                                        <label class="control-label col-md-3">图文标题<span class="required">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" id="create_imgreply_modal_title">
                                        </div>
                                    </div>

                                    <div class="col-md-12 " style="margin-top: 10px;">
                                        <label class="control-label col-md-3">图文封面</label>
                                        <input style="width:300px;height:200px;" class="upload-img-hidden" type="file" name="image" onchange="return upload();">
                                        <input type="hidden" id="create_imgreply_modal_pic" >
                                        <img id="image_preview" style="margin-left: 15px;width: 238px;height:200px;padding-top: 0" src="../../admin-assets/images/local_upload.png" />
                                    </div>

                                    <div class="col-md-12" style="margin-top: 10px;">
                                        <label class="control-label col-md-3">图文简介<span class="required">*</span></label>
                                        <div class="col-md-9">
                                            <!--                                                <input type="text" class="form-control" id="create_file_modal_url">-->
                                            <textarea id="create_imgreply_modal_content" style="width: 238px;height: 200px;resize: none;overflow-y:hidden;overflow-x:hidden"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12" style="margin-top: 10px;">
                                        <label class="control-label col-md-3">图文链接<span class="required">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" id="create_imgreply_modal_link">
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <div class="col-md-5 col-md-offset-1">
                                <button type="button" class="btn btn-primary btn-block" onclick="return createImgReply();">确认</button>
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
        <div class="modal fade" id="edit_upload_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width:450px; margin-top:40px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h5 class="modal-title" id="modal_title">修改单图文</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-horizontal">
                            <form id="edit_form-for-upload"  class="form-horizontal form-label-left" enctype="multipart/form-data">

                                <input type="hidden" id="edit_imgreply_modal_id">
                                <div class="col-md-12">
                                    <div class="col-md-12" style="margin-top: 10px;">
                                        <label class="control-label col-md-3">关键字<span class="required">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" id="edit_imgreply_modal_keyword" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-12" style="margin-top: 10px;">
                                        <label class="control-label col-md-3">图文标题<span class="required">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" id="edit_imgreply_modal_title">
                                        </div>
                                    </div>

                                    <div class="col-md-12 " style="margin-top: 10px;">
                                        <label class="control-label col-md-3">图文封面</label>
                                        <input style="width:300px;height:200px;" class="upload-img-hidden" type="file" name="image" onchange="return editupload();">
                                        <input type="hidden" id="edit_imgreply_modal_pic" >
                                        <img id="edit_image_preview" style="margin-left:15px;width:238px;height: 200px;padding-top: 0;" class="upload-img" style="margin-left: 15px;width: 238px;">
                                    </div>

                                    <div class="col-md-12" style="margin-top: 10px;">
                                        <label class="control-label col-md-3">图文简介<span class="required">*</span></label>
                                        <div class="col-md-9">
                                            <!--                                                <input type="text" class="form-control" id="create_file_modal_url">-->
                                            <textarea id="edit_imgreply_modal_content" style="width: 238px;height: 200px;resize: none;overflow-y:hidden;overflow-x:hidden"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12" style="margin-top: 10px;">
                                        <label class="control-label col-md-3">图文链接<span class="required">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" id="edit_imgreply_modal_link">
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <div class="col-md-5 col-md-offset-1">
                                <button type="button" class="btn btn-primary btn-block" onclick="return editImgReply();">确认</button>
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

        <script>

            // 上传图片
            function upload() {
                data = new FormData($("#form-for-upload")[0]);
                $.ajax({
                    url: "/admin/wechat/reply/uploadImage",
                    type: 'POST',
                    xhr: function() {
                        myXhr = $.ajaxSettings.xhr();
                        if (myXhr.upload) {
                        }
                        return myXhr;
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    async: true,
                    beforeSend: function (data) {
                        showProcessingTip();
                    },
                    success: function(data) {
                        console.log(data);
                        $("#image_preview").attr('src', siteUrl + '/' + data['data']['file_path']);
                        $("#create_imgreply_modal_pic").attr('value', data['data']['file_path']);
                        showSuccessTip(data['message']);
                        //$("#upload_modal").modal('hide');
                        //table.draw();
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            }

            function editupload() {
                data = new FormData($("#edit_form-for-upload")[0]);
                $.ajax({
                    url: "/admin/wechat/reply/uploadImage",
                    type: 'POST',
                    xhr: function() {
                        myXhr = $.ajaxSettings.xhr();
                        if (myXhr.upload) {
                        }
                        return myXhr;
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    async: true,
                    beforeSend: function (data) {
                        showProcessingTip();
                    },
                    success: function(data) {
                        console.log(data);
                        $("#edit_image_preview").attr('src', siteUrl + '/' + data['data']['file_path']);
                        $("#edit_imgreply_modal_pic").attr('value', data['data']['file_path']);
                        showSuccessTip(data['message']);
                        //$("#upload_modal").modal('hide');
                        //table.draw();
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            }

            function deleteAdminFile(data){
                ajax('/admin/wechat/reply', 'DELETE', data);
            }

            function createImgReply() {
                var data = {
                    'keyword': $('#create_imgreply_modal_keyword').val(),
                    'title': $('#create_imgreply_modal_title').val(),
                    'image': $('#create_imgreply_modal_pic').val(),
                    'content': $('#create_imgreply_modal_content').val(),
                    'link':  $('#create_imgreply_modal_link').val(),
                };
                console.log(data);
                ajax('/admin/wechat/reply/news', 'POST', data, successCallback = function () {
                    $("#upload_modal").modal('hide');
                });
            }

            function editImgReply() {
                var data = {
                    'id':$("#edit_imgreply_modal_id").val(),
                    'keyword': $('#edit_imgreply_modal_keyword').val(),
                    'title': $('#edit_imgreply_modal_title').val(),
                    'image': $('#edit_imgreply_modal_pic').val(),
                    'content': $('#edit_imgreply_modal_content').val(),
                    'link':  $('#edit_imgreply_modal_link').val(),
                };
                console.log(data);
                ajax('/admin/wechat/reply/news', 'PUT', data, successCallback = function () {
                    $("#edit_upload_modal").modal('hide');
                });
            }
        </script>
@endsection