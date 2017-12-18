<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{route('admin')}}">UK Window</a>
    </div>

    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>

    <ul class="nav navbar-nav navbar-left navbar-top-links">
        <li><a href="{{route('index')}}" target="_blank"><i class="fa fa-home fa-fw"></i> Website</a></li>
    </ul>

    <ul class="nav navbar-right navbar-top-links">
        <li>
            <a href="javascript:void(0);">
                Xin chào <strong>{{Auth::user()->username}}</strong>
            </a>
        </li>
        <li>
            <a href="{{route('logout')}}">
                <i class="fa fa-sign-out fa-fw"></i> Đăng xuất
            </a>
        </li>
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                </span>
                    </div>
                    <!-- /input-group -->
                </li>
                <li>
                    <a href="{{route('admin')}}" class="active"><i class="fa fa-dashboard fa-fw"></i> Bảng điều
                        khiển</a>
                </li>
                <li>
                    <a href="{{route('slider.index')}}"><i class="fa fa-bookmark fa-fw"></i> Banner</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-product-hunt fa-fw"></i> Sản phẩm<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{route('cat-product.index')}}">Danh mục</a>
                        </li>
                        <li>
                            <a href="{{route('product.index')}}">Sản phẩm</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-image fa-fw"></i> Hình ảnh<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{route('cat-image.index')}}">Thư mục</a>
                        </li>
                        <li>
                            <a href="{{route('image.index')}}">Hình ảnh</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-newspaper-o fa-fw"></i> Tin tức<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{route('cat-news.index')}}">Danh mục</a>
                        </li>
                        <li>
                            <a href="{{route('news.index')}}">Tin tức</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="{{route('user.index')}}"><i class="fa fa-building fa-fw"></i> Dự án</a>
                </li>
                <li>
                    <a href="{{route('user.index')}}"><i class="fa fa-users fa-fw"></i> Tài khoản</a>
                </li>
            </ul>
        </div>
    </div>
</nav>