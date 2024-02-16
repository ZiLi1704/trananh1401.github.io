@extends('Layout.BE')
@section('title', 'Sản Phẩm')
@section('content')
<div class="col-md-12 col-lg-12">
    <div class="card">
        <div class="card-header">Thêm loại sản phẩm</div>
        <div class="card-body">
            <div class="card-body">
                <form method="POST" action="{{ route('productdetail.update', $id)}}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="color" class="form-label">Màu sắc:</label>
                        <input type="text" name="color" placeholder="Nhập ở đây"
                            class="form-control @error('color') is-invalid @enderror" value="{{ old('color') }}"/>
                        @error('color')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="import_quantity" class="form-label">Số lượng nhập:</label>
                        <input type="text" name="import_quantity" placeholder="Nhập ở đây"
                            class="form-control @error('import_quantity') is-invalid @enderror" value="{{ old('import_quantity') }}"/>
                        @error('import_quantity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Tồn kho:</label>
                        <input type="text" name="quantity" placeholder="Nhập ở đây"
                            class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity') }}"/>
                        @error('quantity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="import_price" class="form-label">Giá nhập:</label>
                        <input type="text" name="import_price" placeholder="Nhập ở đây"
                            class="form-control @error('import_price') is-invalid @enderror" value="{{ old('import_price') }}"/>
                        @error('import_price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="sale_price" class="form-label">Giá nhập:</label>
                        <input type="text" name="sale_price" placeholder="Nhập ở đây"
                            class="form-control @error('sale_price') is-invalid @enderror" value="{{ old('sale_price') }}"/>
                        @error('sale_price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="button" class="btn btn-secondary" value="Hủy bỏ" onclick="window.location='{{ route('productdetail.index') }}'" />
                        <button type="submit" class="btn btn-primary">Thêm Loại Sản Phẩm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
