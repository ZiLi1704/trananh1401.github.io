@extends('Layout.FE')
@section('content')

 <!-- Breadcrumb Start -->
 <div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="{{route('index')}}">Trang chủ</a>
                <a class="breadcrumb-item text-dark" href="{{route('shop.show', $product->category_id)}}">Cửa hàng</a>
                <span class="breadcrumb-item active">Sản phẩm</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->


<!-- Shop Detail Start -->
<div class="container-fluid pb-5">
    <div class="row px-xl-5">
        <div class="col-lg-5 mb-30">
            <div id="product-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner bg-light">
                    <div class="carousel-item active">
                        <img style="height: 500px; width: 100%; object-fit: cover" src="{{asset($product->image)}}" alt="Image">
                    </div>
                    @foreach ($productimages as $productimage)
                        <div class="carousel-item">
                            <img  style="height: 500px; width: 100%" src="{{asset($productimage->image_name)}}" alt="Image">
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                    <i class="fa fa-2x fa-angle-left text-dark"></i>
                </a>
                <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                    <i class="fa fa-2x fa-angle-right text-dark"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-7 h-auto mb-30">
            <div class="h-100 bg-light p-30">
                <h3>{{$product->name}}</h3>
                <div class="text-primary mr-2">
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star-half-alt"></small>
                    <small class="far fa-star"></small>
                </div>
                <strong class="text-dark mr-3">Cấu hình:</strong>
                <div class="d-flex mb-3">
                    <ul class="row" style="list-style-type: none; text-align: left">
                        <div class="col">
                            <li><strong>Mã sản phẩm:</strong> {{$product->product_code}}</li>
                            <li><strong>keycap:</strong> {{$product->key_type}}</li>
                            <li><strong>Kit:</strong> {{$product->material}}</li>
                            <li><strong>Layout:</strong> {{$product->keyboard_type}} %</li>
                        </div>
                        <div class="col">
                            <li><strong>công tắc:</strong> {{$product->switch}}</li>
                            <li><strong>đèn nền:</strong> {{$product->backlight}}</li>
                            <li><strong>Pin:</strong> {{$product->battery}}</li>
                            <li><strong>Khả năng phù hợp:</strong>{{$product->compatibility}}</li>
                        </div>
                        <div class="col">
                            <li><strong>Kích cỡ:</strong> {{$product->size}}</li>
                            <li><strong>Căn nặng:</strong> {{$product->weight}} kg</li>
                            <li><strong>Bảo hành:</strong> {{$product->warranty}} months</li>
                       </div>
                    </ul>
                </div>
                <div class="d-flex mb-4">
                    <strong class="text-dark mr-3">Màu sắc:</strong>
                    <form id="product-form" action="{{route('cart.add')}}" method="post">
                        @csrf
                        @method('PUT')
                        @foreach ($productdetails as $productdetail)
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="{{$productdetail->id}}" name="color" data-sale-price="{{$productdetail->sale_price}}">
                                <label class="custom-control-label" for="{{$productdetail->id}}">{{$productdetail->color}}</label>
                            </div>
                        @endforeach
                        <input type="hidden" id="hidden-id" name="id" value="{{$productdetails[0]->id}}">
                        <input type="hidden" id="hidden-sale-price" name="sale_price" value="{{$productdetails[0]->sale_price}}">
                        <h3 id="product-price" class="font-weight-semi-bold mb-4">{{$productdetails[0]->sale_price}} VNĐ</h3>
                        <div class="d-flex align-items-center mb-4 pt-2">
                            <button class="btn btn-primary btn-minus" id="btn-minus">
                                <i class="fa fa-minus"></i>
                            </button>

                            <input type="text" class="form-control bg-secondary border-0 text-center" name="quantity" id="quantity-input" value="1">

                            <button class="btn btn-primary btn-plus" id="btn-plus">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                        <button type="submit" class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i>Thêm vào giỏ hàng</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row px-xl-5">
        <div class="col">
            <div class="bg-light p-30">
                <div class="nav nav-tabs mb-4">
                    <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Miêu tả</a>
                    <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3">Đánh giá (1)</a>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-pane-1">
                        <h4 class="mb-3">Đang Cập nhật</h4>
                    </div>
                    <div class="tab-pane fade" id="tab-pane-3">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="mb-4">1 Đánh giá</h4>
                                <div class="media mb-4">
                                    <img src="{{asset('FE/img/user.jpg')}}" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                    <div class="media-body">
                                        <h6>bot<small> - <i>Tháng 1 2024</i></small></h6>
                                        <div class="text-primary mb-2">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                            <i class="far fa-star"></i>
                                        </div>
                                        <p>{{$product->name}} là một sản phẩm bàn phím nhỏ gọn với chất liệu chất lượng và các tính năng linh hoạt. Phù hợp cho những người làm việc di động hoặc có không gian làm việc hạn chế. Tuy nhiên, có một số điểm chưa hoàn hảo như thiếu pin tích hợp và giới hạn trong việc tùy chỉnh Backlight. Đối với người dùng cần một bàn phím nhỏ gọn và đơn giản, {{$product->name}} có thể là lựa chọn phù hợp.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4 class="mb-4">Để lại đánh giá</h4>
                                <small>Địa chỉ email của bạn sẽ không được công bố. Các trường bắt buộc được đánh dấu *</small>
                                <div class="d-flex my-3">
                                    <p class="mb-0 mr-2">Đánh giá</p>
                                    <div class="text-primary">
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                </div>
                                <form>
                                    <div class="form-group">
                                        <label for="message">Đánh giá cửa bạn</label>
                                        <textarea id="message" cols="30" rows="5" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Tên của bạn</label>
                                        <input type="text" class="form-control" id="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email của bạn</label>
                                        <input type="email" class="form-control" id="email">
                                    </div>
                                    <div class="form-group mb-0">
                                        <input type="submit" value="Đánh giá" class="btn btn-primary px-3">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Shop Detail End -->


