@extends('Layout.FE')
@section('content')

<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="{{route('index')}}">Trang chính</a>
                <span class="breadcrumb-item active">Giỏ hàng</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->


<!-- Cart Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Sản phẩm</th>
                        <th>giá</th>
                        <th>số lượng</th>
                        <th>tổng</th>
                        <th>Công cụ</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach ($carts as $cart)
                    <tr>
                        <td class="align-middle">{{$cart->product_name}} {{$cart->detail_name}}</td>
                        <td class="align-middle">{{$cart->sale_price}} VNĐ</td>
                        <form action="{{route('cart.update')}}" method="post">
                            @csrf
                            @method('PUT')
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-minus" type="submit">
                                        <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" name="quantity" value="{{$cart->quantity}}">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-plus" type="submit">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle">
                                <input type="hidden" name="upid" value="{{$cart->id}}">
                                {{$cart->sale_price * $cart->quantity}} VNĐ
                            </td>
                        </form>
                        <form action="{{route('cart.delete')}}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="delid" value="{{$cart->id}}">
                            <td class="align-middle"><button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button></td>
                        </form>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <form class="mb-30" action="">
                <div class="input-group">
                    <input type="text" class="form-control border-0 p-4" placeholder="Coupon Code">
                    <div class="input-group-append">
                        <button class="btn btn-primary">Thêm mã giảm giá</button>
                    </div>
                </div>
            </form>
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Hóa đơn</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Tạm tính</h6>
                        <h6>{{$totalAmount}} VNĐ</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Shipping</h6>
                        <h6 class="font-weight-medium">
                            @if ( $totalAmount <= 999999)
                                20000 VNĐ
                            @else
                                0 VNĐ
                            @endif
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
                    <a href="{{route('cart.checkout')}}"><input type="button" class="btn btn-block btn-primary font-weight-bold my-3 py-3" value="Tạo đơn"></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->
@endsection

@section('scr')
<script>
    $(document).ready(function () {
        $(".btn-plus").on("click", function () {
            var quantityInput = $("#quantity");
            var currentQuantity = parseInt(quantityInput.val());
            quantityInput.val(currentQuantity + 1);
        });

        $(".btn-minus").on("click", function () {
            var quantityInput = $("#quantity");
            var currentQuantity = parseInt(quantityInput.val());
            if (currentQuantity > 1) {
                quantityInput.val(currentQuantity - 1);
            }
        });
    });
</script>
@endsection
