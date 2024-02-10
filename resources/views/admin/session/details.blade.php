@extends('layouts.admin.master')
@section('content')
<main class="main-content" id="main">
  <section class="lm__dash-con lm__course-buy mb-5 lm_session-details">
    <span class="lm_vec"><img class="light"
      src="assets/images/light.png" alt=""><img class="dark" src="assets/images/dark.png" alt=""></span>
    <div class="container">
      <div class="mb-3">
        <a href="{{ route('admin.session.list') }}" class="btn btn--primary rounded-4 py-2">Go Back</a>
      </div>
      <div class="row lm__course-buy-main">
        {{-- Details --}}
        <div class="col-md-7 col-lg-8 col-xxl-8">
          <div class="lm__course-buy-inner">
            <div class="lm_course-buy-con">
              <div class="lm_course-buy-card card bg-gradient">
                <h2 class="fw-bold text-white">{{ $response['session_name'] }}</h2>
                <h6 class="text-white">{{ $response['short_description'] }}</h6>

                <div class="d-flex align-items-end justify-content-between mt-2">
                  <div class="d-flex align-items-center gap-2"><span class="text-white title-font">Coaches</span>
                    <div class="avtar-group mt-1">
                      @foreach ($response['coaches'] as $coach)
                      <div class="avtar-55"><a onclick="ViewMemberProfile({{ $coach['id'] }})"><img src="{{ $coach['profile_image_url'] ?? asset('assets/images/ev1.jpg')}}" alt=""></a></div>
                      @endforeach
                    </div>
                  </div>
                  <p class="mb-0 text-white">Last updated {{ $response['last_updated'] }}</p>
                </div>
              </div>
              <div class="lm__view-tab">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                  <li class="nav-item" role="presentation"><button class="nav-link active"
                      id="pills-sessionmaterial-tab" data-bs-toggle="pill" data-bs-target="#pills-sessionmaterial"
                      type="button" role="tab" aria-controls="pills-sessionmaterial" aria-selected="true">Description</button></li>
                  <li class="nav-item" role="presentation"><button class="nav-link" id="pills-coaches-tab"
                      data-bs-toggle="pill" data-bs-target="#pills-coaches" type="button" role="tab"
                      aria-controls="pills-coaches" aria-selected="false">Coaches</button></li>
                </ul>
              </div>
              <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-sessionmaterial" role="tabpanel"
                  aria-labelledby="pills-sessionmaterial-tab" tabindex="0">
                  <div class="lm_course-buy-card card border-0 p-30">
                    <h5 class="fw-bold">Description</h5>
                    <h6 class="color-light">{!! nl2br(e($response['description'])) !!}</h6>
                  </div>
                  
                </div>
                <div class="tab-pane fade" id="pills-coaches" role="tabpanel" aria-labelledby="pills-coaches-tab"
                  tabindex="0">
                  
                @foreach ($response['coaches'] as $key => $member)
                  @php
                  $is_follow = ($member['is_follow']) ? $member['is_follow'] : 0 ;
                  
                  @endphp
                  <div class="lm__member-card mb-3">
                    <div class="card shadow p-3 border-0">
                      <div class="d-sm-flex flex-wrap align-items-center gap-2 justify-content-between">
                        <a class="d-flex align-items-center gap-2 mb-2 mb-sm-0" onclick="ViewMemberProfile({{ $member['id'] }})">
                          <div class="avtar-xxl"><img class="rounded-circle position-relative"
                              src="{{ $member['profile_image_url'] ?? asset('assets/images/avtar-6.jpg')}}" alt=""></div>
                          <div class="d-block">
                            <h6 class="mb-0 text-dark" type="button" data-bs-toggle="offcanvas"
                              data-bs-target="#offcanvasRight10" aria-controls="offcanvasRight10"> {{ $member['first_name'].' '.$member['last_name'] }}
                            </h6>
                          </div>
                        </a>
                        <div class="d-flex gap-3 align-items-center lm__member-btn">
                          {{-- <a class="btn btn--chat btn-follow py-1 title-font px-3" href="#">Following </a> --}}
                          {{-- <a class="btn btn--chat py-1 title-font px-3" href="#">Chat</a> --}}
                          @if($is_follow==1)
                          <a class="btn btn--chat btn-follow py-1 title-font px-3 memberActivityAction memberId{{ $member['id'] }}" is-follow="{{ $is_follow }}" member-id="{{ $member['id'] }}">{{ ($is_follow==1) ? 'Following' : 'Follow'}} </a>
                          @else
                          <a class="btn btn--chat btn-follow active py-1 title-font px-3 memberActivityAction memberId{{ $member['id'] }}" is-follow="{{ $is_follow }}" member-id="{{ $member['id'] }}">{{ ($is_follow==1) ? 'Following' : 'Follow'}} </a>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
                  
                </div>
              </div>
            </div>
          </div>
        </div>
        {{-- Slot --}}
        <div class="col-md-5 col-lg-4 col-xxl-4 ps-xxl-0 mt-3 mt-xxl-0 mt-md-0">
          <div class="lm_vedio-card card">
            <div class="card-img position-relative">
              {{-- Uploaded Image here --}}
              <img class="w-100" src="{{ $response['thumbnail_img'] ?? asset('assets/images/courses3.jpg')}}" alt="">
              {{-- When only image upload add in below d-none --}}
              <div class="card-img-overlay">
                <div class="d-flex justify-content-center align-items-center text-center h-100">
                  
                  @if($response['thumbnail_video']!='' && !empty($response['thumbnail_video']))
                  <a class="play-video" onclick="CoursePreviewVideo('{{ $response['thumbnail_video'] }}')" data-bs-toggle="modal" data-bs-target="#course_preview_video">
                  {{-- data-bs-toggle="modal" data-bs-target="#session_video-preview" --}}
                  <img class="in-svg" src="{{asset('assets/images/play-1.svg')}}" alt="">
                    <h6 class="text-white">Preview</h6>
                  </a>
                @endif
                </div>
              </div>
            </div>
            {{-- Button --}}
            {{-- {{ dd($response) }} --}}
            <div class="card-body p-0 pt-2">
              <h4 class="mb-2"> {{ $response['session_name'] }}</h4>
              <h6>Session duration</h6>  
                        
              <form method="post" action="{{ route('session.payment.plan')}}" id="SessionPaymentform12">
                @csrf
              <div class="">
                <div class="lm_slot-min d-flex mb-3 flex-wrap">
                  @if(isset($response['session_duration_data']) && isset($response['session_duration_data'][0]['session_price']))
                  @foreach ($response['session_duration_data'] as $key => $duration_data)
                  @php
                  $selected = '';
                  if($key==0)
                  {
                    $selected = 'checked';
                  }
                  @endphp
                  
                    <input type="radio" class="btn-check" name="session_duration" value="{{ $duration_data['session_duration_id'] }}" id="session_duration{{ $duration_data['session_duration_id'] }}" autocomplete="off" session-price-transaction-id="{{ $duration_data['session_duration_id'] }}" data-session-duration="{{ $duration_data['session_duration'] }}" data-session-price="{{ $duration_data['session_price'] }}" {{ $selected }}>
                    <label class="btn min_slot" for="session_duration{{ $duration_data['session_duration_id'] }}" >{{ $duration_data['session_duration'] }}</label>
                  @endforeach 
                  @endif
                </div>
                
                @if(isset($response['session_duration_data']) && isset($response['session_duration_data'][0]['session_price']))
                    <p class="text-center text-dark show-session-duration-and-price">
                        {{ $response['session_duration_data'][0]['session_duration'] }} / Day: ${{ $response['session_duration_data'][0]['session_price'] }}
                    </p>
                @else
                    <p class="text-center text-dark show-session-duration-and-price">
                        Price not available
                    </p>
                @endif
              </div>
              
              <div class="d-flex gap-2">
                @if(Auth::user()->id!=1) 
                 {{--$response['session_purchase_status']==0 &&   --}}
                
                  {{-- <input type="hidden" name="session_price_transaction_id" id="session_price_transaction_id"> --}}
                  <button class="btn btn--primary d-block w-100 py-2" id="SessionPaymentBtn11" type="submit">Pay Now</button>
                
                @endif
                
                <div class="lm__share">
                  <div class="d-flex gap-2">
                    <span class="lm_pen" data-bs-toggle="tooltip" data-bs-original-title="Share The Session">
                      <a  onclick="OpenShareSessionModal('{{ route('admin.session.detail', ['id' => $response['id']]) }}')">
                        {{-- type="button" data-bs-toggle="offcanvas" data-bs-target="#courseshare" aria-controls="courseshare" class="" href="#" --}}
                        <img class="in-svg"  src="{{ asset('assets/images/share.svg') }}" alt="">
                      </a>
                    </span>
                    {{-- <span><a href="#"> <img class="in-svg" src="{{asset('assets/images/download.svg')}}" alt=""></a></span> --}}
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


  </form>
