<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>MKStore</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="{{ asset('FE/img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="{{ url('https://fonts.gstatic.com') }}">
    <link href="{{ url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap') }}"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="{{ url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css') }}"
        rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('FE/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('FE/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('FE/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
            <div class="col-lg-4">
                <a href="{{ route('index') }}" class="text-decoration-none">
                    <span class="h1 text-uppercase text-primary bg-dark px-2">MK</span>
                    <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Store</span>
                </a>
            </div>
            <div class="col-lg-4 col-6 text-left">
                <form action="">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for products">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4 col-6 text-right">
                <p class="m-0">Hotline</p>
                <h5 class="m-0">0977 346 029</h5>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid bg-dark mb-30">
        <div class="row px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse"
                    href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                    <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Danh Mục</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light"
                    id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                    <div class="navbar-nav w-100">
                        @foreach ($categories as $category)
                            @if ($category->parent_id == null)
                                <div class="nav-item dropdown dropright">
                                    <a href="#" class="nav-link dropdown-toggle"
                                        data-toggle="dropdown">{{ $category->name }}<i
                                            class="fa fa-angle-right float-right mt-1"></i></a>
                                    <div class="dropdown-menu position-absolute rounded-0 border-0 m-0">
                                        @foreach ($categories as $childCategory)
                                            @if ($childCategory->parent_id == $category->id)
                                                <a href="{{ route('shop.show', $childCategory->id) }}"
                                                    class="dropdown-item">{{ $childCategory->name }}
                                                    {{ $childCategory->brand->name }}</a>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <span class="h1 text-uppercase text-dark bg-light px-2">MK</span>
                        <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Store</span>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="{{ route('index') }}" class="nav-item nav-link">Trang chủ</a>
                            <a href="{{route('home.contact')}}" class="nav-item nav-link">Liên hệ</a>
                            <a href="" class="nav-item nav-link">Bài viết</a>
                            <a href="" class="nav-item nav-link">Tuyển dụng</a>
                            <a href="" class="nav-item nav-link"></a>
                        </div>
                        <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                            <a href="{{route('cart.index')}}" class="btn px-0 ml-3">
                                <i class="fas fa-shopping-cart text-primary"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle"
                                    style="padding-bottom: 2px;">{{ $totalQuantity }}</span>
                            </a>
                            @if (!session()->has('userID'))
                                <a href="{{ route('user.login') }}" class="btn px-0">
                                    <i class="fas fa-user text-primary"></i>
                                </a>
                            @else
                                <a href="{{ route('user.index2') }}">Xin chào, {{ session('name') }}</a>
                                <span class="badge text-secondary border border-secondary"
                                    style="padding-bottom: 2px;">
                                    <a href="{{ route('user.logout') }}">Đăng Xuất</a>
                                </span>
                            @endif
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    @yield('content')

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-secondary mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <h5 class="text-secondary text-uppercase mb-4">Thông tin hữu ích</h5>
                <p class="mb-4">Bàn phím cơ là một thiết bị đầu vào cho máy tính được thiết kế với cơ chế switch cơ
                    học, mang lại cảm giác gõ chắc chắn, độ nhạy cao và độ bền ấn tượng, tạo nên trải nghiệm gõ phím đặc
                    biệt cho người dùng.</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>22a/55/175,Lạc Long Quân, Cầu
                    Giấy, Hà Nội</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>anhtq1704@gmail.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>0977 346 029</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Đường dẫn hữu ích</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="{{ 'index' }}"><i
                                    class="fa fa-angle-right mr-2"></i>Trang chủ</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Tuyển
                                Dụng</a>
                            <a class="text-secondary" href="#"><i class="fa fa-angle-right mr-2"></i>Liên
                                Hệ</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Mạng xã hội</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="#"><i
                                    class="fa fa-angle-right mr-2"></i>Facebook</a>
                            <a class="text-secondary mb-2" href="#"><i
                                    class="fa fa-angle-right mr-2"></i>Youtube</a>
                            <a class="text-secondary mb-2" href="#"><i
                                    class="fa fa-angle-right mr-2"></i>Zalo</a>
                            <a class="text-secondary mb-2" href="#"><i
                                    class="fa fa-angle-right mr-2"></i>Instagram</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Tin tức</h5>
                        <p>Theo dõi chúng tôi để cập nhật sản phẩm sớm nhất</p>
                        <form action="">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Email của bạn">
                                <div class="input-group-append">
                                    <button class="btn btn-primary">đăng ký</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top mx-xl-5 py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-secondary">
                    &copy; <a class="text-primary" href="#">Domain</a>. All Rights Reserved. Designed
                    by
                    <a class="text-primary" href="{{ url('https://htmlcodex.com') }}">HTML Codex</a>
                </p>
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="{{ asset('FE/img/payments.png') }}" alt="">
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="{{ asset('FE/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('FE/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('FE/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('FE/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Contact Javascript File -->
    <script src="{{ asset('FE/mail/jqBootstrapValidation.min.js') }}"></script>
    <script src="{{ asset('FE/mail/contact.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('FE/js/main.js') }}"></script>
    @yield('scr')
</body>

</html>
