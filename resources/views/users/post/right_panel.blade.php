<style>
    .lm_rsvp {
        border: #E3A130 !important;
        min-width: auto;
    }
    .lm_upcoming-events .card-inner.px-3.pb-0 .border-btm:not(:last-child) {
    border-bottom: 1px solid #f2f2f2;
    margin-bottom: 10px;
    padding-bottom: 10px;
}
</style>

<!-- Featured Courses -->
 <div class="lm_upcoming-events lm-featured-post featuredCourseDiv">
    <div class="card border-0 p-3 mb-3">
        <div class="d-flex gap-2">
            <div class="d-flex gap-5">
                <span class="d-flex gap-2 align-items-center">
                    <img class="in-svg" src="{{ asset('assets/images/feature-course.svg') }}" alt="">
                    <h5 class="mb-0">Featured Courses</h5>
                </span>
                <div class="d-flex gap-2">
                    <div class="lm-featured-prev courses-prev">
                        <img class="in-svg" src="{{ asset('assets/images/sw-right.svg') }}" alt="">
                    </div>
                    <div class="lm-featured-next courses-next">
                        <img class="in-svg" src="{{ asset('assets/images/sw-left.svg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="course">
            <div class="swiper mySwiper-course">
            <div class="swiper-wrapper courseContent">
                
            </div>     
            </div>
        </div>
    </div>
</div>


<div class="lm_upcoming-events lm-featured-post auto-load featuredEventDiv">
    <div class="card border-0 p-3 mb-3">
        <div class="d-flex gap-2">
            <span>
                <img class="in-svg" src="{{ asset('assets/images/feature- events.svg') }}" alt="">
            </span>
            <h5>Featured Events</h5>
        </div>
        
        <div class="swiper mySwiper-event">
            <div class="swiper-wrapper eventContent">
            
            </div>
        </div>
        {{-- <div class="d-flex gap-3 lm_mx-25">
            <div class="ev_date bg-primary text-center rounded-2 text-white overflow-hidden">
                <div class="d-flex justify-content-center align-items-center h-100">
                    <img src="{{ asset('assets/images/featuredpost-03.jpg')}}" alt="">
                </div>
            </div>
            <div class="d-block">
                <p class="text-dark d-block mb-1 title-font">Being a Leader Master Class With Joe Williams</p>
                <div class="d-flex flex-wrap gap-2">
                    <div class="lm_rsvp btn btn--primary">RSVP</div>
                    <div class="d-flex gap-1 align-items-center"><span>
                                <img class="in-svg" src="assets/images/zoom.svg" alt=""> 
                            </span><span class="text-sm-12">Zoom Meeting</span>
                    </div>
                </div>
            </div>
        </div> --}}
        
        
    </div>
</div> 

@php $request['type'] = "upcoming"; @endphp
@php $events = eventsList($request); 
    $upcoming_event_flag = false;
@endphp

@foreach ($events as $key => $event)
    @if ($event['is_also_post_in_feed'] == 1)
        @php $upcoming_event_flag = true; @endphp
    @endif
@endforeach
@if(count($events) > 0)
    <div class="lm_upcoming-events auto-load">
            @if($upcoming_event_flag == true)
            <div class="card border-0 mb-3">
                <div class="d-flex gap-2 pt-3 px-3">
                    <span>
                        <img class="in-svg" src="{{ asset('assets/images/event.svg') }}" alt="">
                    </span>
                    <h5>Upcoming Events</h5>
                </div>
                <div class="card-inner px-3 pb-0 pb-3">
                {{-- </div> --}}
                @endif

                @foreach ($events as $key => $event)
                @if ($event['is_also_post_in_feed'] == 1)
                {{-- <div class="card-inner px-3 pb-3">  --}}
                    <div class="d-flex gap-3 border-btm">
                        <div class="ev_date bg-primary text-center rounded-2 text-white p-0 overflow-hidden">
                            @php
                            if($event['is_thumbnail_image']==1)
                            {
                            $upload_thumbnail = $event['upload_thumbnail'] ?? asset('assets/images/event-img-01.jpg');
                            }
                            else {
                            $upload_thumbnail = asset('assets/images/event-img-01.jpg');
                            }
                            @endphp
                            <img class="in-svg w-100" src="{{ $upload_thumbnail }}" alt="">
                        </div>
                        <div class="d-block">
                            <p class="text-dark d-block mb-1 title-font"><a onclick="viewEventDetails({{ $event->id }})"> {{ $event['event_title'] }}</a></p>
                            <div class="d-flex mb-2">
                                <div class="lm_rsvp btn btn--primary">
                                    <a onclick="viewEventDetails({{ $event->id }})">RSVP</a>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap gap-3 justify-content-between align-items-center">
                                @if ($event['is_rsvps']<1 && $event['is_rsvps']==0)
                                    @php
                                        $zoomLink =  $event['meeting_join_url'];
                                    @endphp
                                @endif
                            <div class="d-flex gap-1 align-items-center">
                                <span class="pe-1">
                                    <img class="in-svg" src="{{asset('assets/images/calender-01.svg')}}" alt="">
                                </span>
                                <span class="text-sm-12">{{ getDateTimeFormat($event['start_date'])}}</span>
                            </div>
                        </div>
                    </div>
                {{-- </div> --}}
            </div>
            @endif  
        @endforeach
    </div>
