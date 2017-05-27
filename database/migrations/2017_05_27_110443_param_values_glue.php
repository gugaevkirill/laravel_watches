<?php

use Illuminate\Support\Facades\Schema;
use App\Models\Catalog\Param;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ParamValuesGlue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE param_values DROP CONSTRAINT IF EXISTS param_values_param_slug_foreign;");
        DB::statement("ALTER TABLE param_values DROP COLUMN IF EXISTS param_slug;");

        Schema::create(Param::VALUE_PIVOT, function (Blueprint $table) {
            $table->string('param_slug');
            $table->foreign('param_slug')->references('slug')->on('params')->onDelete('cascade');
            $table->integer('param_value_id');
            $table->foreign('param_value_id')->references('id')->on('param_values')->onDelete('cascade');
            $table->primary(['param_slug', 'param_value_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Param::VALUE_PIVOT);
    }
}
