<style>
.lm_upld,
.lm_upld .input-group-text{
    cursor:pointer !important;
}
.lm_profile-modal.show .lm_profile-modal{
    position: relative
}
.select2-container {
    z-index: 9999; /* Adjust the value as needed */
}
.pq__datetime-modal-wrap .xdsoft_datetimepicker.xdsoft_noselect.xdsoft_ {
    top: 0 !important;
    left: 0 !important;
    position: absolute !important;
    z-index: 10000;
    bottom: auto !important;
}

.pq__datetime-modal-wrap {
    position: relative;
}

</style>
<input type="hidden" name="event_id" id="event_id" value="">
{{-- delete event modal --}}
<div class="modal fade" id="DeleteEventModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered lm__modal-4">
        <input type="hidden" id="delet_event_id">
        <div class="modal-content overflow-hidden">
            <div class="modal-body p-4 text-center position-relative">
                <div class="modal-header p-0"><button class="btn-close" type="button" data-bs-dismiss="modal"
                        aria-label="Close"><span> <img class="in-svg" src="{{asset('assets/images/close.svg')}}"
                                alt=""></span></button></div>
                <div class="z-index-1 position-relative lm_mxw50">
                    <h4 class="text-white">Are you sure you want to delete this event?</h4><button
                        class="btn btn--danger mt-3 title-font rounded-2 py-2" onclick="delete_event()">Delete</button><button
                        class="btn-close text-white d-block w-100 mt-2 title-font" type="button" data-bs-dismiss="modal"
                        aria-label="Close">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- view event modal-->
<div class="offcanvas offcanvas-end lm_profile-modal lm_create-modal" id="viewEvent" tabindex="-1"
aria-labelledby="viewEvent">
<div class="offcanvas-header">
    <h5 class="offcanvas-title" id="viewEvent">Skip</h5><button class="btn-close" type="button"
        data-bs-dismiss="offcanvas" aria-label="Close"></button>
</div>
<div class="offcanvas-body p-0">
    <div class="lm_profile-modal p-2">
        <div class="row align-items-center">
            <div class="col-12 text-center">
                <h5 class="text-white mb-0">View Event</h5>
            </div>
        </div>
    </div>
    <div class="lm_create-body lm__event-con">
        <div class="row">
        <div class="col-lg-12">
          <div class="lm__event lm__event-list">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <h5 class="event_title"> Being a Leader Master Class With Zoe Williams</h5>
              <div class="d-flex lm__member-btn gap-2">
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="event-view">
            <div class="event__img"><img class="rounded-4 event_upload_header_image" width="100%" src="" alt=""></div>
            <div class="event_date mb-5 shadow">
              <div class="d-sm-flex justify-content-between">
                <div class="event_date-1">
                  {{-- <h3 class="mb-2 fw-bold event_start_date"></h3> --}}
                  <div class="d-flex gap-2 mb-3">
                    <span> <img class="in-svg" src="{{asset('assets/images/cal_date.svg')}}"
                      alt=""></span>
                    <p class="mb-0 event_date_time"></p>
                  </div>
                  <p class="mb-3 d-flex gap-2"><span><img class="in-svg" src="{{asset('assets/images/subway_time-3.svg')}}" alt=""></span> Duration: <span class="event_duration">2hrs<span></p>
                  
                  <p class="mb-3 d-flex gap-2"><span><img class="in-svg" src="{{asset('assets/images/tabler_calendar-stats.svg')}}" alt=""></span> Status: <span class="event_status">Upcoming</span></p>
                  <div class="d-flex gap-2 EventExpired">
                    <span> <img class="in-svg" src="{{asset('assets/images/zoom.png')}}" alt=""></span>
                    <p class="mb-0"><a class="addZoomLinkToDetail text-dark" href="#" target="_blank">Join Zoom</a></p>
                  </div>
                  <div class="d-flex mt-4 EventExpired"> <a class="text-primary addToCalendar d-flex gap-2" href="#" target="_blank"><span><img src="{{asset('assets/images/g_calendar.png')}}" alt=""></span>Add To Calendar</a></div>
                </div>
                <div class="bg-primary event-btns text-center event_date-2">
                  
                  <input type="hidden" name="view_event_id" id="view_event_id">                  
                  
                  <div class="mb-3"> <button class="btn btn--white-outline title-font event_attendance" attendance-value="going">Going</button></div>
                  <div class="mb-4"><button class="btn btn--white-outline title-font event_attendance" attendance-value="not_going">Not Going</button></div>
                  <div class="avtar-group justify-content-center">
                    <div class="event_attended_avatar d-flex">
                      
                    </div>
                    <p class="mb-0 text-sm-12 ms-2 text-white event_attended_count">0 Going</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="event-con event_description">
            </div>
            <div class="event-con-go my-3 whoGoing">
              <div class="d-flex align-items-center gap-2">
                <h5 class="fw-bold mb-0">See Who’s Going</h5>
                <a class="allRsvpsList" href=""> <span
                  class="text-sm-12">See all RSVPS</span></a>
              </div>
              <div class="avtar-group my-2 event_attended_avatar_list">
              </div>
            </div>
            
            {{-- <div class="event-con-go my-3 coaches"> --}}
                <div class="d-flex align-items-center gap-2">
                    <h5 class="fw-bold mb-0">Coach/Host</h5>
                </div>
                <div class="avtar-group my-2 coaches_list">
                </div>
            {{-- </div> --}}
              
        @if(Auth::user()->is_admin==1)
            <div class="event-setting">
              <h5 class="fw-bold my-3">Event Settings</h5>
              <a
                class="btn btn--dark-outline rounded-3 title-font px-4 py-2" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#manageEventSettingModal" aria-controls="manageEventSettingModal">Manage Event Settings</a>
            </div>
        @endif
          </div>
        </div>
      </div>
    </div>
