<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleryImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gallery_images', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('gallery_id')->unsigned();
            $table->foreign('gallery_id')->references('id')->on('galleries');
            $table->boolean('is_active')->default(false);

            $table->string('image_name');
            $table->string('image_filename')->unique();
            $table->string('image_path');
            $table->string('image_extension', 10);

            $table->string('image_thumbnail_filename')->unique();
            $table->string('image_thumbnail_path');
            $table->string('image_thumbnail_extension', 10);

            $table->string('mobile_name');
            $table->string('mobile_filename')->unique();
            $table->string('mobile_path');
            $table->string('mobile_extension', 10);

            $table->string('mobile_thumbnail_filename')->unique();
            $table->string('mobile_thumbnail_path');
            $table->string('mobile_thumbnail_extension', 10);

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
        Schema::drop('gallery_images');
    }
}