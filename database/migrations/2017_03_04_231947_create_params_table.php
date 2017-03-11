<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use \App\Models\Catalog\Param;

class CreateParamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('params', function (Blueprint $table) {
            $table->string('slug')->primary();
            $table->string('title_ru')->unique();
            $table->string('title_en')->unique()->nullable();
            $table->smallInteger('order')->unsigned()->default(100)->index();
            $table->enum('type', Param::TYPES)->index();
            $table->boolean('required')->default(false);
            $table->boolean('unique')->default(false);
            $table->boolean('in_filter')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('params');
    }
}
