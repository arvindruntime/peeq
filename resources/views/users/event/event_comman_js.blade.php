<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.36/moment-timezone-with-data.min.js"></script>
<script>

function convertToUtc(userDate, userTimezone) {
    var given = moment.tz(userDate, userTimezone);
    var converted = given.utc().format("YYYY-MM-DD HH:mm:ss");
    return converted;
}
    /////// Create Event Start
     $(document).ready(function() {
        
        var id = '{{ request()->query('id') }}';        
        viewEventDetails(id);
        
        $(".mute_event").click(function(e){
            e.preventDefault();
            var event_id = $(this).attr("event-id");
            $("#mute_event_id").val(event_id);
        });
        
        $("#muteEventAction").click(function(e){
            e.preventDefault();
            var event_id = $("#mute_event_id").val();
            let _token = $("input[name=_token]").val();
            
            $.ajax({
            url: "{{route('events.activity')}}"
            , type: "POST"
            , data: {
                event_id: event_id
                ,is_mute: 1
                , _token: _token
            , }
            , dataType: 'JSON'
            , success: function(data) {
                // getData();

                if (data.error) {
                    // printErrorMsg(data.error);
                    return false;
                } else if (data.status == "200") {
                    $("#muteEventModal").modal('hide');
                }
             }
            });
        });
        
        
    $(".event_attendance").click(function(e){
        e.preventDefault();
        var event_id = $("#view_event_id").val();
        let _token = $("input[name=_token]").val();
        var attendance_value = $(this).attr('attendance-value');
            // console.log($(".event_status").html());
        if($(".event_status").html() == 'Finished')
        {
            var success_message = 'Event Finished';                                    
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
            return false
        }
        else{
                
            $.ajax({
            url: "{{route('events.activity')}}"
            , type: "POST"
            , data: {
                event_id: event_id
                ,is_attending: attendance_value
                , _token: _token
            , }
            , dataType: 'JSON'
            , success: function(data) {
                // getData();

                if (data.error) {
                    // printErrorMsg(data.error);
                    return false;
                } else if (data.status == "200") {
                    
                    if (attendance_value === 'going') {
                    $('.event_attendance[attendance-value="going"]').addClass('active');
                    $('.event_attendance[attendance-value="not_going"]').removeClass('active');
                    } 
                    
                    if (attendance_value === 'not_going') {
                    $('.event_attendance[attendance-value="not_going"]').addClass('active');
                    $('.event_attendance[attendance-value="going"]').removeClass('active');
                    }           
                    
                    event = data.data;
                    console.log(event);
                    
                    // Code started to show attended members
                    $('.event_attended_avatar').empty();
                    $('.event_attended_avatar'+event.id).empty();
                    $('.event_attended_avatar_list').empty();
                    event.going.forEach(function(attendee) {
                        var avatarImage = '<div class="avtar-25 shadow bg-white"><img src="'+attendee.profile_image_url+'" alt="'+attendee.first_name+'"></div>';
        
                        $('.event_attended_avatar').append(avatarImage);
                        $('.event_attended_avatar'+event.id).append(avatarImage);
                    
                        var event_attended_avatar_list = '<div class="avtar-55 shadow bg-white ms-0"><img src="'+attendee.profile_image_url+'" alt="'+attendee.first_name+'"></div>';
                        $('.event_attended_avatar_list').append(event_attended_avatar_list);
                    
                    
                    
                    });
                    var event_attended_count = event.total_going + " Going";
                    
                    $(".event_attended_count").html(event_attended_count);
                    $(".event_attended_count"+event.id).html(event_attended_count);
                                        
                    // Code end attended members

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
                        
                        // var redirectToAddtoCalendar = $(".addToCalendar").attr('href');
                        // window.open(redirectToAddtoCalendar, '_blank');
                }
             }
            });
        }
        });
        
        
        $(".add_to_calendar").click(function(e){
            e.preventDefault();
            let _token = $("input[name=_token]").val();
            var event_id = $(this).attr('event-id');
            
            $.ajax({
            url: "{{route('events.activity')}}"
            , type: "POST"
            , data: {
                event_id: event_id
                ,is_calendar: 1
                , _token: _token
            , }
            , dataType: 'JSON'
            , success: function(data) {
                // getData();

                if (data.error) {
                    // printErrorMsg(data.error);
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
                            // footer: '<a href="">Click to open</a>',
                            didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        });
                }
             }
            });
        });
    
    $('#eventStartDate').datetimepicker({
    format: 'd-M-Y H:i',
    minDate: 0,
    timepicker: true,
    defaultDate: new Date(),
    parentID: '#pq__start_date-modal',
    step: 1, // Time step in minutes
    // onShow: function (ct) {
    //     var endDate = $('#eventEndDate').val();
    //     if (endDate) {
    //     this.setOptions({
    //         maxDate: endDate
    //     });
    //     } else {
    //     this.setOptions({
    //         maxDate: false // Reset maxDate if End date is not selected
    //     });
    //     }
    // }
    });

    $('#eventEndDate').datetimepicker({
    format: 'd-M-Y H:i',
    defaultDate: new Date(currDate()),
    minDate: 0,
    timepicker: true,
    parentID: '#pq__end_date-modal',
    step: 1,
    // onShow: function (ct) {
    //     var startDate = $('#eventStartDate').val();
    //     if (startDate) {
    //     this.setOptions({
    //         minDate: startDate
    //     });
    //     } else {
    //     this.setOptions({
    //         minDate: false // Reset minDate if Start date is not selected
    //     });
    //     }
    // }
    });
    
    // For Update Event Setting Calender
    
    $('#EditEventStartDate').datetimepicker({
  format: 'd-M-Y H:i',
  minDate: 0,
  timepicker: true,
  parentID: '#pq__edit_start_date-modal',
  defaultDate: new Date(),
  step: 1, // Time step in minutes
});

