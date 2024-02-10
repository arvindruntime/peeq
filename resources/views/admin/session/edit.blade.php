@extends('layouts.admin.master')
@section('content')
{{-- {{ dd($sessionData) }} --}}
<main class="main-content" id="main">
  <section class="lm__dash-con lm__course-list-admin lm_session-form pb-5">
    <span class="lm_vec"><img class="light" src="{{asset('assets/images/light.png')}}" alt=""><img class="dark"
        src="{{asset('assets/images/dark.png')}}" alt=""></span>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="mb-3">
            <a href="{{ route('admin.session.list') }}" class="btn btn--primary rounded-4 py-2">Go Back</a>
          </div>
          <div class="create-list-admin">
            <div class="create-list-admin-title">
              <h4 class="mb-0 text-primary fw-semibold">PEEQ Session</h4>
            </div>
            <div class="create-admin-form">
              <form action="#" id="saveSessionForm" method="post" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-12">
                    <div id="session1" class="desc">
                      <div class="mb-3 admin-file-upd">
                        <label class="form-label w-100" for="course_thumbnail">
                          Session Thumbnail (600W x 340H) <span class="asterisk">*</span>
                          <div class="admin-file-upd-input position-relative mt-1 thunbnail-edit">
                            <label class="form-label w-100" for="course_thumbnail_change_image">
                              <input class="d-none" type="file" name="thumbnail_img" id="course_thumbnail_change_image">
                              <img class="rounded-4 course_thumbnail_image_preview" name="course_thumbnail"
                                src="{{ $sessionData['thumbnail_img'] }}" alt="">
                              <a class="btn btn--dark " id="change_image_hide">Change Image</a>
                              <label>
                          </div>
                        </label>
                      </div>
                    </div>

                    @if($sessionData['thumbnail_video']=="")
                    <div class="mb-3 admin-file-upd">
                      <label class="form-label w-100" for="session_preview_video">
                        Session Video (600W x 340H)
                        <div class="admin-file-upd-input position-relative mt-1 thunbnail-edit session_video_hide">
                          <input class="form-control" name="thumbnail_video" id="session_preview_video" type="file"
                            accept="video/*">
                          <span class="position-absolute top-50 start-50 translate-middle color-light text-sm-16 text-center">Upload
                            Session Preview Video (600W x 340H)</span>
                        </div>
                      </label>
                      {{-- Video preview --}}
                      <div class="admin-file-upd-input position-relative mt-1 thunbnail-edit d-none"
                        id="thumnail_session_video">
                        <label class="form-label w-100" for="session_vedio_change">
                          <div class="lm_vedio-card card d-none">
                            <input class="d-none" type="file" name="" id="session_vedio_change">
                            <div class="card-img position-relative">
                              <video controlsList="nodownload" controls class="w-100  session_preview_video d-none"
                                src="">
                                <source src="" class="">
                              </video>
                            </div>
                          </div>
                          <a class="btn btn--dark d-none" id="change_video_hide">Change Video</a>
                        </label>
                      </div>
                    </div>
                    @else
                    <div class="mb-3 admin-file-upd">
                      <label class="form-label w-100" for="course_preview_video">
                        Session Preview Video (600W x 340H)
                        <div class="admin-file-upd-input position-relative mt-1 thunbnail-edit">
                          <label class="form-label w-100" for="course_vedio_change">
                            <div class="lm_vedio-card card">
                              <input class="d-none" type="file" name="thumbnail_video" id="course_vedio_change">
                              <div class="card-img position-relative">
                                <video controlsList="nodownload" controls class="w-100  course_preview_video"
                                  name="thumbnail_video" src="{{ $sessionData['thumbnail_video'] ?? '' }}">
                                  <source src="{{ $sessionData['thumbnail_video'] ?? '' }}" type="video/mp4">
                                  <source src="{{ $sessionData['thumbnail_video'] ?? '' }}" type="video/ogg">
                                </video>
                              </div>
                            </div>
                            <a class="btn btn--dark" id="change_video_hide">Change Video</a>
                          </label>
                        </div>
                      </label>
                    </div>
                    @endif
                  </div>
                  {{-- Session Name --}}
                  <div class="mb-3 admin-file-inp"><label class="form-label" for="session_name">Session Name <span
                        class="asterisk">*</span></label>
                    <input class="form-control shadow" name="session_name" id="session_name"
                      value="{{ $sessionData['session_name'] }}" type="text" placeholder="Session Name">
                  </div>

                  {{-- Short Description --}}
                  <div class="mb-3 admin-file-inp"><label class="form-label" for="short_description">Short Description 
                      (Optional)</label>
                    <input class="form-control shadow" name="short_description" id="short_description" type="text"
                      placeholder="Short Description 255 Character Max" value="{{ $sessionData['short_description'] }}">
                  </div>

                  {{-- Description --}}
                  <div class="mb-3 admin-file-textarea">
                    <label class="form-label" for="description">Description <span class="asterisk">*</span></label>
                    <textarea class="form-control shadow" name="description" id="description" rows="3"
                      placeholder="Description">{{ $sessionData['description'] }}</textarea>
                  </div>

                  {{-- Add coaches --}}

                  <div class="mb-3 admin-file-select">
                    <label for="id_label_multiple">Add Coaches <span class="asterisk">*</span></label>
                    @php $course_price = '';

                    @endphp
                    <select name="coaches[]" id="coaches"
                      class="select2 form-select js-example-templating js-states form-control select2-hidden-accessible select-img"
                      aria-label="Default select example" multiple="multiple">
                      @foreach (coachList() as $coach)
                      @php
                      $coachId = $coach->id;
                      @endphp
                      <option value="{{ $coachId }}" data-src="{{ $coach->profile_image_url }}" 
                        @if($sessionData['coaches']->contains('id', $coachId)) selected @endif
                        >{{ $coach->first_name }} {{ $coach->last_name }}</option>
                      @endforeach
                    </select>

                  </div>

                  {{-- Sesion Duration and Price --}}
              <div class="session_box">
                @if(!empty($sessionData['session_duration_data']))
                @php
                  // $sessionDurationCount = count($sessionData['session_duration_data']);
                @endphp
                  @foreach ($sessionData['session_duration_data'] as $key => $durationData)
                    <div class="row mb-2">
                      <div class="col-sm-5">
                        <div class="admin-file-inp w-100 mb-2">
                          <label for="session_duration" class="form-label">Session Duration <span
                              class="asterisk">*</span></label>
                          {!! sessionDurationSelect('session_duration[]', $durationData['session_duration']) !!}
                        </div>
                        <div class="admin-file-inp w-100 mb-2">
                          <label for="session_price" class="form-label">Session Slot Price <span
                              class="asterisk">*</span></label>
                              {!! sessionPriceSelect('session_price[]', $durationData['session_price']) !!}
                        </div>
                      </div>
                      <div class="col-sm-7">
                        <div class="mb-3 admin-file-textarea">
                          <label class="form-label" for="session_code">Calendly code</label>
                          <div class="d-flex align-items-center gap-2">
                            <textarea class="form-control shadow" name="calendly_description[]" id="session_code"
                              rows="4" placeholder="Calendly code">{{ $durationData['calendly_description'] }}</textarea>
                            
                            @if( $key==0)
                              <span class="lm_form-add shadow">
                                  <img src="{{asset('assets/images/plus2.svg')}}" alt="">
                              </span>
                            @else
                              <span class="lm_form-remove shadow">
                                  <img src="{{asset('assets/images/minus.svg')}}" alt="">
                              </span>
                            @endif
                            
                          </div>
                        </div>
                      </div>
                    </div>
                    @php
                      // $sessionDurationCount = ($sessionDurationCount+1);
                    @endphp
                  @endforeach
                  @else
                  <div class="row session_row">
                    <div class="col-sm-5">
                      <div class="admin-file-inp w-100 mb-2">
                        <label for="session_duration" class="form-label">Session Duration <span class="asterisk">*</span></label>
                        {!! sessionDurationSelect('session_duration[]', '') !!}
                      </div>
                      <div class="admin-file-inp w-100 mb-2">
                        <label for="session_price" class="form-label">Session Slot Price <span class="asterisk">*</span></label>
                        {!! sessionPriceSelect('session_price[]', '') !!}
                      </div>
                    </div>
                    <div class="col-sm-7">
                      <div class="mb-3 admin-file-textarea">
                        <label class="form-label" for="calendly_description">Calendly code</label>
                        <div class="d-flex align-items-center gap-2">
                          <textarea class="form-control shadow" name="calendly_description[]" rows="4" placeholder="Calendly code"></textarea>
                          
                        <span class="lm_form-add shadow">
                            <img src="{{asset('assets/images/plus2.svg')}}" alt="">
                        </span>
                        {{-- <span class="lm_form-remove shadow">
                            <img src="{{asset('assets/images/minus.svg')}}" alt="">
                        </span> --}}
                        
                          {{-- <span class="lm_form-add shadow">
                            <img src="{{asset('assets/images/plus2.svg')}}" alt="">
                          </span> --}}
                          {{-- <span class="lm_form-remove shadow" style="display: none;">
                            <img src="{{asset('assets/images/minus.svg')}}" alt="">
                          </span> --}}
                        </div>
                      </div>
                    </div>
                  </div>
                @endif
              </div>
                
                </div>
                <div class="review-title mt-2">
                  <h5 class="mb-2">Session Privacy <span class="asterisk">*</span></h5>
                  <div class="lm_on-off shadow mt-2 my-3">
                    <div class="lm_switch">
                      <div class="form-check form-switch ps-0 mb-2">
                        <div class="d-flex gap-5 align-items-center justify-content-between">
                          <label class="form-check-label title-font mb-0" id="status" for="status">Public
                          </label>
                          <input name="status" id="session_status" class="form-check-input on-off session_status"
                            type="checkbox" role="switch" @if($sessionData['status']=='1' ) checked @endif>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="lm_privacy mb-3">
                  <div class="d-flex justify-content-center align-item-center text-center">
                    <div class="d-block">
                      <p class="text-white mb-0 fw-bold">Privacy - Secret</p>
                      <p class="text-white mb-0"> By default the Session will be private can change after
                        creating modules.
                      </p>
                    </div>
                  </div>
                </div>
                <div class="lm_crt-btn d-flex justify-content-center align-item-center">
                  <button class="btn btn--primary" id="UpdateSessionBtn" type="button">Update Session</button>
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
  $(document).ready(function() {
    
    
    $(".session_box").on("click", ".lm_form-add", function() {
    var addMoreSessionDuration = '<div class="row session_row"><div class="col-sm-5"><div class="admin-file-inp w-100 mb-2"><label for="session_duration" class="form-label">Session Duration <span class="asterisk">*</span></label>{!! sessionDurationSelect("session_duration[]", 30) !!}</div><div class="admin-file-inp w-100 mb-2"><label for="session_price" class="form-label">Session Slot Price <span class="asterisk">*</span></label>{!! sessionPriceSelect("session_price[]", 400) !!}</div></div><div class="col-sm-7"><div class="mb-3 admin-file-textarea"><label class="form-label" for="calendly_description">Calendly code</label><div class="d-flex align-items-center gap-2"><textarea class="form-control shadow" name="calendly_description[]" rows="4" placeholder="Calendly code"></textarea><span class="lm_form-remove shadow"><img src="{{asset("assets/images/minus.svg")}}" alt=""></span></div></div></div></div>';
    $(".session_box").append(addMoreSessionDuration);
    });

    // $(".session_box").on("click", ".lm_form-remove", function() {
    //     $(this).closest('.session_row').remove();
    // });
    
    $(".session_box").on("click", ".lm_form-remove", function() {
    $(this).closest('.row').remove();
});




    // // // Add new row on lm_form-add click
    // $(".session_box").on("click", ".lm_form-add", function() {
    //   var addMoreSessionDuration = '<div class="row session_row"><div class="col-sm-5"><div class="admin-file-inp w-100 mb-2"><label for="session_duration" class="form-label">Session Duration <span class="asterisk">*</span></label>{!! sessionDurationSelect("session_duration[]", 30) !!}</div><div class="admin-file-inp w-100 mb-2"><label for="session_price" class="form-label">Session Slot Price <span class="asterisk">*</span></label>{!! sessionPriceSelect("session_price[]", 400) !!}</div></div><div class="col-sm-7"><div class="mb-3 admin-file-textarea"><label class="form-label" for="calendly_description">Calendly code</label><div class="d-flex align-items-center gap-2"><textarea class="form-control shadow" name="calendly_description[]" rows="4" placeholder="Calendly code"></textarea><span class="lm_form-remove shadow"><img src="{{asset("assets/images/minus.svg")}}" alt=""></span></div></div></div></div>';
    //   $(".session_box").append(addMoreSessionDuration);
    // });   

    // // // Remove row on lm_form-remove click
    //  $(".session_box").on("click", ".lm_form-remove", function() {
    //    $(this).closest('.session_row').remove();
    //  });
  });
