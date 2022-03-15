<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_types', function (Blueprint $table) {
            $table->increments('id');
            $table->text("name");
            $table->timestamps();
        });

        Schema::create('investment_returns', function (Blueprint $table) {
            $table->increments('id');
            $table->text("name");
            $table->timestamps();
        });

        Schema::create('apartment_types', function (Blueprint $table) {
            $table->increments('id');
            $table->text("name");
            $table->timestamps();
        });

        Schema::create('apartment_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->text("name");
            $table->timestamps();
        });

        Schema::create('apartments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("project_id")->nullable();
            $table->text("name")->nullable();
            $table->string("code")->unique();
            $table->date("deadline")->nullable();
            $table->unsignedInteger("municipality_id")->nullable();
            $table->float("downtown_distance")->nullable();
            $table->double("price")->nullable();
            $table->double("price_after")->nullable();
            $table->unsignedInteger("payment_type_id")->nullable();
            $table->float("down_payment_percent")->nullable();
            $table->double("down_payment_value")->nullable();
            $table->integer("installments_period")->nullable();
            $table->double("installments_value")->nullable();
            $table->double("meter_price")->nullable();
            $table->boolean("for_investment")->nullable();
            $table->unsignedInteger("investment_return_id")->nullable();
            $table->double("return_investment_value")->nullable();
            $table->unsignedInteger("apartment_type_id")->nullable();
            $table->integer("bedrooms")->nullable();
            $table->integer("living_rooms")->nullable();
            $table->float("total_area")->nullable();
            $table->float("net_area")->nullable();
            $table->text("directions")->nullable();
            $table->integer("floor")->nullable();
            $table->integer("apartment_number")->nullable();
            $table->string("bloc_number")->nullable();
            $table->integer("floors")->nullable();
            $table->integer("bathrooms")->nullable();
            $table->boolean("balacony")->nullable();
            $table->string("kitchen_type")->nullable();
            $table->string("image")->nullable();
            $table->string("video")->nullable();
            $table->string("floor_plan")->nullable();
            $table->string("slug")->nullable();
            $table->smallInteger("show_in_home")->nullable();
            $table->timestamp("show_at")->nullable();
            $table->text('seo_keywords')->nullable();
            $table->text('image_alt')->nullable();
            $table->text('meta')->nullable();
            $table->text('description')->nullable();

            $table->timestamps();
            $table->foreign("project_id")->references('id')->on("projects")->onDelete('SET NULL');
            $table->foreign("municipality_id")->references('id')->on("municipalities")->onDelete('SET NULL');
            $table->foreign("payment_type_id")->references('id')->on("payment_types")->onDelete('SET NULL');
            $table->foreign("investment_return_id")->references('id')->on("investment_returns")->onDelete('SET NULL');
            $table->foreign("apartment_type_id")->references('id')->on("apartment_types")->onDelete('SET NULL');
        });


        Schema::create('apartment_transport', function (Blueprint $table) {
            $table->unsignedInteger("apartment_id");
            $table->unsignedInteger("transport_id");
            $table->unique(['apartment_id', 'transport_id']);
            $table->foreign("apartment_id")->references('id')->on("apartments")->onDelete('CASCADE');
            $table->foreign("transport_id")->references('id')->on("transports")->onDelete('CASCADE');
        });

        Schema::create('apartment_views', function (Blueprint $table) {
            $table->increments('id');
            $table->text("name");
            $table->timestamps();
        });

        Schema::create('apartment_view', function (Blueprint $table) {
            $table->unsignedInteger("apartment_id");
            $table->unsignedInteger("apartment_view_id");
            $table->unique(['apartment_id', 'apartment_view_id']);
            $table->foreign("apartment_id")->references('id')->on("apartments")->onDelete('CASCADE');
            $table->foreign("apartment_view_id")->references('id')->on("apartment_views")->onDelete('CASCADE');
        });

        Schema::create('apartment_deliverables', function (Blueprint $table) {
            $table->increments('id');
            $table->text("name");
            $table->timestamps();
        });

        Schema::create('apartment_deliverable', function (Blueprint $table) {
            $table->unsignedInteger("apartment_id");
            $table->unsignedInteger("apartment_deliverable_id");
            $table->unique(['apartment_id', 'apartment_deliverable_id'],'apartment_deliverable_key');
            $table->foreign("apartment_id")->references('id')->on("apartments")->onDelete('CASCADE');
            $table->foreign("apartment_deliverable_id")->references('id')->on("apartment_deliverables")->onDelete('CASCADE');
        });

        Schema::create('apartment_landmark', function (Blueprint $table) {
            $table->unsignedInteger("apartment_id");
            $table->unsignedInteger("landmark_id");
            $table->unique(['apartment_id', 'landmark_id']);
            $table->foreign("apartment_id")->references('id')->on("apartments")->onDelete('CASCADE');
            $table->foreign("landmark_id")->references('id')->on("landmarks")->onDelete('CASCADE');
            $table->timestamps();
        });

        Schema::create('apartment_tag', function (Blueprint $table) {
            $table->unsignedInteger("apartment_id");
            $table->unsignedInteger("apartment_tag_id");
            $table->unique(['apartment_id', 'apartment_tag_id']);
            $table->foreign("apartment_id")->references('id')->on("apartments")->onDelete('CASCADE');
            $table->foreign("apartment_tag_id")->references('id')->on("apartment_tags")->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apartment_transport');
        Schema::dropIfExists('apartments');
        Schema::dropIfExists('payment_types');
        Schema::dropIfExists('investment_returns');
        Schema::dropIfExists('apartment_types');
    }
}
