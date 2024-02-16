@extends('Layout.BE')
@section('title', 'Đơn hàng')
@section('content')
<div class="col-md-12 col-lg-12">
    <div class="card">
        <div class="card-header">Đơn hàng mới</div>
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
                        <th style="width: 250px; text-align: right">Công Cụ</th>
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
                                            <form action="{{ route('od.stt', $od->id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">
                                                    Xác Nhận
                                                </button>
                                            </form>
                                        </div>
                                    </li>
                                    <li style="margin-right: 10px">
                                        <div>
                                            <form action="{{ route('od.drop', $od->id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <a href="{{ route('od.dt', $od->id)}}"><input type="button"  class="btn btn-danger" value="Chi tiết"></a>
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
