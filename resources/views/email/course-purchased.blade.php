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
              We are writing to acknowledge your recent purchase of the {{ $courseName }} from PEEQ™. We hope you find the course both enjoyable and educational as you embark on your journey.
            </p>
            <p
              style="margin-bottom: 1em; font-size: 16px; color: #8a8a8a; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;">
              If you have any inquiries or need support throughout your course, please do not hesitate to contact our dedicated support team.
            </p>
            <p style="color: #8a8a8a; font-size: 16px; margin-top: 16px;">Thank you for choosing PEEQ™.</p>
            
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
