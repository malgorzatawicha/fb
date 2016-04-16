<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleryCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gallery_categories', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('title');
            $table->string('slug')->unique();
            $table->boolean('active');
            $table->text('description');
            $table->integer('logo_id')->nullable()->unsigned();
            $table->foreign('logo_id')->references('id')->on('files');
            $table->integer('parent_id')->nullable()->index();
            $table->integer('lft')->nullable()->index();
            $table->integer('rgt')->nullable()->index();
            $table->integer('depth')->nullable();

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
        Schema::drop('gallery_categories');
    }
}
