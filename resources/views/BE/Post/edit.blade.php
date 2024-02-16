@extends('Layout.BE')
@section('title', 'Sửa danh mục sản phẩm')
@section('content')

<div class="col-md-12 col-lg-12">
    <div class="card">
        <div class="card-header">Cập nhật danh mục sản phẩm</div>
        <div class="card-body">
            <form method="POST" action="{{ route('post.update', $post) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="mb-3">
                   <label for="title">Tiêu đề:</label>
                    <input type="text" name="title" value="{{ old('title', $post->title) }}">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Thay ảnh mới (nếu cần)</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="content">Nội dung:</label>
                    <textarea name="content" required>{{ old('content', $post->content) }}</textarea>
                </div>
                <div class="mb-3">
                    <input type="button" class="btn btn-secondary" value="Hủy bỏ" onclick="window.location='{{ route('post.index') }}'" />
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
