<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\Cron\ProfileCompletionController;

class SendProfileCompletionEmailsOneWeek extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send-profile-completion-emails-one-week';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send profile completion reminder emails to users after 1 week';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $controller = new ProfileCompletionController();
        $controller->profileCompletionReminderOneWeekAfter();

        $this->info('Profile completion reminder email after 1 week sent successfully.');
    }
}
