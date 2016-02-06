<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMainImageToGalleryProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gallery_projects', function($table)
        {
            $table->integer('main_image_id')->unsigned()->nullable();
            $table->foreign('main_image_id')->references('id')->on('gallery_project_images');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gallery_projects', function($table)
        {
            $table->dropColumn('main_image_id');
        });
    }
}
