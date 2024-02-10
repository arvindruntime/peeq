@extends('layouts.admin.master')
@section('content')
<!-- USER -->
{{-- {{ dd($course['upload_pdf']) }} --}}

<main class="main-content" id="main">
  <section class="lm__dash-con lm__course-buy mb-5">
    <span class="lm_vec"><img class="light"
      src="{{asset('assets/images/light.png')}}" alt=""><img class="dark" src="{{asset('assets/images/dark.png')}}" alt=""></span>
    <div class="container">
      <div class="mb-3">
        <a href="{{ route('user.courses.list') }}" class="btn btn--primary rounded-4 py-2">Go Back</a>
      </div>
      <div class="row lm__course-buy-main">
        <div class="col-md-7 col-lg-12 col-xl-8">
          <div class="lm__course-buy-inner">
            <div class="lm_course-buy-con">
              <div class="lm_course-buy-card card bg-gradient">
                <h2 class="fw-bold text-white">{{ $course['course_name'] }}</h2>
                <h6 class="text-white">{{ $course['course_tagline'] }}</h6>

                <div class="d-flex align-items-end justify-content-between mt-2">
                  <div class="d-flex align-items-center gap-2">
                    <span class="text-white title-font">Coaches</span>
                    <div class="avtar-group mt-1">
                          
                      @if(isset($course['coaches']))
                      @foreach ($course['coaches'] as $coaches)
                      {{-- {{ dd($coaches) }} --}}
                        <div class="avtar-55"><a onclick="ViewMemberProfile({{ $coaches['id'] }})"><img src="{{ $coaches['profile_image_url'] ?? asset('assets/images/ev1.jpg')}}"></a></div>
                      @endforeach
                      @endif
                      
                    </div>
                  </div>
                  
                  <p class="mb-0 text-white">Last updated {{ $course['last_updated'] }}</p>
                </div>
              </div>
                         
              <div class="lm__view-tab">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                  <li class="nav-item" role="presentation"><button class="nav-link active"
                      id="pills-coursematerial-tab" data-bs-toggle="pill" data-bs-target="#pills-coursematerial"
                      type="button" role="tab" aria-controls="pills-coursematerial" aria-selected="true">Course
                      Material</button></li>
                  <li class="nav-item" role="presentation"><button class="nav-link" id="pills-coaches-tab"
                      data-bs-toggle="pill" data-bs-target="#pills-coaches" type="button" role="tab"
                      aria-controls="pills-coaches" aria-selected="false">Coaches</button></li>
                </ul>
              </div>
              <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-coursematerial" role="tabpanel"
                  aria-labelledby="pills-coursematerial-tab" tabindex="0">
                  <div class="lm_course-buy-card card bg-gradient-gray border-0">
                    <h5>Course Material</h5>
                    
                    
                    
                    {{-- <div>
                      <span class="list-group-item list-group-item-action ps-0 py-0">
                         <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2 p-3">
                               <p class="mb-0">Welcome To Your Self Mastery Journey</p>
                            </div>
                         </div>
                      </span>
                      <span class="list-group-item list-group-item-action ps-0 py-0">
                         <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2 p-3">
                               <p class="mb-0">Welcome To Your Self Mastery Journey</p>
                            </div>
                         </div>
                      </span>
                      <span class="list-group-item list-group-item-action ps-0 py-0">
                         <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2 p-3">
                               <p class="mb-0">Welcome To Your Self Mastery Journey</p>
                            </div>
                         </div>
                      </span>
                      <span class="list-group-item list-group-item-action ps-0 py-0">
                         <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2 p-3">
                               <p class="mb-0">Welcome To Your Self Mastery Journey</p>
                            </div>
                         </div>
                      </span>
                      <span class="list-group-item list-group-item-action ps-0 py-0">
                         <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2 p-3">
                               <p class="mb-0">Welcome To Your Self Mastery Journey</p>
                            </div>
                         </div>
                      </span>
                      
                      <div class="moretext">
                         <span class="list-group-item list-group-item-action ps-0 py-0">
                            <div class="d-flex align-items-center justify-content-between">
                               <div class="d-flex align-items-center gap-2 p-3">
                                  <p class="mb-0">Welcome To Your Self Mastery Journey</p>
                               </div>
                            </div>
                         </span>
                         <span class="list-group-item list-group-item-action ps-0 py-0">
                            <div class="d-flex align-items-center justify-content-between">
                               <div class="d-flex align-items-center gap-2 p-3">
                                  <p class="mb-0">Welcome To Your Self Mastery Journey</p>
                               </div>
                            </div>
                         </span>
                      </div>
                   </div>
                   <div class="d-flex align-items-center justify-content-center"><button
                      class="btn btn--primary p-10-50 moreless-button">More sections</button>
                   </div> --}}
                   
                   
                   
                   
                   
                     {{-- <p class="mb-2">46 Modules • 42h 34m total length</p> --}}
                     @if(isset($course['course_material']['modules']))
                     <p class="mb-2">{{ $course['course_material']['total_modules'] }} Modules</p>
                     @endif
                    <div class="list-group video-list">
                      
                      @php
                        $count = 0;
                      @endphp
                      @if(isset($course['course_material']['modules']))
                      @foreach ($course['course_material']['modules'] as $i=> $course_material)
                      @php
                        $count += 1;
                      @endphp
                      @if($i<5)
                        <span class="list-group-item list-group-item-action ps-0 py-0" aria-current="true">
                          <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2 p-3">
                              <!-- <div class="video-bg"><img class="in-svg" src="{{asset('assets/images/play1.svg')}}" alt=""></div> -->
                              <p class="mb-0">{{ $course_material['title'] }}</p>
                            </div>
                            <!-- <span class="text-sm-12 color-light">30:25</span> -->
                          </div>
                        </span>
                        @else
                        <div class="moretext" style="display: none;">
                          <span class="list-group-item list-group-item-action ps-0 py-0" aria-current="true">
                          <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2 p-3">
                              <!-- <div class="video-bg"><img class="in-svg" src="{{asset('assets/images/play1.svg')}}" alt=""></div> -->
                              <p class="mb-0">{{ $course_material['title'] }}</p>
                            </div>
                            <!-- <span class="text-sm-12 color-light">30:25</span> -->
                          </div>
                          </span>
                        </div>
                      @endif
                      
                      @endforeach
                      @endif  
                    </div>
                    
                    @if($count>=5)
                    <div class="d-flex align-items-center justify-content-center">
                      <button class="btn btn--primary p-10-50 moreless-button">More sections</button>
                    </div>
                    @endif
                    
                  </div>
                  <div class="lm_course-buy-card card border-0 p-30">
                    <h5 class="fw-bold">Description</h5>
                    <h6 class="color-light">{!! $course['description'] !!}</h6>
                    
                    {{-- <div class="lm_course-buy-card card p-3 lm_course-coaches">
                      <h5 class="fw-bold">Coaches</h5>
                      <div class="d-flex align-items-center lm__coache gap-3 gap-sm-0 flex-wrap">
                        
                        @if(isset($course['coaches']))
                      @foreach ($course['coaches'] as $coaches)
                        
                        <div class="d-flex align-items-center gap-2 lm__coaches">
                          <div class="avtar-xxl"><img class="rounded-circle position-relative"
                              src="{{ $coaches->profile_image_url ?? asset('assets/images/member-1.jpg')}}" alt=""></div>
                          <p class="mb-0 text-dark">{{ $coaches->first_name . " " . $coaches->last_name}}</p>
                        </div>
                        
                      @endforeach
                      @endif
                                             
                      </div>
                    </div> --}}
                    
                    
                  </div>
                  
                </div>
                <div class="tab-pane fade" id="pills-coaches" role="tabpanel" aria-labelledby="pills-coaches-tab" tabindex="0">
                  
                  @php $request['user_type'] = "Coach";
                        // $request->per_page = 100;
                  @endphp
                    @foreach ($course['coaches'] as $key => $member)
                    @php
                    // $is_follow = $coaches->userCoachActivity->is_follow ?? 0;
                    $is_follow = ($member['is_follow']) ? $member['is_follow'] : 0 ;
                    @endphp
                    {{-- {{ dd($coaches->userCoachActivity->is_follow ?? 0) }} --}}
                    {{-- @php if($member->id == Auth::user()->id) continue @endphp --}}
                    
                    <div class="lm__member-card mb-3">
                      <div class="card shadow p-3 border-0">
                        <div class="d-sm-flex flex-wrap align-items-center gap-2 justify-content-between">
                          <a class="d-flex align-items-center gap-2 mb-2 mb-sm-0" onclick="ViewMemberProfile({{ $member['id'] }})">
                            <div class="avtar-xxl"><img  class="rounded-circle position-relative"
                                src="{{ $member['profile_image_url'] ?? asset('assets/images/avtar-6.jpg')}}" alt="">
                              {{-- <div class="avtar-active"></div> --}}
                            </div>
                            <div class="d-block">
                              <h6 class="mb-0 text-dark" type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasRight10" aria-controls="offcanvasRight10"> {{ $member['first_name'].' '.$member['last_name'] }}</h6>
                              {{-- <p class="title-font mb-0"></p> --}}
                            </div>
                          </a>
                           <div class="d-flex gap-3 align-items-center lm__member-btn">
                            
                            {{-- {{ dd($member) }} --}}
                            @if($is_follow==1)
                          <a class="btn btn--chat btn-follow py-1 title-font px-3 memberActivityAction memberId{{ $member['id'] }}" is-follow="{{ $is_follow }}" member-id="{{ $member['id'] }}">{{ ($is_follow==1) ? 'Following' : 'Follow'}} </a>
                          @else
                          <a class="btn btn--chat btn-follow active py-1 title-font px-3 memberActivityAction memberId{{ $member['id'] }}" is-follow="{{ $is_follow }}" member-id="{{ $member['id'] }}">{{ ($is_follow==1) ? 'Following' : 'Follow'}} </a>
                          @endif
                          
                          
                            {{-- <a class="btn btn--chat btn-follow active py-1 title-font px-3" href="#">Follow </a> --}}
                              {{-- <a class="btn btn--chat py-1 title-font px-3" href="#">Chat</a> --}}
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
        <div class="col-md-5 col-lg-12 col-xl-4 ps-xl-0 mt-3 mt-md-0 mt-xl-0">
          <div class="lm_vedio-card card">
            <div class="card-img position-relative">
              
              <img class="w-100" src="{{ $course['course_thumbnail'] ?? asset('assets/images/courses3.jpg')}}" alt="">
              <div class="card-img-overlay">
                <div class="d-flex justify-content-center align-items-center text-center h-100">
                  <a class="play-video" onclick="CoursePreviewVideo('{{ $course['course_preview_video'] }}')" data-bs-toggle="modal" data-bs-target="#course_preview_video">
                    <img class="in-svg" src="{{asset('assets/images/play-1.svg')}}" alt="">
                    <h6 class="text-white">Preview</h6>
                  </a>
                </div>
              </div>
            </div>
            <div class="card-body p-0 pt-2">
              <h4 class="mb-2"> <span class="text-dark">{{ $course['course_name'] }} </span></h4>
              @if($course['course_price_type']=="paid" && $course['course_purchase_status']==0)
                <h5 class="text-primary">${{ $course['course_price'] }} AUD</h5>
              @endif
              
              <div class="d-flex gap-2">
                @if(Auth::user()->is_admin!=1)
                  @if($course['course_price_type']=="paid" && $course['course_purchase_status']==0)
                      <a class="btn btn--primary d-block w-100 py-2" href="{{ route('course.payment.plan' , ['id' => $course['id']]) }}">Buy Course</a>
                  @else
                    @if($course['module_overviewed'] == 0)
                      <a class="btn btn--primary w-100 py-2 d-flex" href="{{ route('user.courses.intro', ['course_id' => $course['id'], 'course_modules' => '']) }}">Start Course <img class="" src="{{asset('assets/images/cplay.svg')}}" alt=""></a>
                    @else
                      <a class="btn btn--primary w-100 py-2 d-flex" href="{{ route('user.courses.intro', ['course_id' => $course['id'], 'course_modules' => '']) }}">Continue Course <img class="" src="{{asset('assets/images/cplay.svg')}}" alt=""></a>
                    @endif
                  @endif
                @endif
                
                <div class="lm__share">
                  <div class="d-flex gap-2">
                    <span data-bs-toggle="tooltip" data-bs-original-title="Share The Course">
                      <a onclick="OpenShareCourseModal('{{ route('user.courses.view', ['id' => $course['id']]) }}')" >
                        <img class="in-svg" src="{{asset('assets/images/share.svg')}}" alt="">
                      </a>
                    </span>
                    {{-- <span data-bs-toggle="tooltip" data-bs-original-title="Download PDF Brochure">
                      <a href="{{ $course['upload_pdf'] }}" download="{{ $course['upload_pdf']}}"><img class="in-svg" src="{{asset('assets/images/download.svg')}}"alt=""></a>
                    </span> --}}
                </div>
                </div>
              </div>
              <a class="btn btn--green d-block w-100 py-2 d-flex mt-3" href="{{ $course['upload_pdf'] }}" download="{{ $course['upload_pdf']}}"><img class="in-svg" src="{{asset('assets/images/download.svg')}}"alt=""> Download Brochure</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
@include('admin.course.course-modal');
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
@endsection