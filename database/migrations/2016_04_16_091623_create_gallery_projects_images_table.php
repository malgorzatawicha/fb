<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleryProjectsImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gallery_project_images', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('gallery_project_id')->unsigned();
            $table->foreign('gallery_project_id')->references('id')->on('gallery_projects');
            $table->boolean('active')->default(false);

            $table->string('name');
            $table->text('description');
            $table->integer('image_id')->nullable()->unsigned();
            $table->foreign('image_id')->references('id')->on('files')->onDelete('set null');

            $table->integer('thumb_id')->nullable()->unsigned();
            $table->foreign('thumb_id')->references('id')->on('files')->onDelete('set null');
            $table->boolean('watermarked')->default(true);

            $table->integer('position');
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
        Schema::drop('gallery_projects_images');
    }
}
