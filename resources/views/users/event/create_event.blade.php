@extends('layouts.admin.master')
@section('content')
<link rel="stylesheet" href="{{ asset('assets/lib/main.css') }}">
<main class="main-content" id="main">
    <section class="lm__dash-con lm__event-con">
      <span class="lm_vec"><img class="light" src="assets/images/light.png"
        alt=""><img class="dark" src="assets/images/dark.png" alt=""></span>
      <div class="container">
        <div class="row gap-lg-0 gap-2">
          <div class="col-xxl-8 col-lg-6">
            <div class="lm__event">
              <div class="lm__event-title">
                <h4>Events</h4>
              </div>
              <div class="lm__event-tab">
                {{-- <ul class="nav nav-pills mb-4 nav-primary" id="pills-tab" role="tablist">
                  <li class="nav-item" role="presentation"><button class="nav-link active" id="pills-all-tab"
                    data-bs-toggle="pill" data-bs-target="#pills-all" type="button" role="tab"
                    aria-controls="pills-all" aria-selected="true">All</button></li>
                  <li class="nav-item" role="presentation"><button class="nav-link" id="pills-upcoming-tab"
                    data-bs-toggle="pill" data-bs-target="#pills-upcoming" type="button" role="tab"
                    aria-controls="pills-upcoming" aria-selected="false">Upcoming</button></li>
                  <li class="nav-item" role="presentation"><button class="nav-link" id="pills-past-tab"
                    data-bs-toggle="pill" data-bs-target="#pills-past" type="button" role="tab"
                    aria-controls="pills-past" aria-selected="false">Past</button></li>
                </ul> --}}
                <div class="tab-content" id="pills-tabContent">
                  <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab"
                    tabindex="0">
                    <a class="lm__event-create" type="button" data-bs-toggle="offcanvas"
                      data-bs-target="#createEventOffcanvas" aria-controls="createEventOffcanvas">
                      <div class="lm__event-btn">
                        <div class="create-btn"><span class="me-3"><img class="in-svg" src="assets/images/plus-3.svg"
                          alt=""></span> Create Event</div>
                      </div>
                    </a>
                  </div>
                  <div class="tab-pane fade" id="pills-upcoming" role="tabpanel" aria-labelledby="pills-upcoming-tab"
                    tabindex="0">...</div>
                  <div class="tab-pane fade" id="pills-past" role="tabpanel" aria-labelledby="pills-past-tab"
                    tabindex="0">...</div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xxl-4 col-lg-6">
            <div class="lm__event-cal">
              <div id="wrap">
                <h5 class="position-absolute">Calendar</h5>
                <div id="external-events">
                  <h4>Draggable Events</h4>
                  <div id="external-events-list"></div>
                  <div class="fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event">
                    <div class="fc-event-main">My Event 1</div>
                  </div>
                  <div class="fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event">
                    <div class="fc-event-main">My Event 2</div>
                  </div>
                  <div class="fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event">
                    <div class="fc-event-main">My Event 3</div>
                  </div>
                  <div class="fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event">
                    <div class="fc-event-main">My Event 4</div>
                  </div>
                  <div class="fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event">
                    <div class="fc-event-main">My Event 5</div>
                  </div>
                  <p></p>
                  <input id="drop-remove" type="checkbox"><label for="drop-remove">remove after drop</label>
                </div>
                <div id="calendar-wrap">
                  <div id="calendar"></div>
                </div>
              </div>
            </div>
            <div class="lm__expand-cal"> <a class="btn btn--primary" href="{{ route('events.calendar') }}">Expand Calander</a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <script src="{{ asset('assets/lib/main.js') }}"> </script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      var viewEventOffcanvas = new bootstrap.Offcanvas(document.getElementById('viewEvent'));
  
      var currentDate = new Date(); // Get the current date
  
      var calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
          left: 'prev,title,next,today',
          right: 'listMonth,timeGridDay,timeGridWeek,dayGridMonth',
        },
        initialDate: currentDate, // Set the initial date to the current date
        defaultDate: currentDate, // Set the default date to the current date
        businessHours: true,
        editable: true,
        selectable: true,
        dayNames: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
  
        events: function(info, successCallback, failureCallback) {
          $.ajax({
            url: "{{ route('events.index') }}",
            method: 'GET',
            data: {
              page: '1',
              type: 'all',
              calendar: 1,
            },
            success: function(response) {
              //console.log(response); // Log the response in the console
              //console.log('arvind kumar dubey');
              successCallback(response); // Pass the response to the success callback
            },
            error: function(xhr, status, error) {
              console.error(error); // Log any error that occurred
              failureCallback(error); // Pass the error to the failure callback
            }
          });
        },
        eventClick: function(info) {
      var event = info.event;
      
      // Implement this function to retrieve event details
      
      console.log(event);
      
    //   var startDateTime = "2023-07-24 09:30:10";
    //   var endDateTime = "2023-07-30 09:30:10";
      
    //   var startTime = moment(event.start_date, "YYYY-MM-DD HH:mm:ss").format("h:mmA");
    
    // var endTime = moment(event.end_date, "YYYY-MM-DD HH:mm:ss").format("h:mmA");

    // var formattedTimeRange = startTime + " - " + endTime + " IST";

    //   $('#viewEvent .offcanvas-body .lm__event h5').text(event.title);
    //   $('#viewEvent .offcanvas-body .event_date-1 h3 .start_date').text(event.start_date);
    //   $('#viewEvent .offcanvas-body .event_time').text(event.start_date);
    //   $('#viewEvent .offcanvas-body .event__img img').attr('src', event.extendedProps.upload_thumbnail);
    //   $('#viewEvent .offcanvas-body .event-con p').text(event.extendedProps.description);
    //   $('#viewEvent .offcanvas-body .event-con-go .avtar-group').html(event.extendedProps.rsvpsHtml);
      
      viewEventDetails(event.id);


      viewEventOffcanvas.show(); // Open the offcanvas panel
    }
  
        // eventClick: function(info) {
        //   var eventId = info.event.id;
        //   window.location.href = '/event-detail/' + eventId;
        //   info.jsEvent.preventDefault();
        // }
      });
  
      calendar.render();
      
      // Function to retrieve event details
  function getInfoFromEvent(event) {
    
    // Implement your logic to extract event details from the event object
    // var eventDetails = {
    //   title: event.title,
    //   description: event.extendedProps.description,
    //   start: event.start.toLocaleString(),
    //   end: event.end.toLocaleString(),
    //   start_date: event.start_date,
    // };

    return event;
  }
  
    });
  </script>
  @include('users.event.event_comman_js')
  @include('users.event.event_modal')
@endsection