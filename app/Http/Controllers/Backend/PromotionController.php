<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PromotionController extends Controller
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

        $promotions = Promotion::orderBy('id')->get();

        return view('backend.promotion.create', compact('promotions'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title'             => 'required',
            'short_description' => 'required',
            'button'            => 'required',
            'image'             => 'nullable|mimes:jpg,png,jpeg|max:1024', //|dimensions:max_width=500,max_height=500'

        ]);

        $image = $request->file('image');

        if ($image) {

            $image_name = Str::uuid() . '.' . $image->extension();
            Storage::putFiLeAS('promotion/', $image, $image_name);

            // Image::make($image)->crop(200, 256)->save(public_path('storage/banner/' . $image_name), 90);

        } else {
            $image_name = null;
        }

        Promotion::create([
            "title"             => $request->title,
            "button"             => $request->button,
            "short_description" => $request->short_description,
            "image"             => $image_name,
        ]);

        return back();

    }

    /**
     * Display the specified resource.
     */
    public function show(Promotion $promotion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Promotion $promotion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Promotion $promotion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Promotion $promotion)
    {
        //
    }
}
