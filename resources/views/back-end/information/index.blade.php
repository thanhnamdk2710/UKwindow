@extends('back-end.layouts.master')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Cài đặt</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Thông tin cửa hàng
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        @if(Session::has('message'))
                            <div class="alert alert-{{Session::get('alert')}} alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
                                </button>
                                {{Session::get('message')}}
                            </div>
                        @endif

                        <div class="row">
                            <form action="{{route('information.update', $information->id)}}" class="form-horizontal"
                                  method="POST" enctype="multipart/form-data">
                                {{csrf_field()}}
                                {{method_field('PUT')}}
                                <div class="form-group{{ $errors->has('company_name') ? ' has-error' : '' }}">
                                    <label for="company_name" class="col-md-4 control-label">Tên cửa hàng</label>

                                    <div class="col-md-6">
                                        <input id="company_name" type="text" class="form-control" name="company_name"
                                               value="{{ $information->company_name }}">
                                        @if ($errors->has('company_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('company_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                    <label for="address" class="col-md-4 control-label">Địa chỉ</label>

                                    <div class="col-md-6">
                                        <input id="address" type="text" class="form-control" name="address"
                                               value="{{ $information->address }}">
                                        @if ($errors->has('address'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                @if($information->logo != '')
                                    <div class="form-group">
                                        <label class="col-md-4 control-label"></label>
                                        <div class="col-md-6">
                                            <img src="{{asset('assets/images/logo.svg')}}" alt="" width="200px">
                                        </div>
                                    </div>
                                @else
                                    <div class="form-group">
                                        <label class="col-md-4 control-label"></label>
                                        <div class="col-md-6">
                                            <div class="label label-info">Chưa có Logo</div>
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group{{ $errors->has('logo') ? ' has-error' : '' }}">
                                    <label for="logo" class="col-md-4 control-label">Logo</label>

                                    <div class="col-md-6">
                                        <input id="logo" type="file" class="form-control" name="logo">
                                        @if ($errors->has('logo'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('logo') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                @if($information->video != '')
                                    <div class="form-group">
                                        <label class="col-md-4 control-label"></label>
                                        <div class="col-md-6">
                                            {!! $information->video !!}
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group{{ $errors->has('video') ? ' has-error' : '' }}">
                                    <label for="video" class="col-md-4 control-label">Video</label>

                                    <div class="col-md-6">
                                        <input id="video" type="text" class="form-control" name="video"
                                               value="{{$information->video}}">
                                        @if ($errors->has('video'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('video') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('address_company') ? ' has-error' : '' }}">
                                    <label class="col-md-4 control-label">Công ty cổ phần
                                        UK</label>

                                    <div class="col-md-6">
                                        <textarea name="address_company" id="editor1" class="form-control" rows="10">
                                            {{ $information->address_company }}
                                        </textarea>
                                        @if ($errors->has('address_company'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('address_company') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('office') ? ' has-error' : '' }}">
                                    <label for="office" class="col-md-4 control-label">Văn phòng đại diện</label>

                                    <div class="col-md-6">
                                        <textarea name="office" id="editor" class="form-control" rows='10'>
                                            {{ $information->office }}
                                        </textarea>
                                        @if ($errors->has('office'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('office') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-6">
                                        <button class="btn btn-primary" type="submit">Lưu</button>
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