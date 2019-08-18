<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use App\Brand;

$factory->define(Brand::class, function (Faker $faker) {
    return [
        'name' => $faker->company
    ];
});
