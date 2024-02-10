<?php

namespace App\Http\Controllers\cron;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProfileCompletionReminderEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class ProfileCompletionController extends Controller
{
    public function profileCompletionReminderDayAfter()
    {
        $this->sendProfileCompletionReminders('mail_send_after_day', Carbon::now()->subDay());
    }

    public function profileCompletionReminderOneWeekAfter()
    {
        $this->sendProfileCompletionReminders('mail_send_after_week', Carbon::now()->subWeek());
    }

    private function sendProfileCompletionReminders($mailSendAttribute, $dateThreshold)
    {
        $users = User::where(function ($query) {
            $query->whereNull('welcome_checklist_complete')
                ->orWhere('welcome_checklist_complete', '=', 0);
        })
        ->where('created_at', '<=', $dateThreshold)
        ->whereNull('deleted_at')
        ->whereNull($mailSendAttribute)
        ->get();

        if ($users->isNotEmpty()) {
            foreach ($users as $user) {
                try {
                    $userName = $user->first_name . ' ' . $user->last_name;
                    $loginUrl = URL::route('login');
                    Mail::to($user->email)->send(new ProfileCompletionReminderEmail($userName, $loginUrl));
                    $user->$mailSendAttribute = 1;
                    $user->save();
                    sleep(1);
                    // Log successful email sending
                    Log::info('Profile completion reminder email sent successfully to ' . $user->email);
                } catch (TransportExceptionInterface $e) {
                    $this->handleEmailError($e, $user, $mailSendAttribute);
                    $this->retrySendingEmail($user, $mailSendAttribute);
                } catch (Exception $e) {
                    $this->handleEmailError($e, $user, $mailSendAttribute);
                }
            }
        }
    }

    private function retrySendingEmail(User $user, $mailSendAttribute)
    {
        $maxRetries = 3;
        $retryCount = 0;

        while ($retryCount < $maxRetries) {
            try {
                sleep(1);
                Mail::to($user->email)->send(new ProfileCompletionReminderEmail($user->name, URL::route('login')));
                $user->$mailSendAttribute = 1;
                $user->save();
                break;
            } catch (TransportExceptionInterface $e) {
                $this->handleEmailError($e, $user, $mailSendAttribute);
                $retryCount++;
            } catch (Exception $e) {
                $this->handleEmailError($e, $user, $mailSendAttribute);
                $retryCount++;
            }
        }
    }

    private function handleEmailError($e, $user, $mailSendAttribute)
    {
        Log::error('Error sending profile completion reminder email to ' . $user->email);
        Log::error('Error message: ' . $e->getMessage());
    }
}
