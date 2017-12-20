@extends('back-end.layouts.master')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tin tức</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Chi tiết tin tức
                        <a href="{{route('news.index')}}" class="btn btn-default btn-xs pull-right">
                            <span class="fa fa-arrow-left"></span> Trở lại</a>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3">
                                <img src="{{asset($news->image)}}" alt="" width="100%">
                            </div>
                            <div class="col-md-9">
                                <div class="product-items"><b>Tiêu đề:</b> {{$news->title}}</div>
                                <div class="product-items"><b>Ngày đăng:</b> {{$news->created_at}}</div>
                                <div class="product-items"><b>Nội dung:</b> {{$news->body}}</div>
                            </div>
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