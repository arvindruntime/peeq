@extends('layouts.emailTemplate.master')
@section('content')
<!-- start main content-->
<div class="cpi-content-inner">
    <table style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; border-collapse: collapse !important;">
      <tbody>
        <tr>
          <td style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; width: 12px; height: 25px;" width="12" height="25">
            &nbsp;
          </td>
          <td style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; width: 12px; height: 25px;" width="12" height="25">
            &nbsp;
          </td>
        </tr>
      </tbody>
    </table>
    <table style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; border-collapse: collapse !important;">
      <tbody>
        <tr>
          <tr>
            <td
              style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; padding: 30px; background-color: #fff; border-radius: 20px;">
              <h2
                style="display: block; color: #1f1f1f; font-weight: bold; line-height: 100%; margin-top: 0; margin-right: 0; margin-bottom: 10px; margin-left: 0; font-size: 20px;">
                Dear {{ $goingUserName }},
              </h2>
              <p
                style="margin-bottom: 1em; font-size: 16px; color: #8a8a8a; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;">
                We're excited to see that you've confirmed your attendance for the upcoming event on {{ $startDateFormat }} through the PEEQ™ network! To ensure you have a seamless experience and don't miss out on any valuable content, please follow the steps below:
              </p>
              
              <p style="color: #8a8a8a; font-size: 16px; margin-top: 16px;">1. <strong>Add to Google Calendar:</strong> To add the event to your Google Calendar, simply click the following link: <a href="http://www.google.com/calendar/event?action=TEMPLATE&dates={{ $startDate }}/{{ $endDate }}&text={{ $eventTitle }}&location=Live&details={{ $eventDescription }}" target="_blank">Add to Google Calendar</a>. This will help you stay organised and receive reminders as the event date approaches.</p>
              
              <p style="color: #8a8a8a; font-size: 16px; margin-top: 16px;">2. <strong>Accessing the Event:</strong>In order to watch the event, please remember that you must join through one of the following options:</p>
              
              <table style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; border-collapse: collapse !important;" >
                <tbody>
                  <tr>
                    <td style="padding-left: 40px;">
                      <p style="color: #8a8a8a; font-size: 16px; margin-top: 16px;"><strong>Option 1: Zoom Link in Google Calendar:</strong> On the day of the event, open your Google Calendar and click on the event. You'll find the Zoom link provided within the event details. Click the link at the scheduled time to join the event directly.</p>
                      <p style="color: #8a8a8a; font-size: 16px; margin-top: 16px;"><strong>Option 2: Zoom Link within the PEEQ™ System:</strong> Log in to the PEEQ™ system using your credentials and navigate to the event page. There, you'll find the Zoom link displayed. Click on the link to join the event.</p>
                      <p style="color: #8a8a8a; font-size: 16px; margin-top: 16px;"><strong>Option 3: Zoom Link:</strong> Alternatively, you can also just click this link to access the event directly from your email: <a href="{{ $zoomJoinLink }}" target="_blank">Zoom Link</a>
                      </p>
                    </td>
                  </tr>
                </tbody>
              </table>
              
              <p style="color: #8a8a8a; font-size: 16px; margin-top: 16px;">Please ensure you're logged into your Zoom account when accessing the event to avoid any complications. If you encounter any technical issues or have questions, feel free to reach out to our support team at support@peeq.com.au</p>
              
              <p style="color: #8a8a8a; font-size: 16px; margin-top: 16px;">We're looking forward to having you join us for this exciting event! Thank you for being a part of the PEEQ™ community.</p>
              
              <p
                style="color: #8a8a8a; font-size: 16px; margin-top: 16px;">
                Best regards,
              </p>
              <p
                style="color: #8a8a8a; font-size: 16px; margin-top: 16px;">
                PEEQ™ Network Team
              </p>
            </td>
          </tr>
        </tr>
      </tbody>
    </table>
</div>
<!-- end main content -->
@endsection