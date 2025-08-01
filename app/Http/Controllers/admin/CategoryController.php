<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use  illuminate\support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view("admin.category.index", compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.category.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                "name" => "required|unique:categories,name",
            ],
            [
                "name.required" => "Category Name is required field",
                "unique" => "Category Already exists."
            ],
        );
        $category = new Category();
        $category->name = Str::title($request->name);
        $category->slug = Str::slug($request->name, "-");
        $category->save();
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
        $category = category::find($id);
        return view("admin.category.edit", compact("category"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                "name" => "required|unique:categories,name",
            ],
            [
                "name.required" => "Category Name is required field",
                "unique" => "Category Already exists."
            ],
        );
        $category = Category::find($id);
        $category->name = Str::title($request->name);
        $category->slug = Str::slug($request->name, "-");
        $category->update();
        return redirect('/category');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = category::find($id);
        $category->delete();
        return back();
    }
}
