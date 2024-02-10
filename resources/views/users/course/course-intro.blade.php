@extends('layouts.admin.master')
@section('content')
<style>
.disabled-div {
    pointer-events: none;
    background-color: #f0f0f0; /* Example styling for a disabled look */
    opacity: 0.7; /* Example opacity to make it look disabled */
}
       
.tala_khalu svg path {
  fill: #29BA0F !important
}
  .lm__term.mb-3.right span {
    color: #11D147 !important;
  }
  
  .lm__term.mb-3.wrong span {
    color: #CC4141 !important;
  }

  #section-loader{
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    /* background-color: rgb(255, 255, 255); */
    background: #fff !important;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9;
    border-radius: 20px;

  }
  body.dark #section-loader 
  {
    background: #0a2538 !important;
  }
  .auto-load {
    display: none;
  }

  .errorClass {
    border: 1px solid red !important;
  }


  /* Loader */


  .loader {
    /* margin: 20% auto 0; */
    transform: translateZ(0);
  }

  .loader:before,
  .loader:after {
    content: '';
    position: absolute;
    top: 0;
  }

  .loader:before,
  .loader:after,
  .loader {
    border-radius: 50%;
    width: 20px;
    height: 20px;
    animation: animation 1.2s infinite ease-in-out;
  }

  .loader {
    animation-delay: -0.16s;
  }

  .loader:before {
    left: -3.5em;
    animation-delay: -0.32s;
  }

  .loader:after {
    left: 3.5em;
  }

  @keyframes animation {

    0%,
    80%,
    100% {
      box-shadow: 0 2em 0 -1em #E3A130;
    }

    40% {
      box-shadow: 0 2em 0 0 #E3A130;
    }
  }

.overlay-onload {
    position: absolute;
    top: 0;
    right: 0;
    left: 0;
    bottom: 0;
    width: 100%;
    height: 100%;
    border-radius: 20px;
    background: #fff;
}
body.dark .overlay-onload 
{
  background: #fff;
}
.content-wraper{
  position: relative;
    z-index: 9;
    background: #fff;
    padding: 20px;
    border-radius: 20px;

}
body.dark .content-wraper{
  background: var(--bg-dark-theame);
  color: #E6E6E6 !important;
}

body.dark .content-wraper p ,
body.dark .content-wraper span{
  color: #E6E6E6 !important;
}
body.dark .ready-player-1{
  background: #00152f
}

body.dark  .ready-player-1 svg path{
  fill : #fff;
}

body.dark  .green-audio-player .slider{
  background: #03253c;
}
.card .subModulePreview p span{
    background: transparent !important;
}

body.dark .lm__overview-card p span{
  color: #fff !important;
}
body .accordion-item .accordion-header .accordion-button::before{
  content: none;
}
</style>

<script>
  function showSectionContent() {
  // Show the auto-load sections
  $('.auto-load').show();
}

function showSectionLoader(sectionId='') {
  // Show the loader initially
  $('#section-loader' + sectionId).show();
}

function hideSectionLoader(sectionId='') {
  // Hide the loader when content is loaded
  $('#section-loader' + sectionId).hide();
}
  
