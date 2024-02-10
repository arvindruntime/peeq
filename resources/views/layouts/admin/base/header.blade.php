<link rel="stylesheet" href="{{asset('assets/css/dashboard_header.css')}}"> 


<link rel="stylesheet" href="{{asset('assets/froalaeditor/css/froala_editor.css')}}">
<link rel="stylesheet" href="{{asset('assets/froalaeditor/css/froala_style.css')}}">
<link rel="stylesheet" href="{{asset('assets/froalaeditor/css/plugins/colors.css')}}">
<link rel="stylesheet" href="{{asset('assets/froalaeditor/css/plugins/emoticons.css')}}">
<link rel="stylesheet" href="{{asset('assets/froalaeditor/css/plugins/image_manager.css')}}">
<link rel="stylesheet" href="{{asset('assets/froalaeditor/css/plugins/image.css')}}">
<link rel="stylesheet" href="{{asset('assets/froalaeditor/css/plugins/video.css')}}"> 

@php
    $user = Auth::user();
    
    

    if (isset($user) && $user->timezone_id!='') {
        $timeZoneInfo = getTimeZoneName($user->timezone_id);

        if ($timeZoneInfo) {
            $timezone = $timeZoneInfo->timezone;
            session(['user_timezone' => $timezone]);
        }
    }    
        
    $request['is_mobile'] = 0;
    $welcome_checklist = welcomeChecklists($request);
    session()->put('welcome_checklist', $welcome_checklist['welcome_checklist_complete']);  
    $disabled = "";
    if($welcome_checklist['welcome_checklist_complete']<1)
    {
        $disabled = "disabled";
    }        
    @endphp
    
    {{-- {{ now()->format('H:i:s') }} --}}
{{-- {{ dd($user) }} --}}
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
<header class="dash__header auto-load {{ $disabled }}">
    <div class="container">
        <div class="lm__dash-heade pt-2">
            <div class="row justify-content-between align-items-center position-relative">
                <div class="col-2 d-block d-lg-none z-index-3 position-relative"><a
                        class="d-flex justify-content-start btn-toogle p-0 border-0"><img class="in-svg" src="{{ asset('assets/images/toggle.svg') }}"
                            alt=""></a></div>
                <div class="col-10 col-lg-12 col-xxl-12 lm_nav">
                    <div class="blink text-center">
                        {{-- <p class="mb-1 text-primary">{{ env('ANNOUNCEMENT') }}</p> --}}
                    </div>
                    <div class="position-relative">
                        <div class="row g-3 justify-content-md-between position-relative align-items-center">
                            <div class="col-2 col-lg-6 col-lg-5 col-xl-4">
                                <form id="searchForm" class="d-none d-lg-block" role="search">
                                    <div class="lm__dash-search">
                                        <input class="form-control" id="searchInput" type="search" aria-label="Search" placeholder="Search Peeq" value="{{ request()->input('term') }}">
                                        <button type="submit">
                                            <span> <img  class="in-svg" src="{{ asset('assets/images/search.svg') }}" alt=""></span>
                                        </button>
                                    </div>
                                                    @php
                                                    // $userDate = '2023-08-17 14:18:00';                                                    
                                                    // $userTimezone = getUserTimeZone();
                                                    
                                                    // echo getDateTimeFormat($userDate);
                                                    
                                                    // $userTimezone = getUserTimeZone();
                                                    // $utcDate = convertToUtc($userDate, getUserTimeZone());
                                                    // echo $utcDate;
                                                    @endphp
                                </form>
                                <div class="dropdown d-block d-lg-none"><a type="button" data-bs-toggle="dropdown"
                                        aria-expanded="false"><span class="bg-white-42"> <img class="in-svg"
                                                src="{{ asset('assets/images/search.svg') }}" alt=""></span></a>
                                    <div class="dropdown-menu lm__search shadow border-0 mt-2">
                                        <form action="#" role="search">
                                            <p class="mb-2">Seacrh here</p>
                                            <div class="lm__dash-search"><input class="form-control shadow"
                                                    id="lm-search" type="search" aria-label="Search"
                                                    placeholder="Search Peeq"><button
                                                    type="submit"><span> <img class="in-svg"
                                                            src="{{ asset('assets/images/search.svg') }}" alt=""></span></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-10 col-lg-6">
                                <ul class="lm__dash-list justify-content-end hstack gap-3">
                                    <li class="lm__dash-item dark-btn">
                                        <div class="dark-mode" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Change mode"><input class="checkbox" id="checkbox"
                                                type="checkbox"><label class="label bg-white-42" for="checkbox">
                                                <div class="ball"></div>
                                            </label></div>
                                    </li>
                                    <li class="lm__dash-item">
                                        <div class="dropdown" ><a href="#" type="button" data-bs-toggle="dropdown"
                                                aria-expanded="false"><span class="bg-white-42" onclick="getPushNotification()" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="View notifications"><img
                                                        src="{{ asset('assets/images/BellFill.svg') }}" alt=""></span>
                                                                                                               
                                                          <span id="notification_badge" class="text-sm-12 px-1 position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary d-none">
                                                            0<span class="visually-hidden">unread messages</span>
                                                          </span>
                                                        </a>
                                            <div class="dropdown-menu lm_drop border-0 shadow mt-3 rounded-4">
                                                <div class="d-flex justify-content-between px-3">
                                                    <h5>Notification Settings</h5><span type="button"
                                                        data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight2"
                                                        aria-controls="offcanvasRight2"><img class="in-svg"
                                                            src="{{ asset('assets/images/setting.svg') }}" alt=""></span>
                                                </div>
                                                {{-- <div class="card shadow border-0 p-3 rounded-4 mb-3">
                                                    <h6>Allow Desktop Notifications so you don’t miss new activity!
                                                    </h6>
                                                    <div class="d-flex align-items-center"><button
                                                            class="btn btn--primary py-2 px-3 title-font">Allow</button><button
                                                            class="btn btn-link title-font text-secondary py-0">Allow</button>
                                                    </div>
                                                </div> --}}
                                                {{-- <div id="preloader" class="preloader">
                                                    <div class="loader"></div>
                                                </div> --}}
                                                  
                                                <ul id="pushNotificationList" class="push-notification-list">
                                                    
                                                </ul>
                                            </div>
                                        </div>
                                       
                                    </li>
                                    {{-- <li class="lm__dash-item">
                                        <div class="dropdown"  ><a href="#" type="button" data-bs-toggle="dropdown"
                                                aria-expanded="false"><span class="bg-white-42" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="View messages"><img
                                                        src="{{ asset('assets/images/EnvelopeFill.svg') }}" alt=""></span></a>
                                            <div class="dropdown-menu p-3 lm_drop border-0 shadow mt-3 rounded-4">
                                                <div class="d-flex justify-content-between mb-3">
                                                    <h5 class="mb-0">Messages</h5>
                                                    <div class="dropdown-sound"><a
                                                            class="dropdown-toggle-sound"><span><img class="in-svg"
                                                                    src="{{ asset('assets/images/dots-1.svg') }}"
                                                                    alt=""></span></a>
                                                        <div class="dropdown-card p-3">
                                                            <div class="form-check form-switch ps-0 mb-2">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center">
                                                                    <label class="form-check-label title-font"
                                                                        for="flexSwitchCheckChecked">Enable
                                                                        Sounds</label><input
                                                                        class="form-check-input"
                                                                        id="flexSwitchCheckChecked" type="checkbox"
                                                                        role="switch" checked=""></div>
                                                            </div>
                                                            <div class="form-check form-switch ps-0">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center">
                                                                    <label class="form-check-label title-font"
                                                                        for="flexSwitchCheckChecked">Show Send
                                                                        Button</label><input
                                                                        class="form-check-input"
                                                                        id="flexSwitchCheckChecked" type="checkbox"
                                                                        role="switch" checked=""></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <form class="mb-2" action="#" role="search">
                                                    <div class="lm__dash-search lm__dash-search-2"><input
                                                            class="form-control shadow" id="lm-search1"
                                                            type="search" aria-label="Search"
                                                            placeholder="Search"><button type="submit"><span> <img
                                                                    class="in-svg" src="{{ asset('assets/images/search.svg') }}"
                                                                    alt=""></span></button></div>
                                                </form>
                                                <div class="list-group border-0"><a
                                                        class="list-group-item list-group-item-action shadow border-0 p-2 rounded-4 mb-2"
                                                        href="#" aria-current="true">
                                                        <div class="d-flex w-100 justify-content-between">
                                                            <div class="d-flex gap-2 align-items-center">
                                                                <div class="avtar-40"> <img
                                                                        src="{{ asset('assets/images/avtar-10.jpg') }}" alt="">
                                                                </div>
                                                                <div class="d-block">
                                                                    <p class="mb-0 title-font lh-1">Arlene McCoy</p>
                                                                    <small class="title-font text-secondary">How are
                                                                        you?</small>
                                                                </div>
                                                            </div>
                                                            <div class="d-block text-center">
                                                                <p
                                                                    class="mb-0 title-font text-sm-10 text-primary">
                                                                    3:41pm</p><span
                                                                    class="badge bg-primary rounded-circle text-sm-10">2</span>
                                                            </div>
                                                        </div>
                                                    </a><a
                                                        class="list-group-item list-group-item-action shadow border-0 p-2 rounded-4 mb-2"
                                                        href="#" aria-current="true">
                                                        <div class="d-flex w-100 justify-content-between">
                                                            <div class="d-flex gap-2 align-items-center">
                                                                <div class="avtar-40"> <img
                                                                        src="{{ asset('assets/images/avtar-11.jpg') }}" alt="">
                                                                </div>
                                                                <div class="d-block">
                                                                    <p class="mb-0 title-font lh-1">Raqeal Russel
                                                                    </p><small class="title-font text-secondary">How
                                                                        are you?</small>
                                                                </div>
                                                            </div>
                                                            <div class="d-block text-center">
                                                                <p
                                                                    class="mb-0 title-font text-sm-10 text-primary">
                                                                    3:41pm</p><span
                                                                    class="badge bg-primary rounded-circle text-sm-10">2</span>
                                                            </div>
                                                        </div>
                                                    </a><a
                                                        class="list-group-item list-group-item-action shadow border-0 p-2 rounded-4 mb-2"
                                                        href="#" aria-current="true">
                                                        <div class="d-flex w-100 justify-content-between">
                                                            <div class="d-flex gap-2 align-items-center">
                                                                <div class="avtar-40"> <img
                                                                        src="{{ asset('assets/images/avtar-12.jpg') }}" alt="">
                                                                </div>
                                                                <div class="d-block">
                                                                    <p class="mb-0 title-font lh-1">Coreall Joness
                                                                    </p><small class="title-font text-secondary">How
                                                                        are you?</small>
                                                                </div>
                                                            </div>
                                                            <div class="d-block text-center">
                                                                <p
                                                                    class="mb-0 title-font text-sm-10 text-primary">
                                                                    3:41pm</p><span
                                                                    class="badge bg-primary rounded-circle text-sm-10">2</span>
                                                            </div>
                                                        </div>
                                                    </a><a
                                                        class="list-group-item list-group-item-action shadow border-0 p-2 rounded-4 mb-2"
                                                        href="#" aria-current="true">
                                                        <div class="d-flex w-100 justify-content-between">
                                                            <div class="d-flex gap-2 align-items-center">
                                                                <div class="avtar-40"> <img
                                                                        src="{{ asset('assets/images/avtar-13.jpg') }}" alt="">
                                                                </div>
                                                                <div class="d-block">
                                                                    <p class="mb-0 title-font lh-1">Willam Smith</p>
                                                                    <small class="title-font text-secondary">How are
                                                                        you?</small>
                                                                </div>
                                                            </div>
                                                            <div class="d-block text-center">
                                                                <p
                                                                    class="mb-0 title-font text-sm-10 text-primary">
                                                                    3:41pm</p><span
                                                                    class="badge bg-primary rounded-circle text-sm-10">2</span>
                                                            </div>
                                                        </div>
                                                    </a></div>
                                            </div>
                                        </div>
                                    </li> --}}
                                    <li class="lm__dash-item">
                                        <div class="dropdown"><a class="d-flex align-items-center text-dark"
                                                href="#" type="button" data-bs-toggle="dropdown"
                                                aria-expanded="false"><span class="bg-white-42 me-2 user-profile"><img
                                                        src="{{ $user->profile_image_url }}" class="profile_image1" alt=""></span>{{ $user->first_name }} {{ $user->last_name }}</a>
                                            <div class="dropdown-menu p-3 lm_drop border-0 shadow mt-3">
                                                <div class="d-flex justify-content-between">
                                                    <h5>Account setting</h5>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="d-flex gap-2"><span class="bg-white-42 user-profile shadow"><img
                                                                src="{{ $user->profile_image_url }}" class="profile_image1" alt=""></span>
                                                        <div class="d-block">
                                                            <h6 class="mb-0 fw-bold">{{ $user->first_name }} {{ $user->last_name }}</h6>
                                                            <p class="mb-0 text-sm-14 text-secondary title-font" >
                                                                <a onclick="ViewMemberProfile({{ $user->id }},'1')">View your Profile</a></p>
                                                                {{-- data-bs-toggle="offcanvas" data-bs-target="#your_profile" aria-controls="your_profile" --}}
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <hr>
                                                 <ul class="list-group text-secondary title-font">
                                                    
                                                    @if(session()->get('welcome_checklist')==1)
                                                    <li class="list-group-item text-secondary border-0 p-1">
                                                        <a type="button" data-bs-toggle="offcanvas" data-id="7" data-bs-target="#offcanvasRight2" aria-controls="offcanvasRight2">Notification Settings</a></li>
                                                    @endif
                                                    <li class="list-group-item text-secondary border-0 p-1">
                                                        <a type="button" class="purchase_plan" data-bs-toggle="offcanvas" data-bs-target="#your-purchases" aria-controls="your-purchases">My Plans and Purchases</a>
                                                    </li>
                                                    {{-- @if($user->is_admin == 1) --}}
                                                    <li class="list-group-item text-secondary border-0 p-1">
                                                        <a type="button" data-bs-toggle="offcanvas" data-bs-target="#inviteMemberModal" aria-controls="inviteMemberModal">Invite Friends</a>
                                                    </li>
                                                    {{-- @endif --}}
                                                        
                                                    {{-- <li class="list-group-item text-secondary border-0 p-1">Text me
                                                        the App</li>
                                                    <li class="list-group-item text-secondary border-0 p-1">Saved
                                                        Drafts</li> --}}
                                                        
                                                    @if(session()->get('welcome_checklist')==1)
                                                        <li class="list-group-item text-secondary border-0 p-1"><a href="{{ asset('post_by_filter?type=is_save') }}">Saved
                                                        Posts</a></li>
                                                        <li class="list-group-item text-secondary border-0 p-1"><a href="{{ asset('post_by_filter?type=is_hide_post') }}">Hide
                                                            Posts</a></li>
                                                                                                                        
                                                            
                                                            @if($user->is_admin == 0)
                                                            <li class="list-group-item text-secondary border-0 p-1"><a data-bs-toggle="offcanvas" data-id="7" data-bs-target="#offcanvasRight3" aria-controls="offcanvasRight3">Download App</a></li>
                                                            @endif
                                                    @endif
                                                            <li class="list-group-item text-secondary border-0 p-1"><a href="{{ asset('change-password') }}">Change Password</a></li>
                                                            <li class="list-group-item text-secondary border-0 p-1">    
                                                                <a class="d-flex rounded-2 d-block" href="{{ route('logout') }}"
                                                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                                   Logout
                                                                </a>
                                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                                    @csrf
                                                                </form>
                                                            </li>
                                                </ul> 
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered lm__modal">
    <div class="modal-content">
        <div class="modal-body p-4">
            <div class="lm__term--title">
                <h3 class="mb-2">Accept our terms of service</h3>
                <p class="mb-2">To continue, please accept our Terms of Service</p>
            </div>
            <div class="lm__term"><label class="lm-check-term">I agree to the Terms of Service and Privacy Policy
                    (required)<input type="checkbox" checked="checked"><span class="checkmark">
                    </span></label><label class="lm-check-term">I agree to receive activity emails from this Mighty
                    Network. I can refine or revoke this consent anytime. (opt-in)<input type="checkbox"
                        checked="checked"><span class="checkmark"> </span></label><label class="lm-check-term">I
                    agree to receive activity emails from this Mighty Network. I can refine or revoke this consent
                    anytime. (opt-in)<input type="checkbox" checked="checked"><span class="checkmark">
                    </span></label><label class="lm-check-term">I agree to receive commercial emails from this
                    Mighty Network. I can revoke this consent at any time by unsubscribing to any commercial email
                    from this Host. (opt-in)<input type="checkbox" checked="checked"><span
                        class="checkmark"></span></label>
                <div class="lm__term--button"> <button class="btn btn--primary">Confirm</button><button
                        class="close-button" type="button" data-bs-dismiss="modal">Cancel</button></div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered lm__modal-2">
    <div class="modal-content">
        <div class="modal-body p-4 text-center">
            <div class="lm__term--title">
                <h3 class="mb-2 fw-bold">Are you sure you want to sign out?</h3>
            </div>
            <div class="lm__term--button"> <button class="btn btn--primary">Yes, Sign Out</button><button
                    class="close-button" type="button" data-bs-dismiss="modal">Cancel</button></div>
        </div>
    </div>
