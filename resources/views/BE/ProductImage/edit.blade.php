@extends('Layout.BE')
@section('title', 'Sản Phẩm')
@section('content')
    <form method="POST" action="{{ route('productimage.update', $id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <!-- Các trường khác của form -->
        <div class="mb-3">
            <label for="image_name" class="form-label">Ảnh minh họa</label>
            <input type="file" name="image_name" class="form-control">
        </div>
        <div class="mb-3">
            <input type="button" class="btn btn-secondary" value="Hủy bỏ"
                onclick="window.location='{{ route('productimage.index') }}'" />
            <button type="submit" class="btn btn-primary">Lưu chỉnh sửa</button>
        </div>
    </form>
@endsection