$(document).ready(function() {
  // Show the initial loader
  showSectionLoader();

  // Hide the content of all auto-load sections initially
  $('.auto-load').hide();

  // Simulate a delay of 2 seconds to demonstrate loading
  setTimeout(function() {
    // Show the content of each auto-load section and hide the loader
    $('.auto-load').each(function() {
      showSectionContent($(this));
    });
    hideSectionLoader();
  }, 500);
});
</script>
<main class="main-content" id="main">
  <section class="lm__dash-con mb-5 lm__module-overview">
    <span class="lm_vec"><img class="light" src="{{asset('assets/images/light.png')}}" alt=""><img class="dark" src="{{asset('assets/images/dark.png')}}" alt=""></span>
    <div class="container">
      <div class="row lm__module-overview">
        <div class="col-12">
          @if(Auth::user()->is_admin == 1)
          <div class="mb-3">
            <a href="{{ route('admin.courses.inner', ['id' => $course_id]) }}" class="btn btn--primary rounded-4 py-2">Go Back</a>
          </div>
          @else
          <div class="mb-3">
            <a href="{{ route('user.courses.view', ['id' => $course_id]) }}" class="btn btn--primary rounded-4 py-2">Course Overview</a>
          </div>
          @endif
          <div class="lm__module-overview-con module-view-con">
            <!-- 1 -->
            <div class="lm__overview-card p-0">
            <div class="card shadow h-100 p-3 rounded-4 border-0">
              <div id="section-loader" class="loader-container">
                {{-- <div class="loadaer-logo">
                  <img src="{{ asset('assets/images/dash-logo.svg') }}">
                </div> --}}
                <div class="loader"></div>
              </div>
              {{-- Module overview details --}}
              
            @if($moduleData[0]['mark_as_complete']!=2)
              <div class="overlay-onload module_overview_description">
                <div class="content-wraper">
                  <h2>{!! $moduleData[0]['course']['course_name'] ?? '' !!}</h2>    
                  {!! $moduleData[0]['course']['module_overview_description'] ?? '' !!}    
                  <div class="lm__module-button text-end d-flex justify-content-end align-items-center w-100">
                    <a class="btn btn--primary cr-btn-next me-4" onclick="hideCourseModuleOverview()" >Start Course Here</a>
                  </div>
                </div>
              </div>
            @endif

            {{-- Interactive Button Position Change by ap --}}
            <div class="row-12 d-flex justify-content-between">
                <h5 class="fw-bold text-primary subHeaderTitle">{{ $moduleData[0]['course']['course_name'] ?? '' }}
                </h5>
              <div class="d-flex justify-content-between appendButtons">
                <div class="lm-workbook-wrap InteractivePreviewButton float-end mt-0">
                  <a class="InteractivePreview d-none" target="_blank">
                    <div class="lm-workbook">
                      <img src="{{asset('assets/images/icon-pdf.svg')}}" alt="">
                      <span>Interactive Workbook</span>
                    </div>
                  </a>
                </div>
              </div>
            </div>
              <div class="audio-wali-div" style="display: none">
                <div class="ready-player-1 player">
                    <audio id="audioPlayer" controls>
                        
                    </audio>
                </div>
              </div>
              <!-- code commnted by kj -->
              <!--<div class="lm_audio mb-4">
                <div class="lm_audio-card">
                  <div class="audio-player">
                    <div class="timeline">
                      <div class="progress"></div>
                    </div>
                    <div class="controls">
                      <div class="play-container">
                        <div class="toggle-play play">
                        </div>
                      </div>
                      <div class="time">
                        <div class="current">0:00</div>
                        <div class="divider1">/</div>
                        <div class="length"></div>
                      </div>
                      <div class="volume-container">
                        <div class="volume-button">
                          <div class="volume icono-volumeMedium">
                            <img class="unmute" src="https://i.ibb.co/gRwV26r/volume.png" alt="">
                            <img class="mute" src="https://i.ibb.co/rZWg6ZV/mdi-volume-mute.png" alt="mdi-volume-mute">
                          </div>
                        </div>

                        <div class="volume-slider">
                          <div class="volume-percentage"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>--> 
               
              <!-- <h5 class="fw-bold">What You'll Get </h5> -->
              <!-- <p class="mb-3 color-light">Welcome to Self Mastery and congratulations on beginning this exciting journey. Before you begin, please watch this special video message from Zoe Williams, Founder & CEO of PEEQ and your Lead Facilitator of the Self Mastery Program. </p>
              <p class="mb-0 color-light">What You'll Get From Your Self Mastery Program:</p> -->
              
              <input type="hidden" name="audioFile" class="audioFile"/>
            
              <span class="subModulePreview">
                {{ $moduleData[0]['course']['description'] ?? ''}}
                {{-- <div class="card-image"> <img src="{{ $moduleData[0]['course']['course_thumbnail'] ?? '' }}" alt=""></div> --}}
                
              </span>
              
              <!-- Button -->
              <div class="d-flex justify-content-between appendButtons">
                  {{-- <div class="lm-workbook-wrap InteractivePreviewButton ">
                    <a class="InteractivePreview" target="_blank">
                      <div class="lm-workbook">
                        <img src="{{asset('assets/images/icon-pdf.svg')}}" alt="">
                        <span>Interactive Workbook</span>
                      </div>
                    </a>
                  </div> --}}
                  <div class="lm__module-button text-end nextButton d-flex justify-content-end align-items-center w-100"></div>
                  
                </div>
              </div>
              @if(Auth::user()->is_admin != 1)
              <div class="d-flex justify-content-center quizSubmitBtn d-none">
                <a class="btn btn--primary mt-3" onclick="showQuizCongratulationPopup()" type="button" data-bs-toggle="modal" data-bs-target="#quiz-result">Get Results</a>
              </div>
              @endif
            <!-- 2 -->
            </div>
            <div class="lm_overview-list">
              <div class="card shadow">
                <div class="d-flex gap-2 align-items-center course-icon">
                  <span> <img class="in-svg" src="{{asset('assets/images/course.svg')}}" alt=""></span>
                  <h6 class="mb-0 fw-bold">{{ $moduleData[0]['course']['course_name'] ?? '' }}</h6>
                </div>
                <div class="accordion-course">
                  <div class="accordion" id="pq_accordionExample">
                    
                    {{-- <input type="hidden" id="course_module_id" >
                    <input type="hidden" id="course_id" >
                    <input type="hidden" id="next_type" >
                    <input type="hidden" id="complete_type" > --}}
                    <input type="hidden" id="button_label_flag" >
                    <input type="hidden" id="interactive_work_book_flag" >
                    <div id="data-wrapper">
                      @include('users.course.course-intro-xhr')
                      
                    </div>
                  
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
  </section>
 
