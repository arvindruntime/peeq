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
                Dear {{ $receiverName }},
              </h2>
              <p
                style="margin-bottom: 1em; font-size: 16px; color: #8a8a8a; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;">
                I hope this email finds you well! I'm excited to extend a special invitation to you for an exclusive opportunity. I am currently a valued member of a new one of its kind leadership development app called PEEQ™ (Performance Elevation through EQ), I believe you'd be a perfect fit for our thriving community of like-minded global leaders.
              </p>
              <p
                style="margin-bottom: 1em; font-size: 16px; color: #8a8a8a; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;">
                PEEQ™ offers a unique space to connect, collaborate, and grow with influential professionals from diverse industries and backgrounds. From topic-based groups to live coaching sessions and thought-provoking webinars, there's something for everyone seeking personal and professional development.
              </p>
              <p
                style="margin-bottom: 1em; font-size: 16px; color: #8a8a8a; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;">
                Joining PEEQ™ is easy! It would be great to have you in this community with me - simply click the link below to create your account and unlock your full potential:
              </p>
              <p
                style="color: #8a8a8a; font-size: 16px; margin-top: 20px;">
                <a href="{{ $invitationLink }}">[Invitation Link]</a>
              </p>
              <p
                style="color: #8a8a8a; font-size: 16px; margin-top: 20px;">
                I can't wait to see you on the platform, where we can connect, learn, and grow together.
              </p>
              <p
                style="color: #8a8a8a; font-size: 16px; margin-top: 20px;">
                Let's elevate our performance and EQ with PEEQ™!
              </p>
              <p
                style="color: #8a8a8a; font-size: 16px; margin-top: 20px;">
                {{ $additionalMessage }}
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
