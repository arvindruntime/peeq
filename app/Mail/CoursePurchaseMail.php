<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CoursePurchaseMail extends Mailable
{
    use Queueable, SerializesModels;

    public $userName;
    public $courseName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userName, $courseName)
    {
        $this->userName = $userName;
        $this->courseName = $courseName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Confirmation of Your '. $this->courseName .' Purchase')
                    ->view('email.course-purchased')
                    ->with([
                        'userName' => $this->userName,
                        'courseName' => $this->courseName
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
