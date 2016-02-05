<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableGalleryProjectsImages extends Migration
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
            $table->string('base_filename')->unique();
            $table->string('base_path');
            $table->string('big_filename')->unique();
            $table->string('big_path');
            $table->string('mobile_filename')->unique();
            $table->string('mobile_path');
            $table->string('thumb_filename')->unique();
            $table->string('thumb_path');
            $table->string('mobile_thumb_filename')->unique();
            $table->string('mobile_thumb_path');
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
