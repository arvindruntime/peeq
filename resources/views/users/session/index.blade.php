@extends('layouts.admin.master')
@section('content')

<main class="main-content" id="main">
  <section class="lm__dash-con lm__course-list lm__list-after-pay lm_session-list">
    <span class="lm_vec"><img class="light"
      src="assets/images/light.png" alt=""><img class="dark" src="assets/images/dark.png" alt=""></span>
      <div class="container">
        <div class="row">
          <div class="col-xxl-10">
            <div class="lm__course">
              <div class="lm__course-title">
                <div class="d-flex justify-content-between">
                  <h4 class="text-primary fw-semibold">PEEQ Courses</h4>
                </div>
              </div>
              <div class="lm__course-tab">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                  <li class="nav-item" role="presentation"><button class="nav-link active" id="pills-all-tab"
                      data-bs-toggle="pill" data-bs-target="#pills-all-session" type="button" role="tab"
                      aria-controls="pills-all-session" aria-selected="true">All</button></li>
                  <li class="nav-item" role="presentation"><button class="nav-link" id="pills-purchased-tab-session"
                      data-bs-toggle="pill" data-bs-target="#pills-purchased-session" type="button" role="tab"
                      aria-controls="pills-purchased-session" aria-selected="false">purchased</button></li>
                </ul>
              </div>
              <div class="lm_course-con">
                <div class="tab-content" id="pills-tabContent">
                  <div class="tab-pane fade show active" id="pills-all-session" role="tabpanel" aria-labelledby="pills-all-tab"
                    tabindex="0">
                    <div class="row gap-4 gap-md-0">
                      <div class="col-md-6 lg">
                        <div class="lm_course-card card border-0 shadow">
                          <div class="card-img position-relative"><img src="{{asset('assets/images/courses2.jpg')}}" alt="">
                            <!-- <div class="position-absolute top-0 end-0 mt-2 me-2"><span
                                class="fw-normal badge bg-primary text-sm-16 rounded-4 title-font">Purchased</span>
                            </div> -->
                          </div>
                          <div class="card-body px-0 pb-0">
                            <div class="d-flex align-items-center gap-2 mb-2">
                              <h4 class="mb-0"> <a class="text-dark" href="#">Self Mastery Program</a></h4>
                            </div>
                            <p class="mb-2">The Self Mastery Program is designed to be self directed and we encourage
                              you to take as much time as you need to process, reflect and implement the tools you learn
                              into your leadership practice and daily life.</p>
                            <div class="d-flex align-items-end justify-content-between">
                              
                              <div class="d-flex align-items-end gap-2 w-100">
                                <div class="d-block">
                                  <span class="text-dark title-font">Coaches</span>
                                  <div class="avtar-group mt-1">
                                    <div class="avtar-55"><img src="{{ asset('assets/images/ev1.jpg') }}" alt=""></div>
                                    <div class="avtar-55"><img src="{{ asset('assets/images/ev2.jpg') }}" alt=""></div>
                                    <div class="avtar-55"><img src="{{ asset('assets/images/ev3.jpg') }}" alt=""></div>
                                  </div>
                                </div>
                                {{-- Button --}}
                                <div class="w-100">
                                  <a class="btn btn--primary py-2 w-100" href="#">View Session </a>
                                </div>
                                <span class="lm_pen" data-bs-toggle="tooltip" data-bs-original-title="Share The Session">
                                  <a type="button" data-bs-toggle="offcanvas" data-bs-target="#courseshare" aria-controls="courseshare" class="" href="#"><img class="in-svg"  src="{{ asset('assets/images/share.svg') }}" alt=""></a>
                                </span>
                                <span class="lm_pen" data-bs-toggle="tooltip" data-bs-original-title="Download PDF Brochure"><a class="" href="#"><img class="in-svg"  src="{{ asset('assets/images/download.svg') }}" alt=""></a></span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6 lg">
                        <div class="lm_course-card card border-0 shadow">
                          <div class="card-img position-relative"><img src="{{asset('assets/images/courses2.jpg')}}" alt="">
                            <!-- <div class="position-absolute top-0 end-0 mt-2 me-2"><span
                                class="fw-normal badge bg-primary text-sm-16 rounded-4 title-font">Purchased</span>
                            </div> -->
                          </div>
                          <div class="card-body px-0 pb-0">
                            <div class="d-flex align-items-center gap-2 mb-2">
                              <h4 class="mb-0"> <a class="text-dark" href="#">Self Mastery Program</a></h4>
                            </div>
                            <p class="mb-2">The Self Mastery Program is designed to be self directed and we encourage
                              you to take as much time as you need to process, reflect and implement the tools you learn
                              into your leadership practice and daily life.</p>
                            <div class="d-flex align-items-end justify-content-between">
                              
                              <div class="d-flex align-items-end gap-2 w-100">
                                <div class="d-block">
                                  <span class="text-dark title-font">Coaches</span>
                                  <div class="avtar-group mt-1">
                                    <div class="avtar-55"><img src="{{ asset('assets/images/ev1.jpg') }}" alt=""></div>
                                    <div class="avtar-55"><img src="{{ asset('assets/images/ev2.jpg') }}" alt=""></div>
                                    <div class="avtar-55"><img src="{{ asset('assets/images/ev3.jpg') }}" alt=""></div>
                                  </div>
                                </div>
                                {{-- Button --}}
                                <div class="w-100">
                                  <a class="btn btn--primary py-2 w-100" href="#">View Session </a>
                                </div>
                                  <span class="lm_pen" data-bs-toggle="tooltip" data-bs-original-title="Share The Session">
                                    <a type="button" data-bs-toggle="offcanvas" data-bs-target="#courseshare" aria-controls="courseshare" class="" href="#">
                                      <img class="in-svg"  src="{{ asset('assets/images/share.svg') }}" alt="">
                                    </a>
                                  </span>
                                  <span class="lm_pen" data-bs-toggle="tooltip" data-bs-original-title="Download PDF Brochure">
                                    <a href="#">
                                      <img class="in-svg"  src="{{ asset('assets/images/download.svg') }}" alt="">
                                    </a>
                                  </span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="pills-purchased-session" role="tabpanel" aria-labelledby="pills-purchased-tab"
                    tabindex="0">
                    <div class="row gap-4 gap-md-0">
                      <div class="col-md-6 lg">
                        <div class="lm_course-card card border-0 shadow">
                          <div class="card-img position-relative"><img src="{{asset('assets/images/courses2.jpg')}}" alt="">
                            <!-- <div class="position-absolute top-0 end-0 mt-2 me-2"><span
                                class="fw-normal badge bg-primary text-sm-16 rounded-4 title-font">Purchased</span>
                            </div> -->
                          </div>
                          <div class="card-body px-0 pb-0">
                            <div class="d-flex align-items-center gap-2 mb-2">
                              <h4 class="mb-0"> <a class="text-dark" href="#">Self Mastery Program</a></h4>
                            </div>
                            <p class="mb-2">The Self Mastery Program is designed to be self directed and we encourage
                              you to take as much time as you need to process, reflect and implement the tools you learn
                              into your leadership practice and daily life.</p>
                            <div class="d-flex align-items-end justify-content-between">
                              
                              <div class="d-flex align-items-end gap-2 w-100">
                                <div class="d-block">
                                  <span class="text-dark title-font">Coaches</span>
                                  <div class="avtar-group mt-1">
                                    <div class="avtar-55"><img src="{{ asset('assets/images/ev1.jpg') }}" alt=""></div>
                                    <div class="avtar-55"><img src="{{ asset('assets/images/ev2.jpg') }}" alt=""></div>
                                    <div class="avtar-55"><img src="{{ asset('assets/images/ev3.jpg') }}" alt=""></div>
                                  </div>
                                </div>
                                {{-- Button --}}
                                <div class="w-100">
                                  <a class="btn btn--primary py-2 w-100" href="#">View Session </a>
                                </div>
                                <span class="lm_pen" data-bs-toggle="tooltip" data-bs-original-title="Share The Session">
                                  <a type="button" data-bs-toggle="offcanvas" data-bs-target="#courseshare" aria-controls="courseshare" class="" href="#">
                                    <img class="in-svg"  src="{{ asset('assets/images/share.svg') }}" alt="">
                                  </a>
                                </span>
                                <span class="lm_pen" data-bs-toggle="tooltip" data-bs-original-title="Download PDF Brochure">
                                  <a href="#">
                                    <img class="in-svg"  src="{{ asset('assets/images/download.svg') }}" alt="">
                                  </a>
                                </span>
                              </div>
                            </div>
                          </div>
                        </div>
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

@endsection