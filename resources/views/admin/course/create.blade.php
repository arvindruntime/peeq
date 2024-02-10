@extends('layouts.admin.master')
@section('content')

{{-- <style>
  .admin-file-textarea .fr-toolbar.fr-desktop.fr-top.fr-basic.fr-sticky-on{
    z-index:1 !important;
}
</style> --}}
<style>
  .thunbnail-edit.card{
    border: 0;
  }
  .lm_vedio-card.card{
    border: 0 !important;
  }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/4.0.19/css/froala_editor.pkgd.min.css" />
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/4.0.19/js/froala_editor.pkgd.min.js"></script>
<main class="main-content" id="main">
  <section class="lm__dash-con lm__course-list-admin">
    <span class="lm_vec"><img class="light"
      src="{{asset('assets/images/light.png')}}" alt=""><img class="dark" src="{{asset('assets/images/dark.png')}}" alt=""></span>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="mb-3">
            <a href="{{ route('admin.courses.index') }}" class="btn btn--primary rounded-4 py-2">Go Back</a>
          </div>
          <div class="create-list-admin">
            <div class="create-list-admin-title">
              <h4 class="mb-0 text-primary fw-semibold">PEEQ Courses</h4>
            </div>
            <div class="create-admin-form">
                <form action="#" id="saveSourseForm" method="post" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-12">
                    <div class="mb-3 admin-file-upd">
                      <label class="form-label w-100" for="course_thumbnail">
                        Course Thumbnail
                        <div class="admin-file-upd-input position-relative mt-1 thunbnail-edit course_thumbnail_hide">
                          <input class="form-control" name="course_thumbnail" id="course_thumbnail" type="file" accept="image/*">
                          <span class="position-absolute top-50 start-50 translate-middle color-light text-sm-16 text-center">Upload
                          Course Thumbnail</span>
                        </div>
                      </label>
                     {{-- Image preview --}}
                      <div class="admin-file-upd-input position-relative mt-1 thunbnail-edit d-none" id="thumnail_coure_img">
                        <label class="form-label w-100" for="course_thumbnail_change_image">
                          <input class="d-none" type="file" name="" id="course_thumbnail_change_image">
                           <img class="rounded-4 course_thumbnail_image_preview d-none" 
                                src="{{asset('assets/images/courses3.jpg')}}" alt="">
                          <a class="btn btn--dark d-none" id="change_image_hide">Change Image</a>
                        <label>
                      </div>
                    </div>
                    <div class="mb-3 admin-file-upd">
                      <label class="form-label w-100" for="course_preview_video1">
                        Course Preview Video
                        <div class="admin-file-upd-input position-relative mt-1 thunbnail-edit course_video_hide">
                          <input class="form-control" name="course_preview_video" id="course_preview_video1" type="file" accept="video/*">
                          <span class="position-absolute top-50 start-50 translate-middle color-light text-sm-16 text-center">Upload Course Preview Video</span>
                        </div>
                      </label>
                      {{-- Video preview --}}
                      <div class="admin-file-upd-input position-relative mt-1 thunbnail-edit d-none" id="thumnail_coure_video">
                        <label class="form-label w-100" for="course_vedio_change">
                          <div class="lm_vedio-card card d-none">
                            <input class="d-none" type="file" name="" id="course_vedio_change">
                            <div class="card-img position-relative">
                                <video controlsList="nodownload" controls class="w-100  course_preview_video d-none" src="">
                                  <source src="" class="">
                                </video>
                            </div>
                          </div>
                          <a class="btn btn--dark d-none"id="change_video_hide">Change Video</a>
                        </label>
                      </div>
                    </div>
                    <div class="mb-3 admin-file-inp"><label class="form-label" for="course_name">Course Name</label>
                      <input class="form-control shadow" name="course_name" id="course_name" type="text"
                        placeholder="Course Name">
                    </div>
                    <div class="mb-3 admin-file-inp"><label class="form-label" for="course_tagline">Course
                      Tagline (Optional)</label><input class="form-control shadow" name="course_tagline" id="course_tagline"
                        type="text" placeholder="Course Tagline">
                    </div>
                    <div class="mb-3 admin-file-select">
                      <label for="id_label_multiple">Add Coaches</label>
                      <select name="coaches" id="coaches" class="select2 form-select js-example-templating js-states form-control select2-hidden-accessible select-img"
                        aria-label="Default select example" multiple="multiple">
                        @foreach (coachList() as $coach)
                          <option value="{{ $coach->id }}" data-src="{{ $coach->profile_image_url }}">{{ $coach->first_name . ' ' . $coach->last_name }}</option>
                        @endforeach
                      </select>
                    </div>
                    
                    <div class="mb-3 admin-file-textarea">
                      <label class="form-label" for="description">Description</label>
                      <textarea class="form-control shadow" name="description" id="description" rows="3" placeholder="Description"></textarea>
                    </div>
                    
                    <div class="mb-3 admin-file-textarea">
                      <label class="form-label" for="description">Module Overview Description</label>
                      <textarea class="form-control shadow" name="module_overview_description" id="module_overview_description" rows="3" placeholder="Module Overview Description..."></textarea>
                    </div>
                    
                    <div class="mb-3 admin-file-textarea">
                      <label class="form-label" for="description">Upload PDF</label>
                      <input class="form-control shadow" name="upload_pdf" id="upload_pdf" type="file" accept=".pdf">
                    </div>
                    
                    <div class="mb-3 admin-file-upd">
                      <label class="form-label w-100" for="course_completed_image">
                        Course Completed Image
                        <div class="admin-file-upd-input position-relative mt-1 course_completed_thumbnail_hide thunbnail-edit">
                          <input class="form-control"  name="course_completed_image" id="course_completed_image" type="file" accept="image/*">
                          <span class="position-absolute top-50 start-50 translate-middle color-light text-sm-16 text-center">Upload
                            Course Completed Image</span>
                        </div>
                        <div class="admin-file-upd-input position-relative mt-1 thunbnail-edit d-none" id="thumnail_coure_complate_img">
                          <label class="form-label w-100" for="course_completed_thumbnail_change_image">
                            <input class="d-none" type="file" name="" id="course_completed_thumbnail_change_image">
                             <img class="rounded-4 course_completed_thumbnail_image_preview d-none" 
                                  src="" alt="">
                            <a class="btn btn--dark d-none" id="change_completed_image_hide">Change Image</a>
                          <label>
                        </div>
                      </label>
                    </div>

                    <div class="mb-3 admin-file-inp">
                      <label class="form-label" for="google_pay_id">Google pay id (Optional)</label>
                      <input class="form-control shadow" name="google_pay_id" id="google_pay_id"  type="text" placeholder="Google pay id">
                    </div>
                    
                    <div class="mb-3 admin-file-inp">
                      <label class="form-label" for="apple_pay_id">Apple pay id (Optional)</label>
                      <input class="form-control shadow" name="apple_pay_id" id="apple_pay_id" type="text" placeholder="Apple pay id">
                    </div>
                    
                    <div class="mb-3 admin-file-inp">
                      <label class="form-label" for="stripe_subscription_course_id">Stripe subscription course id (Optional)</label>
                      <input class="form-control shadow" name="stripe_subscription_course_id" id="stripe_subscription_course_id" type="text" placeholder="Stripe subscription course id">
                    </div>
                      
                      
                    <div class="price-title">
                      <h5 class="mb-2">Course Price</h5>
                    </div>
                    <div class="course-price-tab my-2">
                      <ul class="nav nav-pills mb-3 nav-primary shadow" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <button class="nav-link active" onclick="setPriceType('free')" id="pills-free-tab" data-bs-toggle="pill" data-bs-target="#pills-free" type="button" role="tab"
                          aria-controls="pills-free" aria-selected="true">Free</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" onclick="setPriceType('paid')" id="pills-paid-tab" data-bs-toggle="pill" data-bs-target="#pills-paid" type="button" role="tab"
                          aria-controls="pills-paid" aria-selected="false">Paid</button>
                        </li>
                      </ul>
                      <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-free" role="tabpanel"
                          aria-labelledby="pills-free-tab" tabindex="0"> </div>
                        <div class="tab-pane fade" id="pills-paid" role="tabpanel"
                          aria-labelledby="pills-pais-tab" tabindex="0">
                          <div class="row">
                            <div class="col-md-6 mb-3">
                              <div class="admin-file-inp">
                                <input class="form-control shadow" name="course_price_type" id="course_price_type" type="hidden" value="free">
                                <input class="form-control shadow" name="course_price" id="course_price" type="number" value="" placeholder="e.g. 499">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      
                      <!-- <div class="review-title">
                        <h5 class="mb-2">Reviews</h5>
                        <p class="mb-0">Allow Members to add Reviews on this Course.</p>
                      </div>
                      <div class="lm_on-off shadow my-3">
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
                        <button class="btn btn--primary" id="SaveCourseBtn" type="button">Create Course</button>
                        {{-- <a class="btn btn--primary" href="{{ route('admin.courses.list') }}">Create Course</a> --}}
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