$('#EditEventEndDate').datetimepicker({
  format: 'd-M-Y H:i',
  defaultDate: new Date(currDate()),
  minDate: 0,
  timepicker: true,
  parentID: '#pq__edit_end_date-modal',
  step: 1,
});

function currDate() {
  var d = new Date();
  var y = d.getFullYear();
  var m = d.getMonth();
  var da = d.getDate();
  var h = d.getHours();
  var mi = d.getMinutes() + 45;
  var se = d.getSeconds();
  var mDate = new Date(y, m, da, h, mi, se);
  return mDate;
} 
      
    //   $('#editEventStartDate').datetimepicker({
    //       format: 'd-M-Y H:i',
    //       minDate: 0,
    //       timepicker: true,
    //       step: 05,
    //       onShow: function(ct) {
    //       var endDate = $('#end-date').val();
    //       if (endDate) {
    //         this.setOptions({
    //           maxDate: endDate
    //         });
    //       }
    //     }
    //   });
      
    //   $('#editEventEndDate').datetimepicker({
    //       format: 'd-M-Y H:i',
    //       minDate: 0,
    //       timepicker: true,
    //       step: 05,
    //       onShow: function(ct) {
    //       var startDate = $('#start-date').val();
    //       if (startDate) {
    //         this.setOptions({
    //           minDate: startDate
    //         });
    //       }
    //     }
    //   });
      
      
    //   $('#updateEventStartDate').datetimepicker({
    //       format: 'd-M-Y H:i',
    //       minDate: 0,
    //       timepicker: true,
    //       step: 05,
    //       onShow: function(ct) {
    //       var endDate = $('#end-date').val();
    //       if (endDate) {
    //         this.setOptions({
    //           maxDate: endDate
    //         });
    //       }
    //     }
    //   });
      
    //   $('#updateEventEndDate').datetimepicker({
    //       format: 'd-M-Y H:i',
    //       minDate: 0,
    //       timepicker: true,
    //       step: 05,
    //       onShow: function(ct) {
    //       var startDate = $('#start-date').val();
    //       if (startDate) {
    //         this.setOptions({
    //           minDate: startDate
    //         });
    //       }
    //     }
    //   });
      
    
    $(".updateEvent").click(function(e) {
        
        e.preventDefault();
        $('.print-error-msg').html('<ul><li></li></ul>');
        let _token = $("input[name=_token]").val();
                
        var formData = new FormData($("#updateEventForm")[0]);
        var start_date = moment.utc(formData.get('start_date'), 'DD-MMM-YYYY HH:mm').format('YYYY-MM-DD HH:mm:ss');
        var end_date = moment.utc(formData.get('end_date'), 'DD-MMM-YYYY HH:mm').format('YYYY-MM-DD HH:mm:ss');
        formData.set('start_date', start_date);
        formData.set('end_date', end_date);
        
        // const editorHtmlSource = new FroalaEditor('#update_event_descreption', { });
        // var htmlcode = editorHtmlSource.html.get();
        // formData.set('description', htmlcode);
        
        document.addEventListener('DOMContentLoaded', function() {
        const editorHtmlSource = new FroalaEditor('#update_event_descreption', {});
        var htmlcode = editorHtmlSource.html.get();
        formData.set('description', htmlcode);
        });

        
        var is_also_post_in_feed = ($('#updateEventForm input[name="is_also_post_in_feed"]').is(':checked')) ? 1 : 0;
        formData.set('is_also_post_in_feed', is_also_post_in_feed);
            
        var is_rsvps = ($('#updateEventForm input[name="is_rsvps"]').is(':checked')) ? 1 : 0;
        formData.set('is_rsvps', is_rsvps);
        
        var is_header_image_or_video = ($('#updateEventForm input[name="is_header_image_or_video"]').is(':checked')) ? 1 : 0;
        formData.set('is_header_image_or_video', is_header_image_or_video);
        
        var is_thumbnail_image = ($('#updateEventForm input[name="is_thumbnail_image"]').is(':checked')) ? 1 : 0;
        formData.set('is_thumbnail_image', is_thumbnail_image);
        
        var is_description = ($('#updateEventForm input[name="is_description"]').is(':checked')) ? 1 : 0;
        formData.set('is_description', is_description);
            
            
        var id = $("#edit_event_id").val();
        let url = '{{ route("events.update", ":id") }}';
        url = url.replace(':id', id);
        
        $.ajax({
            url: url
            , type: "POST"
            , headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            , data: formData
            , dataType: 'JSON'            
            , contentType: false
            , processData: false
            , success: function(data) {
                $('.print-error-msg').html('<ul><li></li></ul>');

                    if (data.error) {
                        printErrorMsg(data.error);
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
                            // footer: '<a href="">Click to open</a>',
                            didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        });
                        $('.btn-close').click();
                        eventType();
                        window.location.href= '{{ route("events.index") }}'+'?id='+id;                        
                    }

            }
        });

        function printErrorMsg(msg) {

            console.log(msg);
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display', 'block');
            $.each(msg, function(key, value) {
                $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
            });
        }
    });
    
    // start  Save event Setting //////
    $(".saveEventSetting").click(function(e) {
        
        e.preventDefault();
        
        $(".saveEventSetting").attr("disabled", true);
        $('.print-error-msg').html('<ul><li></li></ul>');
        let _token = $("input[name=_token]").val();
        var id = $("#event_id").val();
        console.log(id);
                
        var formData = new FormData($("#eventSettingForm")[0]);
        
        
        var start_date = moment.utc(formData.get('start_date'), 'DD-MMM-YYYY HH:mm').format('YYYY-MM-DD HH:mm:ss');
        var end_date = moment.utc(formData.get('end_date'), 'DD-MMM-YYYY HH:mm').format('YYYY-MM-DD HH:mm:ss');
        var userTimezone = "{{ getUserTimeZone() }}"; 
    
        formData.set('start_date', convertToUtc(start_date, userTimezone));
        formData.set('end_date', convertToUtc(end_date, userTimezone));
            
        
        const editorHtmlSource = new FroalaEditor('#EventSettingDescreption', { });
        var htmlcode = editorHtmlSource.html.get();
        formData.set('description', htmlcode);
                        
        var is_also_post_in_feed = ($('#eventSettingForm input[name="is_also_post_in_feed"]').is(':checked')) ? 1 : 0;
        formData.set('is_also_post_in_feed', is_also_post_in_feed);

        var is_rsvps = ($('#eventSettingForm input[name="is_rsvps"]').is(':checked')) ? 1 : 0;
        formData.set('is_rsvps', is_rsvps);
        
        var is_header_image_or_video = ($('#eventSettingForm input[name="is_header_image_or_video"]').is(':checked')) ? 1 : 0;
        formData.set('is_header_image_or_video', is_header_image_or_video);
        
        var is_thumbnail_image = ($('#eventSettingForm input[name="is_thumbnail_image"]').is(':checked')) ? 1 : 0;
        formData.set('is_thumbnail_image', is_thumbnail_image);
        
        var is_description = ($('#eventSettingForm input[name="is_description"]').is(':checked')) ? 1 : 0;
        formData.set('is_description', is_description);
            
        let url = '{{ route("events.update", ":id") }}';
        url = url.replace(':id', id);
        
        $.ajax({
            url: url
            , type: "POST"
            , headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            , data: formData
            , dataType: 'JSON'            
            , contentType: false
            , processData: false
            , success: function(data) {
                $(".saveEventSetting").attr("disabled", false);
                $('.print-error-msg').html('<ul><li></li></ul>');
                    if (data.error) {
                        $(".saveEventSetting").attr("disabled", true);
                        printErrorMsg(data.error);
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
                            // footer: '<a href="">Click to open</a>',
                            didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        });
                        $("#manageEventSettingModal").offcanvas('hide');
                        $("#viewEvent").offcanvas('hide');
                        // $('.btn-close').click();
                        eventType();                        
                    }
            },
            error: function (xhr, textStatus, errorThrown) {
                // Handle server errors here
                
                $(".saveEventSetting").attr("disabled", false);
                
                var errorMessage = xhr.responseJSON.message;
                Swal.fire({
                    toast: true,
                    icon: 'error',
                    title: errorMessage,
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
        });

        function printErrorMsg(msg) {
            $(".saveEventSetting").attr("disabled", false);
            console.log(msg);
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display', 'block');
            $.each(msg, function(key, value) {
                $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
            });
        }
    });
    
    // End  Save event Setting //////
    
    
    $(".btn_saveEvent").click(function(e) {

            $(".btn_saveEvent").attr("disabled", true);
            $("#errorField").text('');
        
            e.preventDefault();
            $('.print-error-msg').html('<ul><li></li></ul>');
            let _token = $("input[name=_token]").val();
                    
            var formData = new FormData($("#eventForm")[0]);
            // var formData = $(this).serialize();
            
            
            var start_date = moment.utc(formData.get('start_date'), 'DD-MMM-YYYY HH:mm').format('YYYY-MM-DD HH:mm:ss');
            var end_date = moment.utc(formData.get('end_date'), 'DD-MMM-YYYY HH:mm').format('YYYY-MM-DD HH:mm:ss');
            var userTimezone = "{{ getUserTimeZone() }}"; 
        
            formData.set('start_date', convertToUtc(start_date, userTimezone));
            formData.set('end_date', convertToUtc(end_date, userTimezone));
                        
            const editorHtmlSource = new FroalaEditor('#event_descreption', { });
            var htmlcode = editorHtmlSource.html.get();
            formData.set('description', htmlcode);
            
            
            var is_also_post_in_feed = ($('#eventForm input[name="is_also_post_in_feed"]').is(':checked')) ? 1 : 0;
            formData.set('is_also_post_in_feed', is_also_post_in_feed);
            
            var is_rsvps = ($('#eventForm input[name="is_rsvps"]').is(':checked')) ? 1 : 0;
            formData.set('is_rsvps', is_rsvps);
            
            var is_header_image_or_video = ($('#eventForm input[name="is_header_image_or_video"]').is(':checked')) ? 1 : 0;
            formData.set('is_header_image_or_video', is_header_image_or_video);
            
            var is_thumbnail_image = ($('#eventForm input[name="is_thumbnail_image"]').is(':checked')) ? 1 : 0;
            formData.set('is_thumbnail_image', is_thumbnail_image);
            
            var is_description = ($('#eventForm input[name="is_description"]').is(':checked')) ? 1 : 0;
            formData.set('is_description', is_description);
            
            

            $.ajax({
                url: "{{route('events.store')}}"
                , type: "POST"
                , headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                , data: formData
                , dataType: 'JSON'            
                , contentType: false
                , processData: false 
                , success: function(data) {
                    $("#errorField").text('');
                    console.log('xhr sucess');
                    $(".btn_saveEvent").attr("disabled", false);
                    $('.print-error-msg').html('<ul><li></li></ul>');

                    if (data.error) {
                        printErrorMsg(data.error);
                        console.log('error thrown');
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
                            // footer: '<a href="">Click to open</a>',
                            didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        });
                        //$('.btn-close').click();
                        $("#createEventOffcanvas").offcanvas("hide");
                        eventType();
                        
                    }
                    $("#eventForm")[0].reset();
                },
                error: function (xhr, textStatus, errorThrown) {
                    // Handle server errors here
                    $(".btn_saveEvent").attr("disabled", false);
                    var errorMessage = xhr.responseJSON.message;
                    Swal.fire({
                        toast: true,
                        icon: 'error',
                        title: errorMessage,
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
                // ,error: function(jqXHR, textStatus, errorThrown) {
                // $(".btn_saveEvent").attr("disabled", false);
                            
                // // Display the error message
                // var errorMessage = (jqXHR.responseJSON && jqXHR.responseJSON.message) ? jqXHR.responseJSON.message : "An error occurred: " + errorThrown;
                // $('#errorField').text(jqXHR.responseJSON.message);
                // console.log(jqXHR.responseJSON.message);
                // }


            // error: function(jqXHR, textStatus, errorThrown) {
            //     $(".btn_saveEvent").attr("disabled", false);
                
            //     // Display the error message
            //     $('#errorField').text('An error occurred: ' + errorThrown);
            //     console.log(jqXHR);
            // }
            });

            function printErrorMsg(msg) {

                console.log(msg);
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display', 'block');
                $.each(msg, function(key, value) {
                    $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
                });
            }
        });
        
        
        $(".btn_saveDraftEvent").click(function(e) {
            
            $(".btn_saveDraftEvent").attr("disabled", true);
            $("#errorField").text('');
        
        e.preventDefault();
        $('.print-error-msg').html('<ul><li></li></ul>');
        let _token = $("input[name=_token]").val();
        
        var formData = new FormData($("#eventForm")[0]);
        
        // formData.append('upload_header_image_or_video', $("#upload_header_image_or_video")[0].files[0]);
        // formData.append('upload_thumbnail', $("#upload_thumbnail")[0].files[0]);        
        
        var start_date = moment.utc(formData.get('start_date'), 'DD-MMM-YYYY HH:mm').format('YYYY-MM-DD HH:mm:ss');
        var end_date = moment.utc(formData.get('end_date'), 'DD-MMM-YYYY HH:mm').format('YYYY-MM-DD HH:mm:ss');
        var userTimezone = "{{ getUserTimeZone() }}"; 
    
        formData.set('start_date', convertToUtc(start_date, userTimezone));
        formData.set('end_date', convertToUtc(end_date, userTimezone));

        // formData.is_save_to_draft = 1;
        formData.append('is_save_to_draft', 1);
       // $(".btn_saveEvent").attr("disabled", true);
       
       const editorHtmlSource = new FroalaEditor('#event_descreption', { });
        var htmlcode = editorHtmlSource.html.get();
        formData.set('description', htmlcode);
       
        var is_also_post_in_feed = ($('#eventForm input[name="is_also_post_in_feed"]').is(':checked')) ? 1 : 0;
        formData.set('is_also_post_in_feed', is_also_post_in_feed);
            
       var is_rsvps = ($('#eventForm input[name="is_rsvps"]').is(':checked')) ? 1 : 0;
        formData.set('is_rsvps', is_rsvps);
        
        var is_header_image_or_video = ($('#eventForm input[name="is_header_image_or_video"]').is(':checked')) ? 1 : 0;
        formData.set('is_header_image_or_video', is_header_image_or_video);
        
        var is_thumbnail_image = ($('#eventForm input[name="is_thumbnail_image"]').is(':checked')) ? 1 : 0;
        formData.set('is_thumbnail_image', is_thumbnail_image);
        
        var is_description = ($('#eventForm input[name="is_description"]').is(':checked')) ? 1 : 0;
        formData.set('is_description', is_description);

        $.ajax({
            url: "{{route('events.store')}}"
            , type: "POST"
            , headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            , data: formData
            , dataType: 'JSON'            
            , contentType: false
            , processData: false 
            , success: function(data) {
                                
                $("#errorField").text('');
                console.log('xhr sucess');
                $(".btn_saveDraftEvent").attr("disabled", false);
                $('.print-error-msg').html('<ul><li></li></ul>');

                    if (data.error) {
                        printErrorMsg(data.error);
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
                            // footer: '<a href="">Click to open</a>',
                            didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        });
                        //$('.btn-close').click();
                        $("#createEventOffcanvas").offcanvas("hide");
                        eventType();
                        
                    }
                    
                    $("#eventForm")[0].reset();

            },
            error: function (xhr, textStatus, errorThrown) {
                // Handle server errors here
                
                $(".btn_saveDraftEvent").attr("disabled", false);
                
                var errorMessage = xhr.responseJSON.message;
                Swal.fire({
                    toast: true,
                    icon: 'error',
                    title: errorMessage,
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
            // ,
            // error: function(jqXHR, textStatus, errorThrown) {
            //     $(".btn_saveDraftEvent").attr("disabled", false);
                            
            //     // Display the error message
            //     var errorMessage = (jqXHR.responseJSON && jqXHR.responseJSON.message) ? jqXHR.responseJSON.message : "An error occurred: " + errorThrown;
            //     $('#errorField').text(jqXHR.responseJSON.message);
            //     console.log(jqXHR.responseJSON.message);
            // }
        });

        function printErrorMsg(msg) {

            console.log(msg);
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display', 'block');
            $.each(msg, function(key, value) {
                $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
            });
        }
    });
    
    });
        
        // btn_saveDraftEvent

    $( document ).ready(function() {  
        
        const EventSettingEditor = new FroalaEditor('#EventSettingDescreption', {  
          key: froala_editor_key,
    attribution: false,
    charCounterCount: false,
    fullPage: true,
    placeholderText: 'Description',
    toolbarButtons: {
        moreText: {
            buttons: ['bold', 'italic', 'underline', 'undo', 'redo']
        },
        moreParagraph: {
            buttons: ['alignLeft', 'alignCenter', 'formatOLSimple']
        },
        moreRich: {
            buttons: ['insertImage', 'insertVideo', 'insertFile', 'fullscreen'] // Add 'insertFile'
        }
    },
    videoUpload: true,
    videoResponsive: true,
    videoInsertButtons: ['videoBack', '|', 'videoUpload', 'videoManager'],
    imageUploadURL: "{{ route('upload.image') }}",
    videoUploadURL: "{{ route('upload.video') }}",
    imageInsertButtons: ['imageUpload', 'imageManager'], // Add 'imageManager' to enable image browsing
    fileUpload: true, // Enable file upload support
    fileMaxSize: 1024 * 1024 * 200, // Adjust the maximum file size as needed
    fileUploadURL: "{{ route('upload.file') }}", // Set the route for handling file uploads
    fileInsertButtons: ['fileUpload', 'fileManager'], // Add 'fileManager' to enable file browsing
    fileAllowedTypes: ['*'], // Allow all file types; you can specify specific types like ['pdf', 'doc', 'txt'] if needed
    toolbarButtonsMD: [['fileUpload', 'fileManager']] // Show the custom file upload button on medium-sized screens and above 
    ,requestHeaders: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          },                               
      });
      
      
        const editor = new FroalaEditor('#event_descreption', {  
            key: froala_editor_key,
    attribution: false,
    charCounterCount: false,
    fullPage: true,
    placeholderText: 'Description',
    toolbarButtons: {
        moreText: {
            buttons: ['bold', 'italic', 'underline', 'undo', 'redo']
        },
        moreParagraph: {
            buttons: ['alignLeft', 'alignCenter', 'formatOLSimple']
        },
        moreRich: {
            buttons: ['insertImage', 'insertVideo', 'insertFile', 'fullscreen'] // Add 'insertFile'
        }
    },
    videoUpload: true,
    videoResponsive: true,
    videoInsertButtons: ['videoBack', '|', 'videoUpload', 'videoManager'],
    imageUploadURL: "{{ route('upload.image') }}",
    videoUploadURL: "{{ route('upload.video') }}",
    imageInsertButtons: ['imageUpload', 'imageManager'], // Add 'imageManager' to enable image browsing
    fileUpload: true, // Enable file upload support
    fileMaxSize: 1024 * 1024 * 200, // Adjust the maximum file size as needed
    fileUploadURL: "{{ route('upload.file') }}", // Set the route for handling file uploads
    fileInsertButtons: ['fileBack', '|', 'fileUpload', 'fileManager'] // Add 'fileManager' to enable file browsing  
    ,requestHeaders: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          },                             
      });
      
    
    const updateEventEditor = new FroalaEditor('#update_event_descreption', {  
    key: froala_editor_key,
    attribution: false,
    charCounterCount: false,
    fullPage: true,
    placeholderText: 'Description',
    toolbarButtons: {
        moreText: {
            buttons: ['bold', 'italic', 'underline', 'undo', 'redo']
        },
        moreParagraph: {
            buttons: ['alignLeft', 'alignCenter', 'formatOLSimple']
        },
        moreRich: {
            buttons: ['insertImage', 'insertVideo', 'insertFile', 'fullscreen'] // Add 'insertFile'
        }
    },
    videoUpload: true,
    videoResponsive: true,
    videoInsertButtons: ['videoBack', '|', 'videoUpload', 'videoManager'],
    imageUploadURL: "{{ route('upload.image') }}",
    videoUploadURL: "{{ route('upload.video') }}",
    imageInsertButtons: ['imageUpload', 'imageManager'], // Add 'imageManager' to enable image browsing
    fileUpload: true, // Enable file upload support
    fileMaxSize: 1024 * 1024 * 200, // Adjust the maximum file size as needed
    fileUploadURL: "{{ route('upload.file') }}", // Set the route for handling file uploads
    fileInsertButtons: ['fileUpload', 'fileManager'], // Add 'fileManager' to enable file browsing
    fileAllowedTypes: ['*'], // Allow all file types; you can specify specific types like ['pdf', 'doc', 'txt'] if needed
    toolbarButtonsMD: [['fileUpload', 'fileManager']] // Show the custom file upload button on medium-sized screens and above
    ,requestHeaders: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          },
});


