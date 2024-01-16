<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    //

    public function index()
    {

        $products = Product::with('galleries')->select('id', 'title', 'slug', 'short_description', 'sale_price', 'price')->where('status', 1)->get();
        //   dd($products)   ;

        return view('frontend.shop', compact('products'));
    }

    public function categoryProduct($slug)
    {

        // $products  = Category::with(['products'=> function($q){
        //     $q->where('status',1);
        // }])->where('slug',$slug)->where('status',1)->get();
        // return( $products);

        //join query
        $products = Category::join('category_product', 'categories.id', '=', 'category_product.category_id')
            ->join('products', 'products.id', '=', 'category_product.product_id')

            ->select('products.*', 'categories.slug as cat_slug', 'categories.name as cat_name', 'categories.status as cat_status', DB::raw('(SELECT image_path FROM product_galleries WHERE product_id=products.id LIMIT 1) as image'))

            ->where('categories.slug', $slug)->where('products.status', 1)->get();

        return view('frontend.shop', compact('products'));

    }

    public function singleProduct($slug)
    {

        $products = Product::with('galleries')->where('status', 1)->where('slug', $slug)->first();

        $colors = Color::where('status', 1)->whereIn('id', $products->inventories->pluck('color_id')->toArray())->get();

        // dd($colors);

        return view('frontend.product_details', compact('products', 'colors'));
    }

    public function colorWiseSize(Request $request)
    {

        $sizeArray = Inventory::where('product_id', $request->product_id)
            ->where('color_id', $request->color_id)->pluck('size_id')->toArray();

        $sizes = Size::where('status', 1)->whereIn('id', $sizeArray)->get();

        $selectoption = ['<option value="">Select size</option>'];

        foreach ($sizes as $size) {
            $selectoption[] = '<option value="' . $size->id . '">' . $size->name . '</option>';
        }

        return response()->json($selectoption);

    }

    public function colorSizeWiseInventory(Request $request)
    {
        $inventory = Inventory::where('product_id', $request->product_id)
            ->where('color_id', $request->color_id)->where('size_id',$request->size_id)->first();

            return response()->json($inventory);
    }
}
