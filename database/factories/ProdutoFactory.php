<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\Produto\Entities\Produto;
use Faker\Generator as Faker;

$factory->define(Produto::class, function (Faker $faker) {
    $max = Produto::max('id');
    return [
        'id' => $max + 1,
        'name' => $faker->name($faker->name(40)),
        'price' => $faker->name($faker->numberBetween(10, 40)),
        'description' => $faker->name($faker->text(400)),
    ];
});


