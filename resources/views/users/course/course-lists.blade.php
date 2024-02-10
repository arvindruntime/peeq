@extends('layouts.admin.master')
@section('content')

<main class="main-content" id="main">
    <section class="lm__dash-con lm__course-list lm__list-after-pay"><span class="lm_vec"><img class="light"
          src="{{asset('assets/images/light.png')}}" alt=""><img class="dark" src="{{asset('assets/images/dark.png')}}" alt=""></span>
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
                      data-bs-toggle="pill" data-bs-target="#pills-all" type="button" role="tab"
                      aria-controls="pills-all" aria-selected="true">All</button></li>
                  <li class="nav-item" role="presentation"><button class="nav-link" id="pills-purchased-tab"
                      data-bs-toggle="pill" data-bs-target="#pills-purchased" type="button" role="tab"
                      aria-controls="pills-purchased" aria-selected="false">purchased</button></li>
                </ul>
              </div>
              <div class="lm_course-con">
                <div class="tab-content" id="pills-tabContent">
                  <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab"
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
                            <!-- <ul class="d-flex justify-content-end">
                              <li> <span class="text-sm-14 text-primary title-font">3.9</span></li>
                              <li> <span> <img src="{{asset('assets/images/star.svg')}}" alt=""></span></li>
                              <li> <span> <img src="{{asset('assets/images/star.svg')}}" alt=""></span></li>
                              <li> <span> <img src="{{asset('assets/images/star.svg')}}" alt=""></span></li>
                              <li> <span> <img src="{{asset('assets/images/star.svg')}}" alt=""></span></li>
                              <li> <span> <img src="{{asset('assets/images/star1.svg')}}" alt=""></span></li>
                              <li> <span class="text-dark">(1234 ratings)</span></li>
                            </ul> -->
                            <div class="d-flex align-items-end justify-content-between">
                              <div class="d-block"> <span class="text-dark title-font">Coaches</span>
                                <div class="avtar-group mt-1">
                                  <div class="avtar-55"><img src="{{asset('assets/images/ev1.jpg')}}" alt=""></div>
                                  <div class="avtar-55"><img src="{{asset('assets/images/ev2.jpg')}}" alt=""></div>
                                  <div class="avtar-55"><img src="{{asset('assets/images/ev3.jpg')}}" alt=""></div>
                                </div>
                              </div>
                              <div class="d-flex gap-2">
                                <div class="lm__hover">
                                  <div class="d-flex gap-2"><span> <a href="#" type="button" data-bs-toggle="offcanvas" data-bs-target="#courseshare" aria-controls="courseshare"> <img class="in-svg"
                                          src="{{asset('assets/images/share.svg')}}" alt=""></a></span><span><a href="#"> <img
                                          class="in-svg" src="{{asset('assets/images/download.svg')}}" alt=""></a></span></div>
                                </div>
                                <div class="d-block"> <a class="btn btn--dark-lenear text-primary py-2"
                                    href="{{ route('user.courses.viewpay') }}">View Course </a></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="pills-purchased" role="tabpanel" aria-labelledby="pills-purchased-tab"
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
                            <!-- <ul class="d-flex justify-content-end">
                              <li> <span class="text-sm-14 text-primary title-font">3.9</span></li>
                              <li> <span> <img src="{{asset('assets/images/star.svg')}}" alt=""></span></li>
                              <li> <span> <img src="{{asset('assets/images/star.svg')}}" alt=""></span></li>
                              <li> <span> <img src="{{asset('assets/images/star.svg')}}" alt=""></span></li>
                              <li> <span> <img src="{{asset('assets/images/star.svg')}}" alt=""></span></li>
                              <li> <span> <img src="{{asset('assets/images/star1.svg')}}" alt=""></span></li>
                              <li> <span class="text-dark">(1234 ratings)</span></li>
                            </ul> -->
                            <div class="d-flex align-items-end justify-content-between">
                              <div class="d-block"> <span class="text-dark title-font">Coaches</span>
                                <div class="avtar-group mt-1">
                                  <div class="avtar-55"><img src="{{asset('assets/images/ev1.jpg')}}" alt=""></div>
                                  <div class="avtar-55"><img src="{{asset('assets/images/ev2.jpg')}}" alt=""></div>
                                  <div class="avtar-55"><img src="{{asset('assets/images/ev3.jpg')}}" alt=""></div>
                                </div>
                              </div>
                              <div class="d-flex gap-2">
                                <div class="lm__hover">
                                  <div class="d-flex gap-2"><span> <a href="#" type="button" data-bs-toggle="offcanvas" data-bs-target="#courseshare" aria-controls="courseshare"> <img class="in-svg"
                                          src="{{asset('assets/images/share.svg')}}" alt=""></a></span><span><a href="#"> <img
                                          class="in-svg" src="{{asset('assets/images/download.svg')}}" alt=""></a></span></div>
                                </div>
                                <div class="d-block"> <a class="btn btn--dark-lenear text-primary py-2"
                                    href="{{ route('user.courses.viewpay') }}">View Course </a></div>
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
                            <!-- <ul class="d-flex justify-content-end">
                              <li> <span class="text-sm-14 text-primary title-font">3.9</span></li>
                              <li> <span> <img src="{{asset('assets/images/star.svg')}}" alt=""></span></li>
                              <li> <span> <img src="{{asset('assets/images/star.svg')}}" alt=""></span></li>
                              <li> <span> <img src="{{asset('assets/images/star.svg')}}" alt=""></span></li>
                              <li> <span> <img src="{{asset('assets/images/star.svg')}}" alt=""></span></li>
                              <li> <span> <img src="{{asset('assets/images/star1.svg')}}" alt=""></span></li>
                              <li> <span class="text-dark">(1234 ratings)</span></li>
                            </ul> -->
                            <div class="d-flex align-items-end justify-content-between">
                              <div class="d-block"> <span class="text-dark title-font">Coaches</span>
                                <div class="avtar-group mt-1">
                                  <div class="avtar-55"><img src="{{asset('assets/images/ev1.jpg')}}" alt=""></div>
                                  <div class="avtar-55"><img src="{{asset('assets/images/ev2.jpg')}}" alt=""></div>
                                  <div class="avtar-55"><img src="{{asset('assets/images/ev3.jpg')}}" alt=""></div>
                                </div>
                              </div>
                              <div class="d-flex gap-2">
                                <div class="lm__hover">
                                  <div class="d-flex gap-2"><span> <a href="#" type="button" data-bs-toggle="offcanvas" data-bs-target="#courseshare" aria-controls="courseshare"> <img class="in-svg"
                                          src="{{asset('assets/images/share.svg')}}" alt=""></a></span><span><a href="#"> <img
                                          class="in-svg" src="{{asset('assets/images/download.svg')}}" alt=""></a></span></div>
                                </div>
                                <div class="d-block"> <a class="btn btn--dark-lenear text-primary py-2"
                                    href="{{ route('user.courses.viewpay') }}">View Course </a></div>
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

@endsection