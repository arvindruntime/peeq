@extends('layouts.admin.master')
@section('content')
<link href="https://assets.calendly.com/assets/external/widget.css" rel="stylesheet">
<main class="main-content" id="main">
  <section class="lm__dash-con lm__course-buy mb-5 lm_session-details">
    <span class="lm_vec"><img class="light"
      src="assets/images/light.png" alt=""><img class="dark" src="assets/images/dark.png" alt=""></span>
    <div class="container">
      <div class="row lm__course-buy-main">
        {{-- Details --}}
        <div class="col-md-7 col-lg-8 col-xxl-8">
          <div class="lm__course-buy-inner">
            <div class="lm_course-buy-con">
              <div class="lm_course-buy-card card bg-gradient">
                <h2 class="fw-bold text-white">Self Mastery Program</h2>
                <h6 class="text-white">Elevate your emotional intelligence, self-awareness and leadership skills with
                  our Self Mastery online program.</h6>

                <div class="d-flex align-items-end justify-content-between mt-2">
                  <div class="d-flex align-items-center gap-2"><span class="text-white title-font">Coaches</span>
                    <div class="avtar-group mt-1">
                      <div class="avtar-55"><img src="{{asset('assets/images/ev1.jpg')}}" alt=""></div>
                      <div class="avtar-55"><img src="{{asset('assets/images/ev2.jpg')}}" alt=""></div>
                      <div class="avtar-55"><img src="{{asset('assets/images/ev3.jpg')}}" alt=""></div>
                    </div>
                  </div>
                  <p class="mb-0 text-white">Last updated 2/2023</p>
                </div>
              </div>
              <div class="lm__view-tab">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                  <li class="nav-item" role="presentation"><button class="nav-link active"
                      id="pills-sessionmaterial-tab" data-bs-toggle="pill" data-bs-target="#pills-sessionmaterial"
                      type="button" role="tab" aria-controls="pills-sessionmaterial" aria-selected="true">Description</button></li>
                  <li class="nav-item" role="presentation"><button class="nav-link" id="pills-coaches-tab"
                      data-bs-toggle="pill" data-bs-target="#pills-coaches" type="button" role="tab"
                      aria-controls="pills-coaches" aria-selected="false">Coaches</button></li>
                </ul>
              </div>
              <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-sessionmaterial" role="tabpanel"
                  aria-labelledby="pills-sessionmaterial-tab" tabindex="0">
                  <div class="lm_course-buy-card card border-0 p-30">
                    <h5 class="fw-bold">Description</h5>
                    <h6 class="color-light">The Self Mastery Program is designed to be self directed and we encourage
                      you to take as much time as you need to process, reflect and implement the tools you learn into
                      your leadership practice and daily life.</h6>
                    <h6 class="color-light">This program is designed to help you create a work environment where you
                      and your team's feel empowered to self-lead.</h6>
                    <h6 class="color-light">The PEEQ Self Mastery Program will help you elevate your self
                      awareness at a belief system level. This will allow you to see how your beliefs, values and
                      consumption habits are currently influencing your behaviour and leadership.</h6>
                    <h6 class="color-light">Self Awareness allows us to choose our behaviour, this gives us freedom
                      from the constraints of ourselves. We are then able to help free other people from their
                      limiting constraints unlocking value and potential in others.</h6>
                  </div>
                  
                </div>
                <div class="tab-pane fade" id="pills-coaches" role="tabpanel" aria-labelledby="pills-coaches-tab"
                  tabindex="0">
                  <div class="lm__member-card mb-3">
                    <div class="card shadow p-3 border-0">
                      <div class="d-sm-flex flex-wrap align-items-center gap-2 justify-content-between">
                        <div class="d-flex align-items-center gap-2 mb-2 mb-sm-0">
                          <div class="avtar-xxl"><img class="rounded-circle position-relative"
                              src="{{asset('assets/images/member-1.jpg')}}" alt="">
                            <div class="avtar-active"></div>
                          </div>
                          <div class="d-block">
                            <h6 class="mb-0 text-dark" type="button" data-bs-toggle="offcanvas"
                              data-bs-target="#offcanvasRight10" aria-controls="offcanvasRight10"> Arlene McCoy</h6>
                            <p class="title-font mb-0">Host</p>
                          </div>
                        </div>
                        <div class="d-flex gap-3 align-items-center lm__member-btn"><a
                            class="btn btn--chat btn-follow active py-1 title-font px-3" href="#">Follow </a><a
                            class="btn btn--chat py-1 title-font px-3" href="#">Chat</a>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="lm__member-card mb-3">
                    <div class="card shadow p-3 border-0">
                      <div class="d-sm-flex flex-wrap align-items-center gap-2 justify-content-between">
                        <div class="d-flex align-items-center gap-2 mb-2 mb-sm-0">
                          <div class="avtar-xxl"><img class="rounded-circle position-relative"
                              src="{{asset('assets/images/member-2.jpg')}}" alt=""></div>
                          <div class="d-block">
                            <h6 class="mb-0 text-dark" type="button" data-bs-toggle="offcanvas"
                              data-bs-target="#offcanvasRight10" aria-controls="offcanvasRight10"> Albert Flores</h6>
                            <p class="title-font mb-0">Member</p>
                          </div>
                        </div>
                        <div class="d-flex gap-3 align-items-center lm__member-btn"><a
                            class="btn btn--chat btn-follow active py-1 title-font px-3" href="#">Follow </a><a
                            class="btn btn--chat py-1 title-font px-3" href="#">Chat</a>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="lm__member-card mb-3">
                    <div class="card shadow p-3 border-0">
                      <div class="d-sm-flex flex-wrap align-items-center gap-2 justify-content-between">
                        <div class="d-flex align-items-center gap-2 mb-2 mb-sm-0">
                          <div class="avtar-xxl"><img class="rounded-circle position-relative"
                              src="{{asset('assets/images/member-3.jpg')}}" alt=""></div>
                          <div class="d-block">
                            <h6 class="mb-0 text-dark" type="button" data-bs-toggle="offcanvas"
                              data-bs-target="#offcanvasRight10" aria-controls="offcanvasRight10"> Savannah Nguyen
                            </h6>
                          </div>
                        </div>
                        <div class="d-flex gap-3 align-items-center lm__member-btn"><a
                            class="btn btn--chat btn-follow py-1 title-font px-3" href="#">Following </a><a
                            class="btn btn--chat py-1 title-font px-3" href="#">Chat</a>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        {{-- Slot --}}
        <div class="col-md-5 col-lg-4 col-xxl-4 ps-xxl-0 mt-3 mt-xxl-0 mt-md-0">
          <div class="lm_vedio-card card">
            <div class="card-img position-relative">
              {{-- Uploaded image here --}}
              <img class="w-100" src="{{asset('assets/images/courses3.jpg')}}" alt="">
              {{-- When only image upload add in below d-none --}}
              <div class="card-img-overlay">
                <div class="d-flex justify-content-center align-items-center text-center h-100"><a class="play-video"
                    href="" data-bs-toggle="modal" data-bs-target="#session_video-preview"><img class="in-svg"
                      src="{{asset('assets/images/play-1.svg')}}" alt="">
                    <h6 class="text-white">Preview</h6>
                  </a></div>
              </div>
            </div>
            {{-- Button --}}
            <div class="card-body p-0 pt-2">
              <h4 class="mb-2"> <a class="text-dark" href="#">Self Mastery Program </a></h4>
              <h6>Session duration</h6>
              <div class="">
                <div class="lm_slot-min d-flex mb-3 flex-wrap">
                  <input type="radio" class="btn-check" name="options-base" id="option5" autocomplete="off" checked>
                  <label class="btn min_slot" for="option5">30 Minutes</label>

                  <input type="radio" class="btn-check" name="options-base" id="option6" autocomplete="off">
                  <label class="btn min_slot" for="option6">60 Minutes</label>

                  <input type="radio" class="btn-check" name="options-base" id="option7" autocomplete="off">
                  <label class="btn min_slot" for="option7">90 Minutes</label>

                  <input type="radio" class="btn-check" name="options-base" id="option8" autocomplete="off">
                  <label class="btn min_slot" for="option8">120 Minutes</label>
                </div>
                <p class="text-center text-dark">30 Min / Day:$ 500</p>
              </div>
              <div class="d-flex gap-2"><a class="btn btn--primary d-block w-100 py-2" href="" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bookmy_session"><span class="gap-2">Pay Now</span></a>
                <div class="lm__share">
                  <div class="d-flex gap-2">
                    <span><a href="#" type="button" data-bs-toggle="offcanvas" data-bs-target="#courseshare" aria-controls="courseshare" class="" href="#"> <img class="in-svg" src="{{asset('assets/images/share.svg')}}" alt=""></a></span>
                    <span><a href="#"> <img class="in-svg" src="{{asset('assets/images/download.svg')}}" alt=""></a></span>
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
<!-- Course Invite -->
<div class="offcanvas offcanvas-end lm_profile-modal lm_create-modal" id="courseshare" tabindex="-1"
  aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasRightLabel">Skip</h5><button class="btn-close" type="button"
      data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <form name="send_inviteCourseForm" id="send_inviteCourseForm">
  <div class="offcanvas-body p-0">
    <div class="lm_profile-modal p-2">
      <div class="row align-items-center">
        <div class="col-12 text-center">
          <h5 class="text-white mb-0">Invite</h5>
        </div>
      </div>
    </div>
    <div class="lm_create-body invite-body" style="overflow: auto; max-height: 85vh;">
      <div class="lm_in-mem">
        <h5 class="text-center fw-bold">Invite Members</h5>
        <div class="input-group mb-3 invite-input rounded-5 shadow">
          <input class="form-control courseViewUrl" type="text" aria-label="Recipient's username" aria-describedby="button-addon2">
          <button class="btn btn--dark py-1 rounded-5" onclick="copyCourseViewUrl()">Copy Link</button>
        </div>
      </div>
      <div class="lm_in-mail">
        <h5 class="text-center fw-bold">Invite by Email</h5>
        <div class="mb-3"> 
            {{-- <input class="form-control shadow" type="text" placeholder="Add multiple email addresses here"> --}}
            <input name="invite_emailsCourse" class="form-control shadow" type="text" placeholder="Add multiple emails here separated by comma.">
            <span class="help-block print-error-msg" style="color: red;">
              <ul>
                  <li></li>
              </ul>
          </span>
        </div>
        <div class="bg-white shadow lm_msg mb-3">
          <div class="d-flex gap-3">
            <div class="avtar-30"><img src="{{asset('assets/images/logo2.svg') }}" alt=""></div>
            <div class="d-block">
                <textarea rows="4" cols="100" name="message" id="message" placeholder="Additional messages here if Any...."></textarea>
            </div>
          </div>
        </div>
        <div class="d-block">
          <p class="text-sm-12 mb-0 fw-bold">NETWORK PERMISSIONS</p>
          <p class="mb-0 color-light">Choose what permissions these members will have in PEEQ.</p>
        </div>
        <div class="d-flex mt-3 justify-content-between">
          <div class="lm_post-input-emoji mb-2 me-3">
            
            <select class="form-select form-control js-example-basic-single" id="select_boxCourse" name="user_typeCourse">
                <option value="host">Invite as host</option>
                <option value="coach">Invite as Coach</option>
                <option value="member" selected>Invite as Member</option>
            </select>
            
        </div>
        <div class="lm_send"> <button class="btn btn--primary" id="send_inviteCourse">Send</button></div>
                            
                            
            {{-- <select class="form-select form-control"
              id="select_box9">
              <option>Invite as host</option>
              <option value="a">Invite as Maderators</option>
              <option value="c">Invite as Member</option>
            </select></div>
          <div class="lm_send"> <button class="btn btn--primary">Send</button></div> --}}
        </div>
      </div>
    </div>
  </div>
  </form>
