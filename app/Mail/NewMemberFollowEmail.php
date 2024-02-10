<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewMemberFollowEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $receiverName;
    public $followerName;
    public $loginUrl;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($receiverName, $followerName, $loginUrl)
    {
        $this->receiverName = $receiverName;
        $this->followerName = $followerName;
        $this->loginUrl = $loginUrl;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('PEEQ™ New Follower:' . $this->followerName)
                    ->view('email.new_member_follow')
                    ->with([
                        'receiverName' => $this->receiverName,
                        'followerName' => $this->followerName,
                        'loginUrl' => $this->loginUrl,
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
