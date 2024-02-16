@extends('Layout.BE')
@section('title', 'Sửa danh mục sản phẩm')
@section('content')

<div class="col-md-12 col-lg-12">
    <div class="card">
        <div class="card-header">Cập nhật danh mục sản phẩm</div>
        <div class="card-body">
            <form method="POST" action="{{ route('category.update', $category) }}">
                @method('PUT')
                @csrf
                <input type="hidden" name="ID" value="{{ $category->id }}">
                <div class="mb-3">
                    <label for="parent_id" class="form-label">Cấp danh mục</label>
                    <select name="parent_id" class="form-select">
                        <option value="">Danh mục chính</option>
                        @foreach($categories as $item)
                        @if ($item->parent_id===NULL)
                            <option value="{{ $item->id }}"
                                @if($item->depth > 0) style="padding-left: {{ $item->depth * 20 }}px" @endif>
                                {{ $item->name }}
                            </option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="brand_id" class="form-label">Thương hiệu:</label>
                    <select name="brand_id" class="form-select">
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" {{ $brand->id == old('parent_id', $category->brand_id) ? 'selected' : '' }}>
                                {{ $brand->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Danh mục mới:</label>
                    <input type="text" name="name" value="{{ old('name', $category->name) }}" class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <input type="button" class="btn btn-secondary" value="Hủy bỏ" onclick="window.location='{{ route('category.index') }}'" />
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