</main>

{{-- <div class="modal fade" id="moduleThumbnailOverview" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered lm__modal-3">
      <div class="modal-content overflow-hidden">
          <div class="modal-body p-4 text-center position-relative">
              <div class="lm__shape-1 position-absolute top-0 start-0"><img class="in-svg"
                      src="assets/images/shape1.svg" alt=""></div>
              <div class="lm__shape-2 position-absolute bottom-0 end-0"><img class="in-svg"
                      src="assets/images/shape33.svg" alt=""></div>
              <div class="lm__shape-3"> <img class="in-svg" src="assets/images/logoshape1.png" alt=""></div>
              <div class="lm__modal-body">
                 
                  <div class="lm__modal-3-con position-relative z-index-3">
                      <p><img id="ModuleThumnailPreview"></p>
                  </div>
                  <div class="lm__modal-btn"> <button class="btn btn--primary px-5"
                          data-bs-dismiss="modal">Continue</button></div>
              </div>
          </div>
      </div>
  </div>
  </div> --}}
<script src="{{ asset('assets/js/green-audio-player.js') }}"></script>
<script> 
  function showQuizCongratulationPopup()
  {
    var course_id = $('#course_id').val();
    var course_module_id = $('#course_module_id').val();
    var complete_type = $('#complete_type').val();
    var next_type = $('#next_type').val();
    var numberOfModules = $('#numberOfModules').val();
    var runningModuleCount = $('#runningModuleCount').val();
    var quizSubmited = 1;
    var user =62;
    
    showSubModulePreview(course_module_id, complete_type, next_type, course_id,'',numberOfModules,runningModuleCount,quizSubmited,user); 
    var all_question_answer_given = $(".all_question_answer_given").val();
  }
   
  function showModuleOverview(imgSrc='')
  {
    $("#ModuleThumnailPreview").attr("src",imgSrc);
    
    admin = '{{ Auth::user()->is_admin }}';
    if(admin<1 || admin=='')
    {
      // 
    }
      // 
  }
  
  function UserUpdateStatus()
  {
    var course_id = $('#course_id').val();
    var course_module_id = $('#course_module_id').val();
    var complete_type = $('#complete_type').val();
    var next_type = $('#next_type').val();
    var numberOfModules = $('#numberOfModules').val();
    var runningModuleCount = $('#runningModuleCount').val();
    
    showSubModulePreview(course_module_id, complete_type, next_type, course_id,'',numberOfModules,runningModuleCount);
    user_course_activity_update_status(course_id,course_module_id,complete_type,next_type);      
  }
 
    
//   $(document).ready(function() {      
//     $('#UserUpdateStatus').click(function() {
//       var course_id = $('#course_id').val();
//       var course_module_id = $('#course_module_id').val();
//       var complete_type = $('#complete_type').val();
//       var next_type = $('#next_type').val();
//       showSubModulePreview(course_module_id, complete_type, next_type, course_id);
//       user_course_activity_update_status(course_id,course_module_id,complete_type,next_type);
      
//     });
// });

  var course_id = "{{ $course_id }}";
  startCourseModuleOverView(course_id);
