<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        // return view('backend.category.index', compact('categories'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $allcategories = Category::orderBy('id', 'desc')->paginate(10);

        $categories = Category::get();

        return view('backend.category.index', compact('categories', 'allcategories'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name'        => 'required',
            'slug'        => 'nullable',
            'description' => 'nullable|max:300',
            'image'       => 'nullable|mimes:jpg,png', //|max:512|dimensions:max_width=500,max_height=500'
            'parent_id' => 'nullable',
        ]);

        $image = $request->file('image');

        if ($image) {

            $imageName = Str::uuid() . '.' . $image->extension();
            // Storage::putFiLeAS('category/', $image, $imageName);

            //image upload with intervention package
            $path = public_path('storage/category/');
            // Image::make($image)->resize(300, 200)->save($path . $imageName, 90);
            Image::make($image)->crop(300, 200)->save($path . $imageName, 90);

        } else {

            $imageName = null;

        }

        Category::create([
            "name"        => $request->name,
            "slug"        => Str::slug($request->name),
            "description" => $request->description,
            "parent_id"   => $request->parent_id,
            "image"       => $imageName,
        ]);

        return redirect()->route('backend.productmanagement.Category.create');

        // toastr()->persistent()->closeButton()->addSuccess('Category created.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category, $id)
    {
        //
        $category = Category::find($id);

        return view('backend.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category, $id)
    {
        //
        $request->validate([
            'name'        => 'required',
            'slug'        => 'nullable',
            'description' => 'nullable|max:300',
            'image'       => 'nullable|mimes:jpg,png', //|max:512|dimensions:max_width=500,max_height=500'
            'parent_id' => 'nullable',
        ]);

        $preImage = Category::find($id);

        // dd($preImage->image);

        $image = $request->file('image');

        if ($image) {

            $imageName = Str::uuid() . '.' . $image->extension();
            // Storage::putFiLeAS('category/', $image, $imageName);

            //image upload with intervention package

            $path = public_path('storage/category/');

            // Image::make($image)->resize(300, 200)->save($path . $imageName, 90);

            $File_path = public_path("storage/category/$preImage->image");
            // dd($path)
            // dd($File_path);

            if (file_exists($File_path)) {
                unlink($File_path);

            }

            Image::make($image)->crop(300, 200)->save($path . $imageName, 90);

        } else {

            $imageName = $preImage->image;

        }

        Category::where('id', $id)->update([
            "name"        => $request->name,
            "slug"        => Str::slug($request->name),
            "description" => $request->description,
            "parent_id"   => $request->parent_id,
            "image"       => $imageName,
        ]);
        return redirect()->route('backend.productmanagement.Category.create');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category, $id)
    {
        //
        $preImage = Category::find($id);

        if ($preImage) {

            $File_path = public_path("storage/category/$preImage->image");

            if (file_exists($File_path)) {
                unlink($File_path);

            }

        }

        $category = Category::find($id)->delete();

        return redirect()->route('backend.productmanagement.Category.create');

    }

}
