@extends('layouts.admin.master')
@section('content')


<main class="main-content" id="main">
    <section class="lm__dash-con lm__course-list-admin change_password">
      <span class="lm_vec"><img class="light"
        src="{{asset('assets/images/light.png')}}" alt=""><img class="dark" src="{{asset('assets/images/dark.png')}}" alt=""></span>
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="create-list-admin">
              <div class="create-list-admin-title">
                <h4 class="mb-0">Change Password</h4>
              </div>
              <div class="create-admin-form">
                <form method="post" name="changePasswordForm" id="changePasswordForm">
                  <div class="row">
                    <span class="error-message" style="color: red;"></span>
                    <div class="col-12">
                        
                        <div class="mb-3 admin-file-inp">
                            <label class="form-label" for="old_password">Old Password</label>
                            <input class="form-control shadow" name="old_password" id="old_password" type="password"
                            placeholder="Old Password">
                        </div>
                        <div class="mb-3 admin-file-inp">
                            <label class="form-label" for="new_password">New Password</label>
                            <input class="form-control shadow" name="new_password" id="new_password" type="password"
                            placeholder="New Password">
                        </div>
                        <div class="mb-3 admin-file-inp">
                            <label class="form-label" for="confirm_password">Confirm Password</label>
                            <input class="form-control shadow" name="confirm_password" id="confirm_password" type="password"
                            placeholder="Confirm Password">
                        </div> 
                    </div>
                    <div class="col-6 mx-auto">                     
                        <div class="lm_crt-btn d-block w-100">
                          <input type="button" class="btn btn--primary btn_ChangePassword w-100" value="Update">
                        </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

<script>
    
     /////// Create Event Start
     $(document).ready(function() {
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $(".btn_ChangePassword").click(function(e) {
            e.preventDefault();
            $('.error-message').text('');
            let _token = $("input[name=_token]").val();
            var dataArray = {
                _token: _token
            , };
            var formData = new FormData($("#changePasswordForm")[0]);

            $.ajax({
                url: "{{route('change.password')}}"
                , type: "POST"
                , data: formData
                , dataType: 'json'
                ,async: false
                , cache: false
                , contentType: false
                , processData: false 
                , success: function(data) {
                    if (data.error) {
                        return false;
                    } else if (data.status == "200") {
                        
                        $("#changePasswordForm")[0].reset();
                        
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
                        
                    }

                },
                error: function(xhr, status, error) {
                    var errorMessage = "An error occurred. Please try again."; // Default error message
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        // console.log(xhr.responseJSON);
                        errorMessage = xhr.responseJSON.message; // Use the error message from the API response
                    }
                    // Set the error message in the desired HTML tag
                    $('.error-message').text(errorMessage);
                }
            });
        });    
    });
        
        // btn_saveDraftEvent
</script>
@endsection
