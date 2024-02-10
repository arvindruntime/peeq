@extends('layouts.admin.master')
@section('content')

{{-- {{ dd($courseModule) }} --}}
<main class="main-content" id="main">
  <section class="lm__dash-con mb-5 lm__module-overview">
  <span class="lm_vec"><img class="light"
      src="{{asset('assets/images/light.png')}}" alt=""><img class="dark" src="{{asset('assets/images/dark.png')}}" alt=""></span>
    <div class="container">
      <div class="row lm__module-overview">
        <div class="col-12">
          <div class="lm__module-title-btn">
            <div class="d-flex justify-content-between align-items-center">
              <h4 class="mb-0 text-primary fw-semibold">Module Overview</h4>
              <a class="btn btn--primary" href="{{ route('admin.courses.edit.module' , ['id' => $courseModule['id']]) }}">Edit module</a>
              {{-- {{ route('admin.course.edit') }} --}}
            </div>
          </div>

          <div class="d-flex module-wrap">
            <div class="lm__module-overview-con">
                <div class="lm__overview-card card shadow">
                  <h4 class="fw-bold text-primary">{{ $course->course_name }}</h4>
                  
                  
                  {{-- <span class="overview-list">
                  </span> --}}
                  <span class="subModulePreview">
                    <h5 class="fw-bold">{{ $course->course_tagline }} </h5>
                    
                    {!! $course->description !!}
                  </span>
                 
                   {{-- <div class="module-setting">
                    <h5 class="fw-bold">Module Settings</h5>
                    <a class="btn btn--dark-outline rounded-2" href="{{ route('admin.courses.modulesetting') }}">Manage Module Settings</a>
                  </div>  --}}
                </div>
                 <div class="row overview-add gap-2 gap-md-0">
                  <div class="col-md-6">
                    <div class="card overview-add1 h-100"> </div>
                  </div>
                  <div class="col-md-6">
                    <a class="card overview-add2 h-100" href="{{ route('admin.courses.inner' , ['id' => $course['id']]) }}">
                      <div class="d-flex gap-2 align-items-center justify-content-center">
                        <span><img class="in-svg" src="{{asset('assets/images/plus-quiz.svg')}}" alt=""></span>
                        <p class="mb-0 text-dark">Add New Module</p>
                      </div>
                    </a>
                  </div>
                </div> 
            </div>
            <!-- list -->
            <div class="lm__course-con-list">
              <div class="card shadow">
                <div class="course-con-list">
                  <p class="fw-bold mb-0 text-primary p-3">How To Get The Most Out Of This Program</p>
                  
                  <div class="accordion-course">
                    <div class="accordion  moduleTitleDynamic" id="pq_accordionExample">
                      
                      <!-- module start -->
                      
                      <!-- module end -->
                     
                    </div>
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



<script>
  var course_id = "{{ $course_id }}";
  startCourseModuleOverView(course_id);