</div>
{{-- Modal --}}

{{-- ////// calendly modal removed from here --}}

{{-- <div class="modal fade" id="session_video-preview" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered lm__modal-4 session_preview">
    <div class="modal-content overflow-hidden">
      <div class="modal-body p-4 text-center position-relative">
          
          <div class="z-index-1 position-relative lm_mxw50">
            <video controls poster="" >
              <source src="{{ asset('assets/images/about.mp4') }}" type="video/mp4">
              <source src="{{ asset('assets/images/about.mp4') }}" type="video/ogg">
          </video>
          </div>
          <div>
            <a class="btn btn--primary rounded-5 mt-3" data-bs-dismiss="modal"
            aria-label="Close" href="">Continue</a>
            
          </div>
      </div>
    </div>
  </div>
</div> --}}

{{-- <div class="modal fade" id="course_preview_video" data-bs-backdrop="static"  data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" >
  <div class="modal-dialog modal-dialog-centered lm__modal-3 lm__modal-25">
    <div class="modal-content overflow-hidden">
      <div class="modal-body p-4 text-center position-relative">
        <div class="lm__modal-body">
          <div class="lm__modal-3-video position-relative z-index-3 mb-3">            
            <iframe width="750" height="425" id="coursePreviewVideoURL" src="https://www.youtube.com/embed/DFSK_sVwOY8" title="YouTube video player" frameborder="0"  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
              allowfullscreen="">
            </iframe> 
          </div>
          <div class="lm__modal-btn ContinueClick"> <button class="btn btn--primary px-5" data-bs-dismiss="modal">Continue</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> --}}
@include('admin.session.session-modal');
{{-- @if($response['session_purchase_status'] == 1 && Auth::user()->id != 1 && request('calendly_popup') == 1)
    <script>
        $(document).ready(function () {
            $("#bookmy_session").modal('show');
        });
    </script>
@endif --}}

<script type="text/javascript">
  $(document).ready(function() {    
    $(".memberActivityAction").click(function(e) {
        var member_id = $(this).attr("member-id");
        var is_follow = $(this).attr("is-follow");
        
        if(is_follow==1)
        {
          $(this).attr("is-follow", 0);
          $(this).html('Follow');
        }
        
        if(is_follow==0)
        {
          $(this).attr("is-follow", 1);
          $(this).html('Following');
          
        }
        var UpdatedFollowstatus = $(this).attr("is-follow");
        // console.log("member id: " + member_id);
        // console.log("is_follow = " + is_follow);
        // console.log("UpdatedFollowstatus  =" + UpdatedFollowstatus);
        memberActivityAction('follow',member_id,UpdatedFollowstatus,1);
      });
  });
  
    function memberActivityAction(type='',member_id='',is_follow='',is_block_member='') {
          let _token = $("input[name=_token]").val();
          var dataArray = {
                    type: type,
                    _token: _token
                  };
          if(type=="follow")
          {
            dataArray.followers = member_id;
            dataArray.is_follow = is_follow;
          }
          if(type=="block")
          {
            dataArray.block_user_id = member_id;
            dataArray.is_block_member = is_block_member;
            
            type = "blocked";
          }
          if(is_block_member==1)
          {
            type = "all";
          }
          if(type=="host")
          { 
            dataArray.followers = member_id;
            dataArray.is_follow = is_follow;        
            type = "host";
          }
              $.ajax({
                  url: "{{route('member.activity.action')}}"
                  , type: "POST"
                  , data: dataArray
                  , dataType: 'JSON'
                  , beforeSend: function () {
  
                  }
                  , success: function(data) {
                    
                    console.log(data.data.is_follow);
                    
                    
                    
                    // $(".memberId"+member_id).attr("dis-follow", "new val");
                    // var updatedValue = $(".memberId"+member_id).attr("is-follow");
                    
                   
                      if (data.error) {
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
                              didOpen: (toast) => {
                              toast.addEventListener('mouseenter', Swal.stopTimer)
                              toast.addEventListener('mouseleave', Swal.resumeTimer)
                              }
                          });
                
                      }  
                  }
              });
      }
  </script>
  

