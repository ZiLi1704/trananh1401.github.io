@extends('Layout.BE')
@section('title', 'Sản Phẩm')
@section('content')
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">Kho hàng</div>
            <div class="card-body">
                @if ($success = Session::get('success'))
                    <div class="alert alert-success">
                        <h5 class="alert-title"><i class="fas fa-check"></i>{{ $success }}</h5>
                    </div>
                @endif
                <table class="table table-hover" id="dataTables-example" width="100%">
                    <thead>
                        <tr>
                            <th style="width: 5%;">STT</th>
                            <th>Sản phẩm</th>
                            <th>Tồn kho</th>
                            <th>Giá nhập</th>
                            <th>Giá Bán</th>
                            <th style="width: 5%; text-align: right">Công Cụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productDetails as $detail)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{optional($detail->product)->name}} ({{ $detail->color}})</td>
                                <form action="{{ route('storage.edit') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$detail->id}}">
                                    <td>
                                        <input type="text" name="Nquantity{{ $detail->id }}" value="{{ old('Nquantity' . $detail->id, $detail->quantity) }}">
                                        @error('Nquantity' . $detail->id)
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </td>
                                    <td>
                                        <input type="text" name="Nimport{{ $detail->id }}" value="{{ old('Nimport' . $detail->id, $detail->import_price) }}">
                                        @error('Nimport' . $detail->id)
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </td>
                                    <td>
                                        <input type="text" name="Nsale{{ $detail->id }}" value="{{ old('Nsale' . $detail->id, $detail->sale_price) }}">
                                        @error('Nsale' . $detail->id)
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </td>
                                    <td>
                                        <button type="submit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </td>
                                </form>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
