<?php

namespace App\Console\Commands;

use App\Models\Catalog\Param;
use App\Models\Catalog\Product;
use Illuminate\Console\Command;

class CustomMigration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Custom migration script written by developer';

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
        $params = Param::where('type', Param::TYPE_STR)->get();
        foreach (Product::all() as $product) {
            if (!$attrs = $product->attrs) {
                continue;
            };

            foreach ($params as $param) {
                if (!array_key_exists($param->slug, $attrs)) {
                    continue;
                }

                $old = $attrs[$param->slug];
                $attrs[$param->slug] = [
                    'ru' => $old,
                    'en' => $old,
                ];

                echo '.';
            }
            $product->attrs = $attrs;

            echo "\n";

            $product->save();
        }
    }
}
