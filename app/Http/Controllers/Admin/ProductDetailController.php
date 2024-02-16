<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductDetailRequest;
use App\Http\Requests\Product\UpdateProductDetailRequest;
use App\Models\ProductDetail;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductDetailController extends Controller
{
public function index()
{
    $details = ProductDetail::where('product_id', Session::get('newProductId'))->get();
    return view('BE.ProductDetail.index', compact('details'));
}

/**
 * Show the form for creating a new resource.
 */
public function create()
{
    return view('BE.ProductDetail.create');
}

/**
 * Store a newly created resource in storage.
 */
public function store(StoreProductDetailRequest $request)
    {
        try {
            $data = $request->all();
            ProductDetail::create($data);
            return redirect()->route('productdetail.index')->with('success', 'Thêm thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

/**
 * Display the specified resource.
 */
public function show(string $id)
{
    //
}

/**
 * Show the form for editing the specified resource.
 */
public function edit($id)
{
    return view('BE.ProductDetail.edit', compact('id'));
}

public function update(UpdateProductDetailRequest $request, $id)
{
    // Tìm đối tượng ProductImage dựa trên $id
    $productDetail = ProductDetail::findOrFail($id);

    $productDetail->update($request->all());

    return redirect()->route('productdetail.index')->with('success', 'Cập nhật ảnh thành công');
}

/**
 * Remove the specified resource from storage.
 */
public function destroy($id)
{
    // Tìm hình ảnh dựa trên ID
    $productdetail = ProductDetail::find($id);
    // Kiểm tra xem hình ảnh có tồn tại không

    // Xóa hình ảnh
    $productdetail->delete();

    return redirect()->route('productdetail.index')->with('success', 'Xóa thành công');
}

public function storage()
{
    $productDetails = ProductDetail::with('product:id,name')->get();
    return view('BE.storage.index', compact('productDetails'));
}

public function storage_edit(Request $request)
{
    $id = $request->id;
    $rules = [
        'Nquantity' . $id => 'required|numeric',
        'Nimport' . $id => 'required|numeric',
        'Nsale' . $id => 'required|numeric',
    ];

    // Thông báo kiểm tra
    $messages = [
        'Nquantity' . $id . '.required' => 'Trường số lượng là bắt buộc.',
        'Nquantity' . $id . '.numeric' => 'Số lượng phải là một số.',
        'Nimport' . $id . '.required' => 'Trường giá nhập là bắt buộc.',
        'Nimport' . $id . '.numeric' => 'Giá nhập phải là một số.',
        'Nsale' . $id . '.required' => 'Trường giá bán là bắt buộc.',
        'Nsale' . $id . '.numeric' => 'Giá bán phải là một số.',
    ];

    // Thực hiện kiểm tra hợp lệ
    $request->validate($rules, $messages);
    $pd = ProductDetail::find($id)->first();
    $pd->quantity = $request->input('Nquantity' . $id);
    $pd->import_price = $request->input('Nimport' . $id);
    $pd->sale_price = $request->input('Nsale' . $id);

    $pd->save();
    return redirect()->back()->with('success', 'Cập nhật kho thành công.');
}

public function input()
{
    $sups = Supplier::all();
    $productDetails = ProductDetail::with('product:id,name')->get();
    return view('BE.storage.input', compact('productDetails', 'sups'));
}

public function add(Request $request)
{
    $id = $request->prd_id;
    $request->validate([
        'input' => 'required|numeric',
    ], [
        'input.required' => 'Trường số lượng là bắt buộc.',
        'input.numeric' => 'Số lượng phải là một số.',
    ]);
    $pd = ProductDetail::find($id);
    $pd->import_quantity = $request->input;
    $pd->quantity = $pd->quantity  + $request->input;
    $pd->save();
    return redirect()->back()->with('success', 'Nhập hàng thành công.');
}
}

