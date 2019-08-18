<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Brand;

class BrandsController extends Controller
{
    /**
     * Display all brands.
     * 
     * @return view
     */
    public function index()
    {
        if(request()->expectsJson()) return response()->json(Brand::all());
        
        return view('admin.brands.index')->with([
            'brands' => Brand::all()
        ]);
    }

    /**
     * Show the form for createing a new brand.
     * 
     * @return view
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a new brand in the database.
     * 
     * @return redirect
     */
    public function store() 
    {
        $attributes = request()->validate([
            'name' => 'required|unique:brands|min:2|bail'
        ]);

        $brand = Brand::create($attributes);

        return redirect(route('admin.brands.index'));
    }

    /**
     * Show the form for editing given brand.
     * 
     * @param   Brand   $brand
     * @return  view
     */
    public function edit(Brand $brand) 
    {
        return view('admin.brands.edit')->with([
            'brand' => $brand
        ]);
    }
    
    /**
     * Update given brand.
     * 
     * @param   Brand   $brand
     * @return  redirect
     */
    public function update(Brand $brand) 
    {
        $attributes = request()->validate([
            'name' => 'required|unique:brands|min:2|bail'
        ]);

        $brand->update($attributes);

        return redirect()->route('admin.brands.index');
    }

    /**
     * Delete given brand from the database.
     * 
     * @param   Brand   $brand
     * @return  redirect
     */
    public function destroy(Brand $brand) 
    {
        $brand->delete();

        return redirect()->route('admin.brands.index');
    }
}