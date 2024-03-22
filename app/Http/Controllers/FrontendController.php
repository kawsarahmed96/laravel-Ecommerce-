<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\Service;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    //
    public function index()
    {

        $top_sales = DB::table('products')
            ->leftJoin('order_details', 'products.id', '=', 'order_details.product_id')
            ->selectRaw('products.id, SUM(order_details.quantity) as total')
            ->groupBy('products.id')
            ->orderBy('total', 'desc')
            ->take(8)
            ->get();

        $topProducts = [];
        foreach ($top_sales as $topSale) {
            $product           = Product::findOrFail($topSale->id);
            $product->totalQty = $topSale->total;
            $topProducts[]     = $product;
        }

//         $top_sales = DB::table('products')
//             ->leftJoin('order_details', 'products.id', '=', 'order_details.product_id')
//             ->selectRaw('products.id, SUM(order_details.quantity) as total')
//             ->groupBy('products.id')
//             ->orderBy('total', 'desc')
//             ->take(8)
//             ->get();
//
//         $topCategory = [];
//         foreach ($top_sales as $topSale) {
//             $topCat           = Category::findOrFail($topSale->id);
//             $topCat->totalQty = $topSale->total;
//             $topCategory[]    = $topCat;
//         }

        // latest product

        $month = date('m');

        $latests = Product::with('galleries')
            ->whereMonth('created_at', $month)
            ->get();

        // New arrival product
        $newArrivProducts = DB::table('products')
            ->latest()
            ->get()
            ->take(4);

        // Promotion product
        $promotions = Promotion::orderBy('id')->get();

        // service product
        $services = Service::where('status', 1)->orderBy('id')->get();

        // Banner product
        $banners = Banner::where('status', 1)->get();

        return view('frontend.index', compact('topProducts', 'banners', 'services', 'latests', 'promotions', 'newArrivProducts'));
    }
}
