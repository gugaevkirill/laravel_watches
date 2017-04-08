<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('order')->unsigned()->default(100);
            $table->string('brand_slug');
            $table->foreign('brand_slug')->references('slug')->on('brands')->onDelete('cascade');
            $table->string('category_slug');
            $table->foreign('category_slug')->references('slug')->on('categories')->onDelete('cascade');

            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->json('images');
            $table->integer('price_rub')->unsigned()->nullable();
            $table->integer('price_dollar')->unsigned()->nullable();
            $table->json('attrs')->nullable();

            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
