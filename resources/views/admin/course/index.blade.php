@extends('layouts.admin.master')
@section('content')

  <main class="main-content" id="main">
    <section class="lm__dash-con lm__course-list-admin">
        <span class="lm_vec"><img class="light"
          src="{{asset('assets/images/light.png')}}" alt=""><img class="dark" src="{{asset('assets/images/dark.png')}}" alt=""></span>
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="create-list-admin">
                <div class="create-list-admin-title">
                  <h4 class="mb-0 text-primary fw-semibold">PEEQ Courses</h4>
                </div>
                <div class="create-list-admin-tab">
                  <!-- <ul class="nav nav-pills mb-4 nav-primary" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation"><button class="nav-link active" id="pills-all-tab"
                      data-bs-toggle="pill" data-bs-target="#pills-all" type="button" role="tab"
                      aria-controls="pills-all" aria-selected="true">All</button></li>
                    <li class="nav-item" role="presentation"><button class="nav-link" id="pills-private-tab"
                      data-bs-toggle="pill" data-bs-target="#pills-private" type="button" role="tab"
                      aria-controls="pills-private" aria-selected="false">Private</button></li>
                    <li class="nav-item" role="presentation"><button class="nav-link" id="pills-public-tab"
                      data-bs-toggle="pill" data-bs-target="#pills-public" type="button" role="tab"
                      aria-controls="pills-public" aria-selected="false">Public</button></li>
                    <li class="nav-item" role="presentation"><button class="nav-link" id="pills-archive-tab"
                      data-bs-toggle="pill" data-bs-target="#pills-archive" type="button" role="tab"
                      aria-controls="pills-archive" aria-selected="false">Archive</button></li>
                  </ul> -->
                  <a class="create_admin-course" href="{{ route('admin.courses.create') }}">
                    <div class="create-course-btn text-primary gap-2"> <span> <img class="in-svg"
                      src="{{asset('assets/images/plus-3.svg')}}" alt=""></span>Create Course</div>
                  </a>
                  <!-- <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab"
                      tabindex="0">
                    </div>
                    <div class="tab-pane" id="pills-private" role="tabpanel" aria-labelledby="pills-private-tab"
                      tabindex="0">2</div>
                    <div class="tab-pane" id="pills-public" role="tabpanel" aria-labelledby="pills-public-tab"
                      tabindex="0">3</div>
                    <div class="tab-pane" id="pills-archive" role="tabpanel" aria-labelledby="pills-archive-tab"
                      tabindex="0">4</div>
                  </div> -->
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
  </main>

@endsection