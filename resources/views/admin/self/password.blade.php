@extends('admin.common.common')

@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    修改密码
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

                            <form method="post" action="{{ url('/admin/self/password') }}">

                                {{ csrf_field() }}

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label col-md-1">新密码<span class="required">*</span></label>
                                        <div class="col-md-3">
                                            <input type="password" class="form-control" name="password">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label col-md-1">确认密码<span class="required">*</span></label>
                                        <div class="col-md-3">
                                            <input type="password" class="form-control" name="password_confirmation">
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