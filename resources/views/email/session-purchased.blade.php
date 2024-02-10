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
              Dear {{ $userName }},
            </h2>
            <p
              style="margin-bottom: 1em; font-size: 16px; color: #8a8a8a; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;">
              Thank you for your recent purchase of the {{ $sessionDuration }} 1:1 coaching session with PEEQ™.
            </p>
            <p
              style="margin-bottom: 1em; font-size: 16px; color: #8a8a8a; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;">
              To optimize your experience, we kindly request you to schedule your session with your assigned coach. You can conveniently set the date and time by clicking on the button below, which will direct you to Calendly.
            </p>
            <a href="{{ $calendlyDescription }}" target="_blank" style="font-size: 16px; margin-top: 16px;">Secure Your Session
            </a>
            <p
              style="margin-bottom: 1em; font-size: 16px; color: #8a8a8a; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;">
              For any scheduling-related concerns or inquiries, please don't hesitate to contact our support team at support@peeq.com.au.
            </p>
            <p
              style="margin-bottom: 1em; font-size: 16px; color: #8a8a8a; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;">
              We appreciate your trust in PEEQ™ and eagerly anticipate delivering a rewarding coaching session tailored to your needs.
            </p>

            <p
              style="color: #8a8a8a; font-size: 16px; margin-top: 16px;">
              Warm regards,
            </p>
            <p
              style="color: #8a8a8a; font-size: 16px; margin-top: 16px;">
              The PEEQ™ Team
            </p>
          </td>
        </tr>
      </tr>
    </tbody>
  </table>
</div>
<!-- end main content -->
@endsection
