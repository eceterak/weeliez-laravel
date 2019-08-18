<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spec extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * It belongs to an attribute.
     * 
     * @return  App\Attribute
     */
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    /**
     * This relation is not neccessary, but makes working with
     * specs much easier.
     * 
     * @return  App\Type
     */
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}