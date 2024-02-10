<?php

namespace App\Console;

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
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('event-reminder-one-hour-before')->everyMinute(); // Run the command every minute
        $schedule->command('event-reminder-one-day-before')->everyMinute(); // Run the command every minute
        $schedule->command('send-profile-completion-emails-24-hours')->everyMinute(); // Run the command every minute
        $schedule->command('send-profile-completion-emails-one-week')->weekly(); // Run the command every week
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
