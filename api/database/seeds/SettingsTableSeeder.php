<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('settings')->delete();
        \DB::table('settings')->insert(array(
            array(
                'section' => 'Main',
                'key' => 'Location',
                'value' => '{"latitude":21.387401,"longitude":39.703399,"formatted_address":"6910, Al Hamra and Umm Al Jud, Makkah 24331 3879, Saudi Arabia"}',
                'type' => 'AddressField',
                'status' => NULL,
                'created_at' => '2019-04-15 09:06:19',
                'updated_at' => '2019-05-01 12:04:39',
            ),
            array(
                'section' => 'Social',
                'key' => 'Facebook',
                'value' => '',
                'type' => 'Text',
                'status' => NULL,
                'created_at' => NULL,
                'updated_at' => '2019-05-02 07:06:36',
            ),
            array(
                'section' => 'Main',
                'key' => 'Phone1',
                'value' => '+902128222222',
                'type' => 'Text',
                'status' => NULL,
                'created_at' => NULL,
                'updated_at' => '2019-04-14 12:27:49',
            ),
            array(
                'section' => 'Main',
                'key' => 'Phone2',
                'value' => '+905395919999',
                'type' => 'Text',
                'status' => NULL,
                'created_at' => NULL,
                'updated_at' => '2019-04-14 12:27:49',
            ),
            array(
                'section' => 'Main',
                'key' => 'Email',
                'value' => 'info@fanarrealty.com',
                'type' => 'Text',
                'status' => NULL,
                'created_at' => NULL,
                'updated_at' => '2019-04-14 12:27:49',
            ),
            array(
                'section' => 'Social',
                'key' => 'Twitter',
                'value' => '',
                'type' => 'Text',
                'status' => NULL,
                'created_at' => NULL,
                'updated_at' => '2019-05-02 07:06:51',
            ),
            array(
                'section' => 'Social',
                'key' => 'Instagram',
                'value' => '',
                'type' => 'Text',
                'status' => NULL,
                'created_at' => NULL,
                'updated_at' => '2019-05-02 07:08:18',
            ),
            array(
                'section' => 'Social',
                'key' => 'LinkedIn',
                'value' => '',
                'type' => 'Text',
                'status' => NULL,
                'created_at' => NULL,
                'updated_at' => '2019-05-02 07:09:26',
            ),
            array(
                'section' => 'Main',
                'key' => 'Address',
                'value' => '',
                'type' => 'Text',
                'status' => NULL,
                'created_at' => NULL,
                'updated_at' => '2019-04-15 13:12:25',
            ),
            array(
                'section' => 'Main',
                'key' => 'Address_Ar',
                'value' => '',
                'type' => 'Text',
                'status' => NULL,
                'created_at' => '2019-04-15 11:20:27',
                'updated_at' => '2019-04-15 13:13:03',
            ),

            array(
                'section' => 'Sections',
                'key' => 'slider_image',
                'value' => 'hero-img.png',
                'type' => 'FileManager',
                'status' => NULL,
                'created_at' => '2019-04-15 11:20:27',
                'updated_at' => '2019-04-15 13:13:03',
            ),
            array(
                'section' => 'Sections',
                'key' => 'article_promotion_image',
                'value' => '',
                'type' => 'FileManager',
                'status' => NULL,
                'created_at' => '2019-04-15 11:20:27',
                'updated_at' => '2019-04-15 13:13:03',
            ),
            array(
                'section' => 'Sections',
                'key' => 'article_promotion_link',
                'value' => '',
                'type' => 'Text',
                'status' => NULL,
                'created_at' => '2019-04-15 11:20:27',
                'updated_at' => '2019-04-15 13:13:03',
            ),
            array(
                'section' => 'Sections',
                'key' => 'apartments_promotion_link',
                'value' => '',
                'type' => 'Text',
                'status' => NULL,
                'created_at' => '2019-04-15 11:20:27',
                'updated_at' => '2019-04-15 13:13:03',
            ),
        ));


    }
}
