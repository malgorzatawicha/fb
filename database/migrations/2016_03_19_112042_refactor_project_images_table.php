<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RefactorProjectImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gallery_project_images', function($table)
        {
            $table->dropColumn('base_filename');
            $table->dropColumn('base_path');
            $table->dropColumn('big_filename');
            $table->dropColumn('big_path');
            $table->dropColumn('mobile_filename');
            $table->dropColumn('mobile_path');
            $table->dropColumn('thumb_filename');
            $table->dropColumn('thumb_path');
            $table->dropColumn('mobile_thumb_filename');
            $table->dropColumn('mobile_thumb_path');

            $table->integer('image_id')->unsigned();
            $table->foreign('image_id')->references('id')->on('files');

            $table->integer('thumb_id')->unsigned();
            $table->foreign('thumb_id')->references('id')->on('files');

            $table->boolean('watermarked')->default(true);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gallery_project_images', function($table)
        {
            $table->dropColumn('main_image_id');
        });
    }
}
