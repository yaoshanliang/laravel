@extends('admin.common.common')

@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>
                        个人信息
                    </h3>
                </div>

                <div class="pull-right">
                    @include('admin.components.tip')
            </div>
            </div>
            <div class="clearfix"></div>

            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="form-horizontal">

                                <form method="post" action="{{ url('/admin/self/info') }}">

                                    {{ csrf_field() }}

                                    <input type="hidden" name="id" value="{{ $info->id }}">

                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label class="control-label col-md-1">账号<span class="required">*</span></label>
                                            <div class="col-md-3">
                                                <input type="text" class="form-control" name="account" value="{{ $info->account }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label class="control-label col-md-1">姓名</label>
                                            <div class="col-md-3">
                                                <input type="text" class="form-control" name="name" value="{{ $info->name }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label class="control-label col-md-1">手机</label>
                                            <div class="col-md-3">
                                                <input type="text" class="form-control" name="phone" value="{{ $info->phone }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label class="control-label col-md-1">邮箱</label>
                                            <div class="col-md-3">
                                                <input type="text" class="form-control" name="email" value="{{ $info->email }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-2 col-md-offset-1">
                                            <button type="submit" class="btn btn-primary">修改</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection