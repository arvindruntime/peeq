@extends('layouts.admin.master')
@section('content')
<link rel="stylesheet" href="{{ asset('assets/lib/main.css') }}">

    <main class="main-content" id="main">
      <section class="lm__dash-con lm__event-con">
        <span class="lm_vec"><img class="light" src="assets/images/light.png"
          alt=""><img class="dark" src="assets/images/dark.png" alt=""></span>
        <div class="container mb-5">
          <div class="row">
            <div class="col-12">
              <div class="lm__event-100">
                <div class="lm__event-title">
                  <div class="d-flex justify-content-between mb-3">
                    <h4 class="mb-0">Calendar</h4>
                    {{-- <button class="btn btn--primary py-1 px-3" data-bs-toggle="offcanvas" data-bs-target="#createEventOffcanvas"
                    aria-controls="createEventOffcanvas">NEW EVENT</button> --}}
                  </div>
                </div>
                <div class="lm__event-cal100 pt-5">
                  <div id="wrap2">
                    <div class="d-none" id="external-events2">
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
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

    <script src="{{ asset('assets/lib/main.js') }}"> </script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script> --}}
    
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var viewEventOffcanvas = new bootstrap.Offcanvas(document.getElementById('viewEvent'));
    
        var currentDate = new Date(); // Get the current date
        
        var is_calendar = {{ Auth::user()->is_admin ? '0' : '1' }};
            
        var calendar = new FullCalendar.Calendar(calendarEl, {
          headerToolbar: {
        left: 'prev,title,next,today',
        right: 'listMonth,dayGridMonth', // Remove timeGridDay and timeGridWeek from here
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
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              data: {
                page: '1',
                type: 'all',
                calendar: 1,
                is_calendar: is_calendar,
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
    
    {{-- <div class="offcanvas offcanvas-end" tabindex="-1" id="eventDetailsOffcanvas" aria-labelledby="eventDetailsOffcanvasLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="eventDetailsOffcanvasLabel">Event Details</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <!-- Event details content goes here -->
      </div>
    </div> --}}
    @include('users.event.event_comman_js')
    @include('users.event.event_modal')
    @endsection
    
    
