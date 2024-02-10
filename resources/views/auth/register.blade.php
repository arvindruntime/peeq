@extends('layouts.master')
@section('content')

<style>

/* For coming soon  START*/
.coming-soon{
    position:absolute;
    top: 50%;
    width: 100%;
    left: 50%;
    color: #ffffff;
    z-index: 999;
    font-weight:500;
    transform: translate(-50%, -50%);
}

/* For coming soon  END*/
.si_pwd_validate {
    display: flex;
    flex-flow: row wrap;
    /* width: 100%; */
    /* max-width: 800px; */
    justify-content: space-between;
    line-height: 25px !important;
    /* margin-top: 14px; */
}

.si_pwd_validate .sipwd {
    width: calc(100% / 2 - 20px);
    display: inline-flex;
    align-items: center;
    line-height: inherit;
    color: #ffffff;
    font-size: 13px !important;
}

.si_pwd_validate .sipwd input {
    width: 15px;
    height: 15px;
    margin-top: -1px;
    margin-left: 0;
    margin-right: 9px;
    appearance: none;
    padding: 0;
    border: 1px solid #e4ebf3;
    background-clip: border-box;
    border-radius: 50%;
}

.si_pwd_validate .sipwd input:checked {
    background-color: #e3a130;
    border-color: #e3a130 !important;
}
.si_pwd_validate .sipwd span {
    white-space: nowrap;
    /* width: calc(100% - 10%); */
    overflow: hidden;
    text-overflow: ellipsis;
}
@media(max-width:480px){
    .si_pwd_validate {
        max-width: 100%;
    }
    
    .si_pwd_validate .sipwd {
        width: 100%;
    }
}
</style>
    <header class="lm__header-logo">
        <div class="container-fluid">
            <div class="row">
                <div class="col"> <a class="lm-logo" href="{{config('app.url')}}/"><img class="in-svg" src="{{ asset('assets/images/logo.svg') }}" alt=""></a>
                </div>
            </div>
        </div>
    </header>
    <main class="main-content" id="main">
        <section class="lm__hero">
            <div class="lm__hero--inner">
                <div class="container">
                    <div class="row">
                        <div class="col col-lg-10 mx-auto">
                            <div class="lm__login--box">
                                <div class="lm__login-title">
                                    <h2>Sign Up</h2>
                                    <p class="fw-normal">Already have an account? <a href="{{ route('login') }}"> Sign In</a></p>
                                </div>
                                <div class="lm__login-form">
                                    <form class="mb-0" id="form" name="registerForm" method="POST" enctype="multipart/form-data">
                                        {{-- @csrf --}}
                                        <div class="row">
                                            <div class="col col-lg-3 lm__upd-col pe-lg-4">
                                                <div class="lm__upd my-4"><label for="profile_image"> 
                                                    <div class="rounded-circle profile_img-wrap">
                                                        <img class="mx-auto profile_image_preview" src="{{ asset('assets/images/upload.svg')}}" alt="">
                                                    </div>
                                                    <input id="profile_image" type="file" name="profile_image" accept="image/*" hidden><br><span class="flex">
                                                        <img class="in-svg" src="{{ asset('assets/images/PlusLg.svg')}}" alt="">Upload Photo</span></label>
                                                    {{-- <div class="lm__ac--login">
                                                        <p>OR</p>
                                                    </div> --}}
                                                    {{-- <div class="lm__link flex align-items-center">
                                                        <p class="mb-0 mr-2">Link photo from</p>
                                                        <img class="in-svg" src="{{ asset('assets/images/linkedin.svg')}}" alt="">
                                                    </div> --}}
                                                </div>
                                            </div>
                                            <div class="col col-lg-9 ps-lg-4">
                                                <div class="row">
                                                    <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
                                                    <div class="col col-lg-6">
                                                        <div class="lm__form-input"> <input id="first_name" type="text" placeholder="First Name" class="form-control" name="first_name" value="{{ old('first_name') }}" autocomplete="first_name" autofocus> 
                                                            <span><img class="in-svg" src="{{ asset('assets/images/man.svg')}}" alt=""></span>
                                                            <div class="invalid-feedback position-absolute first_name" role="alert"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col col-lg-6">
                                                        <div class="lm__form-input"> <input id="last_name" type="text" placeholder="Last Name" class="form-control" name="last_name" value="{{ old('last_name') }}" autocomplete="last_name" autofocus> 
                                                            <span><img class="in-svg" src="{{ asset('assets/images/man.svg')}}" alt=""></span>
                                                                <div class="invalid-feedback position-absolute last_name" role="alert"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col col-lg-6">
                                                        <div class="lm__form-input mb-0"> <input id="mobile_no" type="text" maxlength="15" minlength="6" placeholder="Mobile Number" class="form-control" name="mobile_no" value="{{ old('mobile_no') }}" autocomplete="mobile_no" autofocus pattern="[0-9]">
                                                            <span><img class="in-svg" src="{{ asset('assets/images/call.svg')}}" alt=""></span>
                                                                <div class="invalid-feedback position-absolute mobile_no" role="alert"></div>
                                                            </div>
                                                            <span class="text-white d-block my-1 text-start ps-2 text-sm-14">Add number without 0 or +</span>
                                                    </div>
                                                    <div class="col col-lg-6">
                                                        <div class="lm__form-input"> <input id="email" type="email" placeholder="Email Address" class="form-control" name="email" value="{{ old('email') }}" autocomplete="email"> 
                                                            <span><img class="in-svg" src="{{ asset('assets/images/mail.svg')}}" alt=""></span>
                                                                <div class="invalid-feedback position-absolute email" role="alert"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col col-lg-6">
                                                        <div class="lm__form-input">
                                                            <input id="password" type="password" placeholder="Password" oninput="removeSpaces(this)" class="form-control" name="password" autocomplete="new-password"> 
                                                            <span><img class="in-svg" src="{{ asset('assets/images/lock.svg')}}" alt=""></span>
                                                            
                                                            <div class="invalid-feedback position-absolute password" role="alert"></div>   
                                                            
                                                            
                                                        </div>
                                                            
                                                            <div class="si_pwd_validate row mb-3" style="display: none; text-align:start;">
                                                                <div class="col-12">
                                                                    <div class="sipwd"><input type="radio" value="1" name="val[8char]"  class="pwd_radio" id="pwd-8" disabled><span class="length valid rss_reject">Min 8 Characters </span></div>
                                                                    <div class="sipwd"><input type="radio" value="1" name="val[Upper]"  class="pwd_radio" id="pwd-upper" disabled><span class="upper valid rss_reject">One Upper Case </span></div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="sipwd"><input type="radio" value="1" name="val[lower]"  class="pwd_radio" id="pwd-lower" disabled><span class="lower valid rss_reject">One Lower Case </span></div>
                                                                    <div class="sipwd"><input type="radio" value="1" name="val[pwd-number]"  class="pwd_radio" id="pwd-number" disabled><span class="num valid rss_reject">One Number</span> </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="sipwd"><input type="radio" value="1" name="val[spl]"  class="pwd_radio" id="pwd-special" disabled><span class="spl valid rss_reject">One Special Character </span></div>
                                                                    {{-- <div class="sipwd"><input type="radio" value="1" name="val[10char]"  class="pwd_radio" id="pwd-maxlength"><span class="length valid rss_reject">Maximum 10 Characters </span></div> --}}
                                                                </div>
                                                            </div>
                                                      
                                                        
                                                    </div>
                                                    <div class="col col-lg-6">
                                                        <div class="lm__form-input">
                                                            <input id="password_confirmation" type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation" autocomplete="new-password">
                                                            <span><img class="in-svg" src="{{ asset('assets/images/lock.svg')}}" alt=""></span>
                                                            
                                                            <div class="invalid-feedback position-absolute password_confirmation" role="alert"></div>
                                                            
                                                            
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="col">
                                                        <div class="lm__form--button">
                                                        <button class="btn btn--primary pop_up" type="button">Sign Up </button>
                                                        
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    {{-- <div class="lm__ac--login">
                                        <p>OR Connect With</p>
                                    </div> --}}
                                    {{-- <div class="lm__ac--social flex flex-wrap justify-content-center mb-3 gap-3 social-btn"> --}}
                                                {{-- <a class="btn btn--white mb-2" href="{{ url('auth/facebook') }}"> <img src="{{ asset('assets/images/facebook.svg')}}"
                                                alt="">Facebook</a> --}}
                                                {{-- <a class="btn btn--white mb-2" href="{{ url('auth/google') }}"> <img
                                                src="{{ asset('assets/images/google.svg')}}" alt="">Google</a>
                                                <a class="btn btn--white mb-2" href="{{ url('auth/linkedin') }}"> <img src="{{ asset('assets/images/linkedin.svg')}}"
                                                alt="">Linkedin</a> --}}
                                                {{-- <a class="btn btn--white mb-2" href="#"> <img
                                                src="{{ asset('assets/images/apple.svg')}}" alt="">Apple</a> --}}
                                    {{-- </div> --}}
                                    <div class="col">
                                        <div class="lm__ac--login mt-0">
                                            <p>Also available here</p>
                                        </div>
                                        <div class="d-flex gap-3 justify-content-center">
                                            <div class="ply-str">
                                                <a href="https://play.google.com/store/apps/details?id=au.com.peeq&pli=1" target="_blank">
                                                    <img src="{{ asset('assets/images/play-store.svg') }}" alt="">
                                                </a>
                                            </div>
                                            <div class="app-str position-relative">
                                                <a href="https://apps.apple.com/us/app/peeq/id6458190160" target="_blank">
                                                    <img src="{{ asset('assets/images/app-store.svg') }}" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="lm__form-privacy sign-up">
                                            <p class="mt-3">You agree to the PEEQ <a href="{{ route('terms.conditions') }}"> Terms Of Service </a> , <a
                                                    href="{{ route('privacy.policy') }}">Privacy Policy </a> and <a href="{{ route('cookie.policy') }}"> Cookie Policy </a> Copyright © {{ date('Y') }} PEEQ.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                
                    <div class="modal-dialog modal-dialog-centered lm__modal">
                        <div class="modal-content">
                            <div class="modal-body p-4">
                                <div class="lm__term--title">
                                    <h3 class="mb-2">Terms of Service</h3>
                                    <p class="mb-2">To continue, please accept our Terms</p>
                                </div>
                                <div class="lm__term">
                                    <label class="lm-check-term">
                                        <input type="checkbox" name="is_terms_and_condition" id="is_terms_and_condition">
                                        <span class="checkmark"></span>
                                        I agree to the <a href="{{ route('terms.conditions') }}" target="_blank" class="text-primary"> Terms of Service</a>
                                        and <a href="{{ route('privacy.policy') }}" target="_blank" class="text-primary">Privacy Policy</a> (required)
                                    </label>
                                        <span style="color:red; padding-left: 35px; display:block; margin-bottom:10px;" id="error_msg3"></span>

                                        {{-- <label class="lm-check-term">I agree to receive notification emails from PEEQ regarding my activity.<input type="checkbox" name="is_agree_to_activity_email" id="is_agree_to_activity_email"><span class="checkmark"> </span></label> --}}

                                        {{-- <label class="lm-check-term">I
                                        agree to receive activity emails from this Mighty Network. I can refine or revoke this consent
                                        anytime. (opt-in)<input type="checkbox" checked="checked"><span class="checkmark">
                                        </span></label> --}}

                                        <label class="lm-check-term">I agree to receive the occasional marketing emails from PEEQ regarding products and services.<input type="checkbox" name="is_agree_to_commercial_email" id="is_agree_to_commercial_email"><span
                                            class="checkmark"></span></label>

                                        <div class="lm__term--button"> 
                                            <button class="btn btn--primary sign_up">Confirm</button>
                                            <button class="close-button" type="button" data-bs-dismiss="modal">Cancel</button>
                                        </div>
                                        <div id="error" style="display: none;"><span style="color: red;">Please read and accept the Terms of Service and Privacy Policy</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                
            </div>
        </section>
    </main>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('.lm__form-input input').on('input', function() {
            var $inputContainer = $(this).closest('.lm__form-input');
            $inputContainer.removeClass('has-error');
            $inputContainer.find('.invalid-feedback').empty();
        });                
        $('.pop_up').on('click', function(e) {
            var first_name = $("#first_name").val();
            var last_name = $("#last_name").val();
            var mobile_no = $("#mobile_no").val();
            var email = $("#email").val();
            var password = $("#password").val();
            var password_confirmation = $("#password_confirmation").val();
            var check_mobile = $.isNumeric(mobile_no);
            var profile_image =  $("#profile_image").val();
            
            $("#error_msg3").html('');
            
            
              
            if(first_name != '' && last_name != '' && mobile_no != '' && email != '' && password != '' && password_confirmation != '' && password == password_confirmation && check_mobile != false && mobile_no.length > 6 && mobile_no.length < 15) {
                $('#exampleModal').modal('show');
            } else {
                
                        $('.first_name').html('');
                        $('.last_name').html('');
                        $('.mobile_no').html('');
                        $('.email').html('');
                        $('.password').html('');
                        $('.password_confirmation').html('');  
                        $('.profile_image').html('');
                
                let _token = $("input[name=_token]").val();

                $.ajax({
                    type: "POST",
                    url: "{{ route('register')}}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        type: 1,
                        first_name: first_name,
                        last_name: last_name,
                        mobile_no: mobile_no,
                        email: email,
                        password: password,
                        password_confirmation: password_confirmation,
                        profile_image: profile_image,
                        is_terms_and_condition: 0,
                        is_agree_to_commercial_email: 0,
                        is_agree_to_activity_email: 0
                    },
                    cache: false,
                    success: function(data){
                        $('#exampleModal').modal('show');
                    },
                    error: function (xhr, status, error) {
                        $('#exampleModal').modal('hide');
                        $.each(xhr.responseJSON.errors, function (key, item) 
                        {
                            $("."+key).show();
                            $("."+key).html(item);
                        });
                    }
                });
                

                //return false;
            }
        });
        
        var counter=0;
        $('.sign_up').on('click', function(e) {
            e.preventDefault();
            
            $('#error_msg3').html('');
            
            var first_name = $("#first_name").val();
            var last_name = $("#last_name").val();
            var mobile_no = $("#mobile_no").val();
            var email = $("#email").val();
            var password = $("#password").val();
            var password_confirmation = $("#password_confirmation").val();
            var profile_image = $("#profile_image")[0].files[0];
                
            let _token = $("input[name=_token]").val();

            if($("#is_terms_and_condition").prop('checked') == true){
                var is_terms_and_condition = 1;
            } else {
                var is_terms_and_condition = 0;
                if(is_terms_and_condition==0){
                    var link = 'Please read and accept the Terms of Service and Privacy Policy'
                    $('#error_msg3').html(link);
                    counter++;
                }
                return false;
            }

            if($("#is_agree_to_activity_email").prop('checked') == true){
                var is_agree_to_activity_email = 1;
            } else {
                var is_agree_to_activity_email = 0;
            }

            if($("#is_agree_to_commercial_email").prop('checked') == true){
                var is_agree_to_commercial_email = 1;
            } else {
                var is_agree_to_commercial_email = 0;
            }

            var formData = new FormData();
            formData.append('_token', $("#csrf").val());
            formData.append('type', 1);
            formData.append('first_name', first_name);
            formData.append('last_name', last_name);
            formData.append('mobile_no', mobile_no);
            formData.append('email', email);
            formData.append('password', password);
            formData.append('password_confirmation', password_confirmation);
            formData.append('is_terms_and_condition', is_terms_and_condition);
            formData.append('is_agree_to_commercial_email', is_agree_to_commercial_email);
            formData.append('is_agree_to_activity_email', is_agree_to_activity_email);
            formData.append('profile_image', profile_image);

            $.ajax({
                type: "POST",
                url: "{{ route('register')}}",
                data: formData,
                headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
                processData: false, // Prevent jQuery from processing the data
                contentType: false, // Prevent jQuery from setting content type
                cache: false,
                success: function(data){
                    //console.log(data);
                    window.location = "{{route('paymentPlans.index')}}";
                },
                error: function (data) {
                    // console.log(data);
                }
            });
        });       
        
        $('#mobile_no').keydown(function(event) {
                var startPos = this.selectionStart;
                if(startPos == 0 && (event.keyCode == 96 || event.keyCode ==48)){
                    event.preventDefault();
                } else {
                    if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9) {

                    } else {
                        if ((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event
                            .keyCode > 105)) {
                            event.preventDefault();
                        }
                    }
                }
        });
        
            $('#mobileNumber').on('input', function() {
            // Get the current value of the input
            let mobileNumber = $(this).val();
        
            // Remove leading "0" or "+"
            if (mobileNumber.length > 0) {
              if (mobileNumber[0] === '0' || mobileNumber[0] === '+') {
                mobileNumber = mobileNumber.slice(1);
                $(this).val(mobileNumber);
              }
            }
          });
      
      
        $('#mobile_no').keydown(function(event) {
        var startPos = this.selectionStart;
        var inputValue = this.value;

        // Check if the input starts with "0" or "+"
        if (startPos === 0 && (event.key === '0' || event.key === '+')) {
            event.preventDefault();
        } else {
            // Allow certain key codes for navigation and deletion
            if (event.keyCode === 46 || event.keyCode === 8 || event.keyCode === 9) {
            // Do nothing for delete, backspace, and tab keys
            } else {
            // Allow numerical digits and numeric keypad keys
            if (
                (event.keyCode < 48 || event.keyCode > 57) &&
                (event.keyCode < 96 || event.keyCode > 105)
            ) {
                event.preventDefault();
            }
            }
        }
        });
    
    
        $('#mobile_no').keydown(function(event) {
            var startPos = this.selectionStart;
            var inputValue = this.value;
            var isNumberKey = (event.key >= '0' && event.key <= '9') || (event.keyCode >= 96 && event.keyCode <= 105);
            var isAllowedNavigationKey = event.keyCode === 46 || event.keyCode === 8 || event.keyCode === 9;

            // Check if the input starts with "0" or "+"
            if (startPos === 0 && (event.key === '0' || event.key === '+')) {
                event.preventDefault();
            } else {
                // Allow numerical digits and specific navigation/deletion keys
                if (!isNumberKey && !isAllowedNavigationKey) {
                event.preventDefault();
                }
            }
        });

        $(document).on('keyup', '#password', function () {
            removeSpaces(this);
            $(".si_pwd_validate").css("display", "block");
            var myInput = document.getElementById("password").value;
            var letter = document.getElementById("pwd-lower");
            var capital = document.getElementById("pwd-upper");
            var number = document.getElementById("pwd-number");
            var special = document.getElementById("pwd-special");
            var length = document.getElementById("pwd-8");
            //var maxlength = document.getElementById("pwd-maxlength"); // Add this line

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
            //&& myInput.length <= 10
            if (myInput.length >= 8 && !/\s/.test(myInput)) { // Check both minimum (8) and maximum (10) length
                length.checked = true
                $('.length').removeClass('rss_reject');
                //maxlength.style.display = "none"; // Hide the maxlength error message
            } else {
                length.checked = false
                //maxlength.style.display = "block"; // Display the maxlength error message
            }

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


        // When the file input change profile image
        $('#profile_image').change(function() {
        // Get the selected file
        var file = this.files[0];
        
        // Check if a file is selected
        if (file) {
            // Create a FileReader object
            var reader = new FileReader();
            
            // Set the onload function
            reader.onload = function(e) {
            // Set the src attribute of the image tag to the loaded image data
            $('.profile_image_preview').attr('src', e.target.result);
            }
            
            // Read the file as a data URL
            reader.readAsDataURL(file);
        }
        });
    });
    function removeSpaces(input) {
        // Remove spaces from the input value
        input.value = input.value.replace(/\s/g, '');
    }
</script>
