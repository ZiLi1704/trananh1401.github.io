<?php

namespace App\Http\Controllers\Client;

use App\Helper\CartHelper;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductDetail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class CartSaveController extends Controller
{
    public function AddCard(Request $request)
{
    if (session()->has('userID')){
        // Kiểm tra sự tồn tại của giỏ hàng cho người dùng
        $userId = session('userID');
        $cart = Cart::where('id_user', $userId)
                ->where('id_product', $request->id)
                ->first();
        if (!$cart) {
            // Nếu giỏ hàng chưa tồn tại, bạn có thể tạo một giỏ hàng mới
            $cart = Cart::create([
                'id_user' => $userId,
                'id_product' => $request->id,
                'quantity' => $request->quantity
            ]);
        }else{
            $cart->quantity += $request->quantity;
            $cart->save();
        }
        // Thêm sản phẩm vào giỏ hàng
        return redirect()->back();
    }else{
        return redirect()->route('user.login');
    }

}
public function index()
{
    if (session()->has('userID')) {
        $userId = session('userID');
        $totalQuantity = CartHelper::getTotalQuantity();
        $categories = Category::all();

        $carts = Cart::join('product_details', 'carts.id_product', '=', 'product_details.id')
            ->join('products', 'product_details.product_id', '=', 'products.id')
            ->where('carts.id_user', $userId)
            ->select('carts.*', 'product_details.color as detail_name', 'product_details.sale_price', 'products.name as product_name')
            ->get();

        $totalAmount = $carts->sum(function ($cart) {
            return $cart->sale_price * $cart->quantity;
        });

        return view('FE.card.index', compact('totalQuantity', 'categories', 'carts', 'totalAmount'));
    } else {
        return redirect()->route('user.login');
    }
}

public function delete(Request $request)
{
    Cart::destroy('id', $request->delid);
    return redirect()->back();
}

public function update(Request $request)
{
    $cart = Cart::find($request->upid);
    $cart->quantity = $request->quantity;
    $cart->save();
    return redirect()->back();
}

public function checkout(Request $request)
{
    $userId = session('userID');
    $user = User::find(session('userID'));
    $totalQuantity = CartHelper::getTotalQuantity();
    $categories = Category::all();
    $carts = Cart::join('product_details', 'carts.id_product', '=', 'product_details.id')
                  ->join('products', 'product_details.product_id', '=', 'products.id')
                  ->where('carts.id_user', $userId)
                  ->select('carts.*', 'product_details.color as detail_name', 'product_details.sale_price', 'products.name as product_name')
                  ->get();
    $totalAmount = $carts->sum(function ($cart) {
        return $cart->sale_price * $cart->quantity;
    });
    return view('FE.Checkout.index', compact('totalQuantity', 'categories', 'user', 'carts', 'totalAmount')) ;
}

public function Oder(Request $request)
{
    $request->merge(['user_id' => session('userID')]);

    $order = Order::create($request->all());

    $carts = Cart::join('product_details', 'carts.id_product', '=', 'product_details.id')
                  ->join('products', 'product_details.product_id', '=', 'products.id')
                  ->where('carts.id_user', session('userID'))
                  ->select('carts.*', 'product_details.color as detail_name', 'product_details.sale_price', 'products.name as product_name')
                  ->get();
    foreach ($carts as $cart) {
        $data = [
            'order_id' => $order->id,
            'product_detail_id' => $cart->id_product,
            'quantity' => $cart->quantity,
        ];
        $delcart = Cart::find($cart->id);
        OrderDetail::create($data);
        $delcart->delete();
    }
    return redirect()->route('index');
}

}
