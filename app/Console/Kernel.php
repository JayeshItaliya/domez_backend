<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        \App\Console\Commands\AutoCancelBooking::class,
        \App\Console\Commands\PaymentDistribution::class,
        \App\Console\Commands\FcmNotification2::class,
        \App\Console\Commands\FcmNotification3::class,
    ];
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('bookings:cancel')->everyMinute()->appendOutputTo(storage_path('logs/bookings_cancel.log'));
        $schedule->command('payment:distribute')->everyMinute()->appendOutputTo(storage_path('logs/payment_distribute.log'));
        // $schedule->command('FCM:Notifcation:2')->everyMinute()->appendOutputTo(storage_path('logs/notification2.log'));
        // $schedule->command('FCM:Notifcation:3')->everyMinute()->appendOutputTo(storage_path('logs/notification3.log'));

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
