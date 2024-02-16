@extends('Layout.BE')
@section('title', 'Danh mục sản phẩm')
@section('content')
<div class="col-md-12 col-lg-12">
    <div class="card">
        <div class="card-header">Khôi phục danh mục sản phẩm</div>
        <div class="card-body">
            @if ($success = Session::get('success'))
            <div class="alert alert-success">
                <h5 class="alert-title"><i class="fas fa-check"></i>{{$success}}</h5>
            </div>
            @endif
            <a href="{{ route('category.index') }}" class="btn btn-success">
                <i class="fas fa-backward"></i>
            </a>
            <table class="table table-hover" id="dataTables-example" width="100%">
                <thead>
                    <tr>
                        <th style="width: 5%;">STT</th>
                        <th>Danh Mục Chính</th>
                        <th>Danh Mục Phụ</th>
                        <th>Thương Hiệu</th>
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
                                        <div>
                                           <form action="{{ route('category.restore', $category->id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-success"><i class="fas fa-undo"></i></button>
                                             </form>
                                        </div>

                                    </li>
                                    <li>
                                        <div>
                                            <form action="{{ route('category.forceDelete', $category->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
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
