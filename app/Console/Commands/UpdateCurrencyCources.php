<?php

namespace App\Console\Commands;

use App\Repositories\CurrencyRepository;
use Illuminate\Console\Command;

class UpdateCurrencyCources extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:currencyupdate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update currency cource';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        (new CurrencyRepository())->updateCources();
    }
}
