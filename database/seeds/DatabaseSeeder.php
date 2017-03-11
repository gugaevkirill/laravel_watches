<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (\App\Models\Catalog\Brand::all()->isEmpty()) {
            $this->call(BrandsSeeder::class);
        }

        if (\App\Models\Catalog\Category::all()->isEmpty()) {
            $this->call(CategoriesSeeder::class);
        }

        if (\App\Models\Content\Chunk::all()->isEmpty()) {
            $this->call(ChunksSeeder::class);
        }

        if (\App\Models\Catalog\Param::all()->isEmpty()) {
            $this->call(ParamsSeeder::class);
        }

        if (\App\Models\Catalog\ParamValue::all()->isEmpty()) {
            $this->call(ParamValuesSeeder::class);
        }

        if (\App\Models\Catalog\Product::all()->isEmpty()) {
            $this->call(ProductsSeeder::class);
        }

        if (\Backpack\Settings\app\Models\Setting::all()->isEmpty()) {
            $this->call(\Backpack\Settings\database\seeds\SettingsTableSeeder::class);
        }

        if (\App\User::all()->isEmpty()) {
            $this->call(UserSeeder::class);
        }
    }
}
