<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductApiController extends Controller
{
    //
    public function productList()
    {
        $products = Product::with('galleries')->select('id', 'title', 'slug', 'short_description', 'sale_price', 'price')->where('status', 1)->get();

        return response()->json($products);
    }

}
