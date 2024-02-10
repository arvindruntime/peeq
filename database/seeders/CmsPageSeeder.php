<?php

namespace Database\Seeders;

use App\Models\CmsPage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CmsPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $termsOfUse = '<div class="lm_term-title"> <h3>Welcome to PEEQ</h3> </div> <div class="lm_term-body text-dark"> <p class="mb-3">Welcome to PEEQ!</p> <p class="mb-3">This Terms of Use sets forth the Agreement between you and PEEQ, Inc. (“we” or “us”) regarding your use of our web service and mobile applications, specifically including each PEEQ Network you create or join (collectively the “Service”). Please read this Agreement, because it contains important information about your content (that you own), how information is shared between Hosts and Members, our limitation of liability to you, and your agreement to resolve any disputes by individual arbitration.</p> <p>If you cannot agree to these Terms of Use, don’t use the Service.</p> <h4>1.Using the Service</h4> <h5 class="mb-2">A. How It Works</h5> <p>Our service enables people to create or participate in a community, online courses, events, and subscriptions dedicated to an interest, passion, identity, or individual (a “PEEQ”) for free or for a fee. People who create a PEEQ (“Hosts”) do so to invite in people (“Members”) to connect with each other, to message, and to exchange information and content. Hosts tailor their PEEQ by adding their own branding, choosing which features they enable, the Members they invite, and the activities they organize in their PEEQ.</p> <h5 class="mb-2">B. Who can use PEEQ?</h5> <p>You must be at least the age of majority in the state or country where you live to create or participate in a PEEQ.</p> <h5 class="mb-2">C. Registration</h5> <p> You will set up an account with each PEEQ you join and participate in. When you set up a profile with any PEEQ, we treat registration information according to our <b>Privacy Policy.</b> Your name and contact information will be made available to your Host. You are responsible for maintaining the confidentiality of your password.</p> <h5 class="mb-2">D. Privacy</h5> <p class="mb-0">Our privacy practices are set forth in our <b> Privacy Policy, which is part of this Agreement.</b> By joining a PEEQ, you are sharing personally identifiable information with your Host, other Members, and us.</p> </div>';

        $privacyPolicy = '<div class="lm_term-title"> <h3>Welcome to PEEQ</h3> </div> <div class="lm_term-body text-dark"> <p class="mb-3">PEEQ is a Service of PEEQ Software. Inc. All visitors to our Service (“Visitors”) who register with the Service and join a PEEQ are Members or Hosts. Hosts are the organizers of PEEQ. Members register and participate in PEEQ. Hosts decide who can join their PEEQ and whether they choose paid Member subscriptions on their PEEQ. This Privacy Policy describes how we, PEEQ Software, Inc., obtain and use information about you and your visits to our website at mightynetworks.com and your participation in a PEEQ and your use of PEEQ mobile applications. To offer the personalized experience of a PEEQ, we collect personal information about you (“Personal Data”). This policy describes how we collect, use, and share your Personal Data with your Host and other Members in connection with your use of the Service, including our mobile applications. Unless defined here, capitalized words have the same meaning as in the <b>PEEQ Terms of Use,</b> which this Privacy Policy is part of.</p> <p>For residents of California, the EU, EEA or the UK, the<b> California Privacy Notice</b> and <b>EU/ EEA/ UK Privacy</b> Notice supplement and form part of this Privacy Policy.</p> <h4>1. Information we collect and how we use it</h4> <p class="mb-2">When you visit our website, join or create a Network, interact with us or your Host through the Service, or use our mobile applications, we, as the service provider for your Host, collect Personal Data and other information from you (collectively, “Data”). We use your Personal Data to be able to provide the Service to you:</p> <ul> <li>We collect Personal Data when you share it voluntarily.</li> <li>We collect some Personal Data automatically when you visit our website, use the Service or use our PEEQ mobile applications.</li> <li>We and your Hosts use your Personal Data to provide and improve the Service, understand how you and other Members are using PEEQ and to inform you about products and services that may be of interest to you.</li> <li>Data does not include Your Content or User Generated Content. As we explain in our Terms of Use, you (and the people you license Your Content from) keep complete ownership of all Your Content. By posting Your Content on the Service, you grant us a license to use it, but you and your licensors still own it.</li> </ul> <h5 class="mb-2">A. Personal Data you provide directly</h5> <p class="mb-2"><b>‘Personal Data or Personal Information’ </b>means any information relating to you from which you can be identified, directly or indirectly, including your name, identification number, location, online identifier such as your IP address or device ID, or one or more factors specific to your physical, physiological, genetic, mental, economic, cultural or social identity.</p> <p class="mb-2"><b>‘Special Categories of Personal Data’ </b>means data revealing your racial or ethnic origin, political opinions, religious or philosophical beliefs, or trade union membership, and data concerning your health, sex life or sexual orientation. </p> <p class="mb-2"><b>‘Aggregated Data’ </b>is data in a summary form for statistical analysis. A common purpose of aggregation is to get more information about particular groups based on specific variables such as age, profession, or income level.</p> </div>';
        
        CmsPage::create([
            'description' => $termsOfUse,
            'type' => 'terms_of_use',
        ]);

        CmsPage::create([
            'description' => $privacyPolicy,
            'type' => 'privacy_policy',
        ]);
    }
}
