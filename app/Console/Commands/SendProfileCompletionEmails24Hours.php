<?php

namespace App\Console\Commands;

use App\Http\Controllers\Cron\ProfileCompletionController;
use Illuminate\Console\Command;

class SendProfileCompletionEmails24Hours extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send-profile-completion-emails-24-hours';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send profile completion reminder emails to users after 24 hours';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $controller = new ProfileCompletionController();
        $controller->profileCompletionReminderDayAfter();

        $this->info('Profile completion reminder email after 24 hours sent successfully.');
    }
}
