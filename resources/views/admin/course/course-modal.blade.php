
<!-- Course Invite -->
<div class="offcanvas offcanvas-end lm_profile-modal lm_create-modal" id="courseshare" tabindex="-1"
  aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasRightLabel">Skip</h5><button class="btn-close" type="button"
      data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <form name="send_inviteCourseForm" id="send_inviteCourseForm">
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
          <input class="form-control courseViewUrl" type="text" aria-label="Recipient's username" aria-describedby="button-addon2">
          <button class="btn btn--dark py-1 rounded-5" onclick="copyCourseViewUrl()">Copy Link</button>
        </div>
      </div>
      <div class="lm_in-mail">
        <h5 class="text-center fw-bold">Invite by Email</h5>
        <div class="mb-3"> 
            {{-- <input class="form-control shadow" type="text" placeholder="Add multiple email addresses here"> --}}
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
        <div class="lm_send"> <button class="btn btn--primary" id="send_inviteCourse">Send</button></div>
                            
                            
            {{-- <select class="form-select form-control"
              id="select_box9">
              <option>Invite as host</option>
              <option value="a">Invite as Maderators</option>
              <option value="c">Invite as Member</option>
            </select></div>
          <div class="lm_send"> <button class="btn btn--primary">Send</button></div> --}}
        </div>
      </div>
    </div>
  </div>
  </form>
</div>
<script type="text/javascript">
function OpenShareCourseModal(url='')
{
    $(".courseViewUrl").val(url);
    $("#courseshare").offcanvas("show");
}
function copyCourseViewUrl() {
    var url = $(".courseViewUrl").val();
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
        $("#send_inviteCourse").on("click", function(event) {
            
            var buttonClick = "#send_inviteCourse";
            let _token = $("input[name=_token]").val();
            var email = $("input[name=invite_emailsCourse]").val();
            var message = $("#message").val();
            var user_type = $("select[name='user_typeCourse']").val();
            var invite_type = 'course';
             
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
                    
                    $("#courseshare").offcanvas("hide");

                    $("#send_inviteCourseForm")[0].reset();
                                        
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