@extends('layouts.landing.master')
@section('content')

  <!--========= Hero START  =========-->
    <section class="main__page__content position-relative">
        <div class="lm__hero--section home-banner position-relative">
        <div class="lm__hero--inn-box lm_about-hero">
            <div class="new-bg-video">
            </div>
        </div>
        <div class="about_hero-wrap">
            <div class="container">
            <div class="row">
                <div class="col-12  text-center">
                <h1 class="fw-bold text-white text-uppercase">Contact Us</h1>
                </div>
            </div>
            </div>
        </div>
    </section>
  <!--========= Hero END =========-->

  <!--========= Forn START =========-->
    <section class="about_main py-5 position-relative contact_forn">
        <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
            <div class="form_bg p-5">
                <form class="row g-4 needs-validation" id="contactForm" name="contactForm">
                    @csrf
                <div class="col-12 text-center text-white">
                    <h4 class="text-primary text-center fw-bold">It’s Easy To Get In Touch With Us</h4>
                    <span id="errorField" style="color: red;"></span>
                </div>
                <!-- First name -->
                <div class="col-md-6">
                    <label for="fname" class="form-label text-white text-white col-form-label-lg">First Name</label>
                    <input type="text" oninput="removeLeadingSpaces(this)" class="form-control form-control-lg" id="first_name" name="first_name" placeholder="First name" required minlength="2" maxlength="100">
                    <div class="invalid-feedback first_name" role="alert"></div>
                </div>
                <!-- Last name -->
                <div class="col-md-6">
                    <label for="lname" class="form-label text-white text-white col-form-label-lg">Last Name</label>
                    <input type="text" oninput="removeLeadingSpaces(this)" class="form-control form-control-lg" id="last_name" name="last_name" placeholder="Last name" required minlength="2" maxlength="100">
                    <div class="invalid-feedback last_name" role="alert"></div>
                </div>
                <!-- Company -->
                <div class="col-md-6">
                    <label for="company_name" class="form-label text-white col-form-label-lg">Company(optional)</label>
                    <input type="text" oninput="removeLeadingSpaces(this)" class="form-control form-control-lg" id="company_name" name="company_name" placeholder="Company" required minlength="2" maxlength="100">
                    <div class="invalid-feedback company_name" role="alert"></div>
                </div>
                <div class="col-md-6">
                    <label for="country_id" class="form-label text-white col-form-label-lg">Country</label>
                    @php $countries = countryList(); @endphp
                    <select class="form-select form-select-lg" id="country_id" name="country_id" required>
                    <option value="" selected>Country</option>
                    @foreach ($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                    @endforeach
                    </select>
                    <div class="invalid-feedback country_id" role="alert"></div>
                </div>
                <!-- Email -->
                <div class="col-12">
                    <label for="usremail" class="form-label text-white col-form-label-lg">Email</label>
                    <input type="email" oninput="removeLeadingSpaces(this)" class="form-control form-control-lg" id="email" name="email" required minlength="5" maxlength="200">
                    <div class="invalid-feedback email" role="alert"></div>
                </div>
                <!-- Description -->
                <div class="col-12">
                    <label for="description" class="form-label text-white col-form-label-lg">How can we help?</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required ></textarea>
                    <div class="invalid-feedback description" role="alert"></div>
                </div>
                
                <div class="col-md-6 mx-auto">
                    <button class="btn btn-primary d-block w-100 py-2" id="contactSubmit">Submit</button>
                </div>
                </form>
            </div>
            </div>
        </div>
        </div>
    </section>
  <!--========= Form END =========-->
<script>
    $(document).ready(function(){           
            $('#contactSubmit').click(function(e) {
            e.preventDefault();
            
            // Clear previous error messages
            $(".invalid-feedback").html("");
            $(".invalid-feedback").empty();
            $('#errorField').html('');
        
            var formData = $("#contactForm").serialize();
            
            console.log("Form submited");
            
            $.ajax({
               type: "POST",
               url: "{{ route('contact_us')}}",
               data: formData,
               success: function(response){
                    $('#errorField').text('');
                    /* Open Popup model for contact us enquiry*/
                    $('#peeq_support').modal('show');
                    $("#contactForm")[0].reset();        
               },
               
                error: function (xhr, status, error) {
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            $(".invalid-feedback").html("");
                            $(".invalid-feedback").empty();
                            $('#errorField').text('');

                            var item = '';
                            $.each(xhr.responseJSON.message, function (key, messages) {
                                item = messages[0];
                                $("#contactForm ."+key).show();
                                $("#contactForm ."+key).html(item);
                            });
                        } else {
                            // Handle other types of errors if needed
                            $('#errorField').text('Something went wrong. ERR_CONNECTION_REFUSED!');
                        }
                }
            });
        });
    });    
    function removeLeadingSpaces(input) {
        // Remove leading spaces from the input value
        input.value = input.value.replace(/^\s+/, '');
    }
</script>
@endsection
