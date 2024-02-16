@extends('Layout.BE')
@section('title', 'Thương hiệu')
@section('content')

<div class="col-md-12 col-lg-12">
    <div class="card">
        <div class="card-header">Cập nhật tên thương hiệu</div>
        <div class="card-body">
            <form method="POST" action="{{ route('supplier.update', $supplier) }}">
                @method('PUT')
                @csrf
                <input type="hidden" name="ID" value="{{ $supplier->id }}">
                <div class="mb-3">
                    <label for="name" class="form-label">Tên nhà cung cấp:</label>
                    <input type="text" name="name" value="{{ old('name', $supplier->name) }}" class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Địa chỉ email:</label>
                    <input type="text" name="email" value="{{ old('email', $supplier->email) }}" class="form-control @error('email') is-invalid @enderror">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Số Điện thoại:</label>
                    <input type="text" name="phone" value="{{ old('phone', $supplier->phone) }}" class="form-control @error('phone') is-invalid @enderror">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <input type="button" class="btn btn-secondary" value="Hủy bỏ" onclick="window.location='{{ route('supplier.index') }}'" />
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
