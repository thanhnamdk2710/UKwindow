@extends('back-end.layouts.master')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Giới thiệu</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Thêm mới bài viết
                        <a href="{{route('about.index')}}" class="btn btn-default btn-xs pull-right">
                            <span class="fa fa-arrow-left"></span> Trở lại</a>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="row">
                            <form action="{{route('about.store')}}" class="form-horizontal" method="POST"
                                  enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                    <label for="name" class="col-md-4 control-label">Tiêu đề</label>

                                    <div class="col-md-6">
                                        <input id="title" type="text" class="form-control" name="title"
                                               value="{{ old('title') }}" autofocus>
                                        @if ($errors->has('title'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('title') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="location" class="col-md-4 control-label">Vị trí</label>

                                    <div class="col-md-6">
                                        <select name="location" id="location" class="form-control">
                                            <option value="0">Trang chủ</option>
                                            <option value="1">Trang con</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                                    <label for="body" class="col-md-4 control-label">Nội dung</label>

                                    <div class="col-md-6">
                                        <textarea name="body" id="body" class="form-control">
                                            {{ old('body') }}
                                        </textarea>
                                        @if ($errors->has('body'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('body') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-6">
                                        <button class="btn btn-primary" type="submit">Thêm mới</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->
@stop