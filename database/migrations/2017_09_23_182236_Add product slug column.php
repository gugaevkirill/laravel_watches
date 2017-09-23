<?php

use \App\Models\Catalog\Product;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProductSlugColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string(Product::URL_SLUG)->nullable()->index();
        });

        foreach (Product::all() as $product) {
            if ($product->url_slug) {
                continue;
            }

            $product->url_slug = $product->generateSlug();
            $product->save();
        }

        Schema::table('products', function (Blueprint $table) {
            $table->unique(Product::URL_SLUG);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(Product::URL_SLUG);
        });
    }
}
