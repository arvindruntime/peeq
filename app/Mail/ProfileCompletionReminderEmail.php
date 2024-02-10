<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ProfileCompletionReminderEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $userName;
    public $loginUrl;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userName, $loginUrl)
    {
        $this->userName = $userName;
        $this->loginUrl = $loginUrl;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Complete Your Profile for Full PEEQ™ Access!')
                    ->view('email.profile_completion_reminder')
                    ->with([
                        'userName' => $this->userName,
                        'loginUrl' => $this->loginUrl
                    ]);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
