@extends('Layout.BE')
@section('title', 'Sản Phẩm')
@section('content')
<div class="col-md-12 col-lg-12">
    <div class="card">
        <div class="card-header">Thêm ảnh</div>
        <div class="card-body">
            <div class="card-body">
                <form method="POST" action="{{ route('productimage.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="product_id" class="form-control" value="{{ session('newProductId') }}">
                    <div class="mb-3">
                        <label for="image_name" class="form-label">Ảnh minh họa</label>
                        <input type="file" name="image_name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <input type="button" class="btn btn-secondary" value="Hủy bỏ" onclick="window.location='{{ route('productimage.index') }}'" />
                        <button type="submit" class="btn btn-primary">Thêm ảnh</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