$(".eventsetting").click(function() {
        // data-bs-toggle="offcanvas" data-bs-target="#manageEventSettingModal1" aria-controls="manageEventSettingModal"
        
        var id = $(this).attr('event-id');
        $("#event_id").val(id);
        // fetchEventToUpdate(id);
        viewEventDetails(id);
        $("#manageEventSettingModal").offcanvas("show");
    });
      
    });
    
    var page = 1;
    var event_type = 'upcoming';
  
    function eventType(event_type='upcoming',page='1')
    {   
        console.log(event_type);
        $("#data-wrapper").html('');
        infinteLoadMore(page,event_type);
    }
    
    /*------------------------------------------
    --------------------------------------------
    Call on Scroll
    --------------------------------------------
    --------------------------------------------*/
    infinteLoadMore(page, 'upcoming', '1');
    function infinteLoadMore(page, event_type='upcoming', refresh='') {
        var ENDPOINT = "{{ route('events.index') }}";
        
        $.ajax({
                url: ENDPOINT + "?page=" + page + "&type=" +event_type+ "&per_page=100",
                datatype: "html",
                type: "get",
                beforeSend: function () {
                    // $('.auto-load').show();
                    // Show the loader initially
                    // showLoader('events');
                }
            })
            .done(function (response) {
                if (response.html == '') {
                    //$('.auto-load').html("We don't have more data to display :(");
                    //return;
                }
  
                // $('.auto-load').hide();
                // Hide the loader and show the content
                if(refresh==1)
                {
                    $("#data-wrapper").html(response.html);    
                }
                else
                {
                    $("#data-wrapper").append(response.html);
                }
                // hideLoader('events');
                // showContent();
            })
            .fail(function (jqXHR, ajaxOptions, thrownError) {
                console.log('Server error occured');
            });
    }
    
    function GetDeletModal(delet_event_id)
    {
        $("#delet_event_id").val(delet_event_id);
        $('#DeleteEventModal').modal('show');
    }
        
    function delete_event() {
        let _token = $("input[name=_token]").val();
        var id = $("#delet_event_id").val();
        let url = '{{ route("events.delete", ":id") }}';
        url = url.replace(':id', id);
        
        console.log(id);
        $.ajax({
            url: url
            , method: "delete"
            , data: {
                _token: _token
                , id: id
            }
        }).done(function(data) {
                                   
            if (data.error)
            {
                var error_message = data.message;                                    
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
                    // footer: '<a href="">Click to open</a>',
                    didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });                        
            }
                    
            $("#delet_event_id").val('');
            $('#DeleteEventModal').modal('hide');
            infinteLoadMore(1,'upcoming',1);
        });
    }
    
    
    
    // Start code of Edit event
    function fetchEventToUpdate(id)
    {
        $("#edit_event_id").val(id);
                
        var formName = "#updateEventForm";
        var modalName = "#updateEventModal";
        var url = '{{ route("events.show", ":id") }}';
        url = url.replace(':id', id);
        let _token =  $("input[name=_token]").val();
      $.ajax({
        url: url,
        method: "GET",  
        data: {
          _token:_token,
          id: id
        }  
      }).done(function(data) {
        if(data.status==200)
        {
            event = data.data;
            
            console.log(event);
            
            $('#update_event_title').val(event.event_title);
            
            var startDate = moment(event.start_date).format('DD-MMM-YYYY HH:mm A');
            var endDate = moment(event.end_date).format('DD-MMM-YYYY HH:mm A');
            
            $('#editEventStartDate').val(startDate);
            $('#editEventEndDate').val(endDate);
            // alert(event.meeting_join_url);
            $(formName+' input[name="meeting_join_url"]').val(event.meeting_join_url);
            
           
                        
            // $("#update_event_descreption").html(event.description);
            // $("#update_event_descreption").val(event.description);
                        
            // const editor = new FroalaEditor('#update_event_descreption', { });
            // editor.html.set(event.description);
                       

            if(event.upload_header_image_or_video==null && event.upload_header_image_or_video <1)
            {
                var upload_header_image = "{{asset('assets/images/event-view.jpg')}}";
            }
            else
            {
                if(event.is_header_image_or_video==1)
                var upload_header_image = event.upload_header_image_or_video;
                else
                var upload_header_image = "{{asset('assets/images/event-view.jpg')}}";
            }
            
            $(".event_upload_header_image").attr('src', upload_header_image);
             
            
            $(formName+ 'input[name="meeting_join_url"]').val(event.meeting_join_url_edit);
                        
            $(formName+' input[name="is_rsvps"]').prop('checked', event.is_rsvps == 1);
            $(formName+' input[name="is_also_post_in_feed"]').prop('checked', event.is_also_post_in_feed == 1);
            $(formName+' input[name="is_header_image_or_video"]').prop('checked', event.is_header_image_or_video == 1);
            $(formName+' input[name="is_thumbnail_image"]').prop('checked', event.is_thumbnail_image == 1);
            $(formName+' input[name="is_description"]').prop('checked', event.is_description == 1);
            
            $(modalName).offcanvas("show");
        }
      });
      
    }
    
    // End code of Edit event
    
    
    // View event details
    function viewEventDetails(id)
    {
        $("#event_id").val(id);
        var url = '{{ route("events.show", ":id") }}';
        url = url.replace(':id', id);
        let _token =  $("input[name=_token]").val();
      $.ajax({
        url: url,
        method: "GET",  
        data: {
          _token:_token,
          id: id
        }  
      }).done(function(data) {
        if(data.status==200)
        {            
            var is_admin = "{{ auth()->user()->is_admin }}";
                        
            event = data.data;
            console.log(event);
            $(".EventExpired").show();
            
            if (event.is_attending === 'going') {
                $('.event_attendance[attendance-value="going"]').addClass('active');
                $('.event_attendance[attendance-value="not_going"]').removeClass('active');
            } 
            
            if (event.is_attending === 'not_going') {
                $('.event_attendance[attendance-value="not_going"]').addClass('active');
                $('.event_attendance[attendance-value="going"]').removeClass('active');
            } 
            
            if (event.is_attending === 'maybe' || event.is_attending === null || event.is_attending ==='') {
                $('.event_attendance[attendance-value="not_going"]').removeClass('active');
                $('.event_attendance[attendance-value="going"]').removeClass('active');
            }                       
            
            $("#view_event_id").val(event.id);
            
            $(".event_title").html(event.event_title);
            // $(".event_start_date").html(event.event_date);
                
            var eventDate = event.event_start_date + " - " + event.event_start_date;
            $(".event_time").html(eventDate);
            
            if(event.is_description==1)
            {
                var description = event.description;
            }
            else
            {
                var description = '';
            }
            $('#eventSettingForm input[name="event_title"]').val(event.event_title);
            $('#eventSettingForm input[name="is_also_post_in_feed"]').prop('checked', event.is_also_post_in_feed == 1);
            $(".event_description").html(description);
            // $("#EventSettingDescreption").html(description);
            
            const editor = new FroalaEditor('#EventSettingDescreption', { });
            editor.html.set(event.description);
            
            
            $('.coaches').empty();
            $('.coaches_list').empty();
            event.coaches.forEach(function(coach) {
                var avatarImage = '<div class="avtar-25 shadow bg-white"><img src="'+coach.profile_image_url+'" alt="'+coach.first_name+'"></div>';
            $('.coaches').append(avatarImage);

            var coaches_list = '<div class="avtar-55 shadow bg-white ms-0"><img src="'+coach.profile_image_url+'" alt="'+coach.first_name+'"></div>';
            $('.coaches_list').append(coaches_list);
                        
            });
            
            // Code started to show attended members
            $('.event_attended_avatar').empty();
            $('.event_attended_avatar_list').empty();
            event.going.forEach(function(attendee) {
                var avatarImage = '<div class="avtar-25 shadow bg-white"><img src="'+attendee.profile_image_url+'" alt="'+attendee.first_name+'"></div>';
            $('.event_attended_avatar').append(avatarImage);
            
            var event_attended_avatar_list = '<div class="avtar-55 shadow bg-white ms-0"><img src="'+attendee.profile_image_url+'" alt="'+attendee.first_name+'"></div>';
            $('.event_attended_avatar_list').append(event_attended_avatar_list);
                        
            });
            
            var event_attended_count = event.total_going + " Going";
            
            $(".event_attended_count").html(event_attended_count);
            
            var utcDate = event.event_date_time_web; //'2023-08-16 09:56:00';

            $(".event_date_time").html(utcDate);
            $(".event_duration").html(event.event_duration);
            $(".event_status").html(event.event_status);
            
            var startDateString = event.start_date;
            var endDateString = event.end_date;

            var startDate = moment(startDateString).format('YYYYMMDD[T]HHmmss[Z]');
            var endDate = moment(endDateString).format('YYYYMMDD[T]HHmmss[Z]');
            // console.log(startDateString, endDateString);
            // if()
            var desc = 'Join Zoom : '+event.zoom.meeting_join_url;
            
            var hrefValue = "http://www.google.com/calendar/event?action=TEMPLATE&dates=" + startDate + '/' + endDate + "&text=" + event.event_title + "&location=Live&details=" + desc;


            $(".addZoomLinkToDetail").attr('href', event.zoom.meeting_join_url);
            $(".addToCalendar").attr('href', hrefValue);
            
            // console.log('Event Status Log = ' + event.event_status);            
            if(event.event_status=='Finished' || event.is_rsvps==1)
            {
                $("#viewEvent .EventExpired").addClass('d-none');
            }
            else
            {
                $("#viewEvent .EventExpired").removeClass('d-none');
            }

            var rsvpsUrl = "{{ route('events.rsvp.list')}}" + '?id=' + event.id + '&type=going';
            $(".allRsvpsList").attr('href', rsvpsUrl);           
            
                var upload_header_image = "{{asset('assets/images/event-view.jpg')}}";
            
                if(event.upload_header_image_or_video!=null && event.upload_header_image_or_video!='')
                {
                    var upload_header_image = event.upload_header_image_or_video;
                }
            
                $(".event_upload_header_image").attr('src', upload_header_image);           
                
            var startDateString = event.start_date;
            var endDateString = event.end_date;

            var startDate = moment(startDateString).format('DD-MMM-YYYY hh:mm');
            var endDate = moment(endDateString).format('DD-MMM-YYYY hh:mm');
            console.log(startDate);
            console.log(endDate);
            $('#eventSettingForm input[id="EditEventStartDate"]').val(startDate);
            $('#eventSettingForm input[id="EditEventEndDate"]').val(endDate);
            
            if(event.meeting_join_url_edit)
            {
                $('#eventSettingForm input[name="meeting_join_url"]').val(event.meeting_join_url_edit);
            }

            $('#edit_coaches').val(null); // Clear previous selection
            $('#edit_coaches option').prop('selected', false);
            if(event.coaches && event.coaches.length > 0){
                $('#edit_coaches option').each(function() {
                    $('#edit_coaches').val(null).trigger('change'); // Clear previous selection

                    if (event.coaches && event.coaches.length > 0) {
                        var selectedCoachId = event.coaches[0].id;
                        // Set the selected value using Select2
                        $('#edit_coaches').val(selectedCoachId).trigger('change');
                    }

                    // var selectedCoachId = event.coaches[0].id;
                    // var coachId = $(this).val();
                    // if (coachId == selectedCoachId) {
                    //     $('#edit_coaches option[value="' + selectedCoachId + '"]').prop('selected', true);
                    //     // $(this).prop('selected', true);
                    // }
                });
            }
            else{
                $('#edit_coaches').val('').trigger('change');
            }
            
            $('#eventSettingForm input[name="is_rsvps"]').prop('checked', event.is_rsvps == 1);
            $('#eventSettingForm input[name="is_header_image_or_video"]').prop('checked', event.is_header_image_or_video == 1);
            $('#eventSettingForm input[name="is_thumbnail_image"]').prop('checked', event.is_thumbnail_image == 1);
            $('#eventSettingForm input[name="is_description"]').prop('checked', event.is_description == 1);
            
            $("#viewEvent").offcanvas("show");
        }
      });
      
    }
    
    // End view event details
    
    function copy_event(id) {
        url = '{{ route("events.index") }}?id=' + id;
        var tempInput = $('<input>'); // Create a temporary input element
        $('body').append(tempInput); // Append the temporary input element to the document
        tempInput.val(url).select(); // Set the value of the temporary input element to the text and select it
        document.execCommand('copy'); // Copy the selected text to the clipboard
        tempInput.remove(); // Remove the temporary input element from the document
        
        var success_message = 'User has copied the event link.';
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
    }
    
    
    $(document).ready(function() {    
        
    // Add an event listener to the start_date input
    $('#eventStartDate').on('change', function() {
        // Get the value of the start_date input
        var startDateValue = $(this).val();
        
        // Convert the start date value to a JavaScript Date object
        var startDate = new Date(startDateValue);

        // Add 5 minutes to the start date
        startDate.setMinutes(startDate.getMinutes() + 45);

        // Format the updated date as "YYYY-MM-DD HH:mm"
        var formattedEndDate = formatDate(startDate);

        // Set the updated value in the end_date input
        //$('#eventEndDate').val(formattedEndDate);
    });

    // Function to format a date object as "YYYY-MM-DD HH:mm"
    function formatDate(date) {
    var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    var day = ('0' + date.getDate()).slice(-2);
    var monthIndex = date.getMonth();
    var year = date.getFullYear();
    var hours = ('0' + date.getHours()).slice(-2);
    var minutes = ('0' + date.getMinutes()).slice(-2);

    return day + '-' + months[monthIndex] + '-' + year + ' ' + hours + ':' + minutes;
    }

});
getFeaturedDetails();
// View event details
// Function to remove HTML tags from a string
function stripHtmlTags(input) {
    var div = document.createElement("div");
    div.innerHTML = input;
    return div.textContent || div.innerText || "";
}
function getFeaturedDetails()
{    
    var url = '{{ route("dashboard.featured") }}';
    let _token =  $("input[name=_token]").val();
    $.ajax({
    url: url,
    method: "GET",  
    data: {
        _token:_token,
    }  
    }).done(function(response) {
        // Loop through the courses in the response
        var courseHtml = '';
        if (response.data.courses!='') {
            $(".featuredCourseDiv").removeClass('d-none');
            $.each(response.data.courses, function(index, course) {               
            
            // var admin_user = "{{ (Auth::user()->is_admin==1) }}";
            // if(admin_user) {
                 url = '{{ route("user.courses.list") }}';
            // } else {
            //      url = '{{ route("enter.pin.page") }}';
            // }
            
            course_details_url = url;
                    
                courseHtml += '<div class="swiper-slide"><a href="'+course_details_url+'">';
                    courseHtml += '<div class="card border-0 shadow h-100 p-0">';
                        courseHtml += '<div class="card-img mb-2">';
                            courseHtml += '<img height="200" width="200" src="'+course.course_thumbnail+'" alt="">';
                            courseHtml += '</div>';
                            courseHtml += '<div class="card-body p-0">';
                                courseHtml += '<h6 class="mb-1">'+course.course_name+'</h6>';
                                courseHtml += '<p class="mb-0 fe-con text-sm-16">'+stripHtmlTags(course.description)+'</p>';
                                courseHtml += '</div>';
                                courseHtml += '</div>';
                                courseHtml += '</a></div>';
                $('.courseContent').append(courseHtml);
            });
        }
        else
        {
            $(".featuredCourseDiv").addClass('d-none');
        } 
        /// End Course
        
        ////// Loop through the Events in the response
            
        $('.eventContent').empty();
        var eventHtml = '';
        if (response.data.events!='') {
            $(".featuredEventDiv").removeClass('d-none');
            $.each(response.data.events, function(index, event) {
                
                eventHtml += '<div class="swiper-slide">';
                eventHtml += '<div class="d-flex gap-3 lm_mx-25" onclick="viewEventDetails('+event.id+')">';
                    eventHtml += '<div class="ev_date bg-primary text-center rounded-2 text-white overflow-hidden">';
                        eventHtml += '<div class="d-flex justify-content-center align-items-center h-100">';
                            if(event.upload_thumbnail!='' && event.upload_thumbnail!=null)
                            {
                                var upload_thumbnail = event.upload_thumbnail; 
                            }
                            else{
                                var upload_thumbnail = "{{ asset('assets/images/event-img-01.jpg') }}";
                            }
                            eventHtml += '<img src="'+upload_thumbnail+'" alt="" style="width:100%">';
                            eventHtml += '</div>';
                            eventHtml += '</div>';
                
                eventHtml += '<div class="d-flex flex-wrap gap-2">';
                eventHtml += '<div class="d-block">';
                    
                eventHtml += '<p class="text-dark d-block mb-1 title-font">'+event.event_title+'</p>';
                eventHtml += '<div class="d-flex mb-2">';
                eventHtml += '<div class="lm_rsvp btn btn--primary">RSVP</div> </div>';
                
                eventHtml += '<div class="d-flex gap-1 align-items-center">';
                // eventHtml += '<span><img class="in-svg" src="assets/images/zoom.svg" alt=""></span>';
                // eventHtml += '<span class="text-sm-12">Zoom Meeting</span>';
                
                var zoomIcon = "{{asset('assets/images/calender-01.svg')}}";
                
                eventHtml += '<span class="pe-1"> <img class="in-svg" src="'+zoomIcon+'" alt=""></span>';
                eventHtml += '<span class="text-sm-12">'+event.start_date+'</span>';
                    
                eventHtml += '</div>';
                eventHtml += '</div>';
                eventHtml += '</div>';
                    
                
                eventHtml += '</div>';
                eventHtml += '</div>';
                eventHtml += '</div>';
                // eventHtml += '<br>';
                $('.eventContent').append(eventHtml);
            });
        }
        else
        {
            $(".featuredEventDiv").addClass('d-none');
        }            
    });
    
}
    
