@extends('layouts.admin.master')
@section('content')
<main class="main-content" id="main">
      <section class="lm__dash-con">
        <span class="lm_vec"><img class="light" src="{{asset('assets/images/light.png')}}" alt=""><img
          class="dark" src="{{asset('assets/images/dark.png')}}" alt=""></span>
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="lm__quiz lm__quiz-admin lm__quiz--preview ">
                <form action="">
                  <div class="lm__quizheading">
                    <h4>Preview</h4>
                  </div>
                  <div class="lm__quiztopic">
                    <h5>How To Get The Most Out Of This Program</h5>
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
                              <p class="mb-0">XYZ</p>
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
                              <p class="mb-0">PQR</p>
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
                              <p class="mb-0">ABC</p>
                            </label>
                          </div>
                        </div>
                        <div class="lm__term col-12 col-sm-6 mb-3 mb-sm-0">
                          <div class="form-check d-flex gap-3 mt-1 align-items-center">
                            <input class="form-check-input"
                              id="flexRadioDefault4" type="radio" name="flexRadioDefault">
                            <label
                              class="lm__choice--img mb-0" for="flexRadioDefault4">
                              <p class="mb-0">All of the Above</p>
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="lm__quizbtn w-100 d-flex justify-content-center mb-5">
                    <a class="btn btn--primary mt-3" href="#">Submit</a></div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

@endsection