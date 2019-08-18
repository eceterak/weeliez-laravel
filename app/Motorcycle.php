<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Motorcycle extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        // Generate the slug. See @setSlugAttribute
        static::creating(function($motorcycle) 
        {
            $motorcycle->slug = $motorcycle->name;
        });
    }

    /**
     * Eager load brand and category.
     * 
     * @var array
     */
    protected $with = [
        'brand',
        'category'
    ];
    
    /**
     * Fetch model with a slug instead of id
     * upon loading with route model binding.
     * 
     * @return string
     */
    public function getRouteKeyName() 
    {
        return 'slug';
    }

    /**
     * Motorcycle belongs to a brand.
     * 
     * @return  App\Brand
     */
    public function brand() 
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Motorcycle belongs to a category.
     * 
     * @return  App\Category
     */
    public function category() 
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * It has many specs.
     * 
     * @return  App\Spec
     */
    public function specs() 
    {
        return $this->hasMany(Spec::class);
    }

    /**
     * Laravel relationships doesn't work very well with specs as,
     * it is hard to group them by type.name. Thats why I'm using custom query.
     * 
     * @return  App\Spec
     */
    public function getSpecsGroupedAttribute() 
    {
        return $this->specs()->with('type')->with('attribute')->orderBy('type_id')->get()->groupBy('type.name');
    }

    /**
     * Set a unique slug based on a name.
     * Motorcycles are fetched based on this attribute.
     * 
     * @param   string  $name
     * @return  void
     */
    public function setSlugAttribute($name) 
    {
        $slug = str_slug($name);

        $this->attributes['slug'] = $slug;
    }

    /**
     * Return all of the required route parameters.
     * 
     * @return  array
     */
    public function getRouteParametersAttribute() 
    {
        return [
            $this->brand->slug, $this->slug
        ];
    }

    /**
     * Given array of attribute id and value, 
     * create specs for motorcycle.
     * 
     * @param   array   $specs
     * @return  void
     */
    public function addSpecs($specs) 
    {
        foreach($specs as $type => $arr) {
            foreach($arr as $key => $value) {
                $this->specs()->create([
                    'attribute_id' => $key,
                    'type_id' => $type,
                    'value' => $value
                ]);
            }
        }
    }
}