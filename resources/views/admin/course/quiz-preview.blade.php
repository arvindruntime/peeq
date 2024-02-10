@extends('layouts.admin.master')
@section('content')
{{-- {{ dd($quizzes);}} --}}

<main class="main-content" id="main">
      <section class="lm__dash-con">
        <span class="lm_vec"><img class="light" src="{{asset('assets/images/light.png')}}" alt=""><img
          class="dark" src="{{asset('assets/images/dark.png')}}" alt=""></span>
        
          <div class="container">
        
          <div class="row">
            <div class="col-12">
              <div class="lm__quiz lm__quiz-admin lm__quiz--preview ">
                <form action="">
                  <div class="lm__quizheading mb-2">
                    <a href="{{ url()->previous() }}" class="btn btn--primary rounded-4 py-2">Go Back</a>
                  </div>
                  <div class="lm__quiztopic">
                    <h5>How To Get The Most Out Of This Program</h5>
                  </div>
                  
              @foreach ($quizzes as $quiz)
                  
                @if($quiz->question_type=="multi_select")
              
                  <div class="lm__quizbox mb-4">
                    <div class="lm__quiz-question shadow">
                      <p class="m-0">{{ $quiz->question }}</p>
                    </div>
                    <div class="lm__preview-choices shadow">
                      
                      {{-- {{ dd($quiz) }} --}}
                      @foreach ($quiz->quizOptions as $option)
                      
                      @php
                        $answered = "";
                        if($option->admin_answer!='')
                        {
                          $answered = "right";                          
                        }
                      @endphp
                        <div class="lm__term mb-3">
                          <label class="lm-check-term mb-0 lh-1 text-white">
                            <input type="checkbox" name="option[]" value="{{ $option->option }}" {{ ($option->admin_answer!='') ? 'checked' : ''  }}>
                            <span class="checkmark"></span>
                            <span>{{ $option->option }}</span>
                          </label>
                        </div>
                      @endforeach
                      
                      {{-- <div class="lm__term mb-3"><label class="lm-check-term mb-0 lh-1 text-white"><input
                        type="checkbox"><span class="checkmark"></span><span>Past Experiences</span></label></div>
                      <div class="lm__term mb-3"><label class="lm-check-term mb-0 lh-1 text-white"><input
                        type="checkbox"><span class="checkmark"></span><span>Values & Beliefs</span></label></div>
                      <div class="lm__term"><label class="lm-check-term mb-0 lh-1 text-white"><input type="checkbox"><span
                        class="checkmark"></span><span>Psychology</span></label></div> --}}
                    </div>
                  </div>
                  
                @endif
                  
                @if($quiz->question_type=="single_select")
                  
                  <div class="lm__quizbox">
                    <div class="lm__quiz-question shadow">
                      <p class="m-0">{{ $quiz->question }}</p>
                    </div>
                    @if($quiz->question_image!='')
                      <div class="lm__quiz-image w-100 text-center"> <img class="mx-auto" src="{{ $quiz->question_image }}" height="500px" width="500px"></div>
                    @endif
                    <div class="lm__preview-choices shadow">
                      <div class="row align-items-center">
                        
                      @foreach ($quiz->quizOptions as $option)
                        <div class="lm__term col-12 col-sm-6 mb-3">
                          <div class="form-check d-flex gap-3 mt-1 align-items-center">
                            <input class="form-check-input" id="option" type="radio" name="option[]" value="{{ $option->option }}" {{ ($option->option==$option->admin_answer) ? 'checked' : ''  }}>
                            <label
                              class="lm__choice--img mb-0" for="flexRadioDefault1">
                              @if($option->option_image!='')
                                <img src="{{ $option->option_image }}" height="200px" width="200px">                                
                              @endif
                              
                              <p class="mb-0">{{ $option->option }}</p>
                            </label>
                          </div>
                        </div>
                      @endforeach  
                        {{-- <div class="lm__term col-12 col-sm-6 mb-3">
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
                        </div> --}}
                        
                        
                      </div>
                    </div>
                  </div>
                  
                @endif
                
              @endforeach
                  
                  {{-- <div class="lm__quizbtn w-100 d-flex justify-content-end mb-5"><a class="btn btn--gray mt-3 me-2 me-lg-3"
                    href="#!">Edit</a><a class="btn btn--primary mt-3" href="#!" type="button" data-bs-toggle="modal"
                    data-bs-target="#quiz-result">Submit</a></div> --}}
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
@endsection