@extends('Layout.BE')
@section('title', 'Thương hiệu')
@section('content')
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">Quản lý thương hiệu</div>
            <div class="card-body">
                @if ($success = Session::get('success'))
                    <div class="alert alert-success">
                        <h5 class="alert-title"><i class="fas fa-check"></i>{{ $success }}</h5>
                    </div>
                @endif
                <a href="{{ route('brand.create') }}" class="btn btn-success">
                    <i class="fas fa-edit"></i>
                </a>
                <table class="table table-hover" id="dataTables-example" width="100%">
                    <thead>
                        <tr>
                            <th style="width: 5%;">STT</th>
                            <th>Tên thương hiệu</th>
                            <th style="width: 5%; text-align: right">Công Cụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($brands as $brand)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $brand->name }}</td>
                                <td>
                                    <ul style="display: flex; list-style-type: none;">
                                        <li style="margin-right: 10px">
                                            <a href="{{ route('brand.edit', $brand) }}" class="btn btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <div>
                                                <form action="{{ route('brand.destroy', $brand) }}" method="post">
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