<script>
  $(document).ready(function () {
    
    // $('.btn-check').click();
    $('.btn-check:checked').change();
    
    $('.btn-check').change(function () {
            // Get the selected radio button's data attributes
            var sessionDuration = $(this).data('session-duration');
            var sessionPrice = $(this).data('session-price');

            // Update the content of the element with class "show-session-duration-and-price"
            $('.show-session-duration-and-price').text(sessionDuration + " / Day: $" + sessionPrice);
        });
        
      
    // $('.btn-check').on('click', function () {
    //   var selectedDuration = $(this).data('session-duration');
    //   var selectedPrice = $(this).attr('data-session-price');
    //   // $('#session_price_transaction_id').val($(this).attr('session-price-transaction-id'));
      
      
    //   console.log("selectedDuration =", selectedDuration);
    //   console.log("selectedPrice =", selectedPrice);
    //   $('.show-session-duration-and-price').text(selectedDuration + ' / Day: $' + selectedPrice);
    // });
    
    
    
     ///// Start session payment code //////////////////
  $('#SessionPaymentBtn').click(function(e) {
    e.preventDefault();
    var clickButtonName = "#SessionPaymentBtn";
    let formName = "#SessionPaymentform";
    var formData = new FormData($(formName)[0]);
    
    // Get the selected value of the radio button
    var session_duration = $('input[name="session_duration"]:checked').val();

    if (session_duration) {
        // If a radio button is selected, append its value to formData
        formData.append('session_duration', session_duration);

        // Continue with your logic here...
    } else {
        // If no radio button is selected, show an error message
        var error_message = "Please select a session duration.";
        Swal.fire({
            toast: true,
            icon: 'error',
            title: error_message,
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
            url: "{{ route('session.payment.plan')}}"
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
                    // $('#errorField').text('');
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
                        
                        window.location.href=data.data.stripe_payment_int_url;
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
              // $('#errorField').text(errorMessage);
          }
        });
    });
  });
</script>

{{-- <script>
  document.addEventListener('DOMContentLoaded', function () {
    var radioButtons = document.querySelectorAll('.show-session-duration-btn');
    var displayElement = document.querySelector('.show-session-duration-and-price');

    radioButtons.forEach(function (radioButton) {
      radioButton.addEventListener('click', function () {
        var selectedDuration = this.getAttribute('data-session-duration');
        var selectedPrice = this.getAttribute('data-session-price');
        console.log("selectedDuration = ",selectedDuration);
        console.log("selectedPrice = ",selectedPrice);
        displayElement.textContent = selectedDuration + ' / Day: $' + selectedPrice;
      });
    });
  });
</script> --}}
@endsection