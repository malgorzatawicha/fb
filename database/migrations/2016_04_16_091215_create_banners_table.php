<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('page_id')->unsigned();
            $table->foreign('page_id')->references('id')->on('pages');

            $table->string('name');
            $table->text('description');

            $table->integer('file_id')->nullable()->unsigned();
            $table->foreign('file_id')->references('id')->on('files');

            $table->boolean('active')->default(false);
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
        Schema::drop('banners');

    }
}
