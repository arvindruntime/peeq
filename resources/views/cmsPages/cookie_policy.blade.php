@extends('layouts.cmsPage.master')
@section('content')

<main class="main-content" id="main">
    <section class="lm_term">
      <div class="container-fluid my-4">
        <div class="d-flex">
          <div class="lm_term-back">
            <h5> <a class="text-dark" href="{{ url('/') }}">Back</a></h5>
          </div>
          <div class="lm_term-logo text-center"><a href="#"><img src="{{asset('assets/images/dash-logo.svg')}}" alt=""></a></div>
        </div>
      </div>
      <div class="lm_term-con">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="lm_term-main mx-auto">
                <div class="lm_term-card card">
                  <div class="lm_term-title">
                    <h2 class="mb-0">COOKIE POLICY</h2>
                    <p class="mb-5"><b>Last updated July 13, 2023</b></p>
                  </div>
                  <div class="lm_term-body text-dark">
                    <p class="mb-3">This Cookie Policy explains how Luminary Mindset PTY LTD (<b>"Company"</b>, <b>"we"</b>, <b>"us"</b>, and <b>"our"</b>) uses cookies and similar technologies to recognize you when you visit our website at <a href="https://www.peeq.com.au/" class="text-decoration-underline text-primary" target="_blank">https://www.peeq.com.au</a> ('<b>"Website"</b>'). It explains what these technologies are and why we use them, as well as your rights to control our use of them.
                    </p>
                    <p class="mb-5">
                      In some cases we may use cookies to collect personal information, or that becomes personal information if we combine it with other information.
                    </p>
                    <h5 class="mb-4 pt-1"><b>What are cookies?</b></h5>
                    <p class="mb-3" id="personal">Cookies are small data files that are placed on your computer or mobile device when you visit a website. Cookies are widely used by website owners in order to make their websites work, or to work more efficiently, as well as to provide reporting information.</p>
                    <p class="mb-5" id="personal">Cookies set by the website owner (in this case, Luminary Mindset PTY LTD) are called "first-party cookies." Cookies set by parties other than the website owner are called "third-party cookies." Third-party cookies enable third-party features or functionality to be provided on or through the website (e.g., advertising, interactive content, and analytics). The parties that set these third-party cookies can recognize your computer both when it visits the website in question and also when it visits certain other websites.</p>
                    <h5 class="mb-4 pt-1"><b>Why do we use cookies?</b></h5>
                    <p class="mb-5" id="personal">We use first- and third-party cookies for several reasons. Some cookies are required for technical reasons in order for our Website to operate, and we refer to these as "essential" or "strictly necessary" cookies. Other cookies also enable us to track and target the interests of our users to enhance the experience on our Online Properties. Third parties serve cookies through our Website for advertising, analytics, and other purposes. This is described in more detail below.
                    <h5 class="mb-4 pt-1"><b>How can I control cookies?</b></h5>
                    <p class="mb-3">
                      You have the right to decide whether to accept or reject cookies. You can exercise your cookie rights by setting your preferences in the Cookie Consent Manager. The Cookie Consent Manager allows you to select which categories of cookies you accept or reject. Essential cookies cannot be rejected as they are strictly necessary to provide you with services.
                    </p>
                    <p class="mb-3">
                      The Cookie Consent Manager can be found in the notification banner and on our website. If you choose to reject cookies, you may still use our website though your access to some functionality and areas of our website may be restricted. You may also set or amend your web browser controls to accept or refuse cookies.
                    </p>
                    <p class="mb-5" id="personal">The specific types of first- and third-party cookies served through our Website and the purposes they perform are described in the table below (please note that the specific cookies served may vary depending on the specific Online Properties you visit):
                    </p>
                    <h5 class="mb-4 pt-1"><b>How can I control cookies on my browser?</b></h5>
                    <p class="mb-3">
                      As the means by which you can refuse cookies through your web browser controls vary from browser to browser, you should visit your browser's help menu for more information. The following is information about how to manage cookies on the most popular browsers:
                    </p>
                    <ul class="mb-4">
                      <li>
                        <a href="https://support.google.com/chrome/answer/95647#zippy=%2Callow-or-block-cookies " class="text-decoration-underline text-primary" target="_blank">Chrome</a>
                      </li>
                      <li>
                        <a href="https://support.microsoft.com/en-us/windows/delete-and-manage-cookies-168dab11-0753-043d-7c16-ede5947fc64d" class="text-decoration-underline text-primary" target="_blank">Internet Explorer</a>
                      </li>
                      <li>
                        <a href="https://support.mozilla.org/en-US/kb/enhanced-tracking-protection-firefox-desktop?redirectslug=enable-and-disable-cookies-website-preferences&redirectlocale=en-US" class="text-decoration-underline text-primary" target="_blank">Firefox</a>
                      </li>
                      <li>
                        <a href="https://support.apple.com/en-ie/guide/safari/sfri11471/mac" class="text-decoration-underline text-primary" target="_blank">Safari</a>
                      </li>
                      <li>
                        <a href="https://support.microsoft.com/en-us/windows/microsoft-edge-browsing-data-and-privacy-bb8174ba-9d73-dcf2-9b4a-c582b4e640dd" class="text-decoration-underline text-primary" target="_blank">Edge</a>
                      </li>
                      <li>
                        <a href="https://help.opera.com/en/latest/web-preferences/" class="text-decoration-underline text-primary" target="_blank">Opera</a>
                      </li>
                    </ul>
                    <p class="mb-3">
                      In addition, most advertising networks offer you a way to opt out of targeted advertising. If you would like to find out more information, please visit:
                    </p>
                    <ul class="mb-5">
                      <li>
                        <a href="http://www.aboutads.info/choices/" class="text-decoration-underline text-primary" target="_blank">Digital Advertising Alliance</a>
                      </li>
                      <li>
                        <a href="https://youradchoices.ca/" class="text-decoration-underline text-primary" target="_blank">Digital Advertising Alliance of Canada</a>
                      </li>
                      <li>
                        <a href="http://www.youronlinechoices.com/" class="text-decoration-underline text-primary" target="_blank">European Interactive Digital Advertising Alliance</a>
                      </li>
                    </ul>
                    <h5 class="mb-4 pt-1"><b>What about other tracking technologies, like web beacons?</b></h5>
                    <p class="mb-5">
                      Cookies are not the only way to recognize or track visitors to a website. We may use other, similar technologies from time to time, like web beacons (sometimes called "tracking pixels" or "clear gifs"). These are tiny graphics files that contain a unique identifier that enables us to recognize when someone has visited our Website or opened an email including them. This allows us, for example, to monitor the traffic patterns of users from one page within a website to another, to deliver or communicate with cookies, to understand whether you have come to the website from an online advertisement displayed on a third-party website, to improve site performance, and to measure the success of email marketing campaigns. In many instances, these technologies are reliant on cookies to function properly, and so declining cookies will impair their functioning.
                    </p>
                    <h5 class="mb-4 pt-1"><b>Do you use Flash cookies or Local Shared Objects?</b></h5>
                    <p class="mb-3">
                      Websites may also use so-called "Flash Cookies" (also known as Local Shared Objects or "LSOs") to, among other things, collect and store information about your use of our services, fraud prevention, and for other site operations.
                    </p>
                    <p class="mb-3">
                      If you do not want Flash Cookies stored on your computer, you can adjust the settings of your Flash player to block Flash Cookies storage using the tools contained in the <a href="http://www.macromedia.com/support/documentation/en/flashplayer/help/settings_manager07.html" class="text-decoration-underline text-primary" target="_blank">Website Storage Settings Panel.</a> You can also control Flash Cookies by going to the <a href="http://www.macromedia.com/support/documentation/en/flashplayer/help/settings_manager03.html" class="text-decoration-underline text-primary" target="_blank">Global Storage Settings Panel</a> and following the instructions (which may include instructions that explain, for example, how to delete existing Flash Cookies (referred to "information" on the Macromedia site), how to prevent Flash LSOs from being placed on your computer without your being asked, and (for Flash Player 8 and later) how to block Flash Cookies that are not being delivered by the operator of the page you are on at the time).
                    </p>
                    <p class="mb-5">
                      Please note that setting the Flash Player to restrict or limit acceptance of Flash Cookies may reduce or impede the functionality of some Flash applications, including, potentially, Flash applications used in connection with our services or online content.
                    </p>
                    <h5 class="mb-4 pt-1"><b>Do you serve targeted advertising?</b></h5>
                    <p class="mb-5">
                      Third parties may serve cookies on your computer or mobile device to serve advertising through our Website. These companies may use information about your visits to this and other websites in order to provide relevant advertisements about goods and services that you may be interested in. They may also employ technology that is used to measure the effectiveness of advertisements. They can accomplish this by using cookies or web beacons to collect information about your visits to this and other sites in order to provide relevant advertisements about goods and services of potential interest to you. The information collected through this process does not enable us or them to identify your name, contact details, or other details that directly identify you unless you choose to provide these.
                    </p>
                    <h5 class="mb-4 pt-1"><b>How often will you update this Cookie Policy?</b></h5>
                    <p class="mb-3">
                      We may update this Cookie Policy from time to time in order to reflect, for example, changes to the cookies we use or for other operational, legal, or regulatory reasons. Please therefore revisit this Cookie Policy regularly to stay informed about our use of cookies and related technologies.
                    </p>
                    <p class="mb-5">
                      The date at the top of this Cookie Policy indicates when it was last updated.
                    </p>
                    <h5 class="mb-4 pt-1"><b>Where can I get further information?</b></h5>
                    <p class="mb-3">
                      If you have any questions about our use of cookies or other technologies, please email us at admin@luminarymindset.com.au or by post to:
                    </p>
                    <p class="mb-0">
                      Luminary Mindset PTY LTD<br>
                      Level 8, 171 Clarence Street<br>
                      Sydney , New South Wales 2000<br>
                      Australia<br>
                      Phone: 07584418696<br>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

@endsection