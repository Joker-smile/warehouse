<?php

use Faker\Generator as Faker;
use App\Material;

$factory->define(Material::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'remark' => $faker->sentence(5),
        'code' => $faker->randomNumber,
        'supplier' => $faker->sentence(3),
    ];
});
