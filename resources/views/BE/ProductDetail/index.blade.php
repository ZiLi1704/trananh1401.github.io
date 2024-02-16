@extends('Layout.BE')
@section('title', 'Sản Phẩm')
@section('content')
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">Loại sản phẩm</div>
            <div class="card-body">
                @if ($success = Session::get('success'))
                    <div class="alert alert-success">
                        <h5 class="alert-title"><i class="fas fa-check"></i>{{ $success }}</h5>
                    </div>
                @endif
                <a href="{{ route('productdetail.create')}}" class="btn btn-success">
                    <i class="fas fa-edit"></i>
                </a>
                <a href="{{ route('product.index')}}" class="btn btn-success">
                    Hoàn Thành
                </a>
                <table class="table table-hover" id="dataTables-example" width="100%">
                    <thead>
                        <tr>
                            <th style="width: 5%;">STT</th>
                            <th>Màu sắc</th>
                            <th>Số lượng nhập</th>
                            <th>Tồn kho</th>
                            <th>Giá nhập</th>
                            <th>Giá Bán</th>
                            <th style="width: 5%; text-align: right">Công Cụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($details as $detail)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $detail->color}}</td>
                                <td>{{ $detail->import_quantity}}</td>
                                <td>{{ $detail->quantity}}</td>
                                <td>{{ $detail->import_price}}</td>
                                <td>{{ $detail->sale_price}}</td>
                                <td>
                                    <ul style="display: flex; list-style-type: none;">
                                        <li style="margin-right: 10px">
                                            <a href="{{ route('productdetail.edit', $detail->id) }}" class="btn btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <div>
                                                <form action="{{ route('productdetail.destroy', $detail->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fas fa-trash"></i>
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
