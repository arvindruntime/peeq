<!--========= Header START  =========-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

<header>
    <nav class="navbar navbar-expand-lg navbar-box">
      <div class="container-fluid px-5">
        <a class="navbar-brand mob-logo" href="{{ url('/') }}"> <img src="{{ asset('landing/assets/images/logo.svg') }}" alt=""></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01"
          aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            class=" in-svg replaced-svg">
            <path d="M3.97461 5.9751H19.9746M3.97461 11.9751H19.9746M3.97461 17.9751H19.9746" stroke="black"
              stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"></path>
          </svg>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
          <a class="navbar-brand des-logo" href="{{ url('/') }}"> <img src="{{ asset('landing/assets/images/logo.svg') }}" alt=""></a>
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="{{ route('landing.about')}}">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('landing.contact')}}">Contact</a>
            </li>
            <li class="nav-item">
              <!-- <a class="nav-link" href="#">Resources</a> -->
            </li>
            <li class="nav-item ms-lg-4">
              <!-- Button trigger modal -->
              <a class="nav-link log-in-btn" href="javascript:void(0);" alt="" id="log-in-btn" data-bs-toggle="modal" data-bs-target="#login-signup">Login
                <img src="{{ asset('landing/assets/images/login-btn.svg') }}"></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <!-- Modal Login and Signup -->
  <div class="modal fade" id="login-signup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <!-- Fliper class -->
      <div class="flip-container">
      <!-- Fliper ID -->
        <div class="flipper" id="flipper">
          
          <!-- Login -->
          <div class="modal-content front border-0">
            <div class="modal-body p-0">
              <div class="lm__login--box">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="lm__shape-1">
                  <img src="{{ asset('landing/assets/images/shape1.svg') }}" alt="">
                </div>
                <div class="lm__shape-2">
                    <img src="{{ asset('landing/assets/images/shape2.svg') }}" alt="">
                </div>
                <div class="lm__shape-3"> <img class="in-svg"
                    src="{{ asset('landing/assets/images/logo-shape.png') }}" alt="">
                </div>
                <div class="lm__login-title">
                    <h2>Login!</h2>
                    <p class="fw-normal">Don't have an account? <a href="javascript:void(0);" class="flipbutton text-green" id="loginButton">Create Account</a>
                    </p>
                </div>
                <div class="lm__login-form">
                    <form id="loginForm" name="loginForm" method="POST" action="{{ route('login') }}" enctype="multipart/form-data">
                      {{-- <form id="loginForm" name="loginForm" method="POST" action="{{ route('login') }}" enctype="multipart/form-data" onsubmit="return submitForm()"> --}}
                        @csrf
                        <div class="row g-3">
                          <!-- Email -->
                            <div class="col-12">
                                <div class="lm__form-input">
                                    <input id="email" type="email" class="form-control  @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" autocomplete="email" autofocus="" placeholder="E-mail Address">
                                    <span>
                                      <img class="in-svg" src="{{ asset('landing/assets/images/mail2.svg') }}" alt="">
                                    </span>
                                    <div class="check check_email" style="display: none;"> <img src="{{ asset('landing/assets/images/check.svg') }}" alt="">
                                    </div>
                                    <div class="invalid-feedback email" role="alert">
                                        {{-- <strong id="email_validation"></strong> --}}
                                    </div>
                                </div>
                            </div>
                            <!-- password -->
                            <div class="col-12">
                                <div class="lm__form-input">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                        name="password" autocomplete="current-password" placeholder="Password"
                                        data-gtm-form-interact-field-id="0">
                                    <span>
                                      <img class="in-svg" src="{{ asset('landing/assets/images/lock.svg') }}" alt="">
                                    </span>
                                    <div class="invalid-feedback password" role="alert">
                                        <strong id="password_validation"></strong>
                                    </div>
                                </div>
                            </div>

                            <div class="text-danger" align="center" style="margin-top: -25px;margin-bottom:20px;">
                                {{-- @if(Session::has('error'))
                                    {{ Session::get('error') }}
                                @endif --}}
                            </div>

                            <!-- Button -->
                            <div class="col-12">
                                <div class="lm__form--button"> <button class="btn btn-primary" type="button" onclick="submitForm()">Login</button>
                                </div>
                            </div>

                            <div class="col-12">
                              <div class="text-start">
                                  <div class="lm__pass"> <a class="text-primary text-decoration-none" href="{{ route('forget.password.get') }}">Forgot Password?</a></div>
                              </div>
                            </div>

                            <div class="col-12 mt-2">
                                <div class="lm__ac--login">
                                    <p>Or Login Using</p>
                                </div>
                            </div>
                            <!-- Social -->
                            <div class="col-12 social-btn mt-0">
                                <div class="lm__ac--social d-flex flex-wrap justify-content-center gap-3">
                                    <a class="btn btn-white gap-2 d-flex align-items-center" href="{{ url('auth/google') }}"> <img
                                        src="{{ asset ('landing/assets/images/google.svg') }}" alt="">Google</a>
                                    <a class="btn btn-white gap-2 d-flex align-items-center" href="{{ url('auth/linkedin') }}"> <img
                                        src="{{ asset ('landing/assets/images/linkedin-icon.png') }}" alt="">Linkedin</a>
                                </div>
                            </div>
                            <!-- Strore -->
                            <div class="col-12">
                            </div>
                        </div>
                    </form>
                </div>
              </div>
            </div>
          </div>

          <!-- Register -->
          <div class="modal-content back border-0">
            <div class="modal-body p-0">
              <div class="lm__login--box">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="lm__shape-1">
                  <img src="{{ asset('landing/assets/images/shape1.svg') }}" alt="">
                </div>
                <div class="lm__shape-2">
                    <img src="{{ asset('landing/assets/images/shape2.svg') }}" alt="">
                </div>
                <div class="lm__shape-3"> <img class="in-svg"
                    src="{{ asset('landing/assets/images/logo-shape.png') }}" alt="">
                </div>
                <div class="lm__login-title">
                    <h2 class="text-green">Create Account</h2>
                    <p class="fw-normal">Already have an account?<a href="javascript:void(0);" class="flipbutton text-primary" id="registerButton">  login </a>
                    </p>
                </div>
                <div class="lm__login-form">
                    <form id="registerForm" name="registerForm" method="POST" enctype="multipart/form-data">
                        <div class="row g-3">
                            <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
                            <!-- First Name -->
                            <div class="col-md-6">
                                <div class="lm__form-input">
                                  <input id="first_name" type="text" placeholder="First Name" class="form-control" name="first_name" value="{{ old('first_name') }}" autocomplete="first_name" autofocus="">
                                    <span>
                                      <img class="in-svg" src="{{ asset('landing/assets/images/person.svg') }}" alt="">
                                    </span>
                                    <div class="invalid-feedback first_name" role="alert"></div>
                                </div>
                            </div>
                            <!-- Last Name -->
                            <div class="col-md-6">
                                <div class="lm__form-input">
                                  <input id="last_name" type="text" placeholder="Last Name" class="form-control" name="last_name" value="{{ old('last_name') }}" autocomplete="last_name" autofocus="">
                                    <span>
                                      <img class="in-svg" src="{{ asset('landing/assets/images/person.svg') }}" alt="">
                                    </span>
                                    <div class="invalid-feedback last_name" role="alert"></div>
                                </div>
                            </div>
                            <!-- Email -->
                            <div class="col-12">
                              <div class="lm__form-input">
                                <input id="rg-email" type="email" placeholder="Email Address" class="form-control" name="email" value="{{ old('email') }}" autocomplete="email">
                                  <span>
                                    <img class="in-svg" src="{{ asset('landing/assets/images/mail2.svg') }}" alt="">
                                  </span>
                                  <div class="invalid-feedback email" role="alert"></div>
                              </div>
                            </div>
                            <!-- Password -->
                            <div class="col-md-6">
                              <div class="lm__form-input">
                                <input id="rg-password" oninput="removeSpaces(this)" type="password" placeholder="Password" class="form-control" name="password" autocomplete="new-password">
                                  <span>
                                    <img class="in-svg" src="{{ asset('landing/assets/images/lock.svg') }}" alt="">
                                  </span>
                                  <div class="invalid-feedback password" role="alert"></div>
                              </div>
                            </div>
                            <!-- Password -->
                            <div class="col-md-6">
                              <div class="lm__form-input">
                                <input id="password_confirmation" type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation" autocomplete="new-password">
                                  <span>
                                    <img class="in-svg" src="{{ asset('landing/assets/images/lock.svg') }}" alt="">
                                  </span>
                                  <div class="invalid-feedback password_confirmation" role="alert"></div>
                              </div>
                            </div>
                            <div class="col-12">
                              <!-- Start code to check Password strong or not -->
                                <div class="si_pwd_validate row mb-3" style="display: none; text-align:start;">
                                    <div class="col-12">
                                        <div class="sipwd"><input type="radio" disabled="" value="1" name="val[8char]"  class="pwd_radio" id="pwd-8"><span class="length valid rss_reject">Min 8 characters </span></div>
                                        <div class="sipwd"><input type="radio" disabled="" value="1" name="val[Upper]"  class="pwd_radio" id="pwd-upper"><span class="upper valid rss_reject">One Upper Case </span></div>
                                    </div>
                                    <div class="col-12">
                                        <div class="sipwd"><input type="radio" disabled="" value="1" name="val[lower]"  class="pwd_radio" id="pwd-lower"><span class="lower valid rss_reject">One Lower Case </span></div>
                                        <div class="sipwd"><input type="radio" disabled="" value="1" name="val[pwd-number]"  class="pwd_radio" id="pwd-number"><span class="num valid rss_reject">One Number</span> </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="sipwd"><input type="radio" disabled="" value="1" name="val[spl]"  class="pwd_radio" id="pwd-special"><span class="spl valid rss_reject">One Special Character </span></div>
                                        {{-- <div class="sipwd"><input type="radio" value="1" name="val[10char]"  class="pwd_radio" id="pwd-maxlength"><span class="length valid rss_reject">Maximum 10 Characters </span></div> --}}
                                    </div>
                                </div>
                              <!-- End code to check Password strong or not -->
                            </div>
                            
                            
                            <div class="col-12">
                                <div class="lm__form-wrap d-flex flex-column justify-content-between align-items-center gap-3">
                                  <div class="form-check text-white text-start position-relative">
                                    <input class="form-check-input" type="checkbox" name="is_terms_and_condition" id="is_terms_and_condition">
                                    {{-- <a href="https://peeq.com.au/terms-of-service" target="_blank" class="form-check-label text-white text-decoration-none" for="gridCheck">
                                      Agree to Terms Of Service
                                    </a> --}}
                                    <label for="is_terms_and_condition">I agree to the <a href="{{ route('terms.conditions') }}" target="_blank" class="form-check-label text-primary text-decoration-none"> Terms of Service</a>
                                        and <a href="{{ route('privacy.policy') }}" target="_blank" class="form-check-label text-primary text-decoration-none">Privacy Policy</a> (required)</label>
                                        <div class="invalid-feedback is_terms_and_condition" role="alert"></div>
                                  </div>
                                  
                                  <div class="form-check text-white text-start">
                                    <input name="is_agree_to_commercial_email" id="is_agree_to_commercial_email" class="form-check-input" type="checkbox">
                                    <label for="is_agree_to_commercial_email">I agree to receive the occasional marketing emails from PEEQ™ regarding products and services.</label>
                                  </div>
                                  
                                </div>
                            </div>
                            
                            <div class="col-12">
                              <div class="lm__form--button"> <button class="btn btn-primary" type="button" onclick="submitSignupForm()">Create My Account</button>
                              </div>
                          </div>
                          
                            <div class="col-12">
                                <div class="lm__ac--login">
                                    <p>Or Create Account Using</p>
                                </div>
                            </div>
                            <div class="col-12 social-btn mt-0">
                                <div class="lm__ac--social d-flex justify-content-center gap-4">
                                    <a class="btn btn-white gap-2 d-flex align-items-center" href="{{ url('auth/google') }}"> <img
                                        src="{{ asset('landing/assets/images/google.svg') }}" alt="">Google</a>
                                    <a class="btn btn-white gap-2 d-flex align-items-center" href="{{ url('auth/linkedin') }}"> <img
                                        src="{{ asset('landing/assets/images/linkedin-icon.png') }}" alt="">Linkedin</a>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="lm__form-privacy sign-up">
                                  <p class="mt-0 text-white">You agree to the PEEQ™ <a class="text-primary text-decoration-none" target="blank" href="{{ route('terms.conditions') }}"> Terms Of Service </a> , <a class="text-primary text-decoration-none" target="blank" href="{{ route('privacy.policy') }}">Privacy Policy </a> and <a class="text-primary text-decoration-none" target="blank" href="{{ route('cookie.policy') }}"> Cookie Policy </a> Copyright © {{ date('Y') }} PEEQ™.</p>
                              </div>
                            </div>
                        </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Login and Signup -->
  <div class="modal fade" id="peeq_support" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered peeq_support">
      <!-- Login -->
      <div class="modal-content front border-0">
        <div class="support_wrapper">
            <div class="icon_wrapper">
              <img src="{{ asset('landing/assets/images/emojione_handshake.svg') }}" alt="">
            </div>
            <h2>Thank you for your enquiry</h2>
            <p>The PEEQ™ support team will be in touch with you soon. </p>
            <button class="btn btn-primary" data-bs-dismiss="modal" >Continue</button>
        </div>
      </div>
    </div>
  </div>

  <!--========= Header END =========-->
  <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    $(document).ready(function() {
    $('#is_terms_and_condition').on('click', function() {
        var $checkbox = $(this);
        var $inputContainer = $checkbox.closest('.lm__form-input');
        var $errorContainer = $inputContainer.find('.invalid-feedback.is_terms_and_condition');        
        if ($checkbox.is(':checked') === true) {
            $(".is_terms_and_condition").html('');
        }
    });
});

    function submitForm() {
        var form = $('#loginForm');
        var formData = form.serialize();
        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: formData,
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
              // // alert("hey");
              // console.log(response);
              // // if (response.status && response.status === 200) {
              //   var successMessage = response.message;
              //     Swal.fire({
              //         toast: true,
              //         icon: 'success',
              //         title: successMessage ,
              //         position: 'top-right',
              //         showConfirmButton: false,
              //         timer: 2000,
              //         timerProgressBar: true,
              //         // footer: '<a href="">Click to open</a>',
              //         didOpen: (toast) => {
              //         toast.addEventListener('mouseenter', Swal.stopTimer)
              //         toast.addEventListener('mouseleave', Swal.resumeTimer)
              //         }
              //     });
                  
                  window.location.replace('{{ route("posts.index") }}');
                  // return true;
                // }
            },
            error: function (xhr, status, error) {
          //$(".lm__form-input").addClass("mb-3");
          
            $.each(xhr.responseJSON.errors, function (key, item) 
            {
              console.log(key);
                $("#loginForm ."+key).show();
                $("#loginForm ."+key).html(item);
            });
            }
            // error: function(error) {
            //   console.log(error);
            //   if (error.status && error.status === 422) {
            //     var errorMessage = error.responseJSON.message;
            //       Swal.fire({
            //           toast: true,
            //           icon: 'warning',
            //           title: errorMessage ,
            //           position: 'top-right',
            //           showConfirmButton: false,
            //           timer: 2000,
            //           timerProgressBar: true,
            //           // footer: '<a href="">Click to open</a>',
            //           didOpen: (toast) => {
            //           toast.addEventListener('mouseenter', Swal.stopTimer)
            //           toast.addEventListener('mouseleave', Swal.resumeTimer)
            //           }
            //       });
            //     }
            // }
        });
        // Return false to prevent the default form submission
        return false;
    }
    
      $(document).on('keyup', '#rg-password', function () {
        removeSpaces(this);
        
            $(".si_pwd_validate").css("display", "block");
            var myInput = document.getElementById("rg-password").value;
            var letter = document.getElementById("pwd-lower");
            var capital = document.getElementById("pwd-upper");
            var number = document.getElementById("pwd-number");
            var special = document.getElementById("pwd-special");
            var length = document.getElementById("pwd-8");
            // var maxlength = document.getElementById("pwd-maxlength"); // Add this line
            console.log(myInput);
            // Validate capital letters
            var lowerCaseLetters = /[a-z]/g;
            if (myInput.match(lowerCaseLetters)) {
                letter.checked = true
                $('.lower').removeClass('rss_reject');
            } else {
                letter.checked = false
            }

            // Validate capital letters
            var upperCaseLetters = /[A-Z]/g;
            if (myInput.match(upperCaseLetters)) {
                capital.checked = true
                $('.upper').removeClass('rss_reject');
            } else {
                capital.checked = false;
            }

            // Validate numbers
            var numbers = /[0-9]/g;
            if (myInput.match(numbers)) {
                number.checked = true
                $('.num').removeClass('rss_reject');
            } else {
                number.checked = false
            }

            // Validate length
            if (myInput.length >= 8) { // Check both minimum (8) and maximum (10) length
                length.checked = true
                $('.length').removeClass('rss_reject');
                //maxlength.style.display = "none"; // Hide the maxlength error message
            } else {
                length.checked = false
                //maxlength.style.display = "block"; // Display the maxlength error message
            }
            
            // Validate length
            // if (myInput.length >= 8 && myInput.length <= 10 && !/\s/.test(myInput)) { // Check both minimum (8) and maximum (10) length
            //     length.checked = true
            //     $('.length').removeClass('rss_reject');
            //     maxlength.style.display = "none"; // Hide the maxlength error message
            // } else {
            //     length.checked = false
            //     maxlength.style.display = "block"; // Display the maxlength error message
            // }

            // Validate special characters
            var specialchar = /[-’/`~!#*$@_%+=.,^&(){}[\]|;:”<>?\\]/g
            if (myInput.match(specialchar)) {
                special.checked = true
                $('.spl').removeClass('rss_reject');
            } else {
                special.checked = false
            }

            var checkedradio = $('.pwd_radio:checked').length;
            if (checkedradio == 5) {
                $(".si_pwd_validate").css("display", "none");
            }
        });
    function removeSpaces(input) {
        // Remove spaces from the input value
        input.value = input.value.replace(/\s/g, '');
    }
    
    
    function submitSignupForm() {
      //$('.lm__form-input').removeClass('mb-3');
      $('.lm__form-input input').on('input', function() {
        var $inputContainer = $(this).closest('.lm__form-input');
        //$(this).removeClass('mb-3');
          $inputContainer.removeClass('has-error');
          $inputContainer.find('.invalid-feedback').empty();
      });
      
      
      var is_terms_and_condition = 0; // Default value

    if ($("#is_terms_and_condition").prop('checked')) {
        is_terms_and_condition = 1;
        var $checkbox = $('#is_terms_and_condition');
        var $inputContainer = $checkbox.closest('.lm__form-input');
        var $errorContainer = $inputContainer.find('.invalid-feedback');
        $inputContainer.removeClass('has-error');
        $errorContainer.empty();
    }
      
    var form = $('#registerForm')[0]; // Access the native DOM element, not the jQuery object
    var formData = new FormData(form); // Create a new FormData object

    var errorMessage = '';

    if ($("#is_terms_and_condition").prop('checked')) {
        var is_terms_and_condition = 1;
    } else {
        //var is_terms_and_condition = 0;
        // errorMessage = 'Please read and accept the Terms of Service and Privacy Policy';

        // Swal.fire({
        //     toast: true,
        //     icon: 'warning',
        //     title: errorMessage,
        //     position: 'top-right',
        //     showConfirmButton: false,
        //     timer: 2000,
        //     timerProgressBar: true,
        //     didOpen: (toast) => {
        //         toast.addEventListener('mouseenter', Swal.stopTimer);
        //         toast.addEventListener('mouseleave', Swal.resumeTimer);
        //     }
        // });

        // return false;
    }

    var is_agree_to_commercial_email = $("#is_agree_to_commercial_email").prop('checked') ? 1 : 0;
    var is_agree_to_activity_email= 0;

    formData.append('_token', $("#csrf").val());
    formData.append('type', 1);
    formData.append('is_terms_and_condition', is_terms_and_condition);
    formData.append('is_agree_to_commercial_email', is_agree_to_commercial_email);
    formData.append('mobile_no', '');
    formData.append('is_agree_to_activity_email', is_agree_to_activity_email);
    
    
    console.log("Form Data Entries:");

for (var pair of formData.entries()) {
    console.log(pair[0] + ': ' + pair[1]);
}

    $.ajax({
        type: "POST",
        url: "{{ route('register')}}",
        data: formData,
        cache: false,
        processData: false, // Prevent jQuery from processing the data
        contentType: false, // Prevent jQuery from setting the content type
        beforeSend: function(xhr) {
            // Set headers here if needed
        },
        success: function (data) {
            console.log("Success - " + data);
            // var successMessage = data.message;

            // Swal.fire({
            //     toast: true,
            //     icon: 'success',
            //     title: successMessage,
            //     position: 'top-right',
            //     showConfirmButton: false,
            //     timer: 2000,
            //     timerProgressBar: true,
            //     didOpen: (toast) => {
            //         toast.addEventListener('mouseenter', Swal.stopTimer);
            //         toast.addEventListener('mouseleave', Swal.resumeTimer);
            //     }
            // });
            window.location = "{{route('paymentPlans.index')}}";
            
            // Wait for 10 seconds before redirecting
            // setTimeout(function() {
            //     window.location = "{{route('paymentPlans.index')}}";
            // }, 10000); // 10000 milliseconds = 10 seconds
        },
        
        error: function (xhr, status, error) {
          //$(".lm__form-input").addClass("mb-3");
          
            $.each(xhr.responseJSON.errors, function (key, item) 
            {
                $("#registerForm ."+key).show();
                $("#registerForm ."+key).html(item);
            });
        }
                    
        // error: function (xhr, textStatus, errorThrown) {
        //       // Handle error
        //       console.log(xhr);

        //       if (xhr.status === 422) {
        //           // Handle validation errors or specific error format
        //           var errorMessage = '';

        //           if (xhr.responseJSON && xhr.responseJSON.errors) {
        //               // Assuming Laravel validation error format
        //               errorMessage = Object.values(xhr.responseJSON.errors).flat().join('<br>');
        //           } else if (xhr.responseJSON && xhr.responseJSON.message) {
        //               // Assuming a general error message format
        //               errorMessage = xhr.responseJSON.message;
        //           } else {
        //               // Handle other cases if needed
        //               errorMessage = 'An error occurred. Please try again.';
        //           }

        //           Swal.fire({
        //               toast: true,
        //               icon: 'warning',
        //               title: errorMessage,
        //               position: 'top-right',
        //               showConfirmButton: false,
        //               timer: 2000,
        //               timerProgressBar: true,
        //               didOpen: (toast) => {
        //                   toast.addEventListener('mouseenter', Swal.stopTimer);
        //                   toast.addEventListener('mouseleave', Swal.resumeTimer);
        //               }
        //           });
        //       } else {
        //           // Handle other error cases
        //           Swal.fire({
        //               toast: true,
        //               icon: 'error',
        //               title: 'An error occurred. Please try again.',
        //               position: 'top-right',
        //               showConfirmButton: false,
        //               timer: 2000,
        //               timerProgressBar: true,
        //               didOpen: (toast) => {
        //                   toast.addEventListener('mouseenter', Swal.stopTimer);
        //                   toast.addEventListener('mouseleave', Swal.resumeTimer);
        //               }
        //           });
        //       }

        //       return false;
        //   }
    });

    return false;
}


</script>
    
  {{-- <script>
    $(document).ready(function () {
        $('#loginForm').submit(function (event) {
            event.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function (response) {
                  console.log('hey');
                    console.log(response.status);
                    if (response.status === 200 && response.statusState === 'success') {
                      window.location.href = '{{ route("paymentPlans.index") }}';
                    }
                },
                error: function (error) {
                    console.log(error.status);
                    if (response.status === 422 && response.statusState === 'error') {
                        
                    }
                }
            });
        });
    });
  </script> --}}

  <script>
    $(document).ready(function(){        
        $("#email").change(function(e){
            e.preventDefault();
            var email = $(this).val();
            let url = '{{ route("check.email.user", ":email") }}';
            url = url.replace(':email', email); 
            $.ajax({
                url: url,
                method: "get"    
            }).done(function(response) {
                console.log(response.message);
                if(response.message == "register") {
                    $('.check_email').show();
                    $('.invalid-feedback').html('');
                } else {
                    $('.check_email').hide();
                }
            });
        });
    });
  </script>