<?php

use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("articles")->insert([
            [
                "title" => '{"en":"Test1"}',
                "slug" => 'Test1',
                "description" => '{"en":"Test1 description"}',
                "details" => '{"en":"Test1 details"}',
                "keywords" => '{"en":"Test1 keyword, another keyword"}',
                "type" => "blog",
                "image" => "test1.jpg"
            ],
            [
                "title" => '{"en":"Test2"}',
                "slug" => 'Test2',
                "description" => '{"en":"Test2 description"}',
                "details" => '{"en":"Test2 details"}',
                "keywords" => '{"en":"Test2 keyword, another keyword"}',
                "type" => "blog",
                "image" => "test2.jpg"
            ],
        ]);
    }
}
