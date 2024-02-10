<div class="modal fade" id="DeleteSessionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered lm__modal-4">
      <input type="hidden" id="delete_session_id">
      <div class="modal-content overflow-hidden">
          <div class="modal-body p-4 text-center position-relative">
              <div class="modal-header p-0"><button class="btn-close" type="button" data-bs-dismiss="modal"
                      aria-label="Close"><span> <img class="in-svg" src="{{asset('assets/images/close.svg')}}"
                              alt=""></span></button></div>
              <div class="z-index-1 position-relative lm_mxw50">
                  <h4 class="text-white">Are you sure you want to delete this session?</h4><button
                      class="btn btn--danger mt-3 title-font rounded-2 py-2" onclick="delete_session()">Delete</button><button
                      class="btn-close text-white d-block w-100 mt-2 title-font" type="button" data-bs-dismiss="modal"
                      aria-label="Close">Cancel</button>
              </div>
          </div>
      </div>
  </div>
</div>


<div class="modal fade" id="bookmy_session" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered lm__modal-4 book_session">
    <div class="modal-content overflow-hidden">
      <div class="modal-body p-4 text-center position-relative">
          <div class="modal-header p-0"><button class="btn-close" type="button" data-bs-dismiss="modal"
                  aria-label="Close"><span> <img class="in-svg" src="{{asset('assets/images/close.svg')}}"
                          alt=""></span></button></div>
          <div class="z-index-1 position-relative lm_mxw50">
              <h5 class="fw-bold session_booking_title"></h5>
              <p class="text-dark">We invite you to schedule your session with the coach via Calendly. Should you encounter any scheduling challenges, please do not hesitate to contact us directly at <a href="#" class="text-primary">support@peeq.com.au</a>, and we will gladly assist in rearranging your appointment. We have also sent this link to your email should you want to book later.</p>
          </div>
          {{-- Second popup btn --}}
          <div id="calendlyAppend">
            {{-- data-bs-dismiss="modal" aria-label="Close" --}}
            {{-- {{ $response['purchased_session_calendly_url'] }} --}}
            <a class="btn btn--primary rounded-5 purchased_session_calendly_url" href="" target="_blank">Book My Session</a>
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
  
<!-- Sessions Invite -->
<div class="offcanvas offcanvas-end lm_profile-modal lm_create-modal" id="sessionshare" tabindex="-1"
  aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasRightLabel">Skip</h5><button class="btn-close" type="button"
      data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <form name="send_inviteSessionForm" action="#" id="send_inviteSessionForm">
  <div class="offcanvas-body p-0">
    <div class="lm_profile-modal p-2">
      <div class="row align-items-center">
        <div class="col-12 text-center">
          <h5 class="text-white mb-0">Invite</h5>
        </div>
      </div>
    </div>
    <div class="lm_create-body invite-body" style="overflow: auto; max-height: 85vh;">
      <div class="lm_in-mem">
        <h5 class="text-center fw-bold">Invite Members</h5>
        <div class="input-group mb-3 invite-input rounded-5 shadow">
          <input class="form-control sessionViewUrl" type="text" aria-label="Recipient's username" aria-describedby="button-addon2">
          <input type="button" class="btn btn--dark py-1 rounded-5" onclick="copySessionViewUrl()" value="Copy Link">
        </div>
      </div>
      <div class="lm_in-mail">
        <h5 class="text-center fw-bold">Invite by Email</h5>
        <div class="mb-3"> 
            <input name="invite_emailsCourse" class="form-control shadow" type="text" placeholder="Add multiple emails here separated by comma.">
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
                <textarea rows="8" cols="100" name="message" id="message" placeholder="Additional messages here if Any...."></textarea>
            </div>
          </div>
        </div>
        {{-- <div class="d-block">
          <p class="text-sm-12 mb-0 fw-bold">NETWORK PERMISSIONS</p>
          <p class="mb-0 color-light">Choose what permissions these members will have in PEEQ.</p>
        </div> --}}
        <div class="d-flex mt-3 justify-content-between">
          <div class="lm_post-input-emoji mb-2 me-3">
            
            @if(Auth::user()->is_admin == 1)
            <select class="form-select form-control js-example-basic-single" id="select_boxCourse" name="user_typeCourse">
                <option value="host">Invite as host</option>
                <option value="coach">Invite as Coach</option>
                <option value="member" selected>Invite as Member</option>
            </select>
            @else
            Invite as Member
            <input type="hidden" value="member" name="user_typeCourse" class="form-control">
            @endif
        </div>
        <div class="lm_send"> <button class="btn btn--primary" id="send_inviteSession">Send</button></div>

        </div>
      </div>
    </div>
  </div>
  </form>
</div>
<script type="text/javascript">
    function CoursePreviewVideo(url) {
      $("#coursePreviewVideoURL").attr('src', url);
      console.log('coursePreviewVideoURL');
      } 
    </script>
    
<script type="text/javascript">
function OpenShareSessionModal(url='')
{
    $(".sessionViewUrl").val(url);
    $("#sessionshare").offcanvas("show");
}
function copySessionViewUrl() {
    var url = $(".sessionViewUrl").val();
    navigator.clipboard.writeText(url)
        .then(() => {
            Swal.fire({
                toast: true,
                icon: 'success',
                title: 'URL copied successfully!',
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

    $(document).ready(function() {          
        $("#send_inviteSession").on("click", function(event) {
            
            var buttonClick = "#send_inviteSession";
            let _token = $("input[name=_token]").val();
            var email = $("input[name=invite_emailsCourse]").val();
            var message = $("#message").val();
            var user_type = $("select[name='user_typeCourse']").val();
            var invite_type = 'session';
             
            $(buttonClick).attr("disabled", true);
            $(".print-error-msg").html('');
            $(buttonClick).addClass('loader-button');
            
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
                    message: message,
                    user_type: user_type,
                    invite_type: invite_type,
                    _token: _token,
                },
                dataType: 'JSON',
                success: function(data) {
                    console.log('arvind');
                    $("input[name=invite_emailsCourse]").val('');
                    console.log(data);
                    // getData();
                    $(buttonClick).attr("disabled", false);
                    $(buttonClick).removeClass('loader-button');
                    $('.spinner-border').hide();
                    
                    $("#sessionshare").offcanvas("hide");

                    $("#send_inviteSessionForm")[0].reset();
                                        
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
                    $(buttonClick).attr("disabled", false);
                // Handle the AJAX error response
                }
            });
        
        });
    });
</script>