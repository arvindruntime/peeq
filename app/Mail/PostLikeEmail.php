<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PostLikeEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $receiverName;
    public $likeUserName;
    public $loginUrl;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($receiverName, $likeUserName, $loginUrl)
    {
        $this->likeUserName = $likeUserName;
        $this->receiverName = $receiverName;
        $this->loginUrl = $loginUrl;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('PEEQ™ Interaction : ' . $this->likeUserName . ' ' . 'Like on Your Post!')
                    ->view('email.post_like')
                    ->with([
                        'receiverName' => $this->receiverName,
                        'likeUserName' => $this->likeUserName,
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
