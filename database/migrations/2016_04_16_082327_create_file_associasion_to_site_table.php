<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileAssociasionToSiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('site', function($table)
        {
            $table->dropColumn('banner_filename');
            $table->dropColumn('banner_path');

            $table->integer('banner_id')->nullable()->unsigned();
            $table->foreign('banner_id')->references('id')->on('files');

            $table->integer('favicon_id')->nullable()->unsigned();
            $table->foreign('favicon_id')->references('id')->on('files');

            $table->string('breadcrumb');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('site', function($table)
        {
            $table->dropColumn('banner_id');
            $table->string('banner_filename')->nullable()->unique();
            $table->string('banner_path')->nullable();

            $table->dropColumn('favicon_id');
            $table->dropColumn('breadcrumb');
        });
    }
}