</div>
</div>
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered lm__modal-2">
    <div class="modal-content">
        <div class="modal-body p-4 text-center"><span class="mb-2"><img class="in-svg mx-auto"
                    src="{{asset('assets/images/CheckCircle.svg')}}" alt=""></span>
            <div class="lm__term--title">
                <h3 class="my-2 fw-bold">Success!</h3>
                <p class="text-light mb-2">Lorem ipsum dolor sit amet consectetur. Feugiat nibh proin orci mattis
                    proin massa platea adipiscing odio</p>
            </div>
            <div class="lm__term--button mt-3"> <button class="btn btn--primary me-0">Go to Dashboard</button></div>
        </div>
    </div>
</div>
</div>
{{-- <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered lm__modal-3">
        <div class="modal-content overflow-hidden">
            <div class="modal-body p-4 text-center position-relative">
                <div class="lm__shape-1 position-absolute top-0 start-0"><img class="in-svg"
                        src="{{asset('assets/images/shape1.svg')}}" alt=""></div>
                <div class="lm__shape-2 position-absolute bottom-0 end-0"><img class="in-svg"
                        src="{{asset('assets/images/shape33.svg')}}" alt=""></div>
                <div class="lm__shape-3"> <img class="in-svg" src="{{('assets/images/logoshape1.png')}}" alt=""></div>
                <div class="lm__modal-body">
                    <div class="lm__modal-3-con position-relative z-index-3">
                        <h2 class="text-white">Welcome to our Ambassador Launch2</h2>
                    </div>
                    <div class="lm__modal-3-video position-relative z-index-3 mb-3"><iframe width="750" height="425"
                            src="https://www.youtube.com/embed/DFSK_sVwOY8" title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen=""></iframe></div>
                    <div class="lm__modal-3-con position-relative z-index-3">
                        <p class="text-white">As a valued friend of PEEQ, we are thrilled to have you in
                            our Global Leadership Network. Alongside a select circle of leaders, hand-picked by Zoe, we
                            are excited to welcome you into this brand-new, exclusive Network. You are part of a group
                            of CEOs, Executives, Team Leaders and Business Owners who we have chosen to connect within
                            the PEEQ experience first. The reason we have chosen you is that you have
                            already shown interest in learning more from Zoe and the PEEQ team and we
                            wanted to find a way to give you access to this without having to rely on scheduled calls,
                            meetings or even in-person appointments.</p>
                    </div>
                    <div class="lm__modal-btn"> <button class="btn btn--primary px-5"
                            data-bs-dismiss="modal">Continue2</button></div>
                </div>
            </div>
        </div>
    </div>
</div> --}}


<div class="modal fade" id="SubModulePreviewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false" data-bs-keyboard="false" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered lm__modal-3">
        <div class="modal-content overflow-hidden">
            <div class="modal-body p-4 text-center position-relative">
                <div class="lm__shape-1 position-absolute top-0 start-0"><img class="in-svg"
                        src="{{ asset('assets/images/shape1.svg') }}" alt=""></div>
                <div class="lm__shape-2 position-absolute bottom-0 end-0"><img class="in-svg"
                        src="{{ asset('assets/images/shape33.svg') }}" alt=""></div>
                <div class="lm__shape-3"> <img class="in-svg" src="{{ asset('assets/images/logoshape1.png') }}" alt=""></div>
                <div class="lm__modal-body" style="max-width: 100%">
                    {{-- <div class="lm__modal-3-con position-relative z-index-3">
                        <h2 class="text-white">Welcome to PEEQ</h2>
                    </div> --}}
                    <div class="lm__modal-3-video position-relative z-index-3 mb-3  d-flex justify-content-center align-items-center">
                        <img id="modulePreviewImage" style="width: 80%">
                    </div>
                    
                    <div class="lm__modal-btn">
                        <button class="btn btn--primary px-5 close" data-bs-dismiss="modal">Continue</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="welcomeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false" data-bs-keyboard="false" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered lm__modal-3">
        <div class="modal-content overflow-hidden">
            <div class="modal-body p-4 text-center position-relative">
                <div class="lm__shape-1 position-absolute top-0 start-0"><img class="in-svg"
                        src="{{ asset('assets/images/shape1.svg') }}" alt=""></div>
                <div class="lm__shape-2 position-absolute bottom-0 end-0"><img class="in-svg"
                        src="{{ asset('assets/images/shape33.svg') }}" alt=""></div>
                <div class="lm__shape-3"> <img class="in-svg" src="{{ asset('assets/images/logoshape1.png') }}" alt=""></div>
                <div class="lm__modal-body">
                    <div class="lm__modal-3-con position-relative z-index-3">
                        <h2 class="text-white">Welcome to PEEQ</h2>
                    </div>
                    <div class="lm__modal-3-video position-relative z-index-3 mb-3">
                        {{-- <iframe width="750" height="425"
                            src="{{'assets/video/Welcome-Inside-PEEQ.mp4'}}" title="YouTube video player" frameborder="0"
                            allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen=""></iframe> --}}
                            <video width="750" height="425" controls>
                                <source src="assets/video/Welcome-Inside-PEEQ.mp4" type="video/mp4">
                                Your browser does not support the video tag.
                              </video>
                        </div>
                    <div class="lm__modal-3-con position-relative z-index-3">
                        <p class="text-white">Thank you for signing up to PEEQ, we are thrilled to have you here. In this quick opening video, PEEQ founder and CEO, Zoe Williams welcomes you to the network and explains how she created PEEQ, how best to use the platform and her vision for the future of this incredible network of leaders.</p>
                    </div>
                    <div class="lm__modal-btn"> <button class="btn btn--primary px-5 close"
                            data-bs-dismiss="modal" id="show_profile">Continue</button></div>
                </div>
            </div>
        </div>
    </div>
</div>
  
<div class="modal fade" id="member_block_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered lm__modal-4">
    <div class="modal-content overflow-hidden">
        <div class="modal-body p-4 text-center position-relative">
            <div class="modal-header p-0"><button class="btn-close" type="button" data-bs-dismiss="modal"
                    aria-label="Close"><span> <img class="in-svg" src="{{asset('assets/images/close.svg')}}"
                            alt=""></span></button></div>
            <div class="lm__modal-4-vec position-absolute top-50 start-50 translate-middle"><img class="in-svg"
                    src="{{asset('assets/images/logo-3.svg')}}" alt=""></div>
            <div class="z-index-1 position-relative lm_mxw50">
                <h4 class="text-white memberName">Block</h4>
                <input type="hidden" id="memberId">
                <input type="hidden" class="tab_type">
                <h6 class="text-white">You will no longer receive notifications or private messages from this
                    member. You also won’t see their posts in your Activity Feed.</h6>
                    <button class="btn btn--primary mt-3 block_member_btn">Confirm</button><button
                    class="btn-close text-white d-block w-100 mt-2" type="button" data-bs-dismiss="modal"
                    aria-label="Close">Cancel</button>
            </div>
        </div>
    </div>
</div>
</div>

<div class="modal fade" id="reportMemberModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered lm__modal-4">
    <div class="modal-content overflow-hidden">
        <div class="modal-body p-4 text-center position-relative">
            <div class="modal-header p-0"><button class="btn-close" type="button" data-bs-dismiss="modal"
                    aria-label="Close"><span> <img class="in-svg" src="{{asset('assets/images/close.svg')}}"
                            alt=""></span></button></div>
            <div class="lm__modal-4-vec position-absolute top-50 start-50 translate-middle"><img class="in-svg"
                    src="{{asset('assets/images/logo-3.svg')}}" alt=""></div>
            <div class="z-index-1 position-relative lm_mxw50">
                <h4 class="text-white">Report This Member</h4>
                <div class="d-flex justify-content-center">
                    <ul class="text-start">
                        <li class="px-3">
                            <div class="lm__term mb-3">
                                <label class="lm-check-term ps-4 mb-0 lh-1 text-white">They're posting spam
                                    <input type="checkbox" name="memberReportReasons" value="They're posting spam">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </li>
                        <li class="px-3">
                            <div class="lm__term mb-3">
                                <label class="lm-check-term ps-4 mb-0 lh-1 text-white">They're being offensive
                                    <input type="checkbox" name="memberReportReasons" value="They're being offensive">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </li>
                        <li class="px-3">
                            <div class="lm__term mb-3">
                                <label class="lm-check-term ps-4 mb-0 lh-1 text-white">They're pretending to be someone
                                    else
                                    <input type="checkbox" name="memberReportReasons" value="They're pretending to be someone">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </li>
                    </ul>
                </div><button class="btn btn--primary mt-3 report_member_btn">Confirm</button>
                <button class="btn-close text-white d-block w-100 mt-2" type="button" data-bs-dismiss="modal"
                    aria-label="Close">Cancel</button>
            </div>
        </div>
    </div>
</div>
</div>
<div class="modal fade" id="exampleModal16" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered lm__modal-4">
    <div class="modal-content overflow-hidden">
        <div class="modal-body p-4 text-center position-relative">
            <div class="modal-header p-0"><button class="btn-close" type="button" data-bs-dismiss="modal"
                    aria-label="Close"><span> <img class="in-svg" src="{{asset('assets/images/close.svg')}}"
                            alt=""></span></button></div>
            <div class="lm__modal-4-vec position-absolute top-50 start-50 translate-middle"><img class="in-svg"
                    src="{{asset('assets/images/logo-3.svg')}}" alt=""></div>
            <div class="z-index-1 position-relative lm_mxw50">
                <h4 class="text-white">How do you want to remove Arlene</h4>
                <h6 class="text-white"><span class="text-primary">Removing this member </span>will only remove their
                    membership, not their contributions or posts. They will be allowed to re-join in the future. If
                    they are the only Host of any Groups or Courses, you replace them as Host.</h6>
                <h6 class="text-white"><span class="text-primary">Banning this member </span>will permanently remove
                    them and their contributions and posts. They will NOT be allowed to re-join in the future. If
                    they are the only Host of any Groups or Courses, you replace them as Host</h6><button
                    class="btn btn--primary mt-3">Remove This Member</button><button
                    class="btn-close text-danger d-block w-100 mt-2 title-font" type="button"
                    data-bs-dismiss="modal" aria-label="Close">Ban This Member </button>
            </div>
        </div>
    </div>
