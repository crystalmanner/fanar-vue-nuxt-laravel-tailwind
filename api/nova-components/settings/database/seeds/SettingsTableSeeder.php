<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert(
            [
                ['section' => 'Main', 'key' => 'Website', 'value' => ''],
                ['section' => 'Main', 'key' => 'Email', 'value' => ''],
                ['section' => 'Main', 'key' => 'Phone', 'value' => ''],
                ['section' => 'Main', 'key' => 'Mobile', 'value' => ''],
                ['section' => 'Main', 'key' => 'Fax', 'value' => ''],
                ['section' => 'Social', 'key' => 'Facebook', 'value' => ''],
                ['section' => 'Social', 'key' => 'Twitter', 'value' => ''],
                ['section' => 'Social', 'key' => 'Instagram', 'value' => ''],
                ['section' => 'Social', 'key' => 'Youtube', 'value' => ''],
                ['section' => 'Main', 'key' => 'Address', 'value' => ''],

            ]
        );
    }
}
