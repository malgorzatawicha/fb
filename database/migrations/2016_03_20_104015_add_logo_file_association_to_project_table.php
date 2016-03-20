<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLogoFileAssociationToProjectTable extends Migration
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
            $table->dropColumn('logo_filename');
            $table->dropColumn('logo_path');

            $table->integer('logo_id')->unsigned();
            $table->foreign('logo_id')->references('id')->on('files');
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
            $table->dropColumn('logo_id');
            $table->string('logo_filename')->nullable()->unique();
            $table->string('logo_path')->nullable();
        });
    }
}