// API Called : courses/13/course_modules
  function startCourseModuleOverView(id) {
    
    // Generate the URL using the named route and provide the 'course_id' parameter
    var url = "{{ route('user.courses.intro', ['course_id' => ':id']) }}";
    url = url.replace(':id', id);

    let _token = $("input[name=_token]").val();
    $.ajax({
      url: url,
      method: "GET",
      data: {
        _token: _token,
        course_id: id // Make sure to provide 'course_id'
      }
    }).done(function(response) {     
      
       $("#data-wrapper").html(response.html);
      
    });
  }
  

  function startCourseHere()
  {
    var course_id = "{{ $course_id }}";
    var course_module_id = $('#course_module_id').val();
    var complete_type = 'introduction';
    var next_type = 'video_lession';
    
    showSubModulePreview(course_module_id, complete_type, next_type, course_id);
  }
  
  // function hideCourseModuleOverview()
  // {
  //   $(".module_overview_description").addClass('d-none');
    
  //   $(".module_overview_description").fadeOut(2000); 
  // }
  
  function hideCourseModuleOverview() {
    $(".module_overview_description").fadeOut(1500, function() {
        $(this).addClass('d-none');
    });
    $("#SubModulePreviewModal").modal('show');
  }

  function warningMessage(status)
  {
    if(status == 0 && status!=1 && status!=2)
    {
      var message = 'This section is locked please finish current Module.';
      Swal.fire({
          toast: true,
          icon: 'warning',
          title: message,
          position: 'top-right',
          showConfirmButton: false,
          timer: 2000,
          timerProgressBar: false,
          didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer);
              toast.addEventListener('mouseleave', Swal.resumeTimer);
          }
      });
    }
  }
  
