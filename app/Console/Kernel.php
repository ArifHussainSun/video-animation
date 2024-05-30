<?php

namespace App\Console;

use App\Http\Controllers\PaymentLinkController;
use App\Http\Controllers\PaymentsController;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */

    protected $commands = [
        Commands\SendMailCommand::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            PaymentLinkController::checkLinkValidity();
            
        })->everyMinute();

        $schedule->call(function () {
            PaymentsController::generateReportviaEmail();

        })->timezone('America/New_York')
        ->at('8:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
