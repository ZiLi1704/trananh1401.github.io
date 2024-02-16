@extends('Layout.BE')
@section('title', 'Sản Phẩm')
@section('content')
<div class="col-md-12 col-lg-12">
    <div class="card">
        <div class="card-header">Cập nhật sản phẩm</div>
        <div class="card-body">
            <div class="card-body">
                <form method="POST" action="{{ route('product.update', $product) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên sản phẩm:</label>
                        <input type="text" name="name" placeholder="Nhập ở đây"
                            class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $product->name) }}"/>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Chọn danh mục:</label>
                        <select name="category_id" class="form-select">
                            @foreach($categories as $item)
                            @if ($item->parent_id != NULL)
                                <option value="{{ $item->id }}"
                                    @if(old('category_id', $product->category_id) == $item->id) selected @endif
                                    @if($item->depth > 0) style="padding-left: {{ $item->depth * 20 }}px" @endif>
                                    {{ $item->name }} {{$item->brand->name}}
                                </option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="product_code" class="form-label">Mã: </label>
                        <input type="text" name="product_code" placeholder="Nhập ở đây"
                            class="form-control @error('product_code') is-invalid @enderror" value="{{ old('product_code', $product->product_code) }}"/>
                        @error('product_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="key_type" class="form-label">Loại keycap: </label>
                        <select name="key_type" class="form-select">
                            <option value="">không có keycap</option>
                            <option value="ABS">ABS</option>
                            <option value="PBT">PBT</option>
                            <option value="PC">PC</option>
                            <option value="POM">POM</option>
                            <option value="PVC">PVC</option>
                            <option value="Kim loại">Kim loại</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="material" class="form-label">Chất liệu: </label>
                        <select name="material" class="form-select">
                            <option value="Nhựa">Nhựa</option>
                            <option value="Nhôm">Nhôm</option>
                            <option value="Gỗ">Gỗ</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="keyboard_type" class="form-label">Layout Phím: </label>
                        <select name="keyboard_type" class="form-select">
                            <option value="">layout chuột</option>
                            <option value="60">60</option>
                            <option value="65">65</option>
                            <option value="75">75</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="switch" class="form-label">Công tắc cơ: </label>
                        <select name="switch" class="form-select">
                            <option value="Linear">Linear</option>
                            <option value="Tactile">Tactile</option>
                            <option value="Clicky">Clicky</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="backlight" class="form-label">Led: </label>
                        <select name="backlight" class="form-select">
                            <option value="">Không Có</option>
                            <option value="Trắng">Trắng</option>
                            <option value="Đơn sắc">Đơn sắc</option>
                            <option value="Rainbow">Rainbow</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="battery" class="form-label">Sử dụng: </label>
                        <select name="battery" class="form-select">
                            <option value="Pin">Pin</option>
                            <option value="Dây">Dây</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="size" class="form-label">Kích thước: </label>
                        <input type="text" name="size" placeholder="Nhập ở đây"
                            class="form-control @error('size') is-invalid @enderror" value="{{ old('size' , $product->size) }}"/>
                        @error('size')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="weight" class="form-label">Khối lượng (kg): </label>
                        <input type="text" name="weight" placeholder="Nhập ở đây"
                            class="form-control @error('weight') is-invalid @enderror" value="{{ old('weight' , $product->weight) }}"/">
                        @error('weight')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="compatibility" class="form-label">Khả năng thích nghi: </label>
                        <select name="compatibility" class="form-select">
                            <option value="Mac/Win">Mac/Win</option>
                            <option value="Mac">Mac</option>
                            <option value="Win">Win</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="warranty" class="form-label">Bảo hành: </label>
                        <select name="warranty" class="form-select">
                            <option value="6">6</option>
                            <option value="12">12</option>
                            <option value="24">24</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Ảnh sản phẩm:</label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"/>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="button" class="btn btn-secondary" value="Hủy bỏ" onclick="window.location='{{ route('product.index') }}'" />
                        <button type="submit" class="btn btn-primary">Cập nhật Sản Phẩm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
