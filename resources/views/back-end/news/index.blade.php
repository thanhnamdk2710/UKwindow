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
                        Danh sách tin tức
                        <a href="{{route('news.create')}}" class="btn btn-success btn-xs pull-right">Thêm mới</a>
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

                        @if(count($news) > 0)
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Hình ảnh</th>
                                        <th>Tiêu đề</th>
                                        <th>Slug</th>
                                        <th class="text-center">Ngày đăng</th>
                                        <th class="text-center">Sửa</th>
                                        <th class="text-center">Xóa</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1 ?>
                                    @foreach($news as $new)
                                        <tr>
                                            <td class="text-center">{{$i++}}</td>
                                            <td class="text-center">
                                                <img src="{{asset($new->image)}}" alt="" width="100px">
                                            </td>
                                            <td>
                                                <a href="{{route('news.show', $new->id)}}">{{$new->title}}</a>
                                            </td>
                                            <td>{{$new->slug}}</td>
                                            <td class="text-center">{{$new->created_at}}</td>
                                            <td class="text-center">
                                                <a href="{{route('news.edit', $new->id)}}"
                                                   class="btn btn-primary" title="Sửa">
                                                    <span class="fa fa-edit"></span>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <form action="{{route('news.destroy', $new->id)}}"
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
                                {{$news->links()}}
                            </div>
                            <!-- /.table-responsive -->
                        @else
                            <div class="alert alert-warning">Hiện tại chưa có tin tức nào!!!</div>
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