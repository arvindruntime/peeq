@php
    use Carbon\Carbon;
@endphp
@foreach ($events as $event)
{{-- {{ dd($event) }} --}}
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <div class="lm__event-card mb-3">
        <div class="card shadow p-3 border-0 rounded-4">
            <div class="d-sm-flex flex-wrap align-items-center gap-2 justify-content-between">
                <div class="d-sm-flex align-items-center gap-3 mb-2 mb-sm-0 w-100">
                    @php
                    $eventStatus = getEventStatus($event->start_date,$event->end_date);
                    if($event->is_thumbnail_image==1)
                    {
                        $upload_thumbnail = $event->upload_thumbnail ?? asset('assets/images/event-img-01.jpg');
                    }
                    else {
                        $upload_thumbnail = asset('assets/images/event-img-01.jpg');
                    }
                    @endphp
                    <div class="event-img"><img class="position-relative" src="{{ $upload_thumbnail }}" alt=""></div>
                    <div class="d-block w-100 mt-3 mt-sm-0">
                        {{-- <p class="title-font mb-0 text-primary">{{ $event->start_date }} </p> --}}
                        <h4 class="mb-0 text-dark">{{ $event->event_title }} </h4>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-block w-100">
                                <div class="d-flex flex-wrap gap-3 align-items-center py-2">
                        @if ($event['is_rsvps']!=1)   
                            @if ($eventStatus=='Finished')
                            
                            @else

                                <div class="d-flex gap-2 align-items-center">
                                    <span><img class="in-svg" src="assets/images/zoom.svg" alt=""></span>
                                    @php
                                        $zoomLink =  $event['meeting_join_url'];
                                    @endphp
                                    <span class="text-sm-12 zoomLink"><a href="{{ $zoomLink }}" target="_blank">Join Zoom</a></span>
                                </div>
                            @endif
                        @endif
                                    <div class="d-flex gap-1 align-items-center">
                                        {{-- <span class="text-sm-12">{{ date('d-M-Y h:s',strtotime($event['start_date'])) }}</span> --}}
                                        <span class="text-sm-12 d-flex align-items-center">
                                            <span class="pe-1"> 
                                                <img class="in-svg" src="{{asset('assets/images/calender-01.svg')}}" alt="">
                                            </span>
                                        {{-- {{ $event['start_date'] }} --}}
                                           
                                            {{-- {{ convertUtcToUserTimezone($event['start_date'], 'Asia/Kolkata') }} --}}
                                            {{-- {{ \Carbon\Carbon::now()->format('Y-m-d H:i:s') }} --}}
                                            @php echo getDateTimeFormat($event['start_date']); 
                                             @endphp
                                            {{-- {{ \Carbon\Carbon::parse($event['start_date'])->format('d-M-Y H:i') }} --}}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="avtar-group">
                                    <div class="event_attended_avatar{{ $event['id'] }} d-flex">
                                        @foreach ($event['going'] as $going)
                                        <div class="avtar-25 shadow">                                   
                                            <img src="{{ $going['profile_image_url'] }}" alt="{{ $going['first_name']." ".$going['last_name'] }}" title="{{ $going['first_name']." ".$going['last_name'] }}">
                                        </div>
                                        @endforeach
                                    </div>
                                    <p class="mb-0 text-sm-12 ms-2 event_attended_count{{ $event['id'] }}"">{{ $event['total_going'] }} Going</p>
                                </div>
                            </div>
                            <div
                                class="d-flex gap-3 align-items-center lm__member-btn w-100 justify-content-end">
            <a onclick="viewEventDetails({{ $event->id }})" class="btn btn--primary py-1 title-font px-4 h6">View Event </a>

                            @php
                            $dnone =''; 
                            if(Auth::user()->user_type!="Host" && $eventStatus=="Finished")
                            { 
                                $dnone = 'd-none';
                            }
                            
                            @endphp           
                                <div class="dropdown mt-1 {{ $dnone }}">
                                    <a class="dropdown-toggle" type="button" data-bs-toggle="dropdown"  aria-expanded="false">
                                        <span>
                                            <img class="in-svg" src="assets/images/dots-1.svg" alt="">
                                        </span>
                                    </a>
                                       
                                    <ul class="dropdown-menu">
                                       
                                        @php
                                            $dateString = $event['start_date'];
                                            $date = Carbon::parse($dateString);
                                            $startDate = $date->format('Ymd\THis\Z');
                                            
                                            $dateString = $event['end_date'];
                                            $date = Carbon::parse($dateString);
                                            $endDate = $date->format('Ymd\THis\Z');
                                            
                                            // dd($event->zoom);
                                            
                                            if(Auth::user()->is_admin==1)
                                            {
                                                $meeting_join_url = $event->meeting_start_url;
                                            }
                                            else {
                                                $meeting_join_url = $event->meeting_join_url;
                                            }
                                            
                                            
                                            $event_description = 'Join Zoom : '. ($meeting_join_url ?? '');
                                            
                                        @endphp
                                        @if($eventStatus=="Finished")
                                        
                                        @else
                                                                            
                                            <li><a class="dropdown-item" event-id="{{ $event->id }}" target="_blank" href="http://www.google.com/calendar/event?action=TEMPLATE&dates={{ $startDate }}/{{ $endDate }}&text={{ $event->event_title }}&location=Live&details={{ $event_description }}">Add to Calendar</a></li>
                                            <li class="dropdown dropdown-submenu"><a class="dropdown-item" href="#" data-toggle="dropdown">Share</a><ul class="dropdown-menu">
                                                <li class="d-flex">
                                                <a class="dropdown-item w-auto" data-placement="top" href="mailto:?subject=Check%20out%20event&amp;body=event%0A{{ route('events.index') }}" title="Share via email">
                                                    <span class="icon-md">
                                                        <img class="in-svg"  src="assets/images/mail-to.svg" alt="">
                                                    </span>
                                                </a>
                                                <a class="dropdown-item w-auto" onclick="copy_event({{ $event->id }})">
                                                    <span class="icon-md">
                                                        <img class="in-svg" src="assets/images/link-to.svg" alt="">
                                                    </span>
                                                </a>
                                                </li>
                                                </ul>
                                            </li>
                                            <li class="divider"></li>
                                        @endif
                                   
                                        @if(Auth::user()->is_admin==1)
                                        <li> <a class="dropdown-item" href="{{ route('download.rsvp', ['id' => $event->id]) }}">Download RSVPs</a></li>
                                        {{-- <li> <a class="dropdown-item eventsetting" event-id="{{ $event->id }}">Event Settings</a></li> --}}
                                        <li><a class="dropdown-item toggleFeaturedEvent" is-featured-event="{{ $event['is_featured'] ? 0 : 1 }}" data-id-fetured-event="{{$event['id']}}"> {{ $event['is_featured'] ? 'Unfeature' : 'Feature' }} Event</a>
                                            <input type="hidden" id="save_type" value="1"/>
                                        </li>
                                        {{-- <li> <a class="dropdown-item">Duplicate Event</a></li> --}}
                                        <li> <a class="dropdown-item" onclick="GetDeletModal({{ $event->id }})">Delete Event</a></li>
                                        @endif
                                        </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
<script>
    $(document).ready(function() {
        $('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
        event.preventDefault();
        event.stopPropagation();
        $(this).parent().siblings().removeClass('open');
        $(this).parent().toggleClass('open');
        });
    });

    $(".toggleFeaturedEvent").click(function(e) {
        e.preventDefault();
        var event_id = $(this).attr("data-id-fetured-event");
        var is_featured = $(this).attr("is-featured-event");

        let url = '{{ route("events.featured.event.status.update", ":id") }}';
        url = url.replace(':id', event_id);

        formData = '';
        $.ajax({
            url: url
            , type: "POST"
            , headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            , data: {
                id: event_id,
                is_featured: is_featured,
            }
            , dataType: 'JSON'            
            , contentType: false
            , processData: false 
            , success: function(data) {
            
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
                    window.location.reload();                         
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                            
                var errorMessage = (jqXHR.responseJSON && jqXHR.responseJSON.message) ? jqXHR.responseJSON.message : "An error occurred: " + errorThrown;
                $('#errorField').text(jqXHR.responseJSON.message);
                console.log(jqXHR.responseJSON.message);
            }
        });
    });
  </script>