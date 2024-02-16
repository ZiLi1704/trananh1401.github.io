@extends('Layout.BE')
@section('title', 'Nhà cung cấp')
@section('content')
<div class="col-md-12 col-lg-12">
    <div class="card">
        <div class="card-header">Thêm mới nhà cung cấp</div>
        <div class="card-body">
            <form method="POST" action="{{ route('supplier.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Tên nhà cung cấp:</label>
                    <input type="text" name="name" placeholder="Nhập tên nhà cung cấp"
                        class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Địa chỉ email:</label>
                    <input type="text" name="email" placeholder="Nhập địa chỉ email"
                        class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Số điện thoại:</label>
                    <input type="text" name="phone" placeholder="Nhập số điện thoại"
                        class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <input type="button" class="btn btn-secondary" value="Hủy bỏ" onclick="window.location='{{ route('supplier.index') }}'" />
                    <button type="submit" class="btn btn-primary">Thêm nhà cung cấp</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
