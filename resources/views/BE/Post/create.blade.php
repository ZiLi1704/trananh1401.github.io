@extends('Layout.BE')
@section('title', 'Bài viết')
@section('content')
<div class="col-md-12 col-lg-12">
    <div class="card">
        <div class="card-header">Thêm mới danh mục sản phẩm</div>
        <div class="card-body">
            <div class="card-body">
                <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Tên bài viết</label>
                        <input type="text" name="title" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Ảnh minh họa</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Nội dung</label>
                        <textarea name="content" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <input type="button" class="btn btn-secondary" value="Hủy bỏ" onclick="window.location='{{ route('post.index') }}'" />
                        <button type="submit" class="btn btn-primary">Thêm bài viết</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