</script>

<script type="text/javascript" src="{{ asset('assets/froalaeditor/js/froala_editor.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/froalaeditor/js/plugins/align.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/froalaeditor/js/plugins/colors.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/froalaeditor/js/plugins/draggable.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/froalaeditor/js/plugins/emoticons.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/froalaeditor/js/plugins/font_size.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/froalaeditor/js/plugins/font_family.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/froalaeditor/js/plugins/image.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/froalaeditor/js/plugins/image_manager.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/froalaeditor/js/plugins/lists.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/froalaeditor/js/plugins/video.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/froalaeditor/js/plugins/fullscreen.min.js') }}"></script>

<link rel="stylesheet" href="{{asset('assets/froalaeditor/css/plugins/file.css')}}">
<script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/file.min.js')}}"></script>

    

<script>
    $(document).ready(function() {
        
        
var swiper = new Swiper('.mySwiper-course', {
  slidesPerView: "1",
  spaceBetween: 10,
  grabCursor: true,
//   loop: true,
//     autoplay: {
//         delay: 0,
//     },
//     speed: 11000,          //add
navigation: {
    nextEl: '.courses-next',
    prevEl: '.courses-prev',
  },
  
});
 // Event
var swiper = new Swiper('.mySwiper-event', {
  slidesPerView: "1",
  spaceBetween: 10,
  grabCursor: true,
  loop: true,
    autoplay: {
        delay: 0,
    },
    speed: 11000,          //add
navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  
});

        $('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
        event.preventDefault();
        event.stopPropagation();
        $(this).parent().siblings().removeClass('open');
        $(this).parent().toggleClass('open');
        });
    });
</script>