<script>
  
  function setPriceType(priceType)
  {
    $("input[name=course_price_type]").val(priceType);
    if(priceType=='free')
    {
      $("input[name=course_price]").val('');
    }    
  }  
  $(document).ready(function() { 
    $("#course_thumbnail, #course_thumbnail_change_image").on('change',function() {
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
            $('.course_thumbnail_image_preview').attr('src', e.target.result);
            $(".course_thumbnail_image_preview").removeClass('d-none');
            $(".course_thumbnail_image_preview").addClass('d-block');
            $('.course_thumbnail_hide').addClass('d-none');
            $("#thumnail_coure_img").removeClass("d-none");
            $("#thumnail_coure_img").addClass("d-block");
            $('#change_image_hide').removeClass('d-none');  
            $('#change_image_hide').addClass('d-relative');
            }
            // Read the file as a data URL
            reader.readAsDataURL(file);
        }
    });
    $("#course_preview_video1, #course_vedio_change").on('change',function() {
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
              $('.course_preview_video').removeClass('d-none');
              $('.course_preview_video').addClass('d-relative');
              $('.course_preview_video').attr('src', e.target.result);
              $('.course_video_hide').addClass('d-none');
              $('.lm_vedio-card.card').removeClass('d-none');
              $("#thumnail_coure_video").removeClass("d-none");
              $("#thumnail_coure_video").addClass("d-block");
              $('.lm_vedio-card.card').addClass('d-block');
              $('#change_video_hide').removeClass('d-none');  
              $('#change_video_hide').addClass('d-relative');
            }
            // Read the file as a data URL
            reader.readAsDataURL(file);
        }
    });
    $("#course_completed_image, #course_completed_thumbnail_change_image").on('change',function() {
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
            $('.course_completed_thumbnail_image_preview').attr('src', e.target.result);
            $(".course_completed_thumbnail_image_preview").removeClass('d-none');
            $(".course_completed_thumbnail_image_preview").addClass('d-block');
            $('.course_completed_thumbnail_hide').addClass('d-none');
            $("#thumnail_coure_complate_img").removeClass("d-none");
            $("#thumnail_coure_complate_img").addClass("d-block");
            $('#change_completed_image_hide').removeClass('d-none');  
            $('#change_completed_image_hide').addClass('d-relative');
            }
            // Read the file as a data URL
            reader.readAsDataURL(file);
        }
    });
  var $coursePriceInput = $("input[name=course_price]");
  // Add an input event listener to the input field
  $coursePriceInput.on("input", function () {
      // Get the current value of the input field
      var currentValue = $coursePriceInput.val();
      // Remove any leading '+' or '-' signs
      var sanitizedValue = currentValue.replace(/^[+-]/, '');
      // Update the input field value with the sanitized value
      $coursePriceInput.val(sanitizedValue);
  });

     /// Start code to create Course
  $('#SaveCourseBtn').click(function(e) {
    e.preventDefault();
    let _token = $("input[name=_token]").val();
    var clickButtonName = "#SaveCourseBtn";
    let formName = "#saveSourseForm";
    var formData = new FormData($(formName)[0]);
    
    console.log("Course add Form submited");
    
    var priceType = $("input[name=course_price_type]").val();
    var course_price = $("input[name=course_price]").val();

    if (priceType == 'paid' && (course_price === '' || isNaN(course_price) || parseFloat(course_price) < 0)) {
        var message = 'Course price can not be blank or negative!';
        Swal.fire({
            toast: true,
            icon: 'warning',
            title: message,
            position: 'top-right',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
        });

        return false;
    }
      
    $(clickButtonName).attr("disabled", true);
        $.ajax({
            url: "{{route('admin.course.create')}}"
            , type: "POST"
            , headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            , data: formData
            , dataType: 'JSON'
            , contentType: false // Set content type to false for file upload
            , processData: false 
            , success: function(data) {
              $(clickButtonName).attr("disabled", false);
                console.log(data);
                if (data.error) {
                  
                  // $(clickButtonName).attr("disabled", false);
                    printErrorMsg(data.error);
                    return false;
                } else if (data.status == "200")
                {
                  console.log(data.data);
                  
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
                            toast.addEventListener('mouseenter', Swal.stopTimer);
                            toast.addEventListener('mouseleave', Swal.resumeTimer);
                        }
                        });
                        
                        window.location.href="{{ route('admin.courses.list') }}";
                }
            },
            error: function(xhr, status, error) {
                  
              
              $(clickButtonName).attr("disabled", false);
                    
                    var errorMessage = "An error occurred. Please try again."; // Default error message
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        // console.log(xhr.responseJSON);
                        errorMessage = xhr.responseJSON.message; // Use the error message from the API response
                                                
                        var message = errorMessage;
                        Swal.fire({
                            toast: true,
                            icon: 'warning',
                            title: message,
                            position: 'top-right',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer);
                                toast.addEventListener('mouseleave', Swal.resumeTimer);
                            }
                            });
                        
                    }
                    // Set the error message in the desired HTML tag
                    $('#errorField').text(errorMessage);
                    console.log(errorMessage+ 'arvind');
                }
        });
    });    
    
    function printErrorMsg(msg) {
    console.log(msg);
    $.each(msg, function(key, value) {
        $("#errorField").text(value);
    });
    }
    
    
    /// Start Froala Editor for Description
    
    var CourseEditor = new FroalaEditor('#module_overview_description', {
          key: froala_editor_key,
          attribution: false,
          placeholderText: 'Module Overview Description...',
          imageInsertButtons: ['imageUpload'],
          toolbarButtons: {
            moreText: {
                buttons: [
                    'bold',
                    'italic',
                    'underline',
                    'strikeThrough',
                    'subscript',
                    'superscript',
                    'inlineStyle'
                ]
                },
                moreParagraph: {
                    buttons: [
                        'alignLeft',
                        'alignCenter',
                        'alignRight',
                        'alignJustify',
                        'formatOL',
                        'formatUL',
                        'outdent',
                        'indent',
                        'quote',
                        'paragraphStyle'
                    ]
                },
                moreRich: {
                    buttons: [
                    'insertLink',
                    'insertImage',
                    'insertVideo',
                    'insertTable',
                    'emoticons',
                    'specialCharacters',
                    'insertHR',
                    'selectAll',
                    'clearFormatting',
                    'print',
                    'help',
                    'html',
                    'undo',
                    'redo',
                    'trackChanges',
                    'markdown'
                ]
                },

                fontFamily: {
                    buttons: ['fontFamily', 'Arial', 'Verdana', 'Tahoma', 'Times New Roman']
                },
                fontSize: {
                    buttons: ['fontSize', '8', '10', '12', '14', '18', '24']
                }
                },
          imageUploadURL: "{{ route('upload.image') }}",
          imageAllowedTypes: ['jpeg', 'jpg', 'png', 'gif'],
          imageMaxSize: 50 * 1024 * 1024,
          videoUpload: true,
          videoUploadURL: "{{ route('upload.video') }}",
          // videoAllowedTypes: ['mp4', 'avi', 'mpeg', 'quicktime'],
          videoManagerLoadURL: '/load-videos',
          videoManagerDeleteURL: '/delete-video',
          videoDefaultDisplay: 'flex',
          requestHeaders: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          videoManagerPreloader: '/preloader.gif',
          
          videoManagerPageSize: 12
          , videoInsertButtons: ['videoBack', '|', 'videoUpload', 'videoManager']
          , videoEditButtons: ['videoReplace', 'videoRemove', '|', 'videoDisplay', 'videoAlign', 'videoSize']
          , videoUploadParams: {
              _token: $('meta[name="csrf-token"]').attr('content')
          }
          , videoManagerLoadParams: {
              _token: $('meta[name="csrf-token"]').attr('content')
          }
          , videoManagerDeleteParams: {
              _token: $('meta[name="csrf-token"]').attr('content')
          }
          , videoManagerSelection: true
          , videoAllowedProviders: ['YouTube', 'Vimeo', 'Dailymotion', 'Youku']
          , videoResponsive: true
          ,charCounterCount: false
          , videoSizeButtons: ['videoSize100', 'videoSize50', 'videoSize25']
          , videoDefaultWidth: '640'
          , videoDefaultHeight: '360'
          , videoDefaultAlign: 'center'
          , videoMaxSize: 200 * 1024 * 1024
          , videoUploadMethod: 'POST'
          ,videoAllowedTypes: ['avi', 'webm', 'mov', 'HEVC', 'flv', 'mp4','MOV']
          , videoManagerSortBy: 'name'
          , videoManagerSortOrder: 'ASC'
          , videoManagerView: 'grid'
          , videoManagerGridPerPage: 12
          , videoManagerGridView: {
              gridWidth: 'auto'
              , gridMargin: 10
          }
          , videoManagerListView: {
              listType: 'ul'
              , listClass: 'fr-video-list'
              , itemClass: 'fr-video-item'
          },
          events: {
          'image.inserted': function($img) {
              console.log('Image inserted:', $img.attr('src'));
              $('#user_post_btn').prop('disabled', false);
          },
          'video.inserted': function($video) {
              console.log('Video inserted:', $video.attr('src'));
              $('#user_post_btn').prop('disabled', false);
              if ($video) {
                var videoElement = $video.find('video'); // Find the video element within the container
                if (videoElement) {
                    videoElement.attr('controls', '');
                    videoElement.attr('controlslist', 'nodownload');
                }
              }
          },
          'contentChanged': function () {
              checkEditorContent();
          },
          'video.beforeInsert': function(e, video) {
              // Modify the video element before insertion.
              if (video) {
                  // Add the controlslist attribute to the video element.
                  video.attr('controlslist', 'nodownload');
              }
          }
                                                      

          }
      });
    //// End froala Editor for Description
    
  });    
    </script>
@endsection