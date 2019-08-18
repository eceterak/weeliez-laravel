<?php

namespace App\Http\Controllers\Admin;

use App\Type;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use App\Attribute;

class TypesController extends Controller
{
    /**
     * Display a listing of all available types.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.types.index')->with([
            'types' => Type::all()
        ]);
    }

    /**
     * Show the form for creating a type.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.types.create');
    }

    /**
     * Store a newly created type in database.
     *
     * @return  redirect
     */
    public function store()
    {
        Type::create(request()->validate([
            'name' => 'required|unique:types'
        ]));

        return redirect(route('admin.types.index'));
    }

    /**
     * Show the form for editing the specified type.
     *
     * @param   \App\Type   $type
     * @return  view
     */
    public function edit(Type $type)
    {
        return view('admin.types.edit')->with([
            'type' => $type->load('attributes')
        ]);
    }

    /**
     * Update the specified type.
     *
     * @param   \App\Type  $type
     * @return  redirect
     */
    public function update(Type $type)
    {
        $attributes = request()->validate([
            'name' => [
                'required', 
                Rule::unique('types')->ignore($type->id)
            ]
        ]);

        $type->update($attributes);

        return redirect(route('admin.types.index'));
    }

    /**
     * Remove the specified type from database.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        $type->delete();

        return redirect(route('admin.types.index'));
    }
}
