@extends('layouts.admin.master')
@section('content')
<main class="main-content" id="main">
  <section class="lm__dash-con lm__course-buy mb-5 lm__view-after-pay"><span class="lm_vec"><img class="light"
        src="{{asset('assets/images/light.png')}}" alt=""><img class="dark" src="{{asset('assets/images/dark.png')}}" alt=""></span>
    <div class="container">
      <div class="row lm__course-buy-main">
        <div class="col-md-7 col-lg-12 col-xxl-8">
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
                      id="pills-coursematerial-tab" data-bs-toggle="pill" data-bs-target="#pills-coursematerial"
                      type="button" role="tab" aria-controls="pills-coursematerial" aria-selected="true">Course
                      Material</button></li>
                  <li class="nav-item" role="presentation"><button class="nav-link" id="pills-coaches-tab"
                      data-bs-toggle="pill" data-bs-target="#pills-coaches" type="button" role="tab"
                      aria-controls="pills-coaches" aria-selected="false">Coaches</button></li>
                </ul>
              </div>
              <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-coursematerial" role="tabpanel"
                  aria-labelledby="pills-coursematerial-tab" tabindex="0">
                  <div class="lm_course-buy-card card bg-gradient-gray border-0">
                    <h5>Course Material</h5>
                    <!-- <p class="mb-2">46 Modules • 42h 34m total length</p> -->
                    <div class="list-group video-list"><a class="list-group-item list-group-item-action ps-0 py-0"
                        href="" aria-current="true">
                        <div class="d-flex align-items-center justify-content-between">
                          <div class="d-flex align-items-center gap-2 p-3">
                            <!-- <div class="video-bg"><img class="in-svg" src="{{asset('assets/images/play1.svg')}}" alt=""></div> -->
                            <p class="mb-0">Welcome To Your Self Mastery Journey</p>
                          </div>
                          <!-- <span class="text-sm-12 color-light">30:25</span> -->
                        </div>
                      </a><a class="list-group-item list-group-item-action ps-0 py-0" href="#" aria-current="true">
                        <div class="d-flex align-items-center justify-content-between">
                          <div class="d-flex align-items-center gap-2 p-3">
                            <!-- <div class="video-bg"><img class="in-svg" src="{{asset('assets/images/play1.svg')}}" alt=""></div> -->
                            <p class="mb-0">How To Get The Most Out Of This Program</p>
                          </div>
                          <!-- <span class="text-sm-12 color-light">10:25</span> -->
                        </div>
                      </a><a class="list-group-item list-group-item-action ps-0 py-0" href="#" aria-current="true">
                        <div class="d-flex align-items-center justify-content-between">
                          <div class="d-flex align-items-center gap-2 p-3">
                            <!-- <div class="video-bg"><img class="in-svg" src="{{asset('assets/images/play1.svg')}}" alt=""></div> -->
                            <p class="mb-0">Meaning Making & The Impact on Performance</p>
                          </div>
                          <!-- <span class="text-sm-12 color-light">10:25</span> -->
                        </div>
                      </a><a class="list-group-item list-group-item-action ps-0 py-0" href="#" aria-current="true">
                        <div class="d-flex align-items-center justify-content-between">
                          <div class="d-flex align-items-center gap-2 p-3">
                            <!-- <div class="video-bg"><img class="in-svg" src="{{asset('assets/images/play1.svg')}}" alt=""></div> -->
                            <p class="mb-0">Emotional Intelligence in Action</p>
                          </div>
                          <!-- <span class="text-sm-12 color-light">10:25</span> -->
                        </div>
                      </a><a class="list-group-item list-group-item-action ps-0 py-0" href="#" aria-current="true">
                        <div class="d-flex align-items-center justify-content-between">
                          <div class="d-flex align-items-center gap-2 p-3">
                            <!-- <div class="video-bg"><img class="in-svg" src="{{asset('assets/images/play1.svg')}}" alt=""></div> -->
                            <p class="mb-0">The Emotional Intelligence System</p>
                          </div>
                          <!-- <span class="text-sm-12 color-light">10:25</span> -->
                        </div>
                      </a></div>
                    <div class="d-flex align-items-center justify-content-center"><button
                        class="btn btn--primary p-10-50">41 more sections </button></div>
                  </div>
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
                    <div class="lm_course-buy-card card p-3 lm_course-coaches">
                      <h5 class="fw-bold">Coaches</h5>
                      <div class="d-flex align-items-center lm__coache gap-3 gap-sm-0 flex-wrap">
                        <div class="d-flex align-items-center gap-2 lm__coaches">
                          <div class="avtar-xxl"><img class="rounded-circle position-relative"
                              src="{{asset('assets/images/member-1.jpg')}}" alt=""></div>
                          <p class="mb-0 text-dark">Arlene McCoy</p>
                        </div>
                        <div class="d-flex align-items-center gap-2 lm__coaches">
                          <div class="avtar-xxl"><img class="rounded-circle position-relative"
                              src="{{asset('assets/images/ev2.jpg')}}" alt="">
                            <div class="avtar-active"></div>
                          </div>
                          <p class="mb-0 text-dark">Albert Flores</p>
                        </div>
                        <div class="d-flex align-items-center gap-2 lm__coaches">
                          <div class="avtar-xxl"><img class="rounded-circle position-relative"
                              src="{{asset('assets/images/member-3.jpg')}}" alt=""></div>
                          <p class="mb-0 text-dark">Savannah Nguyen</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  {{-- <div class="lm_course-buy-card card p-30">
                    <div class="d-flex align-items-center"><span> <img src="{{asset('assets/images/star.svg')}}" alt=""></span>
                      <h5 class="fw-bold">3.9 course rating • 18K reviews</h5>
                    </div>
                    <div class="row">
                      <div class="col-md-6 mb-4">
                        <div class="lm_course-buy-card bg-gradient-gray rounded-4 p-2">
                          <div class="d-flex gap-2">
                            <div class="avtar-40"><img src="{{asset('assets/images/review1.jpg')}}" alt=""></div>
                            <div class="d-block">
                              <p class="mb-0 text-dark">Ricardo c.</p>
                              <ul class="d-flex">
                                <li> <span> <img src="{{asset('assets/images/star.svg')}}" alt=""></span></li>
                                <li> <span> <img src="{{asset('assets/images/star.svg')}}" alt=""></span></li>
                                <li> <span> <img src="{{asset('assets/images/star.svg')}}" alt=""></span></li>
                                <li> <span> <img src="{{asset('assets/images/star.svg')}}" alt=""></span></li>
                                <li> <span> <img src="{{asset('assets/images/star1.svg')}}" alt=""></span></li>
                                <li> <span>2w ago</span></li>
                              </ul>
                            </div>
                          </div>
                          <p class="text-sm-14 mb-0 text-dark">Amazing - you emerge from this course with a rock-solid
                            understanding of a whole array of machine learning techniques and tricks, and you have an
                            entire toolkit to apply each of them.</p>
                        </div>
                      </div>
                      <div class="col-md-6 mb-4">
                        <div class="lm_course-buy-card bg-gradient-gray rounded-4 p-2">
                          <div class="d-flex gap-2">
                            <div class="avtar-40"><img src="{{asset('assets/images/review2.jpg')}}" alt=""></div>
                            <div class="d-block">
                              <p class="mb-0 text-dark">Ricardo c.</p>
                              <ul class="d-flex">
                                <li> <span> <img src="{{asset('assets/images/star.svg')}}" alt=""></span></li>
                                <li> <span> <img src="{{asset('assets/images/star.svg')}}" alt=""></span></li>
                                <li> <span> <img src="{{asset('assets/images/star.svg')}}" alt=""></span></li>
                                <li> <span> <img src="{{asset('assets/images/star.svg')}}" alt=""></span></li>
                                <li> <span> <img src="{{asset('assets/images/star1.svg')}}" alt=""></span></li>
                                <li> <span>2w ago</span></li>
                              </ul>
                            </div>
                          </div>
                          <p class="text-sm-14 mb-0 text-dark">Amazing - you emerge from this course with a rock-solid
                            understanding of a whole array of machine learning techniques and tricks, and you have an
                            entire toolkit to apply each of them.</p>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="lm_course-buy-card bg-gradient-gray rounded-4 p-2">
                          <div class="d-flex gap-2">
                            <div class="avtar-40"><img src="{{asset('assets/images/review3.jpg')}}" alt=""></div>
                            <div class="d-block">
                              <p class="mb-0 text-dark">Ricardo c.</p>
                              <ul class="d-flex">
                                <li> <span> <img src="{{asset('assets/images/star.svg')}}" alt=""></span></li>
                                <li> <span> <img src="{{asset('assets/images/star.svg')}}" alt=""></span></li>
                                <li> <span> <img src="{{asset('assets/images/star.svg')}}" alt=""></span></li>
                                <li> <span> <img src="{{asset('assets/images/star.svg')}}" alt=""></span></li>
                                <li> <span> <img src="{{asset('assets/images/star1.svg')}}" alt=""></span></li>
                                <li> <span>2w ago</span></li>
                              </ul>
                            </div>
                          </div>
                          <p class="text-sm-14 mb-0 text-dark">Amazing - you emerge from this course with a rock-solid
                            understanding of a whole array of machine learning techniques and tricks, and you have an
                            entire toolkit to apply each of them.</p>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="lm_course-buy-card bg-gradient-gray rounded-4 p-2">
                          <div class="d-flex gap-2">
                            <div class="avtar-40"><img src="{{asset('assets/images/review4.jpg')}}" alt=""></div>
                            <div class="d-block">
                              <p class="mb-0 text-dark">Ricardo c.</p>
                              <ul class="d-flex">
                                <li> <span> <img src="{{asset('assets/images/star.svg')}}" alt=""></span></li>
                                <li> <span> <img src="{{asset('assets/images/star.svg')}}" alt=""></span></li>
                                <li> <span> <img src="{{asset('assets/images/star.svg')}}" alt=""></span></li>
                                <li> <span> <img src="{{asset('assets/images/star.svg')}}" alt=""></span></li>
                                <li> <span> <img src="{{asset('assets/images/star1.svg')}}" alt=""></span></li>
                                <li> <span>2w ago</span></li>
                              </ul>
                            </div>
                          </div>
                          <p class="text-sm-14 mb-0 text-dark">Amazing - you emerge from this course with a rock-solid
                            understanding of a whole array of machine learning techniques and tricks, and you have an
                            entire toolkit to apply each of them.</p>
                        </div>
                      </div>
                      <div class="col-12 mt-2">
                        <form action="" method="#">
                          <div class="post_comment-reply d-flex gap-2 mt-4">
                            <div class="avtar p-0"><img class="rounded-circle" src="{{asset('assets/images/post-user.jpg')}}"
                                alt=""></div>
                            <div class="post_comment-wrap position-relative w-100"><input
                                class="form-control border border-dark-subtle rounded-2 p-2 post_cmtt" type="text"
                                placeholder="Share your thoughts..."><span
                                class="position-absolute top-50 end-0 translate-middle-y me-2"><img class="in-svg"
                                  src="{{asset('assets/images/emoji.svg')}}" alt=""></span></div>
                          </div>
                          <ul class="d-flex gap-1 lm__ratting">
                            <li> <span> <img class="in-svg" src="{{asset('assets/images/star1.svg')}}" alt=""></span></li>
                            <li> <span> <img class="in-svg" src="{{asset('assets/images/star1.svg')}}" alt=""></span></li>
                            <li> <span> <img class="in-svg" src="{{asset('assets/images/star1.svg')}}" alt=""></span></li>
                            <li> <span> <img class="in-svg" src="{{asset('assets/images/star1.svg')}}" alt=""></span></li>
                            <li> <span> <img class="in-svg" src="{{asset('assets/images/star1.svg')}}" alt=""></span></li>
                          </ul>
                        </form>
                      </div>
                    </div>
                  </div> --}}
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
                          <!-- <div class="dropdown mt-1"><a class="dropdown-toggle" type="button"
                              data-bs-toggle="dropdown" aria-expanded="false"><span><img class="in-svg"
                                  src="{{asset('assets/images/dots-1.svg')}}" alt=""></span></a>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" type="button" data-bs-toggle="modal"
                                  data-bs-target="#exampleModal14">Block Arlene</a></li>
                              <li><a class="dropdown-item" type="button" data-bs-toggle="modal"
                                  data-bs-target="#exampleModal15">Report Arlene</a></li>
                              <li><a class="dropdown-item" type="button" data-bs-toggle="modal"
                                  data-bs-target="#exampleModal16">Remove from Network</a></li>
                              <li class="dropdown dropdown-submenu toggler"><a class="dropdown-item" href="#"
                                  data-toggle="dropdown">Add this to..</a>
                                <ul class="dropdown-menu dropdown-menu-inner py-3">
                                  <li class="px-3">
                                    <div class="lm__term mb-3"><label class="lm-check-term ps-4 mb-0 lh-1">Network
                                        Host<input type="checkbox"><span class="checkmark"></span></label></div>
                                  </li>
                                  <li class="px-3">
                                    <div class="lm__term mb-3"><label class="lm-check-term ps-4 mb-0 lh-1">Network
                                        Moderator<input type="checkbox"><span class="checkmark"></span></label></div>
                                  </li>
                                  <li class="px-3">
                                    <div class="lm__term"><label class="lm-check-term ps-4 mb-0 lh-1">Network
                                        Member<input type="checkbox"><span class="checkmark"></span></label></div>
                                  </li>
                                </ul>
                              </li>
                            </ul>
                          </div> -->
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
                          <!-- <div class="dropdown mt-1"><a class="dropdown-toggle" type="button"
                              data-bs-toggle="dropdown" aria-expanded="false"><span><img class="in-svg"
                                  src="{{asset('assets/images/dots-1.svg')}}" alt=""></span></a>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" type="button" data-bs-toggle="modal"
                                  data-bs-target="#exampleModal14">Block Arlene</a></li>
                              <li><a class="dropdown-item" type="button" data-bs-toggle="modal"
                                  data-bs-target="#exampleModal15">Report Arlene</a></li>
                              <li><a class="dropdown-item" type="button" data-bs-toggle="modal"
                                  data-bs-target="#exampleModal16">Remove from Network</a></li>
                              <li class="dropdown dropdown-submenu toggler"><a class="dropdown-item" href="#"
                                  data-toggle="dropdown">Add this to..</a>
                                <ul class="dropdown-menu dropdown-menu-inner py-3">
                                  <li class="px-3">
                                    <div class="lm__term mb-3"><label class="lm-check-term ps-4 mb-0 lh-1">Network
                                        Host<input type="checkbox"><span class="checkmark"></span></label></div>
                                  </li>
                                  <li class="px-3">
                                    <div class="lm__term mb-3"><label class="lm-check-term ps-4 mb-0 lh-1">Network
                                        Moderator<input type="checkbox"><span class="checkmark"></span></label></div>
                                  </li>
                                  <li class="px-3">
                                    <div class="lm__term"><label class="lm-check-term ps-4 mb-0 lh-1">Network
                                        Member<input type="checkbox"><span class="checkmark"></span></label></div>
                                  </li>
                                </ul>
                              </li>
                            </ul>
                          </div> -->
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
                          <!-- <div class="dropdown mt-1"><a class="dropdown-toggle" type="button"
                              data-bs-toggle="dropdown" aria-expanded="false"><span><img class="in-svg"
                                  src="{{asset('assets/images/dots-1.svg')}}" alt=""></span></a>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" type="button" data-bs-toggle="modal"
                                  data-bs-target="#exampleModal14">Block Arlene</a></li>
                              <li><a class="dropdown-item" type="button" data-bs-toggle="modal"
                                  data-bs-target="#exampleModal15">Report Arlene</a></li>
                              <li><a class="dropdown-item" type="button" data-bs-toggle="modal"
                                  data-bs-target="#exampleModal16">Remove from Network</a></li>
                              <li class="dropdown dropdown-submenu toggler"><a class="dropdown-item" href="#"
                                  data-toggle="dropdown">Add this to..</a>
                                <ul class="dropdown-menu dropdown-menu-inner py-3">
                                  <li class="px-3">
                                    <div class="lm__term mb-3"><label class="lm-check-term ps-4 mb-0 lh-1">Network
                                        Host<input type="checkbox"><span class="checkmark"></span></label></div>
                                  </li>
                                  <li class="px-3">
                                    <div class="lm__term mb-3"><label class="lm-check-term ps-4 mb-0 lh-1">Network
                                        Moderator<input type="checkbox"><span class="checkmark"></span></label></div>
                                  </li>
                                  <li class="px-3">
                                    <div class="lm__term"><label class="lm-check-term ps-4 mb-0 lh-1">Network
                                        Member<input type="checkbox"><span class="checkmark"></span></label></div>
                                  </li>
                                </ul>
                              </li>
                            </ul>
                          </div> -->
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-5 col-lg-12 col-xxl-4 ps-xxl-0 mt-3 mt-xxl-0 mt-md-0">
          <div class="lm_vedio-card card">
            <div class="card-img position-relative"><img class="w-100" src="{{asset('assets/images/courses3.jpg')}}" alt="">
              <div class="card-img-overlay">
                <div class="d-flex justify-content-center align-items-center text-center h-100"><a class="play-video"
                    href="" data-bs-toggle="modal" data-bs-target="#exampleModal25"><img class="in-svg"
                      src="{{asset('assets/images/play-1.svg')}}" alt="">
                    <h6 class="text-white">Preview</h6>
                  </a></div>
              </div>
            </div>
            <div class="card-body p-0 pt-2">
              <h4 class="mb-2"> <a class="text-dark" href="#">Self Mastery Program </a></h4>
              <h5 class="text-primary">$1,499.99 AUD</h5>
              <div class="d-flex gap-2"><a class="btn btn--primary d-block w-100 py-2" href=""><span class="gap-2">Start Course<img
                      class="in-svg" src="{{asset('assets/images/play-btn.svg')}}" alt=""></span></a>
                <div class="lm__share">
                  <div class="d-flex gap-2"><span><a  type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#courseshare" aria-controls="courseshare"> <img class="in-svg"
                          src="{{asset('assets/images/share.svg')}}" alt=""></a></span><span><a href="#"> <img class="in-svg"
                          src="{{asset('assets/images/download.svg')}}" alt=""></a></span></div>
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