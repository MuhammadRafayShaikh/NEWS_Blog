<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::orderBy('category_id','DESC')->paginate(3);

        // return $category;
        return view('admin.category', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.add-category');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
        $categoryValidation = validator($request->all(), [
            'category' => 'required'
        ]);

        $category = Category::create([
            'category_name' => $request->category
        ]);

        if ($category) {
            return redirect()->route('category.index')->with('category', 'Category Added Successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);

        return $category;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);

        return view('admin.update-category', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $categoryValidation = validator($request->all(), [
            'category' => 'required'
        ]);
        $category = Category::find($id);
        $category->update([
            'category_name' => $request->category
        ]);
        if ($category) {
            return redirect()->route('category.index')->with('category', 'Category Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);

        $category->delete();

        return redirect()->route('category.index')->with('category', 'Category Deleted Successfully');
    }
}
