@extends('layouts.admin.master')
@section('content')

    <main class="main-content" id="main">
        <section class="lm__dash-con">
            <span class="lm_vec"><img class="light" src="{{ asset('assets/images/light.png') }}" alt=""><img
                    class="dark" src="{{ asset('assets/images/dark.png') }}" alt=""></span>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <a href="{{ route('admin.quiz.inner', ['courseModule' => $courseModuleId]) }}" class="btn btn--primary rounded-4 py-2">Go Back</a>
                          </div>
                        <div class="lm__quiz lm__quiz-admin mb-4 ">
                            <form action="#" name="createQuizwForm" id="createQuizwForm" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="question_type" id="question_type" value="{{ $quiz->question_type }}">                                
                                <div class="lm__quizheading">
                                    <h4>Edit Quiz</h4>
                                </div>
                                <div class="lm__quiztopic">
                                    <h5>{{ $courseTitle }}</h5>
                                </div>
                                <div class="lm__quizbox active">
                                    <div class="lm__quiz-question shadow">
                                        <div class="lm__question--edit w-100 d-flex justify-content-between">
                                            <p class="m-0">Question</p>
                                            <div class="lm__editwrap d-flex">
                                                <div class="lm__editeye"><img class="lm__edit--hidden"
                                                        src="{{ asset('assets/images/hidden_eye.svg') }}"
                                                        alt=""><img class="lm__edit in-svg"
                                                        src="{{ asset('assets/images/show_eye.svg') }}" alt="">
                                                </div>
                                                <img class="lm__edit--arrow" src="{{ asset('assets/images/arrow-up.svg') }}"alt="">
                                            </div>
                                        </div>
                                        <div class="position-relative lm__quizinput">
                                            <input name="question" id="question" class="form-control icon shadow py-3" type="text" value="{{ $quiz->question }}">
                                        </div>
                                    </div>
                                    <div class="lm__quiz--animation">
                                        
                                        <div class="lm_quiz-queimage p-0">
                                            <div class="d-flex gap-2 align-items-center mb-1">
                                                <p class="text-sm-14 mb-1 title-font">Question Image</p>
                                                <div class="d-flex gap-2 align-items-center">
                                                    
                                                    {{-- <div class="tooltip-icon mb-1">
                                                        <img src="{{ asset('assets/images/que.svg') }}" alt="">
                                                        <div class="tooltiptext">Turning on RSVPs will allow members to
                                                            select Going, Maybe, or Not
                                                            Going for your event
                                                        </div>
                                                    </div> --}}
                                                </div>
                                            </div>
                                            <label class="lm_upld" for="question_image">
                                                <div class="input-group mb-0"><span class="input-group-text p-0 mb-0">Upload &nbsp;
                                                    </span>
                                                    <input class="form-control" name="question_image" id="question_image" type="file" value="{{ $quiz->question_image }}">
                                                </div>
                                                
                                                
                                            </label>
                                        </div>
                                        
                                        @if($quiz->question_image!='')
                                        <img src="{{ $quiz->question_image }}" alt="" height="150" width="150"><br>
                                        @endif
                                        <div class="lm__quiz-tab">
                                            <ul class="nav nav-pills mb-4 nav-primary shadow d-inline-flex" id="pills-tab"
                                                role="tablist">
                                                
                                                @if($quiz->question_type=="multi_select")
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link {{ $quiz->question_type=="multi_select" ? 'active' : '' }}" id="pills-all-tab" data-bs-toggle="pill"
                                                        data-bs-target="#pills-all" type="button" role="tab"
                                                        aria-controls="pills-all" aria-selected="true">Multi Select</button>
                                                </li>
                                                @elseif($quiz->question_type=="single_select")
                                                
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link {{ $quiz->question_type=="single_select" ? 'active' : '' }}" id="pills-upcoming-tab" data-bs-toggle="pill"
                                                        data-bs-target="#pills-upcoming" type="button" role="tab"
                                                        aria-controls="pills-upcoming" aria-selected="false">Single Select</button>
                                                </li>
                                                @endif
                                            </ul>
                                            <div class="tab-content" id="pills-tabContent">
                                                
                                                {{-- <div class="tab-pane fade shadow active show" id="pills-all" role="tabpanel"  aria-labelledby="pills-all-tab" tabindex="0"> --}}
                                                    <div class="lm__quiz-options mb-3">
                                                        <h6 class="m-0">Correct Answer </h6>
                                                    </div>
                                                    @php
                                                    $optionCounter = 0; // Initialize the option counter
                                                    @endphp
                                                    @foreach ($quiz->quizOptions as $i=> $option)
                                                    <div class="lm__optionbox mb-3">
                                                        <div class="lm__option-choice d-flex align-items-center flex-wrap">
                                                            <div class="lm__term d-flex justify-content-center">
                                                                <span>{{ chr(97 + $optionCounter) }}</span>
                                                                <label class="lm-check-term ps-4 mb-0 lh-1 text-white">
                                                                    
                                                                    @php
                                                                    if($quiz->question_type=="multi_select")
                                                                    {
                                                                        $question_type = 'checkbox';
                                                                    } 
                                                                    if($quiz->question_type=="single_select")
                                                                    {
                                                                        $question_type = 'radio';
                                                                    } 
                                                                    
                                                                    @endphp
                                                                   {{-- {{ dd($option->admin_answer) }} --}}
                                                                    
                                                                    <input name="admin_answer_m[]" type="{{ $question_type }}" value="{{ $option->option }}" {{ ($option->admin_answer==$option->option) ? 'checked' : '' }}>
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                            </div>
                                                            {{-- <label class="lm_upld" for="option_image1">
                                                                <div class="input-group mb-0"><span
                                                                        class="input-group-text p-0 mb-0">Upload
                                                                    </span>
                                                                    <input class="form-control" name="option_image[]" type="file" id="option_image1">
                                                                </div>
                                                            </label> --}}
                                                            <div class="position-relative lm__quiz-input">
                                                                <input name="option_m[]" class="form-control icon shadow py-3" type="text" placeholder="Multiple Choice" value="{{ $option->option }}">
                                                            </div>
                                                            
                                                            {{-- <div class="d-flex"><span class="lm_form-add shadow multi_add"><img
                                                                        src="{{ asset('assets/images/plus-quiz.svg') }}"
                                                                        alt=""></span></div> --}}
                                                            
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                    
                                                    @php
                                                        $optionCounter++; // Increment the option counter
                                                    @endphp
    
                                                    @endforeach
                                                    {{-- Appended Correct answer row by js for multiple--}}
                                                    <div class="multi_select_link"></div>
                                                {{-- </div> --}}
                                                
                                                
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="lm__quizbtn w-100 d-flex justify-content-end">
                                    <a class="btn btn--primary mt-3 me-2 me-lg-3" onclick="UpdateQuiz()">Save </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
    function setQuizType(quizType)
    {
        $("input[name=question_type]").val(quizType);
        
        if (quizType === "multi_select") {
    $("input[name=admin_answer_m][]").attr('type', 'checkbox');
}

if (quizType === "single_select") {
    $("input[name=admin_answer_m][]").attr('type', 'radio');
}
        
    }    
                   /// Course quize add Form
