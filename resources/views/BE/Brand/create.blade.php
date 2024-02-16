@extends('Layout.BE')
@section('title', 'Thương hiệu')
@section('content')
<div class="col-md-12 col-lg-12">
    <div class="card">
        <div class="card-header">Thêm mới thương hiệu</div>
        <div class="card-body">
            <div class="card-body">
                <form method="POST" action="{{ route('brand.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nhập thương hiệu:</label>
                        <input type="text" name="name" placeholder="Nhập ở đây"
                            class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="button" class="btn btn-secondary" value="Hủy bỏ" onclick="window.location='{{ route('brand.index') }}'" />
                        <button type="submit" class="btn btn-primary">Thêm thương hiệu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