</div>
</div>
<div class="modal fade" id="exampleModal17" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered lm__modal-4">
    <div class="modal-content overflow-hidden">
        <div class="modal-body p-4 text-center position-relative">
            <div class="modal-header p-0"><button class="btn-close" type="button" data-bs-dismiss="modal"
                    aria-label="Close"><span> <img class="in-svg" src="{{asset('assets/images/close.svg')}}"
                            alt=""></span></button></div>
            <div class="lm__modal-4-vec position-absolute top-50 start-50 translate-middle"><img class="in-svg"
                    src="{{asset('assets/images/logo-3.svg')}}" alt=""></div>
            <div class="z-index-1 position-relative lm_mxw50">
                <h4 class="text-white">Block Arlene</h4>
                <h6 class="text-white">You will no longer receive notifications or private messages from this
                    member. You also won’t see their posts in your Activity Feed.</h6><button
                    class="btn btn--primary mt-3">Confirm</button><button
                    class="btn-close text-white d-block w-100 mt-2" type="button" data-bs-dismiss="modal"
                    aria-label="Close">cancle</button>
            </div>
        </div>
    </div>
</div>
</div>
<div class="modal fade" id="exampleModal18" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered lm__modal-4">
    <div class="modal-content overflow-hidden">
        <div class="modal-body p-4 text-center position-relative">
            <div class="modal-header p-0"><button class="btn-close" type="button" data-bs-dismiss="modal"
                    aria-label="Close"><span> <img class="in-svg" src="{{asset('assets/images/close.svg')}}"
                            alt=""></span></button></div>
            <div class="lm__modal-4-vec position-absolute top-50 start-50 translate-middle"><img class="in-svg"
                    src="{{asset('assets/images/logo-3.svg')}}" alt=""></div>
            <div class="z-index-1 position-relative lm_mxw50">
                <h4 class="text-white">Report This Member</h4>
                <div class="d-flex justify-content-center">
                    <ul class="text-start">
                        <li class="px-3">
                            <div class="lm__term mb-3"><label
                                    class="lm-check-term ps-4 mb-0 lh-1 text-white">They're posting spam<input
                                        type="checkbox"><span class="checkmark"></span></label></div>
                        </li>
                        <li class="px-3">
                            <div class="lm__term mb-3"><label
                                    class="lm-check-term ps-4 mb-0 lh-1 text-white">They're being offensive<input
                                        type="checkbox"><span class="checkmark"></span></label></div>
                        </li>
                        <li class="px-3">
                            <div class="lm__term mb-3"><label
                                    class="lm-check-term ps-4 mb-0 lh-1 text-white">They're pretending to be someone
                                    else<input type="checkbox"><span class="checkmark"></span></label></div>
                        </li>
                    </ul>
                </div><button class="btn btn--primary mt-3">Confirm</button><button
                    class="btn-close text-white d-block w-100 mt-2" type="button" data-bs-dismiss="modal"
                    aria-label="Close">Cancel</button>
            </div>
        </div>
    </div>
</div>
</div>
<div class="modal fade" id="exampleModal19" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered lm__modal-19">
    <div class="modal-content overflow-hidden">
        <div class="modal-body p-4 text-center position-relative">
            <div class="modal-header p-0"><button class="btn-close" type="button" data-bs-dismiss="modal"
                    aria-label="Close"></button></div>
            <div class="modal-body">
                <h3 class="fw-bold">New Group </h3>
                <div class="contacts_body">
                    <div class="chat_header">
                        <h5 class="fw-bold">Group Name</h5>
                        <div class="lm__create mb-3"><input class="form-control shadow" type="text"
                                placeholder="Group name"></div>
                        <h5 class="fw-bold">Chats </h5>
                        <form action="#" role="search">
                            <div class="lm__dash-search"><input class="form-control shadow" id="lm-search"
                                    type="search" aria-label="Search" placeholder="Search"><button
                                    type="submit"><span> <img class="in-svg" src="{{asset('assets/images/search.svg')}}"
                                            alt=""></span></button></div>
                        </form>
                    </div>
                    <div class="contacts-pop">
                        <ul class="contacts" id="contact-list123_bkp">
                            <li class="chat-group d-flex justify-content-between align-items-center"
                                id="contact-list-1">
                                <div class="d-flex gap-3 align-items-center">
                                    <div class="contact-avatar"><img src="{{asset('assets/images/avtar-10.jpg')}}" alt="avatar">
                                    </div>
                                    <div class="contacts__about text-start">
                                        <div class="contact__name">
                                            <p>Aniket Mishra</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="lm__term mb-0"><input class="form-check-input me-1" id="check1"
                                        type="checkbox" value=""><label class="form-check-label stretched-link"
                                        for="check1"></label></div>
                            </li>
                            <li class="chat-group d-flex justify-content-between align-items-center"
                                id="contact-list-2">
                                <div class="d-flex gap-3 align-items-center">
                                    <div class="contact-avatar"><img src="{{asset('assets/images/avtar-11.jpg')}}" alt="avatar">
                                    </div>
                                    <div class="contacts__about text-start">
                                        <div class="contact__name">
                                            <p>Raqeal Russel</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="lm__term mb-0"><input class="form-check-input me-1" id="check2"
                                        type="checkbox" value=""><label class="form-check-label stretched-link"
                                        for="check2"></label></div>
                            </li>
                            <li class="chat-group d-flex justify-content-between align-items-center"
                                id="contact-list-3">
                                <div class="d-flex gap-3 align-items-center">
                                    <div class="contact-avatar"><img src="{{asset('assets/images/avtar-12.jpg')}}" alt="avatar">
                                    </div>
                                    <div class="contacts__about text-start">
                                        <div class="contact__name">
                                            <p>Coreall Joness</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="lm__term mb-0"><input class="form-check-input me-1" id="check3"
                                        type="checkbox" value=""><label class="form-check-label stretched-link"
                                        for="check3"></label></div>
                            </li>
                            <li class="chat-group d-flex justify-content-between align-items-center"
                                id="contact-list-4">
                                <div class="d-flex gap-3 align-items-center">
                                    <div class="contact-avatar"><img src="{{asset('assets/images/avtar-13.jpg')}}" alt="avatar">
                                    </div>
                                    <div class="contacts__about text-start">
                                        <div class="contact__name">
                                            <p>willoms Smith</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="lm__term mb-0"><input class="form-check-input me-1" id="check4"
                                        type="checkbox" value=""><label class="form-check-label stretched-link"
                                        for="check4"></label></div>
                            </li>
                            <li class="chat-group d-flex justify-content-between align-items-center"
                                id="contact-list-4">
                                <div class="d-flex gap-3 align-items-center">
                                    <div class="contact-avatar"><img src="{{asset('assets/images/avtar-14.jpg')}}" alt="avatar">
                                    </div>
                                    <div class="contacts__about text-start">
                                        <div class="contact__name">
                                            <p>Takazz Maves</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="lm__term mb-0"><input class="form-check-input me-1" id="check5"
                                        type="checkbox" value=""><label class="form-check-label stretched-link"
                                        for="check5"></label></div>
                            </li>
                        </ul>
                    </div>
                    <div class="d-block"><button
                            class="btn btn--primary d-block w-100 py-1 title-font">Create</button></div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="modal fade" id="exampleModal20" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered lm__modal-19 update">
    <div class="modal-content overflow-hidden">
        <div class="modal-body p-4 text-center position-relative">
            <div class="modal-header p-0"><button class="btn-close" type="button" data-bs-dismiss="modal"
                    aria-label="Close"></button></div>
            <div class="modal-body">
                <h3 class="fw-bold">New Group </h3>
                <div class="contacts_body">
                    <div class="chat_header">
                        <h5 class="fw-bold">Group Name</h5>
                        <div class="lm__create mb-3"><input class="form-control shadow" type="text"
                                placeholder="Group name"></div>
                        <h5 class="fw-bold">Chats </h5>
                        <form action="#" role="search">
                            <div class="lm__dash-search"><input class="form-control shadow" id="lm-search"
                                    type="search" aria-label="Search" placeholder="Search"><button
                                    type="submit"><span> <img class="in-svg" src="{{asset('assets/images/search.svg')}}"
                                            alt=""></span></button></div>
                        </form>
                    </div>
                    <div class="contacts-pop">
                        <ul class="contacts" id="contact-list">
                            <li class="chat-group d-flex justify-content-between align-items-center"
                                id="contact-list-1">
                                <div class="d-flex gap-3 align-items-center">
                                    <div class="contact-avatar"><img src="{{asset('assets/images/avtar-10.jpg')}}" alt="avatar">
                                    </div>
                                    <div class="contacts__about text-start">
                                        <div class="contact__name">
                                            <p>Aniket Mishra</p>
                                        </div>
                                    </div>
                                </div><button class="btn btn-link">Remove</button>
                            </li>
                            <li class="chat-group d-flex justify-content-between align-items-center"
                                id="contact-list-2">
                                <div class="d-flex gap-3 align-items-center">
                                    <div class="contact-avatar"><img src="{{asset('assets/images/avtar-11.jpg')}}" alt="avatar">
                                    </div>
                                    <div class="contacts__about text-start">
                                        <div class="contact__name">
                                            <p>Raqeal Russel</p>
                                        </div>
                                    </div>
                                </div><button class="btn btn-link">Remove</button>
                            </li>
                            <li class="chat-group d-flex justify-content-between align-items-center"
                                id="contact-list-3">
                                <div class="d-flex gap-3 align-items-center">
                                    <div class="contact-avatar"><img src="{{asset('assets/images/avtar-12.jpg')}}" alt="avatar">
                                    </div>
                                    <div class="contacts__about text-start">
                                        <div class="contact__name">
                                            <p>Coreall Joness</p>
                                        </div>
                                    </div>
                                </div><button class="btn btn-link">Remove</button>
                            </li>
                            <li class="chat-group d-flex justify-content-between align-items-center"
                                id="contact-list-4">
                                <div class="d-flex gap-3 align-items-center">
                                    <div class="contact-avatar"><img src="{{asset('assets/images/avtar-13.jpg')}}" alt="avatar">
                                    </div>
                                    <div class="contacts__about text-start">
                                        <div class="contact__name">
                                            <p>willoms Smith</p>
                                        </div>
                                    </div>
                                </div><button class="btn btn--primary">Add</button>
                            </li>
                            <li class="chat-group d-flex justify-content-between align-items-center"
                                id="contact-list-4">
                                <div class="d-flex gap-3 align-items-center">
                                    <div class="contact-avatar"><img src="{{asset('assets/images/avtar-14.jpg')}}" alt="avatar">
                                    </div>
                                    <div class="contacts__about text-start">
                                        <div class="contact__name">
                                            <p>Takazz Maves</p>
                                        </div>
                                    </div>
                                </div><button class="btn btn--primary">Add</button>
                            </li>
                        </ul>
                    </div>
                    <div class="d-block"><button
                            class="btn btn--primary d-block w-100 py-1 title-font">Update</button></div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

{{-- start modal for Download APP --}}
<div class="offcanvas offcanvas-end lm_profile-modal" id="offcanvasRight3" tabindex="-1" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasRightLabel">Skip</h5>
        @if(url()->current()==url('dashboard'))
        <button class="app-download ms-auto" id="app-download" type="button"
            data-bs-dismiss="offcanvas" aria-label="Close"><img class="in-svg" src="{{ asset('assets/images/gridicons_cross.svg') }}" alt=""></button>
        @else
        <button class="btn-close ms-auto" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        @endif    
    
    </div>
    <div class="offcanvas-body p-0">
        <div class="lm_profile-modal p-2">
            <div class="row align-items-center">
                <div class="col-8 text-end">
                    <h5 class="text-white mb-0">Download The App</h5>
                </div>
                {{-- <div class="col-4 text-end">
                    <a class="btn btn--primary py-2" href="{{ route('posts.index') }}">Finish</a>
                </div> --}}
            </div>
        </div>
        <div class="lm_dwnl text-center">
            <h5 class="fw-bold d-none d-sm-block">Scan QR Code</h5>
            <div class="d-block">
                <div class="toggle-button-cover"><input class="checkbox" type="checkbox" checked id="toggleCheckbox"></div>
            </div>           
            
            <div class="d-inline-block mx-auto d-none" id="apple-div">
                <img class="d-none d-sm-block mb-2" height="225px" width="225px" src="{{asset('assets/images/PEEQ-IOS-App.png')}}" alt="">
                {{-- d-sm-none d-md-none d-lg-none --}}
                <div class="">
                    <a href="https://apps.apple.com/us/app/peeq/id6458190160" target="_blank">
                        <img src="https://peeq.com.au/staging/assets/images/app-store.svg" alt="">
                    </a>
                    {{-- <a class="d-flex btn btn--primary" href="https://play.google.com/store/apps/details?id=au.com.peeq">Download Now</a> --}}
                </div>
                {{-- class="d-sm-none d-md-none d-lg-none" --}}
            </div>
            
            
            <div class="d-inline-block mx-auto" id="android-div">
                <img class="d-none d-sm-block mb-2" height="225px" width="225px" src="{{asset('assets/images/PEEQ-Android-App.png')}}" alt="">
                {{-- d-sm-none d-md-none d-lg-none --}}
                <div class="">
                    <a href="https://play.google.com/store/apps/details?id=au.com.peeq" target="_blank">
                        <img src="https://peeq.com.au/staging/assets/images/play-store.svg" alt="">
                    </a>                    
                </div>
                {{-- class="d-sm-none d-md-none d-lg-none" --}}
            </div>

            <!-- Finish button -->
            {{-- <div class="row">
                <div class="col-5 mx-auto mt-4">
                    <a href="{{ route('posts.index') }}" class="btn btn--primary w-75">Finish</a>
                </div>
            </div> --}}

            {{-- <p class="text-primary">Or</p>
            <h5 class="fw-bold">Keep up with PEEQ on the
                go.</h5> --}}
        </div>
        {{-- <div class="lm_dwnl-input text-start">
            <div class="input-group mb-3">
                <input class="form-control border rounded-0" type="text" placeholder="Phone Number" aria-label="Phone Number" aria-describedby="button-addon2">
                    <button class="btn btn--primary rounded-0" id="button-addon2" type="button">Text me the app</button>
            </div>
            <span class="text-xs lm_dwn-txt">Phone numbers from outside
                the United States may need to use a prefix (e.g. +44 XX
                XXXX XXXX). Available on <a href="#"> iOS </a> and <a
                    href="#"> Android </a>. This site is protected by
                reCAPTCHA and the Google <a href="#"> Privacy Policy
                </a> and <a href="#"> Terms of Service </a>
                apply.</span>
        </div> --}}
    </div>
