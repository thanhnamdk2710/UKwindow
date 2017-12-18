@extends('back-end.layouts.master')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tài khoản</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Danh sách tài khoản
                        <a href="{{route('user.create')}}" class="btn btn-success btn-xs pull-right">Thêm mới</a>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        @if(Session::has('message'))
                            <div class="alert alert-{{Session::get('alert')}} alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{Session::get('message')}}
                            </div>
                        @endif
                        @if(count($users) > 0)
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Tài khoản</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày tạo</th>
                                        <th class="text-center">Sửa</th>
                                        <th class="text-center">Khóa / Mở khóa</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i =1 ?>
                                    @foreach($users as $user)
                                        <?php
                                        if ($user->status == 0){
                                            $status = "<div class='label label-warning'>Khóa</div>";
                                        } else {
                                            $status = "<div class='label label-success'>Hoạt động</div>";
                                        }

                                        ?>
                                        <tr>
                                            <td class="text-center">{{$i++}}</td>
                                            <td>{{$user->username}}</td>
                                            <td>{!! $status !!}</td>
                                            <td>{{$user->created_at}}</td>
                                            <td class="text-center">
                                                <a href="{{route('user.edit', $user->id)}}" class="btn btn-primary" title="Sửa">
                                                    <span class="fa fa-edit"></span>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                @if($user->status == 1)
                                                    <form action="{{route('user.destroy', $user->id)}}" method="POST">
                                                        {{csrf_field()}}
                                                        {{method_field('DELETE')}}
                                                        <button class="btn btn-danger" title="Khóa">
                                                            <span class="fa fa-lock"></span>
                                                        </button>
                                                    </form>
                                                @else
                                                    <form action="{{route('user.destroy', $user->id)}}" method="POST">
                                                        {{csrf_field()}}
                                                        {{method_field('DELETE')}}
                                                        <button class="btn btn-warning" title="Mở khóa">
                                                            <span class="fa fa-unlock"></span>
                                                        </button>
                                                    </form>
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{$users->links()}}
                            </div>
                            <!-- /.table-responsive -->
                        @else
                            <div class="alert alert-warning">Hiện tại chưa có tài khoản nào!!!</div>
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