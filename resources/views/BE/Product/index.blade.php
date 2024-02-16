@extends('Layout.BE')
@section('title', 'Sản Phẩm')
@section('content')
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">Danh sách sản phẩm</div>
            <div class="card-body">
                @if ($success = Session::get('success'))
                    <div class="alert alert-success">
                        <h5 class="alert-title"><i class="fas fa-check"></i>{{ $success }}</h5>
                    </div>
                @endif
                <a href="{{ route('product.create')}}" class="btn btn-success">
                    <i class="fas fa-edit"></i>
                </a>

                <table class="table table-hover" id="dataTables-example" width="100%">
                    <thead>
                        <tr>
                            <th style="width: 5%;">STT</th>
                            <th>Tên </th>
                            <th>Ảnh</th>
                            <th>Danh Mục</th>
                            <th>Mã sản phẩm</th>
                            <th>Keycap</th>
                            <th>Chất liệu</th>
                            <th>Layout</th>
                            <th>công tắc</th>
                            <th>led</th>
                            <th>Sử dụng</th>
                            <th>kích cỡ</th>
                            <th>khối lượng</th>
                            <th>Khả năng thích nghi</th>
                            <th>Bảo hành</th>
                            <th style="width: 5%; text-align: right">Công Cụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name}}</td>
                                <td>
                                    <img src="{{ asset($item->image) }}" alt=""
                                        style="max-width: 100px; max-height: 100px;">
                                </td>
                                <td>{{ $item->category->name}}</td>
                                <td>{{ $item->product_code}}</td>
                                <td>{{ $item->key_type}}</td>
                                <td>{{ $item->material}}</td>
                                <td>{{ $item->keyboard_type}} %</td>
                                <td>{{ $item->switch}}</td>
                                <td>{{ $item->backlight}}</td>
                                <td>{{ $item->battery}}</td>
                                <td>{{ $item->size}}</td>
                                <td>{{ $item->weight}} kg</td>
                                <td>{{ $item->compatibility}}</td>
                                <th>{{ $item->warranty}} tháng</th>
                                <td>
                                    <ul style="display: flex; list-style-type: none;">
                                        <li style="margin-right: 10px">
                                            <a href="{{ route('product.edit', $item) }}" class="btn btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <div>
                                                <form action="{{ route('product.destroy', $item) }}" method="post">
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
