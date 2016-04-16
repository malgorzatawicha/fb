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
            $table->string('description');
            $table->string('keywords');
            $table->string('breadcrumb');
            $table->text('footer');

            $table->integer('banner_id')->nullable()->unsigned();
            $table->foreign('banner_id')->references('id')->on('files');

            $table->integer('favicon_id')->nullable()->unsigned();
            $table->foreign('favicon_id')->references('id')->on('files');


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
