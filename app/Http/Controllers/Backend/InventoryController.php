<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $colors = Color::all();
        $sizes  = Size::all();
        $inventories = Inventory::where('product_id',$request->product_id)->get();
        // dd($inventories);
        $product = Product::find($request->product_id);
        return view('backend.inventory.index', compact('product', 'colors', 'sizes','inventories'));

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
        $request->validate([
            'product_id' => 'required|integer',
            'color_id'   => 'required',
            'size_id'    => 'required',
            'quantity'   => 'required|integer',
            'add_price'  => 'nullable|integer',
        ]);

        Inventory::create($request->all());
        
        return back();
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
}
