<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $sizes = Size::orderBy('id', 'desc')->paginate(10);
        return view('backend.size.index', compact('sizes'));
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
        //
        $request->validate([
            'name' => 'required|unique:colors,name',
        ]);

        Size::create($request->all());

        return back();

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $size= Size::find($id);
        return view('backend.size.show', compact('size'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $sizes = Size::find($id);

        return view('backend.size.edit', compact('sizes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        Size::where('id',$id)->update([
            'name'=>$request->name,
        ]);
        return redirect()->route('backend.productmanagement.Size.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        $sizes = Size::find($id)->delete();
        return redirect()->route('backend.productmanagement.Size.index');
    }
}
