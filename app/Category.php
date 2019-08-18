<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
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
        static::creating(function($category) 
        {
            $category->slug = $category->name;
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
        $slug = str_slug($name);

        $this->attributes['slug'] = $slug;
    }
}
