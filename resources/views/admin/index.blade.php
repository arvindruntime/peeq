@extends('layouts.admin.master')
@section('content')

  <section class="lm__dash-con payement_plan"><span class="lm_vec"><img class="light" src="{{ asset('assets/images/light.png') }}" alt=""><img class="dark" src="{{ asset('assets/images/dark.png') }}" alt=""></span>
    <div class="container">
      <div class="row"> 
        <div class="lm_payment-plan">
          <div class="d-flex justify-content-between">
            <h4 class="text-primary mb-0">Admin List</h4>
            <button class="btn btn--primary py-2 add_plan" type="button" data-bs-toggle="offcanvas" data-bs-target="#createAdmin" aria-controls="offcanvasRight">Add Admin</button>
            <div class="offcanvas offcanvas-end lm_profile-modal add_model" id="createAdmin" tabindex="-1" aria-labelledby="offcanvasRightLabel">
              <div class="offcanvas-header justify-content-end"> 
                <button class="btn-close close_modal" onclick="javascript:window.location.reload()" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>
              <div class="offcanvas-body p-0 text-center">
                <div class="lm_profile-modal p-2">
                  <div class="row align-items-center">
                    <div class="col-12 text-center">
                      <h5 class="text-white mb-0">Create a New Admin</h5>
                    </div>
                  </div>
                </div>
                <div class="lm__profile-form">
                  <div class="d-block">
                    <h5>Fill In the Details</h5>
                    <form class="row g-4" style="text-align: left;" id="create_form">
                      @csrf
                      <div class="col-12">
                        <label>Name<span class="text-danger">*</span></label>
                        <input class="form-control shadow rounded-3 @error('name') is-invalid @enderror" id="name" name="name" type="text" placeholder="Name">
                          <span class="help-block name_error" style="color: red;"></span>
                      </div>
                      <div class="col-12">
                        <label>Email<span class="text-danger">*</span></label>
                            <input class="form-control shadow rounded-3 @error('email') is-invalid @enderror" id="email" name="email" type="email" placeholder="Email">
                        <span class="help-block email_error" style="color: red;"></span>
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
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col"></th>
                </thead>
                <tbody>
                  @foreach ($admins as $admin)
                  <tr>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}
                    <td> 
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                        <span type="button" class="modal_popup" data-bs-toggle="offcanvas" data-bs-target="#editAdmin" data-id="{{$admin->id}}"  aria-controls="offcanvasRight"{{ $admin->status ? 'checked' : '' }}>
                            <img class="in-svg" src="{{ asset('assets/images/edit01.svg') }}" alt=""></span>
                            <span type="button" class="modal_delete"  data-id="{{$admin->id}}">
                            <i class="fa fa-trash " aria-hidden="true"></i></span>
                        </div>
                        <div class="offcanvas offcanvas-end lm_profile-modal" id="editAdmin" tabindex="-1" aria-labelledby="offcanvasRightLabel">
                          <div class="offcanvas-header justify-content-end"> 
                            <button class="btn-close" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                          </div>
                          <div class="offcanvas-body p-0 text-center">
                            <div class="lm_profile-modal p-2">
                              <div class="row align-items-center">
                                <div class="col-7 text-end">
                                  <h5 class="text-white mb-0">Edit Admin</h5>
                                </div>
                              </div>
                            </div>
                            <div class="lm__profile-form">
                              <div class="d-block">
                                <h5>Edit Admin Details</h5>
                                <form class="row g-4" style="text-align: left;" class="update_plans">
                                  @csrf
                                  <input class="form-control shadow" type="hidden" id="id_edit" name="id" value="">
                                  <div class="col-12">
                                    <label>Name<span class="text-danger">*</span></label>
                                    <input class="form-control shadow rounded-3 @error('name') is-invalid @enderror" id="name_edit" name="name" type="text" placeholder="Name">
                                      <span class="help-block name_errors" style="color: red;"></span>
                                  </div>
                                  <div class="col-12">
                                    <label>Email<span class="text-danger">*</span></label>
                                        <input class="form-control shadow rounded-3 @error('email') is-invalid @enderror" id="email_edit" name="email" type="email" placeholder="Email">
                                    <span class="help-block email_errors" style="color: red;"></span>
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
  // $(document).ready(function() {
  //   $(".modal_popup").click(function() {
  //   $('.name_errors').html('');
  //   $('.email_errors').html('');
  //   $('.created_by_errors').html('');
  //     var id = $(this).attr('data-id');
  //     let url = '{{ route("admin.edit", ":id") }}';
  //     url = url.replace(':id', id); 
  //     $.ajax({
  //         url: url,
  //         method: "get"    
  //     }).done(function(response) {                        
  //         $('#id_edit').val(response.id);
  //         $("#name_edit").val(response.name);
  //         $("#email_edit").val(response.email);
  //         $("#created_by_edit").val(response.created_by);
  //     });
  //   });
    
  // });
</script>
<script>
  // form submit
  $(document).ready(function() {
  $("#btn-save").click(function(e) {
    e.preventDefault();
    $("#btn-save").attr("disabled", true);
            let name = $("#name").val();
            let email = $("#email").val();
            let created_by = $("#created_by").val();            
            let _token = $("input[name=_token]").val();
 
              $.ajax({
                url: "{{route('admin.store')}}",
                type:"POST" ,
                data: {
                    name:name,
                    email:email,
                    created_by:created_by,
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
                      if(key == 'name')
                      {
                        $('.name_error').html(value);
                      }
                      if(key == 'email')
                      {
                        $('.email_error').html(value);
                      }
                      if(key == 'created_by')
                      {
                        $('.created_by_error').html(value);
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
        let name = $("#name_edit").val();
        let email = $("#email_edit").val();
        let created_by = $("#created_by_edit").val();            
        let _token = $("input[name=_token]").val();
        let url = '{{ route("admin.update", ":id") }}';
        url = url.replace(':id', id);
        $.ajax({
            url: url,
            type:"POST" ,
                data: {
                    name:name,
                    email:email,
                    created_by:created_by,
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
                        if(key == 'name')
                        {
                        $('.name_errors').html(value);
                        }
                        if(key == 'email')
                        {
                        $('.email_errors').html(value);
                        }
                        if(key == 'created_by')
                        {
                        $('.created_by_errors').html(value);
                        }
                    });
                }
            }
        });
        $('.add_plan').on('click', function() {
            $('.name_error').html('');
            $('.email_error').html('');
            $('.created_by_error').html('');
            $("#name").val('');
            $("#email").val('');
            $("#created_by").val('');            
        });  
    });
    $('.modal_delete').on('click', function() {
        var id = $(this).attr('data-id');
        // alert(id);
        let _token = $("input[name=_token]").val();
        let url = '{{ route("admin.destroy", ":id") }}';
        url = url.replace(':id', id); 
        $.ajax({
            url: url,
            method: "delete",  
            data: {
                _token:_token,
                id:id
            }  
        }).done(function(data) {
          toastr.success(data.message);
          toastr.options = {
                "showDuration": "800",
                "timeOut": "9000",
                "extendedTimeOut": "3000",
                "showEasing": "swing",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
                }
            location.reload();
        });
    });
});
</script>
