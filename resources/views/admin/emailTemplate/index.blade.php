@extends('layouts.admin.master')
@section('content')

  <section class="lm__dash-con payement_plan"><span class="lm_vec"><img class="light" src="{{ asset('assets/images/light.png') }}" alt=""><img class="dark" src="{{ asset('assets/images/dark.png') }}" alt=""></span>
    <div class="container">
      <div class="row"> 
        <div class="lm_payment-plan">
          <div class="d-flex justify-content-between">
            <h4 class="text-primary mb-0">Email Templates</h4>
            <button class="btn btn--primary py-2 add_email_template" type="button" data-bs-toggle="offcanvas" data-bs-target="#emailTemplate" aria-controls="offcanvasRight">Add Email Template</button>
            <div class="offcanvas offcanvas-end lm_profile-modal add_model" id="emailTemplate" tabindex="-1" aria-labelledby="offcanvasRightLabel">
              <div class="offcanvas-header justify-content-end"> 
                <button class="btn-close close_modal" onclick="javascript:window.location.reload()" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>
              <div class="offcanvas-body p-0 text-center">
                <div class="lm_profile-modal p-2">
                  <div class="row align-items-center">
                    <div class="col-12 text-center">
                      <h5 class="text-white mb-0">Create a New Email Template</h5>
                    </div>
                    {{-- <div class="col-5 text-end">
                      <button type="submit" class="btn btn--primary py-2" id="next">save</button>
                    </div> --}}
                  </div>
                </div>
                <div class="lm__profile-form">
                  <div class="d-block">
                    <h5>Fill In the Details</h5>
                    <form class="row g-4" style="text-align: left;" id="create_form">
                      @csrf
                      <div class="col-12">
                        <label>Title<span class="text-danger">*</span></label>
                        <input class="form-control shadow  @error('title') is-invalid @enderror" id="title" name="title" type="text" placeholder="Email Template Title">
                          <span class="help-block title_error" style="color: red;"></span>
                      </div>
                      <div class="col-12">
                        <label>Content <span class="text-danger">*</span></label>
                        <textarea class="form-control shadow rounded-3 @error('content') is-invalid @enderror" id="content" name="content" id="exampleFormControlTextarea2" rows="3" placeholder="Email Template Content"></textarea>
                        <span class="help-block content_error" style="color: red;"></span>
                      </div>
                      <div class="col-6 mx-auto mt-4">
                        <button type="submit" class="btn btn--primary py-2 w-100" id="btn-save">save</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="lm_payment-table mt-3 position-relative">
            <div class="table-responsive">
              <table class="table table-striped table-bordered">
                <thead class="bg-white">
                  <tr></tr>
                  <th scope="col">Title</th>
                  <th scope="col">Content</th>
                  <th scope="col"></th>
                </thead>
                <tbody>
                  @foreach ($emailTemplates as $emailTemplate)
                  <tr>
                    <td>{{ $emailTemplate->title }}</td>
                    <td>{{ $emailTemplate->content }}</td>
                    <td> 
                      <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                        <span type="button" class="editTemplateBtn" data-bs-toggle="offcanvas" data-bs-target="#editEmailTemplate" data-id="{{$emailTemplate->id}}" >
                            <img class="in-svg" src="{{ asset('assets/images/edit01.svg') }}" alt=""></span>
                        </div>

                        <div class="offcanvas offcanvas-end lm_profile-modal" id="editEmailTemplate" tabindex="-1" aria-labelledby="offcanvasRightLabel">
                          <div class="offcanvas-header justify-content-end"> 
                            <button class="btn-close" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                          </div>
                          <div class="offcanvas-body p-0 text-center">
                            <div class="lm_profile-modal p-2">
                              <div class="row align-items-center">
                                <div class="col-7 text-end">
                                  <h5 class="text-white mb-0">Edit Email Template</h5>
                                </div>
                                {{-- <div class="col-5 text-end">
                                  <button class="btn btn--primary py-2" id="next">save</button>
                                </div> --}}
                              </div>
                            </div>
                            <div class="lm__profile-form">
                              <div class="d-block">
                                <h5>Edit Email Template Details</h5>
                                <form class="row g-4" style="text-align: left;" class="update_email_templates">
                                  @csrf
                                  <input class="form-control shadow" type="hidden" id="id_edit" name="id" value="">
                                  <div class="col-12">
                                    <label>Title<span class="text-danger">*</span></label>
                                    <input class="form-control shadow" id="title_edit" name="title" type="text" value="" placeholder="Email Template Title">
                                    <span class="help-block title_errors" style="color: red;"></span>
                                  </div>
                                  <div class="col-12">
                                    <label>Content<span class="text-danger">*</span></label>
                                    <textarea class="form-control shadow rounded-3" name="content" id="content_edit" rows="3" placeholder="Email Template Content"></textarea>
                                    <span class="help-block content_errors" style="color: red;"></span>
                                  </div>
                                  <div class="col-5 text-end">
                                    <button type="submit" class="btn btn--primary py-2" id="btn_update">Update</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    $(".editTemplateBtn").click(function() {
    $('.title_errors').html('');
    $('.content_errors').html('');
      var id = $(this).attr('data-id');
      let url = '{{ route("admin.emailTemplate.edit", ":id") }}';
      url = url.replace(':id', id); 
      $.ajax({
          url: url,
          method: "get"    
      }).done(function(response) {
          $('#id_edit').val(response.id);
          $("#title_edit").val(response.title);
          $("#content_edit").val(response.content);
      });
    });
    
  });
