<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CategoriesParamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories_params', function (Blueprint $table) {
            $table->string('category_slug');
            $table->foreign('category_slug')->references('slug')->on('categories')->onDelete('cascade');
            $table->string('param_slug');
            $table->foreign('param_slug')->references('slug')->on('params')->onDelete('cascade');
            $table->primary(['category_slug', 'param_slug']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories_params');
    }
}
