<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $products = Product::orderBy('id')->paginate(5);

        return view('backend.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::all();

        return view('backend.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product_images = $request->image_gallery;

        $request->validate([
            'Cate_id'         => 'required',
            'name'            => 'required',
            'short_dec'       => 'required',
            'price'           => 'required',
            'saleprice'       => 'required',
            'description'     => 'required',
            'add_info'        => 'required',
            'image_gallery.*' => 'nullable|mimes:jpeg,jpg,svg,png|max:1024',

        ]);
        $products = Product::create([
            'category_id'       => $request->Cate_id,
            'title'             => $request->name,
            'short_description' => $request->short_dec,
            'price'             => $request->price,
            'sale_price'        => $request->saleprice,
            'description'       => $request->description,
            'additional_info'   => $request->add_info,
            'slug'              => Str::slug($request->name),

        ]);
        $products->categories()->attach($request->Cate_id);

        $product_gallery = [];
        // return public_path('storage/products/');

        if ($product_images) {

            foreach ($product_images as $image) {

                $image_name = Str::uuid() . '.' . $image->extension();

                image::make($image)->resize(680, 680)->save(public_path('storage/products/' . $image_name), 90);

                $product_gallery[] = [
                    'product_id' => $products->id,
                    'image_path' => 'storage/products/' . $image_name,
                    'image_name' => $image_name,

                ];

            }

            ProductGallery::insert($product_gallery);

        }

        return redirect()->route('backend.productmanagement.Product.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product, $id)
    {
        //
        $products   = Product::find($id);
        $categories = Category::all();

        return view('backend.product.edit', compact('products', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product, $id)
    {
        //

        $request->validate([
            'Cate_id'     => 'required',
            'name'        => 'required',
            'short_dec'   => 'required',
            'price'       => 'required',
            'saleprice'   => 'required',
            'description' => 'required',
            'add_info'    => 'required',

        ]);
        Product::find($id)->update([

            'category_id'       => $request->Cate_id,
            'title'             => $request->name,
            'short_description' => $request->short_dec,
            'price'             => $request->price,
            'sale_price'        => $request->saleprice,
            'description'       => $request->description,
            'additional_info'   => $request->add_info,
            'slug'              => Str::slug($request->name),

        ]);
        $products = Product::find($id);
        $products->categories()->sync($request->Cate_id);

        return redirect()->route('backend.productmanagement.Product.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $product = Product::find($id);

        // $product->categories()->detach();
        $product->delete();
        return redirect()->route('backend.productmanagement.Product.index');

    }

    // Product Trash list method---------------------------------------------

    public function productTrashList()
    {

        $products = Product::onlyTrashed()->with('categories')->paginate(25);

        return view('backend.product.trash', compact('products'));

    }
    // Product Trash Restore method---------------------------------------------

    public function productTrashRestore($id)
    {

        $products = Product::onlyTrashed()->find($id);

        $products->restore();

        return redirect()->route('backend.productmanagement.Product.index');

    }
    // Product Trash parmanent delete method---------------------------------------------

    public function productTrashDelete($id)
    {

        $products = Product::onlyTrashed()->find($id);

        $galleries = ProductGallery::where('product_id', $id)->get();

        foreach ($galleries as $gallery) {

            $gallery->delete();
            
            unlink(public_path($gallery->image_path));
        }
        $products->forceDelete();

        return redirect()->route('backend.productmanagement.product.trash.list');

    }
}
