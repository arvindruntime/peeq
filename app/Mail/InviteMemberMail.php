<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InviteMemberMail extends Mailable
{
    use Queueable, SerializesModels;
    public $invitationLink;
    public $receiverName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($invitationLink, $receiverName, $additionalMessage)
    {
        $this->invitationLink = $invitationLink;
        $this->receiverName = $receiverName;
        $this->additionalMessage = $additionalMessage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Join PEEQ™ - Your Exclusive Invitation Awaits!')
                    ->view('email.invite-member')
                    ->with([
                        'invitationLink' => $this->invitationLink,
                        'receiverName' => $this->receiverName,
                        'additionalMessage' => $this->additionalMessage,
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
