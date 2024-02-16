<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Helper\CartHelper;
use App\Models\ProductDetail;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalQuantity = CartHelper::getTotalQuantity();
        $categories = Category::all();
        $products = DB::table('product_details')
            ->join('products', 'product_details.product_id', '=', 'products.id')
            ->select('products.id', 'products.name', 'products.image', DB::raw('MIN(sale_price) as price'))
            ->groupBy('product_details.product_id')
            ->inRandomOrder()
            ->take(8)
            ->get();
        return view('FE.Home.index', compact('categories', 'products', 'totalQuantity'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function contact()
    {
        $totalQuantity = CartHelper::getTotalQuantity();
        $categories = Category::all();
        $products = Product::all();
        return view('FE.Contact.index', compact('categories', 'products', 'totalQuantity'));
    }
}
