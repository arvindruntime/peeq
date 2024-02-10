@extends('layouts.admin.master')
@section('content')

<main class="main-content" id="main">
      <section class="lm__dash-con lm__course-list-admin course-edit">
        <span class="lm_vec">
          <img class="light" src="{{asset('assets/images/light.png')}}" alt="">
          <img class="dark" src="{{asset('assets/images/dark.png')}}" alt="">
        </span>
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="create-list-admin">
                <div class="create-list-admin-title">
                  <h4 class="mb-0 text-primary fw-semibold">Edit PEEQ Course</h4>
                </div>
                <div class="create-admin-form">
                  <form action="" method="get">
                    <div class="row">
                      <div class="col-12">
                        <div class="mb-3 admin-file-upd">
                          <label class="form-label w-100" for="formFile">
                            Course Thumbnail
                            <div class="admin-file-upd-input position-relative mt-1 thunbnail-edit">
                              <div class="lm_vedio-card card">
                                <div class="card-img position-relative"><img class="w-100"
                                  src="{{asset('assets/images/courses3.jpg')}}" alt=""></div>
                              </div>
                              <div class="btn btn--dark" type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasRight13" aria-controls="offcanvasRight13">Change Image</div>
                            </div>
                          </label>
                        </div>
                        <div class="mb-3 admin-file-upd thunbnail-edit">
                          <label class="form-label w-100"
                            for="formFile1">
                            Course Preview Video
                            <div
                              class="admin-file-upd-input position-relative mt-1 vedio-edit">
                              <div class="lm_vedio-card card">
                                <div class="card-img position-relative">
                                  <img class="w-100"
                                    src="{{asset('assets/images/courses3.jpg')}}" alt="">
                                  <div class="card-img-overlay">
                                    <div class="d-flex justify-content-center align-items-center text-center h-100">
                                      <div class="play-video"><img class="in-svg" src="{{asset('assets/images/play-1.svg')}}" alt="">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="btn btn--dark" type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasRight13" aria-controls="offcanvasRight13">Change Video</div>
                            </div>
                          </label>
                        </div>
                        <div class="mb-3 admin-file-inp"><label class="form-label" for="exampleFormControlInput1">Course
                          Name</label><input class="form-control shadow" id="exampleFormControlInput1" type="text"
                            placeholder="e.g. The Astronauts Guide to Exercise">
                        </div>
                        <div class="mb-3 admin-file-inp"><label class="form-label" for="exampleFormControlInput1">Course
                          Tagline (Optional)</label><input class="form-control shadow" id="exampleFormControlInput1"
                            type="text" placeholder="e.g. The Astronauts Guide to Exercise">
                        </div>
                        <div class="mb-3 admin-file-select">
                          <label for="id_label_multiple">Add Coaches</label>
                          <select
                            class="select2 form-select js-example-templating js-states form-control select2-hidden-accessible select-img"
                            aria-label="Default select example" multiple="multiple">
                            <option value="1" data-src="{{asset('assets/images/avatar/1.jpg')}}">Arlene McCoy</option>
                            <option value="2" data-src="{{asset('assets/images/avatar/2.jpg')}}">Savannah Nguyen</option>
                            <option value="3" data-src="{{asset('assets/images/avatar/3.jpg')}}">Albert Flores</option>
                          </select>
                        </div>
                        <div class="mb-3 admin-file-textarea"><label class="form-label"
                          for="exampleFormControlTextarea1">Example textarea</label><textarea
                          class="form-control shadow" id="exampleFormControlTextarea1" rows="3"
                          placeholder="Description"></textarea></div>
                        <div class="price-title">
                          <h5 class="mb-2">Course Price</h5>
                        </div>
                        <div class="course-price-tab my-2">
                          <ul class="nav nav-pills mb-3 nav-primary shadow" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation"><button class="nav-link active" id="pills-free-tab"
                              data-bs-toggle="pill" data-bs-target="#pills-free" type="button" role="tab"
                              aria-controls="pills-free" aria-selected="true">Free</button></li>
                            <li class="nav-item" role="presentation"><button class="nav-link" id="pills-paid-tab"
                              data-bs-toggle="pill" data-bs-target="#pills-paid" type="button" role="tab"
                              aria-controls="pills-paid" aria-selected="false">Paid</button></li>
                          </ul>
                          <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-free" role="tabpanel"
                              aria-labelledby="pills-free-tab" tabindex="0"> </div>
                            <div class="tab-pane fade" id="pills-paid" role="tabpanel"
                              aria-labelledby="pills-pais-tab" tabindex="0">
                              <div class="row">
                                <div class="col-md-6 mb-3">
                                  <div class="admin-file-inp"><input class="form-control shadow"
                                    id="exampleFormControlInput2" type="text" placeholder="e.g. 499"></div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- <div class="review-title">
                            <h5 class="mb-2">Reviews</h5>
                            <p class="mb-0">Allow Members to add Reviews on this Course.</p>
                          </div> -->
                          <!-- <div class="lm_on-off shadow my-3">
                            <div class="lm_switch">
                              <div class="form-check form-switch ps-0 mb-2">
                                <div class="d-flex gap-5 align-items-center justify-content-between"><label
                                  class="form-check-label title-font mb-0" id="on-off" for="flexSwitchCheckChecked1">On
                                  </label><input class="form-check-input on-off" id="flexSwitchCheckChecked1"
                                    type="checkbox" role="switch" checked="">
                                </div>
                              </div>
                            </div>
                          </div> -->
                          <div class="lm_privacy mb-3">
                            <div class="d-flex justify-content-center align-item-center text-center">
                              <div class="d-block">
                                <p class="text-white mb-0 fw-bold">Privacy - Secret</p>
                                <p class="text-white mb-0"> By default the course will be private can change after
                                  creating modules.
                                </p>
                              </div>
                            </div>
                          </div>
                          <div class="lm_crt-btn d-flex justify-content-center align-item-center">
                            <a class="btn btn--primary" href="{{ route('admin.courses.list') }}">Save</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

@endsection