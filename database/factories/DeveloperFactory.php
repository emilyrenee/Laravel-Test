<?php

use Faker\Generator as Faker;

$factory->define(App\Developer::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'personal_site' => $faker->url
    ];
});