</script>

{{-- <script>
  $(document).ready(function() {
    
    // // Add new row on lm_form-add click
    $(".session_box").on("click", ".lm_form-add", function() {
      var clonedRow = $(".session_row:first").clone();
      clonedRow.find('select, textarea').val('');
      clonedRow.find('.lm_form-add').hide();
      clonedRow.find('.lm_form-remove').show();
      $(".session_box").append(clonedRow);
    });

    // // Remove row on lm_form-remove click
     $(".session_box").on("click", ".lm_form-remove", function() {
       $(this).closest('.session_row').remove();
     });
  });
</script> --}}
<script>
  $(document).ready(function() {
    
    ///// Start session update code //////////////////
  $('#UpdateSessionBtn').click(function(e) {
    e.preventDefault();
    var clickButtonName = "#UpdateSessionBtn";
    let formName = "#saveSessionForm";
    var formData = new FormData($(formName)[0]);
    var session_status = $('.session_status').is(':checked');
    if (session_status) {
        formData.append('status', 1);
    } else {
        formData.append('status', 0);
    }
      console.log("Session update Form submited");
      $(clickButtonName).attr("disabled", true);
      
      let url = '{{ route("admin.session.update", ":id") }}';
      url = url.replace(':id', {{ $sessionData['id'] }});
    
        $.ajax({
            url: url
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
                    //printErrorMsg(data.error);
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
                        
                        window.location.href="{{ route('admin.session.list') }}";
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
          }
        });
    });
   ///// End session update code 
   //#thumbnail_img,
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
    
    $("#session_preview_video, #session_vedio_change").on('change',function() {
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
              $('.session_preview_video').removeClass('d-none');
              $('.session_preview_video').addClass('d-relative');
              $('.session_preview_video').attr('src', e.target.result);
              $('.session_video_hide').addClass('d-none');
              $('.lm_vedio-card.card').removeClass('d-none');
              $("#thumnail_session_video").removeClass("d-none");
              $("#thumnail_session_video").addClass("d-block");
              $('.lm_vedio-card.card').addClass('d-block');
              $('#change_video_hide').removeClass('d-none');  
              $('#change_video_hide').addClass('d-relative');
            }
            // Read the file as a data URL
            reader.readAsDataURL(file);
        }
    });
  
    $("input[name$='session_upd']").click(function() {
        var test = $(this).val();

        $("div.desc").hide();
        $("#session" + test).show();
    });
    // Privacy
    $('.on-off').on('click', function(e) {
    var value = $('.on-off').is(':checked');
  
    if (value) {
      $('#public_private').text("Private");
    } else {
      $('#public_private').text("Public");
    }
  });
});
</script>
@endsection