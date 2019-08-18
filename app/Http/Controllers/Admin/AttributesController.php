<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Attribute;
use App\Type;
use App\Motorcycle;

class AttributesController extends Controller
{
    /**
     * 
     * @param   App\Motorcycle  $motorcycle
     * @return
     */
    public function index(Motorcycle $motorcycle) 
    {
        $specs = $motorcycle->specs->pluck('attribute_id');

        return response()->json(
            Attribute::whereNotIn('id', $specs)
                ->with('type')
                ->orderBy('type_id')
                ->get()
                ->groupBy('type.name')
        );
    }

    /**
     * Show the form for creating a new attribute.
     * As attribute must be of a given type, it comes as a parameter.
     *
     * @param   App\Type    $type
     * @return  view
     */
    public function create(Type $type)
    {
        return view('admin.attributes.create')->with([
            'type' => $type
        ]);
    }

    /**
     * Store a newly created attribute in database.
     * As attribute must be of a given type, it comes as a parameter.
     *
     * @param   App\Type    $type
     * @return  redirect
     */
    public function store(Type $type)
    {
        $type->attributes()->create(request()->validate([
            'name' => 'required'
        ]));

        return redirect(route('admin.types.edit', $type->id));
    }

    /**
     * Show the form for editing the specified attribute.
     *
     * @param   App\Attribute  $attribute
     * @return  view
     */
    public function edit(Attribute $attribute)
    {
        return view('admin.attributes.edit')->with([
            'attribute' => $attribute
        ]);
    }

    /**
     * Update the specified attribute.
     *
     * @param   App\Attribute  $attribute
     * @return  redirect
     */
    public function update(Attribute $attribute)
    {
        $attribute->update(request()->validate([
            'name' => 'required|unique:attributes'
        ]));

        return redirect(route('admin.types.edit', $attribute->type->id));
    }

    /**
     * Remove the specified attribute.
     *
     * @param   \App\Attribute  $attribute
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Attribute $attribute)
    {
        $attribute->delete();

        return redirect(route('admin.types.edit', $attribute->type->id));
    }
}
