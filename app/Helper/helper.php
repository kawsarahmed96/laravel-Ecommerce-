<?php

use App\Models\Cart;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

if (!function_exists('categories')) {
    function categories()
    {
        $category = Category::where('status', 1)->get();
        return $category;

    }

}

if (!function_exists('clientCartDetails')) {
    function clientCartDetails()
    {
        $carts = Cart:: with('product')->where('user_id', Auth::id())->get();
        return $carts;

    }

}
if (!function_exists('cartTotal')) {
    function cartTotal()
    {
       $cartTotal = Cart::where('user_id', Auth::id())->sum('total_price');

        return $cartTotal;

    }

}