function showSubModulePreview(course_module_id, complete_type, next_type, course_id='', status='', numberOfModules='', runningModuleCount='', quizSubmited='',initialize='',user='') {
  
  // Generate the URL using the named route and provide the 'course_module_id' and 'type' parameters
  var url = "{{ route('course.module.preview', ['id' => ':id']) }}";
  url = url.replace(':id', course_module_id);
  // user=62;
  var user = '{{$user->id}}';

var InteractivePreviewURL = "{{ route('admin.interactive.view.workbook', ['courseModule' => ':courseModule', 'user' => ':user']) }}";
InteractivePreviewURL = InteractivePreviewURL.replace(':courseModule', course_module_id);
InteractivePreviewURL = InteractivePreviewURL.replace(':user', user);


  $(".InteractivePreview").removeClass("d-none");
  $(".InteractivePreview").attr("href", InteractivePreviewURL);
  showSectionLoader();
  
  $(".quizSubmitBtn").addClass('d-none');
  $(".nextButton").addClass('d-block');
              
  let _token = $("input[name=_token]").val();
  $.ajax({
    url: url,
    method: "GET",
    data: {
      _token: _token,
      type: complete_type,
      user:user // Provide 'type' parameter
    }
  }).done(function(data) {
                    
    if (data.status == 200) {
      $("#button_label_flag").val(data.data.button_label_flag);
      $("#interactive_work_book_flag").val(data.data.interactive_work_book_flag);
      var dataToAppend = data.data.detail_data;
      spanClass = '';
                
      admin = '{{ Auth::user()->is_admin }}';
      
      if(admin<1 || admin=='' || complete_type=="quiz" && (status=0))
      {
        //user_course_activity_update_status(course_id,course_module_id,complete_type,next_type);
      }
    //  }
       $(".audio-wali-div").css('display', 'none');
       
       $(".nextButton a").html("Next");
      
       switch (complete_type) {
        case "introduction":
        spanClass = '';
        if(data.data.detail_data!=null && data.data.detail_data!='')
        {
          spanClass = data.data.detail_data;
        }
        
        $(".subHeaderTitle").html('Introduction');
        
        $("#modulePreviewImage").attr("src",data.data.thumbnail_image);
        
        if(status=='1' && initialize>0)
        {
          $("#SubModulePreviewModal").modal('show');
        }
          var audioElem = document.getElementById("audioPlayer");
          audioElem.load()
          $(audioElem).stop();
          // Code for handling introduction submodules
          break;

        case "video_lesson":
        $(".module_overview_description").addClass('d-none');
        
        spanClass = '';
        if(data.data.detail_data!=null && data.data.detail_data!='')
        {
          spanClass = data.data.detail_data;
        }
        
        $(".subHeaderTitle").html('Video Lesson');
        var audioElem = document.getElementById("audioPlayer");
          audioElem.load()
          $(audioElem).stop();
          // Code for handling video lesson submodules
          break;

        case "audio_recording":
        $(".audio-wali-div").css('display', 'block');
        $(".module_overview_description").addClass('d-none');
        $(".subHeaderTitle").html('Audio Recording');

        spanClass = '';
        if(data.data.detail_data!=null && data.data.detail_data!='')
        {
          spanClass = data.data.detail_data;
        }
        
        if (data.data.audio_recording != '') {
            var audioUrl = data.data.audio_recording;
            $("#audioPlayer").hide();
            $(".player .holder").remove();
            $(".player .controls").remove();
            $(".player .volume").remove();
            // Get the audio element by its ID
            var audioElement = document.getElementById("audioPlayer");

            // Set the source
            audioElement.src = audioUrl;

            // Load the audio
            audioElement.load();

            // Display the audio container if it's hidden
            $(".audio-wali-div").css('display', 'block');

            // Initialize or play the audio as needed
            GreenAudioPlayer.init({
                selector: '.player',
                stopOthersOnPlay: true
            });
            var nxtBtn = $('.nextButton');
            $(nxtBtn).click(function () { 
              $(audioElement).stop();
            });
            // Update the spanClass or any other logic as needed
        }
          // Code for handling audio recording submodules
          break;

        case "task":
        $(".module_overview_description").addClass('d-none');
          
        spanClass = '';
        if(data.data.detail_data!=null && data.data.detail_data!='')
        {
          spanClass = data.data.detail_data;
        }
          
          $(".subHeaderTitle").html('Tasks');
          
          //$(".InteractivePreviewButton").show();
          var audioElem = document.getElementById("audioPlayer");
          audioElem.load()
          $(audioElem).stop();
          // Code for handling task submodules
          break;

          case "quiz":
            
          spanClass = '';
          
          $(".module_overview_description").addClass('d-none');
          $(".subHeaderTitle").html('Quiz');
          
          if(data.data.all_question_answer_given==0)
          {
            if(quizSubmited==1)
            {
              var message = 'Please, Provide All Quiz Answer!';
              Swal.fire({
                  toast: true,
                  icon: 'warning',
                  title: message,
                  position: 'top-right',
                  showConfirmButton: false,
                  timer: 2000,
                  timerProgressBar: false,
                  didOpen: (toast) => {
                      toast.addEventListener('mouseenter', Swal.stopTimer);
                      toast.addEventListener('mouseleave', Swal.resumeTimer);
                  }
              });
            }
            
            $(".nextButton").addClass('d-none');
            
            $(".quizSubmitBtn").removeClass('d-none');
            $(".quizSubmitBtn").addClass('d-block');
          }
          else
          {
            if(quizSubmited==1)
            {
              // $("#quiz_com").modal('show');
            }
            $(".subHeaderTitle").html('Quiz Results');
            $(".nextButton").removeClass('d-none');
            $(".nextButton").addClass('d-block');
          }
                    
          var questionHtml = '';
          var questionHtml = '<div class="lm__quiz-user lm__quiz--preview"><form action=""><div class="lm__quiztopic"> </div><div class="lm__quiztopic"><p class="mb-3">'+(data.data.detail_data !== null ? data.data.detail_data : '')+'</p></div>';
                  
            $.each(data.data.quiz_data, function(index, question) {
              
              var disabledDiv = '';
              if(question.question_answer_given==1)
              {                
                disabledDiv = 'disabled-div';
              }
              // Create HTML elements based on the question type
              questionHtml += '<div class="lm__quizbox '+disabledDiv+'">';
                questionHtml += '<div class="lm__quiz-question shadow">';
                  questionHtml += '<p class="m-0">Q.' + (index + 1) + ' ' + question.question + '</p>';
                  questionHtml += '</div>';
                  
                  if(question.question_image!=null && question.question_image!="")
                  {
                    questionHtml += '<div class="lm__quiz-image w-100 text-center"> <img class="mx-auto" src="'+question.question_image+'"></div>';
                  }
                  
                  questionHtml += '<div class="lm__preview-choices shadow">';
                    $.each(question.quiz_options, function(optionIndex, option) {                      
                      
                      var answered = '';              
                      var isChecked = false;
                                            
                      //// conditions testing  for admin side
                        admin = '{{ Auth::user()->is_admin }}';
                        if(admin==1)
                        {
                          $(".quizSubmitBtn").removeClass('d-none');
                          $(".quizSubmitBtn").addClass('d-block');
                          if(option.admin_answer>0 || option.admin_answer!='')
                          {
                            if(option.admin_answer!= null && option.admin_answer!="" && option.admin_answer>0)
                            {
                              answered = "right";
                              isChecked = true;
                            }
                          }
                        }
                        else
                        {
                          // if(data.data.all_question_answer_given==1)
                          // {
                            //// conditions testing  for user side
                            if(question.question_answer_given==1 && question.question_type=="multi_select")
                            {
                              if(option.is_answered==1)
                              {
                                if(option.admin_answer==option.user_quiz_answer_id)
                                {
                                  if(data.data.all_question_answer_given==1)
                                  {
                                    answered = "right";
                                  }
                                  isChecked = true;
                                }else if(option.admin_answer == null && option.user_quiz_answer_id!='')
                                {
                                  
                                  if(data.data.all_question_answer_given==1)
                                  {
                                    answered = "wrong";
                                  }
                                  isChecked = true;
                                }else if(option.admin_answer == null && option.user_quiz_answer_id == null)
                                {
                                  answered = "";
                                  isChecked = false;
                                }
                              } // answered given
                              else
                              {
                                if(question.question_answer_given==1 && option.admin_answer!= null && option.admin_answer!="" && option.admin_answer>0)
                                {
                                  answered = "right";
                                  //isChecked = true;
                                }
                              }
                            } // question_answer_given == 1
                            else if(question.question_answer_given==1 && question.question_type=="single_select")
                            {
                            if(option.is_answered==1)
                              {
                                if(option.admin_answer==option.user_quiz_answer_id)
                                {
                                  
                                  if(data.data.all_question_answer_given==1)
                                  {
                                    answered = "right";
                                  }
                                  isChecked = true;
                                }
                                else if(option.admin_answer == null && option.user_quiz_answer_id!='')
                                {
                                  if(data.data.all_question_answer_given==1)
                                  {
                                    answered = "wrong";
                                  }
                                  isChecked = true;
                                }
                                else if(option.admin_answer == null && option.user_quiz_answer_id == null)
                                {
                                  answered = "";
                                  isChecked = false;
                                }
                                else
                                {
                                  answered = "";
                                  isChecked = false;
                                }
                              } // answered given
                              else
                              {
                                if(question.question_answer_given==1 && option.admin_answer!= null && option.admin_answer!="" && option.admin_answer>0)
                                {
                                  answered = "right";
                                  //isChecked = true;
                                }
                              }
                            }
                          // }
                        }
                        questionHtml += '<div class="lm__term mb-3 '+answered+'">';
                          // questionOption[] use namespace if needed
                          if (question.question_type === 'single_select') {
                            questionHtml += '<div class="form-check d-flex gap-2 mt-1 align-items-center">';
                              questionHtml += '<input class="form-check-input flex-shrink-0" data-quiz-id="' + option.quiz_id + '" type="radio" name="questionOption'+option.quiz_id+'" value="' + option.id + '" onclick="user_quiz_answer(' + option.quiz_id + ',' + option.id + ',' + "'" + question.question_type + "'" + ')"' + (isChecked ? ' checked' : '') + '>';
                              questionHtml += '<span class="title-font text-sm-20">' + option.option + '</span>';
                            questionHtml += '</div>';
                          } else if (question.question_type === 'multi_select') {
                            questionHtml += '<label class="lm-check-term mb-0 lh-1 text-white">';
                            questionHtml += '<input data-quiz-id="' + option.quiz_id + '" type="checkbox" name="questionOption' + option.quiz_id + '[]" value="' + option.id + '" onclick="user_quiz_answer(' + option.quiz_id + ',' + option.id + ',' + "'" + question.question_type + "'" + ')"' + (isChecked ? ' checked' : '') + '>';
                            questionHtml += '<span class="checkmark"></span>';
                            questionHtml += '<span>' + option.option + '</span>';
                            questionHtml += '</label>';
                          }
                        
                        if(option.option_image!=null && option.option_image!="")
                        {
                          //questionHtml += '<label class="lm__choice--img mb-0" for="flexRadioDefault1"><img src="'+option.option_image+'"><p class="mb-0"></p></label>';
                        }
                        questionHtml += '</div>';
                        
                    });
                    //questionHtml += '</div>';
                            
                

                questionHtml += '</div></div>';

            });
            
            //<a class="btn btn--primary mt-3" href="#!" type="button" data-bs-toggle="modal" data-bs-target="#quiz-result">Submit</a>
            questionHtml +='<div class="lm__quizbtn w-100 d-flex justify-content-center"> </div></form></div>';
            // questionHtml +='<a class="btn btn--primary mt-3" href="#!" type="button" data-bs-toggle="modal" data-bs-target="#quiz-result">Submit</a>';
            
            
            spanClass += questionHtml;
            var audioElem = document.getElementById("audioPlayer");
          audioElem.load()
          $(audioElem).stop();
          break;
          
          case "reflection_questions":
          $(".module_overview_description").addClass('d-none');
          spanClass = '';
          if(data.data.detail_data!=null && data.data.detail_data!='')
          {
            spanClass = data.data.detail_data;
          }
          
          $(".subHeaderTitle").html('Reflection Questions');
          var audioElem = document.getElementById("audioPlayer");
          audioElem.load()
          $(audioElem).stop();
          // Code for handling reflection questions submodules
          break;

          case "reference_link":
          $(".module_overview_description").addClass('d-none');
            spanClass = '';
            if(data.data.detail_data!=null && data.data.detail_data!='')
            {
              spanClass = data.data.detail_data;
            }
            $(".subHeaderTitle").html('Reference Links');
            
            if (data.data.reference_links && data.data.reference_links.length > 0) {
              spanClass += "<ul class='referenceLink'>";
                
              data.data.reference_links.forEach(function(linkObj) {
                if (linkObj.link) {
                  var link ="{{asset('assets/images/link-2.svg')}}"
                  if(linkObj.title=="" || linkObj.title==null || linkObj.title =='undefined')
                  {
                    var title = linkObj.link;
                  }
                  else{
                    var title = linkObj.title;
                  }
                  spanClass += "<li class='d-flex gap-2 mb-2'><img src='"+link+"'><a class='text-primary text-decoration-underline fw-bold' href='" + linkObj.link + "' target='_blank'>" + title + "</a></li>";
                }
              });

              spanClass += "</ul>";
            }
            var audioElem = document.getElementById("audioPlayer");
          audioElem.load()
          $(audioElem).stop();
          break;

        case "closure_video":
        $(".module_overview_description").addClass('d-none');
          
        spanClass = '';
        if(data.data.detail_data!=null && data.data.detail_data!='')
        {
          spanClass = data.data.detail_data;
        }
                  
          $(".subHeaderTitle").html('Closing Video');
          
        if(data.data.closure_video!='')
        {
            var videoUrl = data.data.closure_video;
            var videoElement = "<p><video style='border-radius: 10px !important' controls width='640' height='360'><source src='" + videoUrl + "' type='video/mp4'></video></p>";
            spanClass += videoElement;
        }
        var audioElem = document.getElementById("audioPlayer");
          audioElem.load()
          $(audioElem).stop();
          // Code for handling closure video submodules
          break;

        default:
          // Default code if complete_type doesn't match any case
          break;
      }
      // Append the <span> element to a container (e.g., #containerId)
                
        var allModulesCompleted = {{ $allModulesCompleted ? 'true' : 'false' }};
        console.log(data.data);
        if(admin<1 || admin=='')
        {
          var NextBtnLabelName = "Next";
           
          if(complete_type=="closure_video" && data.data.button_label_flag == 0)
          {
            NextBtnLabelName = "Next Module"; 
          } else if(complete_type=="closure_video" && data.data.button_label_flag == 1 ) {
            NextBtnLabelName = "Complete Course"; 
          }
          if(allModulesCompleted === false ){
            if(data.data.running_task_complate == 2){
              $(".nextButton").html('');
            }
            else
            {
              $(".nextButton").html('<a class="btn btn--primary cr-btn-next me-4" onclick="UserUpdateStatus()" >'+NextBtnLabelName+'</a>');
            }
          } else {
            $(".nextButton").html('');
          }
          if (data.data.interactive_work_book_flag == 1) {
            $(".appendButtons .InteractivePreviewButton").css('display', 'none');
          } else {
            $(".appendButtons .InteractivePreviewButton").css('display', 'block');
          }

        }
                
      $('.subModulePreview').html('');
      $('.subModulePreview').append(spanClass);
      
      
      setTimeout(
        function() 
        {
          hideSectionLoader();
        }, 1000);
      
      $("html, body").animate({ 
            scrollTop: 0 
        }, 1500);
      
    }
  }).fail(function(xhr, status, error) {
    
    var spanClass ="An error occurred. Please try again."; // Default error message
    if (xhr.responseJSON && xhr.responseJSON.message) {
        spanClass = xhr.responseJSON.message; // Use the error message from the API response
        
        $('.subModulePreview').html('');
        $('.subModulePreview').append(spanClass);
    }

  });
}

