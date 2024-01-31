<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\Venda\Entities\Venda;
use Faker\Generator as Faker;

$factory->define(Venda::class, function (Faker $faker) {
    $max = Venda::max('id');
    return [
        'id' => $max + 1,
        'sales_id' => $faker->name($faker->name(40)),
        'amount' => $faker->numberBetween(1,20),
    ];
});


