@extends('layouts.admin.master')
@section('content')
<style>
  .lm_course-buy-card.lm_module-add{
    overflow: visible !important;
  }
</style>
<main class="main-content" id="main">
  <section class="lm__dash-con mb-5 lm__view-module">
    <span class="lm_vec"><img class="light"
      src="{{asset('assets/images/light.png')}}" alt=""><img class="dark" src="{{asset('assets/images/dark.png')}}" alt=""></span>
    <div class="container">
      <div class="mb-3">
          <a href="{{route('admin.courses.inner', ['id' => $courseModule->course_id])}}" class="btn btn--primary rounded-4 py-2">Go Back</a>
      </div>
      <div class="d-flex lm__course-buy-main">
        <div class="lm__course-buy-inner me-1">
          <div class="lm_course-buy-con">
              <div class="lm_course-buy-card card bg-gradient">
                <h2 class="fw-bold text-white">{{ $courseModule->title }}</h2>
              </div>
              @foreach ($quizzes as $quiz)
                <div class="lm_course-buy-card lm_module-add mb-2">
                  <div class="d-flex gap-2 justify-content-between align-items-center">
                    <div class="d-flex gap-2 align-items-center"><span> <img class="in-svg"
                          src="{{asset('assets/images/eye-off.svg')}}" alt=""></span>
                      <h6 class="mb-0 text-dark fw-bold">{{ $quiz->question }}</h6>
                    </div>
                    
                    {{-- <div class="dropdown mt-1"><a class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><span>
                      <!-- Svg -->
                      <svg width="4" height="18" viewBox="0 0 4 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_2661_18626)">
                        <path d="M2 4C3.10456 4 4 3.10457 4 2C4 0.895428 3.10456 0 2 0C0.895438 0 0 0.895428 0 2C0 3.10457 0.895438 4 2 4Z" fill="#252A36"/><path d="M2 11C3.10456 11 4 10.1046 4 9C4 7.89543 3.10456 7 2 7C0.895438 7 0 7.89543 0 9C0 10.1046 0.895438 11 2 11Z" fill="#252A36"/><path d="M2 18C3.10456 18 4 17.1046 4 16C4 14.8954 3.10456 14 2 14C0.895438 14 0 14.8954 0 16C0 17.1046 0.895438 18 2 18Z" fill="#252A36"/>
                        <g filter="url(#filter0_d_2661_18626)"><rect x="-80" y="25" width="320" height="168" rx="20" fill="white"/>
                        </g></g><defs><filter id="filter0_d_2661_18626" x="-88" y="17" width="336" height="184" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB"><feFlood flood-opacity="0" result="BackgroundImageFix"/><feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/><feOffset/><feGaussianBlur stdDeviation="4"/>
                        <feComposite in2="hardAlpha" operator="out"/><feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.15 0"/><feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_2661_18626"/>
                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_2661_18626" result="shape"/>
                        </filter><clipPath id="clip0_2661_18626"><rect width="4" height="18" fill="white"/></clipPath></defs>
                      </svg>
                      </span></a>
                      <ul class="dropdown-menu">
                        <li><a href="{{ route('quiz.update' , ['id' => $quiz->id]) }}" class="dropdown-item"> Edit </a></li>
                        <li><a onclick="deleteQuiz('{{ $quiz->id }}')" class="dropdown-item"> Delete </a></li>                        
                      </ul>
                    </div> --}}
                    
                    <div class="dropdown mt-1"><a class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><span>
                      <!-- Svg -->
                      <svg width="4" height="18" viewBox="0 0 4 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_2661_18626)">
                        <path d="M2 4C3.10456 4 4 3.10457 4 2C4 0.895428 3.10456 0 2 0C0.895438 0 0 0.895428 0 2C0 3.10457 0.895438 4 2 4Z" fill="#252A36"/><path d="M2 11C3.10456 11 4 10.1046 4 9C4 7.89543 3.10456 7 2 7C0.895438 7 0 7.89543 0 9C0 10.1046 0.895438 11 2 11Z" fill="#252A36"/><path d="M2 18C3.10456 18 4 17.1046 4 16C4 14.8954 3.10456 14 2 14C0.895438 14 0 14.8954 0 16C0 17.1046 0.895438 18 2 18Z" fill="#252A36"/>
                        <g filter="url(#filter0_d_2661_18626)"><rect x="-80" y="25" width="320" height="168" rx="20" fill="white"/>
                        </g></g><defs><filter id="filter0_d_2661_18626" x="-88" y="17" width="336" height="184" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB"><feFlood flood-opacity="0" result="BackgroundImageFix"/><feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/><feOffset/><feGaussianBlur stdDeviation="4"/>
                        <feComposite in2="hardAlpha" operator="out"/><feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.15 0"/><feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_2661_18626"/>
                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_2661_18626" result="shape"/>
                        </filter><clipPath id="clip0_2661_18626"><rect width="4" height="18" fill="white"/></clipPath></defs>
                      </svg>
                      </span></a>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('quiz.update' , ['id' => $quiz->id]) }}"> Edit Quiz</a></li>
                        <li><a class="dropdown-item" onclick="deleteQuiz('{{ $quiz->id }}')"> Delete Quiz</a></li>
                        
                      </ul>
                    </div>
                    
                    
                    {{-- <div class="d-flex btn-add-view gap-2"> --}}
                      {{-- <div class="btn btn--primary"><a href="{{ route('quiz.update' , ['id' => $quiz->id]) }}" class="dropdown-item"> Edit </a></div> --}}
                    
                      {{-- <div class="btn btn--primary"><a onclick="deleteQuiz('{{ $quiz->id }}')" class="dropdown-item"> Delete </a></div> --}}
                    {{-- </div> --}}
                  </div>
                </div>
              @endforeach
              <a class="lm_course-buy-card lm_module-add w-100 mb-2" href="{{ route('admin.quiz.create', ['course_id' => $courseModule->course_id, 'course_module_id' => $courseModule->id]) }}">
                <div class="d-flex gap-2">
                  <span> <img class="in-svg" src="{{asset('assets/images/plus.svg')}}" alt=""></span>
                  <p class="mb-0 text-dark">Add Quiz </p>
                </div>
              </a>
          </div>
        </div>
       
      </div>
    </div>
  </section>
</main>
<script>
  function deleteQuiz(id) {
      let _token =  $('meta[name="csrf-token"]').attr('content');
      let url = '{{ route("quiz.delete", ":id") }}';
      url = url.replace(':id',id);
      if(confirm('Are you sure you want delete this quiz ?') === true)
      { 
      $.ajax({
          url: url
          , method: "delete"
          , data: {
              _token: _token
              , id: id
          }
      }).done(function(data) {
        console.log('test by arvind');
          if (data.error || data.status == "400")
          {
              var error_message = data.message;                                    
              Swal.fire({
                  toast: true,
                  icon: 'warning',
                  title: error_message ,
                  position: 'top-right',
                  showConfirmButton: false,
                  timer: 2000,
                  timerProgressBar: false,
                  // footer: '<a href="">Click to open</a>',
                  didOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                  }
              }); 
              return false;
                      
          } else if (data.status == "200") {
              var success_message = data.message;                                    
              Swal.fire({
                  toast: true,
                  icon: 'success',
                  title: success_message ,
                  position: 'top-right',
                  showConfirmButton: false,
                  timer: 2000,
                  timerProgressBar: true,
                  // footer: '<a href="">Click to open</a>',
                  didOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                  }
              });     
              window.location.reload();
          }
      });
    }
    return false;
  }
</script>
@endsection
