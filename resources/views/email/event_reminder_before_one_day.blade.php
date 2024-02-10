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
                Dear {{$userName }},
              </h2>
              <p
                style="margin-bottom: 1em; font-size: 16px; color: #8a8a8a; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;">
                We're delighted that you'll be joining us for the upcoming event on PEEQ™, scheduled for tomorrow on {{ $startDateFormat }}! Your attendance is confirmed, and we're eagerly anticipating your presence. To ensure you're fully prepared, kindly review the information below:
              </p>
              <p
                style="margin-bottom: 1em; font-size: 16px; color: #8a8a8a; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;">
                Adding to Google Calendar: If you haven't already, click the link provided to add the event to your Google Calendar: <a href="http://www.google.com/calendar/event?action=TEMPLATE&dates={{ $startDate }}/{{ $endDate }}&text={{ $eventTitle }}&location=Live&details={{ $eventDescription}}" target="_blank" >Add to Google Calendar</a>. This way, you'll receive timely reminders as the event draws nearer.
              </p>
              <p
                style="margin-bottom: 1em; font-size: 16px; color: #8a8a8a; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;">
                Accessing the Event: To access the event, please keep in mind the following options:
              </p>
              <p
                style="margin-bottom: 1em; font-size: 16px; color: #8a8a8a; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;">
                Option 1: Zoom Link in Google Calendar: Tomorrow, on the event day, access your Google Calendar and find the event. Within the event details, you'll find the Zoom link. Click the link at the scheduled time to seamlessly join the event.
              </p>
              <p
                style="margin-bottom: 1em; font-size: 16px; color: #8a8a8a; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;">
                Option 2: Zoom via PEEQ™: Log in to your PEEQ™ account with your credentials and navigate to the event page. The Zoom link will be clearly displayed. Click on the link to instantly join the event. <a href="{{ $webSiteUrl }}" target="_blank">Website Link</a>
              </p>
              <p
                style="margin-bottom: 1em; font-size: 16px; color: #8a8a8a; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;">
                Option 3: Direct Zoom Link: Alternatively, for quick access to the event waiting room, click this direct Zoom link: <a href="{{ $zoomJoinLink }}" target="_blank">Zoom Link.</a>
              </p>
              <p
                style="margin-bottom: 1em; font-size: 16px; color: #8a8a8a; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;">
                Smooth Event Experience: Prior to joining, please ensure you're logged into your Zoom account to avoid any potential technical issues. If you encounter any challenges or have inquiries, don't hesitate to contact our dedicated support team at support@peeq.com.au.
              </p>
              <p
                style="margin-bottom: 1em; font-size: 16px; color: #8a8a8a; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;">
                We're excited about your participation in this event and the value you bring to the PEEQ™ community.
              </p>
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