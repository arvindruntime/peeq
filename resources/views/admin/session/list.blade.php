@extends('layouts.admin.master')
@section('content')
{{-- {{ dd($sessions); }} --}}
<style type="text/css">
.dropdown .dropdown-menu {
    z-index: 2 !important;
    width: 100% !important;
    min-width: 200px !important;
}
</style>
<main class="main-content" id="main">
  <section class="lm__dash-con lm__course-list lm__list-after-pay lm_session-list">
    <span class="lm_vec"><img class="light"
      src="assets/images/light.png" alt=""><img class="dark" src="assets/images/dark.png" alt=""></span>
    <div class="container">
      <div class="row">
        <div class="col-xxl-10">
          <div class="lm__course">
            <div class="lm__course-title">
              <div class="d-flex justify-content-between">
                <h4 class="text-primary fw-bold">Session</h4>
              </div>
            </div>
            
            @if(Auth::user()->is_admin!=1)
            <div class="lm__course-tab">
              <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation" onclick="getSessionLists('all')">
                  <button class="nav-link active" id="pills-all-tab" data-bs-toggle="pill" data-bs-target="#pills-all" type="button" role="tab"
                    aria-controls="pills-all" aria-selected="true">All</button>
                  </li>
                    
                <li class="nav-item" role="presentation" onclick="getSessionLists('purchased')">
                  <button class="nav-link" id="pills-purchased-tab" data-bs-toggle="pill" data-bs-target="#pills-purchased" type="button" role="tab"
                    aria-controls="pills-purchased" aria-selected="false">Purchased</button>
                </li>
              </ul>
            </div>
            @endif
            
            
            <div class="lm_course-con">
              <div class="row gap-4 gap-md-0" id="data-wrapper">
                @include('admin.session.session-list-xhr')  
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

@include('admin.session.session-modal');

<script>
  var type = '{{ request()->get("type") }}';
  var calendly_popup = '{{ request("calendly_popup") }}';
  var user_id = '{{ Auth::user()->id }}';
  
  if (type == 'purchased' || calendly_popup == 1) {  
    $("#pills-all-tab").removeClass('active');
    $("#pills-purchased-tab").addClass('active');
    getSessionLists('purchased', page = 1);
        
    if (calendly_popup == 1 && user_id != 1) {
      $(document).ready(function () {
          var purchased_session_calendly_url = '{{ request("purchased_session_calendly_url") }}';
          var session_booking_title = '{{ request("session_booking_title") }}';
          // Set the value to the href attribute
          $(".purchased_session_calendly_url").attr('href', purchased_session_calendly_url);
          $('.session_booking_title').text(session_booking_title);

          // Show the modal
          $("#bookmy_session").modal('show');
      });
    }

  } else {
    getSessionLists('all', page = 1);
  }
  
  $(document).ready(function(){
    $('a.purchased_session_calendly_url').click(function(e){
        e.preventDefault(); // Prevent the default behavior of the link
        // Get the Calendly URL from the href attribute
        var calendlyUrl = $(this).attr('href');
        // Open the Calendly URL in a new tab
        window.open(calendlyUrl, '_blank');
        // Disable the button
        // $("a .purchased_session_calendly_url").prop('disabled', true);
        // Close the modal
        $("#bookmy_session").modal('hide');
    });
});

  
  function getSessionLists(type='all',page=1) {
    $("#data-wrapper").html('');
    
    var ENDPOINT = "{{ route('admin.session.list') }}";
    
    $.ajax({
            url: ENDPOINT + "?page=" + page + "&type=" +type+ "&device_type=web"+ "&per_page=100",
            datatype: "html",
            type: "get",
            beforeSend: function () {
                // $('.auto-load').show();
                // Show the loader initially
                // showLoader('events');
            }
        })
        .done(function (response) {
            if (response.html == '')
            {
              var error_message = 'Record not found!';                                    
                  Swal.fire({
                      toast: true,
                      icon: 'warning',
                      title: error_message ,
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
            }
            $("#data-wrapper").html(response.html);
        })
        .fail(function (jqXHR, ajaxOptions, thrownError) {
            console.log('Server error occured');
        });
  }
  </script>
@endsection