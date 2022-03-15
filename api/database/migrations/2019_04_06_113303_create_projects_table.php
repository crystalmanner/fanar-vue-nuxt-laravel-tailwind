<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facilities', function (Blueprint $table) {
            $table->increments('id');
            $table->text("name");
            $table->timestamps();
        });

        Schema::create('transports', function (Blueprint $table) {
            $table->increments('id');
            $table->text("name");
            $table->timestamps();
        });

        Schema::create('project_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->text("name");
            $table->string("color")->nullable();
            $table->timestamps();
        });

        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->text("name");
            $table->string("slug");
            $table->string("code")->unique();
            $table->string("contact")->nullable();
            $table->string("phone")->nullable();
            $table->unsignedInteger("project_status_id")->nullable();
            $table->unsignedInteger("municipality_id")->nullable();
            $table->float("availability")->nullable();
            $table->date("delivery_date")->nullable();
            $table->boolean("ready_for_registration")->nullable();
            $table->integer("buildings")->nullable();
            $table->integer("apartments")->nullable();
            $table->string("construction_company")->nullable();
            $table->float("downtown_distance")->nullable();
            $table->string("image")->nullable();
            $table->string("video")->nullable();
            $table->timestamps();
            $table->foreign("project_status_id")->references('id')->on("project_statuses")->onDelete('SET NULL');
            $table->foreign("municipality_id")->references('id')->on("municipalities")->onDelete('SET NULL');
        });

        Schema::create('project_facility', function (Blueprint $table) {
            $table->unsignedInteger("project_id");
            $table->unsignedInteger("facility_id");
            $table->unique(['project_id', 'facility_id']);
            $table->foreign("project_id")->references('id')->on("projects")->onDelete('CASCADE');
            $table->foreign("facility_id")->references('id')->on("facilities")->onDelete('CASCADE');
        });

        Schema::create('project_transport', function (Blueprint $table) {
            $table->unsignedInteger("project_id");
            $table->unsignedInteger("transport_id");
            $table->unique(['project_id', 'transport_id']);
            $table->foreign("project_id")->references('id')->on("projects")->onDelete('CASCADE');
            $table->foreign("transport_id")->references('id')->on("transports")->onDelete('CASCADE');
        });

        Schema::create('project_landmark', function (Blueprint $table) {
            $table->unsignedInteger("project_id");
            $table->unsignedInteger("landmark_id");
            $table->unique(['project_id', 'landmark_id']);
            $table->foreign("project_id")->references('id')->on("projects")->onDelete('CASCADE');
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
        Schema::dropIfExists('project_facility');
        Schema::dropIfExists('facilities');
        Schema::dropIfExists('project_transport');
        Schema::dropIfExists('transports');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('project_statuses');
    }
}
