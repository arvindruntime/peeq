<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
class EventGoingEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $goingUserName;
    public $zoomJoinLink;
    public $startDateFormat;
    public $endDateFormat;
    public $startDate;
    public $endDate;
    public $eventTitle;
    public $eventDescription;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($goingUserName, $zoomJoinLink, $startDateFormat, $endDateFormat, $startDate, $endDate, $eventTitle, $eventDescription)
    {
        $this->goingUserName = $goingUserName;
        $this->zoomJoinLink = $zoomJoinLink;
        $this->startDateFormat = $startDateFormat;
        $this->endDateFormat = $endDateFormat;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->eventTitle = $eventTitle;
        $this->eventDescription = $eventDescription;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Important: '. $this->goingUserName . ' Your Upcoming Event on PEEQ™.')
                    ->view('email.event_going')
                    ->with([
                        'goingUserName' => $this->goingUserName,
                        'zoomJoinLink' => $this->zoomJoinLink,
                        'startDateFormat' => $this->startDateFormat,
                        'endDateFormat' => $this->endDateFormat,
                        'startDate' => $this->startDate,
                        'endDate' => $this->endDate,
                        'eventTitle' => $this->eventTitle,
                        'eventDescription' => $this->eventDescription,
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