</div>
</div>

{{-- create event modal --}}

<div class="offcanvas offcanvas-end lm_profile-modal lm_create-modal" id="createEventOffcanvas" tabindex="-1"
    aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasRightLabel">Skip</h5><button class="btn-close" type="button"
            data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <form class="event-form" id="eventForm" method="POST" enctype="multipart/form-data">
        <div class="offcanvas-body p-0">
            <div class="lm_profile-modal p-2">
                <div class="row align-items-center">
                    <div class="col-8 text-end pe-5">
                        <h5 class="text-white mb-0">Create Event</h5>
                    </div>
                    <div class="col-4 text-end">
                        <button class="btn btn--primary py-2 title-font btn_saveDraftEvent">Save to Drafts</button>
                    </div>
                </div>
            </div>
            <div class="lm_create-body">
                    <div class="mb-3"><label class="form-label mb-2 title-font h5">Event Title</label>
                        <div class="position-relative">
                            <input name="event_title" class="form-control icon shadow py-3" type="text" placeholder="e.g. The Astronaut's Guide to Exercise">
                        </div>
                    </div>
                    <div class="lm_noti p-0 mb-3">
                        <div class="d-flex gap-2 align-items-center">
                            <p class="title-font mb-0 text-secondary">Also post in Feed</p>
                            <div class="d-flex gap-2 align-items-center">
                                <div class="toggle-button-cover">
                                    <input name="is_also_post_in_feed" value="1" class="checkbox" type="checkbox" checked="checked">
                                </div>
                                <div class="mb-1" data-bs-toggle="tooltip" data-bs-original-title="Post in Feed.">
                                    <img class="in-svg" src="{{asset('assets/images/que.svg')}}" alt="" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 shadow rounded-4 p-3">
                        <div class="d-flex justify-content-end">                
                                <p class="text-sm-12 mb-0">TIME ZONE:<span class="text-dark fw-bold"> {{ getUserTimeZone();}}
                                </span></p>
                            </div>
                        <div class="row gap-sm-0 gap-2">
                            <div class="col-sm-6"><label class="form-label mb-2 title-font h5">Start</label>
                                <div class="form-control-icon position-relative">
                                    <input name="start_date" class="form-control icon shadow py-3 ps-5" id="eventStartDate" type="text" autocomplete="false" value="{{ getDateTimeFormat(date('Y-m-d H:i')) }}">
                                    <div id="pq__start_date-modal" class="pq__datetime-modal-wrap"></div>
                                </div>
                            </div>
                            <div class="col-sm-6"><label class="form-label mb-2 title-font h5">End</label>
                                <div class="form-control-icon position-relative">
                                    <input name="end_date" class="form-control icon shadow py-3 ps-5" id="eventEndDate" type="text" autocomplete="false">
                                    <div id="pq__end_date-modal" class="pq__datetime-modal-wrap"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 shadow rounded-4 p-3">
                        <div class="row gap-sm-0 gap-2">
                            <div class="col-sm-6"><label class="form-label mb-2 title-font h5">Meeting Join Link</label>
                                <div class="position-relative">
                                    <input name="meeting_join_url" class="form-control icon shadow py-3" id="meeting_join_url" type="text" placeholder="e.g. https://zoom.us/j/99365897595?pwd=amdVSWI1Wml0SVpvWndvU2QveGFRQT09#success/">
                                </div>
                            </div>
                            
                            <div class="col-sm-6 admin-file-select">
                                <label class="form-label mb-2 title-font h5" for="id_label_multiple">Add Coach/Host</label>
                                {{-- select2-hidden-accessible select-img --}}
                                <select name="coaches" id="coaches" class="select2 form-select js-example-templating js-states form-control select2-hidden-accessible add-event-select-img" aria-label="Default select example">
                                  <option value="">Select Coach/Host</option>
                                    @foreach (coachList() as $coach)
                                      <option value="{{ $coach->id }}" data-src="{{ $coach->profile_image_url }}"
                                          
                                      >{{ $coach->first_name }} {{ $coach->last_name }}</option>
                                  @endforeach
                              </select>
                              
                            </div>
                              
                              
                        </div>
                    </div>
                    
                    {{-- <h5>Zoom meeting link will be create automatic</h5> --}}
                    <div class="lm_noti p-0 mb-3">
                        <div class="d-block">
                            <div class="d-flex gap-2 align-items-center">
                                <h6 class="title-font fw-bold mb-0 text-secondary text-dark">Close Events</h6>
                                <div class="toggle-button-cover">
                                    <input name="is_rsvps" value="1" class="checkbox" type="checkbox">
                                </div>
                                <div class="mb-1" data-bs-toggle="tooltip" data-bs-original-title="Close Events">
                                    <img src="{{asset('assets/images/que.svg')}}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <h5 class="fw-bold">About Event</h5>
                    
                    
                    <div class="lm_noti p-0 mb-3">
                        <div class="d-flex gap-2 align-items-center mb-1">
                            <p class="text-sm-12 mb-1 title-font"> Hide Header Image</p>
                            <div class="d-flex gap-2 align-items-center">
                                <div class="toggle-button-cover">
                                    <input name="is_header_image_or_video" value="1" class="checkbox" type="checkbox" checked="checked">
                                </div>
                                <div class="mb-1" data-bs-toggle="tooltip" data-bs-original-title="Hide Header Image.">
                                    <img src="{{asset('assets/images/que.svg')}}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="lm_upld">
                            <div class="input-group mb-0">
                                <label class="input-group-text p-0 mb-0" for="upload_header_image_or_video">Upload Header Image</label>
                                    <input name="upload_header_image_or_video" class="form-control" id="upload_header_image_or_video" type="file">
                                </div>
                        </div>
                    </div>
                    <div class="lm_noti p-0 mb-3">
                        <div class="d-flex gap-2 align-items-center mb-1">
                            <p class="text-sm-12 mb-1 title-font">Hide Thumbnail Image</p>
                            <div class="d-flex gap-2 align-items-center">
                                <div class="toggle-button-cover">
                                    <input name="is_thumbnail_image" value="1" class="checkbox" type="checkbox" checked="checked">
                                </div>
                                <div class="mb-1" data-bs-toggle="tooltip" data-bs-original-title="Hide Thumbnail Image.">
                                    <img src="{{asset('assets/images/que.svg')}}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="lm_upld">
                            <div class="input-group mb-0"><label class="input-group-text p-0 mb-0"
                                    for="upload_thumbnail">Upload Thumbnail</label>
                                    <input name="upload_thumbnail" class="form-control" id="upload_thumbnail" type="file"></div>
                        </div>
                    </div>
                    <div class="lm_noti p-0 mb-3">
                        <div class="d-flex gap-2 align-items-center">
                            <h5 class="fw-bold">Hide Description</h5>
                            <div class="d-flex gap-2 align-items-center">
                                <div class="toggle-button-cover">
                                    <input name="is_description" value="1" class="checkbox" type="checkbox" checked="checked">
                                </div>
                                <div class="mb-1" data-bs-toggle="tooltip" data-bs-original-title="Hide Description.">
                                    <img src="{{asset('assets/images/que.svg')}}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                        
                    <div class="mb-3">
                        <textarea class="ckplot form-control shadow" id="event_descreption" name="description"></textarea>
                    </div>
                    <span id="errorField" style="color: red;">
                        @if($errors->has('meeting_join_url'))
                        <div class="alert alert-danger">
                            {{ $errors->first('meeting_join_url') }}
                        </div>
                        @endif
                    </span>
                    <div class="d-flex justify-content-center lm__eve-btn gap-2">
                        <button class="btn btn--primary eve-btn btn_saveEvent" type="submit" >Create Event</button>
                    </div>
                
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="muteEventModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered lm__modal-4">
      <div class="modal-content overflow-hidden">
          <div class="modal-body p-4 text-center position-relative">
              <div class="modal-header p-0"><button class="btn-close" type="button" data-bs-dismiss="modal"
                      aria-label="Close"><span> <img class="in-svg" src="{{asset('assets/images/close.svg')}}"
                              alt=""></span></button></div>
              <div class="z-index-1 position-relative lm_mxw50">
                  <h4 class="text-white">Mute this Event?</h4>
                  <h6 class="text-white">You'll stop receiving notifications about this Event. You can always choose
                      to unmute at any time.</h6>
                      <input type="hidden" name="mute_event_id" id="mute_event_id">
                      <button class="btn btn--primary mt-3 title-font" id="muteEventAction" >Mute</button>
                      <button class="btn-close text-white d-block w-100 mt-2 title-font" type="button" data-bs-dismiss="modal"
                      aria-label="Close">Cancel</button>
              </div>
          </div>
      </div>
  </div>
  </div>
  
  {{-- Event setting start modal--}}
  
  <div class="offcanvas offcanvas-end lm_profile-modal lm_create-modal" id="manageEventSettingModal" tabindex="-1"
