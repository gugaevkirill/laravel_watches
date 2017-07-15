<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MultiLanguage2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('name_ru');
            $table->dropColumn('name_en');
        });

        Schema::table('chunks', function (Blueprint $table) {
            $table->dropColumn('content_ru');
            $table->dropColumn('content_en');
        });

        Schema::table('params', function (Blueprint $table) {
            $table->dropColumn('title_ru');
            $table->dropColumn('title_en');
        });

        Schema::table('param_values', function (Blueprint $table) {
            $table->dropColumn('value_ru');
            $table->dropColumn('value_en');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('categories', function (Blueprint $table) {
            $table->string('name_ru')->unique()->nullable();
            $table->string('name_en')->unique()->nullable();
        });

        Schema::table('chunks', function (Blueprint $table) {
            $table->text('content_ru')->nullable();;
            $table->text('content_en')->nullable();
        });

        Schema::table('params', function (Blueprint $table) {
            $table->string('title_ru')->unique()->nullable();;
            $table->string('title_en')->unique()->nullable();
        });

        Schema::table('param_values', function (Blueprint $table) {
            $table->string('value_ru')->nullable();;
            $table->string('value_en')->nullable();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->text('description')->nullable();
        });
    }
}