</div>

{{-- Start Notification --}}

@php
$notifications = notificationList();
$notification_array = explode(",",$user->notification_setting);
@endphp

<div class="offcanvas offcanvas-end lm_profile-modal" id="offcanvasRight2" tabindex="-1"
aria-labelledby="offcanvasRightLabel">
<div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasRightLabel">Skip</h5><button class="btn-close" type="button"
        data-bs-dismiss="offcanvas" aria-label="Close"></button>
</div>
<div class="offcanvas-body p-0">
    <div class="lm_profile-modal p-2">
        <div class="row align-items-center">
            <div class="col-8 text-start ps-4">
                <h5 class="text-white mb-0">Notification Settings</h5>
            </div>
            <div class="col-4 text-end"><button class="btn btn--primary py-2 change_notification_status">Finish</button></div>
        </div>
    </div>
    
    @foreach ($notifications as $key => $notification)
    
    <div class="lm_noti text-start pb-0">
        <div class="lm_noti-title">
            <div class="d-flex"> <span class="me-2"> <img class="in-svg"
                src="{{ $notification->icon }}" alt=""></span>
                <h5 class="mb-2 fw-bold">{{ $notification->title }}</h5>
            </div>
            <p>{{ $notification->description }}</p>
        </div>
        <div class="lm_noti-upd">
            <div class="row gap-sm-0 gap-2">
                
                @foreach ($notification['notification_detail'] as $value)
                    <div class="col-12 mb-2">
                        <div class="lm_noti-card card shadow p-2 border-0">
                            <div class="d-flex justify-content-between">
                                        <h6 class="fw-bold">{{ $value->title }}</h6>
                                <div class="toggle-button-cover">
                                    <input class="checkbox notification_method" type="checkbox" name="notification_method[]" id="notification_method{{ $value->id }}" value="{{ $value->id }}" {{ (is_array($notification_array) && in_array($value->id, $notification_array)) ? ' checked' : '' }} ></div>
                            </div>
                            <p class="mb-0">{{ $value->detail_description }}</p>
                        </div>
                    </div>
                @endforeach           
                
            </div>
        </div>
    </div>
    @endforeach
    {{-- <div class="lm_noti-freq text-start pb-0">
        <h5 class="fw-bold">Email Frequency</h5>
        <div class="lm_noti-freq card">
            <div class="form-check">
                <input class="form-check-input notification_method" id="email_frequency3" type="radio" name="email_frequency" value="3" {{ (is_array($notification_array) && in_array('3', $notification_array)) ? ' checked' : '' }}>
                <label class="form-check-label" for="email_frequency">As Activity Happens<p>An email will be sent to you every time there’s new activity.</p></label>
            </div>
            
            <div class="form-check">
                <input class="form-check-input notification_method" id="email_frequency4" type="radio" name="email_frequency" value="4" {{ (is_array($notification_array) && in_array('4', $notification_array)) ? ' checked' : '' }}>
                <label class="form-check-label"
                    for="flexRadioDefault2">Default checked radio<p>An email will be sent to you every time there’s
                        new activity.</p>
                </label>
            </div>
        </div>
    </div>
    <div class="lm_noti-type text-start pt-4 pb-4">
        <div class="lm_noti-type-title">
            <h5 class="fw-bold mb-1">Notification Types</h5>
            <p class="mb-2">Select whether to receive notifications for the following activities..</p>
        </div>
        <hr>
        <div class="d-flex justify-content-between align-items-center">
            <div class="lm_noti-type-in">
                <p class="mb-0">Group Coaching Sessions</p><span>Cheers on quick posts, articles, questions, polls,
                    and comments you created.</span>
            </div>
            <div class="toggle-button-cover">
                <input class="checkbox notification_method" type="checkbox" name="notification_type[]" id="notification_type5" value="5" {{ (is_array($notification_array) && in_array('5', $notification_array)) ? ' checked' : '' }}>
            </div>
        </div>
        <hr>
        <div class="d-flex justify-content-between align-items-center">
            <div class="lm_noti-type-in">
                <p class="mb-0">Comments On Your Stuff</p><span>Comments on quick posts, articles, events,
                    questions, and polls you created.</span>
            </div>
            <div class="toggle-button-cover">
                <input class="checkbox notification_method" type="checkbox" name="notification_type[]" id="notification_type6" value="6" {{ (is_array($notification_array) && in_array('6', $notification_array)) ? ' checked' : '' }}>
            </div>
        </div>
        <hr>
        <div class="d-flex justify-content-between align-items-center">
            <div class="lm_noti-type-in">
                <p class="mb-0">Comments After You</p><span>Comments after your comment or replies after your
                    reply.</span>
            </div>
            <div class="toggle-button-cover"><input class="checkbox notification_method" type="checkbox" name="notification_type[]" id="notification_type7" value="7" {{ (is_array($notification_array) && in_array('7', $notification_array)) ? ' checked' : '' }}></div>
        </div>
    </div>
    <div class="lm_noti-type text-start pt-0">
        <div class="lm_noti-type-title">
            <h5 class="fw-bold mb-1">Space Notifications</h5>
            <p class="mb-3">You'll receive notifications for the following Spaces based on the notification types
                you chose above.</p>
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <div class="lm_noti-type-in">
                <p class="mb-0">Group Coaching Sessions </p>
            </div>
            <div class="toggle-button-cover">
                <input class="checkbox notification_method" type="checkbox" name="space_notification[]" id="space_notification8" value="8" {{ (is_array($notification_array) && in_array('8', $notification_array)) ? ' checked' : '' }}>
            </div>
        </div>
        <hr>
        <div class="d-flex justify-content-between align-items-center">
            <div class="lm_noti-type-in">
                <p class="mb-0">Masterclasses </p>
            </div>
            <div class="toggle-button-cover">
                <input class="checkbox notification_method" type="checkbox" name="space_notification[]" id="space_notification9" value="9" {{ (is_array($notification_array) && in_array('9', $notification_array)) ? ' checked' : '' }}>
            </div>
        </div>
        <hr>
        <div class="d-flex justify-content-between align-items-center">
            <div class="lm_noti-type-in">
                <p class="mb-0">Network FAQs </p>
            </div>
            <div class="toggle-button-cover">
                <input class="checkbox notification_method" type="checkbox" name="space_notification[]" id="space_notification10" value="10" {{ (is_array($notification_array) && in_array('10', $notification_array)) ? ' checked' : '' }}>
            </div>
        </div>
        <hr>
    </div> --}}
</div>
</div>


{{-- End Notification --}}

        

<div class="offcanvas offcanvas-end lm_profile-modal lm_create-modal" id="offcanvasRight5" tabindex="-1"
aria-labelledby="offcanvasRightLabel">
<div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasRightLabel">Skip</h5><button class="btn-close" type="button"
        data-bs-dismiss="offcanvas" aria-label="Close"></button>
</div>
<div class="offcanvas-body p-0">
    <div class="lm_profile-modal p-2">
        <div class="row align-items-center">
            <div class="col-8 text-end pe-5">
                <h5 class="text-white mb-0">Create Event</h5>
            </div>
            <div class="col-4 text-end"><button class="btn-link">Save to Drafts</button></div>
        </div>
    </div>
    <div class="lm_create-body">
        <form action="">
            <div class="mb-3"><label class="form-label me-3 mb-0 title-font h5">Event Title</label>
                <div class="form-control-icon position-relative"><input class="form-control icon shadow py-3"
                        type="text" placeholder="e.g. The Astronaut's Guide to Exercise"></div>
            </div>
            <div class="lm_noti p-0 mb-3">
                <div class="d-flex gap-2 align-items-center">
                    <p class="title-font mb-0 text-secondary">Also post in Feed</p>
                    <div class="d-flex gap-2 align-items-center">
                        <div class="toggle-button-cover"><input class="checkbox" type="checkbox" checked="checked">
                        </div>
                        <div class="tooltip-icon mb-1"><img src="{{asset('assets/images/que.svg')}}" alt="">
                            <div class="tooltiptext">Turning on RSVPs will allow members to select Going, Maybe, or
                                Not Going for your event.</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3 shadow rounded-4 p-3">
                <div class="d-flex justify-content-end"><a type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#setTimeZoneModal" aria-controls="setTimeZoneModal">
                        <p class="text-sm-12 mb-0">TIME ZONE:<span class="text-dark fw-bold">IST</span></p>
                    </a></div>
                <div class="row">
                    <div class="col-sm-6"><label class="form-label mb-2 title-font h5">Start</label>
                        <div class="form-control-icon position-relative"><input
                                class="form-control icon shadow py-3 ps-5" type="datetime-local">
                        </div>
                    </div>
                    <div class="col-sm-6"><label class="form-label mb-2 title-font h5">End</label>
                        <div class="form-control-icon position-relative"><input
                                class="form-control icon shadow py-3 ps-5" type="datetime-local">
                        </div>
                    </div>
                </div>
            </div>
            <div class="lm_noti p-0 mb-3">
                <div class="d-flex gap-2 align-items-center">
                    <p class="title-font mb-0 text-secondary">Repeat Event</p>
                    <div class="d-flex gap-2 align-items-center">
                        <div class="toggle-button-cover"><input class="checkbox" type="checkbox" checked="checked">
                        </div>
                        <div class="tooltip-icon mb-1"><img src="{{asset('assets/images/que.svg')}}" alt="">
                            <div class="tooltiptext">Turning on RSVPs will allow members to select Going, Maybe, or
                                Not Going for your event.</div>
                        </div>
                    </div>
                </div>
            </div>
            <h5>Create Meeting</h5>
            <div class="lm_rsvp mb-3">
                <div class="lm_noti p-0 mb-3 lm__event-tab">
                    <div class="row justify-content-between">
                        <div class="col-md-6">
                            <ul class="nav nav-pills mb-3 nav-primary" id="pills-tab1" role="tablist">
                                <li class="nav-item" role="presentation"><button class="nav-link active"
                                        id="pills-meeting-tab" data-bs-toggle="pill" data-bs-target="#pills-meeting"
                                        type="button" role="tab" aria-controls="pills-meeting"
                                        aria-selected="true">Meeting</button></li>
                                <li class="nav-item" role="presentation"><button class="nav-link"
                                        id="pills-webinar-tab" data-bs-toggle="pill" data-bs-target="#pills-webinar"
                                        type="button" role="tab" aria-controls="pills-webinar"
                                        aria-selected="false">Webinar</button></li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group mb-3"><input class="form-control py-1 px-2" type="text"
                                    placeholder="test@gmail.com" value="test@gmail.com"
                                    aria-label="Recipient's username" aria-describedby="button-addon2"><button
                                    class="btn btn--danger py-1" id="button-addon2" type="button"
                                    data-bs-toggle="modal" data-bs-target="#exampleModal21">Unlink</button></div>
                        </div>
                        <div class="col-12">
                            <div class="tab-content" id="pills-tabContent1">
                                <div class="tab-pane fade show active" id="pills-meeting" role="tabpanel"
                                    aria-labelledby="pills-meeting-tab" tabindex="0">
                                    <div class="lm_priv mb-3">
                                        <div class="form-control-icon position-relative"><a class="w-100"
                                                type="button" data-bs-toggle="offcanvas"
                                                data-bs-target="#offcanvasRight6" aria-controls="offcanvasRight6">
                                                <input class="form-control icon shadow py-3" type="text"
                                                    placeholder="Manage Zoom Meeting Options"></a></div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-webinar" role="tabpanel"
                                    aria-labelledby="pills-webinar-tab" tabindex="0">
                                    <div class="lm_priv mb-3">
                                        <div class="form-control-icon position-relative"><a class="w-100"
                                                type="button" data-bs-toggle="offcanvas"
                                                data-bs-target="#offcanvasRight7" aria-controls="offcanvasRight7">
                                                <input class="form-control icon shadow py-3" type="text"
                                                    placeholder="Manage Zoom Webinar Options"></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lm_noti p-0 mb-3">
                <div class="d-flex gap-2 align-items-center">
                    <h6 class="title-font fw-bold mb-0 text-secondary text-dark">RSVPs</h6>
                    <div class="d-flex gap-2 align-items-center">
                        <div class="toggle-button-cover"><input class="checkbox" type="checkbox" checked="checked"
                                onclick="mycheck()"></div>
                        <div class="tooltip-icon mb-1"><img src="{{asset('assets/images/que.svg')}}" alt="">
                            <div class="tooltiptext">Turning on RSVPs will allow members to select Going, Maybe, or
                                Not Going for your event.</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lm_rsvp mb-3">
                <div class="lm_noti p-0 mb-3">
                    <div class="d-flex gap-2 align-items-center">
                        <h6 class="title-font fw-bold mb-0 text-secondary text-dark">Restrict Event Link</h6>
                        <div class="d-flex gap-2 align-items-center">
                            <div class="toggle-button-cover"><input class="checkbox" type="checkbox"
                                    checked="checked"></div>
                            <div class="tooltip-icon mb-1"><img src="{{asset('assets/images/que.svg')}}" alt="">
                                <div class="tooltiptext">Turning on RSVPs will allow members to select Going, Maybe,
                                    or Not Going for your event</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lm_noti p-0">
                    <div class="d-flex gap-2 align-items-center">
                        <h6 class="title-font fw-bold mb-0 text-secondary text-dark">Close RSVPs</h6>
                        <div class="d-flex gap-2 align-items-center">
                            <div class="toggle-button-cover"><input class="checkbox" type="checkbox"
                                    checked="checked"></div>
                            <div class="tooltip-icon mb-1"><img src="{{asset('assets/images/que.svg')}}" alt="">
                                <div class="tooltiptext">Turning on RSVPs will allow members to select Going, Maybe,
                                    or Not Going for your event</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h5 class="fw-bold">About Event</h5>
            <div class="lm_noti p-0 mb-3">
                <div class="d-flex gap-2 align-items-center mb-1">
                    <p class="text-sm-12 mb-1 title-font">Header Image or Video</p>
                    <div class="d-flex gap-2 align-items-center">
                        <div class="tooltip-icon mb-1"><img src="{{asset('assets/images/que.svg')}}" alt="">
                            <div class="tooltiptext">Turning on RSVPs will allow members to select Going, Maybe, or
                                Not Going for your event</div>
                        </div>
                    </div>
                </div>
                <div class="event-img"> <img src="{{asset('assets/images/event-img-02.jpg')}}" alt=""></div>
                <div class="lm_upld">
                    <div class="input-group mb-0"><label class="input-group-text p-0 mb-0"
                            for="inputGroupFile01">Upload Header Image or Video</label><input class="form-control"
                            id="inputGroupFile01" type="file"></div>
                </div>
            </div>
            <div class="lm_noti p-0 mb-3">
                <div class="d-flex gap-2 align-items-center mb-1">
                    <p class="text-sm-12 mb-1 title-font">Thumbnail Image</p>
                    <div class="d-flex gap-2 align-items-center">
                        <div class="tooltip-icon mb-1"><img src="{{asset('assets/images/que.svg')}}" alt="">
                            <div class="tooltiptext">Turning on RSVPs will allow members to select Going, Maybe, or
                                Not Going for your event</div>
                        </div>
                    </div>
                </div>
                <div class="event-img-2"><img src="{{asset('assets/images/event-img-01.jpg')}}" alt=""></div>
                <div class="lm_upld">
                    <div class="input-group mb-0"><label class="input-group-text p-0 mb-0"
                            for="inputGroupFile01">Upload Thumbnail</label><input class="form-control"
                            id="inputGroupFile01" type="file"></div>
                </div>
            </div>
            <div class="mb-3"> <textarea class="ckplot" id="ckplot" name="editor2"></textarea></div>
            <div class="d-flex justify-content-center lm__eve-btn gap-2"><button class="btn btn--primary eve-btn"
                    type="submit">Create Event</button><button class="btn btn--primary eve-btn-round"> <span> <img
                            class="in-svg" src="{{asset('assets/images/calander.svg')}}" alt=""></span></button></div>
        </form>
    </div>