aria-labelledby="offcanvasRightLabel">
<div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasRightLabel">Skip</h5><button class="btn-close" type="button"
        data-bs-dismiss="offcanvas" aria-label="Close"></button>
</div>
<div class="offcanvas-body p-0">
    <div class="lm_profile-modal p-2">
        <div class="row align-items-center">
            <div class="col-12 text-center">
                <h5 class="text-white mb-0">Event Setting</h5>
            </div>
        </div>
    </div>
    <div class="lm_create-body">
        <form id="eventSettingForm" method="POST" enctype="multipart/form-data">
            <div class="mb-3"><label class="form-label mb-2 title-font h5">Event Title</label>
                <div class="position-relative">
                    <input name="event_title" class="form-control icon shadow py-3" type="text" placeholder="e.g. The Astronaut's Guide to Exercise">
                </div>
            </div>
            <div class="lm_noti p-0 mb-3">
                <div class="d-flex gap-2 align-items-center">
                    <p class="title-font mb-0 text-secondary">Also post in Feed</p>
                    <div class="d-flex gap-2 align-items-center">
                        <div class="toggle-button-cover">
                            <input name="is_also_post_in_feed" value="1" class="checkbox" type="checkbox">
                        </div>
                        <div class="mb-1" data-bs-toggle="tooltip" data-bs-original-title="Post in Feed.">
                            <img class="in-svg" src="{{asset('assets/images/que.svg')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            {{-- Start Adding Improvements point --}}
            <div class="mb-3 shadow rounded-4 p-3">
                <div class="d-flex justify-content-end">                
                        <p class="text-sm-12 mb-0">TIME ZONE:<span class="text-dark fw-bold"> {{ getUserTimeZone();}}
                        </span></p>
                    </div>
                <div class="row gap-sm-0 gap-2">
                    <div class="col-sm-6"><label class="form-label mb-2 title-font h5">Start</label>
                        <div class="form-control-icon position-relative">
                            <input name="start_date" class="form-control icon shadow py-3 ps-5" id="EditEventStartDate" type="text" autocomplete="false">
                            <div id="pq__edit_start_date-modal" class="pq__datetime-modal-wrap"></div>
                        </div>
                    </div>
                    <div class="col-sm-6"><label class="form-label mb-2 title-font h5">End</label>
                        <div class="form-control-icon position-relative">
                            <input name="end_date" class="form-control icon shadow py-3 ps-5" id="EditEventEndDate" type="text" autocomplete="false">
                            <div id="pq__edit_end_date-modal" class="pq__datetime-modal-wrap"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3 shadow rounded-4 p-3">
                <div class="row gap-sm-0 gap-2">
                    <div class="col-sm-6"><label class="form-label mb-2 title-font h5">Meeting Join Link</label>
                        <div class="position-relative">
                            <input name="meeting_join_url" class="form-control icon shadow py-3" id="meeting_join_url" type="text" placeholder="e.g. https://zoom.us/j/99365897595?pwd=amdVSWI1Wml0SVpvWndvU2QveGFRQT09#success/">
                        </div>
                    </div>
                    
                    
                    <div class="col-sm-6 admin-file-select">
                       
                        <label class="form-label mb-2 title-font h5" for="id_label_multiple">Add Coach/Host</label>
                        <select name="coaches" id="edit_coaches" class="select2 form-select js-example-templating js-states form-control select2-hidden-accessible select-img" aria-label="Default select example">
                          <option value="">Select Coach/Host</option>
                            @foreach (coachList() as $coach)
                              <option value="{{ $coach->id }}" data-src="{{ $coach->profile_image_url }}"
                                  
                              >{{ $coach->first_name }} {{ $coach->last_name }}</option>
                          @endforeach
                      </select>
                    </div>
                    
                    {{-- <div class="col-sm-6">
                        <label class="form-label mb-2 title-font h5" for="id_label_multiple">Add Coach/Host</label>
                                  
                        <select name="coaches" id="coaches" class="form-select js-example-templating js-states form-control" aria-label="Default select example">
                            <option value="">Select Coach/Host</option>
                            @foreach (coachList() as $coach)
                                <option value="{{ $coach->id }}" data-src="{{ $coach->profile_image_url }}"
                                    
                                >{{ $coach->first_name }} {{ $coach->last_name }}</option>
                            @endforeach
                        </select>
                    </div> --}}
                      
                      
                </div>
            </div>
            
            {{-- <h5>Zoom meeting link will be create automatic</h5> --}}
            {{-- End Adding Improvements point --}}
            
            <div class="lm_noti p-0 mb-3">
                <div class="d-flex gap-2 align-items-center">
                    <h6 class="title-font fw-bold mb-0 text-secondary text-dark">Close Events</h6>
                    <div class="d-flex gap-2 align-items-center">
                        <div class="toggle-button-cover">
                            <input name="is_rsvps" value="1" class="checkbox" type="checkbox">
                        </div>
                        <div class="mb-1" data-bs-toggle="tooltip" data-bs-original-title="Close Events">
                            <img src="{{asset('assets/images/que.svg')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="lm_noti p-0 mb-3">
                <div class="d-flex gap-2 align-items-center mb-1">
                    <p class="text-sm-12 mb-1 title-font">Hide Header Image</p>
                    <div class="d-flex gap-2 align-items-center">
                        <div class="toggle-button-cover">
                            <input name="is_header_image_or_video" value="1" class="checkbox" type="checkbox">
                        </div>
                        <div class="mb-1" data-bs-toggle="tooltip" data-bs-original-title="Hide Header Image.">
                            <img src="{{asset('assets/images/que.svg')}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="lm_upld">
                    <div class="input-group mb-0"><label class="input-group-text p-0 mb-0"
                            for="upload_header_image_or_video_setting">Upload Header Image</label>
                            <input name="upload_header_image_or_video" class="form-control" id="upload_header_image_or_video_setting" type="file"></div>
                </div>
            </div>
            <div class="lm_noti p-0 mb-3">
                <div class="d-flex gap-2 align-items-center mb-1">
                    <p class="text-sm-12 mb-1 title-font">Hide Thumbnail Image</p>
                    <div class="d-flex gap-2 align-items-center">
                        <div class="toggle-button-cover">
                            <input name="is_thumbnail_image" value="1" class="checkbox" type="checkbox">
                        </div>
                        <div class="mb-1" data-bs-toggle="tooltip" data-bs-original-title="Hide Thumbnail Image.">
                            <img src="{{asset('assets/images/que.svg')}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="lm_upld">
                    <div class="input-group mb-0">
                        <label class="input-group-text p-0 mb-0" for="upload_thumbnail_setting">Upload Thumbnail</label>
                            <input name="upload_thumbnail" class="form-control" id="upload_thumbnail_setting" type="file">
                    </div>
                </div>
            </div>
            <div class="lm_noti p-0 mb-3">
                <div class="d-flex gap-2 align-items-center">
                    <h5 class="fw-bold mb-0">Hide Description</h5>
                    <div class="d-flex gap-2 align-items-center">
                        <div class="toggle-button-cover">
                            <input name="is_description" value="1" class="checkbox" type="checkbox">
                        </div>
                        <div class="mb-1" data-bs-toggle="tooltip" data-bs-original-title="Hide Description.">
                            <img src="{{asset('assets/images/que.svg')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <textarea class="ckplot form-control shadow" id="EventSettingDescreption" name="description"></textarea>
            </div>
            
            <div class="d-flex justify-content-center lm__eve-btn gap-2"><button class="btn btn--primary eve-btn saveEventSetting"
                    type="button">Save </button></div>
        </form>
    </div>
