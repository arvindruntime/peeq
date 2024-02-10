@extends('layouts.admin.master')
@section('content')
{{-- {{ dd($course); }} --}}
<main class="main-content" id="main">
  <section class="lm__dash-con mb-5 lm__module-overview">
    <span class="lm_vec"><img class="light" src="{{asset('assets/images/light.png')}}" alt=""><img class="dark" src="{{asset('assets/images/dark.png')}}" alt=""></span>
    <div class="container">
      <div class="row lm__module-overview">
        <div class="col-12">
          <div class="lm__module-overview-con module-view-con">
            <!-- 1 -->
            <div class="lm__overview-card card shadow">
              <h4 class="fw-bold text-primary">{{ $course->course_name }}</h4>
              <h5 class="fw-bold">{{ $course->course_tagline }} </h5>
              <p class="mb-3 color-light">{{ $course->description }}</p>
              {{-- <p class="mb-0 color-light">What You'll Get From Your Self Mastery Program:</p> --}}
              {{-- <ul class="overview-list color-light">
                <li>Access exclusive content. We've designed test mam to inspire, instruct, and engage.</li>
                <li>Meet new people. Your fellow students are as motivated as you are to master what we're exploring
                  here in test mam.
                </li>
                <li>Get results. As you dive into the course content and meet the community here in test mam, you're
                  on a path of mastery. While it's not necessarily easy, the transformation we'll get together
                  matters.
                </li>
              </ul> --}}
              {{-- <p class="text-dark mb-2">Watch the following video for an in depth look at what is included in the Self Mastery Program.</p> --}}
              <div class="card-image"> <img src="{{ $course->course_thumbnail }}" alt=""></div>
              {{-- <div class="additional">
                <p class="color-light">You Are a Part of Something Bigger</p>
                <p class="color-light">By joining the Self Mastery Program, you are also a member of PEEQ Global Leadership Network, our overarching community. You’ll be able to keep up with our Self Mastery Program activity both here, but also in your main PEEQ Activity Feed (think about it as our own Facebook newsfeed with Course and other activity all in one place).</p>
                <p class="color-light">Let’s get started.</p>
              </div> --}}
              <!-- Button -->
              <div class="d-flex justify-content-between">
                <div class="lm-workbook-wrap">
                  <a href="{{ route('user.interactive.workbook') }}">
                    <div class="lm-workbook">
                      <img src="{{asset('assets/images/icon-pdf.svg')}}" alt="">
                      <span>Interactive Workbook</span>
                    </div>
                  </a>
                </div>
                <div class="lm__module-button text-end">
                  <a class="btn btn--primary cr-btn-next me-4" href="{{ route('user.courses.intro', ['id' => $course['id']]) }}">Next</a>
                </div>
              </div>

            </div>
            <!-- 2 -->
            <div class="lm_overview-list">
              <div class="card shadow">
                <div class="d-flex gap-2 align-items-center course-icon">
                  <span> <img class="in-svg" src="{{asset('assets/images/course.svg')}}" alt=""></span>
                  <h6 class="mb-0 fw-bold">Welcome To Your Self Mastery Journey</h6>
                </div>
                <div class="accordion-course">
                  <div class="accordion" id="accordionExample">
                    <!-- 1 -->
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          How To Get The Most Out Of This Program
                        </button>
                      </h2>
                      <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                        <div class="accordion-body p-0">
                          <!-- progress -->
                          <div class="progress-wrap">
                            <p class="text-end color-light mb-0 text-sm-12">5% Completed</p>
                            <div class="progress" role="progressbar" aria-label="Example 1px high" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="height: 4px">
                              <div class="progress-bar" style="width: 2%"></div>
                            </div>
                          </div>
                          <!-- 1 -->
                          <a class="course-con-list-item active" href="">
                            <div class="d-flex align-items-center justify-content-between">
                              <div class="d-flex align-items-center">
                                <div class="icon-div">
                                  <span class="icon">
                                    <img class="in-svg" src="{{asset('assets/images/play-btn.svg')}}" alt="">
                                  </span>
                                </div>
                                <p class="mb-0">Introduction</p>
                              </div>
                              <span class="mb-0 text-sm-12">2:25</span>
                            </div>
                          </a>

                          <!-- 2 -->
                          <a class="course-con-list-item" href="">
                            <div class="d-flex align-items-center justify-content-between">
                              <div class="d-flex align-items-center">
                                <div class="icon-div">
                                  <span class="icon">
                                    <img class="in-svg" src="{{asset('assets/images/lockr.svg')}}" alt="">
                                  </span>
                                </div>
                                <p class="mb-0">Video Lesson</p>
                              </div>
                              <span class="mb-0 text-sm-12">3:25</span>
                            </div>
                          </a>
                          <!-- 3 -->
                          <a class="course-con-list-item" href="">
                            <div class="d-flex align-items-center justify-content-between">
                              <div class="d-flex align-items-center">
                                <div class="icon-div"> <span class="icon"><img class="in-svg" src="{{asset('assets/images/lockr.svg')}}" alt=""></span></div>
                                <p class="mb-0">Audio Lesson</p>
                              </div>
                              <span class="mb-0 text-sm-12">5:25</span>
                            </div>
                          </a>
                          <!-- 4 -->
                          <a class="course-con-list-item" href="">
                            <div class="d-flex align-items-center justify-content-between">
                              <div class="d-flex align-items-center">
                                <div class="icon-div"> <span class="icon"><img class="in-svg" src="{{asset('assets/images/lockr.svg')}}" alt=""></span></div>
                                <p class="mb-0">Tasks</p>
                              </div>
                              <span class="mb-0 text-sm-12">5:25</span>
                            </div>
                          </a>
                          <!-- 5 -->
                          <a class="course-con-list-item" href="">
                            <div class="d-flex align-items-center justify-content-between">
                              <div class="d-flex align-items-center">
                                <div class="icon-div"> <span class="icon"><img class="in-svg" src="{{asset('assets/images/lockr.svg')}}" alt=""></span></div>
                                <p class="mb-0">Quiz</p>
                              </div>
                              <span class="mb-0 text-sm-12">5:25</span>
                            </div>
                          </a>
                          <!-- 6 -->
                          <a class="course-con-list-item" href="">
                            <div class="d-flex align-items-center justify-content-between">
                              <div class="d-flex align-items-center">
                                <div class="icon-div"> <span class="icon"><img class="in-svg" src="{{asset('assets/images/lockr.svg')}}" alt=""></span></div>
                                <p class="mb-0">Reflection Questions</p>
                              </div>
                              <span class="mb-0 text-sm-12">5:25</span>
                            </div>
                          </a>
                          <a class="course-con-list-item" href="">
                            <div class="d-flex align-items-center justify-content-between">
                              <div class="d-flex align-items-center">
                                <div class="icon-div"> <span class="icon"><img class="in-svg" src="{{asset('assets/images/lockr.svg')}}" alt=""></span></div>
                                <p class="mb-0">Reference Links</p>
                              </div>
                              <span class="mb-0 text-sm-12">5:25</span>
                            </div>
                          </a>
                          <!-- 7 -->
                          <a class="course-con-list-item" href="">
                            <div class="d-flex align-items-center justify-content-between">
                              <div class="d-flex align-items-center">
                                <div class="icon-div"> <span class="icon"><img class="in-svg" src="{{asset('assets/images/lockr.svg')}}" alt=""></span></div>
                                <p class="mb-0">Closure Video</p>
                              </div>
                              <span class="mb-0 text-sm-12">5:25</span>
                            </div>
                          </a>
                        </div>
                      </div>
                    </div>

                    <!-- 2 -->
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                          Welcome To Your Self Mastery Journey
                        </button>
                      </h2>
                      <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                          <div class="accordion-body p-0">
                            <!-- progress -->
                            <div class="progress-wrap">
                              <p class="text-end color-light mb-0 text-sm-12">5% Completed</p>
                              <div class="progress" role="progressbar" aria-label="Example 1px high" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="height: 4px">
                                <div class="progress-bar" style="width: 2%"></div>
                              </div>
                            </div>
                            <!-- 1 -->
                            <a class="course-con-list-item active" href="">
                              <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                  <div class="icon-div">
                                    <span class="icon">
                                      <img class="in-svg" src="{{asset('assets/images/play-btn.svg')}}" alt="">
                                    </span>
                                  </div>
                                  <p class="mb-0">Introduction</p>
                                </div>
                                <span class="mb-0 text-sm-12">2:25</span>
                              </div>
                            </a>

                            <!-- 2 -->
                            <a class="course-con-list-item" href="">
                              <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                  <div class="icon-div">
                                    <span class="icon">
                                      <img class="in-svg" src="{{asset('assets/images/lockr.svg')}}" alt="">
                                    </span>
                                  </div>
                                  <p class="mb-0">Video Lesson</p>
                                </div>
                                <span class="mb-0 text-sm-12">3:25</span>
                              </div>
                            </a>
                            <!-- 3 -->
                            <a class="course-con-list-item" href="">
                              <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                  <div class="icon-div"> <span class="icon"><img class="in-svg" src="{{asset('assets/images/lockr.svg')}}" alt=""></span></div>
                                  <p class="mb-0">Audio Lesson</p>
                                </div>
                                <span class="mb-0 text-sm-12">5:25</span>
                              </div>
                            </a>
                            <!-- 4 -->
                            <a class="course-con-list-item" href="">
                              <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                  <div class="icon-div"> <span class="icon"><img class="in-svg" src="{{asset('assets/images/lockr.svg')}}" alt=""></span></div>
                                  <p class="mb-0">Tasks</p>
                                </div>
                                <span class="mb-0 text-sm-12">5:25</span>
                              </div>
                            </a>
                            <!-- 5 -->
                            <a class="course-con-list-item" href="">
                              <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                  <div class="icon-div"> <span class="icon"><img class="in-svg" src="{{asset('assets/images/lockr.svg')}}" alt=""></span></div>
                                  <p class="mb-0">Quiz</p>
                                </div>
                                <span class="mb-0 text-sm-12">5:25</span>
                              </div>
                            </a>
                            <!-- 6 -->
                            <a class="course-con-list-item" href="">
                              <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                  <div class="icon-div"> <span class="icon"><img class="in-svg" src="{{asset('assets/images/lockr.svg')}}" alt=""></span></div>
                                  <p class="mb-0">Reflection Questions</p>
                                </div>
                                <span class="mb-0 text-sm-12">5:25</span>
                              </div>
                            </a>
                            <a class="course-con-list-item" href="">
                              <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                  <div class="icon-div"> <span class="icon"><img class="in-svg" src="{{asset('assets/images/lockr.svg')}}" alt=""></span></div>
                                  <p class="mb-0">Reference Links</p>
                                </div>
                                <span class="mb-0 text-sm-12">5:25</span>
                              </div>
                            </a>
                            <!-- 7 -->
                            <a class="course-con-list-item" href="">
                              <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                  <div class="icon-div"> <span class="icon"><img class="in-svg" src="{{asset('assets/images/lockr.svg')}}" alt=""></span></div>
                                  <p class="mb-0">Closure Video</p>
                                </div>
                                <span class="mb-0 text-sm-12">5:25</span>
                              </div>
                            </a>
                          </div>
                      </div>
                    </div>

                    <!-- 3 -->
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                          How To Get The Most Out Of This Program
                        </button>
                      </h2>
                      <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                          <div class="accordion-body p-0">
                            <!-- progress -->
                            <div class="progress-wrap">
                              <p class="text-end color-light mb-0 text-sm-12">5% Completed</p>
                              <div class="progress" role="progressbar" aria-label="Example 1px high" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="height: 4px">
                                <div class="progress-bar" style="width: 2%"></div>
                              </div>
                            </div>
                            <!-- 1 -->
                            <a class="course-con-list-item active" href="">
                              <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                  <div class="icon-div">
                                    <span class="icon">
                                      <img class="in-svg" src="{{asset('assets/images/play-btn.svg')}}" alt="">
                                    </span>
                                  </div>
                                  <p class="mb-0">Introduction</p>
                                </div>
                                <span class="mb-0 text-sm-12">2:25</span>
                              </div>
                            </a>

                            <!-- 2 -->
                            <a class="course-con-list-item" href="">
                              <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                  <div class="icon-div">
                                    <span class="icon">
                                      <img class="in-svg" src="{{asset('assets/images/lockr.svg')}}" alt="">
                                    </span>
                                  </div>
                                  <p class="mb-0">Video Lesson</p>
                                </div>
                                <span class="mb-0 text-sm-12">3:25</span>
                              </div>
                            </a>
                            <!-- 3 -->
                            <a class="course-con-list-item" href="">
                              <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                  <div class="icon-div"> <span class="icon"><img class="in-svg" src="{{asset('assets/images/lockr.svg')}}" alt=""></span></div>
                                  <p class="mb-0">Audio Lesson</p>
                                </div>
                                <span class="mb-0 text-sm-12">5:25</span>
                              </div>
                            </a>
                            <!-- 4 -->
                            <a class="course-con-list-item" href="">
                              <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                  <div class="icon-div"> <span class="icon"><img class="in-svg" src="{{asset('assets/images/lockr.svg')}}" alt=""></span></div>
                                  <p class="mb-0">Tasks</p>
                                </div>
                                <span class="mb-0 text-sm-12">5:25</span>
                              </div>
                            </a>
                            <!-- 5 -->
                            <a class="course-con-list-item" href="">
                              <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                  <div class="icon-div"> <span class="icon"><img class="in-svg" src="{{asset('assets/images/lockr.svg')}}" alt=""></span></div>
                                  <p class="mb-0">Quiz</p>
                                </div>
                                <span class="mb-0 text-sm-12">5:25</span>
                              </div>
                            </a>
                            <!-- 6 -->
                            <a class="course-con-list-item" href="">
                              <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                  <div class="icon-div"> <span class="icon"><img class="in-svg" src="{{asset('assets/images/lockr.svg')}}" alt=""></span></div>
                                  <p class="mb-0">Reflection Questions</p>
                                </div>
                                <span class="mb-0 text-sm-12">5:25</span>
                              </div>
                            </a>
                            <a class="course-con-list-item" href="">
                              <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                  <div class="icon-div"> <span class="icon"><img class="in-svg" src="{{asset('assets/images/lockr.svg')}}" alt=""></span></div>
                                  <p class="mb-0">Reference Links</p>
                                </div>
                                <span class="mb-0 text-sm-12">5:25</span>
                              </div>
                            </a>
                            <!-- 7 -->
                            <a class="course-con-list-item" href="">
                              <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                  <div class="icon-div"> <span class="icon"><img class="in-svg" src="{{asset('assets/images/lockr.svg')}}" alt=""></span></div>
                                  <p class="mb-0">Closure Video</p>
                                </div>
                                <span class="mb-0 text-sm-12">5:25</span>
                              </div>
                            </a>
                          </div>
                      </div>
                    </div>

                     <!-- 4 -->
                     <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        Welcome To Your Self Mastery Journey
                        </button>
                      </h2>
                      <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body p-0">
                          <!-- progress -->
                          <div class="progress-wrap">
                            <p class="text-end color-light mb-0 text-sm-12">5% Completed</p>
                            <div class="progress" role="progressbar" aria-label="Example 1px high" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="height: 4px">
                              <div class="progress-bar" style="width: 2%"></div>
                            </div>
                          </div>
                          <!-- 1 -->
                          <a class="course-con-list-item active" href="">
                            <div class="d-flex align-items-center justify-content-between">
                              <div class="d-flex align-items-center">
                                <div class="icon-div">
                                  <span class="icon">
                                    <img class="in-svg" src="{{asset('assets/images/play-btn.svg')}}" alt="">
                                  </span>
                                </div>
                                <p class="mb-0">Introduction</p>
                              </div>
                              <span class="mb-0 text-sm-12">2:25</span>
                            </div>
                          </a>

                          <!-- 2 -->
                          <a class="course-con-list-item" href="">
                            <div class="d-flex align-items-center justify-content-between">
                              <div class="d-flex align-items-center">
                                <div class="icon-div">
                                  <span class="icon">
                                    <img class="in-svg" src="{{asset('assets/images/lockr.svg')}}" alt="">
                                  </span>
                                </div>
                                <p class="mb-0">Video Lesson</p>
                              </div>
                              <span class="mb-0 text-sm-12">3:25</span>
                            </div>
                          </a>
                          <!-- 3 -->
                          <a class="course-con-list-item" href="">
                            <div class="d-flex align-items-center justify-content-between">
                              <div class="d-flex align-items-center">
                                <div class="icon-div"> <span class="icon"><img class="in-svg" src="{{asset('assets/images/lockr.svg')}}" alt=""></span></div>
                                <p class="mb-0">Audio Lesson</p>
                              </div>
                              <span class="mb-0 text-sm-12">5:25</span>
                            </div>
                          </a>
                          <!-- 4 -->
                          <a class="course-con-list-item" href="">
                            <div class="d-flex align-items-center justify-content-between">
                              <div class="d-flex align-items-center">
                                <div class="icon-div"> <span class="icon"><img class="in-svg" src="{{asset('assets/images/lockr.svg')}}" alt=""></span></div>
                                <p class="mb-0">Tasks</p>
                              </div>
                              <span class="mb-0 text-sm-12">5:25</span>
                            </div>
                          </a>
                          <!-- 5 -->
                          <a class="course-con-list-item" href="">
                            <div class="d-flex align-items-center justify-content-between">
                              <div class="d-flex align-items-center">
                                <div class="icon-div"> <span class="icon"><img class="in-svg" src="{{asset('assets/images/lockr.svg')}}" alt=""></span></div>
                                <p class="mb-0">Quiz</p>
                              </div>
                              <span class="mb-0 text-sm-12">5:25</span>
                            </div>
                          </a>
                          <!-- 6 -->
                          <a class="course-con-list-item" href="">
                            <div class="d-flex align-items-center justify-content-between">
                              <div class="d-flex align-items-center">
                                <div class="icon-div"> <span class="icon"><img class="in-svg" src="{{asset('assets/images/lockr.svg')}}" alt=""></span></div>
                                <p class="mb-0">Reflection Questions</p>
                              </div>
                              <span class="mb-0 text-sm-12">5:25</span>
                            </div>
                          </a>
                          <a class="course-con-list-item" href="">
                            <div class="d-flex align-items-center justify-content-between">
                              <div class="d-flex align-items-center">
                                <div class="icon-div"> <span class="icon"><img class="in-svg" src="{{asset('assets/images/lockr.svg')}}" alt=""></span></div>
                                <p class="mb-0">Reference Links</p>
                              </div>
                              <span class="mb-0 text-sm-12">5:25</span>
                            </div>
                          </a>
                          <!-- 7 -->
                          <a class="course-con-list-item" href="">
                            <div class="d-flex align-items-center justify-content-between">
                              <div class="d-flex align-items-center">
                                <div class="icon-div"> <span class="icon"><img class="in-svg" src="{{asset('assets/images/lockr.svg')}}" alt=""></span></div>
                                <p class="mb-0">Closure Video</p>
                              </div>
                              <span class="mb-0 text-sm-12">5:25</span>
                            </div>
                          </a>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- <div class="event-cmt cousre-view 0">
          <h5>Comments</h5>
          <div class="d-flex gap-2 bg-white position-relative p-3 rounded-3 mt-3 shadow">
            <div class="avtar-40 p-0"><img class="rounded-circle" src="{{asset('assets/images/avtar-4.jpg')}}" alt=""></div>
            <div class="position-relative w-100">
              <input class="form-control border border-dark-subtle rounded-2 p-2" type="text"
              placeholder="Share your thoughts...">
              <span class="position-absolute top-50 end-0 translate-middle-y me-2"><img class="in-svg"
              src="{{asset('assets/images/emoji.svg')}}" alt=""></span>
            </div>
          </div>
        </div> -->
      </div>
  </section>
  
</main>

@endsection