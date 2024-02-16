<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\Category\StoreCategoryRequest;
use Illuminate\Http\Request;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Brand;
use Throwable;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('children', 'brand')
        ->whereNull('deleted_at') // Lọc chỉ những bản ghi không bị xóa (soft deleted)
        ->orderBy('parent_id')
        ->get();
         return view('BE.Category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::with('children')->orderBy('parent_id')->get();
        $brands = Brand::all();
        return view('BE.Category.create', compact('categories','brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        try {
            $parentId = $request->input('parent_id', null);
            $brandId = $request->input('brand_id');
            Category::create([
                'name' => $request->name,
                'brand_id' => $brandId,
                'parent_id' => $parentId,
            ]);
            return redirect()->route('category.index')->with('success', 'Thêm mới thành công');
        } catch (Throwable $th) {
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
    public function edit(Category $category)
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('BE.Category.edit', compact('category', 'categories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        try {
            $parentId = $request->input('parent_id', null);
            $brandId = $request->input('brand_id');
            $category->update([
                'name' => $request->name,
                'brand_id' => $brandId,
                'parent_id' => $parentId,
            ]);

            return redirect()->route('category.index')->with('success', 'Cập nhật thành công');
        } catch (Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('category.index')->with('success', 'Xóa danh mục thành công');
    }

    public function trash()
    {
        $categories = Category::onlyTrashed()->with('children', 'brand')->orderBy('parent_id')->get();
        return view('BE.Category.trash', compact('categories'));
    }
    public function restore($id)
    {
        // Tìm bản ghi đã xóa mềm theo ID
        $softDeletedCategory = Category::withTrashed()->find($id);

        if (!$softDeletedCategory) {
            return redirect()->route('category.index')->with('error', 'Không tìm thấy bản ghi đã xóa mềm');
        }

        // Khôi phục bản ghi đã xóa mềm
        $softDeletedCategory->restore();

        return redirect()->route('category.index')->with('success', 'Khôi phục bản ghi đã xóa mềm thành công');
    }
    public function forceDelete($id)
    {
        $softDeletedCategory = Category::withTrashed()->find($id);

        if (!$softDeletedCategory) {
            return redirect()->route('category.index')->with('error', 'Không tìm thấy bản ghi đã xóa mềm');
        }

        $softDeletedCategory->forceDelete();

        return redirect()->route('category.index')->with('success', 'Xóa vĩnh viễn bản ghi đã xóa mềm thành công');
    }
}
