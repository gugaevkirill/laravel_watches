<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MultiLanguage1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->json('name')->nullable();
        });

        Schema::table('chunks', function (Blueprint $table) {
            $table->json('content')->nullable();
        });

        Schema::table('params', function (Blueprint $table) {
            $table->json('title')->nullable();
        });

        Schema::table('param_values', function (Blueprint $table) {
            $table->json('value')->nullable();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->json('descriptionnew')->nullable();
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
            $table->dropColumn('name');
        });

        Schema::table('chunks', function (Blueprint $table) {
            $table->dropColumn('content');
        });

        Schema::table('params', function (Blueprint $table) {
            $table->dropColumn('title');
        });

        Schema::table('param_values', function (Blueprint $table) {
            $table->dropColumn('value');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('descriptionnew');
        });
    }
}
