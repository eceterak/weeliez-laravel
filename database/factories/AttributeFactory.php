<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Attribute;
use Faker\Generator as Faker;
use App\Type;

$factory->define(Attribute::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'type_id' => function() {
            return create(Type::class);
        }
    ];
});