function user_course_activity_update_status(course_id, course_module_id, complete_type, next_type,) {
  let _token = $("input[name=_token]").val();
  
  complete_status = 2;
  next_status = 1;
  mark_as_complete = 1;
  if(complete_type=="closure_video")
  {
    mark_as_complete = 2;
  }
  
  data = {
    course_id: course_id,
    course_module_id: course_module_id,
    complete_type: complete_type,
    complete_status: complete_status,
    next_type: next_type,
    next_status: next_status,
    mark_as_complete: mark_as_complete,
    _token: _token,
  };
  
  //  data.is_like = isLike;
          
  $.ajax({
            url: "{{route('user.course.activity.update.status')}}"
            , type: "POST"
            , data: data
            , dataType: 'JSON'
            , success: function(data) {
              $("#button_label_flag").val(data.data.button_label_flag);
              $("#interactive_work_book_flag").val(data.data.interactive_work_book_flag);
              startCourseModuleOverView(course_id);

                if (data.error) {
                    // printErrorMsg(data.error);
                    console.log('Something went wrong !' + data.error);
                    return false;
                } else if (data.status == "200")
                {
                  if(data.data.course_completed==1)
                  {
                    $("#course_com").modal('show');
                    $(".nextButton").addClass('d-none');
                  }
                 // showSubModulePreview(course_module_id, complete_type, next_type, course_id);
                 
                 //startCourseModuleOverView(course_id);
                }
            },
            error: function(xhr, status, error) {
                    
                    var errorMessage = "An error occurred. Please try again."; // Default error message
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message; // Use the error message from the API response
                    }
                    // Set the error message in the desired HTML tag
                                        
                    var message = errorMessage;
                    // Swal.fire({
                    //     toast: true,
                    //     icon: 'warning',
                    //     title: message,
                    //     position: 'top-right',
                    //     showConfirmButton: false,
                    //     timer: 2000,
                    //     timerProgressBar: false,
                    //     didOpen: (toast) => {
                    //         toast.addEventListener('mouseenter', Swal.stopTimer);
                    //         toast.addEventListener('mouseleave', Swal.resumeTimer);
                    //     }
                    // });
                    
                }
        });
            
          }
          
          
