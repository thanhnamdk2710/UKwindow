@extends('back-end.layouts.master')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Sản phẩm</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Chi tiết sản phẩm
                        <a href="{{route('product.index')}}" class="btn btn-default btn-xs pull-right">
                            <span class="fa fa-arrow-left"></span> Trở lại</a>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3">
                                <img src="{{asset($product->image)}}" alt="" width="100%">
                            </div>
                            <div class="col-md-9">
                                <div class="product-items"><b>Tên sản phẩm:</b> {{$product->name}}</div>
                                <div class="product-items"><b>Danh mục:</b> {{$product->category->name}}</div>
                                <div class="product-items"><b>Mã sản phẩm:</b> {{$product->product_code}}</div>
                                <div class="product-items"><b>Chất liệu:</b> {{$product->material}}</div>
                                <div class="product-items"><b>Giá:</b> {{number_format($product->price)}} đồng</div>
                                <div class="product-items"><b>Mô tả:</b> {{$product->description}}</div>
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