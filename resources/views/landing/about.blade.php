@extends('layouts.landing.master')
@section('content')

<!--========= Hero START  =========-->
<section class="main__page__content position-relative">
    <div class="lm__hero--section home-banner position-relative">
      <div class="lm__hero--inn-box lm_about-hero">
        <div class="new-bg-video">
        </div>
      </div>
      <div class="about_hero-wrap">
        <div class="container">
          <div class="row">
            <div class="col-12  text-center">
              <h1 class="fw-bold text-white text-uppercase">About PEEQ™</h1>
            </div>
          </div>
        </div>
      </div>
  </section>
  <!--========= Hero END =========-->

  <!--========= Video START =========-->
  <section class="about_main py-5 position-relative who_we-are">
    <div class="container">
      <div class="row align-items-center g-4">
        <div class="col-lg-6 order-1">
          <div class="about_wrapper text-white pe-lg-5">
            <h3 class="fw-bold primary">Why PEEQ™</h3>
            <!-- <h2 class="fw-bold mb-3">About PEEQ</h2> -->
            <p>Unite with global leaders on PEEQ™, an unparalleled platform dedicated to fostering emotional intelligence and transforming corporate culture. Experience a collaborative learning environment that offers exclusive perks such as group coaching, live discussions, and ongoing interactive exercises, all expertly curated and led by Zoe Williams and the Luminary Mindset™ coaching team. Elevate your leadership game – join now and become part of this extraordinary journey towards personal and professional growth!
          </p>
            <!-- <span class="text-primary about_line position-relative ps-5">Zoe Williams</span> -->
          </div>
        </div>
        <div class="col-lg-6 order-lg-1">
          <div class="monitor_wrap">
            <div class="about_vedio-wrap">
              <div class="frame-wrap wrap-first pt-0 rounded-3 text-center">
                <img class="img-fluid manufacturing-border-radius" width="50%" src="{{ asset('landing/assets/images/logo.svg') }}" alt="">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="about_main py-5 position-relative who_we-are pt-3">
    <div class="container">
      <div class="row align-items-center g-4">
        <div class="col-lg-6 order-lg-1">
          <div class="monitor_wrap">
            <div class="about_vedio-wrap">
              <div class="frame-wrap wrap-second pt-0 rounded-3 ">
                <img src="{{ asset('landing/assets/images/about-sec.png') }}" alt="">
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 order-1">
          <div class="about_wrapper text-white ps-lg-5">
            <h3 class="fw-bold primary">Online Programs</h3>
            <!-- <h2 class="fw-bold mb-3">About PEEQ</h2> -->
            <p>As a PEEQ™ member, you have the opportunity to enhance your emotional intelligence through various online programs, including the Luminary Mindset™ Self Mastery online course. <a href="{{ asset('landing/assets/pdf/PEEQ_BrochureNov23.pdf') }}" class="text-primary text-decoration-none" title="click to download" download >Download PEEQ™ Brochure Here</a></p>

            <p>Self Mastery is a comprehensive 12-module online program, crafted to enhance emotional intelligence, foster self-awareness, and address and overcome blind spots in leadership. Each phase of this self-guided initiative provides video and audio coaching, coupled with exercises in leadership and emotional intelligence, aimed at reshaping your belief systems to enhance your leadership capabilities.</p>
            <ul class="list-group about_lits">
              <p>Enrolling in Self Mastery offers you insights into:</p>
              <li class="list-group-item">• Essential emotional intelligence skills for heightened EQ</li>
              <li class="list-group-item">• Techniques to recognize and leverage your strengths</li>
              <li class="list-group-item">• Strategies to reform your limiting beliefs</li>
              <li class="list-group-item">• Methods to uncover blind spots affecting your EQ, and much more.</li>
            </ul>
            <!-- <span class="text-primary about_line position-relative ps-5"><a href="#" class="text-decoration-none text-primary">JOIN PEEQ™</a></span> -->
          </div>
        </div>
        
      </div>
    </div>
  </section>

  <section class="about_main py-5 position-relative who_we-are pt-3">
    <div class="container">
      <div class="row align-items-center g-4">
        <div class="col-lg-6 order-1">
          <div class="about_wrapper text-white pe-lg-5">
            <h3 class="fw-bold primary">Live Masterclasses & Group Coaching</h3>
            <!-- <h2 class="fw-bold mb-3">About PEEQ</h2> -->
            <p>Within the platform, you have the option to participate in monthly live Masterclasses led by Zoe Williams, delving into specific leadership topics. Join group coaching sessions tailored to address the concerns that resonate most with our members. Participate in interactive weekly content to advance your self-development journey and learning. Forge connections with an exclusive community of global leaders, all dedicated to enhancing corporate culture and boosting performance.
            </p>
            <!-- <span class="text-primary about_line position-relative ps-5">Zoe Williams</span> -->
          </div>
        </div>
        <div class="col-lg-6 order-lg-1">
          <div class="monitor_wrap">
            <div class="about_vedio-wrap">
              <div class="frame-wrap wrap-third pt-0 rounded-3 text-center">
                <img class="img-fluid manufacturing-border-radius" src="{{ asset('landing/assets/images/aboutimg.png') }}" alt="">
              </div>
            </div>
          </div>
        </div>
        
      </div>
      <div class="row mt-5">
        <div class="col-12 text-center">
          <a href="#" class="btn btn-primary Join-btn" data-bs-toggle="modal" data-bs-target="#login-signup"> Join PEEQ™</a>
        </div>
      </div>
    </div>
  </section>
  <!--========= Video END =========-->

@endsection