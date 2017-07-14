<?php

namespace App\Console\Commands;

use App\Models\Catalog\Category;
use App\Models\Catalog\Param;
use App\Models\Catalog\ParamValue;
use App\Models\Catalog\Product;
use App\Models\Content\Chunk;
use Illuminate\Console\Command;

class PublishMultiLang extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'multilang:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $categories = Category::all();
        foreach ($categories as $category) {
            $category->setTranslation('name', 'ru', $category->name_ru);
            $category->setTranslation('name', 'en', $category->name_en);
            $category->save();
        }
        $this->info($categories->count() . ' categories migrated.');

        $chunks = Chunk::all();
        foreach ($chunks as $chunk) {
            $chunk->setTranslation('content', 'ru', $chunk->content_ru);
            $chunk->setTranslation('content', 'en', $chunk->content_en);
            $chunk->save();
        }
        $this->info($chunks->count() . ' categories migrated.');

        $params = Param::all();
        foreach ($params as $param) {
            $param->setTranslation('title', 'ru', $param->title_ru);
            $param->setTranslation('title', 'en', $param->title_en);
            $param->save();
        }
        $this->info($params->count() . ' categories migrated.');

        $values = ParamValue::all();
        foreach ($values as $value) {
            $value->setTranslation('value', 'ru', $value->value_ru);
            $value->setTranslation('value', 'en', $value->value_en);
            $value->save();
        }
        $this->info($values->count() . ' categories migrated.');

        $products = Product::all();
        foreach ($products as $product) {
            $product->setTranslation('descriptionnew', 'ru', $product->description);
            $product->save();
        }
        $this->info($products->count() . ' categories migrated.');
    }
}
