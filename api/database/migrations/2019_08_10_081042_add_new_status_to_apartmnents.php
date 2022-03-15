<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewStatusToApartmnents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign("projects_project_status_id_foreign");
            $table->dropColumn("project_status_id");
        });

        Schema::table('apartments', function (Blueprint $table) {
            $table->unsignedInteger("project_status_id")->nullable();
            $table->foreign("project_status_id")->references('id')->on("project_statuses")->onDelete('SET NULL');
            $table->string("return_investment_value")->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('apartments', function (Blueprint $table) {
            //
        });
    }
}