@endif

</div>
</div>

{{-- <div class="lm_upcoming-events lm_member-online mb-3">
    <div class="card border-0 py-3">
        <div class="lm__event-tab px-3">
            <ul class="nav nav-pills mb-4 nav-primary w-100 nav-justified" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation"><button class="nav-link active" id="pills-members-tab" data-bs-toggle="pill" data-bs-target="#pills-members" type="button" role="tab" aria-controls="pills-members" aria-selected="true">Members</button>
                </li>
                <li class="nav-item" role="presentation"><button class="nav-link" id="pills-coaches-tab" data-bs-toggle="pill" data-bs-target="#pills-coaches" type="button" role="tab" aria-controls="pills-coaches" aria-selected="false">Coaches</button>
                </li>
            </ul>
        </div>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade" id="pills-coaches" role="tabpanel" aria-labelledby="pills-coaches-tab" tabindex="0">
                <div class="card px-3 border-0 rounded-0">

                    @php $request['user_type'] = "Coach"; @endphp
                    @foreach (memberLists($request) as $key => $member)

                    @php if($member->id == Auth::user()->id) continue @endphp

                    <div class="d-flex align-items-center gap-2 justify-content-between mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <div class="avtar-xl shadow"><img class="rounded-circle position-relative w-100 h-100" src="{{ $member->profile_image_url ?? asset('assets/images/avtar-6.jpg')}}" alt="">

                                <div class="position-absolute top-0 start-0">
                                    <span> <img src="{{asset('assets/images/star-fill.svg')}}" alt=""> </span>
                                </div> --}}

                                {{-- <div class="avtar-active"></div> --}}
                            {{-- </div>
                            <P class="title-font mb-0 text-dark"> {{ $member->first_name.' '.$member->last_name }}</P>
                        </div><a class="btn btn--chat py-1 title-font px-3" href="{{ ("chat_memberlist") }}?user_id={{$member->id}}">Chat </a>
                    </div>
                    @endforeach


                </div>
            </div>
            <div class="tab-pane fade show active" id="pills-members" role="tabpanel" aria-labelledby="pills-members-tab" tabindex="0">
                <div class="card px-3 border-0 rounded-0">


                    @php $request['user_type'] = "Member"; @endphp
                    @foreach (memberLists($request) as $key => $member)

                    @php if($member->id == Auth::user()->id) continue @endphp

                    <div class="d-flex align-items-center gap-2 justify-content-between mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <div class="avtar-xl shadow"><img class="rounded-circle position-relative w-100 h-100" src="{{ $member->profile_image_url ?? asset('assets/images/avtar-6.jpg')}}" alt="">
                                 --}}
                                {{-- <div class="position-absolute top-0 start-0">
                                    <span>
                                        <img src="{{asset('assets/images/crown1.svg')}}" alt="">
                                </span>
                            </div> --}}


                            {{-- <div class="avtar-active"></div>    
                        </div>
                        <P class="title-font mb-0 text-dark"> {{ $member->first_name.' '.$member->last_name }}</P>
                    </div><a class="btn btn--chat py-1 title-font px-3" href="{{ ("chat_memberlist") }}?user_id={{$member->id}}">Chat </a>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
</div> --}}

@include('users.event.event_comman_js')
@include('users.event.event_modal')