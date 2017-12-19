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
                        Chỉnh sửa sản phẩm
                        <a href="{{route('product.index')}}" class="btn btn-default btn-xs pull-right">
                            <span class="fa fa-arrow-left"></span> Trở lại</a>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="row">
                            <form action="{{route('product.update', $product->id)}}" class="form-horizontal"
                                  method="POST" enctype="multipart/form-data">
                                {{csrf_field()}}
                                {{method_field('PUT')}}
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="col-md-4 control-label">Tên sản phẩm</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="name"
                                               value="{{ $product->name }}" autofocus>
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('product_code') ? ' has-error' : '' }}">
                                    <label for="product_code" class="col-md-4 control-label">Mã sản phẩm</label>

                                    <div class="col-md-6">
                                        <input id="product_code" type="text" class="form-control" name="product_code"
                                               value="{{ $product->product_code }}">
                                        @if ($errors->has('product_code'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('product_code') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                                    <label class="col-md-4 control-label"></label>

                                    <div class="col-md-6">
                                        <img src="{{asset($product->image)}}" alt="" width="150px">
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                                    <label for="image" class="col-md-4 control-label">Hình ảnh</label>

                                    <div class="col-md-6">
                                        <input id="image" type="file" class="form-control" name="image">
                                        @if ($errors->has('image'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('image') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                                    <label for="category_id" class="col-md-4 control-label">Danh mục</label>

                                    <div class="col-md-6">
                                        <select name="category_id" id="category_id" class="form-control">
                                            @foreach($catProducts as $catProduct)
                                                <option value="{{$catProduct->id}}"
                                                        {{($product->category_id == $catProduct->id)? "selected" : ""}}
                                                >{{$catProduct->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                    <label for="price" class="col-md-4 control-label">Giá sản phẩm</label>

                                    <div class="col-md-6">
                                        <input id="price" type="text" class="form-control" name="price"
                                               value="{{ $product->price }}">
                                        @if ($errors->has('price'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('price') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('material') ? ' has-error' : '' }}">
                                    <label for="price" class="col-md-4 control-label">Chất liệu</label>

                                    <div class="col-md-6">
                                        <input id="material" type="text" class="form-control" name="material"
                                               value="{{ $product->material }}">
                                        @if ($errors->has('material'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('material') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                    <label for="description" class="col-md-4 control-label">Mô tả</label>

                                    <div class="col-md-6">
                                        <textarea name="description" id="description" class="form-control">
                                            {{ $product->description }}
                                        </textarea>
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