</div>
</div>
<div class="offcanvas offcanvas-end lm_profile-modal lm_create-modal" id="offcanvasRight6" tabindex="-1"
aria-labelledby="offcanvasRightLabel">
<div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasRightLabel">Skip</h5><button class="btn-close" type="button"
        data-bs-dismiss="offcanvas" aria-label="Close"></button>
</div>
<div class="offcanvas-body p-0">
    <div class="lm_profile-modal p-2">
        <div class="row align-items-center">
            <div class="col-12 text-center">
                <h5 class="text-white mb-0">Meeting Options</h5>
            </div>
        </div>
    </div>
    <div class="lm_create-body">
        <form action="#">
            <div class="lm_zoom-logo mb-5"> <img src="{{asset('assets/images/zoom-logo.png')}}" alt=""></div>
            <div class="lm__meetting mb-3">
                <h5 class="mb-2">Meeting Id</h5>
                <div class="form-check d-flex gap-2"><input class="form-check-input" id="flexRadioDefaultc1"
                        type="radio" name="flexRadioDefault"><label
                        class="form-check-label d-block w-100 mb-0 h6 text-secondary fw-normal"
                        for="flexRadioDefaultc1">Generate Automatically</label></div>
                <div class="form-check d-flex gap-2"><input class="form-check-input mb-0" id="flexRadioDefaultc2"
                        type="radio" name="flexRadioDefault"><label
                        class="form-check-label d-block w-100 h6 text-secondary fw-normal"
                        for="flexRadioDefaultc2">Personal Meeting ID<span
                            class="text-dark fw-bold">8355091034</span></label></div>
            </div>
            <div class="lm__meetting mb-3">
                <h5 class="mb-2">Meeting Options</h5>
                <div class="lm_noti p-0 mb-3">
                    <div class="d-flex gap-2 align-items-center mb-1">
                        <div class="d-flex gap-2 align-items-center">
                            <div class="toggle-button-cover"><input class="checkbox" type="checkbox"></div>
                            <h6 class="mb-1 text-secondary">Enable join before Host</h6>
                            <div class="tooltip-icon mb-1"><img src="{{asset('assets/images/que.svg')}}" alt="">
                                <div class="tooltiptext">Turning on RSVPs will allow members to select Going, Maybe,
                                    or Not Going for your event</div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex gap-2 align-items-center mb-1">
                        <div class="d-flex gap-2 align-items-center">
                            <div class="toggle-button-cover"><input class="checkbox" type="checkbox"></div>
                            <h6 class="mb-1 text-secondary">Mute participants upon entry</h6>
                            <div class="tooltip-icon mb-1"><img src="{{asset('assets/images/que.svg')}}" alt="">
                                <div class="tooltiptext">Turning on RSVPs will allow members to select Going, Maybe,
                                    or Not Going for your event</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lm__meetting mb-3">
                <h5 class="mb-2">Security</h5>
                <div class="lm_noti p-0 mt-1">
                    <div class="d-flex gap-2 align-items-center">
                        <div class="toggle-button-cover"><input class="checkbox" type="checkbox"></div>
                        <h6 class="mb-1 text-secondary">Require meeting password</h6>
                        <div class="tooltip-icon mb-1"><img src="{{asset('assets/images/que.svg')}}" alt="">
                            <div class="tooltiptext">Turning on RSVPs will allow members to select Going, Maybe, or
                                Not Going for your event</div>
                        </div>
                    </div>
                </div>
                <div class="form-control-icon position-relative my-3"><input class="form-control icon shadow py-3"
                        type="text" placeholder="123456"></div>
                <div class="lm_noti p-0">
                    <div class="d-flex gap-2 align-items-center">
                        <div class="toggle-button-cover"><input class="checkbox" type="checkbox"></div>
                        <h6 class="mb-1 text-secondary">Enable waiting room</h6>
                        <div class="tooltip-icon mb-1"><img src="{{asset('assets/images/que.svg')}}" alt="">
                            <div class="tooltiptext">Turning on RSVPs will allow members to select Going, Maybe, or
                                Not Going for your event</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lm__meetting mb-3">
                <h5 class="mb-2">Video</h5>
                <div class="lm_noti p-0 mt-1">
                    <div class="d-flex gap-2 align-items-center">
                        <div class="toggle-button-cover"><input class="checkbox" type="checkbox"></div>
                        <h6 class="mb-1 text-secondary">Host</h6>
                        <div class="tooltip-icon mb-1"><img src="{{asset('assets/images/que.svg')}}" alt="">
                            <div class="tooltiptext">Turning on RSVPs will allow members to select Going, Maybe, or
                                Not Going for your event</div>
                        </div>
                    </div>
                </div>
                <div class="lm_noti p-0 mt-1">
                    <div class="d-flex gap-2 align-items-center">
                        <div class="toggle-button-cover"><input class="checkbox" type="checkbox"></div>
                        <h6 class="mb-1 text-secondary">Participant</h6>
                        <div class="tooltip-icon mb-1"><img src="{{asset('assets/images/que.svg')}}" alt="">
                            <div class="tooltiptext">Turning on RSVPs will allow members to select Going, Maybe, or
                                Not Going for your event</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lm__meetting mb-3">
                <h5 class="mb-2">Record Meeting</h5>
                <div class="d-flex gap-3 flex-wrap">
                    <div class="form-check d-flex gap-2"><input class="form-check-input" id="flexRadioDefaultc3"
                            type="radio" name="flexRadioDefault"><label
                            class="form-check-label d-block w-100 mb-0 h6 text-secondary fw-normal"
                            for="flexRadioDefaultc3">Don't Record</label></div>
                    <div class="form-check d-flex gap-2"><input class="form-check-input mb-0"
                            id="flexRadioDefaultc4" type="radio" name="flexRadioDefault"><label
                            class="form-check-label d-block w-100 h6 text-secondary fw-normal"
                            for="flexRadioDefaultc4">Zoom Cloud</label></div>
                    <div class="form-check d-flex gap-2"><input class="form-check-input mb-0"
                            id="flexRadioDefaultc5" type="radio" name="flexRadioDefault"><label
                            class="form-check-label d-block w-100 h6 text-secondary fw-normal"
                            for="flexRadioDefaultc5">Zoom Cloud</label></div>
                </div>
            </div>
            <div class="d-flex justify-content-center lm__eve-btn gap-2"><button class="btn btn--primary eve-btn"
                    type="submit">Done</button></div>
        </form>
    </div>
</div>
</div>
<div class="offcanvas offcanvas-end lm_profile-modal lm_create-modal" id="offcanvasRight7" tabindex="-1"
aria-labelledby="offcanvasRightLabel">
<div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasRightLabel">Skip</h5><button class="btn-close" type="button"
        data-bs-dismiss="offcanvas" aria-label="Close"></button>
</div>
<div class="offcanvas-body p-0">
    <div class="lm_profile-modal p-2">
        <div class="row align-items-center">
            <div class="col-12 text-center">
                <h5 class="text-white mb-0">Webinar Options</h5>
            </div>
        </div>
    </div>
    <div class="lm_create-body">
        <form action="#">
            <div class="lm_zoom-logo mb-5"> <img src="{{asset('assets/images/zoom-logo.png')}}" alt=""></div>
            <div class="lm__meetting mb-3">
                <h5 class="mb-2">Webinar Options</h5>
                <div class="lm_noti p-0 mb-3">
                    <div class="d-flex gap-2 align-items-center mb-1">
                        <div class="d-flex gap-2 align-items-center">
                            <div class="toggle-button-cover"><input class="checkbox" type="checkbox"></div>
                            <h6 class="mb-1 text-secondary">Enable join before Host</h6>
                            <div class="tooltip-icon mb-1"><img src="{{asset('assets/images/que.svg')}}" alt="">
                                <div class="tooltiptext">Turning on RSVPs will allow members to select Going, Maybe,
                                    or Not Going for your event</div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex gap-2 align-items-center mb-1">
                        <div class="d-flex gap-2 align-items-center">
                            <div class="toggle-button-cover"><input class="checkbox" type="checkbox"></div>
                            <h6 class="mb-1 text-secondary">Mute participants upon entry</h6>
                            <div class="tooltip-icon mb-1"><img src="{{asset('assets/images/que.svg')}}" alt="">
                                <div class="tooltiptext">Turning on RSVPs will allow members to select Going, Maybe,
                                    or Not Going for your event</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lm__meetting mb-3">
                <h5 class="mb-2">Security</h5>
                <div class="lm_noti p-0 mt-1">
                    <div class="d-flex gap-2 align-items-center">
                        <div class="toggle-button-cover"><input class="checkbox" type="checkbox"></div>
                        <h6 class="mb-1 text-secondary">Require meeting password</h6>
                        <div class="tooltip-icon mb-1"><img src="{{asset('assets/images/que.svg')}}" alt="">
                            <div class="tooltiptext">Turning on RSVPs will allow members to select Going, Maybe, or
                                Not Going for your event</div>
                        </div>
                    </div>
                </div>
                <div class="form-control-icon position-relative my-3"><input class="form-control icon shadow py-3"
                        type="text" placeholder="123456"></div>
            </div>
            <div class="lm__meetting mb-3">
                <h5 class="mb-2">Video</h5>
                <div class="lm_noti p-0 mt-1">
                    <div class="d-flex gap-2 align-items-center">
                        <div class="toggle-button-cover"><input class="checkbox" type="checkbox"></div>
                        <h6 class="mb-1 text-secondary">Host</h6>
                        <div class="tooltip-icon mb-1"><img src="{{asset('assets/images/que.svg')}}" alt="">
                            <div class="tooltiptext">Turning on RSVPs will allow members to select Going, Maybe, or
                                Not Going for your event</div>
                        </div>
                    </div>
                </div>
                <div class="lm_noti p-0 mt-1">
                    <div class="d-flex gap-2 align-items-center">
                        <div class="toggle-button-cover"><input class="checkbox" type="checkbox"></div>
                        <h6 class="mb-1 text-secondary">Participant</h6>
                        <div class="tooltip-icon mb-1"><img src="{{asset('assets/images/que.svg')}}" alt="">
                            <div class="tooltiptext">Turning on RSVPs will allow members to select Going, Maybe, or
                                Not Going for your event</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lm__meetting mb-3">
                <h5 class="mb-2">Record Webinar</h5>
                <div class="d-flex gap-3 flex-wrap">
                    <div class="form-check d-flex gap-2"><input class="form-check-input" id="flexRadioDefaultc3"
                            type="radio" name="flexRadioDefault1"><label
                            class="form-check-label d-block w-100 mb-0 h6 text-secondary fw-normal"
                            for="flexRadioDefaultc3">Don't Record</label></div>
                    <div class="form-check d-flex gap-2"><input class="form-check-input mb-0"
                            id="flexRadioDefaultc4" type="radio" name="flexRadioDefault1"><label
                            class="form-check-label d-block w-100 h6 text-secondary fw-normal"
                            for="flexRadioDefaultc4">Zoom Cloud</label></div>
                    <div class="form-check d-flex gap-2"><input class="form-check-input mb-0"
                            id="flexRadioDefaultc5" type="radio" name="flexRadioDefault1"><label
                            class="form-check-label d-block w-100 h6 text-secondary fw-normal"
                            for="flexRadioDefaultc5">Zoom Cloud</label></div>
                </div>
            </div>
            <div class="d-flex justify-content-center lm__eve-btn gap-2"><button class="btn btn--primary eve-btn"
                    type="submit">Done</button></div>
        </form>
    </div>
