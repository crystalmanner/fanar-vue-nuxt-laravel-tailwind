<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditApartmentsTableAddFeaturedProjects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $show = \App\Models\Apartment::where("show_in_home", true)->pluck("id")->toArray();

        Schema::table('apartments', function (Blueprint $table) {
            $table->string("show_in_home")->change();
        });

        \App\Models\Apartment::whereIn("id", $show)->update(['show_in_home' => \App\Models\Apartment::SHOW_IN_FEATURED_OFFERS]);
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
