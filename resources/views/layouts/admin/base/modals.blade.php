<style>
.lm_profile-modal.show .lm_profile-img1 {
    margin-top: -30px !important;
}
.pq__invite_member_dropdown {
    border: 1px solid #fff;
    box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.15) !important;
    padding: 7px 15px;
    border-radius: 50px;
}
</style>
@php
    $user = Auth::user();
@endphp
{{-- {{ dd($user) }} --}}

<div class="offcanvas offcanvas-end lm_profile-modal lm_create-modal" id="your-purchases" tabindex="-1"
    aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasRightLabel">Skip</h5><button class="btn-close" type="button"
            data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
        <div class="lm_profile-modal p-2">
            <div class="row align-items-center">
                <div class="col-12 text-center">
                    <h5 class="text-white mb-0">Plans and Purchases</h5>
                </div>
            </div>
        </div>
        <div class="lm_create-body plan-body">
            {{-- <h5 class="plan_title">Free</h5> --}}
            <div class="accordion plan-accordion" id="accordionExample">
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="headingOne"><button class="accordion-button" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                            aria-controls="collapseOne"><span class="plan_title">PEEQ</span><span class="badge bg-badge  text-bg-primary fw-normal ms-2">Subscription</span></button></h2>
                    <div class="accordion-collapse collapse show" id="collapseOne" aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="d-flex justify-content-between align-items-end mb-3">
                                <div class="lm_logo"> <img class="in-svg" src="{{asset('assets/images/dash-logo.svg')}}" alt=""></div>
                                {{-- <div class="lm_acco-btn">
                                    <div class="btn btn--primary">View Plan</div>
                                </div> --}}
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="color-light mb-0">Start Date</h6>
                                <p class="text-dark mb-0 plan_start_date"></p>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                              <h6 class="color-light mb-0">End Date</h6>
                              <p class="text-dark mb-0 plan_end_date"></p>
                          </div>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="color-light mb-0">Price</h6>
                                <p class="text-dark mb-0 final_amount">Free</p>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="color-light mb-0">Status</h6>
                                <p class="lm_status mb-0">Active</p>
                            </div>
                            <div class="d-flex mt-3">
                                <div class="lm_support"><a class="btn btn--primary-outline text-dark" href="{{ asset('contact-support') }}"> Contact
                                        Support</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- @if(Auth::user()->id!=1) --}}
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingTwo"><button class="accordion-button" type="button"
                          data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true"
                          aria-controls="collapseTwo"><span>1:1 Coaching Sessions</span><span class="badge bg-badge  text-bg-primary fw-normal ms-2">Session history</span></button></h2>
                  <div class="accordion-collapse collapse" id="collapseTwo" aria-labelledby="headingTwo"
                      data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                        <div class="session_tbl table-responsive" id="appendPurchasedData">
                          @include('layouts.admin.base.purchased_session_xml')
                        </div>
                      </div>
                  </div>
              </div>
              {{-- @endif --}}
            </div>
        </div>
    </div>
</div>                  
  
