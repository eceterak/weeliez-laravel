<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * It has many attributes.
     * 
     * @return  App\Attribute
     */
    public function attributes() 
    {
        return $this->hasMany(Attribute::class);
    }

}
