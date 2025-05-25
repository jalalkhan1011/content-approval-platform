<?php

namespace App\Http\Controllers;

use App\Models\category\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
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
        $request->validate([
            'category_name' => 'required|string|max:100|unique:categories,category_name',
        ]);

        try {
            $data = $request->all();
            Category::create($data);
            toastr()->success('Category created successfully.');
            return back();
        } catch (\Throwable $th) {
            toastr()->error('Something went wrong. Please try again.');
            return back();
        }
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
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'category_name' => 'required|string|max:100|unique:categories,category_name,' . $category->id,
        ]);

        try {
            $data = $request->all();
            $category->update($data);
            toastr()->success('Category updated successfully.');
            return redirect(route('category.categories.index'));
        } catch (\Throwable $th) {
            toastr()->error('Something went wrong. Please try again.');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            toastr()->success('Category deleted successfully.');
            return back();
        } catch (\Throwable $th) {
            toastr()->error('Something went wrong. Please try again.');
            return back();
        }
    }
}
