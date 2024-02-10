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
                <h2 class="mb-0">TERMS OF SERVICE</h2>
                <p class="mb-5"><b>Last updated June 16, 2023</b></p>
                </div>
                <div class="lm_term-body text-dark">
                <h5 class="mb-4 pt-1"><b>AGREEMENT TO OUR LEGAL TERMS</b></h5>
                <p class="mb-3">We are Luminary Mindset PTY LTD, doing business as PEEQ™ (<b>'Company'</b>, <b>'we'</b>, <b>'us'</b>, or <b>'our'</b>), a company registered in Australia at Level 8, 171 Clarence Street, Sydney , New South Wales 2000.
                </p>
                <p class="mb-3">We operate the website <a href="https://www.peeq.com.au/" class="text-decoration-underline text-primary"> https://www.peeq.com.au</a> (the <b>'Site'</b>), the mobile application PEEQ™ (the <b>'App'</b>), as well as any other related products and services that refer or link to these legal terms (the <b>'Legal Terms'</b>) (collectively, the <b>'Services'</b>).
                </p>
                <p class="mb-3">
                    You can contact us by email at support@peeq.com.au, or by mail to Level 8, 171 Clarence Street, Sydney , New South Wales 2000, Australia.
                </p>
                <p class="mb-3">
                    These Legal Terms constitute a legally binding agreement made between you, whether personally or on behalf of an entity (<b>'you'</b>), and Luminary Mindset PTY LTD, concerning your access to and use of the Services. You agree that by accessing the Services, you have read, understood, and agreed to be bound by all of these Legal Terms. IF YOU DO NOT AGREE WITH ALL OF THESE LEGAL TERMS, THEN YOU ARE EXPRESSLY PROHIBITED FROM USING THE SERVICES AND YOU MUST DISCONTINUE USE IMMEDIATELY.
                </p>
                <p class="mb-3">
                    We will provide you with prior notice of any scheduled changes to the Services you are using. The modified Legal Terms will become effective upon posting or notifying you by notifications@peeq.com.au, as stated in the email message. By continuing to use the Services after the effective date of any changes, you agree to be bound by the modified terms.
                </p>
                <p class="mb-3">
                    The Services are intended for users who are at least 18 years old. Persons under the age of 18 are not permitted to use or register for the Services.
                </p>
                <p class="mb-5">
                    We recommend that you print a copy of these Legal Terms for your records.
                </p>
                <h4 class="mb-3 fw-bold" id="table">TABLE OF CONTENTS</h4>
                <a href="#1" class="d-block color-primary text-decoration-underline mb-1">1. OUR SERVICES</a>
                <a href="#2" class="d-block color-primary text-decoration-underline mb-1">2. INTELLECTUAL PROPERTY RIGHTS</a>
                <a href="#3" class="d-block color-primary text-decoration-underline mb-1">3. USER REPRESENTATIONS</a>
                <a href="#4" class="d-block color-primary text-decoration-underline mb-1">4. USER REGISTRATION</a>
                <a href="#5" class="d-block color-primary text-decoration-underline mb-1">5. PRODUCTS</a>
                <a href="#6" class="d-block color-primary text-decoration-underline mb-1">6. PURCHASES AND PAYMENT</a> 
                <a href="#7" class="d-block color-primary text-decoration-underline mb-1">7. REFUNDS POLICY</a>
                <a href="#8" class="d-block color-primary text-decoration-underline mb-1">8. SOFTWARE</a>
                <a href="#9" class="d-block color-primary text-decoration-underline mb-1">9. PROHIBITED ACTIVITIES</a>
                <a href="#10" class="d-block color-primary text-decoration-underline mb-1">10. USER GENERATED CONTRIBUTIONS</a>
                <a href="#11" class="d-block color-primary text-decoration-underline mb-1">11. CONTRIBUTION LICENCE</a>
                <a href="#12" class="d-block color-primary text-decoration-underline mb-1">12. GUIDELINES FOR REVIEWS</a>
                <a href="#13" class="d-block color-primary text-decoration-underline mb-1">13. MOBILE APPLICATION LICENCE</a>
                <a href="#14" class="d-block color-primary text-decoration-underline mb-1">14. SOCIAL MEDIA</a>
                <a href="#15" class="d-block color-primary text-decoration-underline mb-1">15. THIRD-PARTY WEBSITES AND CONTENT</a>
                <a href="#16" class="d-block color-primary text-decoration-underline mb-1">16. SERVICES MANAGEMENT</a>
                <a href="#17" class="d-block color-primary text-decoration-underline mb-1">17. PRIVACY POLICY</a>
                <a href="#18" class="d-block color-primary text-decoration-underline mb-1">18. COPYRIGHT INFRINGEMENTS</a>
                <a href="#19" class="d-block color-primary text-decoration-underline mb-1">19. TERM AND TERMINATION</a>
                <a href="#20" class="d-block color-primary text-decoration-underline mb-1">20. MODIFICATIONS AND INTERRUPTIONS</a>
                <a href="#21" class="d-block color-primary text-decoration-underline mb-1">21. GOVERNING LAW</a>
                <a href="#22" class="d-block color-primary text-decoration-underline mb-1">22. DISPUTE RESOLUTION</a>
                <a href="#23" class="d-block color-primary text-decoration-underline mb-1">23. CORRECTIONS</a>
                <a href="#24" class="d-block color-primary text-decoration-underline mb-1">24. DISCLAIMER</a>
                <a href="#25" class="d-block color-primary text-decoration-underline mb-1">25. LIMITATIONS OF LIABILITY</a>
                <a href="#26" class="d-block color-primary text-decoration-underline mb-1">26. INDEMNIFICATION</a>
                <a href="#27" class="d-block color-primary text-decoration-underline mb-1">27. USER DATA</a>
                <a href="#28" class="d-block color-primary text-decoration-underline mb-1">28. ELECTRONIC COMMUNICATIONS, TRANSACTIONS, AND SIGNATURES</a>
                <a href="#29" class="d-block color-primary text-decoration-underline mb-1">29. CALIFORNIA USERS AND RESIDENTS</a>
                <a href="#30" class="d-block color-primary text-decoration-underline mb-1">30. MISCELLANEOUS</a>
                <a href="#31" class="d-block color-primary text-decoration-underline mb-5">31. CONTACT US</a>
                <h5 class="mb-4 pt-1" id="1"><b>1. OUR SERVICES</b></h5>
                <p class="mb-3">The information provided when using the Services is not intended for distribution to or use by any person or entity in any jurisdiction or country where such distribution or use would be contrary to law or regulation or which would subject us to any registration requirement within such jurisdiction or country. Accordingly, those persons who choose to access the Services from other locations do so on their own initiative and are solely responsible for compliance with local laws, if and to the extent local laws are applicable.</p>
                <p class="mb-5">The Services are not tailored to comply with industry-specific regulations (Health Insurance Portability and Accountability Act (HIPAA), Federal Information Security Management Act (FISMA), etc.), so if your interactions would be subjected to such laws, you may not use the Services. You may not use the Services in a way that would violate the Gramm-Leach-Bliley Act (GLBA).</p>
                <h5 class="mb-4 pt-1" id="2"><b>2. INTELLECTUAL PROPERTY RIGHTS</b></h5>
                <h6 class="fs-4">
                    <b>
                    Our intellectual property
                    </b>
                </h6>
                <p class="mb-3">We are the owner or the licensee of all intellectual property rights in our Services, including all source code, databases, functionality, software, website designs, audio, video, text, photographs, and graphics in the Services (collectively, the 'Content'), as well as the trademarks, service marks, and logos contained therein (the 'Marks').</p>
                <p class="mb-3">Our Content and Marks are protected by copyright and trademark laws (and various other intellectual property rights and unfair competition laws) and treaties in the United States and around the world.</p>
                <p class="mb-4">We are the owner or the licensee of all intellectual property rights in our Services, including all source code, databases, functionality, software, website designs, audio, video, text, photographs, and graphics in the Services (collectively, the 'Content'), as well as the trademarks, service marks, and logos contained therein (the 'Marks').</p>
                <h6 class="fs-4">
                    <b>
                    Your use of our Services
                    </b>
                </h6>
                <p class="mb-3">
                    Subject to your compliance with these Legal Terms, including the <a href="#9" class="text-primary text-decoration-underline">'PROHIBITED ACTIVITIES'</a> section below, we grant you a non-exclusive, non-transferable, revocable licence to: 
                </p>
                <ul>
                    <li class="pb-0">access the Services; and</li>
                    <li>download or print a copy of any portion of the Content to which you have properly gained access.</li>
                </ul>
                <p class="mb-3">
                    solely for your personal, non-commercial use or internal business purpose.
                </p>
                <p class="mb-3">Except as set out in this section or elsewhere in our Legal Terms, no part of the Services and no Content or Marks may be copied, reproduced, aggregated, republished, uploaded, posted, publicly displayed, encoded, translated, transmitted, distributed, sold, licensed, or otherwise exploited for any commercial purpose whatsoever, without our express prior written permission.</p>
                <p class="mb-3">If you wish to make any use of the Services, Content, or Marks other than as set out in this section or elsewhere in our Legal Terms, please address your request to: support@peeq.com.au. If we ever grant you the permission to post, reproduce, or publicly display any part of our Services or Content, you must identify us as the owners or licensors of the Services, Content, or Marks and ensure that any copyright or proprietary notice appears or is visible on posting, reproducing, or displaying our Content.</p>
                <p class="mb-3">We reserve all rights not expressly granted to you in and to the Services, Content, and Marks.</p>
                <p class="mb-5">Any breach of these Intellectual Property Rights will constitute a material breach of our Legal Terms and your right to use our Services will terminate immediately.
                </p>
                <h6 class="fs-4">
                    <b>
                    Your submissions and contributions
                    </b>
                </h6>
                <p class="mb-3">
                    Please review this section and the <a href="#9" class="text-primary text-decoration-underline">'PROHIBITED ACTIVITIES'</a> section carefully prior to using our Services to understand the (a) rights you give us and (b) obligations you have when you post or upload any content through the Services. 
                </p>
                <p class="mb-3">
                    <b>Submissions:</b> By directly sending us any question, comment, suggestion, idea, feedback, or other information about the Services ('Submissions'), you agree to assign to us all intellectual property rights in such Submission. You agree that we shall own this Submission and be entitled to its unrestricted use and dissemination for any lawful purpose, commercial or otherwise, without acknowledgment or compensation to you.
                </p>
                <p class="mb-3">
                    <b>Contributions:</b> The Services may invite you to chat, contribute to, or participate in blogs, message boards, online forums, and other functionality during which you may create, submit, post, display, transmit, publish, distribute, or broadcast content and materials to us or through the Services, including but not limited to text, writings, video, audio, photographs, music, graphics, comments, reviews, rating suggestions, personal information, or other material ('Contributions'). Any Submission that is publicly posted shall also be treated as a Contribution.
                </p>
                <p class="mb-3">
                    You understand that Contributions may be viewable by other users of the Services and possibly through third-party websites.
                </p>
                <p class="mb-3">
                    <b>When you post Contributions, you grant us a licence (including use of your name, trademarks, and logos):</b> By posting any Contributions, you grant us an unrestricted, unlimited, irrevocable, perpetual, non-exclusive, transferable, royalty-free, fully-paid, worldwide right, and licence to: use, copy, reproduce, distribute, sell, resell, publish, broadcast, retitle, store, publicly perform, publicly display, reformat, translate, excerpt (in whole or in part), and exploit your Contributions (including, without limitation, your image, name, and voice) for any purpose, commercial, advertising, or otherwise, to prepare derivative works of, or incorporate into other works, your Contributions, and to sublicence the licences granted in this section. Our use and distribution may occur in any media formats and through any media channels.
                </p>
                <p class="mb-3">
                    This licence includes our use of your name, company name, and franchise name, as applicable, and any of the trademarks, service marks, trade names, logos, and personal and commercial images you provide.
                </p>
                <p class="mb-3">
                    <b>You are responsible for what you post or upload:</b> By sending us Submissions and/or posting Contributions through any part of the Services or making Contributions accessible through the Services by linking your account through the Services to any of your social networking accounts, you:
                </p>
                <ul>
                    <li>confirm that you have read and agree with our <a href="#9" class="text-decoration-underline text-primary">'PROHIBITED ACTIVITIES'</a> and will not post, send, publish, upload, or transmit through the Services any Submission nor post any Contribution that is illegal, harassing, hateful, harmful, defamatory, obscene, bullying, abusive, discriminatory, threatening to any person or group, sexually explicit, false, inaccurate, deceitful, or misleading;</li>
                    <li>to the extent permissible by applicable law, waive any and all moral rights to any such Submission and/or Contribution;</li>
                    <li>warrant that any such Submission and/or Contributions are original to you or that you have the necessary rights and licences to submit such Submissions and/or Contributions and that you have full authority to grant us the above-mentioned rights in relation to your Submissions and/or Contributions; and</li>
                    <li>warrant and represent that your Submissions and/or Contributions do not constitute confidential information.</li>
                </ul>
                <p class="mb-3">
                    You are solely responsible for your Submissions and/or Contributions and you expressly agree to reimburse us for any and all losses that we may suffer because of your breach of (a) this section, (b) any third party’s intellectual property rights, or (c) applicable law.
                </p>
                <p class="mb-5">
                    <b>We may remove or edit your Content:</b> Although we have no obligation to monitor any Contributions, we shall have the right to remove or edit any Contributions at any time without notice if in our reasonable opinion we consider such Contributions harmful or in breach of these Legal Terms. If we remove or edit any such Contributions, we may also suspend or disable your account and report you to the authorities.
                </p>
                <h6 class="fs-4">
                    <b>
                    Copyright infringement
                    </b>
                </h6>
                <p class="mb-5">
                    We respect the intellectual property rights of others. If you believe that any material available on or through the Services infringes upon any copyright you own or control, please immediately refer to the <a href="#18" class="text-primary text-decoration-underline">'COPYRIGHT INFRINGEMENTS'</a> section below. 
                </p>
                <h5 class="mb-4 pt-1" id="3"><b>3. USER REPRESENTATIONS</b></h5>
                <p class="mb-3">By using the Services, you represent and warrant that: (1) all registration information you submit will be true, accurate, current, and complete; (2) you will maintain the accuracy of such information and promptly update such registration information as necessary; (3) you have the legal capacity and you agree to comply with these Legal Terms; (4) you are not a minor in the jurisdiction in which you reside; (5) you will not access the Services through automated or non-human means, whether through a bot, script or otherwise; (6) you will not use the Services for any illegal or unauthorised purpose; and (7) your use of the Services will not violate any applicable law or regulation.</p>
                <p class="mb-5">If you provide any information that is untrue, inaccurate, not current, or incomplete, we have the right to suspend or terminate your account and refuse any and all current or future use of the Services (or any portion thereof).</p>
                <h5 class="mb-4 pt-1" id="4"><b>4. USER REGISTRATION</b></h5>
                <p class="mb-5">You may be required to register to use the Services. You agree to keep your password confidential and will be responsible for all use of your account and password. We reserve the right to remove, reclaim, or change a username you select if we determine, in our sole discretion, that such username is inappropriate, obscene, or otherwise objectionable.</p>
                <h5 class="mb-4 pt-1" id="5"><b>5. PRODUCTS</b></h5>
                <p class="mb-5">All products are subject to availability. We reserve the right to discontinue any products at any time for any reason. Prices for all products are subject to change.</p>
                <h5 class="mb-4 pt-1" id="6"><b>6. PURCHASES AND PAYMENT</b></h5>
                <p class="mb-2">We accept the following forms of payment:</p>
                <ul class="mb-3" style="list-style-type: '- ';">
                    <li class="pb-0">Visa</li>
                    <li class="pb-0">Mastercard</li>
                    <li class="pb-0">American Express</li>
                    <li class="pb-0">PayPal</li>
                    <li class="pb-0">Stripe</li>
                </ul>
                <p class="mb-3">
                    You agree to provide current, complete, and accurate purchase and account information for all purchases made via the Services. You further agree to promptly update account and payment information, including email address, payment method, and payment card expiration date, so that we can complete your transactions and contact you as needed. Sales tax will be added to the price of purchases as deemed required by us. We may change prices at any time. All payments shall be in Australian Dollars .
                </p>
                <p class="mb-3">
                    You agree to pay all charges at the prices then in effect for your purchases and any applicable shipping fees, and you authorise us to charge your chosen payment provider for any such amounts upon placing your order. If your order is subject to recurring charges, then you consent to our charging your payment method on a recurring basis without requiring your prior approval for each recurring charge, until such time as you cancel the applicable order. We reserve the right to correct any errors or mistakes in pricing, even if we have already requested or received payment.
                </p>
                <p class="mb-5">
                    We reserve the right to refuse any order placed through the Services. We may, in our sole discretion, limit or cancel quantities purchased per person, per household, or per order. These restrictions may include orders placed by or under the same customer account, the same payment method, and/or orders that use the same billing or shipping address. We reserve the right to limit or prohibit orders that, in our sole judgement, appear to be placed by dealers, resellers, or distributors.
                </p>
                <h5 class="mb-4 pt-1" id="7"><b>7. REFUNDS POLICY</b></h5>
                <p class="mb-5">All sales are final and no refund will be issued.</p>
                <h5 class="mb-4 pt-1" id="8"><b>8. SOFTWARE</b></h5>
                <p class="mb-5">We may include software for use in connection with our Services. If such software is accompanied by an end user licence agreement ('EULA'), the terms of the EULA will govern your use of the software. If such software is not accompanied by a EULA, then we grant to you a non-exclusive, revocable, personal, and non-transferable licence to use such software solely in connection with our services and in accordance with these Legal Terms. Any software and any related documentation is provided 'AS IS' without warranty of any kind, either express or implied, including, without limitation, the implied warranties of merchantability, fitness for a particular purpose, or non-infringement. You accept any and all risk arising out of use or performance of any software. You may not reproduce or redistribute any software except in accordance with the EULA or these Legal Terms.</p>
                <h5 class="mb-4 pt-1" id="9"><b>9. PROHIBITED ACTIVITIES</b></h5>
                <p class="mb-3">You may not access or use the Services for any purpose other than that for which we make the Services available. The Services may not be used in connection with any commercial endeavours except those that are specifically endorsed or approved by us.</p>
                <p class="mb-2">
                    As a user of the Services, you agree not to:
                </p>
                <ul class="mb-5">
                    <li class="pb-1">Systematically retrieve data or other content from the Services to create or compile, directly or indirectly, a collection, compilation, database, or directory without written permission from us.</li>
                    <li class="pb-1">Trick, defraud, or mislead us and other users, especially in any attempt to learn sensitive account information such as user passwords.</li>
                    <li class="pb-1">Circumvent, disable, or otherwise interfere with security-related features of the Services, including features that prevent or restrict the use or copying of any Content or enforce limitations on the use of the Services and/or the Content contained therein.</li>
                    <li class="pb-1">Disparage, tarnish, or otherwise harm, in our opinion, us and/or the Services.</li>
                    <li class="pb-1">Use any information obtained from the Services in order to harass, abuse, or harm another person.</li>
                    <li class="pb-1">Make improper use of our support services or submit false reports of abuse or misconduct.</li>
                    <li class="pb-1">Use the Services in a manner inconsistent with any applicable laws or regulations.</li>
                    <li class="pb-1">Engage in unauthorised framing of or linking to the Services.</li>
                    <li class="pb-1">Upload or transmit (or attempt to upload or to transmit) viruses, Trojan horses, or other material, including excessive use of capital letters and spamming (continuous posting of repetitive text), that interferes with any party’s uninterrupted use and enjoyment of the Services or modifies, impairs, disrupts, alters, or interferes with the use, features, functions, operation, or maintenance of the Services.</li>
                    <li class="pb-1">Engage in any automated use of the system, such as using scripts to send comments or messages, or using any data mining, robots, or similar data gathering and extraction tools.</li>
                    <li class="pb-1">Delete the copyright or other proprietary rights notice from any Content.</li>
                    <li class="pb-1">Attempt to impersonate another user or person or use the username of another user.</li>
                    <li class="pb-1">Upload or transmit (or attempt to upload or to transmit) any material that acts as a passive or active information collection or transmission mechanism, including without limitation, clear graphics interchange formats ('gifs'), 1×1 pixels, web bugs, cookies, or other similar devices (sometimes referred to as 'spyware' or 'passive collection mechanisms' or 'pcms').</li>
                    <li class="pb-1">Interfere with, disrupt, or create an undue burden on the Services or the networks or services connected to the Services.</li>
                    <li class="pb-1">Harass, annoy, intimidate, or threaten any of our employees or agents engaged in providing any portion of the Services to you.</li>
                    <li class="pb-1">Attempt to bypass any measures of the Services designed to prevent or restrict access to the Services, or any portion of the Services.</li>
                    <li class="pb-1">Copy or adapt the Services' software, including but not limited to Flash, PHP, HTML, JavaScript, or other code.</li>
                    <li class="pb-1">Except as permitted by applicable law, decipher, decompile, disassemble, or reverse engineer any of the software comprising or in any way making up a part of the Services.</li>
                    <li class="pb-1">Except as may be the result of standard search engine or Internet browser usage, use, launch, develop, or distribute any automated system, including without limitation, any spider, robot, cheat utility, scraper, or offline reader that accesses the Services, or use or launch any unauthorised script or other software.</li>
                    <li class="pb-1">Use a buying agent or purchasing agent to make purchases on the Services.</li>
                    <li class="pb-1">Make any unauthorised use of the Services, including collecting usernames and/or email addresses of users by electronic or other means for the purpose of sending unsolicited email, or creating user accounts by automated means or under false pretences.</li>
                    <li class="pb-1">Use the Services as part of any effort to compete with us or otherwise use the Services and/or the Content for any revenue-generating endeavour or commercial enterprise.</li>
                    <li class="pb-1">Use the Services to advertise or offer to sell goods and services.</li>
                    <li class="pb-1">Sell or otherwise transfer your profile.</li>
                </ul>
                <h5 class="mb-4 pt-1" id="10"><b>10. USER GENERATED CONTRIBUTIONS</b></h5>
                <p class="mb-2">
                    The Services may invite you to chat, contribute to, or participate in blogs, message boards, online forums, and other functionality, and may provide you with the opportunity to create, submit, post, display, transmit, perform, publish, distribute, or broadcast content and materials to us or on the Services, including but not limited to text, writings, video, audio, photographs, graphics, comments, suggestions, or personal information or other material (collectively, 'Contributions'). Contributions may be viewable by other users of the Services and through third-party websites. As such, any Contributions you transmit may be treated as non-confidential and non-proprietary. When you create or make available any Contributions, you thereby represent and warrant that:
                </p>
                <ul class="mb-3">
                    <li class="pb-1">The creation, distribution, transmission, public display, or performance, and the accessing, downloading, or copying of your Contributions do not and will not infringe the proprietary rights, including but not limited to the copyright, patent, trademark, trade secret, or moral rights of any third party.</li>
                    <li class="pb-1">You are the creator and owner of or have the necessary licences, rights, consents, releases, and permissions to use and to authorise us, the Services, and other users of the Services to use your Contributions in any manner contemplated by the Services and these Legal Terms.</li>
                    <li class="pb-1">You have the written consent, release, and/or permission of each and every identifiable individual person in your Contributions to use the name or likeness of each and every such identifiable individual person to enable inclusion and use of your Contributions in any manner contemplated by the Services and these Legal Terms.</li>
                    <li class="pb-1">Your Contributions are not false, inaccurate, or misleading.</li>
                    <li class="pb-1">Your Contributions are not unsolicited or unauthorised advertising, promotional materials, pyramid schemes, chain letters, spam, mass mailings, or other forms of solicitation.</li>
                    <li class="pb-1">Your Contributions are not obscene, lewd, lascivious, filthy, violent, harassing, libellous, slanderous, or otherwise objectionable (as determined by us).</li>
                    <li class="pb-1">Your Contributions do not ridicule, mock, disparage, intimidate, or abuse anyone.</li>
                    <li class="pb-1">Your Contributions are not used to harass or threaten (in the legal sense of those terms) any other person and to promote violence against a specific person or class of people.</li>
                    <li class="pb-1">Your Contributions do not violate any applicable law, regulation, or rule.</li>
                    <li class="pb-1">Your Contributions do not violate the privacy or publicity rights of any third party.</li>
                    <li class="pb-1">Your Contributions do not violate any applicable law concerning child pornography, or otherwise intended to protect the health or well-being of minors.</li>
                    <li class="pb-1">Your Contributions do not include any offensive comments that are connected to race, national origin, gender, sexual preference, or physical handicap.</li>
                    <li class="pb-1">Your Contributions do not otherwise violate, or link to material that violates, any provision of these Legal Terms, or any applicable law or regulation.</li>
                </ul>
                <p class="mb-5">
                    Any use of the Services in violation of the foregoing violates these Legal Terms and may result in, among other things, termination or suspension of your rights to use the Services.
                </p>
                <h5 class="mb-4 pt-1" id="11"><b>11. CONTRIBUTION LICENCE</b></h5>
                <p class="mb-3">
                    By posting your Contributions to any part of the Services or making Contributions accessible to the Services by linking your account from the Services to any of your social networking accounts, you automatically grant, and you represent and warrant that you have the right to grant, to us an unrestricted, unlimited, irrevocable, perpetual, non-exclusive, transferable, royalty-free, fully-paid, worldwide right, and licence to host, use, copy, reproduce, disclose, sell, resell, publish, broadcast, retitle, archive, store, cache, publicly perform, publicly display, reformat, translate, transmit, excerpt (in whole or in part), and distribute such Contributions (including, without limitation, your image and voice) for any purpose, commercial, advertising, or otherwise, and to prepare derivative works of, or incorporate into other works, such Contributions, and grant and authorise sublicences of the foregoing. The use and distribution may occur in any media formats and through any media channels.
                </p>
                <p class="mb-3">
                    This licence will apply to any form, media, or technology now known or hereafter developed, and includes our use of your name, company name, and franchise name, as applicable, and any of the trademarks, service marks, trade names, logos, and personal and commercial images you provide. You waive all moral rights in your Contributions, and you warrant that moral rights have not otherwise been asserted in your Contributions.
                </p>
                <p class="mb-3">
                    We do not assert any ownership over your Contributions. You retain full ownership of all of your Contributions and any intellectual property rights or other proprietary rights associated with your Contributions. We are not liable for any statements or representations in your Contributions provided by you in any area on the Services. You are solely responsible for your Contributions to the Services and you expressly agree to exonerate us from any and all responsibility and to refrain from any legal action against us regarding your Contributions.
                </p>
                <p class="mb-5">
                    We have the right, in our sole and absolute discretion, (1) to edit, redact, or otherwise change any Contributions; (2) to re-categorise any Contributions to place them in more appropriate locations on the Services; and (3) to pre-screen or delete any Contributions at any time and for any reason, without notice. We have no obligation to monitor your Contributions.
                </p>
                <h5 class="mb-4 pt-1" id="12"><b>12. GUIDELINES FOR REVIEWS</b></h5>
                <p class="mb-3">
                    We may provide you areas on the Services to leave reviews or ratings. When posting a review, you must comply with the following criteria: (1) you should have firsthand experience with the person/entity being reviewed; (2) your reviews should not contain offensive profanity, or abusive, racist, offensive, or hateful language; (3) your reviews should not contain discriminatory references based on religion, race, gender, national origin, age, marital status, sexual orientation, or disability; (4) your reviews should not contain references to illegal activity; (5) you should not be affiliated with competitors if posting negative reviews; (6) you should not make any conclusions as to the legality of conduct; (7) you may not post any false or misleading statements; and (8) you may not organise a campaign encouraging others to post reviews, whether positive or negative.
                </p>
                <p class="mb-5">
                    We may accept, reject, or remove reviews in our sole discretion. We have absolutely no obligation to screen reviews or to delete reviews, even if anyone considers reviews objectionable or inaccurate. Reviews are not endorsed by us, and do not necessarily represent our opinions or the views of any of our affiliates or partners. We do not assume liability for any review or for any claims, liabilities, or losses resulting from any review. By posting a review, you hereby grant to us a perpetual, non-exclusive, worldwide, royalty-free, fully paid, assignable, and sublicensable right and licence to reproduce, modify, translate, transmit by any means, display, perform, and/or distribute all content relating to review.
                </p>
                <h5 class="mb-4 pt-1" id="13"><b>13. MOBILE APPLICATION LICENCE</b></h5>
                <h6 class="fs-4">
                    <b>
                    Use Licence
                    </b>
                </h6>
                <p class="mb-3">
                    If you access the Services via the App, then we grant you a revocable, non-exclusive, non-transferable, limited right to install and use the App on wireless electronic devices owned or controlled by you, and to access and use the App on such devices strictly in accordance with the terms and conditions of this mobile application licence contained in these Legal Terms. You shall not: (1) except as permitted by applicable law, decompile, reverse engineer, disassemble, attempt to derive the source code of, or decrypt the App; (2) make any modification, adaptation, improvement, enhancement, translation, or derivative work from the App; (3) violate any applicable laws, rules, or regulations in connection with your access or use of the App; (4) remove, alter, or obscure any proprietary notice (including any notice of copyright or trademark) posted by us or the licensors of the App; (5) use the App for any revenue-generating endeavour, commercial enterprise, or other purpose for which it is not designed or intended; (6) make the App available over a network or other environment permitting access or use by multiple devices or users at the same time; (7) use the App for creating a product, service, or software that is, directly or indirectly, competitive with or in any way a substitute for the App; (8) use the App to send automated queries to any website or to send any unsolicited commercial email; or (9) use any proprietary information or any of our interfaces or our other intellectual property in the design, development, manufacture, licensing, or distribution of any applications, accessories, or devices for use with the App.
                </p>
                <h6 class="fs-4">
                    <b>
                    Apple and Android Devices
                    </b>
                </h6>
                <p class="mb-5">
                    The following terms apply when you use the App obtained from either the Apple Store or Google Play (each an 'App Distributor') to access the Services: (1) the licence granted to you for our App is limited to a non-transferable licence to use the application on a device that utilises the Apple iOS or Android operating systems, as applicable, and in accordance with the usage rules set forth in the applicable App Distributor’s terms of service; (2) we are responsible for providing any maintenance and support services with respect to the App as specified in the terms and conditions of this mobile application licence contained in these Legal Terms or as otherwise required under applicable law, and you acknowledge that each App Distributor has no obligation whatsoever to furnish any maintenance and support services with respect to the App; (3) in the event of any failure of the App to conform to any applicable warranty, you may notify the applicable App Distributor, and the App Distributor, in accordance with its terms and policies, may refund the purchase price, if any, paid for the App, and to the maximum extent permitted by applicable law, the App Distributor will have no other warranty obligation whatsoever with respect to the App; (4) you represent and warrant that (i) you are not located in a country that is subject to a US government embargo, or that has been designated by the US government as a 'terrorist supporting' country and (ii) you are not listed on any US government list of prohibited or restricted parties; (5) you must comply with applicable third-party terms of agreement when using the App, e.g. if you have a VoIP application, then you must not be in violation of their wireless data service agreement when using the App; and (6) you acknowledge and agree that the App Distributors are third-party beneficiaries of the terms and conditions in this mobile application licence contained in these Legal Terms, and that each App Distributor will have the right (and will be deemed to have accepted the right) to enforce the terms and conditions in this mobile application licence contained in these Legal Terms against you as a third-party beneficiary thereof.
                </p>
                <h5 class="mb-4 pt-1" id="14"><b>14. SOCIAL MEDIA</b></h5>
                <p class="mb-5">
                    As part of the functionality of the Services, you may link your account with online accounts you have with third-party service providers (each such account, a 'Third-Party Account') by either: (1) providing your Third-Party Account login information through the Services; or (2) allowing us to access your Third-Party Account, as is permitted under the applicable terms and conditions that govern your use of each Third-Party Account. You represent and warrant that you are entitled to disclose your Third-Party Account login information to us and/or grant us access to your Third-Party Account, without breach by you of any of the terms and conditions that govern your use of the applicable Third-Party Account, and without obligating us to pay any fees or making us subject to any usage limitations imposed by the third-party service provider of the Third-Party Account. By granting us access to any Third-Party Accounts, you understand that (1) we may access, make available, and store (if applicable) any content that you have provided to and stored in your Third-Party Account (the 'Social Network Content') so that it is available on and through the Services via your account, including without limitation any friend lists and (2) we may submit to and receive from your Third-Party Account additional information to the extent you are notified when you link your account with the Third-Party Account. Depending on the Third-Party Accounts you choose and subject to the privacy settings that you have set in such Third-Party Accounts, personally identifiable information that you post to your Third-Party Accounts may be available on and through your account on the Services. Please note that if a Third-Party Account or associated service becomes unavailable or our access to such Third-Party Account is terminated by the third-party service provider, then Social Network Content may no longer be available on and through the Services. You will have the ability to disable the connection between your account on the Services and your Third-Party Accounts at any time. PLEASE NOTE THAT YOUR RELATIONSHIP WITH THE THIRD-PARTY SERVICE PROVIDERS ASSOCIATED WITH YOUR THIRD-PARTY ACCOUNTS IS GOVERNED SOLELY BY YOUR AGREEMENT(S) WITH SUCH THIRD-PARTY SERVICE PROVIDERS. We make no effort to review any Social Network Content for any purpose, including but not limited to, for accuracy, legality, or non-infringement, and we are not responsible for any Social Network Content. You acknowledge and agree that we may access your email address book associated with a Third-Party Account and your contacts list stored on your mobile device or tablet computer solely for purposes of identifying and informing you of those contacts who have also registered to use the Services. You can deactivate the connection between the Services and your Third-Party Account by contacting us using the contact information below or through your account settings (if applicable). We will attempt to delete any information stored on our servers that was obtained through such Third-Party Account, except the username and profile picture that become associated with your account.
                </p>
                <h5 class="mb-4 pt-1" id="15"><b>15. THIRD-PARTY WEBSITES AND CONTENT</b></h5>
                <p class="mb-5">
                    The Services may contain (or you may be sent via the Site or App) links to other websites ('Third-Party Websites') as well as articles, photographs, text, graphics, pictures, designs, music, sound, video, information, applications, software, and other content or items belonging to or originating from third parties ('Third-Party Content'). Such Third-Party Websites and Third-Party Content are not investigated, monitored, or checked for accuracy, appropriateness, or completeness by us, and we are not responsible for any Third-Party Websites accessed through the Services or any Third-Party Content posted on, available through, or installed from the Services, including the content, accuracy, offensiveness, opinions, reliability, privacy practices, or other policies of or contained in the Third-Party Websites or the Third-Party Content. Inclusion of, linking to, or permitting the use or installation of any Third-Party Websites or any Third-Party Content does not imply approval or endorsement thereof by us. If you decide to leave the Services and access the Third-Party Websites or to use or install any Third-Party Content, you do so at your own risk, and you should be aware these Legal Terms no longer govern. You should review the applicable terms and policies, including privacy and data gathering practices, of any website to which you navigate from the Services or relating to any applications you use or install from the Services. Any purchases you make through Third-Party Websites will be through other websites and from other companies, and we take no responsibility whatsoever in relation to such purchases which are exclusively between you and the applicable third party. You agree and acknowledge that we do not endorse the products or services offered on Third-Party Websites and you shall hold us blameless from any harm caused by your purchase of such products or services. Additionally, you shall hold us blameless from any losses sustained by you or harm caused to you relating to or resulting in any way from any Third-Party Content or any contact with Third-Party Websites.
                </p>  
                <h5 class="mb-4 pt-1" id="16"><b>16. SERVICES MANAGEMENT</b></h5>
                <p class="mb-5">
                    We reserve the right, but not the obligation, to: (1) monitor the Services for violations of these Legal Terms; (2) take appropriate legal action against anyone who, in our sole discretion, violates the law or these Legal Terms, including without limitation, reporting such user to law enforcement authorities; (3) in our sole discretion and without limitation, refuse, restrict access to, limit the availability of, or disable (to the extent technologically feasible) any of your Contributions or any portion thereof; (4) in our sole discretion and without limitation, notice, or liability, to remove from the Services or otherwise disable all files and content that are excessive in size or are in any way burdensome to our systems; and (5) otherwise manage the Services in a manner designed to protect our rights and property and to facilitate the proper functioning of the Services.
                </p>  
                <h5 class="mb-4 pt-1" id="17"><b>17. PRIVACY POLICY</b></h5>
                <p class="mb-5">
                    We care about data privacy and security. Please review our Privacy Policy: <a href="https://app.termly.io/document/privacy-policy/e0a002a9-f72d-44ff-94e3-b5ca4dd92644" class="text-decoration-underline text-primary">https://app.termly.io/document/privacy-policy/e0a002a9-f72d-44ff-94e3-b5ca4dd92644.</a> By using the Services, you agree to be bound by our Privacy Policy, which is incorporated into these Legal Terms. Please be advised the Services are hosted in Australia. If you access the Services from any other region of the world with laws or other requirements governing personal data collection, use, or disclosure that differ from applicable laws in Australia, then through your continued use of the Services, you are transferring your data to Australia, and you expressly consent to have your data transferred to and processed in Australia.
                </p>  
                <h5 class="mb-4 pt-1" id="18"><b>18. COPYRIGHT INFRINGEMENTS</b></h5>
                <p class="mb-5">
                    We respect the intellectual property rights of others. If you believe that any material available on or through the Services infringes upon any copyright you own or control, please immediately notify us using the contact information provided below (a 'Notification'). A copy of your Notification will be sent to the person who posted or stored the material addressed in the Notification. Please be advised that pursuant to applicable law you may be held liable for damages if you make material misrepresentations in a Notification. Thus, if you are not sure that material located on or linked to by the Services infringes your copyright, you should consider first contacting an attorney.
                </p>  
                <h5 class="mb-4 pt-1" id="19"><b>19. TERM AND TERMINATION</b></h5>
                <p class="mb-3">
                    These Legal Terms shall remain in full force and effect while you use the Services. WITHOUT LIMITING ANY OTHER PROVISION OF THESE LEGAL TERMS, WE RESERVE THE RIGHT TO, IN OUR SOLE DISCRETION AND WITHOUT NOTICE OR LIABILITY, DENY ACCESS TO AND USE OF THE SERVICES (INCLUDING BLOCKING CERTAIN IP ADDRESSES), TO ANY PERSON FOR ANY REASON OR FOR NO REASON, INCLUDING WITHOUT LIMITATION FOR BREACH OF ANY REPRESENTATION, WARRANTY, OR COVENANT CONTAINED IN THESE LEGAL TERMS OR OF ANY APPLICABLE LAW OR REGULATION. WE MAY TERMINATE YOUR USE OR PARTICIPATION IN THE SERVICES OR DELETE YOUR ACCOUNT AND ANY CONTENT OR INFORMATION THAT YOU POSTED AT ANY TIME, WITHOUT WARNING, IN OUR SOLE DISCRETION.
                </p>  
                <p class="mb-5">
                    If we terminate or suspend your account for any reason, you are prohibited from registering and creating a new account under your name, a fake or borrowed name, or the name of any third party, even if you may be acting on behalf of the third party. In addition to terminating or suspending your account, we reserve the right to take appropriate legal action, including without limitation pursuing civil, criminal, and injunctive redress.
                </p>  
                <h5 class="mb-4 pt-1" id="20"><b>20. MODIFICATIONS AND INTERRUPTIONS</b></h5>
                <p class="mb-3">
                    We reserve the right to change, modify, or remove the contents of the Services at any time or for any reason at our sole discretion without notice. However, we have no obligation to update any information on our Services. We also reserve the right to modify or discontinue all or part of the Services without notice at any time. We will not be liable to you or any third party for any modification, price change, suspension, or discontinuance of the Services.
                </p>  
                <p class="mb-5">
                    We cannot guarantee the Services will be available at all times. We may experience hardware, software, or other problems or need to perform maintenance related to the Services, resulting in interruptions, delays, or errors. We reserve the right to change, revise, update, suspend, discontinue, or otherwise modify the Services at any time or for any reason without notice to you. You agree that we have no liability whatsoever for any loss, damage, or inconvenience caused by your inability to access or use the Services during any downtime or discontinuance of the Services. Nothing in these Legal Terms will be construed to obligate us to maintain and support the Services or to supply any corrections, updates, or releases in connection therewith.
                </p>  
                <h5 class="mb-4 pt-1" id="21"><b>21. GOVERNING LAW</b></h5> 
                <p class="mb-5">
                    These Legal Terms shall be governed by and defined following the laws of Australia. Luminary Mindset PTY LTD and yourself irrevocably consent that the courts of Australia shall have exclusive jurisdiction to resolve any dispute which may arise in connection with these Legal Terms.
                </p>  
                <h5 class="mb-4 pt-1" id="22"><b>22. DISPUTE RESOLUTION</b></h5> 
                <p class="mb-5">
                    You agree to irrevocably submit all disputes related to these Legal Terms or the legal relationship established by these Legal Terms to the jurisdiction of the Australia courts. Luminary Mindset PTY LTD shall also maintain the right to bring proceedings as to the substance of the matter in the courts of the country where you reside or, if these Legal Terms are entered into in the course of your trade or profession, the state of your principal place of business.
                </p>  
                <h5 class="mb-4 pt-1" id="23"><b>23. CORRECTIONS</b></h5> 
                <p class="mb-5">
                    There may be information on the Services that contains typographical errors, inaccuracies, or omissions, including descriptions, pricing, availability, and various other information. We reserve the right to correct any errors, inaccuracies, or omissions and to change or update the information on the Services at any time, without prior notice.
                </p>  
                <h5 class="mb-4 pt-1" id="24"><b>24. DISCLAIMER</b></h5> 
                <p class="mb-5">
                    THE SERVICES ARE PROVIDED ON AN AS-IS AND AS-AVAILABLE BASIS. YOU AGREE THAT YOUR USE OF THE SERVICES WILL BE AT YOUR SOLE RISK. TO THE FULLEST EXTENT PERMITTED BY LAW, WE DISCLAIM ALL WARRANTIES, EXPRESS OR IMPLIED, IN CONNECTION WITH THE SERVICES AND YOUR USE THEREOF, INCLUDING, WITHOUT LIMITATION, THE IMPLIED WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, AND NON-INFRINGEMENT. WE MAKE NO WARRANTIES OR REPRESENTATIONS ABOUT THE ACCURACY OR COMPLETENESS OF THE SERVICES' CONTENT OR THE CONTENT OF ANY WEBSITES OR MOBILE APPLICATIONS LINKED TO THE SERVICES AND WE WILL ASSUME NO LIABILITY OR RESPONSIBILITY FOR ANY (1) ERRORS, MISTAKES, OR INACCURACIES OF CONTENT AND MATERIALS, (2) PERSONAL INJURY OR PROPERTY DAMAGE, OF ANY NATURE WHATSOEVER, RESULTING FROM YOUR ACCESS TO AND USE OF THE SERVICES, (3) ANY UNAUTHORISED ACCESS TO OR USE OF OUR SECURE SERVERS AND/OR ANY AND ALL PERSONAL INFORMATION AND/OR FINANCIAL INFORMATION STORED THEREIN, (4) ANY INTERRUPTION OR CESSATION OF TRANSMISSION TO OR FROM THE SERVICES, (5) ANY BUGS, VIRUSES, TROJAN HORSES, OR THE LIKE WHICH MAY BE TRANSMITTED TO OR THROUGH THE SERVICES BY ANY THIRD PARTY, AND/OR (6) ANY ERRORS OR OMISSIONS IN ANY CONTENT AND MATERIALS OR FOR ANY LOSS OR DAMAGE OF ANY KIND INCURRED AS A RESULT OF THE USE OF ANY CONTENT POSTED, TRANSMITTED, OR OTHERWISE MADE AVAILABLE VIA THE SERVICES. WE DO NOT WARRANT, ENDORSE, GUARANTEE, OR ASSUME RESPONSIBILITY FOR ANY PRODUCT OR SERVICE ADVERTISED OR OFFERED BY A THIRD PARTY THROUGH THE SERVICES, ANY HYPERLINKED WEBSITE, OR ANY WEBSITE OR MOBILE APPLICATION FEATURED IN ANY BANNER OR OTHER ADVERTISING, AND WE WILL NOT BE A PARTY TO OR IN ANY WAY BE RESPONSIBLE FOR MONITORING ANY TRANSACTION BETWEEN YOU AND ANY THIRD-PARTY PROVIDERS OF PRODUCTS OR SERVICES. AS WITH THE PURCHASE OF A PRODUCT OR SERVICE THROUGH ANY MEDIUM OR IN ANY ENVIRONMENT, YOU SHOULD USE YOUR BEST JUDGEMENT AND EXERCISE CAUTION WHERE APPROPRIATE.
                </p>  
                <h5 class="mb-4 pt-1" id="25"><b>25. LIMITATIONS OF LIABILITY</b></h5> 
                <p class="mb-5">
                    IN NO EVENT WILL WE OR OUR DIRECTORS, EMPLOYEES, OR AGENTS BE LIABLE TO YOU OR ANY THIRD PARTY FOR ANY DIRECT, INDIRECT, CONSEQUENTIAL, EXEMPLARY, INCIDENTAL, SPECIAL, OR PUNITIVE DAMAGES, INCLUDING LOST PROFIT, LOST REVENUE, LOSS OF DATA, OR OTHER DAMAGES ARISING FROM YOUR USE OF THE SERVICES, EVEN IF WE HAVE BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES. NOTWITHSTANDING ANYTHING TO THE CONTRARY CONTAINED HEREIN, OUR LIABILITY TO YOU FOR ANY CAUSE WHATSOEVER AND REGARDLESS OF THE FORM OF THE ACTION, WILL AT ALL TIMES BE LIMITED TO THE AMOUNT PAID, IF ANY, BY YOU TO US DURING THE SIX (6) MONTH PERIOD PRIOR TO ANY CAUSE OF ACTION ARISING. CERTAIN US STATE LAWS AND INTERNATIONAL LAWS DO NOT ALLOW LIMITATIONS ON IMPLIED WARRANTIES OR THE EXCLUSION OR LIMITATION OF CERTAIN DAMAGES. IF THESE LAWS APPLY TO YOU, SOME OR ALL OF THE ABOVE DISCLAIMERS OR LIMITATIONS MAY NOT APPLY TO YOU, AND YOU MAY HAVE ADDITIONAL RIGHTS.
                </p>  
                <h5 class="mb-4 pt-1" id="26"><b>26. INDEMNIFICATION</b></h5> 
                <p class="mb-5">
                    You agree to defend, indemnify, and hold us harmless, including our subsidiaries, affiliates, and all of our respective officers, agents, partners, and employees, from and against any loss, damage, liability, claim, or demand, including reasonable attorneys’ fees and expenses, made by any third party due to or arising out of: (1) your Contributions; (2) use of the Services; (3) breach of these Legal Terms; (4) any breach of your representations and warranties set forth in these Legal Terms; (5) your violation of the rights of a third party, including but not limited to intellectual property rights; or (6) any overt harmful act toward any other user of the Services with whom you connected via the Services. Notwithstanding the foregoing, we reserve the right, at your expense, to assume the exclusive defence and control of any matter for which you are required to indemnify us, and you agree to cooperate, at your expense, with our defence of such claims. We will use reasonable efforts to notify you of any such claim, action, or proceeding which is subject to this indemnification upon becoming aware of it.
                </p>  
                <h5 class="mb-4 pt-1" id="27"><b>27. USER DATA</b></h5> 
                <p class="mb-5">
                    We will maintain certain data that you transmit to the Services for the purpose of managing the performance of the Services, as well as data relating to your use of the Services. Although we perform regular routine backups of data, you are solely responsible for all data that you transmit or that relates to any activity you have undertaken using the Services. You agree that we shall have no liability to you for any loss or corruption of any such data, and you hereby waive any right of action against us arising from any such loss or corruption of such data.
                </p>  
                <h5 class="mb-4 pt-1" id="28"><b>28. ELECTRONIC COMMUNICATIONS, TRANSACTIONS, AND SIGNATURES</b></h5> 
                <p class="mb-5">
                    Visiting the Services, sending us emails, and completing online forms constitute electronic communications. You consent to receive electronic communications, and you agree that all agreements, notices, disclosures, and other communications we provide to you electronically, via email and on the Services, satisfy any legal requirement that such communication be in writing. YOU HEREBY AGREE TO THE USE OF ELECTRONIC SIGNATURES, CONTRACTS, ORDERS, AND OTHER RECORDS, AND TO ELECTRONIC DELIVERY OF NOTICES, POLICIES, AND RECORDS OF TRANSACTIONS INITIATED OR COMPLETED BY US OR VIA THE SERVICES. You hereby waive any rights or requirements under any statutes, regulations, rules, ordinances, or other laws in any jurisdiction which require an original signature or delivery or retention of non-electronic records, or to payments or the granting of credits by any means other than electronic means.
                </p>  
                <h5 class="mb-4 pt-1" id="29"><b>29. CALIFORNIA USERS AND RESIDENTS</b></h5> 
                <p class="mb-5">
                    If any complaint with us is not satisfactorily resolved, you can contact the Complaint Assistance Unit of the Division of Consumer Services of the California Department of Consumer Affairs in writing at 1625 North Market Blvd., Suite N 112, Sacramento, California 95834 or by telephone at (800) 952-5210 or (916) 445-1254.
                </p>  
                <h5 class="mb-4 pt-1" id="30"><b>30. MISCELLANEOUS</b></h5> 
                <p class="mb-5">
                    These Legal Terms and any policies or operating rules posted by us on the Services or in respect to the Services constitute the entire agreement and understanding between you and us. Our failure to exercise or enforce any right or provision of these Legal Terms shall not operate as a waiver of such right or provision. These Legal Terms operate to the fullest extent permissible by law. We may assign any or all of our rights and obligations to others at any time. We shall not be responsible or liable for any loss, damage, delay, or failure to act caused by any cause beyond our reasonable control. If any provision or part of a provision of these Legal Terms is determined to be unlawful, void, or unenforceable, that provision or part of the provision is deemed severable from these Legal Terms and does not affect the validity and enforceability of any remaining provisions. There is no joint venture, partnership, employment or agency relationship created between you and us as a result of these Legal Terms or use of the Services. You agree that these Legal Terms will not be construed against us by virtue of having drafted them. You hereby waive any and all defences you may have based on the electronic form of these Legal Terms and the lack of signing by the parties hereto to execute these Legal Terms.
                </p>  
                <h5 class="mb-4 pt-1" id="31"><b>31. CONTACT US</b></h5> 
                <p class="mb-3">
                    In order to resolve a complaint regarding the Services or to receive further information regarding use of the Services, please contact us at:
                </p>  
                <p class="mb-0 fw-bold">
                Luminary Mindset PTY LTD<br>
                Level 8, 171 Clarence Street<br>
                Sydney , New South Wales 2000<br>
                Australia<br>
                Phone: +61426496774<br>
                support@peeq.com.au<br>
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
