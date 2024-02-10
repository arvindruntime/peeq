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
            <div class="lm__quiz-user lm__quiz--preview">
                <form action="">
                  <div class="lm__quiztopic">
                    <h5>How To Get The Most Out Of This Program</h5>
                  </div>
                  <div class="lm__quiztopic">
                    <h5 class="text-dark">Quiz</h5>
                    <p class="mb-3">Take this short quiz to check your retention on what we’ve covered in this module. And remember, if something is not clear to you, you can flag a question to your coach through the app and they’ll come back to you to ensure you have a full understanding of everything that has been discussed through the module’s content. </p>
                  </div>
                  
                  <div class="lm__quizbox mb-4">
                    <div class="lm__quiz-question shadow">
                      <p class="m-0">Q.1 What is the best approach ?</p>
                    </div>
                    <div class="lm__preview-choices shadow">
                      <div class="lm__term mb-3"><label class="lm-check-term mb-0 lh-1 text-white"><input
                        type="checkbox"><span class="checkmark"></span><span>Consumption Habits</span></label></div>
                      <div class="lm__term mb-3"><label class="lm-check-term mb-0 lh-1 text-white"><input
                        type="checkbox"><span class="checkmark"></span><span>Past Experiences</span></label></div>
                      <div class="lm__term mb-3"><label class="lm-check-term mb-0 lh-1 text-white"><input
                        type="checkbox"><span class="checkmark"></span><span>Values & Beliefs</span></label></div>
                      <div class="lm__term"><label class="lm-check-term mb-0 lh-1 text-white"><input type="checkbox"><span
                        class="checkmark"></span><span>Psychology</span></label></div>
                    </div>
                  </div>
                  
                  
                  
                  
                  <div class="lm__quizbox">
                    <div class="lm__quiz-question shadow">
                      <p class="m-0">Q.2 Recognize the image</p>
                    </div>
                    <div class="lm__quiz-image w-100 text-center"> <img class="mx-auto" src="{{asset('assets/images/que-img.jpg')}}">
                    </div>
                    <div class="lm__preview-choices shadow">
                      <div class="row align-items-center">
                        <div class="lm__term col-12 col-sm-6 mb-3">
                          <div class="form-check d-flex gap-3 mt-1 align-items-center">
                            <input class="form-check-input"
                              id="flexRadioDefault1" type="radio" name="flexRadioDefault">
                            <label
                              class="lm__choice--img mb-0" for="flexRadioDefault1">
                              <img src="{{asset('assets/images/opt-a.jpg')}}">
                              <p class="mb-0">Surpresses</p>
                            </label>
                          </div>
                        </div>
                        <div class="lm__term col-12 col-sm-6 mb-3">
                          <div class="form-check d-flex gap-3 mt-1 align-items-center">
                            <input class="form-check-input"
                              id="flexRadioDefault2" type="radio" name="flexRadioDefault">
                            <label
                              class="lm__choice--img mb-0" for="flexRadioDefault2">
                              <img src="{{asset('assets/images/opt-b.jpg')}}">
                              <p class="mb-0">Activates</p>
                            </label>
                          </div>
                        </div>
                        <div class="lm__term col-12 col-sm-6 mb-3 mb-sm-0">
                          <div class="form-check d-flex gap-3 mt-1 align-items-center">
                            <input class="form-check-input"
                              id="flexRadioDefault3" type="radio" name="flexRadioDefault">
                            <label
                              class="lm__choice--img mb-0" for="flexRadioDefault3">
                              <img src="{{asset('assets/images/opt-c.jpg')}}">
                              <p class="mb-0">Enhances</p>
                            </label>
                          </div>
                        </div>
                        <div class="lm__term col-12 col-sm-6 mb-3 mb-sm-0">
                          <div class="form-check d-flex gap-3 mt-1 align-items-center">
                            <input class="form-check-input"
                              id="flexRadioDefault4" type="radio" name="flexRadioDefault">
                            <label
                              class="lm__choice--img mb-0" for="flexRadioDefault4">
                              <p class="mb-0">Improves response time</p>
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="lm__quizbtn w-100 d-flex justify-content-center">
                    <a class="btn btn--primary mt-3" href="#!" type="button" data-bs-toggle="modal"
                    data-bs-target="#quiz-result">Submit</a></div>
                </form>
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
                          <a class="course-con-list-item complete" href="">
                            <div class="d-flex align-items-center justify-content-between">
                              <div class="d-flex align-items-center">
                                <div class="icon-div"> <span class="icon">
                                  <img class="in-svg" src="{{asset('assets/images/Check02.svg')}}" alt=""></span></div>
                                <p class="mb-0">Audio Lesson</p>
                              </div>
                              <span class="mb-0 text-sm-12">5:25</span>
                            </div>
                          </a>
                          <!-- 4 -->
                          <a class="course-con-list-item complete" href="">
                            <div class="d-flex align-items-center justify-content-between">
                              <div class="d-flex align-items-center">
                                <div class="icon-div"> <span class="icon">
                                  <img class="in-svg" src="{{asset('assets/images/Check02.svg')}}" alt=""></span></div>
                                <p class="mb-0">Tasks</p>
                              </div>
                              <span class="mb-0 text-sm-12">5:25</span>
                            </div>
                          </a>
                          <!-- 5 -->
                          <a class="course-con-list-item active" href="">
                            <div class="d-flex align-items-center justify-content-between">
                              <div class="d-flex align-items-center">
                                <div class="icon-div"> <span class="icon"><img class="in-svg" src="{{asset('assets/images/play-btn.svg')}}" alt=""></span></div>
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