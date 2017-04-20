@extends('admin.common.common')

@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>
                        图片
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
                                    <a href="javascript:void(0);" class="btn btn-primary" onclick="return uploadModal();">上传</a>

                                    <input type="text" id="search" class="form-control search" placeholder="名称">
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
                                        <th>图片</th>
                                        <th>名称</th>
                                        <th>大小</th>
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
            var ajaxUrl = "{{ route('getImageLists') }}";
            var columns = [
                {"data": "id"},
                {
                    "data": "id",
                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                        html = "<a target='_blank' href=" + site_url + '/' + oData.file_path + "><img style='width:100px; height:100px' src='" + site_url + '/' + oData.file_path + "'/></a>";
                        $(nTd).html(html);
                    }
                },
                {"data": "file_name"},
                {"data": "size"},
                {"data": "created_at"},
                {
                    "data": "id",
                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                        html = "<a href='javascript:void(0);' onclick='return alertModal(deleteAdmin,{id:" + sData + "});'>删除</a> ";
                        $(nTd).html(html);
                    }
                }];

            function uploadModal()
            {
                $("#image_preview").attr('src', '');
                $("#upload_modal").modal('show');
            }
        </script>

        <!-- Modal -->
        <div class="modal fade" id="upload_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width:450px; margin-top:40px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h5 class="modal-title" id="modal_title">上传</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-horizontal">
                            <form id="form-for-upload"  class="form-horizontal form-label-left" enctype="multipart/form-data">

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="col-md-9 col-md-offset-3">
                                            <input class="upload-img-hidden" type="file" name="image" onchange="return upload();">
                                            <img id="image_preview" class="upload-img">
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <div class="col-md-5 col-md-offset-1">
                                <button type="button" class="btn btn-primary btn-block" onclick="return createImage();">确认</button>
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
            // 上传图片
            function upload() {
                data = new FormData($("#form-for-upload")[0]);
                $.ajax({
                    url: "{{ route('uploadImage') }}",
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
                        $("#image_preview").attr('src', site_url + '/' + data['data']['file_path']);
                        showSuccessTip(data['message']);
                        $("#upload_modal").modal('hide');
                        table.draw();
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            }
        </script>
@endsection