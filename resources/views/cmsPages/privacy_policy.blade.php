@extends('layouts.cmsPage.master')
@section('content')

<main class="main-content" id="main">
<section class="lm_term">
    <div class="container-fluid my-4">
    <div class="d-flex">
        <div class="lm_term-back">
        {{-- <h5> <a class="text-dark" href="javascript:history.back()">Back</a></h5> --}}
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
                <h2 class="mb-0">Privacy Policy</h2>
                <p class="mb-5"><b>Last updated June 30, 2023</b></p>
                </div>
                <div class="lm_term-body text-dark">
                <p class="mb-3">This privacy notice for Luminary Mindset PTY LTD (doing business as PEEQ™)
                    (<b>'we'</b>, <b>'us'</b>, or <b>'our'</b>), describes how and why we might collect, store, use,
                    and/or share ('<b>process</b>') your information when you use our services ('<b>Services</b>'),
                    such as when you:</p>
                <ul>
                    <li>
                    Visit our website at <a href="http://www.peeq.com.au">http://www.peeq.com.au</a>, or any website
                    of ours that links to this privacy notice
                    </li>
                    <li>
                    Download and use our mobile application (PEEQ™), or any other application of ours that links to
                    this privacy notice
                    </li>
                    <li>
                    Engage with us in other related ways, including any sales, marketing, or events
                    </li>
                </ul>
                <p class="mb-5">
                    <b>Questions or concerns?</b> Reading this privacy notice will help you understand your privacy
                    rights and choices. If you do not agree with our policies and practices, please do not use our
                    Services. If you still have any questions or concerns, please contact us at <a
                    href="mailto:support@peeq.com.au" class="text-primary">support@peeq.com.au</a>.
                </p>
                <h4 class="mb-3 fw-bold">SUMMARY OF KEY POINTS</h4>
                <p class="mb-4 small fw-bold text-secondary">This summary provides key points from our privacy
                    notice, but you can find out more details about any of these topics by clicking the link following
                    each key point or by using our <a href="#table" class="text-decoration-underline">table of contents</a>
                    below to find the section you are looking for.</p>
                <p class="text-secondary mb-3">
                    <b class="text-black">What personal information do we process?</b> When you visit, use, or
                    navigate our Services, we may process personal information depending on how you interact with us
                    and the Services, the choices you make, and the products and features you use. Learn more about <a
                    href="#personal" class="text-decoration-underline text-primary">personal information you disclose to
                    us</a>.
                </p>
                <p class="text-secondary mb-3">
                    <b class="text-black">Do we process any sensitive personal information?</b> We do not process
                    sensitive personal information. .
                </p>
                <p class="text-secondary mb-3">
                    <b class="text-black">Do we receive any information from third parties?</b> We may receive
                    information from public databases, marketing partners, social media platforms, and other outside
                    sources. Learn more about <a href="#info" class="text-decoration-underline text-primary">information collected from other sources</a>.
                </p>
                <p class="text-secondary mb-3">
                    <b class="text-black">How do we process your information?</b> We process your information to
                    provide, improve, and administer our Services, communicate with you, for security and fraud
                    prevention, and to comply with law. We may also process your information for other purposes with
                    your consent. We process your information only when we have a valid legal reason to do so. Learn
                    more about <a href="#2" class="text-decoration-underline text-primary">how we process your information</a>.
                </p>
                <p class="text-secondary mb-3">
                    <b class="text-black">In what situations and with which parties do we share personal
                    information?</b> We may share information in specific situations and with specific third
                    parties. Learn more about <a href="#4" class="text-decoration-underline text-primary">when and with
                    whom we share your personal information</a>.
                </p>
                <p class="text-secondary mb-3">
                    <b class="text-black">How do we keep your information safe?</b> We have organisational and
                    technical processes and procedures in place to protect your personal information. However, no
                    electronic transmission over the internet or information storage technology can be guaranteed to
                    be 100% secure, so we cannot promise or guarantee that hackers, cybercriminals, or other
                    unauthorised third parties will not be able to defeat our security and improperly collect, access,
                    steal, or modify your information. Learn more about <a href="#9"
                    class="text-decoration-underline text-primary">how we keep your information safe</a>.
                </p>
                <p class="text-secondary mb-3">
                    <b class="text-black">What are your rights?</b> Depending on where you are located geographically,
                    the applicable privacy law may mean you have certain rights regarding your personal information.
                    Learn more about <a href="#11" class="text-decoration-underline text-primary">your privacy
                    rights</a>.
                </p>
                <p class="text-secondary mb-3">
                    <b class="text-black">How do you exercise your rights?</b> The easiest way to exercise your rights
                    is by submitting a <a href="https://app.termly.io/notify/e0a002a9-f72d-44ff-94e3-b5ca4dd92644" class="text-decoration-underline text-primary" target="_blank">data subject access
                    request</a>, or by contacting us. We will consider and act upon any request in accordance with
                    applicable data protection laws.
                </p>
                <p class="text-secondary mb-5">
                    Want to learn more about what we do with any information we collect? <a href="#11"
                    class="text-decoration-underline text-primary">Review the privacy notice in full</a>.
                </p>
                <h4 class="mb-3 fw-bold" id="table">TABLE OF CONTENTS</h4>
                <a href="#1" class="d-block color-primary text-decoration-underline mb-1">1. WHAT INFORMATION DO WE
                    COLLECT?</a>
                <a href="#2" class="d-block color-primary text-decoration-underline mb-1">2. HOW DO WE PROCESS YOUR
                    INFORMATION?</a>
                <a href="#3" class="d-block color-primary text-decoration-underline mb-1">3. WHAT LEGAL BASES DO WE
                    RELY ON TO PROCESS YOUR PERSONAL INFORMATION?</a>
                <a href="#4" class="d-block color-primary text-decoration-underline mb-1">4. WHEN AND WITH WHOM DO WE
                    SHARE YOUR PERSONAL INFORMATION?</a>
                <a href="#5" class="d-block color-primary text-decoration-underline mb-1">5. WHAT IS OUR STANCE ON
                    THIRD-PARTY WEBSITES?</a>
                <a href="#6" class="d-block color-primary text-decoration-underline mb-1">6. DO WE USE COOKIES AND
                    OTHER TRACKING TECHNOLOGIES?</a>
                <a href="#7" class="d-block color-primary text-decoration-underline mb-1">7. HOW DO WE HANDLE YOUR
                    SOCIAL LOGINS? </a>
                <a href="#8" class="d-block color-primary text-decoration-underline mb-1">8. HOW LONG DO WE KEEP YOUR
                    INFORMATION?</a>
                <a href="#9" class="d-block color-primary text-decoration-underline mb-1">9. HOW DO WE KEEP YOUR
                    INFORMATION SAFE?</a>
                <a href="#10" class="d-block color-primary text-decoration-underline mb-1">10. DO WE COLLECT
                    INFORMATION FROM MINORS?</a>
                <a href="#11" class="d-block color-primary text-decoration-underline mb-1">11. WHAT ARE YOUR PRIVACY
                    RIGHTS?</a>
                <a href="#12" class="d-block color-primary text-decoration-underline mb-1">12. CONTROLS FOR
                    DO-NOT-TRACK FEATURES</a>
                <a href="#13" class="d-block color-primary text-decoration-underline mb-1">13. DO CALIFORNIA RESIDENTS
                    HAVE SPECIFIC PRIVACY RIGHTS?</a>
                <a href="#14" class="d-block color-primary text-decoration-underline mb-1">14. DO VIRGINIA RESIDENTS
                    HAVE SPECIFIC PRIVACY RIGHTS?</a>
                <a href="#15" class="d-block color-primary text-decoration-underline mb-1">15. DO WE MAKE UPDATES TO
                    THIS NOTICE?</a>
                <a href="#16" class="d-block color-primary text-decoration-underline mb-1">16. HOW CAN YOU CONTACT US
                    ABOUT THIS NOTICE?</a>
                <a href="#17" class="d-block color-primary text-decoration-underline mb-5">17. HOW CAN YOU REVIEW,
                    UPDATE, OR DELETE THE DATA WE COLLECT FROM YOU?</a>
                <h5 class="mb-4 pt-1" id="1"><b>1. WHAT INFORMATION DO WE COLLECT?</b></h5>
                <p class="mb-4" id="personal"><b>Personal information you disclose to us</b></p>
                <p class="text-secondary mb-3"><b class="text-black">In Short: </b>We collect personal information
                    that you provide to us.</p>
                <p class="mb-3">We collect personal information that you voluntarily provide to us when you register
                    on the Services, express an interest in obtaining information about us or our products and
                    Services, when you participate in activities on the Services, or otherwise when you contact us.
                </p>
                <p class="mb-3"><b class="text-black">Personal Information Provided by You.</b> The personal
                    information that we collect depends on the context of your interactions with us and the Services,
                    the choices you make, and the products and features you use. The personal information we collect
                    may include the following:</p>
                <ul class="mb-2">
                    <li>names</li>
                    <li>phone numbers</li>
                    <li>email addresses</li>
                    <li>job titles</li>
                    <li>usernames</li>
                    <li>passwords</li>
                    <li>billing addresses</li>
                    <li>debit/credit card numbers</li>
                    <li>contact preferences</li>
                    <li>contact or authentication data</li>
                </ul>
                <p class="mb-3"><b>Sensitive Information.</b> We do not process sensitive information.</p>
                <p class="mb-3"><b>Payment Data.</b> We may collect data necessary to process your payment
                    if you make purchases, such as your payment instrument number, and the security code associated
                    with your payment instrument. All payment data is stored by Stripe . You may find their privacy
                    notice link(s) here: <a href="https://stripe.com/gb/legal/privacy-center"
                    class="text-decoration-underline text-primary" target="_blank">https://stripe.com/gb/legal/privacy-center.</a>
                </p>
                <p class="mb-3"><b>Social Media Login Data.</b> We may provide you with the option to
                    register with us using your existing social media account details, like your Facebook, Twitter, or
                    other social media account. If you choose to register in this way, we will collect the information
                    described in the section called <a href="#7" class="text-decoration-underline text-primary">'HOW DO WE HANDLE YOUR SOCIAL LOGINS?'</a> below
                </p>
                <p><b>Application Data.</b> If you use our application(s), we also may
                    collect the following information if you choose to provide us with access or permission:</p>
                <ul>
                    <li>
                    <b class="fst-italic">
                        Geolocation Information.</b> We may request access or permission to track location-based
                    information from your mobile device, either continuously or while you are using our mobile
                    application(s), to provide certain location-based services. If you wish to change our access or
                    permissions, you may do so in your device's settings.
                    </li>
                    <li>
                    <b class="fst-italic">
                        Mobile Device Access.</b> We may request access or permission to certain features from your
                    mobile device, including your mobile device's calendar, social media accounts, and other
                    features. If you wish to change our access or permissions, you may do so in your device's
                    settings.
                    </li>
                    <li>
                    <b class="fst-italic">
                        Mobile Device Data.</b> We automatically collect device information (such as your mobile
                    device ID, model, and manufacturer), operating system, version information and system
                    configuration information, device and application identification numbers, browser type and
                    version, hardware model Internet service provider and/or mobile carrier, and Internet Protocol
                    (IP) address (or proxy server). If you are using our application(s), we may also collect
                    information about the phone network associated with your mobile device, your mobile device’s
                    operating system or platform, the type of mobile device you use, your mobile device’s unique
                    device ID, and information about the features of our application(s) you accessed.
                    </li>
                    <li class="mb-2">
                    <b class="fst-italic">
                        Push Notifications.</b> We may request to send you push notifications regarding your account
                    or certain features of the application(s). If you wish to opt out from receiving these types of
                    communications, you may turn them off in your device's settings.
                    </li>
                </ul>
                <p class="mb-2">
                    This information is primarily needed to maintain the security and operation of our application(s), for troubleshooting, and for our internal analytics and reporting purposes.
                </p>
                <p class="mb-5">
                    All personal information that you provide to us must be true, complete, and accurate, and you must notify us of any changes to such personal information.
                </p>
                <h6 class="fw-bold fs-5 mb-3">Information automatically collected</h6>
                <p class="fst-italic mb-3">
                    <b class="text-secondary">
                    In Short:</b> Some information — such as your Internet Protocol (IP) address and/or browser and device characteristics — is collected automatically when you visit our Services.
                </p>
                <p class="mb-3">
                    We automatically collect certain information when you visit, use, or navigate the Services. This information does not reveal your specific identity (like your name or contact information) but may include device and usage information, such as your IP address, browser and device characteristics, operating system, language preferences, referring URLs, device name, country, location, information about how and when you use our Services, and other technical information. This information is primarily needed to maintain the security and operation of our Services, and for our internal analytics and reporting purposes.
                </p>
                <p class="mb-5">
                    Like many businesses, we also collect information through cookies and similar technologies. You can find out more about this in our Cookie Notice: <a target="_blank" href="https://app.termly.io/document/cookie-policy/13431987-f893-4940-bb46-b3159b7f8375" class="text-primary text-decoration-underline">https://app.termly.io/document/cookie-policy/13431987-f893-4940-bb46-b3159b7f8375</a>.
                </p>
                <p class="mb-2">
                    The information we collect includes:
                </p>
                <ul class="mb-4">
                    <li>
                    <i>Log and Usage Data.</i> Log and usage data is service-related, diagnostic, usage, and performance information our servers automatically collect when you access or use our Services and which we record in log files. Depending on how you interact with us, this log data may include your IP address, device information, browser type, and settings and information about your activity in the Services (such as the date/time stamps associated with your usage, pages and files viewed, searches, and other actions you take such as which features you use), device event information (such as system activity, error reports (sometimes called 'crash dumps'), and hardware settings).
                    </li>
                    <li>
                    <i>Device Data.</i> We collect device data such as information about your computer, phone, tablet, or other device you use to access the Services. Depending on the device used, this device data may include information such as your IP address (or proxy server), device and application identification numbers, location, browser type, hardware model, Internet service provider and/or mobile carrier, operating system, and system configuration information.
                    </li>
                    <li>
                    <i>Location Data.</i> We collect location data such as information about your device's location, which can be either precise or imprecise. How much information we collect depends on the type and settings of the device you use to access the Services. For example, we may use GPS and other technologies to collect geolocation data that tells us your current location (based on your IP address). You can opt out of allowing us to collect this information either by refusing access to the information or by disabling your Location setting on your device. However, if you choose to opt out, you may not be able to use certain aspects of the Services.
                    </li>
                </ul>
                <h6 class="fw-bold fs-5 mb-3" id="info">Information collected from other sources</h6>
                <p class="fst-italic mb-3">
                    <b class="text-secondary">
                    In Short:</b> We may collect limited data from public databases, marketing partners, social media platforms, and other outside sources.
                </p>
                <p class="mb-5">
                    In order to enhance our ability to provide relevant marketing, offers, and services to you and update our records, we may obtain information about you from other sources, such as public databases, joint marketing partners, affiliate programs, data providers, social media platforms, and from other third parties. This information includes mailing addresses, job titles, email addresses, phone numbers, intent data (or user behaviour data), Internet Protocol (IP) addresses, social media profiles, social media URLs, and custom profiles, for purposes of targeted advertising and event promotion. If you interact with us on a social media platform using your social media account (e.g. Facebook or Twitter), we receive personal information about you such as your name, email address, and gender. Any personal information that we collect from your social media account depends on your social media account's privacy settings.
                </p>
                <h5 class="mb-4 pt-1" id="2"><b>2. HOW DO WE PROCESS YOUR INFORMATION?</b></h5>
                <p class="fst-italic mb-3">
                    <b class="text-secondary">
                    In Short:</b> We process your information to provide, improve, and administer our Services, communicate with you, for security and fraud prevention, and to comply with law. We may also process your information for other purposes with your consent.
                </p>
                <p class="mb-3">
                    <b>
                    We process your personal information for a variety of reasons, depending on how you interact with our Services, including:
                    </b>
                </p>
                <ul class="mb-5">
                    <li>
                    <b>To facilitate account creation and authentication and otherwise manage user accounts.</b> We may process your information so you can create and log in to your account, as well as keep your account in working order.
                    </li>
                    <li>
                    <b>To deliver and facilitate delivery of services to the user.</b> We may process your information to provide you with the requested service.
                    </li>
                    <li>
                    <b>To respond to user inquiries/offer support to users.</b> We may process your information to respond to your inquiries and solve any potential issues you might have with the requested service.
                    </li>
                    <li>
                    <b>To send administrative information to you.</b> We may process your information to send you details about our products and services, changes to our terms and policies, and other similar information.
                    </li>
                    <li>
                    <b>To fulfil and manage your orders.</b> We may process your information to fulfil and manage your orders, payments, returns, and exchanges made through the Services.
                    </li>
                    <li>
                    <b>To enable user-to-user communications.</b> We may process your information if you choose to use any of our offerings that allow for communication with another user.
                    </li>
                    <li>
                    <b>To save or protect an individual's vital interest.</b> We may process your information when necessary to save or protect an individual’s vital interest, such as to prevent harm.
                    </li>
                </ul>
                <h5 class="mb-4 pt-1" id="3"><b>3. WHAT LEGAL BASES DO WE RELY ON TO PROCESS YOUR INFORMATION?</b></h5>
                <p class="fst-italic mb-4">
                    <b class="text-secondary">
                    In Short:</b> We only process your personal information when we believe it is necessary and we have a valid legal reason (i.e. legal basis) to do so under applicable law, like with your consent, to comply with laws, to provide you with services to enter into or fulfil our contractual obligations, to protect your rights, or to fulfil our legitimate business interests.
                </p>
                <p class="text-decoration-underline fst-italic text-secondary mb-4">
                    If you are located in the EU or UK, this section applies to you.
                </p>
                <p class="mb-2">
                    The General Data Protection Regulation (GDPR) and UK GDPR require us to explain the valid legal bases we rely on in order to process your personal information. As such, we may rely on the following legal bases to process your personal information:
                </p>
                <ul class="mb-5">
                    <li>
                    <b>Consent.</b> We may process your information if you have given us permission (i.e. consent) to use your personal information for a specific purpose. You can withdraw your consent at any time. Learn more about <a href="#withdrawconsent" class="text-primary text-decoration-underline">withdrawing your consent.</a>
                    </li>
                    <li>
                    <b>Performance of a Contract.</b> We may process your personal information when we believe it is necessary to fulfil our contractual obligations to you, including providing our Services or at your request prior to entering into a contract with you.
                    </li>
                    <li>
                    <b>Legal Obligations.</b> We may process your information where we believe it is necessary for compliance with our legal obligations, such as to cooperate with a law enforcement body or regulatory agency, exercise or defend our legal rights, or disclose your information as evidence in litigation in which we are involved.
                    </li>
                    <li>
                    <b>Vital Interests.</b> We may process your information where we believe it is necessary to protect your vital interests or the vital interests of a third party, such as situations involving potential threats to the safety of any person. 
                    </li>
                </ul>
                <h5 class="mb-4 pt-1" id="4"><b>4. WHEN AND WITH WHOM DO WE SHARE YOUR PERSONAL INFORMATION? </b></h5>
                <p class="fst-italic mb-4">
                    <b class="text-secondary">
                    In Short:</b> We may share information in specific situations described in this section and/or with the following third parties.
                </p>
                <p class="mb-2">
                    We may need to share your personal information in the following situations:
                </p>
                <ul class="mb-5">
                    <li>
                    <b>Business Transfers.</b> We may share or transfer your information in connection with, or during negotiations of, any merger, sale of company assets, financing, or acquisition of all or a portion of our business to another company.
                    </li>
                    <li>
                    <b>Affiliates.</b> WWe may share your information with our affiliates, in which case we will require those affiliates to honour this privacy notice. Affiliates include our parent company and any subsidiaries, joint venture partners, or other companies that we control or that are under common control with us.
                    </li>
                    <li>
                    <b>Other Users.</b> When you share personal information (for example, by posting comments, contributions, or other content to the Services) or otherwise interact with public areas of the Services, such personal information may be viewed by all users and may be publicly made available outside the Services in perpetuity. If you interact with other users of our Services and register for our Services through a social network (such as Facebook), your contacts on the social network will see your name, profile photo, and descriptions of your activity. Similarly, other users will be able to view descriptions of your activity, communicate with you within our Services, and view your profile.
                    </li>
                </ul>
                <h5 class="mb-4 pt-1" id="5"><b>5. WHAT IS OUR STANCE ON THIRD-PARTY WEBSITES?</b></h5>
                <p class="fst-italic mb-4">
                    <b class="text-secondary">
                    In Short:</b> We are not responsible for the safety of any information that you share with third parties that we may link to or who advertise on our Services, but are not affiliated with, our Services.
                </p>
                <p class="mb-5">
                    The Services may link to third-party websites, online services, or mobile applications and/or contain advertisements from third parties that are not affiliated with us and which may link to other websites, services, or applications. Accordingly, we do not make any guarantee regarding any such third parties, and we will not be liable for any loss or damage caused by the use of such third-party websites, services, or applications. The inclusion of a link towards a third-party website, service, or application does not imply an endorsement by us. We cannot guarantee the safety and privacy of data you provide to any third parties. Any data collected by third parties is not covered by this privacy notice. We are not responsible for the content or privacy and security practices and policies of any third parties, including other websites, services, or applications that may be linked to or from the Services. You should review the policies of such third parties and contact them directly to respond to your questions.
                </p>
                <h5 class="mb-4 pt-1" id="6"><b>6. DO WE USE COOKIES AND OTHER TRACKING TECHNOLOGIES?</b></h5>
                <p class="fst-italic mb-4">
                    <b class="text-secondary">
                    In Short:</b> We may use cookies and other tracking technologies to collect and store your information.
                </p>
                <p class="mb-5">
                    We may use cookies and similar tracking technologies (like web beacons and pixels) to access or store information. Specific information about how we use such technologies and how you can refuse certain cookies is set out in our Cookie Notice: <a href="https://app.termly.io/document/cookie-policy/13431987-f893-4940-bb46-b3159b7f8375" class="text-decoration-underline text-primary" target="_blank">https://app.termly.io/document/cookie-policy/13431987-f893-4940-bb46-b3159b7f8375.</a>
                </p>
                <h5 class="mb-4 pt-1" id="7"><b>7. HOW DO WE HANDLE YOUR SOCIAL LOGINS? </b></h5>
                <p class="fst-italic mb-4">
                    <b class="text-secondary">
                    In Short:</b> If you choose to register or log in to our Services using a social media account, we may have access to certain information about you.
                </p>
                <p class="mb-3">
                    Our Services offer you the ability to register and log in using your third-party social media account details (like your Facebook or Twitter logins). Where you choose to do this, we will receive certain profile information about you from your social media provider. The profile information we receive may vary depending on the social media provider concerned, but will often include your name, email address, friends list, and profile picture, as well as other information you choose to make public on such a social media platform.
                </p>
                <p class="mb-5">
                    We will use the information we receive only for the purposes that are described in this privacy notice or that are otherwise made clear to you on the relevant Services. Please note that we do not control, and are not responsible for, other uses of your personal information by your third-party social media provider. We recommend that you review their privacy notice to understand how they collect, use, and share your personal information, and how you can set your privacy preferences on their sites and apps.
                </p>
                <h5 class="mb-4 pt-1" id="8"><b>8. HOW LONG DO WE KEEP YOUR INFORMATION?</b></h5>
                <p class="fst-italic mb-4">
                    <b class="text-secondary">
                    In Short:</b> We keep your information for as long as necessary to fulfil the purposes outlined in this privacy notice unless otherwise required by law.
                </p>
                <p class="mb-3">
                    We will only keep your personal information for as long as it is necessary for the purposes set out in this privacy notice, unless a longer retention period is required or permitted by law (such as tax, accounting, or other legal requirements). No purpose in this notice will require us keeping your personal information for longer than the period of time in which users have an account with us.
                </p>
                <p class="mb-5">
                    When we have no ongoing legitimate business need to process your personal information, we will either delete or anonymise such information, or, if this is not possible (for example, because your personal information has been stored in backup archives), then we will securely store your personal information and isolate it from any further processing until deletion is possible.
                </p>
                <h5 class="mb-4 pt-1" id="9"><b>9. HOW DO WE KEEP YOUR INFORMATION SAFE?</b></h5>
                <p class="fst-italic mb-4">
                    <b class="text-secondary">
                    In Short:</b> We aim to protect your personal information through a system of organisational and technical security measures.
                </p>
                <p class="mb-5">
                    We have implemented appropriate and reasonable technical and organisational security measures designed to protect the security of any personal information we process. However, despite our safeguards and efforts to secure your information, no electronic transmission over the Internet or information storage technology can be guaranteed to be 100% secure, so we cannot promise or guarantee that hackers, cybercriminals, or other unauthorised third parties will not be able to defeat our security and improperly collect, access, steal, or modify your information. Although we will do our best to protect your personal information, transmission of personal information to and from our Services is at your own risk. You should only access the Services within a secure environment.
                </p>
                <h5 class="mb-4 pt-1" id="10"><b>10. DO WE COLLECT INFORMATION FROM MINORS?</b></h5>
                <p class="fst-italic mb-4">
                    <b class="text-secondary">
                    In Short:</b> We do not knowingly collect data from or market to children under 18 years of age.
                </p>
                <p class="mb-5">
                    We do not knowingly solicit data from or market to children under 18 years of age. By using the Services, you represent that you are at least 18 or that you are the parent or guardian of such a minor and consent to such minor dependent’s use of the Services. If we learn that personal information from users less than 18 years of age has been collected, we will deactivate the account and take reasonable measures to promptly delete such data from our records. If you become aware of any data we may have collected from children under age 18, please contact us at support@peeq.com.au.
                </p>
                <h5 class="mb-4 pt-1" id="11"><b>11. WHAT ARE YOUR PRIVACY RIGHTS?</b></h5>
                <p class="fst-italic mb-4">
                    <b class="text-secondary">
                    In Short:</b> In some regions, such as , you have rights that allow you greater access to and control over your personal information. You may review, change, or terminate your account at any time.
                </p>
                <p class="mb-3">
                    In some regions (like ), you have certain rights under applicable data protection laws. These may include the right (i) to request access and obtain a copy of your personal information, (ii) to request rectification or erasure; (iii) to restrict the processing of your personal information; and (iv) if applicable, to data portability. In certain circumstances, you may also have the right to object to the processing of your personal information. You can make such a request by contacting us by using the contact details provided in the section <a href="#16" class="text-decoration-underline text-primary">'HOW CAN YOU CONTACT US ABOUT THIS NOTICE?'</a> below.
                </p>
                <p class="mb-3">
                    We will consider and act upon any request in accordance with applicable data protection laws.
                </p>
                <p class="mb-3">
                    If you are located in the EEA or UK and you believe we are unlawfully processing your personal information, you also have the right to complain to your <a href="https://ec.europa.eu/justice/data-protection/bodies/authorities/index_en.htm" class="text-decoration-underline text-primary" target="_blank">Member State data protection authority</a> or <a href="https://ico.org.uk/make-a-complaint/data-protection-complaints/data-protection-complaints/" class="text-decoration-underline text-primary" target="_blank">UK data protection authority.</a>
                </p>
                <p class="mb-3">
                    If you are located in Switzerland, you may contact the <a href="https://www.edoeb.admin.ch/edoeb/en/home.html" class="text-decoration-underline text-primary" target="_blank">Federal Data Protection and Information Commissioner.</a>
                </p>
                <p class="mb-3" id="withdrawconsent">
                    <b class="text-decoration-underline">Withdrawing your consent:</b> If we are relying on your consent to process your personal information, which may be express and/or implied consent depending on the applicable law, you have the right to withdraw your consent at any time. You can withdraw your consent at any time by contacting us by using the contact details provided in the section <a href="#16" class="text-decoration-underline text-primary">'HOW CAN YOU CONTACT US ABOUT THIS NOTICE?'</a> below or updating your preferences.
                </p>
                <p class="mb-3">
                    However, please note that this will not affect the lawfulness of the processing before its withdrawal nor, when applicable law allows, will it affect the processing of your personal information conducted in reliance on lawful processing grounds other than consent.
                </p>
                <p class="mb-3">
                    <b class="text-decoration-underline">Opting out of marketing and promotional communications:</b> You can unsubscribe from our marketing and promotional communications at any time by clicking on the unsubscribe link in the emails that we send, or by contacting us using the details provided in the section <a href="#16" class="text-decoration-underline text-primary">'HOW CAN YOU CONTACT US ABOUT THIS NOTICE?'</a> below. You will then be removed from the marketing lists. However, we may still communicate with you — for example, to send you service-related messages that are necessary for the administration and use of your account, to respond to service requests, or for other non-marketing purposes.
                </p>
                <h6 class="fs-4">
                    <b>
                    Account Information
                    </b>
                </h6>
                <p class="mb-3">
                    If you would at any time like to review or change the information in your account or terminate your account, you can:
                </p>
                <ul>
                    <li> 
                    Log in to your account settings and update your user account.
                    </li>
                    <li>
                    Contact us using the contact information provided.
                    </li>
                </ul>
                <p>
                    Upon your request to terminate your account, we will deactivate or delete your account and information from our active databases. However, we may retain some information in our files to prevent fraud, troubleshoot problems, assist with any investigations, enforce our legal terms and/or comply with applicable legal requirements.
                </p>
                <p class="mb-3">
                    <b class="text-decoration-underline">Cookies and similar technologies:</b> Most Web browsers are set to accept cookies by default. If you prefer, you can usually choose to set your browser to remove cookies and to reject cookies. If you choose to remove cookies or reject cookies, this could affect certain features or services of our Services. You may also <a href="http://www.aboutads.info/choices/" class="text-decoration-underline text-primary" target="_blank">opt out of interest-based advertising by advertisers</a> on our Services. For further information, please see our Cookie Notice: <a href="https://app.termly.io/document/cookie-policy/13431987-f893-4940-bb46-b3159b7f8375" class="text-decoration-underline text-primary" target="_blank">https://app.termly.io/document/cookie-policy/13431987-f893-4940-bb46-b3159b7f8375.</a>
                </p>
                <p class="mb-5">
                    If you have questions or comments about your privacy rights, you may email us at support@peeq.com.au.
                </p>
                <h5 class="mb-4 pt-1" id="12"><b>12. CONTROLS FOR DO-NOT-TRACK FEATURES</b></h5>
                <p class="mb-4">
                    Most web browsers and some mobile operating systems and mobile applications include a Do-Not-Track ('DNT') feature or setting you can activate to signal your privacy preference not to have data about your online browsing activities monitored and collected. At this stage no uniform technology standard for recognising and implementing DNT signals has been finalised. As such, we do not currently respond to DNT browser signals or any other mechanism that automatically communicates your choice not to be tracked online. If a standard for online tracking is adopted that we must follow in the future, we will inform you about that practice in a revised version of this privacy notice.
                </p>
                <h5 class="mb-4 pt-1" id="13"><b>13. DO CALIFORNIA RESIDENTS HAVE SPECIFIC PRIVACY RIGHTS?</b></h5>
                <p class="fst-italic mb-4">
                    <b class="text-secondary">
                    In Short:</b> Yes, if you are a resident of California, you are granted specific rights regarding access to your personal information.
                </p>
                <p>
                    California Civil Code Section 1798.83, also known as the 'Shine The Light' law, permits our users who are California residents to request and obtain from us, once a year and free of charge, information about categories of personal information (if any) we disclosed to third parties for direct marketing purposes and the names and addresses of all third parties with which we shared personal information in the immediately preceding calendar year. If you are a California resident and would like to make such a request, please submit your request in writing to us using the contact information provided below.
                </p>
                <p>
                    If you are under 18 years of age, reside in California, and have a registered account with Services, you have the right to request removal of unwanted data that you publicly post on the Services. To request removal of such data, please contact us using the contact information provided below and include the email address associated with your account and a statement that you reside in California. We will make sure the data is not publicly displayed on the Services, but please be aware that the data may not be completely or comprehensively removed from all our systems (e.g. backups, etc.).
                </p>
                <h6 class="fs-4">
                    <b>
                    CCPA Privacy Notice
                    </b>
                </h6>
                <p class="mb-3">
                    The California Code of Regulations defines a 'resident' as:
                </p>
                <ol>
                    <li class="mb-2">(1) every individual who is in the State of California for other than a temporary or transitory purpose and</li>
                    <li class="mb-3">(2) every individual who is domiciled in the State of California who is outside the State of California for a temporary or transitory purpose
                    </li>
                </ol>
                <p class="mb-3">
                    All other individuals are defined as 'non-residents'.
                </p>
                <p class="mb-3">
                    If this definition of 'resident' applies to you, we must adhere to certain rights and obligations regarding your personal information.
                </p>
                <p>
                    <b>
                    What categories of personal information do we collect?
                    </b>
                </p>
                <p>
                    We have collected the following categories of personal information in the past twelve (12) months:
                </p>
                <div class="table-responsive">
                    <table class="table table-bordered mb-5">
                    <thead>
                        <tr>
                        <th scope="col" width="30%">Category</th>
                        <th scope="col" width="50%">Examples</th>
                        <th scope="col" class="text-center" width="20%">Collected</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td class="align-middle">A. Identifiers</td>
                        <td class="align-middle">Contact details, such as real name, alias, postal address, telephone or mobile contact number, unique personal identifier, online identifier, Internet Protocol address, email address, and account name</td>
                        <td class="text-center align-middle">YES</td>
                        </tr>
                        <tr>
                        <td class="align-middle">B. Personal information categories listed in the California Customer Records statute</td>
                        <td class="align-middle">Name, contact information, education, employment, employment history, and financial information</td>
                        <td class="text-center align-middle">NO</td>
                        </tr>
                        <tr>
                        <td class="align-middle">C. Protected classification characteristics under California or federal law</td>
                        <td class="align-middle">Gender and date of birth</td>
                        <td class="text-center align-middle">YES</td>
                        </tr>
                        <tr>
                        <td class="align-middle">D. Commercial information</td>
                        <td class="align-middle">Transaction information, purchase history, financial details, and payment information</td>
                        <td class="text-center align-middle">NO</td>
                        </tr>
                        <tr>
                        <td class="align-middle">E. Biometric information</td>
                        <td class="align-middle">Fingerprints and voiceprints</td>
                        <td class="text-center align-middle">NO</td>
                        </tr>
                        <tr>
                        <td class="align-middle">F. Internet or other similar network activity</td>
                        <td class="align-middle">Browsing history, search history, online behaviour, interest data, and interactions with our and other websites, applications, systems, and advertisements</td>
                        <td class="text-center align-middle">NO</td>
                        </tr>
                        <tr>
                        <td class="align-middle">G. Geolocation data</td>
                        <td class="align-middle">Device location</td>
                        <td class="text-center align-middle">Yes</td>
                        </tr>
                        <tr>
                        <td class="align-middle">H. Audio, electronic, visual, thermal, olfactory, or similar information</td>
                        <td class="align-middle">Images and audio, video or call recordings created in connection with our business activities</td>
                        <td class="text-center align-middle">NO</td>
                        </tr>
                        <tr>
                        <td class="align-middle">I. Professional or employment-related information</td>
                        <td class="align-middle">Business contact details in order to provide you our Services at a business level or job title, work history, and professional qualifications if you apply for a job with us</td>
                        <td class="text-center align-middle">NO</td>
                        </tr>
                        <tr>
                        <td class="align-middle">J. Education Information</td>
                        <td class="align-middle">Student records and directory information</td>
                        <td class="text-center align-middle">NO</td>
                        </tr>
                        <tr>
                        <td class="align-middle">K. Inferences drawn from other personal information</td>
                        <td class="align-middle">Inferences drawn from any of the collected personal information listed above to create a profile or summary about, for example, an individual’s preferences and characteristics</td>
                        <td class="text-center align-middle">NO</td>
                        </tr>
                        <tr>
                        <td class="align-middle">L. Sensitive Personal Information</td>
                        <td class="align-middle"></td>
                        <td class="text-center align-middle">NO</td>
                        </tr>
                    </tbody>
                    </table>
                    <p class="mb-3">
                    We will use and retain the collected personal information as needed to provide the Services or for:
                    </p>
                    <ul class="mb-4">
                    <li>Category A - As long as the user has an account with us</li>
                    <li>Category C - As long as the user has an account with us</li>
                    <li>Category G - As long as the user has an account with us</li>
                    </ul>
                    <p class="mb-3">
                    We may also collect other personal information outside of these categories through instances where you interact with us in person, online, or by phone or mail in the context of:
                    </p>
                    <ul class="mb-4">
                    <li>Receiving help through our customer support channels;</li>
                    <li>Participation in customer surveys or contests; and</li>
                    <li>Facilitation in the delivery of our Services and to respond to your inquiries.</li>
                    </ul>
                    <p class="mb-3">
                    <b>
                        How do we use and share your personal information?
                    </b>
                    </p>
                    <p class="mb-3">
                    More information about our data collection and sharing practices can be found in this privacy notice and our Cookie Notice: <a href="https://app.termly.io/document/cookie-policy/13431987-f893-4940-bb46-b3159b7f8375" class="text-decoration-underline text-primary" target="_blank">https://app.termly.io/document/cookie-policy/13431987-f893-4940-bb46-b3159b7f8375.</a>
                    </p>
                    <p class="mb-3">
                    You may contact us by email at support@peeq.com.au, or by referring to the contact details at the bottom of this document.
                    </p>
                    <p class="mb-5">
                    If you are using an authorised agent to exercise your right to opt out we may deny a request if the authorised agent does not submit proof that they have been validly authorised to act on your behalf.
                    </p>
                    <p class="mb-3">
                    <b>
                        Will your information be shared with anyone else?
                    </b>
                    </p>
                    <p class="mb-3">
                    We may disclose your personal information with our service providers pursuant to a written contract between us and each service provider. Each service provider is a for-profit entity that processes the information on our behalf, following the same strict privacy protection obligations mandated by the CCPA.
                    </p>
                    <p class="mb-3">
                    We may use your personal information for our own business purposes, such as for undertaking internal research for technological development and demonstration. This is not considered to be 'selling' of your personal information.
                    </p>
                    <p class="mb-5">
                    We have not disclosed, sold, or shared any personal information to third parties for a business or commercial purpose in the preceding twelve (12) months. We will not sell or share personal information in the future belonging to website visitors, users, and other consumers.
                    </p>
                    <p class="mb-3 fs-4">
                    <b>
                        Your rights with respect to your personal data
                    </b>
                    </p>
                    <p class="text-decoration-underline fs-5 mb-3">
                    Right to request deletion of the data — Request to delete
                    </p>
                    <p class="mb-3">
                    You can ask for the deletion of your personal information. If you ask us to delete your personal information, we will respect your request and delete your personal information, subject to certain exceptions provided by law, such as (but not limited to) the exercise by another consumer of his or her right to free speech, our compliance requirements resulting from a legal obligation, or any processing that may be required to protect against illegal activities.
                    </p>
                    <p class="text-decoration-underline fs-5 mb-3">
                    Right to be informed — Request to know
                    </p>
                    <p class="mb-3">
                    Depending on the circumstances, you have a right to know:
                    </p>
                    <ul>
                    <li>whether we collect and use your personal information;</li>
                    <li>the categories of personal information that we collect;</li>
                    <li>the purposes for which the collected personal information is used;</li>
                    <li>whether we sell or share personal information to third parties;</li>
                    <li>the categories of personal information that we sold, shared, or disclosed for a business purpose;</li>
                    <li>the categories of third parties to whom the personal information was sold, shared, or disclosed for a business </li>purpose;
                    <li>the business or commercial purpose for collecting, selling, or sharing personal information; and</li>
                    <li>the specific pieces of personal information we collected about you.</li>
                    </ul>
                    <p>
                    In accordance with applicable law, we are not obligated to provide or delete consumer information that is de-identified in response to a consumer request or to re-identify individual data to verify a consumer request
                    </p>
                    <p class="text-decoration-underline fs-5 mb-3">
                    Right to Non-Discrimination for the Exercise of a Consumer’s Privacy Rights
                    </p>
                    <p class="mb-3">
                    Right to Non-Discrimination for the Exercise of a Consumer’s Privacy Rights
                    </p>
                    <p class="text-decoration-underline fs-5 mb-3">
                    Right to Limit Use and Disclosure of Sensitive Personal Information
                    </p>
                    <p class="mb-3">
                    We do not process consumer's sensitive personal information.
                    </p>
                    <p class="text-decoration-underline fs-5 mb-3">
                    Verification process
                    </p>
                    <p class="mb-3">
                    Upon receiving your request, we will need to verify your identity to determine you are the same person about whom we have the information in our system. These verification efforts require us to ask you to provide information so that we can match it with information you have previously provided us. For instance, depending on the type of request you submit, we may ask you to provide certain information so that we can match the information you provide with the information we already have on file, or we may contact you through a communication method (e.g. phone or email) that you have previously provided to us. We may also use other verification methods as the circumstances dictate.
                    </p>
                    <p class="mb-3">
                    We will only use personal information provided in your request to verify your identity or authority to make the request. To the extent possible, we will avoid requesting additional information from you for the purposes of verification. However, if we cannot verify your identity from the information already maintained by us, we may request that you provide additional information for the purposes of verifying your identity and for security or fraud-prevention purposes. We will delete such additionally provided information as soon as we finish verifying you.
                    </p>
                    <p class="text-decoration-underline fs-5 mb-3">
                    Other privacy rights
                    </p>
                    <ul>
                    <li>You may object to the processing of your personal information.</li>
                    <li>You may request correction of your personal data if it is incorrect or no longer relevant, or ask to restrict the processing of the information.</li>
                    <li>You can designate an authorised agent to make a request under the CCPA on your behalf. We may deny a request from an authorised agent that does not submit proof that they have been validly authorised to act on your behalf in accordance with the CCPA.</li>
                    <li>You may request to opt out from future selling or sharing of your personal information to third parties. Upon receiving an opt-out request, we will act upon the request as soon as feasibly possible, but no later than fifteen (15) days from the date of the request submission.</li>
                    </ul>
                    <p class="mb-5">
                    To exercise these rights, you can contact us by email at support@peeq.com.au, or by referring to the contact details at the bottom of this document. If you have a complaint about how we handle your data, we would like to hear from you.
                    </p>
                    <h5 class="mb-4 pt-1" id="14"><b>14. DO VIRGINIA RESIDENTS HAVE SPECIFIC PRIVACY RIGHTS?</b></h5>
                    <p class="fst-italic mb-4">
                    <b class="text-secondary">
                    In Short:</b> Yes, if you are a resident of Virginia, you may be granted specific rights regarding access to and use of your personal information.
                    </p>
                    <p class="mb-3 fs-5">
                    <b>
                        Virginia CDPA Privacy Notice
                    </b>
                    </p>
                    <p class="mb-3">Under the Virginia Consumer Data Protection Act (CDPA):</p>

                    <p class="mb-3">'Consumer' means a natural person who is a resident of the Commonwealth acting only in an individual or household context. It does not include a natural person acting in a commercial or employment context.</p>

                    <p class="mb-3">'Personal data' means any information that is linked or reasonably linkable to an identified or identifiable natural person. 'Personal data' does not include de-identified data or publicly available information.</p>

                    <p class="mb-3">'Sale of personal data' means the exchange of personal data for monetary consideration.</p>

                    <p class="mb-3">If this definition 'consumer' applies to you, we must adhere to certain rights and obligations regarding your personal data.</p>

                    <p class="mb-3">The information we collect, use, and disclose about you will vary depending on how you interact with us and our Services. To find out more, please visit the following links:</p>
                    <ul class="mb-4">
                    <li>
                        <a href="#1" class="text-primary text-decoration-underline">
                        Personal data we collect
                        </a>
                    </li>
                    <li>
                        <a href="#2" class="text-primary text-decoration-underline">
                        How we use your personal data
                        </a>
                    </li>
                    <li>
                        <a href="#4" class="text-primary text-decoration-underline">
                        When and with whom we share your personal data
                        </a>
                    </li>
                    </ul>
                    <p class="mb-3">The information we collect, use, and disclose about you will vary depending on how you interact with us and our Services. To find out more, please visit the following links:</p>
                    <ul class="mb-3">
                    <li class="mb-2">Right to be informed whether or not we are processing your personal data</li>
                    <li class="mb-2">Right to access your personal data</li>
                    <li class="mb-2">Right to correct inaccuracies in your personal data</li>
                    <li class="mb-2">Right to request deletion of your personal data</li>
                    <li class="mb-2">Right to obtain a copy of the personal data you previously shared with us</li>
                    <li class="mb-2">Right to opt out of the processing of your personal data if it is used for targeted advertising, the sale of personal data, or profiling in furtherance of decisions that produce legal or similarly significant effects ('profiling')</li>
                    </ul>
                    <p class="mb-3">
                    We have not sold any personal data to third parties for business or commercial purposes. We will not sell personal data in the future belonging to website visitors, users, and other consumers.
                    </p>
                    <p class="mb-3 text-decoration-underline fs-5">
                    Exercise your rights provided under the Virginia CDPA
                    </p>
                    <p class="mb-3">
                    More information about our data collection and sharing practices can be found in this privacy notice and our Cookie Notice: <a href="https://app.termly.io/document/cookie-policy/13431987-f893-4940-bb46-b3159b7f8375" class="text-primary text-decoration-underline" target="_blank">https://app.termly.io/document/cookie-policy/13431987-f893-4940-bb46-b3159b7f8375.</a>
                    </p>
                    <p class="mb-3">
                    You may contact us by email at support@peeq.com.au, by submitting a <a href="https://app.termly.io/notify/e0a002a9-f72d-44ff-94e3-b5ca4dd92644" class="text-primary text-decoration-underline">data subject access request,</a> or by referring to the contact details at the bottom of this document.
                    </p>
                    <p class="mb-3">
                    If you are using an authorised agent to exercise your rights, we may deny a request if the authorised agent does not submit proof that they have been validly authorised to act on your behalf.
                    </p>
                    <p class="text-decoration-underline fs-5 mb-3">
                    Verification process
                    </p>
                    <p class="mb-3">
                    We may request that you provide additional information reasonably necessary to verify you and your consumer's request. If you submit the request through an authorised agent, we may need to collect additional information to verify your identity before processing your request.
                    </p>
                    <p class="mb-3">
                    Upon receiving your request, we will respond without undue delay, but in all cases, within forty-five (45) days of receipt. The response period may be extended once by forty-five (45) additional days when reasonably necessary. We will inform you of any such extension within the initial 45-day response period, together with the reason for the extension.
                    </p>
                    <p class="text-decoration-underline fs-5 mb-3">                
                    Right to appeal 
                    </p>
                    <p class="mb-5">
                    If we decline to take action regarding your request, we will inform you of our decision and reasoning behind it. If you wish to appeal our decision, please email us at support@peeq.com.au. Within sixty (60) days of receipt of an appeal, we will inform you in writing of any action taken or not taken in response to the appeal, including a written explanation of the reasons for the decisions. If your appeal if denied, you may contact the <a href="https://www.oag.state.va.us/consumer-protection/index.php/file-a-complaint" class="text-decoration-underline text-primary" target="_blank">Attorney General to submit a complaint.
                    </p>
                    <h5 class="mb-4 pt-1" id="15"><b>15. DO WE MAKE UPDATES TO THIS NOTICE?</b></h5>
                    <p class="fst-italic mb-4">
                    <b class="text-secondary">
                    In Short:</b> Yes, we will update this notice as necessary to stay compliant with relevant laws.
                    </p>
                    <p class="mb-5">
                    We may update this privacy notice from time to time. The updated version will be indicated by an updated 'Revised' date and the updated version will be effective as soon as it is accessible. If we make material changes to this privacy notice, we may notify you either by prominently posting a notice of such changes or by directly sending you a notification. We encourage you to review this privacy notice frequently to be informed of how we are protecting your information.
                    </p>
                    <h5 class="mb-4 pt-1" id="16"><b>16. HOW CAN YOU CONTACT US ABOUT THIS NOTICE?</b></h5>
                    <p class="mb-3">
                    If you have questions or comments about this notice, you may email us at support@peeq.com.au or contact us by post at:
                    </p>
                    <p class="mb-5">
                    Luminary Mindset PTY LTD<br>
                    Level 8, 171 Clarence Street<br>
                    Sydney 2000 <br>
                    Australia<br>
                    </p>
                    <h5 class="mb-4 pt-1" id="17"><b>17. HOW CAN YOU REVIEW, UPDATE, OR DELETE THE DATA WE COLLECT FROM YOU?
                    </b></h5>
                    <p class="mb-0">
                    Based on the applicable laws of your country, you may have the right to request access to the personal information we collect from you, change that information, or delete it. To request to review, update, or delete your personal information, please fill out and submit a <a href="https://app.termly.io/notify/e0a002a9-f72d-44ff-94e3-b5ca4dd92644" class="text-primary text-decoration-underline">data subject access request.</a>
                    </p>
                </div>
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
