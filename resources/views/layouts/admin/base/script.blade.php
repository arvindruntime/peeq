{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
</script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script> --}}
{{-- <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- Step -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"
    integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
{{-- calandly --}}
<script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js" async></script>
<script src="{{ asset('assets/js/main.js') }}"></script>

<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" integrity="sha512-bYPO5jmStZ9WI2602V2zaivdAnbAhtfzmxnEGh9RwtlI00I9s8ulGe4oBa5XxiC6tCITJH/QG70jswBhbLkxPw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
<!-- <style>
  .xdsoft_datetimepicker .xdsoft_calendar td:hover, .xdsoft_datetimepicker .xdsoft_timepicker .xdsoft_time_box > div > div:hover {
    color: #fff !important;
    background: #e3a130 !important;
}
</style> -->
<script>
    $(document).ready(function() {

        //check for localStorage, add as browser preference if missing
        //   if (!localStorage.getItem("mode")) {
        //     if (window.matchMedia("(prefers-color-scheme: dark)").matches) {
        //         localStorage.setItem("mode", "dark");
        //     } else {
        //         localStorage.setItem("mode", "light");
        //     }
        //   }

        //   if (localStorage.getItem("mode") == "dark") {
        //     $("body").addClass("dark");
        //     $("body").removeClass("light");
        //     document.getElementById("checkbox").checked = true;
        //   } else {
        //     $("body").removeClass("dark");
        //     $("body").addClass("light");
        //     document.getElementById("checkbox").checked = false;
        //   }        
        ////////////////////// start Notification status Update /////////////////
        $('.change_notification_status').on('click', function() {
            let _token = $("input[name=_token]").val();
            var status_on = [];
            var status_off = '';
            $('.notification_method:checked').each(function() {
                status_on.push($(this).val());
            });
            var status_on_string = status_on.join(); // 'A,B,C'
            console.log(status_on_string);
            $.ajax({
                url: "{{ route('notification.change_status') }}",
                method: "GET",
                data: {
                    _token: _token,
                    status_on: status_on_string,
                    status_off: status_off,
                }
            }).done(function(data) {

                if (data.error) {
                    printErrorMsg(data.error);
                    return false;
                } else if (data.status == "200") {
                    var success_message = data.message;
                    // $('#offcanvasRight3').modal('hide');
                    // $('.btn-close').click();   
                    $("#offcanvasRight2").offcanvas("hide");
                    var success_message = data.message;

                    Swal.fire({
                        toast: true,
                        icon: 'success',
                        title: success_message,
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

                    $(".steps-completed3").addClass('active');
                    $(".welcomeList3").removeClass("lm_disable");
                    $(".welcomeList3").addClass('active');

                    $("#progress_step_path").css("height", "100%");
                    
                    window.location.href = "{{ route('posts.index') }}"; // Updated by arvind

                    // progress_step_path

                    // $("#offcanvasRight3").modal('hide');

                }

            });

        });

        /////////////////// End Notification Status Update //////////////////


        $("#select_box1").select2({
            dropdownParent: $("#inviteMemberModal")
        });
        
        $("#select_boxCourse").select2({
            dropdownParent: $("#courseshare")
        });


        // Location
        // $("#location_edit ,#timezone_edit").select2({
        //     dropdownParent: $("#offcanvasRight1")
        // });

        // Time_zone
        $("#time_zone").select2({
            dropdownParent: $("#setTimeZoneModal")
        });

        // step
        $('.nav-tabs > li a[title]').tooltip();
        //Wizard
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            var $target = $(e.target);
            if ($target.hasClass('disabled')) {
                return false;
            }

            // handle with prgressbar 
            var step = $(e.target).data('step');
            var percent = (parseInt(step) / 7) * 100;
            $('.progress-bar').css({
                width: percent + '%'
            });
            $('.progress-bar').text('Step ' + step + ' of 7');

        });

        $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
            var $target = $(e.target);
            $target.parent().addClass('active');
        });

        $('a[data-toggle="tab"]').on('hide.bs.tab', function(e) {
            var $target = $(e.target);
            $target.parent().removeClass('active');
        });

        function swal(name = '', msg = '') {
            var error_message = msg;
            Swal.fire({
                toast: true,
                icon: 'warning',
                title: name + ' ' + error_message,
                position: 'top-right',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                }
            });
            return false;
        }

        $(".next-step").click(function(e) {

            let text = $.trim($('#title').val()); //remove leading and trailing white spaces from the input text.
            // let pattern = /\s/g;   //this patten not allow white spaces after & before write text
            // let result = text.match(pattern);
            if ($('#title').val() == '') {
                swal('Title', 'field required');
            }else if(text === ''){
                swal('Title', 'can not be empty!');
            }else if ($('#thumbnail_image').val() == '' && $('#thumbnail_image_tmp').val() == '') {
                swal('Thumbnail image', 'field required');
                return false;
            }else if ($('#introduction').val() == '') {
                swal('Introduction', 'field required');
                return false;
            } else {
                var $active = $('.wizard .nav-tabs li a.active');
                $active.parent().next().children().removeClass('disabled');
                $active.parent().addClass('done');
                nextTab($active);
            }
        });

        ///start step-2 validation ///
        $(".videoBtn").click(function(e) {
            let videoLesson = new FroalaEditor('#video_lesson', {}, function() {});
            let contentPost = videoLesson.html.get();
            content = contentPost;
            let textContent = $(contentPost).text();
            textContent = textContent.trim();
            // if (textContent === '') {
            //     swal('Please enter content in the editor.')
            // } else {
                var $active = $('.wizard .nav-tabs li a.active');
                $active.parent().next().children().removeClass('disabled');
                $active.parent().addClass('done');
                nextTab($active);
            // }
        });
        ///end step-2 validation

        ///start step-3 validation
        // optional
        // end 3 validation

        ///start step-4 validation
        $('.taskBtn').click(function(e) {
            let Taskedit = new FroalaEditor('#task', {}, function() {});
            // Get the content from the Froala Editor
            let contentpost = Taskedit.html.get();
            content = contentpost;
            let textContent = $(contentpost).text();
            // Remove leading and trailing whitespace (including line breaks)
            textContent = textContent.trim();
            // if (textContent === '') {
                // Content is empty, display an error message
                //swal('Please enter content in the editor.')
            // } else {
                var $active = $('.wizard .nav-tabs li a.active');
                $active.parent().next().children().removeClass('disabled');
                $active.parent().addClass('done');
                nextTab($active);
            // }
        })
        //end step-4 validation

        //start step-5 validation
        // create form (skip)
        //end step-5 validation

        //start step-6 validation
        $('.reflextionBtn').click(function() {
            let reflextionBtn = new FroalaEditor('#reflection_questions', {}, function() {});
            // Get the content from the Froala Editor
            let contentpost = reflextionBtn.html.get();
            content = contentpost;
            let textContent = $(contentpost).text();
            // Remove leading and trailing whitespace (including line breaks)
            textContent = textContent.trim();
            // if (textContent === '') {
                // Content is empty, display an error message
                //swal('Please enter content in the editor.')
            // } else {
                var $active = $('.wizard .nav-tabs li a.active');
                $active.parent().next().children().removeClass('disabled');
                $active.parent().addClass('done');
                nextTab($active);
            // }
        });
        //end step-6 validation

        //start step-7 validation
        $('.reference_linkBtn').click(function() {
            let referenceLinkDescription = new FroalaEditor('#reference_link_description', {}, function() {});
            // Get the content from the Froala Editor
            let contentpost = referenceLinkDescription.html.get();
            content = contentpost;
            let textContent = $(contentpost).text();
            // Remove leading and trailing whitespace (including line breaks)
            textContent = textContent.trim();
            // if (textContent === '') {
                // Content is empty, display an error message
                //swal('Please enter content in the editor.')
            // } else if ($('#reference_link').val() == '') {
                //swal('Reference links', 'field required');
            // } else {
                
                
                var links = $("input[name='reference_link[]']");
                var isValid = true;

                links.each(function () {
                    var linkValue = $(this).val().trim(); // Remove leading and trailing spaces
                    if (linkValue === '') {
                        isValid = false;
                        return false; // Exit the loop early
                    }
                });

                // if (isValid) {
                //     //alert('All links are valid.');
                // } else {
                //     swal('Reference links', 'field required');
                //     return false;
                //     //alert('Some links contain only spaces or are empty.');
                // }
        
        
                var $active = $('.wizard .nav-tabs li a.active');
                $active.parent().next().children().removeClass('disabled');
                $active.parent().addClass('done');
                nextTab($active);
            // }
        });
        //start step-7 validation

        //start step-8 validation
        $('.closure_video').click(function() {
            var course_id =$("#course_id").val();
            let closureVideoDescription = new FroalaEditor('#closure_video_description', {}, function() {});
            // Get the content from the Froala Editor
            let contentpost = closureVideoDescription.html.get();
            content = contentpost;
            let textContent = $(contentpost).text();
            // Remove leading and trailing whitespace (including line breaks)
            textContent = textContent.trim();
            if (textContent === '') {
                // Content is empty, display an error message
                swal('Please enter content in the editor.')
            } else {
                var success_message = "Module update Successfully";
                console.log(success_message);
                Swal.fire({
                    toast: true,
                    icon: 'success',
                    title: success_message,
                    position: 'top-right',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer);
                        toast.addEventListener('mouseleave', Swal.resumeTimer);
                    }
                });
                
                var course_module_id =$("#course_module_id").val();
                $("#checking_completed").val(1);
                // var id = course_module_id;
                
                var id =$("#course_id").val();
                var url = '{{ url('') }}'+'/course-intro/' + id + '/course_modules?course_modules=';
                //window.location.href = url;
            }
        });
        //start step-8 validation

        function nextTab(elem) {
            $(elem).parent().next().find('a[data-toggle="tab"]').click();
        }

        function prevTab(elem) {
            $(elem).parent().prev().find('a[data-toggle="tab"]').click();
        }

        // Select2 with image
        function formatState(state) {
            if (!state.id) {
                return state.text;
            }
            var $state = $(
                '<div class="d-flex gap-2 align-items-center"> <span class="avtar-30"><img src="' + $(state
                    .element).attr('data-src') + '" class="img-flag" /></span> ' + state.text +
                '</span></div>'
            );
            return $state;
        };

        
        $('.add-event-select-img').select2({
            minimumResultsForSearch: Infinity,
            templateResult: formatState,
            templateSelection: formatState
        });      
        
        /// Code For Edit Event modal
        
        $('.select-img').select2({
            minimumResultsForSearch: Infinity,
            templateResult: formatState,
            templateSelection: formatState
        });
        
        // $('#manageEventSettingModal').on('shown.bs.modal', function () {
        //     $('.edit_event_select-img').select2({
        //         minimumResultsForSearch: Infinity,
        //         templateResult: formatState,
        //         templateSelection: formatState
        //     });
        // });

        // $('.edit_event_select-img').select2({
        //     minimumResultsForSearch: Infinity,
        //     templateResult: formatState,
        //     templateSelection: formatState
        // });
        // Dropzone
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        }) // ENABLE TOOLTIP FUNCTION

        // SORT TEAMS
        $(".dropzone-teams, .div-grp").sortable({
            placeholder: "drag-location",
            handle: ".team-handle",
            start: function(e, ui) {
                ui.placeholder.height(ui.helper.outerHeight());
            }
        });

        // SORT USERS
        $(".dropzone-users").sortable({
            connectWith: ".dropzone-users",
            handle: ".user-handle",
            placeholder: "drag-location",
            start: function(e, ui) {
                ui.placeholder.height(ui.helper.outerHeight());
            }
        });
        // 
        $(".eye-close").click(function() {
            $(this).toggleClass("eye-open");
        });

        // Possible improvements:
        // - Change timeline and volume slider into input sliders, reskinned
        // - Change into Vue or React component
        // - Be able to grab a custom title instead of "Music Song"
        // - Hover over sliders to see preview of timestamp/volume change

        // const audioPlayer = document.querySelector(".audio-player");
        // const audio = new Audio(
        // "https://ia800905.us.archive.org/19/items/FREE_background_music_dhalius/backsound.mp3"
        // );
        // //credit for song: Adrian kreativaweb@gmail.com

        // console.dir(audio);

        // audio.addEventListener(
        // "loadeddata",
        // () => {
        //     audioPlayer.querySelector(".time .length").textContent = getTimeCodeFromNum(
        //     audio.duration
        //     );
        //     audio.volume = .75;
        // },
        // false
        // );

        // //click on timeline to skip around
        // const timeline = audioPlayer.querySelector(".timeline");
        // timeline.addEventListener("click", e => {
        // const timelineWidth = window.getComputedStyle(timeline).width;
        // const timeToSeek = e.offsetX / parseInt(timelineWidth) * audio.duration;
        // audio.currentTime = timeToSeek;
        // }, false);

        // //click volume slider to change volume
        // const volumeSlider = audioPlayer.querySelector(".controls .volume-slider");
        // volumeSlider.addEventListener('click', e => {
        // const sliderWidth = window.getComputedStyle(volumeSlider).width;
        // const newVolume = e.offsetX / parseInt(sliderWidth);
        // audio.volume = newVolume;
        // audioPlayer.querySelector(".controls .volume-percentage").style.width = newVolume * 100 + '%';
        // }, false)

        // //check audio percentage and update time accordingly
        // setInterval(() => {
        // const progressBar = audioPlayer.querySelector(".progress");
        // progressBar.style.width = audio.currentTime / audio.duration * 100 + "%";
        // audioPlayer.querySelector(".time .current").textContent = getTimeCodeFromNum(
        //     audio.currentTime
        // );
        // }, 500);

        // //toggle between playing and pausing on button click
        // const playBtn = audioPlayer.querySelector(".controls .toggle-play");
        // playBtn.addEventListener(
        // "click",
        // () => {
        //     if (audio.paused) {
        //     playBtn.classList.remove("play");
        //     playBtn.classList.add("pause");
        //     audio.play();
        //     } else {
        //     playBtn.classList.remove("pause");
        //     playBtn.classList.add("play");
        //     audio.pause();
        //     }
        // },
        // false
        // );

        // audioPlayer.querySelector(".volume-button").addEventListener("click", () => {
        // const volumeEl = audioPlayer.querySelector(".volume-container .volume");
        // audio.muted = !audio.muted;
        // if (audio.muted) {
        //     volumeEl.classList.remove("icono-volumeMedium");
        //     volumeEl.classList.add("icono-volumeMute");
        // } else {
        //     volumeEl.classList.add("icono-volumeMedium");
        //     volumeEl.classList.remove("icono-volumeMute");
        // }
        // });

        // //turn 128 seconds into 2:08
        // function getTimeCodeFromNum(num) {
        // let seconds = parseInt(num);
        // let minutes = parseInt(seconds / 60);
        // seconds -= minutes * 60;
        // const hours = parseInt(minutes / 60);
        // minutes -= hours * 60;

        // if (hours === 0) return `${minutes}:${String(seconds % 60).padStart(2, 0)}`;
        // return `${String(hours).padStart(2, 0)}:${minutes}:${String(
        //     seconds % 60
        // ).padStart(2, 0)}`;
        // }

    });

    function lightDark() {
        $(function() {
            $('#checkbox').click(function() {
                $('body').toggleClass('dark');
                // Optional: Store the user's theme preference in localStorage
                localStorage.setItem('theme', $('body').hasClass('dark') ? 'dark' : 'light');
            });

            // Check the user's stored theme preference and set it on page load
            var theme = localStorage.getItem('theme');
            if (theme === 'dark') {
                $('body').addClass('dark');
                document.getElementById('checkbox').checked = true;
            }
        });
    }

    lightDark();
</script>
