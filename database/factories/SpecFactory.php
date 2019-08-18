<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Spec;
use Faker\Generator as Faker;
use App\Motorcycle;
use App\Attribute;
use App\Type;

$factory->define(Spec::class, function (Faker $faker) {
    return [
        'motorcycle_id' => function() {
            return create(Motorcycle::class);
        },
        'attribute_id' => function() {
            return create(Attribute::class);
        },
        'type_id' => function() {
            return create(Type::class);
        },
        'value' => $faker->numberBetween(1, 5000)
    ];
});
