<?php

namespace App\Console\Commands;

use App\Repositories\CurrencyRepository;
use Illuminate\Console\Command;
use App\Models\Catalog;

class ShuffleProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:shuffleproducts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Shuffle products order field';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        foreach (Catalog\Product::all() as $product) {
            $product->order = random_int(101, 200);
            $product->save();
            echo " - $product->order";
        }
    }
}
