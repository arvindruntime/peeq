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
                We hope this email finds you well. It seems like you've requested to reset your password for your PEEQ™ account. No worries; we're here to assist you in regaining access to your exclusive membership.
              </p>
              <p
                style="margin-bottom: 1em; font-size: 16px; color: #8a8a8a; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;">
                To proceed with the password reset, simply click on the link provided below. You'll be directed to a secure page where you can set a new password:
              </p>
              <p
                style="color: #8a8a8a; font-size: 16px; margin-top: 20px;">
                <a href="{{ route('reset.password.get', ['token' => $token, 'email' => $email ]) }}">[Reset Password Link]</a>
              </p>
              <p
                style="color: #8a8a8a; font-size: 16px; margin-top: 20px;">
                Please ensure that you complete this process within 30 minutes for security purposes. If you did not initiate this request, kindly ignore this email, and your account will remain secure.
              </p>
              <p
                style="color: #8a8a8a; font-size: 16px; margin-top: 20px;">
                At PEEQ™, we value the safety and privacy of our members, and this additional verification step helps us ensure your account's protection.
              </p>
              <p
                style="color: #8a8a8a; font-size: 16px; margin-top: 20px;">
                Should you encounter any difficulties or require further assistance, don't hesitate to contact our support team at support@peeq.com.au. We're here to help you get back on track!
              </p>
              <p
                style="color: #8a8a8a; font-size: 16px; margin-top: 20px;">
                Thank you for being a part of the PEEQ™ community. We look forward to continuing our journey of growth and empowerment together.
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
