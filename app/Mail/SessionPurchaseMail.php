<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SessionPurchaseMail extends Mailable
{
    use Queueable, SerializesModels;

    public $userName;
    public $sessionName;
    public $sessionDuration;
    public $calendlyDescription;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userName, $sessionName, $sessionDuration, $calendlyDescription)
    {
        $this->userName = $userName;
        $this->sessionName = $sessionName;
        $this->sessionDuration = $sessionDuration;
        $this->calendlyDescription = $calendlyDescription;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Confirmation and Next Steps for Your PEEQ™ 1:1 Coaching Session')
                    ->view('email.session-purchased')
                    ->with([
                        'userName' => $this->userName,
                        'sessionName' => $this->sessionName,
                        'sessionDuration' => $this->sessionDuration,
                        'calendlyDescription' => $this->calendlyDescription
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
