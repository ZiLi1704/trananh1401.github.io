@extends('Layout.BE')
@section('title', 'Đơn hàng')
@section('content')
<div class="col-md-12 col-lg-12">
    <div class="card">
        <div class="card-header">Giao thành công</div>
        <div class="card-body">
            @if ($success = Session::get('success'))
            <div class="alert alert-success">
                <h5 class="alert-title"><i class="fas fa-check"></i>{{$success}}</h5>
            </div>
            @endif
            <a href="{{ route('od.index') }}" class="btn btn-success">
                <i class="fas fa-backward"></i>
            </a>
            <table class="table table-hover" id="dataTables-example" width="100%">
                <thead>
                    <tr>
                        <th style="width: 5%;">STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orderDetails as $od)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {{ $od->productDetail->product->name }} ({{$od->productDetail->color}})
                            </td>
                            <td>{{ $od->quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