function UpdateQuiz()
{
    var question_type = $("input[name=question_type]").val();
    
    let _token = $("input[name=_token]").val();
    let formName = "#createQuizwForm";
    var formData = new FormData($(formName)[0]);
    
    if(question_type=="multi_select")
    {
        
        handleSelectMulti(formData);
        formData.delete('admin_answer_m');
        formData.delete('option_m');
        
        formData.delete('admin_answer_s');
        formData.delete('option_s');
    }
    
    if(question_type=="single_select")
    {
        
        handleSelectSingle(formData);
        formData.delete('admin_answer_s');
        formData.delete('option_s');
        
        formData.delete('admin_answer_m');
        formData.delete('option_m');
    }

    
    var id = "{{ $quiz->id }}";
    var url = "{{route('admin.quiz.update.data', ":id")}}";
    url = url.replace(":id", id);         
            
        // $(".CourseModuleSaveBtn").attr("disabled", true);
        $.ajax({
            url: url,
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            dataType: 'JSON',
            contentType: false // Set content type to false for file upload
                ,
            processData: false,
            success: function(data) {
                
                // $(".CourseModuleSaveBtn").attr("disabled", false);
                console.log(data);
                if (data.error) {
                    
                    Swal.fire({
                toast: true,
                icon: 'error',
                title: data.error[0],
                position: 'top-right',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal
                        .stopTimer);
                    toast.addEventListener('mouseleave', Swal
                        .resumeTimer);
                }
                });
                
                
                    // $(".CourseModuleSaveBtn").attr("disabled", false);
                    printErrorMsg(data.error);
                    return false;
                } else if (data.status == "200") {
                    // $('input[name="course_module"]').val(data.data.id);

                    $('#errorField').text('');
                    $(formName)[0].reset();
                    var success_message = data.message;
                    console.log(success_message);
                    Swal.fire({
                        toast: true,
                        icon: 'success',
                        title: success_message,
                        position: 'top-right',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal
                                .stopTimer);
                            toast.addEventListener('mouseleave', Swal
                                .resumeTimer);
                        }
                    });
                        // console.log(data.data.course_module_id);
                        var courseModuleId =data.data.course_module_id;
                        var url = "{{ route('admin.quiz.preview', ['courseModule' => ':courseModule']) }}";
                        url = url.replace(':courseModule', courseModuleId);
                        window.location.href = url;

                }
            },
            error: function(xhr, status, error) {

                // $(".CourseModuleSaveBtn").attr("disabled", false);

                var errorMessage =
                "An error occurred. Please try again."; // Default error message
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    // console.log(xhr.responseJSON);
                    errorMessage = xhr.responseJSON
                    .message; // Use the error message from the API response
                }
                // Set the error message in the desired HTML tag
                $('#errorField').text(errorMessage);
                
                Swal.fire({
                toast: true,
                icon: 'error',
                title: errorMessage,
                position: 'top-right',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal
                        .stopTimer);
                    toast.addEventListener('mouseleave', Swal
                        .resumeTimer);
                }
                });
                
                
            }
        });
    }  // End function SaveQuiz
    
