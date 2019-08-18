<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Motorcycle;
use App\Brand;

class MotorcyclesController extends Controller
{
    /**
     * Display a listing of the motorcycles
     *
     * @return view
     */
    public function index()
    {
        return view('motorcycles.index')->with([
           'motorcycles' => Motorcycle::paginate(24) 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('motorcycles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return redirect
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required',
            'year_start' => 'required|numeric',
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id'
        ]);

        $motorcycle = Motorcycle::create($attributes);

        return redirect(route('motorcycles.created', $motorcycle->slug));
    }

    /**
     * A motorcycle was added to the database. Show confirmation message.
     * 
     * @param App\Motorcycle $motorcycle
     * @return view
     */
    public function created(Motorcycle $motorcycle) 
    {
        return view('motorcycles.created')->with([
            'motorcycle' => $motorcycle
        ]);
    }

    /**
     * Display the specified motorcycle
     *
     * @param   Brand   $brand
     * @param   Motorcycle  $motorcycle
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand, Motorcycle $motorcycle)
    {
        return view('motorcycles.show')->with([
            'motorcycle' => $motorcycle
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
