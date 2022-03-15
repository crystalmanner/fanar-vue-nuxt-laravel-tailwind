<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApartmentOffer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartment_offer', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("age")->nullable();
            $table->integer("rooms")->nullable();
            $table->text("rooms_categories")->nullable();
            $table->double("annual_expenses")->nullable();
            $table->double("expected_return_value")->nullable();
            $table->float("building_area")->nullable();
            $table->text("available_furniture")->nullable();
            $table->unsignedInteger("apartment_id");
            $table->timestamps();
            $table->foreign("apartment_id")->references('id')->on("apartments")->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apartment_offer');
    }
}
