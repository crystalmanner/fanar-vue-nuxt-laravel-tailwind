<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\Apartment::class, function (Faker $faker) {
    $projct=\App\Models\Project::inRandomOrder();
    return array_merge(getArray($faker), [
        'project_id' => $projct->value('id'),
        'municipality_id' => \App\Models\Municipality::inRandomOrder()->value('id'),
        'downtown_distance' => $faker->randomFloat(2, 1, 200),
    ]);
});

$factory->defineAs(\App\Models\Apartment::class, 'no_project', function (Faker $faker) {
    return array_merge(getArray($faker), [
        'municipality_id' => \App\Models\Municipality::inRandomOrder()->value('id'),
        'downtown_distance' => $faker->randomFloat(2, 1, 200),
    ]);
});

$factory->afterCreating(\App\Models\Apartment::class, function (\App\Models\Apartment $apartment, Faker $faker) {
    $apartment->views()->attach(\App\Models\ApartmentView::inRandomOrder()->limit($faker->numberBetween(1, 6))->pluck('id')->toArray());
    $apartment->deliverables()->attach(\App\Models\ApartmentDeliverable::inRandomOrder()->limit($faker->numberBetween(1, 8))->pluck('id')->toArray());
});

$factory->afterCreating(\App\Models\Apartment::class, function (\App\Models\Apartment $apartment, Faker $faker) {

    $apartment->transports()->attach(\App\Models\Transport::inRandomOrder()->limit($faker->numberBetween(1, 5))->pluck('id')->toArray());
    $apartment->views()->attach(\App\Models\ApartmentView::inRandomOrder()->limit($faker->numberBetween(1, 6))->pluck('id')->toArray());
    $apartment->deliverables()->attach(\App\Models\ApartmentDeliverable::inRandomOrder()->limit($faker->numberBetween(1, 8))->pluck('id')->toArray());
}, 'no_project');

function getArray(Faker $faker)
{
    $price = $faker->randomFloat(2, 10, 200);
    $totalArea = $faker->randomFloat(2, 1, 200);

    return [
        'name' => $faker->jobTitle,
        'code' => $faker->randomNumber(7),
        'deadline' => now()->addDays($faker->randomNumber(2))->addMonths($faker->randomNumber(2))->toDateString(),
        'price' => $price,
        'price_after' => $price - 5,
        'payment_type_id' => \App\Models\PaymentType::inRandomOrder()->value('id'),
        'down_payment_percent' => $faker->numberBetween(1, 100),
        'down_payment_value' => $faker->randomFloat(2, 1, 200),
        'installments_period' => $faker->numberBetween(1, 48),
        'installments_value' => $faker->randomFloat(2, 1, 200),
        'meter_price' => $faker->randomFloat(2, 1, 200),
        'for_investment' => $faker->boolean,
        'investment_return_id' => \App\Models\InvestmentReturn::inRandomOrder()->value('id'),
        'return_investment_value' => $faker->randomFloat(2, 1, 200),
        'apartment_type_id' => \App\Models\ApartmentType::inRandomOrder()->value('id'),
        'bedrooms' => $faker->numberBetween(0, 10),
        'living_rooms' => $faker->numberBetween(0, 5),
        'total_area' => $faker->randomFloat(2, 1, 200),
        'net_area' => $totalArea + 5,
        'directions' => \Illuminate\Support\Arr::random(\App\Models\Apartment::DIRECTIONS, $faker->numberBetween(1, 4)),
        'floor' => $faker->numberBetween(0, 100),
        'apartment_number' => $faker->randomNumber(4),
        'bloc_number' => $faker->randomNumber(5),
        'floors' => $faker->numberBetween(0, 100),
        'bathrooms' => $faker->numberBetween(1, 5),
        'balacony' => $faker->boolean,
        'kitchen_type' => \Illuminate\Support\Arr::random(\App\Models\Apartment::KITCHEN_TYPES),
    ];
}
