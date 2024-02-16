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
            <table class="table table-hover" id="dataTables-example" width="100%">
                <thead>
                    <tr>
                        <th style="width: 5%;">STT</th>
                        <th>Email chính</th>
                        <th>Người Nhận</th>
                        <th>SĐT</th>
                        <th>Địa chỉ</th>
                        <th>Email Nhận</th>
                        <th>Tổng tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $od)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {{ $od->mainemail }}
                            </td>
                            <td>{{ $od->name }}</td>
                            <td>{{ $od->phone }}</td>
                            <td>{{ $od->address }}</td>
                            <td>{{ $od->email }}</td>
                            <td>{{ $od->total}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
