@extends('back-end.layouts.master')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Banner</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Danh sách Banner
                        <a href="{{route('slider.create')}}" class="btn btn-success btn-xs pull-right">Thêm mới</a>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        @if(Session::has('message'))
                            <div class="alert alert-{{Session::get('alert')}} alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{Session::get('message')}}
                            </div>
                        @endif
                        @if(count($sliders) > 0)
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Hình ảnh</th>
                                        <th class="text-center">Tiêu đề</th>
                                        <th class="text-center">Trạng thái</th>
                                        <th class="text-center">Ngày tạo</th>
                                        <th class="text-center">Sửa</th>
                                        <th class="text-center">Ẩn / Hiện</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i =1 ?>
                                    @foreach($sliders as $slider)
                                        <?php
                                          if ($slider->status == 0){
                                              $status = "<span class='label label-warning'>Ẩn</span>";
                                          } else {
                                              $status = "<span class='label label-success'>Hiện</span>";
                                          }
                                        ?>
                                        <tr>
                                            <td class="text-center">{{$i++}}</td>
                                            <td class="text-center">
                                                <img src="{{asset($slider->path)}}" alt="" class="img-slider">
                                            </td>
                                            <td>{{$slider->title}}</td>
                                            <td class="text-center">{!! $status !!}</td>
                                            <td class="text-center">{{ $slider->created_at }}</td>
                                            <td class="text-center">
                                                <a href="{{route('slider.edit', $slider->id)}}" class="btn btn-primary" title="Sửa">
                                                    <span class="fa fa-edit"></span>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                @if($slider->status == 1)
                                                    <form action="{{route('slider.destroy', $slider->id)}}" method="POST">
                                                        {{csrf_field()}}
                                                        {{method_field('DELETE')}}
                                                        <button class="btn btn-danger" title="Ẩn">
                                                            <span class="fa fa-eye-slash"></span>
                                                        </button>
                                                    </form>
                                                @else
                                                    <form action="{{route('slider.destroy', $slider->id)}}" method="POST">
                                                        {{csrf_field()}}
                                                        {{method_field('DELETE')}}
                                                        <button class="btn btn-warning" title="Hiện">
                                                            <span class="fa fa-eye"></span>
                                                        </button>
                                                    </form>
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{$sliders->links()}}
                            </div>
                            <!-- /.table-responsive -->
                        @else
                            <div class="alert alert-warning">Hiện tại chưa có Banner nào!!!</div>
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