</div>

{{-- Modal --}}
<div class="modal fade" id="bookmy_session" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered lm__modal-4 book_session">
    <div class="modal-content overflow-hidden">
      <div class="modal-body p-4 text-center position-relative">
          <div class="modal-header p-0"><button class="btn-close" type="button" data-bs-dismiss="modal"
                  aria-label="Close"><span> <img class="in-svg" src="{{asset('assets/images/close.svg')}}"
                          alt=""></span></button></div>
          <div class="z-index-1 position-relative lm_mxw50">
              <h5 class="fw-bold">Your 1:1 coaching session with Zoe Williams has been successfully secured</h5>
              <p class="text-dark">We invite you to schedule your session with the coach via Calendly. Should you encounter any scheduling challenges, please do not hesitate to contact us directly at <a href="#" class="text-primary">support@peeq.com.au</a>, and we will gladly assist in rearranging your appointment.</p>
          </div>
          {{-- Second popup btn --}}
          <div>
            <a class="btn btn--primary rounded-5" data-bs-dismiss="modal"
            aria-label="Close" href="" onclick="Calendly.initPopupWidget({url: 'https://calendly.com/yashpatel-coderkube/30min'});return false;">Book My Session</a>
            {{-- <button class="btn btn--primary rounded-5" data-bs-target="#calandly_modal" data-bs-toggle="modal">Book My Session</button> --}}
          </div>
      </div>
    </div>
  </div>
</div>
{{-- Modal --}}
<div class="modal fade" id="session_video-preview" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered lm__modal-4 session_preview">
    <div class="modal-content overflow-hidden">
      <div class="modal-body p-4 text-center position-relative">
          {{-- <div class="modal-header p-0"><button class="btn-close" type="button" data-bs-dismiss="modal"
                  aria-label="Close"><span> <img class="in-svg" src="{{asset('assets/images/close.svg')}}"
                          alt=""></span></button></div> --}}
          <div class="z-index-1 position-relative lm_mxw50">
            <video controls poster="" >
              <source src="{{ asset('assets/images/about.mp4') }}" type="video/mp4">
              <source src="{{ asset('assets/images/about.mp4') }}" type="video/ogg">
          </video>
          </div>
          {{-- Second popup btn --}}
          <div>
            <a class="btn btn--primary rounded-5 mt-3" data-bs-dismiss="modal"
            aria-label="Close" href="">Continue</a>
            {{-- <button class="btn btn--primary rounded-5" data-bs-dismiss="modal"
            aria-label="Close">Continue</button> --}}
          </div>
      </div>
    </div>
  </div>
</div>

@endsection