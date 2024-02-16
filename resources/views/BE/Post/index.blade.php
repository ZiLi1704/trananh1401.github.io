@extends('Layout.BE')
@section('title', 'Bài viết')
@section('content')
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">Quản lý bài viết</div>
            <div class="card-body">
                @if ($success = Session::get('success'))
                    <div class="alert alert-success">
                        <h5 class="alert-title"><i class="fas fa-check"></i>{{ $success }}</h5>
                    </div>
                @endif
                <a href="{{ route('post.create') }}" class="btn btn-success">
                    <i class="fas fa-edit"></i>
                </a>
                <table class="table table-hover" id="dataTables-example" width="100%">
                    <thead>
                        <tr>
                            <th style="width: 5%;">STT</th>
                            <th>Tên bài viết</th>
                            <th>Ảnh minh họa</th>
                            <th style="width: 30%;">Nội dung</th>
                            <th style="width: 5%; text-align: right">Công Cụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $post->title }}</td>
                                <td>
                                    <img src="{{ asset($post->image) }}" alt=""
                                        style="max-width: 100px; max-height: 100px;">
                                </td>
                                <td>{{ $post->content }}</td>
                                <td>
                                    <ul style="display: flex; list-style-type: none;">
                                        <li style="margin-right: 10px">
                                            <a href="{{ route('post.edit', $post) }}" class="btn btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <div>
                                                <form action="{{ route('post.destroy', $post) }}" method="post">
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
