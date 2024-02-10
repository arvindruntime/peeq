@extends('layouts.admin.master')
@section('content')
  <section class="lm__dash-con payement_plan"><span class="lm_vec"><img class="light" src="{{ asset('assets/images/light.png') }}" alt=""><img class="dark" src="{{ asset('assets/images/dark.png') }}" alt=""></span>
    <div class="container">
      <div class="row"> 
        <div class="lm_payment-plan">
          <div class="d-flex justify-content-between">
            <h4 class="text-primary mb-0">Payment Plans</h4>
            <button class="btn btn--primary py-2 add_plan" type="button" data-bs-toggle="offcanvas" data-bs-target="#AddPlanDetail" aria-controls="offcanvasRight">Add Plan</button>
            <div class="offcanvas offcanvas-end lm_profile-modal add_model" id="AddPlanDetail" tabindex="-1" aria-labelledby="offcanvasRightLabel">
              <div class="offcanvas-header justify-content-end"> 
                <button class="btn-close close_modal" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>
              <div class="offcanvas-body p-0 text-center">
                <div class="lm_profile-modal p-2">
                  <div class="row align-items-center">
                    <div class="col-12 text-center">
                      <h5 class="text-white mb-0">Create a New Plan</h5>
                    </div>
                    {{-- <div class="col-5 text-end">
                      <button type="submit" class="btn btn--primary py-2" id="next">save</button>
                    </div> --}}
                  </div>
                </div>
                <div class="lm__profile-form">
                  <div class="d-block">
                    <h5>Fill In the Details</h5>
                    <form class="row g-4" style="text-align: left;" id="AddPlanDetailsForm">
                      @csrf
                      <div class="col-12">
                        <label>Plan Title<span class="text-danger">*</span></label>
                        <input class="form-control shadow" id="plan_title" name="plan_title" type="text" placeholder="Plan Title">
                          <span class="help-block plan_title_error" style="color: red;"></span>
                      </div>
                      <div class="col-12">
                        <label>Plan Description<span class="text-danger">*</span></label>
                        <textarea class="form-control shadow rounded-3" id="plan_description" name="plan_description" id="exampleFormControlTextarea2" rows="3" placeholder="Plan Description"></textarea>
                        <span class="help-block plan_description_error" style="color: red;"></span>
                      </div>
                      <div class="col-md-6"> 
                        <label>Plan Type<span class="text-danger">*</span></label>
                        <select class="form-select form-control shadow" id="plan_type" name="plan_type" aria-label="Default select example">
                          <option value="">----Select Plan Type----</option>
                          <option value="monthly">Monthly</option>
                          <option value="yearly">Yearly</option>
                        </select>
                        <span class="help-block plan_type_error" style="color: red;"></span>
                      </div>
                      <div class="col-6">
                        <label>Plan Amount<span class="text-danger">*</span></label>
                        <input class="form-control shadow" id="plan_amount" name="plan_amount" type="text" placeholder="Plan Amount">
                          <span class="help-block plan_amount_error" style="color: red;"></span>
                      </div>
                      {{-- <div class="col-12"> 
                        <label>Status<span class="text-danger"></span></label>
                        <select class="form-select form-control shadow" name="status"  id="plan_status" aria-label="Default select example">
                          <option value="active">Active</option>
                        </select>
                        <span class="help-block status_error" style="color: red;"></span>
                      </div> --}}
                      <div class="col-6 mx-auto mt-4">
                        <button type="button" class="btn btn--primary py-2 w-100" id="savePlanBtn">Save</button>
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
                  <th scope="col">Plan Title</th>
                  <th scope="col">Plan Description</th>
                  <th scope="col">Plan Type</th>
                  <th scope="col">Plan Amount</th>
                  <th scope="col">Status</th>
                  <th scope="col"></th>
                </thead>
                <tbody>
                  @foreach ($plans as $plan)
                  <tr>
                    <td>{{ $plan->plan_title }}</td>
                    <td>{{ Str::limit($plan->plan_description, 20) }}</td>
                    <td>{{ $plan->plan_type }}
                    <td>{{ $plan->plan_amount }}</td>
                    <td>
                      @if($plan->status == 'active')
                      <span class="text-green">Active</span><span
                        type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#editPlanDetails"
                        aria-controls="offcanvasRight"></span>
                      @else
                      <span class="text-danger">Inactive</span><span
                        type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#editPlanDetails"
                        aria-controls="offcanvasRight"></span>
                      @endif
                    </td>
                    <td> 
                      <div class="d-flex align-items-center justify-content-between gap-3">
                        <span type="button" class="editPlanBtn" data-bs-toggle="offcanvas" data-bs-target="#editPlanDetails" data-id="{{$plan->id}}"  aria-controls="offcanvasRight"{{ $plan->status ? 'checked' : '' }}>
                        <img class="in-svg" src="{{ asset('assets/images/edit01.svg') }}" alt=""></span>
                        <div class="d-flex">
                          <div class="avtar-30 shadow">
                            <a onclick="GetDeletModal({{ $plan['id'] }})"><img class="in-svg"  src="{{asset('assets/images/delete-fill.svg') }}" width="80" alt="" ></a>
                          </div>
                        </div>
                      </div>
                        <div class="offcanvas offcanvas-end lm_profile-modal" id="editPlanDetails" tabindex="-1" aria-labelledby="offcanvasRightLabel">
                          <div class="offcanvas-header justify-content-end"> 
                            <button class="btn-close" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                          </div>
                          <div class="offcanvas-body p-0 text-center">
                            <div class="lm_profile-modal p-2">
                              <div class="row align-items-center">
                                <div class="col-7 text-end">
                                  <h5 class="text-white mb-0">Edit Plan</h5>
                                </div>
                                {{-- <div class="col-5 text-end">
                                  <button class="btn btn--primary py-2" id="next">save</button>
                                </div> --}}
                              </div>
                            </div>
                            <div class="lm__profile-form">
                              <div class="d-block">
                                <h5>Edit Plan Details</h5>
                                <form class="row g-4" style="text-align: left;" class="update_plans" id="editPlanDetailsForm">
                                  @csrf
                                  <input class="form-control shadow" type="hidden" id="id_edit" name="id" value="">
                                  <div class="col-12">
                                    <label>Plan Title<span class="text-danger">*</span></label>
                                    <input class="form-control shadow" id="plan_title_edit" name="plan_title" type="text" value="" placeholder="Plan Title">
                                    <span class="help-block plan_title_errors" style="color: red;"></span>
                                  </div>
                                  <div class="col-12">
                                    <label>Plan Description<span class="text-danger">*</span></label>
                                    <textarea class="form-control shadow rounded-3" name="plan_description" id="plan_description_edit" rows="3" placeholder="Plan Description"></textarea>
                                    <span class="help-block plan_description_errors" style="color: red;"></span>
                                  </div>
                                  <div class="col-md-6">
                                    <label>Plan Type<span class="text-danger">*</span></label>
                                      <select class="form-select form-control shadow" name="plan_type" id="plan_type_edit" aria-label="Default select example">
                                        <option value="">----Select Plan Type----</option>
                                        <option value="monthly">Monthly</option>
                                        <option value="yearly">Yearly</option>
                                      </select>
                                      <span class="help-block plan_type_errors" style="color: red;"></span>
                                  </div>
                                  <div class="col-md-6">
                                    <label>Plan Amount<span class="text-danger">*</span></label>
                                    <input class="form-control shadow" id="plan_amount_edit" name="plan_amount" type="text" value="" placeholder="Plan Amount">
                                    <span class="help-block plan_amount_errors" style="color: red;"></span>
                                  </div>
                                  <div class="col-12"> 
                                    <label>Status<span class="text-danger"></span></label>
                                    <select class="form-select form-control shadow" name="status" id="status_edit" aria-label="Default select example">
                                      <option value="active" {{ (old('status') === 'active') ? 'selected' : '' }} >Active</option>
                                      <option value="inactive" {{ (old('status') === 'inactive') ? 'selected' : '' }} >Inactive</option>
                                    </select>
                                    <span class="help-block status_errors" style="color: red;"></span>
                                  </div>
                                  <div class="col-6 mx-auto mt-4">
                                    <button type="submit" class="btn btn--primary py-2 w-100" id="btn_update">Update</button>
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
  {{-- Delete Plan Modal --}}
  <div class="modal fade" id="DeletePlanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered lm__modal-4">
        <input type="hidden" id="delete_plan_id">
        <div class="modal-content overflow-hidden">
            <div class="modal-body p-4 text-center position-relative">
                <div class="modal-header p-0"><button class="btn-close" type="button" data-bs-dismiss="modal"
                        aria-label="Close"><span> <img class="in-svg" src="{{asset('assets/images/close.svg')}}"
                                alt=""></span></button></div>
                <div class="z-index-1 position-relative lm_mxw50">
                    <h4 class="text-white">Are you sure you want to delete this Plan?</h4><button
                        class="btn btn--danger mt-3 title-font rounded-2 py-2" onclick="deletePlan()">Delete</button><button
                        class="btn-close text-white d-block w-100 mt-2 title-font" type="button" data-bs-dismiss="modal"
                        aria-label="Close">Cancel</button>
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    $(".editPlanBtn").click(function() {
    $('.plan_title_errors').html('');
    $('.plan_description_errors').html('');
    $('.plan_type_errors').html('');
    $('.plan_amount_errors').html('');
    $('.status_errors').html('');
      var id = $(this).attr('data-id');
      let url = '{{ route("admin.plans.edit", ":id") }}';
      url = url.replace(':id', id); 
      $.ajax({
          url: url,
          method: "get"    
      }).done(function(response) {
          $('#id_edit').val(response.id);
          $("#plan_title_edit").val(response.plan_title);
          $("#plan_description_edit").val(response.plan_description);
          $("#plan_type_edit").val(response.plan_type);
          $("#status_edit").val(response.status);
          $("#plan_amount_edit").val(response.plan_amount);
      });
    });
    
  });
