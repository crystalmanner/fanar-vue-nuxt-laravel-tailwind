<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('model');
            $table->string('file_name');
            $table->string('disk');
            $table->unsignedInteger('size')->nullable();
            $table->string('mime_type')->nullable();
            $table->text('title')->nullable();
            $table->string('collection_name')->nullable();
            $table->string('name')->nullable();
            $table->text('manipulations')->nullable();
            $table->text('custom_properties')->nullable();
            $table->text('responsive_images')->nullable();
            $table->unsignedInteger('order_column')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('media');
    }
}
