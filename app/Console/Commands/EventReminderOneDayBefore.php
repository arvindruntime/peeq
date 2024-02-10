<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Http\Controllers\Cron\EventReminderController;

class EventReminderOneDayBefore extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'event-reminder-one-day-before';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send event reminder emails 1 day before event start';
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $controller = new EventReminderController();
        $controller->eventReminderOneDayBefore();

        $this->info('Event reminder email 1 day before sent successfully.');

    }
}
