@extends('layouts.admin.master')
@section('content')
<main class="main-content" id="main">
  <section class="lm__dash-con mb-5 lm__module-overview">
    <span class="lm_vec"><img class="light" src="{{asset('assets/images/light.png')}}" alt=""><img class="dark" src="{{asset('assets/images/dark.png')}}" alt=""></span>
    <div class="container">
      <div class="row lm__module-overview">
        <div class="col-12">
          <div class="lm__module-overview-con module-view-con">
            <!-- 1 -->
            <div class="lm__overview-card card shadow">
              <h4 class="fw-bold text-primary">How To Get The Most Out Of This Program</h4>
              <p>The Tasks section in each module provides you with exercises to complete related to the module’s content or topic. To make the most of the Self Mastery course, take plenty of time to complete the tasks thoroughly and make notes so that you are able to reflect on them later.</p>
              <p>Go to page 5 in your interactive workbook to complete the below tasks for this module. </p>
              <p>Task 1: Head into your interactive workbook and complete the Consumption Audit over the next 5 days.</p>
              <p>Task 2: Make a list of the type of positive daily consumption habits you have and increase your consumption of these things during the program. Make a commitment to spend an hour/30 mins each day doing this while going through the program.</p>
              <p>Task3: Journal the thoughts, feelings and moods you experience as a result of what you consume - this is designed to elevate your self awareness by looking more closely at the impact of your consumption on your emotional state. </p>
              <!-- <div class="lm__module-button">
                <button class="btn btn--primary px-5">Open Interactive Journal</button>
              </div> -->
              <div class="d-flex justify-content-between">
                <div class="lm-workbook-wrap">
                  <a href="{{ route('user.interactive.workbook') }}">
                    <div class="lm-workbook">
                      <img src="{{asset('assets/images/icon-pdf.svg')}}" alt="">
                      <span>Interactive Workbook</span>
                    </div>
                  </a>
                </div>
              <!-- Button -->
              <div class="lm__module-button text-end mt-1">
                <a class="btn btn--secondry cr-btn-prev me-2" href="{{ route('user.courses.audio') }}">Prev</a>
                <a class="btn btn--primary cr-btn-next me-4" href="{{ route('user.courses.quiz') }}">Next</a>
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
                          <a class="course-con-list-item complete" href="">
                            <div class="d-flex align-items-center justify-content-between">
                              <div class="d-flex align-items-center">
                                <div class="icon-div">
                                  <span class="icon">
                                    <img class="in-svg" src="{{asset('assets/images/Check02.svg')}}" alt="">
                                  </span>
                                </div>
                                <p class="mb-0">Introduction</p>
                              </div>
                              <span class="mb-0 text-sm-12">2:25</span>
                            </div>
                          </a>

                          <!-- 2 -->
                          <a class="course-con-list-item complete" href="">
                            <div class="d-flex align-items-center justify-content-between">
                              <div class="d-flex align-items-center">
                                <div class="icon-div">
                                  <span class="icon">
                                    <img class="in-svg" src="{{asset('assets/images/Check02.svg')}}" alt="">
                                  </span>
                                </div>
                                <p class="mb-0">Video Lesson</p>
                              </div>
                              <span class="mb-0 text-sm-12">3:25</span>
                            </div>
                          </a>
                          <!-- 3 -->
                          <a class="course-con-list-item active" href="">
                            <div class="d-flex align-items-center justify-content-between">
                              <div class="d-flex align-items-center">
                                <div class="icon-div"> <span class="icon"><img class="in-svg" src="{{asset('assets/images/play-btn.svg')}}" alt=""></span></div>
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