</div>
</div>
<div class="offcanvas offcanvas-end lm_profile-modal lm_create-modal" id="offcanvasRight8" tabindex="-1"
aria-labelledby="offcanvasRightLabel">
<div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasRightLabel">Skip</h5><button class="btn-close" type="button"
        data-bs-dismiss="offcanvas" aria-label="Close"></button>
</div>
<div class="offcanvas-body p-0">
    <div class="lm_profile-modal p-2">
        <div class="row align-items-center">
            <div class="col-12 text-center">
                <h5 class="text-white mb-0">Create Event</h5>
            </div>
        </div>
    </div>
    <div class="lm_create-body">
        <form action="#">
            <div class="lm_mxw5 mx-0">
                <div class="d-block lm__form-input radio">
                    <div class="form-check d-flex gap-2"><input class="form-check-input" id="flexRadioDefaultc5"
                            type="radio" name="flexRadioDefault"><label class="form-check-label d-block"
                            for="flexRadioDefaultc5">
                            <div class="d-block text-start">
                                <h6 class="mb-1">Post Now</h6>
                                <p class="mb-2 text-secondary title-font">Post immediately after the "Post" button
                                    is clicked.</p>
                            </div>
                        </label></div>
                    <div class="form-check d-block"><input class="form-check-input" id="flexRadioDefaultc6"
                            type="radio" name="flexRadioDefault" checked=""><label class="form-check-label d-block"
                            for="flexRadioDefaultc6">
                            <div class="d-block text-start">
                                <h6 class="mb-1">Schedule Post</h6>
                                <p class="mb-2 text-secondary title-font">Post immediately after the "Post" button
                                    is clicked.</p>
                            </div>
                        </label></div>
                </div>
                <div class="lm__form-input">
                    <div class="d-flex mb-3 align-items-center gap-3"><label
                            class="form-label me-3 mb-0 title-font">Date & Time</label>
                        <div class="position-relative"><input
                                class="form-control icon shadow py-3 ps-5" type="datetime-local">
                        </div>
                    </div>
                </div>
                <div class="d-flex gap-5">
                    <h6>Timezone</h6>
                    <h6>Asia/Calcutta</h6>
                </div>
                <div class="d-flex justify-content-center align-items-center flex-column"><button
                        class="btn btn--primary mt-3 btn-save">Save Setting</button><button
                        class="btn-close d-block w-100 mt-2 btn-cancle" type="button" data-bs-dismiss="offcanvas"
                        aria-label="Close">Cancel</button></div>
            </div>
        </form>
    </div>
</div>
</div>
<div class="offcanvas offcanvas-end lm_profile-modal lm_create-modal" id="setTimeZoneModal" tabindex="-1"
aria-labelledby="offcanvasRightLabel">
<div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasRightLabel">Skip</h5><button class="btn-close" type="button"
        data-bs-dismiss="offcanvas" aria-label="Close"></button>
</div>
<div class="offcanvas-body p-0">
    <div class="lm_profile-modal p-2">
        <div class="row align-items-center">
            <div class="col-12 text-center">
                <h5 class="text-white mb-0">Create Event</h5>
            </div>
        </div>
    </div>
    <div class="lm_create-body">
        <form action="#">
            <h4 class="fw-bold">Time Zone</h4>
            <p class="mb-2 text-secondary title-font">For most events members will see the event's time converted to
                their local time. Local Events will indicate if the event's time zone, set below, differs from the
                member's local time.</p>
                
                @php $timeZones = timeZoneList(); @endphp
                <select id="time_zone" class="form-select form-control shadow timezone_id js-example-basic-single" aria-label="Default select example" required>
                  <option value="">---Timezone---</option>
                  @foreach ($timeZones as $timezone)
                  
                @php $selected = ''; @endphp
                @if( $timezone->id== $user->timezone_id )
                @php $selected = 'selected="selected"'; @endphp
                @endif
                    <option value="{{ $timezone->id }}" {{ $selected }}>{{ $timezone->timezone . ' (' . $timezone->gmt_offset . ' )' }}</option>
                  @endforeach
                </select>
                
            <div class="d-flex justify-content-center align-items-center flex-column"><button
                    class="btn btn--primary mt-3 btn-save">Save Setting</button><button
                    class="btn-close d-block w-100 mt-2 btn-cancle" type="button" data-bs-dismiss="offcanvas"
                    aria-label="Close">Cancel</button></div>
        </form>
    </div>
</div>
</div>

<div class="modal fade" id="exampleModal211" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered lm__modal-4">
    <div class="modal-content overflow-hidden">
        <div class="modal-body p-4 text-center position-relative">
            <div class="modal-header p-0"><button class="btn-close" type="button" data-bs-dismiss="modal"
                    aria-label="Close"><span> <img class="in-svg" src="{{asset('assets/images/close.svg')}}"
                            alt=""></span></button></div>
            <div class="z-index-1 position-relative lm_mxw50">
                <h4 class="text-white">Are you sure you want to unlink this Zoom Account?</h4>
                <p class="my-3 text-secondary title-font">You’re about to unlink the account: test@gmail.com. This
                    change will have the following effects:</p>
                <ul class="text-primary text-start">
                    <li class="py-2">
                        <p class="mb-0 title-font">You'll no longer be able to create Zoom events here in PEEQ. </p>
                    </li>
                    <li class="py-2">
                        <p class="mb-0 title-font">All Zoom events you previously created with this Zoom account
                            will be changed to the Meeting event type, but the original Zoom link will be preserved.
                        </p>
                    </li>
                    <li class="py-2">
                        <p class="mb-0 title-font">Zoom events created in PEEQ will no longer be kept
                            in sync with your events list at Zoom.us. </p>
                    </li>
                </ul><button class="btn btn--primary mt-3 title-font">Yes, Unlink Account</button><button
                    class="btn-close text-white d-block w-100 mt-2 title-font" type="button" data-bs-dismiss="modal"
                    aria-label="Close">cancle</button>
            </div>
        </div>
    </div>
</div>
</div>


<div class="modal fade" id="exampleModal24" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <p class="mb-3 text-white">PEEQ Global<br>Leadership Network</p>
                        <div class="lm_price">
                            <h6 class="text-primary mb-0 fw-bold">$499.99</h6>
                            <p class="mb-3 text-light">AUD / month</p>
                        </div>
                    </div>
                    <p class="mb-1 text-light">Monthly subscription starting<br>Sat, Feb 4, 2023</p>
                    <hr class="my-3">
                    <div class="d-flex justify-content-between text-start">
                        <p class="mb-2 text-white fw-bold">Due Today</p>
                        <div class="lm_price">
                            <h6 class="text-primary mb-0 fw-bold">$0.00</h6>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between text-start">
                        <p class="text-sm mb-0 text-light">Due Later</p>
                        <div class="lm_price">
                            <p class="mb-0 text-light">$499.99 AUD</p>
                        </div>
                    </div>
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
                            <div class="col col-md-12 text-center my-3 mt-2"><a
                                    class="moreless-button d-flex justify-content-center">Have a Referral Code
                                    <span> <img class="in-svg" src="{{asset('assets/images/arrow.svg')}}" alt=""></span></a>
                            </div>
                            <div class="col col-md-12 moretext">
                                <div class="lm__form-input mb-4"> <input class="form-control" type="text"
                                        placeholder="code"></div>
                            </div>
                            <div class="col col-md-12">
                                <div class="d-flex align-items-center mb-3"> <img class="in-svg"
                                        src="{{asset('assets/images/lock1.svg')}}" alt="">
                                    <p class="text-light mb-0 ms-1">Card information is stored on a secure server
                                    </p>
                                </div>
                            </div>
                            <div class="col col-md-12">
                                <div class="lm__form--button"> <button class="btn btn--primary" type="submit"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal2">Submit</button></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

{{-- @php $timeZones = timeZoneList($user->location_id); @endphp --}}
{{-- {{ dd($timeZones) }} --}}

{{-- start user profile Edit Popup --}}
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"> </script> --}}

