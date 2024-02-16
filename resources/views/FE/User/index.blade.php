@extends('Layout.FE')
@section('content')
 <!-- Breadcrumb Start -->
 <div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="{{route('index')}}">Trang chủ</a>
                <span class="breadcrumb-item active">Cá nhân</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<div class="container-fluid pb-5">
    <div class="row px-xl-5">
        <div class="col">
            <div class="bg-light p-30">
                <div class="nav nav-tabs mb-4">
                    <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Thông tin</a>
                    <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3">Đơn hàng</a>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-pane-1">
                        <div class="row" style="min-height: 60vh">
                            <div class="col-2" style="background-color: #FFD333 ">
                                <div style="width: 150px; height: 150px; overflow: hidden; border-radius: 50%; margin-top:20px ;margin-bottom: 10px">
                                    <img src="{{ asset($user->avatar_image) }}" style="width: 100%; height: 100%; object-fit: cover;" alt="avatar_image">
                                </div>
                                <h5 style="margin-top:10px ">{{ $user->name }}</h5>
                            </div>
                            <div class="col-10" style="background-color: #1a0000">
                                <div style="text-align: right; margin-top:20px">
                                    <a href="{{route('user.image')}}">
                                        <input type="button" value="Cập nhật thông tin">
                                    </a>
                                </div>
                               <table style="height: 80%; width: 100%">
                                    <tr>
                                        <td style="text-align: left; width: 140px; "><h5 style="color:white">Email: </h5></td>
                                        <td style="text-align: left; "><h5 style="color:white">{{$user->email}}</h5></td>
                                    </tr>
                                    <tr >
                                        <td style="text-align: left; "><h5 style="color:white">Số điện thoại: </h5></td>
                                        <td style="text-align: left; "><h5 style="color:white">{{$user->phone}}</h5></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left; "><h5 style="color:white">Địa chỉ: </h5></td>
                                        <td style="text-align: left; "><h5 style="color:white">{{$user->address}}</h5></td>
                                    </tr>
                               </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-pane-3">
                        <div class="row" style="min-height: 60vh">
                            <div style="height: 500px; width: 100% ;background-color: black; overflow-y: scroll">
                                <table style="width: 100%">
                                    <tr style="border: 1px solid white; height: 50px; top: 0">
                                        <td style="width: 50px;"><h5 style="color: white">STT</h5></td>
                                        <td style="width: 100px;"><h5 style="color: white">Mã vận đỡn</h5></td>
                                        <td style="text-align: center; color: white"><h5 style="color: white">Địa chỉ nhận</h5></td>
                                        <td style="text-align: center; color: white; width: 100px"><h5 style="color: white">Tổng tiền</h5></td>
                                        <td style="width: 150px; text-align: center;color: white"><h5 style="color: white">Trạng thái</h5></td>
                                    </tr>
                                    @foreach ($orders as $order)
                                    <tr style="border: 1px solid white; height: 50px;">
                                        <td style="text-align: left"><h6 style="color: white">{{$loop->iteration}}</h6></td>
                                        <td style="text-align: left"><h6 style="color: white">
                                            @if ($order->order_code == NULL)
                                                Chưa có
                                            @else
                                                {{$order->order_code}}
                                            @endif
                                        </h6></td>
                                        <td style="text-align: center"><h6 style="color: white">{{$order->address}}</h6></td>
                                        <td style="text-align: left"><h6 style="color: white">{{$order->total}}</h6></td>
                                        <td style="text-align: center"><h6 style="color: white">
                                            @if ($order->status != "Đang giao hàng")
                                                {{$order->status}}
                                            @else
                                                <form action="{{route('od.ok')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$order->id}}">
                                                    <button type="submit">Đã nhận hàng</button>
                                                </form>
                                                <form action="{{route('od.shipErr2')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$order->id}}">
                                                    <button type="submit">Lỗi</button>
                                                </form>
                                            @endif
                                        </h6></td>
                                    </tr>
                                    @endforeach

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
