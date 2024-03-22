<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        
      

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $banners = Banner::orderBy('id')->get();

        return view('backend.banner.create',compact('banners'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'             => 'required',
            'short_description' => 'required',
            'price'             => 'nullable',
            'sale_price'        => 'nullable',
            'image'             => 'nullable|mimes:jpg,png,jpeg|max:1024', //|dimensions:max_width=500,max_height=500'

        ]);

        $image = $request->file('image');

        if ($image) {

            $image_name = Str::uuid() . '.' . $image->extension();
            Storage::putFiLeAS('banner/', $image, $image_name);

            // Image::make($image)->crop(200, 256)->save(public_path('storage/banner/' . $image_name), 90);

        } else {
            $image_name = null;
        }

        Banner::create([
            "title"             => $request->title,
            "short_description" => $request->short_description,
            "price"             => $request->price,
            "sale_price"        => $request->sale_price,
            "image"             => $image_name,
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        //
    }
}
