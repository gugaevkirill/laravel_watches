<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NewImagesFieldInProductsBrands extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            DB::statement("ALTER TABLE products ADD COLUMN imagesnew json DEFAULT '[]';");
            DB::statement("ALTER TABLE brands ADD COLUMN imagenew BIGINT;");
            DB::statement("ALTER TABLE sell_forms ADD COLUMN imagenew BIGINT;");
            DB::statement("ALTER TABLE brands DROP COLUMN image;");
            DB::statement("ALTER TABLE sell_forms DROP COLUMN image;");
            DB::statement("ALTER TABLE products alter COLUMN images DROP NOT NULL ;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
            DB::statement("ALTER TABLE products DROP COLUMN imagesnew;");
            DB::statement("ALTER TABLE brands DROP COLUMN imagenew;");
            DB::statement("ALTER TABLE sell_forms DROP COLUMN imagenew;");
            DB::statement("ALTER TABLE brands ADD COLUMN image text;");
            DB::statement("ALTER TABLE sell_forms ADD COLUMN image text;");
    }
}
