@extends('Layout.FE')
@section('content')

 <!-- Breadcrumb Start -->
 <div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="{{route('index')}}">Trang chính</a>
                <span class="breadcrumb-item active">Tạo đơn</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->


<!-- Checkout Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-8">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Billing Address</span></h5>
            <form action="{{route('cart.order')}}" method="post">
                @csrf
            <div class="bg-light p-30 mb-5">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Tên đầy đủ</label>
                        <input class="form-control" type="text" name="name" value="{{$user->name}}">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>E-mail</label>
                        <input class="form-control" type="text" name="email" value="{{$user->email}}">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Số điện thoại</label>
                        <input class="form-control" type="text" name="phone" value="{{$user->phone}}">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Địa chỉ</label>
                        <input class="form-control" type="text" name="address" value="{{$user->address}}">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Chi tiết </span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom">
                    <h6 class="mb-3">Sản phẩm</h6>
                    @foreach ($carts as $cart)
                        <div class="d-flex justify-content-between">
                            <p>{{$cart->product_name}} {{$cart->detail_name}}</p>
                            <p>{{$cart->sale_price * $cart->quantity}} VNĐ</p>
                    </div>
                    @endforeach
                </div>
                <div class="border-bottom pt-3 pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Tạm tính</h6>
                        <h6>{{ $totalAmount}} VNĐ</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Shipping</h6>
                        <h6 class="font-weight-medium">
                            @if ( $totalAmount <= 999999)
                                20000
                            @else
                                0
                            @endif
                            VNĐ
                        </h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Tổng</h5>
                        <h5>
                            @if ( $totalAmount <= 999999)
                                {{$totalAmount + 20000}}
                            @else
                                {{$totalAmount}}
                            @endif
                             VNĐ
                        </h5>
                    </div>
                </div>
                <div class="pt-2">
                    <button class="btn btn-block btn-primary font-weight-bold py-3">Tạo Đơn</button>
                </div>
            </div>
        </div>
    </form >
    </div>
</div>
<!-- Checkout End -->
@endsection
