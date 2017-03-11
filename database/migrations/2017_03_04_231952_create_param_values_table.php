<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParamValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('param_values', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('order')->unsigned()->default(100)->index();
            $table->string('param_slug')->index();
            $table->foreign('param_slug')->references('slug')->on('params')->onDelete('cascade');
            $table->string('value_ru');
            $table->string('value_en')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('param_values');
    }
}
