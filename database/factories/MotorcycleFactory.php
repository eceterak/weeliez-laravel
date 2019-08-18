<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use App\Motorcycle;
use App\Brand;
use App\Category;

$factory->define(Motorcycle::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'brand_id' => function() {
            return create(Brand::class);
        },
        'category_id' => function() {
            return create(Category::class);
        },
        'year_start' => $faker->year
    ];
});
