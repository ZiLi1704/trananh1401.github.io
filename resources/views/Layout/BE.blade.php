<!doctype html>
<!--
* Bootstrap Simple Admin Template
* Version: 2.1
* Author: Alexis Luna
* Website: https://github.com/alexis-luna/bootstrap-simple-admin-template
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MKStore | @yield('title')</title>
    <script src="{{url('https://cdn.tiny.cloud/1/x99bor8yirkkozi0o89rxmzyemaiaj2u7l4cvqat0geybriq/tinymce/5/tinymce.min.js')}}" referrerpolicy="origin"></script>
    <link href="{{asset('BE/assets/vendor/fontawesome/css/fontawesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('BE/assets/vendor/fontawesome/css/solid.min.css')}}" rel="stylesheet">
    <link href="{{asset('BE/assets/vendor/fontawesome/css/brands.min.css')}}" rel="stylesheet">
    <link href="{{asset('BE/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('BE/assets/css/master.css')}}" rel="stylesheet">
    <link href="{{asset('BE/assets/vendor/flagiconcss/css/flag-icon.min.css')}}" rel="stylesheet">
    <link href="{{asset('BE/assets/vendor/datatables/datatables.min.css')}}" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <!-- sidebar navigation component -->
        <nav id="sidebar" class="active">
            <div class="sidebar-header">
                <img src="{{asset('BE/assets/img/bootstraper-logo.png')}}" alt="bootraper logo" class="app-logo">
            </div>
            <ul class="list-unstyled components text-secondary">
                <li>
                    <a href="{{route('admin.index')}}"><i class="fas fa-home"></i>Dashboard</a>
                </li>
                <li>
                    <a href="#tablesmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle no-caret-down"><i class="fas fa-layer-group"></i>Quản lý</a>
                    <ul class="collapse list-unstyled" id="tablesmenu">
                        <li>
                            <a href="{{route('user.index')}}"><i class="fas fa-angle-right"></i>Người dùng</a>
                        </li>
                        <li>
                            <a href="{{route('brand.index')}}"><i class="fas fa-angle-right"></i>Thương hiệu</a>
                        </li>
                        <li>
                            <a href="{{route('supplier.index')}}"><i class="fas fa-angle-right"></i>Nhà cung cấp</a>
                        </li>
                        <li>
                            <a href="{{route('category.index')}}"><i class="fas fa-angle-right"></i>Danh mục sản phẩm</a>
                        </li>
                        <li>
                            <a href="{{route('product.index')}}"><i class="fas fa-angle-right"></i>Sản phẩm</a>
                        </li>

                        <li>
                            <a href="{{route('post.index')}}"><i class="fas fa-angle-right"></i>Bài viết</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#ordersmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle no-caret-down"><i class="fas fa-layer-group"></i>Đơn hàng</a>
                    <ul class="collapse list-unstyled" id="ordersmenu">
                        <li>
                            <a href="{{route('od.index')}}"><i class="fas fa-angle-right"></i>Cần xác nhận</a>
                        </li>
                        <li>
                            <a href="{{route('od.ship')}}"><i class="fas fa-angle-right"></i>Vận chuyển hàng</a>
                        </li>
                        <li>
                            <a href="{{route('od.shipping')}}"><i class="fas fa-angle-right"></i>Đang vận chuyển</a>
                        </li>
                        <li>
                            <a href="{{route('od.err')}}"><i class="fas fa-angle-right"></i>Giao hàng lỗi</a>
                        </li>
                        <li>
                            <a href="{{route('od.done')}}"><i class="fas fa-angle-right"></i>Thành công</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#storagemenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle no-caret-down"><i class="fas fa-layer-group"></i>Kho hàng</a>
                    <ul class="collapse list-unstyled" id="storagemenu">
                        <li>
                            <a href="{{route('storage.input')}}"><i class="fas fa-angle-right"></i>Nhập Hàng</a>
                        </li>
                        <li>
                            <a href="{{route('storage.index')}}"><i class="fas fa-angle-right"></i>Tồn Kho</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- end of sidebar component -->
        <div id="body" class="active">
            <!-- navbar navigation component -->
            <nav class="navbar navbar-expand-lg navbar-white bg-white">
                <button type="button" id="sidebarCollapse" class="btn btn-light">
                    <i class="fas fa-bars"></i><span></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <div class="nav-dropdown">
                                <a href="#" id="nav2" class="nav-item nav-link dropdown-toggle text-secondary" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user"></i> <span>Xin Chào</span> <i style="font-size: .8em;" class="fas fa-caret-down"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end nav-link-menu">
                                    <ul class="nav-list">
                                        <li><a href="" class="dropdown-item"><i class="fas fa-address-card"></i> Profile</a></li>
                                        <li><a href="" class="dropdown-item"><i class="fas fa-envelope"></i> Messages</a></li>
                                        <li><a href="" class="dropdown-item"><i class="fas fa-cog"></i> Settings</a></li>
                                        <div class="dropdown-divider"></div>
                                        <li><a href="{{route('user.logout')}}" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- end of navbar navigation -->
            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="{{asset('BE/assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('BE/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('BE/assets/vendor/chartsjs/Chart.min.js')}}"></script>
    <script src="{{asset('BE/assets/js/dashboard-charts.js')}}"></script>
    <script src="{{asset('BE/assets/js/script.js')}}"></script>
    <script src="{{asset('BE/assets/vendor/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('BE/assets/js/initiate-datatables.js')}}"></script>
    <script>
        tinymce.init({
          selector: 'textarea', // Use <textarea> elements as the target
          plugins: 'autolink lists link image charmap print preview',
          toolbar: 'undo redo | formatselect | bold italic backcolor | \
            alignleft aligncenter alignright alignjustify | \
            bullist numlist outdent indent | removeformat | link image',
        });
    </script>
</body>

</html>