function handleSelectMulti(formData) {
    var adminAnswers = $("input[name='admin_answer_m[]']:checked").map(function () {
        return $(this).val();
    }).get();

    var options = $("input[name='option_m[]']").map(function () {
        return $(this).val();
    }).get();

    var adminAnswersCSV = adminAnswers.join(',');
    var optionsCSV = options.join(',');

    formData.append('admin_answer', adminAnswersCSV);
    formData.append('option', optionsCSV);
    
    formData.delete('admin_answer_m');
    formData.delete('option_m');
}


function handleSelectSingle(formData) {
    var adminAnswers = $("input[name='admin_answer_m[]']:checked").map(function () {
        return $(this).val();
    }).get();

    var options = $("input[name='option_m[]']").map(function () {
        return $(this).val();
    }).get();

    var adminAnswersCSV = adminAnswers.join(',');
    var optionsCSV = options.join(',');

    formData.append('admin_answer', adminAnswersCSV);
    formData.append('option', optionsCSV);
}
       
    function printErrorMsg(msg) {
                console.log(msg);
                $.each(msg, function(key, value) {
                    $("#errorField").text(value);
                });
            }
    
    
        $(document).ready(function() {
            var i = 1
            currentChar = 'a';
            function incrementAlphabet_multiple() {
              // Check if the current character is 'Z', and if so, reset it to 'A'
              if (currentChar === 'z') {
              currentChar = 'a';
              } else {
              // Increment the character to the next one
              return currentChar =  String.fromCharCode(currentChar.charCodeAt(0) + 1);
              }
            }
            var currentChar_single = 'a'
            function incrementAlphabet_single() {
              // Check if the current character is 'Z', and if so, reset it to 'A'
              if (currentChar_single === 'z') {
              currentChar_single = 'a';
              } else {
              // Increment the character to the next one
              return currentChar_single =  String.fromCharCode(currentChar_single.charCodeAt(0) + 1);
              }
            }
          
            $('.multi_add').on('click', function() {
              i++;
              var link ='<span id="multi_add_link_static'+i+'">'
              link +='<div class="lm__optionbox mb-3"><div class="lm__option-choice d-flex align-items-center flex-wrap"><div class="lm__term d-flex justify-content-center"><span>'+incrementAlphabet_multiple()+'.</span><label class="lm-check-term ps-4 mb-0 lh-1 text-white"><input name="admin_answer_m[]" value="1" type="checkbox"><span class="checkmark"></span></label></div>'
              //link+='<label class="lm_upld" for="option_image1"><div class="input-group mb-0"><span class="input-group-text p-0 mb-0">Upload</span> <input class="form-control" name="option_image[]" id="option_image1" type="file"> </div></label>'
              link+='<div class="position-relative lm__quiz-input"><input name="option_m[]" id="option1"class="form-control icon shadow py-3" type="text" placeholder="Multiple Choice"></div>'
              link+='<div class="d-flex"><span class="lm_form-add shadow" onclick="remove_added_multi_add_link('+i+')"><img src="{{ asset("assets/images/minus-quiz.svg") }}"alt=""></span></div></div></div></span>';
              $('.multi_select_link').append(link)
              // console.log(link);
              return false;
            });

            $('.single_add').on('click', function () {
              i++;
              var link ='<span id="single_add_link_static'+i+'">'
              link+='<div class="lm__optionbox mb-3"><div class="lm__option-choice d-flex align-items-center flex-wrap"><div class="lm__term d-flex justify-content-center align-items-center"><span>'+incrementAlphabet_single()+'.</span>'
              link+='<div class="form-check d-flex gap-2 mt-1"><input class="form-check-input" name="admin_answer_s[]" value="1" type="radio"></div></div>';
              
              //link+='<label class="lm_upld" for="option_single_image"><div class="input-group mb-0"><span class="input-group-text p-0 mb-0">Upload </span> <input class="form-control" name="option_image[]" id="option_single_image" type="file"> </div> </label>'
              link+='<div class="position-relative lm__quiz-input"><input name="option_s[]" class="form-control icon shadow py-3" type="text" placeholder="Single Choice"></div><div class="d-flex"><span class="lm_form-add shadow single_add" onclick="remove_added_single_add_link('+i+')"><img src="{{ asset("assets/images/minus-quiz.svg") }}"alt=""></span></div></div></div></span>';
              $('.single_select_link').append(link)
              // console.log(link);
              return false;
            });
        });
     
      function remove_added_multi_add_link(id='')
      {
        var button_id = id;            
        $('#multi_add_link_static'+button_id+'').remove();
        return false;
      }

      function remove_added_single_add_link(id='')
      {
        var button_id = id;            
        $('#single_add_link_static'+button_id+'').remove();
        return false;
      }
    </script>
@endsection