</script>
<script>
  
  // Function to reload the page
  function reloadPage() {
    window.location.reload();
  }

  // form submit
  $(document).ready(function() {
    $("#savePlanBtn").click(function(e) {
      e.preventDefault();
      $("#savePlanBtn").attr("disabled", true);
        let plan_title = $("#plan_title").val();
        let plan_description = $("#plan_description").val();
        let plan_type = $("#plan_type").val();
        let status = $("#status").val();
        let plan_amount = $("#plan_amount").val();
        let _token = $("input[name=_token]").val();
  
      $.ajax({
        url: "{{route('admin.plans.store')}}",
        type:"POST" ,
        data: {
            plan_title:plan_title,
            plan_description:plan_description,
            plan_type:plan_type,
            status:status,
            plan_amount:plan_amount,
            _token:_token
        },
        dataType: 'JSON',
        success:function(data)
        {
          $("#savePlanBtn").attr("disabled", false);
          if(data.status == 'success') {
            
            var success_message = data.message;
                    // console.log(success_message);
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
            $("#AddPlanDetail").offcanvas("hide");
            $("#AddPlanDetailsForm")[0].reset();
          }
          
        // Set a timer to reload the page after 2 seconds (2000 milliseconds)
        const interval = 2000; // 2 seconds in milliseconds
        setTimeout(reloadPage, interval);

        },
        error: function (data) {
          $("#savePlanBtn").attr("disabled", false);
          console.log(data);
          if(data.status == 422) {
            var data = JSON.parse(data.responseText);
            console.log(data.errors);
            $(this).prop('disabled', false);
            $('.help-block').html('');
            $.each(data.errors, function (key, value){
              if(key == 'plan_title')
              {
                $('.plan_title_error').html(value);
              }
              if(key == 'plan_description')
              {
                $('.plan_description_error').html(value);
              }
              if(key == 'plan_type')
              {
                $('.plan_type_error').html(value);
              }
              if(key == 'plan_amount')
              {
                $('.plan_amount_error').html(value);
              }
              if(key == 'status')
              {
                $('.status_error').html(value);
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
      let plan_title = $("#plan_title_edit").val();
      let plan_description = $("#plan_description_edit").val();
      let plan_type = $("#plan_type_edit").val();
      let status = $("#status_edit").val();
      let plan_amount = $("#plan_amount_edit").val();
      let _token = $("input[name=_token]").val();
      let url = '{{ route("admin.plans.update", ":id") }}';
      url = url.replace(':id', id);
        $.ajax({
          url: url,
          type:"POST" ,
          data: {
              plan_title:plan_title,
              plan_description:plan_description,
              plan_type:plan_type,
              status:status,
              plan_amount:plan_amount,
              _token:_token
          },
          dataType: 'JSON',
          success:function(data)
          {
            $("#btn_update").attr("disabled", false);
              if(data.status == 'success') {
                
                var success_message = data.message;
                    // console.log(success_message);
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
              $("#editPlanDetails").offcanvas("hide");
              $("#editPlanDetailsForm")[0].reset();
            
              }
              
            // Set a timer to reload the page after 2 seconds (2000 milliseconds)
            const interval = 2000; // 2 seconds in milliseconds
            setTimeout(reloadPage, interval);
        
          },
          error: function (data) {
            $("#btn_update").attr("disabled", false);
            if(data.status == 422) {
              var data = JSON.parse(data.responseText);
              console.log(data.errors);
              $(this).prop('disabled', false);
              $('.help-block').html('');
              $.each(data.errors, function (key, value){
                if(key == 'plan_title')
                {
                  $('.plan_title_errors').html(value);
                }
                if(key == 'plan_description')
                {
                  $('.plan_description_errors').html(value);
                }
                if(key == 'plan_type')
                {
                  $('.plan_type_errors').html(value);
                }
                if(key == 'plan_amount')
                {
                  $('.plan_amount_errors').html(value);
                }
                if(key == 'status')
                {
                  $('.status_errors').html(value);
                }
              });
            }
          }
        });
    });
});

function GetDeletModal(delete_plan_id)
{
    $("#delete_plan_id").val(delete_plan_id);
    $('#DeletePlanModal').modal('show');
}

function deletePlan()
{
  let url = '{{ route("admin.plans.delete", [":id"]) }}';
  var id = $("#delete_plan_id").val();
  url = url.replace(':id', id);
  var _token = $('meta[name="csrf-token"]').attr('content');
  $.ajax({
    url: url,
    type: 'DELETE',
    data: {
        "_token": _token,
      },
    dataType: 'json',
    success: function(data) {
      var success_message = data.message;
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
        $("#delete_plan_id").val('');
        $('#DeletePlanModal').modal('hide');
        $('.modal-backdrop').remove(); // Remove the modal backdrop
        $('body').removeClass('modal-open'); // Remove the 'modal-open' class from the body     
        window.location.reload();
      },
      error: function(xhr, status, error) {
          console.error(error);
          //alert('An error occurred while deleting the user.');
          
          var success_message = error;
        Swal.fire({
            toast: true,
            icon: 'warning',
            title: success_message,
            position: 'top-right',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: false,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
        });
        
        
      }
    });
}
$(document).ready(function() {
  $("#plan_type").select2({
    placeholder: "Select Plan Type",
    dropdownParent: $("#AddPlanDetail")
  });
});
</script>
<script>
    document.getElementById("plan_status").value = "active";
</script>