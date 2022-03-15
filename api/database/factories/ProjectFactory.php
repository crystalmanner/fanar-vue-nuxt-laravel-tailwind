<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\Project::class, function (Faker $faker) {
    return [
        'name' => $faker->jobTitle,
        'slug' => \Illuminate\Support\Str::slug($faker->jobTitle),
        'code' => $faker->randomNumber(7),
        'contact' => $faker->firstName . ' ' . $faker->lastName,
        'phone' => $faker->phoneNumber,
        'municipality_id' => \App\Models\Municipality::inRandomOrder()->value('id'),
        'availability' => $faker->numberBetween(0, 100),
        'delivery_date' => now()->addDays($faker->randomNumber(2))->addMonths($faker->randomNumber(2))->toDateString(),
        'ready_for_registration' => $faker->boolean,
        'buildings' => $faker->numberBetween(1, 100),
        'apartments' => $faker->numberBetween(1, 100),
        'construction_company' => $faker->company,
        'downtown_distance' => $faker->randomFloat(2, 1, 200)
    ];
});

$factory->afterCreating(\App\Models\Project::class, function (\App\Models\Project $project, Faker $faker) {
    $project->facilities()->attach(\App\Models\Facility::inRandomOrder()->limit($faker->numberBetween(1, 20))->pluck('id')->toArray());
    $project->transports()->attach(\App\Models\Transport::inRandomOrder()->limit($faker->numberBetween(1, 5))->pluck('id')->toArray());
});