<!-- Products Start -->
<div class="container-fluid py-5">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Sản phẩm tương tự</span></h2>
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel related-carousel">
                @foreach ($products as $item)
                    <div class="product-item bg-light">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid" style="width: 100%; height: 200px; object-fit: cover" src="{{asset($item->image)}}" alt="">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <div style="width: 100%; word-wrap: break-word;">
                                <a class="h6 text-decoration-none"
                                href="{{ route('shop.detail', $item->id) }}">
                                {{ $item->name }}
                                </a>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>{{$item->price}} VNĐ</h5>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small>(99)</small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- Products End -->

@endsection

@section('scr')

<script>
$(document).ready(function () {
    // Chọn radio button đầu tiên
    $('input[type="radio"]:first').prop('checked', true).change();

    // Gán sự kiện 'change' cho tất cả radio buttons
    $('input[type="radio"]').on('change', function () {
        // Lấy giá trị từ radio button được chọn
        var selectedColorId = $(this).attr('id');
        var selectedSalePrice = $(this).data('sale-price');

        // Cập nhật giá trị ẩn trong form
        $('#hidden-id').val(selectedColorId);
        $('#hidden-sale-price').val(selectedSalePrice);

        // Cập nhật giá trị hiển thị trên trang
        $('#product-price').text(selectedSalePrice + ' VNĐ');
    });
});
document.addEventListener("DOMContentLoaded", function () {
        var quantityInput = document.getElementById("quantity-input");
        var btnMinus = document.getElementById("btn-minus");
        var btnPlus = document.getElementById("btn-plus");

        // Ngăn chặn sự kiện mặc định khi nút tăng được nhấn
        btnPlus.addEventListener("click", function (event) {
            event.preventDefault();
            incrementQuantity();
        });

        // Ngăn chặn sự kiện mặc định khi nút giảm được nhấn
        btnMinus.addEventListener("click", function (event) {
            event.preventDefault();
            decrementQuantity();
        });

        // Hàm tăng số lượng
        function incrementQuantity() {
            var currentQuantity = parseInt(quantityInput.value, 10);
            quantityInput.value = currentQuantity + 1;
        }

        // Hàm giảm số lượng
        function decrementQuantity() {
            var currentQuantity = parseInt(quantityInput.value, 10);
            if (currentQuantity > 1) {
                quantityInput.value = currentQuantity - 1;
            }
        }
    });
</script>

@endsection
