<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        // Generate the slug. See @setSlugAttribute
        static::creating(function($brand) 
        {
            $brand->slug = $brand->name;
        });
    }
    
    /**
     * Fetch model with a slug instead of id
     * upon loading with route model binding.
     * 
     * @return  string
     */
    public function getRouteKeyName() 
    {
        return 'slug';
    }

    /**
     * Slug won't repeat as name is unique,
     * 
     * @param   string  $name
     * @return  void
     */
    public function setSlugAttribute($name) 
    {
        $this->attributes['slug'] = str_slug($name);
    }
}