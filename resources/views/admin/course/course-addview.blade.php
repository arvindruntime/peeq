@extends('layouts.admin.master')
@section('content')

<main class="main-content" id="main">
      <section class="lm__dash-con mb-5 lm__view-module">
        <span class="lm_vec"><img class="light"
          src="{{asset('assets/images/light.png')}}" alt=""><img class="dark" src="{{asset('assets/images/dark.png')}}" alt=""></span>
        <div class="container">
          <div class="d-flex lm__course-buy-main">
            <div class="lm__course-buy-inner me-1">
              <div class="lm_course-buy-con">
                <div class="lm_course-buy-card card bg-gradient">
                  <h2 class="fw-bold text-white">Self Mastery Program</h2>
                  <h6 class="text-white mb-0">Elevate your emotional intelligence, self-awareness and leadership skills
                    with our Self Mastery online program.
                  </h6>
                </div>
                <!-- Moveable -->
                <div class="dropzone-teams">
                  <div class="dropzone-users">
                    <div class="d-flex align-items-center">
                      <span class="me-2 user-handle">
                        <img class="in-svg" src="{{asset('assets/images/move.svg')}}" alt="">
                      </span>
                      <div class="lm_course-buy-card lm_module-add mb-2 drag-user w-100">
                        <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center">
                          <div class="d-flex gap-2 align-items-center">
                            <span class="eye-close"> 
                              <img class="in-svg close" src="{{asset('assets/images/eye-off.svg')}}" alt="">
                              <img class="in-svg open" src="{{asset('assets/images/eye-on.svg')}}" alt="">
                            </span>
                            <h6 class="mb-0 text-dark fw-bold">How To Get The Most Out Of This Program</h6>
                          </div>
                          <div class="d-flex btn-add-view gap-2">
                            <div class="btn btn--primary"><a href="{{ route('admin.courses.add.module' , ['id' => 16]) }}" class="text-white"> Edit </a></div>
                          </div>
                        </div>
                      </div>

                    </div>
                    <div class="d-flex align-items-center">
                      <span class="me-2 user-handle">
                        <img class="in-svg" src="{{asset('assets/images/move.svg')}}" alt="">
                      </span>
                      <a class="lm_course-buy-card lm_module-add w-100 mb-2" href="{{ route('admin.courses.add.module' , ['id' => 16]) }}">
                        <div class="d-flex gap-2">
                          <span> <img class="in-svg" src="{{asset('assets/images/plus.svg')}}" alt=""></span>
                          <p class="mb-0 text-dark">Add Module </p>
                        </div>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="lm_vedio-card card ms-0 ms-lg-3 mt-3 mt-lg-0">
              <div class="card-img position-relative">
                <img class="w-100" src="{{asset('assets/images/courses3.jpg')}}" alt="">
                <div class="card-img-overlay">
                  <div class="d-flex justify-content-center align-items-center text-center h-100">
                    <a class="play-video"
                      href="" data-bs-toggle="modal" data-bs-target="#exampleModal25">
                      <img class="in-svg"
                        src="{{asset('assets/images/play-1.svg')}}" alt="">
                      <h6 class="text-white">Preview</h6>
                    </a>
                  </div>
                </div>
              </div>
              <div class="card-body p-0 pt-2">
                <h4 class="mb-2"> <a class="text-dark" href="#">Self Mastery Program </a></h4>
                <a class="btn btn--primary d-block w-100 py-3 mb-2" href="{{ route('admin.course.edit') }}">Edit Course</a>
                <!-- <a class="btn btn--dark-lenear d-block w-100 py-3" href="{{ route('admin.courses.setting') }}">Manage Course Setting</a> -->
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>


@endsection
