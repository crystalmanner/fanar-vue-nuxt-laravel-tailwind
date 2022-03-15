<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Admin::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt('123123'),
        'status'=>\App\Models\Admin::STATUS_ACTIVE
    ];
});
