@extends('back-end.layouts.master')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Hình ảnh</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Danh sách hình ảnh
                        <a href="{{route('image.create')}}" class="btn btn-success btn-xs pull-right">Thêm mới</a>
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
                        @if(count($images) > 0)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <ul class="nav nav-pills">
                                        <?php $i = 1 ?>
                                        @foreach($catImages as $catImage)
                                            <li class="{!! ($i == 1) ? "active" : "" !!}">
                                                <a href="#category-{{$catImage->id}}" data-toggle="tab">{{$catImage->name}}</a>
                                            </li>
                                            <?php $i++ ?>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="panel-body">
                                    <!-- Tab panes -->
                                    <div class="tab-content block-image">
                                    <?php $j = 1; ?>
                                    @foreach($catImages as $catImage)
                                        <div class="tab-pane fade {!! ($j == 1) ? "active in" : "" !!}"
                                             id="category-{{$catImage->id}}">
                                            <?php
                                            $images = \App\Image::where('category_id', $catImage->id)->get();
                                            if (count($images) > 0){
                                            ?>
                                            @foreach($images as $image)
                                                <?php
                                                if (strlen($image->title) > 25) {
                                                    $title = substr($image->title, 0, 25) . "...";
                                                } else {
                                                    $title = $image->title;
                                                }
                                                ?>
                                                <div class="col-md-3">
                                                    <div class="panel panel-success">
                                                        <div class="panel-heading">
                                                            <img src="{{asset($image->path)}}" alt="" width="100%">
                                                        </div>
                                                        <div class="panel-body">
                                                            <div class="pull-left">
                                                                {!! $title !!}
                                                            </div>
                                                            <div class="pull-right">
                                                                <form action="{{route('image.destroy', $image->id)}}"
                                                                      method="POST">
                                                                    {{csrf_field()}}
                                                                    {{method_field('DELETE')}}
                                                                    <button class="btn btn-danger" title="Xóa">
                                                                        <span class="fa fa-trash"></span>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <?php
                                            } else {
                                                echo "<div class='alert alert-warning'>Hiện tại chưa có hình ảnh nào!!!</div>";
                                            }
                                            ?>
                                        </div>
                                        <?php $j++ ?>
                                    @endforeach

                                </div>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-warning">Hiện tại chưa có hình ảnh nào!!!</div>
                        @endif
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