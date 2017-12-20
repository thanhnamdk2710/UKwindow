@extends('back-end.layouts.master')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Nhà máy</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Danh sách bài biết
                        <a href="{{route('factory.create')}}" class="btn btn-success btn-xs pull-right">Thêm mới</a>
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

                        @if(count($factories) > 0)
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Tiêu đề</th>
                                        <th class="text-center">Ngày viết</th>
                                        <th class="text-center">Sửa</th>
                                        <th class="text-center">Xóa</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1 ?>
                                    @foreach($factories as $factory)
                                        <tr>
                                            <td class="text-center">{{$i++}}</td>
                                            <td>{{$factory->title}}</td>
                                            <td class="text-center">{{$factory->created_at}}</td>
                                            <td class="text-center">
                                                <a href="{{route('factory.edit', $factory->id)}}"
                                                   class="btn btn-primary" title="Sửa">
                                                    <span class="fa fa-edit"></span>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <form action="{{route('factory.destroy', $factory->id)}}"
                                                      method="POST">
                                                    {{csrf_field()}}
                                                    {{method_field('DELETE')}}
                                                    <button class="btn btn-danger" title="Xóa">
                                                        <span class="fa fa-trash"></span>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{$factories->links()}}
                            </div>
                            <!-- /.table-responsive -->
                        @else
                            <div class="alert alert-warning">Hiện tại chưa có bài viết nào!!!</div>
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