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
                We wanted to share some wonderful news with you! {{ $commentUserName }} has commented on your post on PEEQ™ - Performance Elevation through EQ! 🎉 Connect and grow with supportive leaders who appreciate your insights and contributions.
              </p>

            <table class="image_block mobile_hide"
                width="100%" border="0" align="center"
                cellpadding="0" cellspacing="0"
                role="presentation"
                style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                <tbody>
                <tr>
                    <td
                    style="width:100%;padding-right:0px;padding-left:0px;margin: 0 auto;display: block; ">
                    <div align="center"
                        style="line-height:10px; display: block;">
                        <a href="{{ $loginUrl }}" target="_blank"
                        style="outline:none"
                        tabindex="-1"><img
                            src="https://peeq.com.au/public/assets/images/login_email.png"
                            style="display: block; height: auto; border: 0; width: 100px; max-width: 100%;"
                            width="100"></a>
                    </div>
                    </td>
                </tr>
                </tbody>
            </table>
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
