<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        \App\Console\Commands\AutoCancelBooking::class,
    ];
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('bookings:cancel')->everyMinute()->appendOutputTo(storage_path('logs/bookings:cancel.log'));
        $schedule->command('payment:distribute')->weeklyOn(3, '9:00')->appendOutputTo(storage_path('logs/payment:distribute.log'));
        // $schedule->command('bookings:cancel')->everyMinute()->withoutOverlapping()->onFailure(function () { /* Code..*/ });;
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
