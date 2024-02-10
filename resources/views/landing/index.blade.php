@extends('layouts.landing.master')
@section('content')

  <!--========= Hero START  =========-->
  <section class="main__page__content">
    <div class="lm__hero--section home-banner">
      <div class="lm__hero--inn-box">
        <div class="container">
          <div class="hero-main-box align-items-center">
            <div class="hero-left-box">
              <div class="hero-left-inn-box">
                <div class="hero-img-box position-relative">
                  <!-- Hero slider -->
                  <div
                    class="d-none mySwiper-hero swiper swiper-container swiper-full-mobile swiper-container-initialized swiper-container-horizontal">
                    <div class="swiper-wrapper">
                      <!-- <div class="swiper-slide">
                        <div class="swiper-img-slide">
                          <img src="assets/images/slider_img1.png" alt="">
                        </div>
                      </div> -->
                      <div class="swiper-slide">
                        <div class="swiper-img-slide">
                          <img src="{{ asset('landing/assets/images/nslider1.jpg') }}" alt="">
                        </div>
                      </div>
                      <div class="swiper-slide">
                        <div class="swiper-img-slide">
                          <img src="{{ asset('landing/assets/images/nslider2.jpg') }}" alt="">
                        </div>
                      </div>
                      <div class="swiper-slide">
                        <div class="swiper-img-slide">
                          <img src="{{ asset('landing/assets/images/nslider3.jpg') }}" alt="">
                        </div>
                      </div>
                      <div class="swiper-slide">
                        <div class="swiper-img-slide">
                          <img src="{{ asset('landing/assets/images/nslider4.jpg') }}" alt="">
                        </div>
                      </div>
                      <div class="swiper-slide">
                        <div class="swiper-img-slide">
                          <img src="{{ asset('landing/assets/images/nslider5.jpg') }}" alt="">
                        </div>
                      </div>
                      <div class="swiper-slide">
                        <div class="swiper-img-slide">
                          <img src="{{ asset('landing/assets/images/nslider6.jpg') }}" alt="">
                        </div>
                      </div>
                      <div class="swiper-slide">
                        <div class="swiper-img-slide">
                          <img src="{{ asset('landing/assets/images/nslider7.jpg') }}" alt="">
                        </div>
                      </div>
                      <div class="swiper-slide">
                        <div class="swiper-img-slide">
                          <img src="{{ asset('landing/assets/images/nslider8.jpg') }}" alt="">
                        </div>
                      </div>
                      <div class="swiper-slide">
                        <div class="swiper-img-slide">
                          <img src="{{ asset('landing/assets/images/nslider9.jpg') }}" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="vedio_wrap-ab">
                    <!-- <video src="assets/images/peeq_welcome.mp4"></video> -->
                    {{-- <video controls poster="" >
                      <source src="{{ asset('landing/assets/images/peeq_welcome.mp4') }}" type="video/mp4">
                      <source src="{{ asset('landing/assets/images/peeq_welcome.mp4') }}" type="video/ogg">
                    </video> --}}
                    <!-- Video Container -->
                    <div id="video-container">
                      <!-- Video Thumbnail -->
                      <div id="thumbnail" onclick="toggleVideo()">
                        <img class="thumb" src="{{ asset('landing/assets/images/thumbnail-vdo.png') }}" alt="Video Thumbnail" >
                        <img class="thumb_btn" src="{{ asset('landing/assets/images/play-1.svg') }}" alt="">
                      </div>
                      
                      <!-- Video Element -->
                      <video id="myVideo" controls>
                          <source src="{{ asset('landing/assets/images/peeq_welcome.mp4') }}" type="video/mp4">
                      </video>
                    </div>

                  </div>
                  <!-- <img src="assets/images/mobile.png" alt=""> -->
                </div>
              </div>
            </div>
            <div class="hero-right-box">
              <div class="hero-right-con-box">
                <h1>PEEQ<sup class="super_text">TM</sup></h1>
                <p>Performance Elevation <br>through EQ </p>
                <div class="btn btn-link hero-right-btn align-items-center d-inline-flex gap-3" data-bs-toggle="modal" data-bs-target="#login-signup">
                  <a href="#" class="text-decoration-none text-white">Join Peeq<sup class="super_text1">TM </sup> <span
                      class="ms-1"> Network</span> <br><small>12 Months Free Subscription!</small></a>
                  <span>
                    <img src="{{ asset('landing/assets/images/arrow-angle-right-circle.svg') }}" alt="">
                  </span>
                </div>

                <div class="google-img">
                  <div class="google-inn-box">
                    <div class="google-play">
                      <a href="https://play.google.com/store/apps/details?id=au.com.peeq&pli=1" target="_blank"><img
                          src="{{ asset('landing/assets/images/play.png') }}" alt="" ></a>
                    </div>
                    <div class="google-play">
                      <a href="https://apps.apple.com/us/app/peeq/id6458190160" target="_blank"><img src="{{ asset('landing/assets/images/app.png')}}"
                          alt=""></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </section>
  <!--========= Hero END =========-->
  
  <!--========= Video START =========-->
  <section class="about_main py-5 position-relative lm__hero--section ">
    <div class="container">
      <div class="row align-items-center g-4">
        <div class="col-lg-6 order-1">
          <div class="about_wrapper text-white pe-lg-5">
            <h2 class="fw-bold primary mb-3">About PEEQ™</h2>
            <!-- <h2 class="fw-bold mb-3">About PEEQ</h2> -->
            <p>PEEQ™ - Performance Elevation through EQ. <br /> PEEQ™ is a digital space for leaders looking to elevate
              their emotional intelligence, uplift corporate culture and create real change within their organisations.
              This private network connects, coaches and supports you through your leadership journey. A source of
              leadership coaching and development - in your pocket.
            </p>
          </div>
        </div>
        <div class="col-lg-6 order-lg-1">
          <div class="monitor_wrap">
            <!-- <img src="assets/images/monitor.png" alt=""> -->
            <div class="about_vedio-wrap">
              <div class="frame-wrap pt-0">
                  <div class="vedio_wrap-ab d-none">
                    <video controls>
                      <source src="{{ asset('landing/assets/images/peeq_welcome.mp4') }}" type="video/mp4">
                      <source src="{{ asset('landing/assets/images/peeq_welcome.mp4') }}" type="video/ogg">
                    </video>
                  </div>
                  <div class="hero-left-box">
                    <div class="hero-left-inn-box">
                      <div class="hero-img-box position-relative">
                        <!-- Hero slider -->
                        <img src="{{ asset('landing/assets/images/fmobile.png') }}" class="mob_frame" />
                        <div
                          class="mySwiper-hero swiper swiper-container swiper-full-mobile swiper-container-initialized swiper-container-horizontal">
                          <div class="swiper-wrapper">
                            <!-- <div class="swiper-slide">
                              <div class="swiper-img-slide">
                                <img src="assets/images/slider_img1.png" alt="">
                              </div>
                            </div> -->
                            <div class="swiper-slide">
                              <div class="swiper-img-slide">
                                <img src="{{ asset('landing/assets/images/nslider1.jpg') }}" alt="">
                              </div>
                            </div>
                            <div class="swiper-slide">
                              <div class="swiper-img-slide">
                                <img src="{{ asset('landing/assets/images/nslider2.jpg') }}" alt="">
                              </div>
                            </div>
                            <div class="swiper-slide">
                              <div class="swiper-img-slide">
                                <img src="{{ asset('landing/assets/images/nslider3.jpg') }}" alt="">
                              </div>
                            </div>
                            <div class="swiper-slide">
                              <div class="swiper-img-slide">
                                <img src="{{ asset('landing/assets/images/nslider4.jpg') }}" alt="">
                              </div>
                            </div>
                            <div class="swiper-slide">
                              <div class="swiper-img-slide">
                                <img src="{{ asset('landing/assets/images/nslider5.jpg') }}" alt="">
                              </div>
                            </div>
                            <div class="swiper-slide">
                              <div class="swiper-img-slide">
                                <img src="{{ asset('landing/assets/images/nslider6.jpg') }}" alt="">
                              </div>
                            </div>
                            <div class="swiper-slide">
                              <div class="swiper-img-slide">
                                <img src="{{ asset('landing/assets/images/nslider7.jpg') }}" alt="">
                              </div>
                            </div>
                            <div class="swiper-slide">
                              <div class="swiper-img-slide">
                                <img src="{{ asset('landing/assets/images/nslider8.jpg') }}" alt="">
                              </div>
                            </div>
                            <div class="swiper-slide">
                              <div class="swiper-img-slide">
                                <img src="{{ asset('landing/assets/images/nslider9.jpg') }}" alt="">
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- <img src="assets/images/mobile.png" alt=""> -->
                      </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--========= Video END =========-->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        var video = document.getElementById('myVideo');
        var thumbnail = document.getElementById('thumbnail');

        // Click on the thumbnail to play/pause the video
        thumbnail.addEventListener('click', function() {
            if (video.paused) {
                video.play();
            } else {
                video.pause();
            }
        });

        // Show the thumbnail again when the video is paused
        video.addEventListener('pause', function() {
            thumbnail.style.display = 'block';
        });

        // Hide the thumbnail when the video is played
        video.addEventListener('play', function() {
            thumbnail.style.display = 'none';
        });
    });
   </script>
@endsection
