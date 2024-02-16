@extends('Layout.BE')
@section('title', 'Đơn hàng')
@section('content')
<div class="col-md-12 col-lg-12">
    <div class="card">
        <div class="card-header">Thêm mã vận đơn</div>
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
                        <th style="width: 300px; text-align: right">Công Cụ</th>
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
                            <td>
                                <ul style="display: flex; list-style-type: none;">
                                    <li style="margin-right: 10px">
                                        <div>
                                            <form action="{{ route('od.shipOrder', $od->id) }}" method="post">
                                                @csrf
                                                <!-- Add the following lines for validation -->
                                                <div class="form-group">
                                                    <input type="text" name="order_code" class="form-control" >
                                                    @error('order_code')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <button type="submit" class="btn btn-danger">
                                                    Giao Hàng
                                                </button>
                                            </form>
                                        </div>
                                    </li>
                                    <li style="margin-right: 10px">
                                        <div>
                                            <form action="{{ route('od.unstt', $od->id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">
                                                    Quay Lại
                                                </button>
                                            </form>
                                        </div>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