</script>
<script>
  // form submit
  $(document).ready(function() {
  $("#btn-save").click(function(e) {
    e.preventDefault();
    $("#btn-save").attr("disabled", true);
            let title = $("#title").val();
            let content = $("#content").val();       
            let _token = $("input[name=_token]").val();
 
              $.ajax({
                url: "{{route('admin.emailTemplate.store')}}",
                type:"POST" ,
                data: {
                    title:title,
                    content:content,
                    _token:_token
                },
                dataType: 'JSON',
                success:function(data)
                {
                  $("#btn-save").attr("disabled", false);
                  if(data.status == 'success') {
                    $('.close_modal').click();
                    toastr.success(data.message);
                    toastr.options = {
                      "showDuration": "800",
                      "timeOut": "9000",
                      "extendedTimeOut": "3000",
                      "showEasing": "swing",
                      "showMethod": "fadeIn",
                      "hideMethod": "fadeOut"
                    }
                    setTimeout(function(){
                    }, 2000);
                  }
                },
                error: function (data) {
                  $("#btn-save").attr("disabled", false);
                  console.log(data);
                  if(data.status == 422) {
                    var data = JSON.parse(data.responseText);
                    console.log(data.errors);
                    $(this).prop('disabled', false);
                    $('.help-block').html('');
                    $.each(data.errors, function (key, value){
                      if(key == 'title')
                      {
                        $('.title_error').html(value);
                      }
                      if(key == 'content')
                      {
                        $('.content_error').html(value);
                      }
                    });
                  }
                }
              });
  });
  });
</script>
<script>
   $(document).ready(function() {
  $("#btn_update").click(function(e) {
    e.preventDefault();
    $("#btn_update").attr("disabled", true);
    var id = $("#id_edit").val();
    let title = $("#title_edit").val();
    let content = $("#content_edit").val();          
    let _token = $("input[name=_token]").val();
    let url = '{{ route("admin.emailTemplate.update", ":id") }}';
    url = url.replace(':id', id);
    $.ajax({
      url: url,
      type:"POST" ,
      data: {
          title:title,
          content:content,
          _token:_token
      },
      dataType: 'JSON',
      success:function(data)
      {
        $("#btn_update").attr("disabled", false);
          if(data.status == 'success') {
            $('.close_modal').click();
            toastr.success(data.message);
            toastr.options = {
              "showDuration": "800",
              "timeOut": "9000",
              "extendedTimeOut": "3000",
              "showEasing": "swing",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            }
            setTimeout(function(){
            }, 2000);
          }
      },
      error: function (data) {
        $("#btn_update").attr("disabled", false);
        if(data.status == 422) {
          var data = JSON.parse(data.responseText);
          console.log(data.errors);
          $(this).prop('disabled', false);
          $('.help-block').html('');
          $.each(data.errors, function (key, value){
            if(key == 'title')
            {
              $('.title_errors').html(value);
            }
            if(key == 'content')
            {
              $('.content_errors').html(value);
            }
          });
        }
      }
    });
 
  });

  $('.add_email_template').on('click', function() {
    $('.title_error').html('');
    $('.content_error').html('');
    $('.status_error').html('');
    $("#title").val('');
    $("#content").val('');          
  });  
});
</script>
