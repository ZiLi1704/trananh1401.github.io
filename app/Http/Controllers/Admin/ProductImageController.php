<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductImageRequest;
use App\Http\Requests\Product\UpdateProductImageRequest;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $images = ProductImage::where('product_id', Session::get('newProductId'))->get();
        return view('BE.ProductImage.index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('BE.ProductImage.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductImageRequest $request)
    {
        try {
            $imagePath = $request->file('image_name')->store('images', 'public');
            ProductImage::create([
                'product_id' => $request->product_id,
                'image_name' => 'storage/' . $imagePath,
            ]);

            return redirect()->route('productimage.index')->with('success', 'Thêm ảnh thành công');
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
        return view('BE.ProductImage.edit', compact('id'));
    }

    public function update(UpdateProductImageRequest $request, $id)
{
    // Tìm đối tượng ProductImage dựa trên $id
    $productImage = ProductImage::findOrFail($id);

    if ($request->hasFile('image_name')) {
        $imagePath = $request->file('image_name')->store('images', 'public');
        $productImage->update(['image_name' => 'storage/' . $imagePath]);
    }

    return redirect()->route('productimage.index')->with('success', 'Cập nhật ảnh thành công');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Tìm hình ảnh dựa trên ID
        $productImage = ProductImage::find($id);
        // Kiểm tra xem hình ảnh có tồn tại không
        if (!$productImage) {
            return redirect()->route('productimage.index')->with('error', 'Không tìm thấy hình ảnh');
        }

        // Xóa hình ảnh
        $productImage->delete();

        return redirect()->route('productimage.index')->with('success', 'Xóa ảnh thành công');
    }
}
