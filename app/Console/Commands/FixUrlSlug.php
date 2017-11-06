<?php

namespace App\Console\Commands;

use App\Models\Catalog\Product;
use App\Models\Catalog\ProductArchived;
use Illuminate\Console\Command;

class FixUrlSlug extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:fixurlslug';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix Url Slug';

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
        foreach (Product::all() as $product) {
            $this->fixProductUrlSlug($product);
        }

        foreach (ProductArchived::all() as $product) {
            $this->fixProductUrlSlug($product);
        }
    }

    private function fixProductUrlSlug(Product $product): void
    {
        if ($product->url_slug) {
            return;
        }

        $product->url_slug = $product->generateSlug();
        $product->save();

        echo '.';
    }
}
