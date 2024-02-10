<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PostCommentEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $receiverName;
    public $commentUserName;
    public $loginUrl;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($receiverName, $commentUserName, $loginUrl)
    {
        $this->commentUserName = $commentUserName;
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
        return $this->subject('PEEQ™ Interaction : ' . $this->commentUserName . ' ' . ' Comment on Your Post!')
                    ->view('email.post_comment')
                    ->with([
                        'receiverName' => $this->receiverName,
                        'commentUserName' => $this->commentUserName,
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
