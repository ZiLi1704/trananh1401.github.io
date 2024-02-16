@extends('Layout.BE')
@section('title', 'Danh mục sản phẩm')
@section('content')
<div class="col-md-12 col-lg-12">
    <div class="card">
        <div class="card-header">Danh mục sản phẩm</div>
        <div class="card-body">
            @if ($success = Session::get('success'))
            <div class="alert alert-success">
                <h5 class="alert-title"><i class="fas fa-check"></i>{{$success}}</h5>
            </div>
            @endif
            <a href="{{ route('category.create') }}" class="btn btn-success">
                <i class="fas fa-edit"></i>
            </a>
            <a href="{{ route('category.trash') }}" class="btn btn-success">
                <i class="fas fa-recycle"></i>
            </a>
            <table class="table table-hover" id="dataTables-example" width="100%">
                <thead>
                    <tr>
                        <th style="width: 5%;">STT</th>
                        <th>Danh Mục Chính</th>
                        <th>Danh Mục Phụ</th>
                        <td>
                            Thương Hiệu
                        </td>
                        <th style="width: 5%; text-align: right">Công Cụ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {{ $category->name }}
                            </td>
                            <td>
                                <div>
                                    @if($category->children->count() > 0)
                                        <ul style="list-style-type: none">
                                            @foreach($category->children as $child)
                                                <li>{{ $child->name }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </td>
                            <td>
                                {{ $category->brand->name }}
                            </td>
                            <td>
                                <ul style="display: flex; list-style-type: none;">
                                    <li style="margin-right: 10px">
                                        <a href="{{ route('category.edit', $category) }}" class="btn btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <div>
                                            <form action="{{ route('category.destroy', $category) }}" method="post">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
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
