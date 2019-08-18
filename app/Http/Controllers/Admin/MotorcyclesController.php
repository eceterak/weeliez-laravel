<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Motorcycle;
use App\Http\Requests\StoreMotorcycleRequest;
use App\Brand;
use App\Http\Requests\UpdateMotorcycleRequest;
use App\Category;
use App\Attribute;

class MotorcyclesController extends Controller
{
    /**
     * Display a listing of all motorcycles.
     *
     * @return view
     */
    public function index()
    {
        return view('admin.motorcycles.index')->with([
            'motorcycles' => Motorcycle::paginate(24)
        ]);
    }

    /**
     * Show the form for creating a new motorcycle.
     *
     * @return view
     */
    public function create()
    {
        return view('admin.motorcycles.create')->with([
            'brands' => Brand::all(),
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a new motorcycle in database.
     *
     * @return  redirect
     */
    public function store(StoreMotorcycleRequest $request)
    {
        $motorcycle = Motorcycle::create($request->validated());

        return redirect(route('admin.motorcycles.edit', $motorcycle->slug));
    }

    /**
     * Show the form for editing the given motorcycle.
     *
     * @param   Brand  $brand
     * @param   Motorcycle  $motorcycle
     * @return  view
     */
    public function edit(Motorcycle $motorcycle)
    {
        return view('admin.motorcycles.edit')->with([
            'motorcycle' => $motorcycle,
            'attributes' => Attribute::whereNotIn('id', $motorcycle->specs->pluck('attribute_id'))->with('type')->orderBy('type_id')->get()->groupBy('type.name')
        ]);
    }

    /**
     * Update given motorcycle.
     *
     * @param   Brand  $brand
     * @param   Motorcycle  $motorcycle
     * @return  redirect
     */
    // public function update(Motorcycle $motorcycle, UpdateMotorcycleRequest $request)
    // {
    //     $motorcycle->update($request->validated());

    //     if(request()->has('specs')) $motorcycle->addSpecs(request('specs'));

    //     return redirect()->route('admin.motorcycles.index');
    // }

    public function update(Motorcycle $motorcycle)
    {
        dd(request()->all());
    }

    /**
     * Delete given motorcycle from database.
     *
     * @param   Brand  $brand
     * @param   Motorcycle  $motorcycle
     * @return  redirect
     */
    public function destroy(Motorcycle $motorcycle)
    {
        $motorcycle->delete();

        return redirect()->route('admin.motorcycles.index');
    }
}
