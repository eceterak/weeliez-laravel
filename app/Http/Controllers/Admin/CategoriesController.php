<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class CategoriesController extends Controller
{
    /**
     * Display all categories.
     * 
     * @return view
     */
    public function index()
    {
        if(request()->expectsJson()) return response()->json(Category::all());

        return view('admin.categories.index')->with([
            'categories' => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new category.
     *
     * @return view
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created category in database.
     *
     * @return redirect
     */
    public function store(Request $request)
    {
        $attributes = request()->validate([
            'name' => 'required|unique:categories|min:2|bail'
        ]);

        $category = Category::create($attributes);

        return redirect()->route('admin.categories.index');
    }

    /**
     * Show the form for editing given category.
     * 
     * @param   Category    $category
     * @return  view
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit')->with([
            'category' => $category
        ]);
    }

    /**
     * Update given category.
     * 
     * @param   Category   $category
     * @return  redirect
     */
    public function update(Category $category) 
    {
        $attributes = request()->validate([
            'name' => 'required|unique:categories|min:2|bail'
        ]);

        $category->update($attributes);

        return redirect()->route('admin.categories.index');
    }

    /**
     * Delete given brand from the database.
     * 
     * @param   Category    $category
     * @return  redirect
     */
    public function destroy(Category $category) 
    {
        $category->delete();

        return redirect()->route('admin.categories.index');
    }
}