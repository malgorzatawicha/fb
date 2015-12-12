<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_images', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');
            $table->boolean('active')->default(false);
            $table->boolean('is_featured')->default(false);

            $table->string('image_name')->unique();
            $table->string('image_path');
            $table->string('image_extension', 10);

            $table->string('image_thumbnail_name')->unique();
            $table->string('image_thumbnail_path');
            $table->string('image_thumbnail_extension', 10);

            $table->string('mobile_name')->unique();
            $table->string('mobile_path');
            $table->string('mobile_extension', 10);

            $table->string('mobile_thumbnail_name')->unique();
            $table->string('mobile_thumbnail_path');
            $table->string('mobile_thumbnail_extension', 10);

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
        Schema::drop('product_images');
    }
}
