@extends('Layout.BE')
@section('title', 'Sản Phẩm')
@section('content')
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">Hình Ảnh Sản Phẩm</div>
            <div class="card-body">
                @if ($success = Session::get('success'))
                    <div class="alert alert-success">
                        <h5 class="alert-title"><i class="fas fa-check"></i>{{ $success }}</h5>
                    </div>
                @endif
                <a href="{{ route('productimage.create')}}" class="btn btn-success">
                    <i class="fas fa-edit"></i>
                </a>
                <a href="{{ route('productdetail.index')}}" class="btn btn-success">
                    Tiếp theo
                </a>
                <table class="table table-hover" id="dataTables-example" width="100%">
                    <thead>
                        <tr>
                            <th style="width: 5%;">STT</th>
                            <th>Ảnh minh họa</th>
                            <th style="width: 5%; text-align: right">Công Cụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($images as $image)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="{{ asset($image->image_name) }}" alt=""
                                        style="max-width: 100px; max-height: 100px;">
                                </td>
                                <td>
                                    <ul style="display: flex; list-style-type: none;">
                                        <li style="margin-right: 10px">
                                            <a href="{{ route('productimage.edit', $image->id) }}" class="btn btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <div>
                                                <form action="{{ route('productimage.destroy', $image->id) }}" method="post">
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
