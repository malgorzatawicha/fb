<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description');

            $table->string('banner_name');
            $table->string('banner_filename')->unique();
            $table->string('banner_path');
            $table->string('banner_extension', 10);

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
        Schema::drop('site');
    }
}