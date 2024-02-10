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
              <p class="mb-3 color-light">In this video, Zoe Williams explains the necessary lifestyle changes required of you in order for this program to have the maximum impact. To achieve your desired outcomes, it may mean limiting or completely cutting out certain areas of your consumption, which have become a habit. In doing so, you will become more clear-minded and open to all of the potential benefits within this program. </p>
              <p class="mb-0 color-light">The video talks about the significance of your awareness and potentially eradication of:</p>
              <ul class="overview-list color-light">
                <li>Caffeine</li>
                <li>Alcohol </li>
                <li>Synthetic sugars</li>
                <li>Media information</li>
                <li>Social media </li>
              </ul>
              <!-- <div class="card-image"> <img src="{{asset('assets/images/module.jpg')}}" alt=""></div> -->
              <div class="card-image position-relative rounded-4">
              <video width="100%" height="100%" controls>
                <source src="{{asset('assets/images/Luminary.mp4')}}" type="video/mp4">
                <source src="{{asset('assets/images/Luminary.mp4')}}" type="video/ogg">
              </video>
                
              </div>
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
                <a class="btn btn--secondry cr-btn-prev me-2" href="{{ route('user.courses.video') }}">Prev</a>
                <a class="btn btn--primary cr-btn-next me-4" href="{{ route('user.courses.audio') }}">Next</a>
              </div>
              </div>
            </div>
            <!--Start  Course module Right panel-->
            @include('users/course/course_module_right_panel');
            <!-- End Course module Right panel-->
            
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