// API Called : courses/13/course_modules
  function startCourseModuleOverView(id) {
    console.log('courseModuleOverView called');
    
    // alert('test');

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
    }).done(function(data) {
      
      console.log(data.html);
      
      if (data.status == 200) {

        // Assuming your response data is stored in a variable called 'responseData'
        var responseData = data.data.data;
        
        console.log("Module Details : "+data.data.data);
        
        var container = $(".moduleTitleDynamic");
        
        // Clear the container before appending new content
        container.empty();
        
        responseData.forEach(function (courseData, i) {
                    
          if(i === 0)
          {
            var showClass = 'show';
          }
          else
          {
            var showClass = '';
          }
          
          var courseHTML = '<div class="accordion-item">';
          courseHTML += '<h2 class="accordion-header">';
          courseHTML += '<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne'+i+'" aria-expanded="true" aria-controls="collapseOne'+i+'">';
          courseHTML += courseData.title;
          courseHTML += '</button>';
          courseHTML += '</h2>';
          courseHTML += '<div id="collapseOne'+i+'" class="accordion-collapse collapse '+showClass+'" data-bs-parent="#pq_accordionExample">';
          courseHTML += '<div class="accordion-body p-0">';
          // courseHTML += '<div class="progress-wrap">';
          // courseHTML += '<p class="text-end color-light mb-0 text-sm-12">' + courseData.course_completed_progress + '% Completed</p>';
          // courseHTML += '<div class="progress" role="progressbar" aria-label="Example 1px high" aria-valuenow="' + courseData.course_completed_progress + '" aria-valuemin="0" aria-valuemax="100" style="height: 4px">';
          // courseHTML += '<div class="progress-bar" style="width: ' + courseData.course_completed_progress + '%"></div>';
          // courseHTML += '</div>';
          courseHTML += '</div>';
          
          courseData.course_sub_module.forEach(function (subModule, index) {
          
          // if (subModule.status === 1)
          // {
             var isActive = (i === 0 && index === 0) ? 'active' : '';
            
          //   var isActive = 'active';
            
          //   var course_id = id;
          //   var course_module_id = courseData.id;
          //   var subModule_type = subModule.type;
          //   var next_type = subModule.next_type;
            
          //   $("#UserUpdateStatus")
          // .attr('course-id', course_id)
          // .attr('module-id', course_module_id)
          // .attr('module-type', subModule_type)
          // .attr('next-type', next_type);
          
          // //showSubModulePreview(course_module_id, subModule_type, next_type, course_id);
  
          // }
          // else{
          //   var isActive = '';
          // }
          
          //var isActive = 'active';
          // var isActive = (i === 0 && index === 0) ? 'active' : '';
          
          
          console.log(courseData.id);
          
          // if(subModule.status==1)
          // {
            var iconSrc = "{{asset('assets/images/play-btn.svg')}}";
          // }
          
          // if(subModule.status==2)
          // {
          //   var iconSrc = "{{asset('assets/images/check.svg')}}";
          // }
          // if(subModule.status==0)
          // {
          //   var iconSrc = "{{asset('assets/images/lockr.svg')}}";
          //   var desabled = "true";
          // }
          
          courseHTML += '<a class="course-con-list-item ' + isActive + '">';
          
          // var clickHandler = '';
          // if (subModule.status === 1 || subModule.status==2)
          // {
            //clickHandler = "showSubModulePreview(" + courseData.id + ", '" + subModule.type + "', '" + subModule.next_type + "', " + id + ")";
            
            courseHTML += '<div class="d-flex align-items-center justify-content-between" onclick="showSubModulePreview(' + courseData.id + ', \'' + subModule.type + '\', \'' + subModule.next_type + '\', ' + id + ')">';
          // }
          // else
          // {
          //   courseHTML += '<div class="d-flex align-items-center justify-content-between">';
          // }
         
          //courseHTML += '<div class="d-flex align-items-center justify-content-between" onclick="' + clickHandler + '">';
            
          courseHTML += '<div class="d-flex align-items-center">';
          courseHTML += '<div class="icon-div">';
          courseHTML += '<span class="icon">';
          courseHTML += '<img class="in-svg" src="'+iconSrc+'" alt="">';
          courseHTML += '</span>';
          courseHTML += '</div>';
          courseHTML += '<p class="mb-0">' + subModule.name + '</p>';
                  
          courseHTML += '</div>';
          courseHTML += '<span class="mb-0 text-sm-12"></span>';
          courseHTML += '</div>';
          courseHTML += '</a>';
        });

          courseHTML += '</div>';
          courseHTML += '</div>';
          courseHTML += '</div>';
        
          // container.empty();
          
          container.append(courseHTML);
        });
        
        
        if (responseData.length > 0 && responseData[0].course_sub_module.length > 0) {
        showSubModulePreview(responseData[0].id, responseData[0].course_sub_module[0].type, responseData[0].course_sub_module[0].next_type, id);
      }
      
      
      }
    });
  }
  
  
  function showSubModulePreview(course_module_id, subModule_type, next_type='', course_id='') {
  
  // Generate the URL using the named route and provide the 'course_module_id' and 'type' parameters
  var url = "{{ route('course.module.preview', ['id' => ':id']) }}";
  url = url.replace(':id', course_module_id);

  let _token = $("input[name=_token]").val();
  $.ajax({
    url: url,
    method: "GET",
    data: {
      _token: _token,
      type: subModule_type // Provide 'type' parameter
    }
  }).done(function(data) {
                    
    if (data.status == 200) {
      var dataToAppend = data.data.detail_data;
      spanClass = '';
      
      console.log(data.data);

  //     $("#UserUpdateStatus")
  // .attr('course-id', course_id)
  // .attr('module-id', course_module_id)
  // .attr('module-type', subModule_type)
  // .attr('next-type', next_type);
      
     //user_course_activity_update_status(course_id,course_module_id,subModule_type,next_type);
      switch (subModule_type) {
        case "introduction":
        spanClass = data.data.detail_data;
          // Code for handling introduction submodules
          break;

        case "video_lesson":
        spanClass = data.data.detail_data;
          // Code for handling video lesson submodules
          break;

        case "audio_recording":
          
          spanClass = data.data.detail_data;
          if (data.data.audio_recording != '') {
            var audioUrl = data.data.audio_recording;
            var audioElement = "<p><audio controls>";
            audioElement += "<source src='" + audioUrl + "' type='audio/mpeg'>";
            audioElement += "<source src='" + audioUrl + "' type='audio/wav'>";
            audioElement += "<source src='" + audioUrl + "' type='audio/ogg'>";
            audioElement += "Your browser does not support the audio element.";
            audioElement += "</audio></p>";
            
            spanClass += audioElement;
          }

          // Code for handling audio recording submodules
          break;

        case "task":
          spanClass = data.data.detail_data;
          // Code for handling task submodules
          break;
          
          case "quiz":
          
          var questionHtml = '<div class="lm__quiz-user lm__quiz--preview"><form action=""><div class="lm__quiztopic"><h5>How To Get The Most Out Of This Program</h5>       </div><div class="lm__quiztopic"><h5 class="text-dark">Quiz</h5><p class="mb-3">Take this short quiz to check your retention on what we’ve covered in this module. And remember, if something is not clear to you, you can flag a question to your coach through the app and they’ll come back to you to ensure you have a full understanding of everything that has been discussed through the module’s content. </p>     </div>';
                  
          $.each(data.data.quiz_data, function(index, question) {
                // Create HTML elements based on the question type
                questionHtml += '<div class="lm__quizbox">';
                questionHtml += '<div class="lm__quiz-question shadow">';
                questionHtml += '<p class="m-0">Q.' + (index + 1) + ' ' + question.question + '</p>';
                questionHtml += '</div>';

                if (question.question_type === 'single_select') {
                  if(question.question_image!=null && question.question_image!="")
                    {
                      questionHtml += '<div class="lm__quiz-image w-100 text-center"> <img class="mx-auto" src="'+question.question_image+'"></div>';
                    }
                    
                    questionHtml += '<div class="lm__preview-choices shadow">';
                    $.each(question.quiz_options, function(optionIndex, option) {
                      
                        questionHtml += '<div class="lm__term mb-3">';
                        questionHtml += '<label class="lm-check-term mb-0 lh-1 text-white">';
                        if (question.question_type === 'single_select') {
                            questionHtml += '<input type="radio" name="question_' + question.id + '">' + option.option;
                        } else if (question.question_type === 'multi_select') {
                            questionHtml += '<input type="checkbox" name="question_' + question.id + '[]">' + option.option;
                        }
                        
                        questionHtml += '<span class="checkmark"></span>';
                        questionHtml += '<span style="color:black">' + option.option + '</span>';
                        questionHtml += '</label>';
                        if(option.option_image!=null && option.option_image!="")
                        {
                          //questionHtml += '<label class="lm__choice--img mb-0" for="flexRadioDefault1"><img src="'+option.option_image+'"><p class="mb-0"></p></label>';
                        }
                        questionHtml += '</div>';
                        
                        console.log(questionHtml);
                    });
                    //questionHtml += '</div>';
                }
                
                if (question.question_type === 'multi_select') {
                  
                    if(question.question_image!=null && question.question_image!="")
                    {
                      questionHtml += '<div class="lm__quiz-image w-100 text-center"> <img class="mx-auto" src="'+question.question_image+'"></div>';
                    }
                    // Handle single-select and multi-select question types
                    questionHtml += '<div class="lm__preview-choices shadow"><div class="row align-items-center">';
                    $.each(question.quiz_options, function(optionIndex, option) {
                      
                      // console.log(option.option);
                      questionHtml += '<div class="lm__term col-12 col-sm-6 mb-3">';
                      questionHtml += '<div class="form-check d-flex gap-3 mt-1 align-items-center">';
                      questionHtml += '<input class="form-check-input" type="radio" name="question_' + question.id + '[]">' + option.option;
                      
                      if(option.option_image!=null && option.option_image!="")
                      {
                        questionHtml += '<label class="lm__choice--img mb-0" for="flexRadioDefault1"><img src="'+option.option_image+'"><p class="mb-0"></p></label>';
                      }
                      
                      questionHtml += '</div></div>';
                                                
                        // console.log(question.question_image);
                    });
                    questionHtml += '</div>';
                }

                questionHtml += '</div></div>';

            });
            
            questionHtml +='<div class="lm__quizbtn w-100 d-flex justify-content-center"> <a class="btn btn--primary mt-3" href="#!" type="button" data-bs-toggle="modal" data-bs-target="#quiz-result">Submit</a></div></form></div>';
            
            spanClass += questionHtml;
          break;

        case "reflection_questions":
          spanClass = data.data.detail_data;
          // Code for handling reflection questions submodules
          break;

          case "reference_link":
            spanClass = data.data.detail_data;
            if (data.data.reference_links && data.data.reference_links.length > 0) {
              spanClass += "<ul>";
                
              data.data.reference_links.forEach(function(linkObj) {
                if (linkObj.link) {
                  spanClass += "<li><a href='" + linkObj.link + "' target='_blank'>" + linkObj.link + "</a></li>";
                }
              });

              spanClass += "</ul>";
            }
          break;

        case "closure_video":
          spanClass = data.data.detail_data;
          
        if(data.data.closure_video!='')
        {
            var videoUrl = data.data.closure_video;
            var videoElement = "<p><video controls width='640' height='360'><source src='" + videoUrl + "' type='video/mp4'></video></p>";
            spanClass += videoElement;
        }
          // Code for handling closure video submodules
          break;

        default:
          // Default code if subModule_type doesn't match any case
          break;
      }
      // Append the <span> element to a container (e.g., #containerId)
      $('.subModulePreview').html('');
      $('.subModulePreview').append(spanClass);
      
      console.log(data.data.detail_data);
    }
  }).fail(function(xhr, status, error) {
    
    var spanClass ="An error occurred. Please try again."; // Default error message
    if (xhr.responseJSON && xhr.responseJSON.message) {
        // console.log(xhr.responseJSON);
        spanClass = xhr.responseJSON.message; // Use the error message from the API response
        
        $('.subModulePreview').html('');
        $('.subModulePreview').append(spanClass);
    }

  });
}
  </script>
  
  
{{-- <script>
  var course_module_id = "{{ $id }}";
  courseModuleOverView(course_module_id);
   function courseModuleOverView(id)
    {
      console.log('courseModuleOverView called');
        var url = '{{ route("course.module.preview", ":id") }}';
        url = url.replace(':id', id)+"?type=introduction";
        let _token =  $("input[name=_token]").val();
      $.ajax({
        url: url,
        method: "GET",  
        data: {
          _token:_token,
          id: id
        }  
      }).done(function(data) {
        if(data.status==200)
        {
            // console.log(data.data.detail_data);
            $(".overview-list").html(data.data.detail_data);
        }
      });
      
    } 
    </script> --}}
@endsection