{{-- Login User Profile --}}
<div class="offcanvas offcanvas-end lm_profile-modal" id="your_profile_old" tabindex="-1"
    aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header justify-content-end"><button class="btn-close text-end" type="button"
            data-bs-dismiss="offcanvas" aria-label="Close"></button></div>
    <div class="offcanvas-body p-0">
        <div class="lm_profile-modal p-2">
            <div class="row align-items-center">
                <div class="col-7 text-end">
                    <h5 class="text-white mb-0">View Profile</h5>
                </div>
                <div class="col-5 text-end">
                    <button class="btn btn--primary py-2" type="button" data-bs-toggle="offcanvas" data-id="{{ $user->id }}" data-bs-target="#offcanvasRight1" aria-controls="offcanvasRight1">Edit profile</button>
                    
                </div>
            </div>
        </div>
        <div class="lm_profile-img position-relative"><img class="object-fit-cover w-100" height="200" src="{{($user->cover_image_url) ?? asset('assets/images/profile.png') }}" alt=""></div>
        <div class="d-flex gap-2 profile-top">
            <div class="lm_profile-img1 shadow bg-white overflow-hidden "><img  class="w-100 object-fit-cover h-100 profile_image" src="{{($user->profile_image_url) ?? asset('assets/images/logo2.svg') }}" alt=""></div>
        </div>
        <div class="d-block ms-4 mt-4">
            <div class="d-block position-relative">
                <h5 class="mb-0 text-dark">{{ $user->first_name }} {{ $user->last_name }}</h5><span
                    class="position-absolute top-0 start-100 translate-middle p-1 bg-primary-50 rounded-circle mt-2 ms-3 bg-opacity-10"></span>
            </div><span class="text-sm-14 text-dark title-font">Last active 1m ago</span>
            <div class="hstack gap-3 mt-3">
                <div class="d-flex gap-2 text-secondary">
                    <p class="title-font mb-0">{{ $user->post_count ?? 0 }}</p>
                    <p class="title-font mb-0">Posts</p>
                </div>
                <div class="vr"></div>
                <div class="d-flex gap-2 text-secondary">
                    <p class="title-font mb-0">{{ $user->follower_count ?? 0 }}</p>
                    <p class="title-font mb-0">Follower</p>
                </div>
                <div class="vr"></div>
                <div class="d-flex gap-2 text-secondary">
                    <p class="title-font mb-0">{{ $user->following_count ?? 0 }}</p>
                    <p class="title-font mb-0">Following</p>
                </div>
            </div>
        </div>
        <div class="lm__profile-form">
            <div class="row g-4">
                <div class="col-12 text-start">
                  <p class="text-dark title-font fw-bold mb-2">Company Name </p>
                  <h6 class="text-secondary">{{ $user->company_name ?? '' }}</h6>
                </div>

                <div class="col-12 text-start">
                  <p class="text-dark title-font fw-bold mb-2">Job Title </p>
                  <h6 class="text-secondary">{{ $user->job_title ?? '' }}</h6>
                </div>
               
          
                <div class="col-12 text-start">
                    <p class="text-dark title-font fw-bold mb-2">About Me </p>
                    <h6 class="text-secondary">{{ $user->bio ?? '' }}</h6>
                </div>
                <div class="col-12 text-start">
                    <p class="text-dark title-font fw-bold mb-2">Location </p>
                    <h6 class="text-secondary">{{ $user->location->country_name ?? '' }} </h6>
                </div>
                <div class="col-12">
                    <div class="lm_additional text-start">
                        <p class="mb-2 title-font fw-bold">Personal Links</p>
                        <div class="d-flex align-items-center">
                            
                @php
                $personal_link_array = explode(',', $user->personal_link); 
                @endphp
                                              
                @foreach($personal_link_array as $link)
                  @if($link!='')
                    <span class="badge me-3 bg-primary-strip"><a href="{{ $link }}" target="_blank">
                      <img src="{{ getSocialIcon($link) }}" alt="{{ $link }}">
                    </a></span>
                  @endif
                @endforeach 
                  
                            {{-- <button class="btn lm_additional-btn shadow"><img class="in-svg" src="assets/images/plus-3.svg" alt=""></button> --}}
                        </div>
                    </div>
                </div>
                {{-- <div class="col-12">
                    <div class="lm_additional text-start">
                        <p class="mb-2 title-font fw-bold">General</p>
                        <div class="d-flex align-items-center"><button class="btn lm_additional-btn shadow"><img
                                    class="in-svg" src="assets/images/plus-3.svg" alt=""></button></div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="lm_additional text-start">
                        <p class="mb-2 title-font fw-bold">Courses</p>
                        <div class="d-flex align-items-center"><span
                                class="badge text-bg-dark me-3 bg-primary-strip">PEEQ</span></div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="lm_additional text-start">
                        <p class="mb-2 title-font fw-bold">Find Resources</p>
                        <div class="d-flex align-items-center"><button class="btn lm_additional-btn shadow"><img
                                    class="in-svg" src="assets/images/plus-3.svg" alt=""></button></div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>

{{-- Member Profile --}}
<div class="offcanvas offcanvas-end lm_profile-modal" id="your_profile" tabindex="-1"
    aria-labelledby="offcanvasRightLabel" data="{{ asset('assets/images') }}">
    <div class="offcanvas-header justify-content-end"><button class="btn-close text-end" type="button"
            data-bs-dismiss="offcanvas" aria-label="Close"></button></div>
    <div class="offcanvas-body p-0">
        {{-- <div class="lm_profile-modal p-2">
            <div class="row align-items-center">
                <div class="col-7 text-end">
                    <h5 class="text-white mb-0">Profile</h5>
                </div>
                
            </div>
        </div> --}}
        
        
        <div class="lm_profile-modal p-2">
          <div class="row align-items-center">
              <div class="col-7 text-end">
                  <h5 class="text-white mb-0">View Profile</h5>
              </div>
              <div class="col-5 text-end edit_profile">
                  <button class="btn btn--primary py-2" type="button" data-bs-toggle="offcanvas" data-id="{{ $user->id }}" data-bs-target="#offcanvasRight1" aria-controls="offcanvasRight1">Edit profile</button>
                  
              </div>
          </div>
        </div>
      
      
        <div class="lm_profile-img position-relative"><img class="object-fit-cover w-100 cover_image_url" height="200" src="" alt=""></div>
        <div class="d-flex gap-2 profile-top">
            <div class="lm_profile-img1 shadow bg-white overflow-hidden "><img  class="w-100 object-fit-cover h-100 profile_image profile_image_url" src="" alt=""></div>
        </div>
        <div class="d-block ms-4 mt-4">
            <div class="d-block position-relative">
                <h5 class="mb-0 text-dark member_name"></h5><span
                    class="position-absolute top-0 start-100 translate-middle p-1 bg-primary-50 rounded-circle mt-2 ms-3 bg-opacity-10"></span>
            </div><span class="text-sm-14 text-dark title-font last_seen">Last active 1m ago</span>
            <div class="hstack gap-3 mt-3">
                <div class="d-flex gap-2 text-secondary">
                    <p class="title-font mb-0 post_count"></p>
                    <p class="title-font mb-0">Posts</p>
                </div>
                <div class="vr"></div>
                <div class="d-flex gap-2 text-secondary">
                    <p class="title-font mb-0 follower_count"></p>
                    {{-- <p class="title-font mb-0"><a href="{{ route('follower.list') }}" >Followers</a></p> --}}
                </div>
                <div class="vr"></div>
                <div class="d-flex gap-2 text-secondary">
                    <p class="title-font mb-0 following_count"></p>
                    {{-- <p class="title-font mb-0"><a href="{{ route('following.list') }}" >Following</a></p> --}}
                </div>
            </div>
        </div>
        <div class="lm__profile-form">
            <div class="row g-4">
              <div class="col-12 text-start">
                <p class="text-dark title-font fw-bold mb-2">Company Name </p>
                <h6 class="text-secondary company_name"></h6>
              </div>
                
              <div class="col-12 text-start">
                <p class="text-dark title-font fw-bold mb-2">Job Title </p>
                <h6 class="text-secondary job_title"></h6>
              </div>
          
              <div class="col-12 text-start">
                    <p class="text-dark title-font fw-bold mb-2">About Me </p>
                    <h6 class="text-secondary bio"></h6>
                </div>
                <div class="col-12 text-start">
                    <p class="text-dark title-font fw-bold mb-2">Location </p>
                    <h6 class="text-secondary country_name"></h6>
                </div>
                <div class="col-12">
                    <div class="lm_additional text-start">
                        <p class="mb-2 title-font fw-bold">Personal Links</p>
                        <div class="d-flex align-items-center personal_links">
                            
                @php
                $personal_link_array = explode(',', $user->personal_link); 
                @endphp
                                              
                @foreach($personal_link_array as $link)
                  @if($link!='')
                    <span class="badge me-3 bg-primary-strip"><a href="{{ $link }}" target="_blank">
                      <img src="{{ getSocialIcon($link) }}" alt="{{ $link }}">
                    </a></span>
                  @endif
                @endforeach 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="offcanvas offcanvas-end lm_profile-modal lm_create-modal" id="inviteMemberModal" tabindex="-1"
    aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasRightLabel">Skip</h5><button class="btn-close" type="button"
            data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
        <div class="lm_profile-modal p-2">
            <div class="row align-items-center">
                <div class="col-12 text-center">
                    <h5 class="text-white mb-0">Invite</h5>
                </div>
            </div>
        </div>
        <div class="lm_create-body invite-body">
            <div class="d-flex justify-content-center">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation"><button class="nav-link active" id="pills-invite-tab"
                            data-bs-toggle="pill" data-bs-target="#pills-invite" type="button" role="tab"
                            aria-controls="pills-invite" aria-selected="true">Invites</button></li>
                    <li class="nav-item" role="presentation"><button onclick="getInviteMembers()" class="nav-link" id="pills-sent-invites-tab"
                            data-bs-toggle="pill" data-bs-target="#pills-sent-invites" type="button" role="tab"
                            aria-controls="pills-sent-invites" aria-selected="false">Sent Invitations</button></li>
                </ul>
            </div>
            <div class="d-block">
              <form action="#" id="SendInviteForm" name="SendInviteForm">
                <div class="tab-content invite-member" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-invite" role="tabpanel"
                        aria-labelledby="pills-invite-tab" tabindex="0">
                        <h5 class="text-center fw-bold">Invite Members</h5>
                        <div class="input-group mb-3 invite-input rounded-5 shadow">
                          <input class="form-control" type="text" placeholder="{{ url('') }}" value="{{ url('') }}"  aria-label="Recipient's username" aria-describedby="button-addon2">

                          <a  class="btn btn--dark py-1 rounded-5"  onclick="copy_web_url()" >Copy Link</a>
                        </div>
                                {{-- data-bs-toggle="modal" data-bs-target="#exampleModal21" --}}
                                
                        <h5 class="text-center fw-bold">Invite by Email</h5>
                        <div class="mb-3">
                            <input name="invite_emails" class="form-control shadow" type="text" placeholder="Add multiple emails here separated by comma.">
                            
                            <span class="help-block print-error-msg" style="color: red;">
                                <ul>
                                    <li></li>
                                </ul>
                            </span>
                            
                        </div>
                        <div class="bg-white shadow lm_msg mb-3">
                            <div class="d-flex gap-3">
                                <div class="avtar-30"><img src="{{($user->profile_image_url) ?? asset('assets/images/logo2.svg') }}" alt=""></div>
                                <div class="d-block">
                                    
                                <textarea rows="8" cols="100" name="invite_message" placeholder="Additional messages here if Any...."></textarea>

                                    {{-- <p class="mb-3 text-dark">Hi!</p>
                                    <p class="mb-3 text-dark">I'm a member of PEEQ, and I think you should
                                        be too. Come join me!</p>
                                    <p class="mb-0 text-dark">See you there,<br>Custom Coder</p> --}}
                                </div>
                            </div>
                        </div>
                        {{-- <div class="d-block">
                            <p class="text-sm-12 mb-0 fw-bold">NETWORK PERMISSIONS</p>
                            <p class="mb-0 color-light">Choose what permissions these members will have in Peeq.</p>
                        </div> --}}
                        <div class="d-flex mt-3 justify-content-between">
                            <div class="lm_post-input-emoji mb-2 me-3">
                                {{-- js-example-basic-single" id="select_box1"> --}}
                                
                                
                                @if($user->is_admin == 1)
                                <select class="form-select form-control js-example-basic-single pq__invite_member_dropdown" id="select_box1" name="user_type">
                                  <option value="host">Invite as host</option>
                                    <option value="coach">Invite as Coach</option>
                                    <option value="member" selected>Invite as Member</option>
                                </select>
                                @else
                                <div class="pq__invite_member_dropdown">
                                Invite as Member
                                </div>
                                <input type="hidden" value="member" name="user_type" class="form-control">
                                @endif
                            </div>
                            <div class="lm_send"> <button class="btn btn--primary" id="send_invite">Send Invitation</button></div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-sent-invites" role="tabpanel"
                        aria-labelledby="pills-sent-invites-tab" tabindex="0">
                        <p class="text-dark mb-3">Here's a list of the people that have been invited to join PEEQ.</p>
                        <div class="lm_sent-invite-tbl">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Invited By</th>
                                        <th scope="col">Last Updated</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody id="invite-members-list">

                                </tbody>
                                
                                @include('layouts.admin.base.loader')
                                
                            </table>
                        </div>
                    </div>
                </div>
              </form>
            </div>
        </div>
    </div>
</div>
<div class="offcanvas offcanvas-end lm_profile-modal lm_create-modal" id="offcanvasRight13" tabindex="-1"
  aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasRightLabel">Skip</h5>
    <button class="btn-close" type="button"
      data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body p-0">
    <div class="lm_profile-modal p-2">
      <div class="row align-items-center">
        <div class="col-12 text-center">
          <h5 class="text-white mb-0">Media Library</h5>
        </div>
      </div>
    </div>
    <div class="lm_create-body gallary-body">
      <form action="">
        <div class="input-group mb-3">
          <label class="input-group-text lm__upload-file" for="inputGroupFile01">
            <div class="d-block">
              <span class="d-block upd-title">Upload</span>
              <div class="d-block"><span class="d-flex justify-content-center"> <img class="in-svg"
                src="assets/images/file.svg" alt=""></span></div>
              <h6 class="d-block">Drag & Drop Media here</h6>
            </div>
          </label>
          <input class="form-control" id="inputGroupFile01" type="file">
        </div>
        <div class="lm__course-tab lm__upd-tab">
          <div class="d-flex justify-content-between flex-wrap mb-3">
            <ul class="nav nav-pills mb-3 shadow" id="pills-tab" role="tablist">
              <li class="nav-item" role="presentation"><button class="nav-link active" id="pills-gallery-tab"
                data-bs-toggle="pill" data-bs-target="#pills-gallery" type="button" role="tab"
                aria-controls="pills-gallery" aria-selected="true">Gallery</button></li>
              <li class="nav-item" role="presentation"><button class="nav-link" id="pills-images-tab"
                data-bs-toggle="pill" data-bs-target="#pills-images" type="button" role="tab"
                aria-controls="pills-images" aria-selected="false">Images</button></li>
              <li class="nav-item" role="presentation"><button class="nav-link" id="pills-videos-tab"
                data-bs-toggle="pill" data-bs-target="#pills-videos" type="button" role="tab"
                aria-controls="pills-videos" aria-selected="false">Videos</button></li>
            </ul>
            <div class="lm__insdtl">
              <div class="d-flex gap-2"><button class="btn btn--primary py-2">Insert </button><button
                class="btn btn--danger py-2">Delete</button></div>
            </div>
          </div>
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-gallery" role="tabpanel"
              aria-labelledby="pills-gallery-tab" tabindex="0">
              <div class="d-flex gap-2 flex-wrap">
                <div class="card lm-img-box">
                  <img class="card-img" src="{{asset('assets/images/g6.jpg')}}" alt="">
                  <div class="card-img-overlay">
                    <a class="glyphicon glyphicon-question-sign append text-info tip"
                      data-tip="tip1"><span class="icon-hov"> <img class="in-svg" src="{{asset('assets/images/info3.svg')}}"
                      alt=""></span></a>
                    <div class="tip-content hidden" id="tip1">
                      <div class="d-flex gap-2 title-font"><span class="text-dark"> File Name</span><span
                        class="color-light"> filename.jpeg</span></div>
                      <hr class="my-1">
                      <div class="d-flex gap-2 title-font"><span class="text-dark">File Size</span><span
                        class="color-light">21.56kb</span></div>
                    </div>
                  </div>
                </div>
                <div class="card lm-img-box">
                  <img class="card-img" src="{{asset('assets/images/g8.jpg')}}" alt="">
                  <div class="card-img-overlay">
                    <a class="glyphicon glyphicon-question-sign append text-info tip"
                      data-tip="tip2"><span class="icon-hov"> <img class="in-svg" src="{{asset('assets/images/info3.svg')}}"
                      alt=""></span></a>
                    <div class="tip-content hidden" id="tip2">
                      <div class="d-flex gap-2 title-font"><span class="text-dark"> File Name</span><span
                        class="color-light"> filename.jpeg</span></div>
                      <hr class="my-1">
                      <div class="d-flex gap-2 title-font"><span class="text-dark">File Size</span><span
                        class="color-light">21.56kb</span></div>
                    </div>
                  </div>
                </div>
                <div class="card lm-img-box">
                  <img class="card-img" src="{{asset('assets/images/g7.jpg')}}" alt="">
                  <div class="card-img-overlay">
                    <a class="glyphicon glyphicon-question-sign append text-info tip"
                      data-tip="tip3"><span class="icon-hov"> <img class="in-svg" src="{{asset('assets/images/info3.svg')}}"
                      alt=""></span></a>
                    <div class="tip-content hidden" id="tip3">
                      <div class="d-flex gap-2 title-font"><span class="text-dark"> File Name</span><span
                        class="color-light"> filename.jpeg</span></div>
                      <hr class="my-1">
                      <div class="d-flex gap-2 title-font"><span class="text-dark">File Size</span><span
                        class="color-light">21.56kb</span></div>
                    </div>
                  </div>
                </div>
                <div class="card lm-img-box">
                  <img class="card-img" src="{{asset('assets/images/g9.jpg')}}" alt="">
                  <div class="card-img-overlay">
                    <a class="glyphicon glyphicon-question-sign append text-info tip"
                      data-tip="tip4"><span class="icon-hov"> <img class="in-svg" src="{{asset('assets/images/info3.svg')}}"
                      alt=""></span></a>
                    <div class="tip-content hidden" id="tip4">
                      <div class="d-flex gap-2 title-font"><span class="text-dark"> File Name</span><span
                        class="color-light"> filename.jpeg</span></div>
                      <hr class="my-1">
                      <div class="d-flex gap-2 title-font"><span class="text-dark">File Size</span><span
                        class="color-light">21.56kb</span></div>
                    </div>
                  </div>
                </div>
                <div class="card lm-img-box">
                  <img class="card-img" src="{{asset('assets/images/g10.jpg')}}" alt="">
                  <div class="card-img-overlay">
                    <span class="play"><img class="in-svg" src="{{asset('assets/images/play-1.svg')}}"
                      alt=""></span><a class="glyphicon glyphicon-question-sign append text-info tip"
                      data-tip="tip5"><span class="icon-hov"> <img class="in-svg" src="{{asset('assets/images/info3.svg')}}"
                      alt=""></span></a>
                    <div class="tip-content hidden" id="tip5">
                      <div class="d-flex gap-2 title-font"><span class="text-dark"> File Name</span><span
                        class="color-light"> filename.jpeg</span></div>
                      <hr class="my-1">
                      <div class="d-flex gap-2 title-font"><span class="text-dark">File Size</span><span
                        class="color-light">21.56kb</span></div>
                    </div>
                  </div>
                </div>
                <div class="card lm-img-box">
                  <img class="card-img" src="{{asset('assets/images/g1.jpg')}}" alt="">
                  <div class="card-img-overlay">
                    <a class="glyphicon glyphicon-question-sign append text-info tip"
                      data-tip="tip6"><span class="icon-hov"> <img class="in-svg" src="{{asset('assets/images/info3.svg')}}"
                      alt=""></span></a>
                    <div class="tip-content hidden" id="tip6">
                      <div class="d-flex gap-2 title-font"><span class="text-dark"> File Name</span><span
                        class="color-light"> filename.jpeg</span></div>
                      <hr class="my-1">
                      <div class="d-flex gap-2 title-font"><span class="text-dark">File Size</span><span
                        class="color-light">21.56kb</span></div>
                    </div>
                  </div>
                </div>
                <div class="card lm-img-box">
                  <img class="card-img" src="{{asset('assets/images/g2.jpg')}}" alt="">
                  <div class="card-img-overlay">
                    <a class="glyphicon glyphicon-question-sign append text-info tip"
                      data-tip="tip7"><span class="icon-hov"> <img class="in-svg" src="{{asset('assets/images/info3.svg')}}"
                      alt=""></span></a>
                    <div class="tip-content hidden" id="tip7">
                      <div class="d-flex gap-2 title-font"><span class="text-dark"> File Name</span><span
                        class="color-light"> filename.jpeg</span></div>
                      <hr class="my-1">
                      <div class="d-flex gap-2 title-font"><span class="text-dark">File Size</span><span
                        class="color-light">21.56kb</span></div>
                    </div>
                  </div>
                </div>
                <div class="card lm-img-box">
                  <img class="card-img" src="{{asset('assets/images/g4.jpg')}}" alt="">
                  <div class="card-img-overlay">
                    <a class="glyphicon glyphicon-question-sign append text-info tip"
                      data-tip="tip8"><span class="icon-hov"> <img class="in-svg" src="{{asset('assets/images/info3.svg')}}"
                      alt=""></span></a>
                    <div class="tip-content hidden" id="tip8">
                      <div class="d-flex gap-2 title-font"><span class="text-dark"> File Name</span><span
                        class="color-light"> filename.jpeg</span></div>
                      <hr class="my-1">
                      <div class="d-flex gap-2 title-font"><span class="text-dark">File Size</span><span
                        class="color-light">21.56kb</span></div>
                    </div>
                  </div>
                </div>
                <div class="card lm-img-box">
                  <img class="card-img" src="{{asset('assets/images/g3.jpg')}}" alt="">
                  <div class="card-img-overlay">
                    <span class="play"><img class="in-svg" src="{{asset('assets/images/play-1.svg')}}"
                      alt=""></span><a class="glyphicon glyphicon-question-sign append text-info tip"
                      data-tip="tip9"><span class="icon-hov"> <img class="in-svg" src="{{asset('assets/images/info3.svg')}}"
                      alt=""></span></a>
                    <div class="tip-content hidden" id="tip9">
                      <div class="d-flex gap-2 title-font"><span class="text-dark"> File Name</span><span
                        class="color-light"> filename.jpeg</span></div>
                      <hr class="my-1">
                      <div class="d-flex gap-2 title-font"><span class="text-dark">File Size</span><span
                        class="color-light">21.56kb</span></div>
                    </div>
                  </div>
                </div>
                <div class="card lm-img-box">
                  <img class="card-img" src="{{asset('assets/images/g5.jpg')}}" alt="">
                  <div class="card-img-overlay">
                    <a class="glyphicon glyphicon-question-sign append text-info tip"
                      data-tip="tip10"><span class="icon-hov"> <img class="in-svg" src="{{asset('assets/images/info3.svg')}}"
                      alt=""></span></a>
                    <div class="tip-content hidden" id="tip10">
                      <div class="d-flex gap-2 title-font"><span class="text-dark"> File Name</span><span
                        class="color-light"> filename.jpeg</span></div>
                      <hr class="my-1">
                      <div class="d-flex gap-2 title-font"><span class="text-dark">File Size</span><span
                        class="color-light">21.56kb</span></div>
                    </div>
                  </div>
                </div>
                <div class="card lm-img-box">
                  <img class="card-img" src="{{asset('assets/images/g11.jpg')}}" alt="">
                  <div class="card-img-overlay">
                    <a class="glyphicon glyphicon-question-sign append text-info tip"
                      data-tip="tip11"><span class="icon-hov"> <img class="in-svg" src="{{asset('assets/images/info3.svg')}}"
                      alt=""></span></a>
                    <div class="tip-content hidden" id="tip11">
                      <div class="d-flex gap-2 title-font"><span class="text-dark"> File Name</span><span
                        class="color-light"> filename.jpeg</span></div>
                      <hr class="my-1">
                      <div class="d-flex gap-2 title-font"><span class="text-dark">File Size</span><span
                        class="color-light">21.56kb</span></div>
                    </div>
                  </div>
                </div>
                <div class="card lm-img-box">
                  <img class="card-img" src="{{asset('assets/images/g10.jpg')}}" alt="">
                  <div class="card-img-overlay">
                    <span class="play"><img class="in-svg" src="{{asset('assets/images/play-1.svg')}}"
                      alt=""></span><a class="glyphicon glyphicon-question-sign append text-info tip"
                      data-tip="tip12"><span class="icon-hov"> <img class="in-svg" src="{{asset('assets/images/info3.svg')}}"
                      alt=""></span></a>
                    <div class="tip-content hidden" id="tip12">
                      <div class="d-flex gap-2 title-font"><span class="text-dark"> File Name</span><span
                        class="color-light"> filename.jpeg</span></div>
                      <hr class="my-1">
                      <div class="d-flex gap-2 title-font"><span class="text-dark">File Size</span><span
                        class="color-light">21.56kb</span></div>
                    </div>
                  </div>
                </div>
                <div class="card lm-img-box">
                  <img class="card-img" src="{{asset('assets/images/g13.jpg')}}" alt="">
                  <div class="card-img-overlay">
                    <a class="glyphicon glyphicon-question-sign append text-info tip"
                      data-tip="tip13"><span class="icon-hov"> <img class="in-svg" src="{{asset('assets/images/info3.svg')}}"
                      alt=""></span></a>
                    <div class="tip-content hidden" id="tip13">
                      <div class="d-flex gap-2 title-font"><span class="text-dark"> File Name</span><span
                        class="color-light"> filename.jpeg</span></div>
                      <hr class="my-1">
                      <div class="d-flex gap-2 title-font"><span class="text-dark">File Size</span><span
                        class="color-light">21.56kb</span></div>
                    </div>
                  </div>
                </div>
                <div class="card lm-img-box">
                  <img class="card-img" src="{{asset('assets/images/g12.jpg')}}" alt="">
                  <div class="card-img-overlay">
                    <a class="glyphicon glyphicon-question-sign append text-info tip"
                      data-tip="tip14"><span class="icon-hov"> <img class="in-svg" src="{{asset('assets/images/info3.svg')}}"
                      alt=""></span></a>
                    <div class="tip-content hidden" id="tip14">
                      <div class="d-flex gap-2 title-font"><span class="text-dark"> File Name</span><span
                        class="color-light"> filename.jpeg</span></div>
                      <hr class="my-1">
                      <div class="d-flex gap-2 title-font"><span class="text-dark">File Size</span><span
                        class="color-light">21.56kb</span></div>
                    </div>
                  </div>
                </div>
                <div class="card lm-img-box">
                  <img class="card-img" src="{{asset('assets/images/g14.jpg')}}" alt="">
                  <div class="card-img-overlay">
                    <a class="glyphicon glyphicon-question-sign append text-info tip"
                      data-tip="tip15"><span class="icon-hov"> <img class="in-svg" src="{{asset('assets/images/info3.svg')}}"
                      alt=""></span></a>
                    <div class="tip-content hidden" id="tip15">
                      <div class="d-flex gap-2 title-font"><span class="text-dark"> File Name</span><span
                        class="color-light"> filename.jpeg</span></div>
                      <hr class="my-1">
                      <div class="d-flex gap-2 title-font"><span class="text-dark">File Size</span><span
                        class="color-light">21.56kb</span></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="pills-images" role="tabpanel" aria-labelledby="pills-images-tab"
              tabindex="0">
              <div class="d-flex gap-2 flex-wrap">
                <div class="card lm-img-box">
                  <img class="card-img" src="{{asset('assets/images/g6.jpg')}}" alt="">
                  <div class="card-img-overlay">
                    <a class="glyphicon glyphicon-question-sign append text-info tip"
                      data-tip="tip1"><span class="icon-hov"> <img class="in-svg" src="{{asset('assets/images/info3.svg')}}"
                      alt=""></span></a>
                    <div class="tip-content hidden" id="tip1">
                      <div class="d-flex gap-2 title-font"><span class="text-dark"> File Name</span><span
                        class="color-light"> filename.jpeg</span></div>
                      <hr class="my-1">
                      <div class="d-flex gap-2 title-font"><span class="text-dark">File Size</span><span
                        class="color-light">21.56kb</span></div>
                    </div>
                  </div>
                </div>
                <div class="card lm-img-box">
                  <img class="card-img" src="{{asset('assets/images/g8.jpg')}}" alt="">
                  <div class="card-img-overlay">
                    <a class="glyphicon glyphicon-question-sign append text-info tip"
                      data-tip="tip2"><span class="icon-hov"> <img class="in-svg" src="{{asset('assets/images/info3.svg')}}"
                      alt=""></span></a>
                    <div class="tip-content hidden" id="tip2">
                      <div class="d-flex gap-2 title-font"><span class="text-dark"> File Name</span><span
                        class="color-light"> filename.jpeg</span></div>
                      <hr class="my-1">
                      <div class="d-flex gap-2 title-font"><span class="text-dark">File Size</span><span
                        class="color-light">21.56kb</span></div>
                    </div>
                  </div>
                </div>
                <div class="card lm-img-box">
                  <img class="card-img" src="{{asset('assets/images/g7.jpg')}}" alt="">
                  <div class="card-img-overlay">
                    <a class="glyphicon glyphicon-question-sign append text-info tip"
                      data-tip="tip3"><span class="icon-hov"> <img class="in-svg" src="{{asset('assets/images/info3.svg')}}"
                      alt=""></span></a>
                    <div class="tip-content hidden" id="tip3">
                      <div class="d-flex gap-2 title-font"><span class="text-dark"> File Name</span><span
                        class="color-light"> filename.jpeg</span></div>
                      <hr class="my-1">
                      <div class="d-flex gap-2 title-font"><span class="text-dark">File Size</span><span
                        class="color-light">21.56kb</span></div>
                    </div>
                  </div>
                </div>
                <div class="card lm-img-box">
                  <img class="card-img" src="{{asset('assets/images/g9.jpg')}}" alt="">
                  <div class="card-img-overlay">
                    <a class="glyphicon glyphicon-question-sign append text-info tip"
                      data-tip="tip4"><span class="icon-hov"> <img class="in-svg" src="{{asset('assets/images/info3.svg')}}"
                      alt=""></span></a>
                    <div class="tip-content hidden" id="tip4">
                      <div class="d-flex gap-2 title-font"><span class="text-dark"> File Name</span><span
                        class="color-light"> filename.jpeg</span></div>
                      <hr class="my-1">
                      <div class="d-flex gap-2 title-font"><span class="text-dark">File Size</span><span
                        class="color-light">21.56kb</span></div>
                    </div>
                  </div>
                </div>
                <div class="card lm-img-box">
                  <img class="card-img" src="{{asset('assets/images/g1.jpg')}}" alt="">
                  <div class="card-img-overlay">
                    <a class="glyphicon glyphicon-question-sign append text-info tip"
                      data-tip="tip6"><span class="icon-hov"> <img class="in-svg" src="{{asset('assets/images/info3.svg')}}"
                      alt=""></span></a>
                    <div class="tip-content hidden" id="tip6">
                      <div class="d-flex gap-2 title-font"><span class="text-dark"> File Name</span><span
                        class="color-light"> filename.jpeg</span></div>
                      <hr class="my-1">
                      <div class="d-flex gap-2 title-font"><span class="text-dark">File Size</span><span
                        class="color-light">21.56kb</span></div>
                    </div>
                  </div>
                </div>
                <div class="card lm-img-box">
                  <img class="card-img" src="{{asset('assets/images/g2.jpg')}}" alt="">
                  <div class="card-img-overlay">
                    <a class="glyphicon glyphicon-question-sign append text-info tip"
                      data-tip="tip7"><span class="icon-hov"> <img class="in-svg" src="{{asset('assets/images/info3.svg')}}"
                      alt=""></span></a>
                    <div class="tip-content hidden" id="tip7">
                      <div class="d-flex gap-2 title-font"><span class="text-dark"> File Name</span><span
                        class="color-light"> filename.jpeg</span></div>
                      <hr class="my-1">
                      <div class="d-flex gap-2 title-font"><span class="text-dark">File Size</span><span
                        class="color-light">21.56kb</span></div>
                    </div>
                  </div>
                </div>
                <div class="card lm-img-box">
                  <img class="card-img" src="{{asset('assets/images/g4.jpg')}}" alt="">
                  <div class="card-img-overlay">
                    <a class="glyphicon glyphicon-question-sign append text-info tip"
                      data-tip="tip8"><span class="icon-hov"> <img class="in-svg" src="{{asset('assets/images/info3.svg')}}"
                      alt=""></span></a>
                    <div class="tip-content hidden" id="tip8">
                      <div class="d-flex gap-2 title-font"><span class="text-dark"> File Name</span><span
                        class="color-light"> filename.jpeg</span></div>
                      <hr class="my-1">
                      <div class="d-flex gap-2 title-font"><span class="text-dark">File Size</span><span
                        class="color-light">21.56kb</span></div>
                    </div>
                  </div>
                </div>
                <div class="card lm-img-box">
                  <img class="card-img" src="{{asset('assets/images/g5.jpg')}}" alt="">
                  <div class="card-img-overlay">
                    <a class="glyphicon glyphicon-question-sign append text-info tip"
                      data-tip="tip10"><span class="icon-hov"> <img class="in-svg" src="{{asset('assets/images/info3.svg')}}"
                      alt=""></span></a>
                    <div class="tip-content hidden" id="tip10">
                      <div class="d-flex gap-2 title-font"><span class="text-dark"> File Name</span><span
                        class="color-light"> filename.jpeg</span></div>
                      <hr class="my-1">
                      <div class="d-flex gap-2 title-font"><span class="text-dark">File Size</span><span
                        class="color-light">21.56kb</span></div>
                    </div>
                  </div>
                </div>
                <div class="card lm-img-box">
                  <img class="card-img" src="{{asset('assets/images/g11.jpg')}}" alt="">
                  <div class="card-img-overlay">
                    <a class="glyphicon glyphicon-question-sign append text-info tip"
                      data-tip="tip11"><span class="icon-hov"> <img class="in-svg" src="{{asset('assets/images/info3.svg')}}"
                      alt=""></span></a>
                    <div class="tip-content hidden" id="tip11">
                      <div class="d-flex gap-2 title-font"><span class="text-dark"> File Name</span><span
                        class="color-light"> filename.jpeg</span></div>
                      <hr class="my-1">
                      <div class="d-flex gap-2 title-font"><span class="text-dark">File Size</span><span
                        class="color-light">21.56kb</span></div>
                    </div>
                  </div>
                </div>
                <div class="card lm-img-box">
                  <img class="card-img" src="{{asset('assets/images/g13.jpg')}}" alt="">
                  <div class="card-img-overlay">
                    <a class="glyphicon glyphicon-question-sign append text-info tip"
                      data-tip="tip13"><span class="icon-hov"> <img class="in-svg" src="{{asset('assets/images/info3.svg')}}"
                      alt=""></span></a>
                    <div class="tip-content hidden" id="tip13">
                      <div class="d-flex gap-2 title-font"><span class="text-dark"> File Name</span><span
                        class="color-light"> filename.jpeg</span></div>
                      <hr class="my-1">
                      <div class="d-flex gap-2 title-font"><span class="text-dark">File Size</span><span
                        class="color-light">21.56kb</span></div>
                    </div>
                  </div>
                </div>
                <div class="card lm-img-box">
                  <img class="card-img" src="{{asset('assets/images/g12.jpg')}}" alt="">
                  <div class="card-img-overlay">
                    <a class="glyphicon glyphicon-question-sign append text-info tip"
                      data-tip="tip14"><span class="icon-hov"> <img class="in-svg" src="{{asset('assets/images/info3.svg')}}"
                      alt=""></span></a>
                    <div class="tip-content hidden" id="tip14">
                      <div class="d-flex gap-2 title-font"><span class="text-dark"> File Name</span><span
                        class="color-light"> filename.jpeg</span></div>
                      <hr class="my-1">
                      <div class="d-flex gap-2 title-font"><span class="text-dark">File Size</span><span
                        class="color-light">21.56kb</span></div>
                    </div>
                  </div>
                </div>
                <div class="card lm-img-box">
                  <img class="card-img" src="{{asset('assets/images/g14.jpg')}}" alt="">
                  <div class="card-img-overlay">
                    <a class="glyphicon glyphicon-question-sign append text-info tip"
                      data-tip="tip15"><span class="icon-hov"> <img class="in-svg" src="{{asset('assets/images/info3.svg')}}"
                      alt=""></span></a>
                    <div class="tip-content hidden" id="tip15">
                      <div class="d-flex gap-2 title-font"><span class="text-dark"> File Name</span><span
                        class="color-light"> filename.jpeg</span></div>
                      <hr class="my-1">
                      <div class="d-flex gap-2 title-font"><span class="text-dark">File Size</span><span
                        class="color-light">21.56kb</span></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="pills-videos" role="tabpanel" aria-labelledby="pills-videos-tab"
              tabindex="0">
              <div class="d-flex gap-2 flex-wrap">
                <div class="card lm-img-box">
                  <img class="card-img" src="{{asset('assets/images/g3.jpg')}}" alt="">
                  <div class="card-img-overlay">
                    <span class="play"><img class="in-svg" src="{{asset('assets/images/play-1.svg')}}"
                      alt=""></span><a class="glyphicon glyphicon-question-sign append text-info tip"
                      data-tip="tip9"><span class="icon-hov"> <img class="in-svg" src="{{asset('assets/images/info3.svg')}}"
                      alt=""></span></a>
                    <div class="tip-content hidden" id="tip9">
                      <div class="d-flex gap-2 title-font"><span class="text-dark"> File Name</span><span
                        class="color-light"> filename.jpeg</span></div>
                      <hr class="my-1">
                      <div class="d-flex gap-2 title-font"><span class="text-dark">File Size</span><span
                        class="color-light">21.56kb</span></div>
                    </div>
                  </div>
                </div>
                <div class="card lm-img-box">
                  <img class="card-img" src="{{asset('assets/images/g10.jpg')}}" alt="">
                  <div class="card-img-overlay">
                    <span class="play"><img class="in-svg" src="{{asset('assets/images/play-1.svg')}}"
                      alt=""></span><a class="glyphicon glyphicon-question-sign append text-info tip"
                      data-tip="tip5"><span class="icon-hov"> <img class="in-svg" src="{{asset('assets/images/info3.svg')}}"
                      alt=""></span></a>
                    <div class="tip-content hidden" id="tip5">
                      <div class="d-flex gap-2 title-font"><span class="text-dark"> File Name</span><span
                        class="color-light"> filename.jpeg</span></div>
                      <hr class="my-1">
                      <div class="d-flex gap-2 title-font"><span class="text-dark">File Size</span><span
                        class="color-light">21.56kb</span></div>
                    </div>
                  </div>
                </div>
                <div class="card lm-img-box">
                  <img class="card-img" src="{{asset('assets/images/g10.jpg')}}" alt="">
                  <div class="card-img-overlay">
                    <span class="play"><img class="in-svg" src="{{asset('assets/images/play-1.svg')}}"
                      alt=""></span><a class="glyphicon glyphicon-question-sign append text-info tip"
                      data-tip="tip12"><span class="icon-hov"> <img class="in-svg" src="{{asset('assets/images/info3.svg')}}"
                      alt=""></span></a>
                    <div class="tip-content hidden" id="tip12">
                      <div class="d-flex gap-2 title-font"><span class="text-dark"> File Name</span><span
                        class="color-light"> filename.jpeg</span></div>
                      <hr class="my-1">
                      <div class="d-flex gap-2 title-font"><span class="text-dark">File Size</span><span
                        class="color-light">21.56kb</span></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Course payment -->
<div class="modal fade" id="coursebuy" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered lm__modal-4">
        <div class="modal-content overflow-hidden">
            <div class="modal-body p-4 text-center position-relative">
                <div class="lm__login--box text-start">
                    <div class="lm__login-title d-flex justify-content-center align-items-center">
                        <h2 class="title-font text-white">Payment</h2>
                    </div>
                    <div class="lm__card card py-4 px-3 mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <h6 class="text-white fw-bold">What you’ll pay</h6>
                        </div>
                        <div class="d-flex justify-content-between text-start">
                            <p class="mb-0 text-white">Self Mastery Program</p>
                            <div class="lm_price d-flex gap-2">
                                <h6 class="text-primary mb-0 fw-bold">$1499.99</h6>
                                <p class="mb-0 text-light text-sm-12">AUD</p>
                            </div>
                        </div>
                        <!-- <p class="mb-1 text-light">Monthly subscription starting<br>Sat, Feb 4, 2023</p> -->
                        <hr class="my-3">
                        <div class="d-flex justify-content-between text-start">
                            <p class="mb-2 text-white fw-bold">Due Total</p>
                            <div class="lm_price d-flex gap-2">
                                <h6 class="text-primary mb-0 fw-bold">$1499.99</h6>
                                <p class="mb-0 text-light text-sm-12">AUD</p>
                            </div>
                        </div>
                        <!-- <div class="d-flex justify-content-between text-start">
                            <p class="text-sm mb-0 text-light">Due Later</p>
                            <div class="lm_price">
                                <p class="mb-0 text-light">$499.99 AUD</p>
                            </div>
                        </div> -->
                    </div>
                    <div class="lm__login-form payment">
                        <h5 class="text-white fw-bold">Credit Card Details</h5>
                        <form action="#">
                            <div class="row">
                                <div class="col col-md-12">
                                    <div class="lm__form-input mb-4"> <input class="form-control" type="text"
                                            placeholder="Name on Card"></div>
                                </div>
                                <div class="col col-md-8">
                                    <div class="lm__form-input mb-4"> <input class="form-control" type="text"
                                            placeholder="Card Number"></div>
                                </div>
                                <div class="col col-md-4">
                                    <div class="lm__form-input mb-4"> <input class="form-control" type="text"
                                            placeholder="CVC"></div>
                                </div>
                                <div class="col col-md-6">
                                    <div class="lm__form-input mb-4"> <input class="form-control" type="text"
                                            placeholder="Expiration Date"></div>
                                </div>
                                <div class="col col-md-6">
                                    <div class="lm__form-input mb-4"> <input class="form-control" type="text"
                                            placeholder="Zip or Postal Code"></div>
                                </div>
                                <div class="col col-md-12">
                                    <div class="lm__form-input mb-4"> <input class="form-control" type="text"
                                            placeholder="Country"></div>
                                </div>
                                <!-- <div class="col col-md-12 text-center my-3 mt-0"><a
                                        class="moreless-button d-flex justify-content-center">Have a promo Code
                                        <span> <img class="in-svg" src="{{asset('assets/images/arrow.svg')}}" alt=""></span></a>
                                </div>
                                <div class="col col-md-12 moretext">
                                    <div class="lm__form-input mb-4"> <input class="form-control" type="text"
                                            placeholder="code"></div>
                                </div> -->
                                <div class="col col-md-12">
                                    <div class="d-flex align-items-center mb-3"> <img class="in-svg"
                                            src="{{asset('assets/images/lock1.svg')}}" alt="">
                                        <p class="text-light mb-0 ms-1">Card information is stored on a secure server
                                        </p>
                                    </div>
                                </div>
                                <div class="col col-md-12">
                                    <div class="lm__form--button"> <a class="btn btn--primary" href="{{ route('user.courses.lists') }}" type="submit"
                                    >Submit</a></div>
                                    <button class="btn-close text-white d-block w-100 mt-2" type="button" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="offcanvas offcanvas-end lm_profile-modal lm_create-modal" id="offcanvasRight16" tabindex="-1"
  aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasRightLabel">Skip</h5><button class="btn-close" type="button"
      data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body p-0">
    <div class="lm_profile-modal p-2">
      <div class="row align-items-center">
        <div class="col-12 text-center">
          <h5 class="text-white mb-0">Invite</h5>
        </div>
      </div>
    </div>
    <div class="lm_create-body invite-body">
      <div class="lm_in-mem">
        <h5 class="text-center fw-bold">Invite Members</h5>
        <div class="input-group mb-3 invite-input rounded-5 shadow"><input class="form-control" type="text"
            placeholder=""
            value=""
            aria-label="Recipient's username" aria-describedby="button-addon2"><button
            class="btn btn--dark py-1 rounded-5" id="button-addon2" type="button" data-bs-toggle="modal"
            data-bs-target="#exampleModal21">Copy Link</button></div>
      </div>
      <div class="lm_in-mail">
        <h5 class="text-center fw-bold">Invite by Email</h5>
        <div class="mb-3"> <input class="form-control shadow" type="text"
            placeholder="Add multiple email addresses here"></div>
        <div class="bg-white shadow lm_msg mb-3">
          <div class="d-flex gap-3">
            <div class="avtar-30"><img src="assets/images/invite.jpg" alt=""></div>
            <div class="d-block">
              <p class="mb-3 text-dark">Hi!</p>
              <p class="mb-3 text-dark">I'm a member of PEEQ, and I think you should be too. Come join me!
              </p>
              <p class="mb-0 text-dark">See you there,<br>Custom Coder</p>
            </div>
          </div>
        </div>
        <div class="d-block">
          <p class="text-sm-12 mb-0 fw-bold">NETWORK PERMISSIONS</p>
          <p class="mb-0 color-light">Choose what permissions these members will have in PEEQ.</p>
        </div>
        <div class="d-flex mt-3 justify-content-between">
          <div class="lm_post-input-emoji mb-2 me-3"><select class="form-select form-control js-example-basic-single"
              id="select_box1">
              <option>Invite as host</option>
              <option value="a">Invite as Maderators</option>
              <option value="c">Invite as Member</option>
            </select></div>
          <div class="lm_send"> <button class="btn btn--primary">Send</button></div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Video open -->
<div class="modal fade" id="course_preview_video" data-bs-backdrop="static"  data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" >
  <div class="modal-dialog modal-dialog-centered lm__modal-3 lm__modal-25">
    <div class="modal-content overflow-hidden">
      <div class="modal-body p-4 text-center position-relative">
        <div class="lm__modal-body">
          <div class="lm__modal-3-video position-relative z-index-3 mb-3">
            
            {{-- <video width="750" height="425" controls>
              <source  src="" type="video/mp4">
              Your browser does not support the video tag.
            </video> --}}
            
            <iframe width="750" height="425" id="coursePreviewVideoURL" src="" title="YouTube video player" frameborder="0"  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
              allowfullscreen="">
            </iframe> 
          </div>
          <div class="lm__modal-btn ContinueClick"> <button class="btn btn--primary px-5" data-bs-dismiss="modal">Continue</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Subscription--}}
<div class="modal fade subscription" id="subscription" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered lm__modal">
    <div class="modal-content">
      <div class="modal-body p-4 text-center">
        <div class="modal-header p-0 border-0">
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close">
            <span> 
              <img class="in-svg" src="{{asset('assets/images/close.svg')}}"alt="">
              </span>
            </button>
          </div>
          {{-- Image --}}
          <div class="d-flex justify-content-center mb-2">
            <img src="{{asset('assets/images/sub-bell.png')}}" alt="">
          </div>
          <div class="body-content">
            <h2 class="text-primary mb-3">Your 12-Month Complimentary Subscription with PEEQ has reached <br> its conclusion.</h2>
            <h5 class="text-dark fw-normal">To continue enjoying our services, please select the "Proceed" option to initiate your paid subscription.</h5>
            <a href="{{ route('paymentPlans.index') }}" class="btn btn--primary w-100">Proceed </a>
          </div>
      </div>
    </div>
  </div>
</div>

{{-- Quiz Successfully completed --}}
{{-- <div class="modal fade subscription" id="quiz_com" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered lm__modal">
    <div class="modal-content">
      <div class="modal-body p-4 text-center">
        <div class="modal-header p-0 border-0">
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close">
            <span> 
              <img class="in-svg" src="{{asset('assets/images/close.svg')}}"alt="">
              </span>
            </button>
          </div>
          Image
          <div class="d-flex justify-content-center mb-2">
            <img src="{{asset('assets/images/trophy.png')}}" alt="">
          </div>
          <div class="body-content">
            <h2 class="text-primary mb-3">Congratulations on your successful completion of the quiz. </h2>
            <h5 class="text-dark fw-normal">Please click the "View Results" button to review your performance.</h5>
            <a class="btn btn--primary w-100" data-bs-dismiss="modal" aria-label="Close">View Results</a>
          </div>
      </div>
    </div>
  </div>
</div> --}}


{{-- Course Completed --}}
<div class="modal fade subscription" id="course_com" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered lm__modal">
    <div class="modal-content">
      <div class="modal-body p-4 text-center">
        <div class="modal-header p-0 border-0">
          <button class="btn-close" type="button" id="CourseModuleClose" data-bs-dismiss="modal" aria-label="Close">
            <span> 
              <img class="in-svg" src="{{asset('assets/images/close.svg')}}"alt="">
              </span>
            </button>
          </div>
          {{-- Image --}}
          <div class="d-flex justify-content-center mb-2">
            <img src="{{asset('assets/images/cap.png')}}" alt="">
          </div>
          <div class="body-content">
            {{-- <h2 class="text-primary mb-3">Congratulations !! <br> Your Course Completed </h2>
            <h5 class="text-dark fw-normal"> --}}
              <img src="{{ asset('assets/images/course_completed_congratulation_img.png') }}" height="100%" width="100%">
            {{-- </h5> --}}
            <a href="{{ route('user.courses.list', ['type' => 'purchased']) }}" class="btn btn--primary">OK</a>
          </div>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  function CoursePreviewVideo(url) {
    $("#coursePreviewVideoURL").attr('src', url);
    console.log('coursePreviewVideoURL');
    } 
  </script>
<script>   
   
    function getInviteMembers(page = '1') {
        $.ajax({
                url: '{{ route("sent.invite.members") }}?page=' + page
                , type: "get"
                , beforeSend: function() {
                  // Show the loader initially
                  showLoader();
                   // $('.auto-load').show();
                }
            })
            .done(function(data) {
                if (data.html == " ") {
                    //$('.auto-load').html("We don't have more data to display :(");
                    //return;
                }
                // $('.auto-load').hide();
                // Hide the loader and show the content
                hideLoader();
                showContent();
                $("#invite-members-list").html(data.html);
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                alert('server not responding...');

            });
    }
    
    $(document).ready(function() {  
      
      $('#course_preview_video').on('hidden.bs.modal', function (e) {
      // Pause the YouTube video when the modal is closed
      var iframe = document.getElementById('coursePreviewVideoURL');
      var iframeSrc = iframe.src;
      iframe.src = iframeSrc; // This reloads the iframe, effectively pausing the video
    });
    
    //// Start  get Plans and Purchases //
        $('.purchase_plan').on('click', function(event) {
        event.preventDefault();
        // var search_txt = $('#searchInput').val();
            $.ajax({
            url: '{{route("purchase.plan")}}',
            method: 'GET',
            data: {},
            success: function(response) {
                console.log(response.data);
                var FinalAmmount = response.data.final_amount;
                $(".final_amount").text(FinalAmmount.toUpperCase());
                $(".plan_title").text(response.data.plan.plan_title);
                $(".plan_start_date").text(response.data.plan_start_date);
                $(".plan_end_date").text(response.data.plan_end_date);
            },
            error: function(xhr, status, error) {
                console.log(error.message);
            }
            });
            
            ///////////// 1:1 coaching session purchases plan
              $.ajax({
              url: '{{route("admin.session.oneTwone")}}',
              method: 'GET',
              data: {},
              success: function(response) {
                  console.log(response);
                  $("#appendPurchasedData").html(response.html);
                  // var FinalAmmount = response.data.final_amount;
                  // $(".final_amount").text(FinalAmmount.toUpperCase());
                  // $(".plan_title").text(response.data.plan.plan_title);
                  // $(".plan_start_date").text(response.data.plan_start_date);
                  // $(".plan_end_date").text(response.data.plan_end_date);
              },
              error: function(xhr, status, error) {
                  console.log(error.message);
              }
              });
            
        });
        
        $("#send_invite").on("click", function(event) {
            
            // var url = "{{route('invite.by_email', ":id")}}";
            // url = url.replace(":id", id);
            
            let _token = $("input[name=_token]").val();
            var email = $("input[name=invite_emails]").val();
            var invite_message = $("textarea[name='invite_message']").val();
            var user_type = $("select[name='user_type']").val();
            
            $("#send_invite").attr("disabled", true);
            $(".print-error-msg").html('');
            $("#send_invite").addClass('loader-button');
            
            $('.spinner-border').show();
            $.ajax({
                url: '{{route("invite.by_email")}}',
                type: "POST",
                beforeSend: function() {
                        // $('.ajax-load').show();
                        $('.spinner-border').show();
                    },
                data: {
                    email: email,
                    // message1: invite_message,
                    message: invite_message,
                    user_type: user_type,
                    _token: _token,
                },
                dataType: 'JSON',
                success: function(data) {
                  $("#SendInviteForm")[0].reset();
                    console.log('arvind');
                    $("input[name=invite_emails]").val('');
                    console.log(data);
                    // getData();
                    $("#send_invite").attr("disabled", false);
                    $("#send_invite").removeClass('loader-button');
                    $('.spinner-border').hide();
                              
                    $("input[name=invite_emails]").val('');
                    $("input[name='message']").html('');
                    $("input[name='message']").val('');
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
                                        
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseJSON.message);
                    $(".print-error-msg").html(xhr.responseJSON.message);
                    $("#send_invite").attr("disabled", false);
                // Handle the AJAX error response
                }
            });
        
    });
    ///ContinueClick video audio and vedio Stop
    var ContinueClick = $('.ContinueClick');
    var url = $('#coursePreviewVideoURL').attr('src');
    $(ContinueClick).click(function() {
      $('#coursePreviewVideoURL').attr('src', '');
    });
    $('#coursePreviewVideoURL').attr('src', url);
});

$(document).ready(function() {
  $("#select_box9").select2({
    dropdownParent: $("#courseshare")
  });
});

function copy_web_url() {
    var url = '{{ url("") }}';
    navigator.clipboard.writeText(url)
        .then(() => {
            Swal.fire({
                toast: true,
                icon: 'success',
                title: 'Web URL copied successfully!',
                position: 'top-right',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                }
            });
        })
        .catch((error) => {
            console.error('Failed to copy URL to clipboard: ', error);
            // Handle the error (e.g., show an error message to the user)
        });
}
$('#CourseModuleClose').click(function () { 
    window.location.href='{{ route('user.courses.list', ['type' => 'purchased']) }}';
});
</script>