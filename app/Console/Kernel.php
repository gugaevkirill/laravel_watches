<?php

namespace App\Console;

use App\Console\Commands\CustomMigration;
use App\Console\Commands\ShuffleProducts;
use App\Console\Commands\UpdateCurrencyCources;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        CustomMigration::class,
        UpdateCurrencyCources::class,
        ShuffleProducts::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
         $schedule->command('custom:currencyupdate')
             ->weekly();
        $schedule->command('custom:shuffleproducts')
            ->weekly();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
