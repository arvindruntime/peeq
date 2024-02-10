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
                Greetings from the PEEQ™ team,
              </p>
              <p
                style="margin-bottom: 1em; font-size: 16px; color: #8a8a8a; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;">
                We're pleased to have you as a new member of the PEEQ™ community. To help you get acquainted with our platform and make the most of your experience, we've put together some essential information that will guide you through the initial steps.
              </p>
              <p
                style="margin-bottom: 1em; font-size: 16px; color: #8a8a8a; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;">
                As a token of our appreciation for joining the PEEQ™ network, we're excited to offer you a special gift. You now have exclusive access to our Luminary Mindset 14-page downloadable bundle, courtesy of Zoe Williams and her team. These self-development tools are designed to complement your journey with PEEQ™, providing techniques and planners to assist you in integrating new habits and pursuing your goals.
              </p>
              <p
                style="margin-bottom: 1em; font-size: 16px; color: #8a8a8a; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;">
                To get started, please refer to the <a href="https://drive.google.com/file/d/1qDUZgDSCpGsUCCD3bq_4lGZIvy5KQjRV/view" target="_blank" style="text-decoration: underline; color: blue;">Welcome to PEEQ™ Document</a>, which outlines key features and tips for navigating our platform.
              </p>
              <p
                style="margin-bottom: 1em; font-size: 16px; color: #8a8a8a; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;">
                Thank you for being a part of PEEQ™. We're here to support you as you explore the platform and all the opportunities it offers.
              </p>            
              <p
                style="color: #8a8a8a; font-size: 16px; margin-top: 16px;">
                Best regards,
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
