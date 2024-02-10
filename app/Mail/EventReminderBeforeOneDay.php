<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class EventReminderBeforeOneDay extends Mailable
{
    use Queueable, SerializesModels;
    public $eventTitle;
    public $userName;
    public $startDateFormat;
    public $endDateFormat;
    public $startDate;
    public $endDate;
    public $eventDescription;
    public $webSiteUrl;
    public $zoomJoinLink;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($eventTitle, $userName, $startDateFormat, $endDateFormat, $startDate, $endDate, $eventDescription, $webSiteUrl, $zoomJoinLink)
    {
        $this->eventTitle = $eventTitle;
        $this->userName = $userName;
        $this->startDateFormat = $startDateFormat;
        $this->endDateFormat = $endDateFormat;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->eventDescription = $eventDescription;
        $this->webSiteUrl = $webSiteUrl;
        $this->zoomJoinLink = $zoomJoinLink;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Reminder: '. $this->userName . ' Your Upcoming PEEQ™ Event Tomorrow!')
                    ->view('email.event_reminder_before_one_day')
                    ->with([
                        'eventTitle' => $this->eventTitle,
                        'userName' => $this->userName,
                        'startDateFormat' => $this->startDateFormat,
                        'endDateFormat' => $this->endDateFormat,
                        'startDate' => $this->startDate,
                        'endDate' => $this->endDate,
                        'eventDescription' => $this->eventDescription,
                        'webSiteUrl' => $this->webSiteUrl,
                        'zoomJoinLink' => $this->zoomJoinLink,
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