</div>
</div>

  {{-- Event setting End Modal --}}
  
  
  {{-- <div class="offcanvas offcanvas-end lm_profile-modal lm_create-modal" id="updateEventModal" tabindex="-1"
aria-labelledby="offcanvasRightLabel">
<div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasRightLabel">Skip</h5><button class="btn-close" type="button"
        data-bs-dismiss="offcanvas" aria-label="Close"></button>
</div>
<div class="offcanvas-body p-0">
    <div class="lm_profile-modal p-2">
        <div class="row align-items-center">
            <div class="col-12 text-center">
                <h5 class="text-white mb-0">Edit Event</h5>
            </div>
        </div>
    </div>
    <div class="lm_create-body">
        <form id="updateEventForm" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="edit_event_id" id="edit_event_id">
            <input type="hidden" name="is_save_to_draft" id="is_save_to_draft" value="0">
            <div class="mb-3"><label class="form-label mb-2 title-font h5">Event Title</label>
                <div class="position-relative"><input name="event_title" id="update_event_title" class="form-control icon shadow py-3"
                        type="text" placeholder="e.g. The Astronaut's Guide to Exercise"></div>
            </div>
            <div class="lm_noti p-0 mb-3">
                <div class="d-flex gap-2 align-items-center">
                    <p class="title-font mb-0 text-secondary">Also post in Feed</p>
                    <div class="d-flex gap-2 align-items-center">
                        <div class="toggle-button-cover"><input name="is_also_post_in_feed" class="checkbox" type="checkbox">
                        </div>
                        <div class="mb-1" data-bs-toggle="tooltip" data-bs-original-title="Post in Feed.">
                            <img class="in-svg" src="{{asset('assets/images/que.svg')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mb-3 shadow rounded-4 p-3">
                <div class="d-flex justify-content-end">                    
                        <p class="text-sm-12 mb-0">TIME ZONE:<span class="text-dark fw-bold">{{ $tmz['abbreviation'] ?? '' }}
                        </span></p>
                    </div>
                <div class="row gap-sm-0 gap-2">
                    <div class="col-sm-6"><label class="form-label mb-2 title-font h5">Start</label>
                        <div class="form-control-icon position-relative">
                            <input name="start_date" class="form-control icon shadow py-3 ps-5" id="editEventStartDate" type="text" readonly autocomplete="false">
                        </div>
                    </div>
                    <div class="col-sm-6"><label class="form-label mb-2 title-font h5">End</label>
                        <div class="form-control-icon position-relative">
                            <input name="end_date" class="form-control icon shadow py-3 ps-5" id="editEventEndDate" type="text" readonly autocomplete="false">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="lm_noti p-0 mb-3">
                <div class="d-flex gap-2 align-items-center">
                    <h6 class="title-font fw-bold mb-0 text-secondary text-dark">Close Events</h6>
                    <div class="d-flex gap-2 align-items-center">
                        <div class="toggle-button-cover">
                            <input name="is_rsvps" value="1" class="checkbox" type="checkbox">
                        </div>
                        <div class="mb-1" data-bs-toggle="tooltip" data-bs-original-title="Close Events">
                            <img src="{{asset('assets/images/que.svg')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="lm_noti p-0 mb-3">
                <div class="d-flex gap-2 align-items-center mb-1">
                    <p class="text-sm-12 mb-1 title-font">Hide Header Image</p>
                    <div class="d-flex gap-2 align-items-center">
                        <div class="toggle-button-cover">
                            <input name="is_header_image_or_video" value="1" class="checkbox" type="checkbox">
                        </div>
                        <div class="mb-1" data-bs-toggle="tooltip" data-bs-original-title="Hide Header Image.">
                            <img src="{{asset('assets/images/que.svg')}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="event-img"> <img src="{{asset('assets/images/event-img-02.jpg')}}" alt=""></div>
                <div class="lm_upld">
                    <div class="input-group mb-0"><label class="input-group-text p-0 mb-0"
                            for="inputGroupFile01">Upload Header Image</label>
                            <input name="upload_header_image_or_video" class="form-control" id="inputGroupFile01" type="file"></div>
                </div>
            </div>
            <div class="lm_noti p-0 mb-3">
                <div class="d-flex gap-2 align-items-center mb-1">
                    <p class="text-sm-12 mb-1 title-font">Hide Thumbnail Image</p>
                    <div class="d-flex gap-2 align-items-center">
                        <div class="toggle-button-cover">
                            <input name="is_thumbnail_image" value="1" class="checkbox" type="checkbox">
                        </div>
                        <div class="mb-1" data-bs-toggle="tooltip" data-bs-original-title="Hide Thumbnail Image.">
                            <img src="{{asset('assets/images/que.svg')}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="event-img-2"><img src="{{asset('assets/images/event-img-01.jpg')}}" alt=""></div>
                <div class="lm_upld">
                    <div class="input-group mb-0"><label class="input-group-text p-0 mb-0"
                            for="inputGroupFile01">Upload Thumbnail</label>
                            <input name="upload_thumbnail" class="form-control" id="inputGroupFile01" type="file"></div>
                </div>
            </div>
            <div class="lm_noti p-0 mb-3">
                <div class="d-flex gap-2 align-items-center">
                    <h5 class="fw-bold mb-0">Hide Description</h5>
                    <div class="d-flex gap-2 align-items-center">
                        <div class="toggle-button-cover">
                            <input name="is_description" value="1" class="checkbox" type="checkbox">
                        </div>
                        <div class="mb-1" data-bs-toggle="tooltip" data-bs-original-title="Hide Description.">
                            <img src="{{asset('assets/images/que.svg')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <textarea class="ckplot form-control shadow" id="update_event_descreption" name="description"></textarea>
            </div>
            
            <div class="d-flex justify-content-center lm__eve-btn gap-2"><button class="btn btn--primary eve-btn updateEvent"
                    type="button">Save </button></div>
        </form>
    </div>
</div>
</div> --}}

  
  {{-- Start Update event modal --}}
  {{-- <div class="offcanvas offcanvas-end lm_profile-modal lm_create-modal" id="updateEventModal_old" tabindex="-1"
aria-labelledby="offcanvasRightLabel">
<div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasRightLabel">Skip</h5><button class="btn-close" type="button"
        data-bs-dismiss="offcanvas" aria-label="Close"></button>
</div>
<div class="offcanvas-body p-0">
    <div class="lm_profile-modal p-2">
        <div class="row align-items-center">
            <div class="col-12 text-center pe-5">
                <h5 class="text-white mb-0">Edit Event</h5>
            </div>
        </div>
    </div>
    <div class="lm_create-body">
        <form action="updateEventForm" method="POST" enctype="multipart/form-data">
            
            <div class="mb-3"><label class="form-label mb-2 title-font h5">Event Title</label>
                <div class="position-relative"><input name="event_title" id="update_event_title" class="form-control icon shadow py-3"
                        type="text" placeholder="e.g. The Astronaut's Guide to Exercise"></div>
            </div>
            <div class="lm_noti p-0 mb-3">
                <div class="d-flex gap-2 align-items-center">
                    <p class="title-font mb-0 text-secondary">Also post in Feed</p>
                    <div class="d-flex gap-2 align-items-center">
                        <div class="toggle-button-cover"><input name="is_also_post_in_feed" class="checkbox" type="checkbox">
                        </div>
                        <div class="mb-1" data-bs-toggle="tooltip" data-bs-original-title="Post in Feed.">
                            <img class="in-svg" src="{{asset('assets/images/que.svg')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3 shadow rounded-4 p-3">
                <div class="d-flex justify-content-end"><a type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#setTimeZoneModal" aria-controls="setTimeZoneModal">
                        <p class="text-sm-12 mb-0">TIME ZONE:<span class="text-dark fw-bold">IST</span></p>
                    </a></div>
                <div class="row gap-sm-0 gap-2">
                    <div class="col-sm-6"><label class="form-label mb-2 title-font h5">Start</label>
                        <div class="form-control-icon position-relative">
                          <input class="form-control icon shadow py-3 ps-5" name="start_date" id="updateEventStartDate" type="text">
                        </div>
                    </div>
                    <div class="col-sm-6"><label class="form-label mb-2 title-font h5">End</label>
                        <div class="form-control-icon position-relative"><input class="form-control icon shadow py-3 ps-5" name="end_date" id="updateEventEndDate" type="text">
                        </div>
                    </div>
                </div>
            </div>
            <div class="lm_noti p-0 mb-3">
                <div class="d-flex gap-2 align-items-center">
                    <p class="title-font mb-0 text-secondary">Repeat Event</p>
                    <div class="d-flex gap-2 align-items-center">
                        <div class="toggle-button-cover"><input name="is_repeat_event" class="checkbox" type="checkbox">
                        </div>
                        <div class="tooltip-icon mb-1"><img class="in-svg" src="{{asset('assets/images/que.svg')}}" alt="">
                            <div class="tooltiptext">Turning on RSVPs will allow members to select Going, Maybe, or
                                Not Going for your event.</div>
                        </div>
                    </div>
                </div>
            </div>
            <h5 class="fw-bold">About Event</h5>
            <div class="lm_noti p-0 mb-3">
                <div class="d-flex gap-2 align-items-center mb-1">
                    <p class="text-sm-12 mb-1 title-font">Hide Header Image</p>
                    <div class="d-flex gap-2 align-items-center">
                        <div class="toggle-button-cover"><input name="is_header_image_or_video" class="checkbox" type="checkbox" value="1">
                        </div>
                        <div class="mb-1" data-bs-toggle="tooltip" data-bs-original-title="Hide Header Image.">
                            <img src="{{asset('assets/images/que.svg')}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="lm_upld">
                    <div class="input-group mb-0"><label class="input-group-text p-0 mb-0"
                            for="inputGroupFile01">Upload Header Image</label><input name="upload_header_image_or_video" class="form-control"
                            id="inputGroupFile01" type="file"></div>
                </div>
            </div>
            <div class="lm_noti p-0 mb-3">
                <div class="d-flex gap-2 align-items-center mb-1">
                    <p class="text-sm-12 mb-1 title-font">Hide Thumbnail Image</p>
                    <div class="d-flex gap-2 align-items-center">
                        <div class="toggle-button-cover"><input name="is_thumbnail_image" class="checkbox" type="checkbox" value="1">
                        </div>
                        <div class="mb-1" data-bs-toggle="tooltip" data-bs-original-title="Hide Thumbnail Image.">
                            <img src="{{asset('assets/images/que.svg')}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="lm_upld">
                    <div class="input-group mb-0"><label class="input-group-text p-0 mb-0"
                            for="inputGroupFile02">Upload Thumbnail</label><input name="upload_thumbnail" class="form-control"
                            id="inputGroupFile02" type="file"></div>
                </div>
            </div>
            <div class="lm_noti p-0 mb-3">
                <div class="d-flex gap-2 align-items-center">
                    <h5 class="fw-bold">Hide Description</h5>
                    <div class="d-flex gap-2 align-items-center">
                        <div class="toggle-button-cover"><input name="is_description" class="checkbox" type="checkbox" value="1">
                        </div>
                        <div class="mb-1" data-bs-toggle="tooltip" data-bs-original-title="Hide Description.">
                            <img src="{{asset('assets/images/que.svg')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3"> 
              <textarea class="ckplot form-control shadow" id="update_event_descreption" name="description"></textarea>
              </div>
            <div class="d-flex justify-content-center lm__eve-btn gap-2">
              <button class="btn btn--primary eve-btn" type="submit">Save</button></div>
        </form>
    </div>
</div>
</div> --}}
  {{-- End Update Event modal --}}
    