<div class="offcanvas offcanvas-end lm_profile-modal" id="offcanvasRight1" tabindex="-1" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasRightLabel"><a href="#"></a></h5>
      <button class="btn-close" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
      <form  method="POST" id="update_user_profile_form" enctype="multipart/form-data">
        
        <input type="hidden" value="{{ $user->id }}" name="user_id" class="user_id">
        <input type="hidden" value="1" name="step_update" class="step_update">
        <input type="hidden" value="1" name="is_website">
        
        @csrf
        <div class="lm_profile-modal p-2">
          <div class="row align-items-center">
            <div class="col-8 text-end"> 
              <h5 class="text-white mb-0">Complete Your Profile</h5>
            </div>
            <div class="col-4 text-end">
              <button class="btn btn--primary py-2" id="update_user_profile_button" data-id="{{ $user->id }}">Save</button>
            </div>
          </div>
        </div>
        <div class="lm_profile-img position-relative">
            <div class="cover-wraper">
                <img src="{{($user->cover_image_url) ?? asset('assets/images/profile.png') }}" alt="" class="preview-image-before-upload-cover" style="width:100%; height:200px;">
                <label for="cover_upload" class="position-absolute bottom-0 w-100">
                    <input type="file" name="cover_image" style="display: none;" id="cover_upload" accept=".png, .jpg, .jpeg"/>
                    <span class="position-absolute bottom-0 end-0 p-1 edit-icon"    ><img class="in-svg" src="{{ asset('assets/images/edit.svg') }}" id="cover_image" alt=""></span>
                </label>
            </div>
          {{-- @if(!empty($user->cover_image)) --}}
          
          {{-- @else --}}
            {{-- <img src="{{ asset('assets/images/cover.png') }}" id="preview-image-before-upload-cover" src=""><span class="position-absolute bottom-0 end-0 pe-2 pb-2"><a href="#"> <img class="in-svg" id="cover_image" src="{{ asset('assets/images/edit.svg') }}" alt=""></a></span> --}}
          {{-- <img src="{{ asset('assets/images/profile.jpg') }}" alt=""><span class="position-absolute bottom-0 end-0 pe-2 pb-2"><a href="#"> <img class="in-svg" id="cover_image" src="{{ asset('assets/images/edit.svg') }}" alt=""></a></span>                           --}}
          {{-- @endif --}}
        </div>
        <div class="lm_profile-img1 shadow bg-white p-0 overflow-hidden img22">
            <label for="profile_upload" class="position-absolute bottom-0 end-0 p-1 mb-0">
                <input type="file" name="profile_image" style="display: none;" id="profile_upload" accept=".png, .jpg, .jpeg"/>
                <span class="edit-icon d-inline-block mb-0"><img class="in-svg" src="{{ asset('assets/images/edit.svg') }}" id="profile_image" alt=""></span>
            </label>
            {{-- @if(!empty($user->profile_image)) --}}
            <img src="{{($user->profile_image_url) ?? asset('assets/images/logo2.svg') }}" class ="profile_image h-100 w-100" alt="" >
            
            {{-- @else --}}
          {{-- <img src="{{ asset('assets/images/profile.png') }}" id="preview-image-before-upload" src=""><span class="position-absolute bottom-0 end-0 pe-2 pb-2"><a href="#"> <img class="in-svg" id="profile_image" src="{{ asset('assets/images/edit.svg') }}" alt=""></a></span> --}}
          {{-- <img src="{{ asset('assets/images/logo2.svg') }}" alt=""><span class="position-absolute bottom-0 end-0 pe-2 pb-2"><a href="#"> <img class="in-svg" id="profile_image" src="{{ asset('assets/images/edit.svg') }}" alt=""></a></span>                           --}}
          {{-- @endif --}}
        </div>
        <div class="lm__profile-form">
          <p class="mb-2"><h5 style="text-align: left;">Personal Settings</h5><span class="error" style="color: red;"></span></p>
          
          <div class="row g-4">
              <div class="col-md-6">
                <input class="form-control shadow" id="inputfname_edit" type="text" value="{{ $user->first_name }}" placeholder="First Name" name="first_name" required>
                <div class="invalid-feedback position-absolute first_name" role="alert"></div>
              </div>
              <div class="col-md-6">
                <input class="form-control shadow" id="inputsname_edit" type="text" value="{{ $user->last_name }}" placeholder="Last Name" name="last_name" required>
                <div class="invalid-feedback position-absolute first_name" role="alert"></div>
              </div>
              <div class="col-md-6">
                <input class="form-control shadow" id="inputjob-title_edit" type="text" value="{{ $user->job_title }}" placeholder="Job Title" name="job_title">
              </div>
              <div class="col-md-6">
                <input class="form-control shadow" id="inputcomname_edit" type="text" value="{{ $user->company_name }}" placeholder="Company Name" name="company_name">
              </div>
              <div class="col-12">
                <textarea class="form-control shadow rounded-3" id="about_me_edit" rows="3" placeholder="Bio" name="bio">{{ $user->bio }}</textarea>
              </div>
              <div class="col-12 text-start">
                <p class="mb-2">Why here? </p>
                <div class="hstack gap-3">
                    <div class="lm__term">
                      <label class="lm-check-term ps-4 mb-0 lh-1">Leadership Development<input type="checkbox" name="leadership_development" value="1" {{ ($user->leadership_development==1) ? 'checked' : '' }} id="leadership_development_edit">
                        <span class="checkmark"></span></label>
                    </div>
                    <div class="lm__term">
                      <label class="lm-check-term ps-4 mb-0 lh-1">Self Development<input type="checkbox" name="self_development" value="1" {{ ($user->self_development==1) ? 'checked' : '' }} id="self_development_edit">
                        <span class="checkmark"></span></label>
                    </div>
                    <div class="lm__term">
                      <label class="lm-check-term ps-4 mb-0 lh-1">Culture Uplift<input type="checkbox" name="culture_uplift" value="1" {{ ($user->culture_uplift==1) ? 'checked' : '' }} id="culture_uplift_edit">
                        <span class="checkmark"></span></label>
                    </div>
                    <div class="lm__term">
                      <label class="lm-check-term ps-4 mb-0 lh-1">Networking<input type="checkbox" name="networking" value="1" {{ ($user->networking==1) ? 'checked' : '' }} id="networking_edit">
                        <span class="checkmark"></span></label>
                    </div>
                </div>
              </div>
        
              <div class="col-12 text-start">
                <label class="form-label">Simply copy your social or personal link URL and add it here.</label>
                <div class="d-flex">
                  <input class="form-control shadow" type="text" name="personal_link[]" placeholder="Personal Links" value="">
                  <span class="lm_form-add shadow ms-3"><button type="submit"  style="border: none;  cursor: pointer; appearance: none;background-color: inherit;" class="add"><img src="{{ asset('assets/images/plus2.svg') }}" alt=""></button></span>
                  </div><br>

                @php
                $personal_link_array = explode(',', $user->personal_link); $i = 1; @endphp
                @foreach($personal_link_array as $info)
                @php $i++; @endphp
                  @if(!empty($info))
                  <span id="personal_link_dynamic{{ $i }}">
                    <div class="d-flex">
                      <input class="form-control shadow" type="text" name="personal_link[]" placeholder="Personal Links" value="{{ $info }}"><br/><span class="lm_form-add shadow ms-3 remove_added_dynamic" id="{{ $i }}"><img src="{{asset('assets/images/trash.svg')}}" alt=""></span>
                      </div><br></span>
                  @endif
                  @endforeach
                <div class="append_personal_link"></div>
              </div>
              
              <div class="col-md-4"> 
                @php $countries = countryList(); @endphp
                <select class="form-select form-control shadow location_id js-example-basic-single" id="location_edit" name="location_id" aria-label="Default select example" required>
                  <option value="" selected>---Location---</option>
                  @foreach ($countries as $country)
                  
                    @php $selected = ''; @endphp
                    @if( $country->id== $user->location_id )
                    @php $selected = 'selected="selected"'; @endphp
                    @endif
                   
  
                    <option value="{{ $country->id }}" {{ $selected }}>{{ $country->country_name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-8 text-start">
                <!-- <label for=""> This is used to determine when to send you notifications.</label> -->
                
                @php $timeZones = timeZoneList($user->location_id); @endphp
                <select class="form-select form-control shadow timezone_id js-example-basic-single" id="timezone_edit" name="timezone_id" aria-label="Default select example" required>
                    @foreach ($timeZones as $timezone)
                        @php $selected = ''; @endphp
                        @if( $timezone->id== $user->timezone_id )
                        @php $selected = 'selected="selected"'; @endphp
                        @endif
                        <option value="{{ $timezone->id }}" {{ $selected }}>{{ $timezone->timezone . ' (' . $timezone->gmt_offset . ' )' }}</option>
                    @endforeach
                </select>
              </div>
              {{-- <option value="{{ $user->timezone->id }}">{{ $user->timezone->timezone . ' (' . $user->timezone->gmt_offset . ' )' }}</option> --}}
              
              {{-- 
                @php $timeZones = timeZoneList($user->location_id); @endphp
                @foreach ($timeZones as $timezone)
                  
              @php $selected = ''; @endphp
              @if( $timezone->id== $user->timezone_id )
              @php $selected = 'selected="selected"'; @endphp
              @endif
                  <option value="{{ $timezone->id }}" {{ $selected }}>{{ $timezone->timezone . ' (' . $timezone->gmt_offset . ' )' }}</option>
                @endforeach --}}
                
              {{-- <div class="col-12"> 
                <div class="lm_additional text-start"> 
                  <div class="d-flex align-items-center"><span class="badge text-bg-dark me-3">General</span>
                    <input class="form-control shadow" id="general" type="text" name="general[]" placeholder="General" value="">
                    <button class="btn lm_additional-btn shadow add_general" type="submit"><img class="in-svg" src="{{ asset('assets/images/plus-3.svg') }}" alt=""></button>
                  </div>
                </div>
                <br>
                @if(!empty($user->general))
                @php $general_array = explode(',', $user->general);  @endphp
                  @foreach($general_array as $info)
                    <div class="d-flex">
                      <input class="form-control shadow" id="general_edit" type="text" name="general[]" placeholder="General" value="{{ $info }}">
                    </div>
                    <br/>
                  @endforeach
                @endif
                <br>
              </div>
              <div class="append_general_link"></div>
              <div class="col-12"> 
                <div class="lm_additional text-start"> 
                  <p class="mb-2">Courses</p>
                  <div class="d-flex align-items-center"><span class="badge text-bg-dark me-3">Course</span>
                    <input class="form-control shadow" id="course" type="text" name="course[]" placeholder="Course" value="">
                    <button class="btn lm_additional-btn shadow add_course" type="submit"><img class="in-svg" src="{{ asset('assets/images/plus-3.svg') }}" alt=""></button>
                  </div>
                </div>
                <br>
                @php $course_array = explode(',', $user->course);  @endphp
                @foreach($course_array as $info)
                  @if(!empty($info))
                    <div class="d-flex">
                      <input class="form-control shadow" id="course_edit" type="text" name="course[]" placeholder="Course" value="{{ $info }}">
                    </div>
                    <br/>
                  @endif
                @endforeach
                <br>
              </div>
              <div class="append_course_link"></div> --}}
              {{-- <div class="col-12"> 
                <div class="lm_additional text-start"> 
                  <p class="mb-2">Find Resources</p>
                  <div class="d-flex align-items-center"><span class="badge text-bg-dark me-3">General</span>
                    <input class="form-control shadow" id="find_resource" type="text" name="find_resource[]" placeholder="Find Resourse" value="">
                    <button class="btn lm_additional-btn shadow add_find_resource" type="submit"><img class="in-svg" src="{{ asset('assets/images/plus-3.svg') }}" alt=""></button>
                  </div>
                </div>
                <br>
                @php $find_resource_array = explode(',', $user->find_resource);  @endphp
              @foreach($find_resource_array as $info)
                @if(!empty($info))
                    <div class="d-flex">
                      <input class="form-control shadow" id="find_resource_edit" type="text" name="find_resource[]" placeholder="Find Resourse" value="{{ $info }}">
                    </div>
                    <br/>
                @endif
              @endforeach
                <br>
              </div>
              <div class="append_find_resource_link"></div> --}}
          </div>
        </div>
      </form>
    </div>
  </div>
  
{{-- End user edit profile popup --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@include('layouts.admin.base.modals')

<script type="text/javascript">
    const froala_editor_key = '{{ config('app.froala_editor_key') }}';
</script>

<script>
function convertToUTC(dateTimeString) {
  // Assuming dateTimeString is in 'YYYY-MM-DD HH:mm' format
  const [date, time] = dateTimeString.split(' ');

  const [year, month, day] = date.split('-').map(Number);
  const [hours, minutes] = time.split(':').map(Number);

  // Create a Date object using the date and time parts
  const localDateTime = new Date(year, month - 1, day, hours, minutes);

  // Get the UTC time in milliseconds
  const utcTime = localDateTime.getTime() - (localDateTime.getTimezoneOffset() * 60000);

  // Create a new Date object for the UTC time
  const utcDateTime = new Date(utcTime);

  // Format the UTC date and time as 'YYYY-MM-DD HH:mm:ss'
  const formattedUTCDateTime = utcDateTime.toISOString().slice(0, 19).replace('T', ' ');

  return formattedUTCDateTime;
}

    $(document).ready(function() {
        
    $("#location_edit, #timezone_edit").select2({
        dropdownParent: $("#offcanvasRight1")
    });
    
             
    $('#location_edit').on('change', function() {
        var country_id = $(this).val();
        // console.log('location_edit' + country_id);
        
        var url = '{{ route("user.time_zones", ":country_id") }}';
        url = url.replace(':country_id', country_id);
        
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                var timezoneDropdown = $('#timezone_edit');
                timezoneDropdown.empty();
                if(response.status==200)
                {
                    $.each(response.data, function(index, timezone) {
                        console.log(timezone);
                        timezoneDropdown.append('<option value="' + timezone.id + '">' + timezone.timezone + '</option>');
                    });
                }
            }
        });
    });
                
    // Intercept the "keydown" event for the input fields
  $("#inputfname_edit, #inputsname_edit").on("keydown", function(event) {
    // Check for special characters (only allow letters and spaces)
    if (event.key.match(/[^A-Za-z\s]/)) {
      // Prevent the default behavior (stop the special character from being entered)
      event.preventDefault();
    }
  });
    
    //// Start Global Search function //
        
    $('#searchForm').on('submit', function(event) {
    event.preventDefault();
    var search_txt = $('#searchInput').val();
        if(search_txt=="")
        {
            var success_message = 'Search field cannot be empty.';                                    
                Swal.fire({
                    toast: true,
                    icon: 'warning',
                    title: success_message ,
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
        }
        $.ajax({
        url: '{{route("global.search")}}',
        method: 'GET',
        data: { term: search_txt },
        success: function(response) {
            window.location.href = '{{ route("global.search") }}'+'?term=' + search_txt;
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
        });
    });
    
    //// End Global Search function //   
    
    ////////////////////////// Update Profile //////////////////////////
    $('#update_user_profile_button').click(function(event) {
  
    event.preventDefault();
    
    $('.error').html('');
    console.log('edite profile submited');
    var formData = new FormData($("#update_user_profile_form")[0]);
  
    var first_name = $("#inputfname_edit").val();
    var last_name =  $("#inputsname_edit").val();                        
    var job_title = $('#update_user_profile_form input[name="job_title"]').val();
    var company_name = $('#update_user_profile_form input[name="company_name"]').val();
    var bio = $('#update_user_profile_form input[name="bio"]').val();
    var city =  $("#location_edit").val();
    var timezone_edit = $("#timezone_edit").val(); 
    var empty_name = $.trim($("#inputfname_edit").val()); 
    var empty_last_name = $.trim($("#inputsname_edit").val()); 
    var empty_job_title = $.trim($("#update_user_profile_form input[name='job_title']").val()); 
    var empty_company_name = $.trim($("#update_user_profile_form input[name='company_name']").val());  
        
    // $('#eventSettingForm input[name="is_header_image_or_video"]').prop('checked', event.is_header_image_or_video == 1);
        
        
        if(first_name==='')
        {
            $('.error').html('Please enter a first name');
            return false;    
        }
        else if(empty_name == '')
        {
            $('.error').html('First name can not be empty!');
            return false;    
        }
        if(last_name==='')
        {
            $('.error').html('Please enter a last name');
            return false;    
        }
        else if(empty_last_name == '')
        {
            $('.error').html('Last name can not be empty!');
            return false;
        }
        
        if(job_title==='')
        {
            $('.error').html('Please enter a job title.');
            return false;    
        }
        else if(empty_job_title == '')
        {
            $('.error').html('Job title can not be empty!');
            return false;
        }
        
        if(company_name==='')
        {
            $('.error').html('Please enter a company name.');
            return false;    
        }
        else if(empty_company_name == '')
        {
            $('.error').html('Company name can not be empty!');
            return false;
        }
        
        if(bio==='')
        {
            $('.error').html('Please enter a bio.');
            return false;    
        }
        
    // Helper function to check if at least one checkbox is checked in a group
  function isAtLeastOneCheckboxChecked(groupName) {
    return $('#update_user_profile_form input[name="' + groupName + '"]:checked').length > 0;
  }

  // Validate checkboxes
  
  if ((isAtLeastOneCheckboxChecked('leadership_development')===false) && (isAtLeastOneCheckboxChecked('self_development')===false) && (isAtLeastOneCheckboxChecked('culture_uplift')===false) && (isAtLeastOneCheckboxChecked('networking')===false))
  {
    $('.error').html('Please select at least one why here option.');
    return false;
  }

  // Helper function to get checkbox value
  function getCheckboxValue(checkboxName) {
    return $('#update_user_profile_form input[name="' + checkboxName + '"]').is(':checked') ? 1 : 0;
  }

  // Set checkbox values in formData
  formData.set('leadership_development', getCheckboxValue('leadership_development'));
  formData.set('self_development', getCheckboxValue('self_development'));
  formData.set('culture_uplift', getCheckboxValue('culture_uplift'));
  formData.set('networking', getCheckboxValue('networking'));
        
        
        if(city==='')
        {
            $('.error').html('Please select location.');
            return false;    
        }
        if(timezone_edit==='')
        {
            $('.error').html('Please select timezone.');
            return false;    
        }
           
        $("#update_user_profile").attr("disabled", true);
        var user_id = $('.user_id').val();
        var url = '{{ route("user.update", ":id") }}';
        url = url.replace(':id', user_id);
  
        $.ajax({
          url: url,
          type:"POST" ,
          headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
          data: formData,
          dataType: 'JSON',
          async: false,
          cache: false,
          contentType: false,
          processData: false,
          success:function(data)
          {
            // $('.btn-close').click();   
            $("#offcanvasRight1").offcanvas("hide");             
            console.log(data);
            $("#update_user_profile").attr("disabled", false); 
                          
            if(data.error) {
              printErrorMsg(data.error);
              console.log(data);
              return false;
            } else if(data.status == "200") {
                
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
                        
                        
                        $("#progress_step_path").addClass('progress-dash');
                        $(".steps-completed1").addClass('active');
                        
                        // $(".steps-completed2").addClass('active');
                        $(".welcomeList2").removeClass("lm_disable");
                        $(".welcomeList2").addClass('active');
                        /* user profile update save button click to open notification setting popup */
                        // $('#offcanvasRight2').offcanvas('show');
        
                        //getWelcomeChecklist();
                        // setTimeout( function(){
                        //     window.location.reload();
                        // }, 3000);
  
              
              
              }
          },
          error: function (xhr, status, error) {
              console.log(xhr.responseJSON.message);
            if (xhr.responseJSON && xhr.responseJSON.error) {
                $.each(xhr.responseJSON.error, function (key, item) {
                $("."+key).show();
                $("."+key).html(item);
                });
            } else {
                $('.error').html(xhr.responseJSON.message);
                console.log("An error occurred, but no error message was returned.");
            }
            }
  
        });
        
        function printErrorMsg (msg) {
            console.log(msg);
            // $(".print-error-msg").find("ul").html('');
            // $(".print-error-msg").css('display','block');
            // $.each( msg, function( key, value ) {
            //     $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            //     $('.content_error').html(value);
            //     $('.article_content_error').html(value);
            // });
        }
      });      
        
    });
    </script>
    
<script>
    
    function downloadApp()
    {
      let _token =  $("input[name=_token]").val();
      $.ajax({
        url: "{{route('download_app')}}",
        method: "GET",  
        data: {
          _token:_token
        }  
      }).done(function(data) {
        
        // $('.btn-close').click();
        $("#offcanvasRight3").offcanvas("hide");
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
                        
        
        // circle2 steps-completed2 active
        
        $(".steps-completed3").addClass('active');
        $(".welcomeList3").removeClass("lm_disable");
        $(".welcomeList3").addClass('active');
        
        
        // getWelcomeChecklist();
        // setTimeout( function(){
        //     window.location.reload();
        // }, 3000);
      });
    }

    /* Welcome Checklist Popup */
    $(document).ready(function () {
        var user_login = "{{ session()->get('first_login') }}";
        if (user_login == 1) {
        $('#welcomeModal').modal('show');
        } else {
        $('#welcomeModal').modal('hide');
        }
        //document.getElementById('first_login').value = 0;
    });
    /* show user profile update popup click welcome checklist continue button */
    // $('#show_profile').click(function () { 
    //     $('#offcanvasRight1').offcanvas('show');
    // });

    $(document).ready(function() {
    // When the file input changes
        $('#profile_upload').change(function() {
        // Get the selected file
        var file = this.files[0];
        
        // Check if a file is selected
        if (file) {
            // Create a FileReader object
            var reader = new FileReader();
            
            // Set the onload function
            reader.onload = function(e) {
            // Set the src attribute of the image tag to the loaded image data
            $('.profile_image').attr('src', e.target.result);
            }
            
            // Read the file as a data URL
            reader.readAsDataURL(file);
        }
        });

        $('#cover_upload').change(function() {
        // Get the selected file
        var file = this.files[0];
        
        // Check if a file is selected
        if (file) {
            // Create a FileReader object
            var reader = new FileReader();
            
            // Set the onload function
            reader.onload = function(e) {
            // Set the src attribute of the image tag to the loaded image data
            $('.preview-image-before-upload-cover').attr('src', e.target.result);
            }
            
            // Read the file as a data URL
            reader.readAsDataURL(file);
        }
        });
    });
       
    //////// Notification count //////////////
    // getNotificationcount();
    // function getNotificationcount()
    // { 
    //     $.ajax({
    //             url: "{{route('push.notifications')}}"
    //             , type: "get"
    //     })
    //     .done(function(data) {
    //         $("#notification_badge").html(data.data.notification_count);         
    //     })
    //     .fail(function(jqXHR, ajaxOptions, thrownError) {
    //         console.log('Server error occured');
    //     });
    // } 
</script>
<script>
    $(document).ready(function() {
        
        
    $("#toggleCheckbox").change(function() {
        if ($(this).is(":checked")) {
            $("#apple-div").addClass("d-none");
            $("#android-div").removeClass("d-none");
        }
        else
        {
            $("#android-div").addClass("d-none");
            $("#apple-div").removeClass("d-none");
        }
    });
            
            
        $('#app-download').click(function() {
        window.location.href = "{{ route('posts.index') }}";
        });
        
        
        var i = 1;
    $('.add').on('click', function() {
      i++;
        var link = '<span id="personal_link_static'+i+'"><div class="d-flex">' 
        link += '<input class="form-control shadow" type="text" name="personal_link[]" placeholder="Personal Links" value=""><br/><span class="lm_form-add shadow ms-3" onclick="remove_added_personal_link('+i+')"><img src="assets/images/trash.svg" alt=""></span>'
        link += '</div><br></span>'
        $('.append_personal_link').append(link)
        console.log(link);
        return false;
      });
      
      $('.remove_added_dynamic').on('click', function() { 
        var button_id = $(this).attr("id");            
        $('#personal_link_dynamic'+button_id+'').remove();
        return false;
      }); 
      
    });

    /* Remove Edit Profile Personal link button*/
    function remove_added_personal_link(id='')
    {
        var button_id = id;            
        $('#personal_link_static'+button_id+'').remove();
        return false;
    }
    $(function() {
        $('[data-bs-toggle="tooltip"]').tooltip({
            trigger: 'hover',
        });
    });
    $(function() {
        $('[data-bs-toggle="tooltip"]').hover(function () {
            var tooltipTitle = $(this).attr('data-bs-original-title');
            $(this).attr('title', '');
            $(this).tooltip({ title: tooltipTitle }).tooltip('show');
        }, function () {
            $(this).tooltip('hide');
        });
    });


    // Focus on select2 search
    // $(document).on('select2:open', () => {
    //     document.querySelector('.select2-search__field').focus();
    // });

    $(document).on('select2:open', (e) => {
    const selectId = e.target.id

        $(".select2-search__field[aria-controls='select2-" + selectId + "-results']").each(function (
            key,
            value,
        ){
            value.focus();
        })
    });
    var APP_URL = "<?php echo env('APP_URL'); ?>";
    function getSocialIcon(link) {
        var icons = {
            'facebook.com': 'fb-icon.png',
            'instagram.com': 'insta-icon.png',
            'linkedin.com': 'linkedin-icon.png',
            'youtube.com': 'youtube-icon.png',
            'twitter.com': 'twitter-icon.png',
            
        };

        for (var url in icons) {
            if (link.includes(url)) {
                return APP_URL + '/assets/images/' + icons[url];
            }
        }

        return APP_URL + '/assets/images/default-social-icon.png';
    }
    
    function ViewMemberProfile(id='',edit_profile='') {
        $(".view_profile").html('');
        let url = '{{ route("member", ":id") }}';
        url = url.replace(':id', id);
        
        if(edit_profile<1)
        {
          $("#your_profile .edit_profile").html('');
        }
        
      $.ajax({
                url: url,
                datatype: "html",
                type: "get",
                beforeSend: function () {     
                  // Show the loader initially
                  //showLoader('members');                  
                    // $('.auto-load').show();
                }
            })
            .done(function (response) {
              if(response.status==200)
              {
                $("#your_profile .personal_links").empty();
                    member = response.data;
                    $("#your_profile .cover_image_url").attr('src',member.cover_image_url);
                    $("#your_profile .profile_image_url").attr('src',member.profile_image_url);
                    $("#your_profile .member_name").html(member.first_name + ' ' + member.last_name);
                    $("#your_profile .last_seen").html('Last active ' + member.last_seen);
                    
                    $("#your_profile .post_count").html(member.post_count);
                    $("#your_profile .follower_count").html(member.followers_count);
                    $("#your_profile .following_count").html(member.following_count);
                    
                    var memberId = member.id;
                    var authId = $(".user_id").val();
                    
                    if (authId == memberId) {
                        $("#your_profile .follower_count").html('<a href="{{ route('follower.list') }}">'+member.followers_count+' Followers</a>');
                        $("#your_profile .following_count").html('<a href="{{ route('following.list') }}">'+member.following_count+' Following</a>');
                    } else {
                        $("#your_profile .follower_count").html(member.followers_count+ " Followers");
                        $("#your_profile .following_count").html(member.following_count+ " Following");
                    }
                    $("#your_profile .job_title").html(member.job_title);
                    $("#your_profile .company_name").html(member.company_name);
                                    
                    $("#your_profile .bio").html(member.bio);
                    if(member.personal_link != null && member.personal_link != '') {

                      var personalLinks = member.personal_link.split(',');
                      
                      // Iterate over the personal links array and append them to the container
                      var personalLinksContainer = $("#your_profile .personal_links");
                      personalLinks.forEach(function(link) {
                          if (link.trim() !== '') {
                              var linkHtml = '<span class="badge me-3 bg-primary-strip"><a href="' + link + '" target="_blank">';
                                linkHtml += '<img src="' + getSocialIcon(link) + '" alt="' + link.trim() + '">';
                                linkHtml += '</a></span>';
                                
                                personalLinksContainer.append(linkHtml);
                            }
                        });
                    }
                
                  
                    if(member.location==null)
                    {
                        var country_name = '';
                    }
                    else
                    {
                        var country_name = member.location.country_name;
                        
                    }
                    
                    $("#your_profile .country_name").html(country_name);
                  
                    $("#your_profile").offcanvas("show");
                }    
            })
            .fail(function (jqXHR, ajaxOptions, thrownError) {
                console.log('Server error occured');
            }); 
    }     
</script>

<script type="text/javascript" src="{{asset('assets/froalaeditor/js/froala_editor.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/align.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/colors.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/draggable.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/emoticons.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/font_size.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/font_family.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/image.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/image_manager.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/lists.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/video.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/fullscreen.min.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<script>

    // Function to update the badge
    function updateBadge() {
        $.ajax({
                url: "{{route('push.notifications')}}"
                , type: "get"
        })
        .done(function(response) {
            // console.log("notification_count = " + data.data.notification_count);
            $("#notification_badge").html(response.notification_count);      
            
            if(response.notification_count>0)
            {
                $("#notification_badge").removeClass('d-none');
            }
        })
        .fail(function(jqXHR, ajaxOptions, thrownError) {
            console.log('Server error occured');
        });
        
      var notificationCount = $('#notification_badge').text();
      notificationCount = parseInt(notificationCount);
      const badgeElement = document.getElementById('notification_badge');

      if (notificationCount < 10) {
        badgeElement.textContent = notificationCount;
        // badgeElement.classList.remove('badge-danger'); // Remove danger class if it was added
        badgeElement.classList.add('badge-primary'); // Add primary class
      } else {
        badgeElement.textContent = '9+';
        badgeElement.classList.remove('badge-primary'); // Remove primary class if it was added
        // badgeElement.classList.add('badge-danger'); // Add danger class
      }
    }

    // Example: Increment the count (you would do this when your count changes)
    //count++;

    // Update the badge
    updateBadge();
    
    
    function getPushNotification() { 
// Get the reference to the preloader and the Push Notification List
//const preloader = document.getElementById('preloader');
const pushNotificationList = document.getElementById('pushNotificationList');
$("#pushNotificationList").html('');
        $.ajax({
                url: "{{route('push.notifications')}}"
                , type: "get"
                ,data: { per_page: 500 }
                , beforeSend: function() {
                    // Show the preloader
                    //preloader.style.display = 'block';
                }
            })
            .done(function(response) {   
                
                // console.log();
                if(response.notification_count>0)
                {
                    $("#notification_badge").removeClass('d-none');
                }
                
            $.each(response.data.data, function(index, notification) {
                // console.log(notification);
                
                var view ="view";
                if(notification.notification_viewed==1)
                {
                    view = "";
                    //$("#pushNotificationList li").addClass(view);
                }
            const listItem = document.createElement('li');
            listItem.innerHTML = `
            <div class="d-flex gap-2 align-items-center cursor-pt">
                <div class="avtar-55 shadow p-2">
                    <img src="${notification.sender.profile_image_url}" alt="">
                </div>
                <p class="title-font mb-0 text-sm-14">${notification.description}</p>
                <p class="mb-0 text-sm-14 white-space-no-wrap text-secondary">${notification.created_at}</p>
            </div>
                `;
                $(listItem).addClass(view);
                
                pushNotificationList.appendChild(listItem);
            }); // End each
            
            updateNotificationCount();
            
            }) // end success
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                console.log('Server error occured');
            });
    } 
    
    //// Update notification count
    
    
    function updateNotificationCount() {
        // Make an AJAX POST request
        let url = '{{ route("notification.update.count") }}';
        // url = url.replace(':id', id);
        $.ajax({
            
            url: url,
            type: "POST",
            dataType: "json",
            data: {
                // Additional data you may want to send
                // key: value
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token
            },
            success: function(response) {
                // Handle success response
                $("#notification_badge").html(response.data.notification_count);
                //console.log(response);
                if(response.data.notification_count==0)
                {
                    $("#notification_badge").addClass('d-none');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Handle error
                console.error("AJAX Error: " + textStatus, errorThrown);
            }
        });
    }
    
    // function updateNotificationCount(id) {
    //     // Make an AJAX POST request
    //     let url = '{{ route("notification.update.count", ":id") }}';
    //     url = url.replace(':id', id);
    //     $.ajax({
            
    //         url: url,
    //         type: "POST",
    //         dataType: "json",
    //         data: {
    //             // Additional data you may want to send
    //             // key: value
    //         },
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token
    //         },
    //         success: function(response) {
    //             // Handle success response
    //             $("#notification_badge").html(response.data.notification_count);
    //             //console.log(response);
    //             if(response.data.notification_count==0)
    //             {
    //                 $("#notification_badge").addClass('d-none');
    //             }
    //         },
    //         error: function(jqXHR, textStatus, errorThrown) {
    //             // Handle error
    //             console.error("AJAX Error: " + textStatus, errorThrown);
    //         }
    //     });
    // }
    
</script>