function user_quiz_answer(quiz_id, quiz_option_id,question_type) {
  let _token = $("input[name=_token]").val();   
    
    if (question_type === "multi_select") {
    const selectedValues = [];
    const checkboxes = document.getElementsByName('questionOption' + quiz_id + '[]');
    for (let i = 0; i < checkboxes.length; i++) {
      const checkbox = checkboxes[i];
      if (checkbox.checked) {
        selectedValues.push(checkbox.value);
      }
    }

    quiz_option_id = selectedValues.join('-'); // Join selected values as a comma-separated string
  }  
  
  data = {
    quiz_id: quiz_id,
    quiz_option_id: quiz_option_id,
    _token: _token,
  };
          
  $.ajax({
            url: "{{route('user.quiz.answer')}}"
            , type: "POST"
            , data: data
            , dataType: 'JSON'
            , success: function(data) {
              
                if (data.error) {
                    console.log('Something went wrong !' + data.error);
                    return false;
                } else if (data.status == "200")
                {
                 
                }
            },
            error: function(xhr, status, error) {
                    
                    var errorMessage = "An error occurred. Please try again."; // Default error message
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message; // Use the error message from the API response
                    }
                    var message = errorMessage;
                    // Swal.fire({
                    //     toast: true,
                    //     icon: 'warning',
                    //     title: message,
                    //     position: 'top-right',
                    //     showConfirmButton: false,
                    //     timer: 2000,
                    //     timerProgressBar: false,
                    //     didOpen: (toast) => {
                    //         toast.addEventListener('mouseenter', Swal.stopTimer);
                    //         toast.addEventListener('mouseleave', Swal.resumeTimer);
                    //     }
                    // });
                    
                    console.log(errorMessage);
                }
        });
  }
  
  showLoader();
</script>

@endsection