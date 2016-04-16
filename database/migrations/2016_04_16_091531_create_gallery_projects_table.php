<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleryProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gallery_projects', function(Blueprint $table) {
            $table->increments('id');

            $table->integer('gallery_category_id')->unsigned();
            $table->foreign('gallery_category_id')->references('id')->on('gallery_categories');

            $table->string('name');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('active');
            $table->text('description');
            $table->integer('logo_id')->nullable()->unsigned();
            $table->foreign('logo_id')->references('id')->on('files')->onDelete('set null');
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
        Schema::drop('gallery_projects');
    }
}
