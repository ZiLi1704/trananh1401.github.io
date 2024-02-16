@extends('Layout.BE')
@section('title', 'Nhập hàng')
@section('content')
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">Nhập hàng</div>
            <div class="card-body">
                <div class="card-body">
                    @if ($success = Session::get('success'))
                    <div class="alert alert-success">
                        <h5 class="alert-title"><i class="fas fa-check"></i>{{ $success }}</h5>
                    </div>
                     @endif
                    <form method="POST" action="{{ route('storage.add') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="prd_id" class="form-label">Chọn sản phầm</label>
                            <select name="prd_id" class="form-select">
                                @foreach ($productDetails as $detail)
                                    <option value="{{ $detail->id }}">
                                        {{optional($detail->product)->name}} ({{ $detail->color}})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="sup_id" class="form-label">Chọn nhà cung cấp</label>
                            <select name="sup_id" class="form-select">
                                @foreach($sups as $sup)
                                    <option value="{{ $sup->id }}">
                                        {{ $sup->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="input" class="form-label">Nhập số lượng:</label>
                            <input type="text" name="input" placeholder="Nhập ở đây"
                                class="form-control @error('input') is-invalid @enderror">
                            @error('input')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Nhập hàng</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
