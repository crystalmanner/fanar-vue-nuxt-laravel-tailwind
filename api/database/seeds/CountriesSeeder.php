<?php

use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = json_decode(file_get_contents(public_path('countries.json')));
        foreach ($countries as $country) {
            $countryObj = new \App\Models\Country();
            $countryObj->name = $country->country_en;
            $countryObj->phone_code = $country->phone_code;
            $countryObj->code = $country->country_code;
            $countryObj->save();
        }
    }
}
