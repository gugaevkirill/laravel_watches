<?php

namespace App\Console\Commands;

use App\Models\Catalog\Product;
use Illuminate\Console\Command;

class PublishProductsPrice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'price:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fills product usd price by price_dollar';

    /**
     * Create a new command instance.
     *
     * @return void
     */
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
            $product->price_usd = $product->price_dollar;
            $product->save();

            echo '.';
        }
    }
}
