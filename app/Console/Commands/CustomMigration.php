<?php

namespace App\Console\Commands;

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
        // Yout code here
    }
}
