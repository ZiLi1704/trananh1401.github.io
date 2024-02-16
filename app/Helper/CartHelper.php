<?php

namespace App\Helper;

use App\Models\Cart;

class CartHelper
{
    public static function getTotalQuantity()
    {
        $cart = Cart::where('id_user', session('userID'));

        if ($cart) {
            $totalQuantity = $cart->sum('quantity');
            return $totalQuantity;
        } else {
            return 0;
        }

    }
}
