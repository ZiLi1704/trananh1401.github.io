<?php

namespace App\Http\Controllers\Client;

use App\Helper\CartHelper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    public function show(String $id)
    {
        $totalQuantity = CartHelper::getTotalQuantity();
        $categories = Category::all();
        $products = DB::table('product_details')
        ->join('products', 'product_details.product_id', '=', 'products.id')
        ->select('products.id', 'products.name', 'products.image', DB::raw('MIN(sale_price) as price'))
        ->groupBy('product_details.product_id')
        ->where('products.category_id', $id)
        ->get();
        return view('FE.Shop.index', compact('categories', 'products' ,'totalQuantity'));
    }

    public function GetProduct(String $id)
    {
        $categories = Category::all();
        $totalQuantity = CartHelper::getTotalQuantity();
        $product = Product::find($id);
        $productimages = ProductImage::where('product_id', $id)->get();
        $productdetails = ProductDetail::where('product_id', $id)->get();
        $products = DB::table('product_details')
        ->join('products', 'product_details.product_id', '=', 'products.id')
        ->select('products.id', 'products.name', 'products.image', DB::raw('MIN(sale_price) as price'))
        ->groupBy('product_details.product_id')
        ->where('products.category_id', $product->category_id)
        ->inRandomOrder()
        ->take(8)
        ->get();
        return view('FE.Shop.detail', compact('categories', 'product', 'productimages', 'productdetails', 'products', 'totalQuantity'));
    }
}
