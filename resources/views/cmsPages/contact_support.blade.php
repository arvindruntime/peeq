@extends('layouts.cmsPage.master')
@section('content')

<!DOCTYPE html>
<html>
<head>
  <title>PEEQ™</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
</head>
<body>
  <!-- Your HTML content here -->
  
<main class="main-content" id="main">
    <section class="lm_term">
        <div class="container-fluid my-4">
            <div class="d-flex">
                <div class="lm_term-back">
                    <h5> <a class="text-dark" href="{{ route('posts.index') }}">Back</a></h5>
                </div>
                <div class="lm_term-logo text-center"><img width="150" src="assets/images/dash-logo.svg" alt=""></a>
                </div>
            </div>
        </div>
        <div class="lm_term-con">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="lm_term-main mx-auto">
                            <div class="lm_term-card card">
                                <div class="lm_term-title">
                                    <h2 class="text-center">Submit a request</h2>
                                    <span id="errorField" style="color: red;"></span>
                                </div>
                                <div class="lm_term-body text-dark">
                                    <form action="#" id="contact-support" method="post" enctype="multipart/form-data"> 
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="exampleInputEmail1">Your email address</label>
                                                <input class="form-control" id="email" type="email" name="email">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="exampleFormControlInput2">I am ...(optional)</label>
                                                <select class="form-select form-control" name="user_type" id="user_type" aria-label="Default select example">
                                                    {{-- optional (member, host, on_a_mighty_networks_free_trail, curious_about_mighty_networks) --}}
                                                    
                                                    <option selected="">Please Select</option>
                                                    <option value="member">a Member</option>
                                                    <option value="host">a Host</option>
                                                    <option value="on_a_mighty_networks_free_trail">on a PEEQ™ Free Trail</option>
                                                    <option value="curious_about_mighty_networks">curious about PEEQ™</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="exampleFormControlInput1">My name</label>
                                                <input class="form-control" name="name" id="name" type="text">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="exampleFormControlInput3">Subject(optional)</label>
                                                <input class="form-control" name="subject" id="subject" type="text">
                                            </div>
                                            <div class="mb-3"><label class="form-label" for="exampleFormControlTextarea1">Description</label>
                                                    <textarea class="form-control rounded-2" name="description" id="description" rows="3"></textarea>
                                                <div class="form-text text-sm-10" id="emailHelp">If this is a
                                                    support issue, please include the device and/or browser you are
                                                    using to access your PEEQ™ account, and attach any relevant
                                                    screenshots.</div>
                                            </div>
                                            <div class="mb-3"><label class="form-label" for="exampleFormControlInput4">PEEQ™ Name or URL(optional)</label>
                                                    <input class="form-control" name="mighty_network_name" id="mighty_network_name" type="text">
                                            </div>
                                            <div class="input-group mb-3"><label class="form-label d-block w-100">Attachments(optional)</label>
                                                <label class="input-group-text" for="attachment"><span> <img class="in-svg" src="assets/images/plus.svg" alt=""></span>Add files here
                                                    <input class="form-control d-none" id="attachment" name="attachment" type="file" value="">
                                                </label>
                                            </div>
                                            <div class="mb-3 d-flex justify-content-center">
                                                <button class="btn btn--primary px-5" id="contactSupportSave" type="button">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- {!! csrf_field() !!} --}}
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
 <script>
$(document).ready(function() {   
    $('#contactSupportSave').click(function(e) {
    e.preventDefault();
    // var formData  = $("#contact-support").serialize()         
    let _token = $("input[name=_token]").val();
    
    var formData = new FormData($("#contact-support")[0]);

        $.ajax({
            url: "{{route('contact.support.store')}}"
            , type: "POST"
            , headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            , data: formData
            , dataType: 'JSON'
            , contentType: false // Set content type to false for file upload
            , processData: false 
            , success: function(data) {
                console.log(data);
                if (data.error) {
                    printErrorMsg(data.error);
                    return false;
                } else if (data.status == "200")
                {
                    $('#errorField').text('');
                    $("#contact-support")[0].reset();
                    var success_message = data.message;
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
                }
            },
            error: function(xhr, status, error) {
                    
                    var errorMessage = "An error occurred. Please try again."; // Default error message
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        // console.log(xhr.responseJSON);
                        errorMessage = xhr.responseJSON.message; // Use the error message from the API response
                    }
                    // Set the error message in the desired HTML tag
                    $('#errorField').text(errorMessage);
                    console.log(errorMessage);
                }
        });
    });
    function printErrorMsg(msg) {
    console.log(msg);
    $.each(msg, function(key, value) {
        $("#errorField").text(value);
    });
}
});
    

</script> 

</body>
</html>
@endsection
