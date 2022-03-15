<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->increments('id');
            $table->text("name");
            $table->timestamps();
        });

        Schema::create('municipalities', function (Blueprint $table) {
            $table->increments('id');
            $table->text("name");
            $table->unsignedInteger("city_id")->nullable();
            $table->string("image")->nullable();
            $table->timestamps();
            $table->foreign("city_id")->references("id")->on("cities")->onDelete("CASCADE");
        });

        Schema::create('landmark_types', function (Blueprint $table) {
            $table->increments('id');
            $table->text("name");
            $table->timestamps();
        });

        Schema::create('landmarks', function (Blueprint $table) {
            $table->increments('id');
            $table->text("name");
            $table->unsignedInteger("landmark_type_id");
            $table->timestamps();
            $table->foreign("landmark_type_id")->references("id")->on("landmark_types")->onDelete("CASCADE");
        });

        Schema::create('municipality_landmark', function (Blueprint $table) {
            $table->unsignedInteger("municipality_id");
            $table->unsignedInteger("landmark_id");
            $table->unique(['municipality_id', 'landmark_id']);
            $table->foreign("municipality_id")->references('id')->on("municipalities")->onDelete('CASCADE');
            $table->foreign("landmark_id")->references('id')->on("landmarks")->onDelete('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('municipality_landmark');
        Schema::dropIfExists('landmarks');
        Schema::dropIfExists('municipalities');
        Schema::dropIfExists('cities');
    }
}
