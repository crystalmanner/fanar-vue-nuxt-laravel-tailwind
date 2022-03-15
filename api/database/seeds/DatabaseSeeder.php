<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $this->call(AdminSeeder::class);

        foreach (['Instanbol', 'Ankara', 'Izmir', 'Bursa', 'Sakarya', 'Valova', 'Tarabzon', 'Mersin', 'Samson', 'Eskisehir'] as $type) {
            $city = \App\Models\City::create(['name' => $type]);
            $city->municipalities()->create(["name" => $faker->streetName]);
            $city->municipalities()->create(["name" => $faker->streetName]);
        }

        foreach (['Hospital', 'University', 'Park', 'Tourist site', 'School'] as $type) {
            $type = \App\Models\LandmarkType::create(['name' => $type]);
            $type->landmarks()->create(["name" => $faker->company]);
            $type->landmarks()->create(["name" => $faker->company]);
        }

        foreach (['Ready for delivery', 'Under construction'] as $type) {
            \App\Models\ProjectStatus::create(['name' => $type]);
        }

        foreach ([
                     'Parking spot', 'generator', 'Smart Home system', 'Security guards',
                     'Gym', 'Sawna', 'Turkish bath', 'Spa', 'Cinema', 'Children\'s swimming pool',
                     'adults\' swimming pool', 'Internal swimming pool', 'External swimming pool',
                     'Separated swimming pool', 'Mixed swimming pool', 'Basketball Stadium',
                     'Football Stadium', 'Children playground', 'Reception service', 'Jacuzzi room',
                     'Yoga room', 'Karaoke Room', 'Guest reception room', 'Meeting room',
                     'Banquet Room', 'Music room', 'Business room',
                 ] as $type) {
            \App\Models\Facility::create(['name' => $type]);
        }

        foreach (['Metro', 'Metrobus', 'Public buses', 'Minibuses', 'Tram'] as $type) {
            \App\Models\Transport::create(['name' => $type]);
        }

        foreach (['Cash', 'Installments'] as $type) {
            \App\Models\PaymentType::create(['name' => $type]);
        }

        foreach (['Reselling guarantee', 'Fixed rent guarantee', 'None'] as $type) {
            \App\Models\InvestmentReturn::create(['name' => $type]);
        }

        foreach (['Apartment', 'Duplex', 'Villa', 'Apartment with large garden', 'Hotel Apartment', 'Hotel Apartment', 'Palace'] as $type) {
            \App\Models\ApartmentType::create(['name' => $type]);
        }

        foreach (['Sea', 'Lake', 'City', 'Greens paces', 'Facilities', 'Project services'] as $type) {
            \App\Models\ApartmentView::create(['name' => $type]);
        }

        foreach (['Gaz', 'Oven', 'Suction', 'AC unit', 'Dishwasher', 'Kitchen cabinets', 'A closet at the entrance to the house', 'Fully furnished'] as $type) {
            \App\Models\ApartmentDeliverable::create(['name' => $type]);
        }

        $this->call(CountriesSeeder::class);

//        factory(\App\Models\Project::class, 50)->create();
//        factory(\App\Models\Apartment::class, 750)->create();
    }
}
