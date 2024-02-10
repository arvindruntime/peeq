@extends('layouts.admin.master')
@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.4.1/css/rowReorder.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">

<section class="lm__dash-con payement_plan"><span class="lm_vec"><img class="light" src="{{ asset('assets/images/light.png') }}" alt=""><img class="dark" src="{{ asset('assets/images/dark.png') }}" alt=""></span>
    <div class="container">
      <div class="row"> 
        <div class="lm_payment-plan mw-100">
          <div class="d-flex justify-content-between">
            <h4 class="text-primary mb-0">Users</h4>
          </div>
          <div class="lm_payment-table mt-3 position-relative ">
            {{-- Data table --}}
            <div class="table-responsive">
              <table id="user_table" class="table table-responsive table-borderless table-striped dataTable no-footer display nowrap" style="width:100%">
                <thead class="bg-white">
                  <tr>
                    <th scope="col">No.</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col" class="email">Email</th>
                    <th scope="col">Company</th>
                    <th scope="col">Job Title</th>
                    <th scope="col">Country</th>
                    <th scope="col">Device Type</th>
                    <th scope="col">Plan Start Date</th>
                    <th scope="col">Plan End Date	</th>
                    <th scope="col">Plan</th>
                    <th scope="col">Opt In</th>
                    <th scope="col">Profile Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($users as $key => $user)
                  <tr>
                    <th scope="row">{{ $key+1 }}</th>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td class="email">{{ $user->email }}</td>
                    <td>{{ $user->company_name }}</td>
                    <td>{{ $user->job_title }}</td>
                    <td>{{ optional($user->location)->country_name }}</td>
                    <td>{{ $user->device_type ? : 'web' }} </td>
                    <td>
                      @if ($user->purchasePlan)
                          {{ $user->purchasePlan->created_at->format('Y-m-d') }}
                      @else
                          -
                      @endif
                    </td>
                    <td>
                        @if ($user->purchasePlan && $user->purchasePlan->created_at)
                            <?php
                                $planStartDate = \Carbon\Carbon::parse($user->purchasePlan->created_at);
                                $planEndDate = $planStartDate->addYear(); // Calculate the end date by adding one year
                            ?>
                            {{ $planEndDate->format('Y-m-d') }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                      @if ($user->purchasePlan && $user->purchasePlan->plan)
                          {{ $user->purchasePlan->plan->plan_title }}
                      @else
                          -
                      @endif
                    </td>
                    <td>{{ ($user->is_agree_to_commercial_email) ? 'Yes' : 'No' }}</td>
                    <td>{{ ($user->welcome_checklist_complete) ? 'Yes' : 'No' }}</td>
                    {{-- <td><div class="dropdown mt-1"><a class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><span>
                      <!-- Svg -->
                      <svg width="4" height="18" viewBox="0 0 4 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_2661_18626)">
                        <path d="M2 4C3.10456 4 4 3.10457 4 2C4 0.895428 3.10456 0 2 0C0.895438 0 0 0.895428 0 2C0 3.10457 0.895438 4 2 4Z" fill="#252A36"/><path d="M2 11C3.10456 11 4 10.1046 4 9C4 7.89543 3.10456 7 2 7C0.895438 7 0 7.89543 0 9C0 10.1046 0.895438 11 2 11Z" fill="#252A36"/><path d="M2 18C3.10456 18 4 17.1046 4 16C4 14.8954 3.10456 14 2 14C0.895438 14 0 14.8954 0 16C0 17.1046 0.895438 18 2 18Z" fill="#252A36"/>
                        <g filter="url(#filter0_d_2661_18626)"><rect x="-80" y="25" width="320" height="168" rx="20" fill="white"/>
                        </g></g><defs><filter id="filter0_d_2661_18626" x="-88" y="17" width="336" height="184" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB"><feFlood flood-opacity="0" result="BackgroundImageFix"/><feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/><feOffset/><feGaussianBlur stdDeviation="4"/>
                        <feComposite in2="hardAlpha" operator="out"/><feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.15 0"/><feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_2661_18626"/>
                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_2661_18626" result="shape"/>
                        </filter><clipPath id="clip0_2661_18626"><rect width="4" height="18" fill="white"/></clipPath></defs>
                      </svg>
                      </span></a>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" type="button">View Plan</a></li>
                        <li><a class="dropdown-item" type="button">View Purchases</a></li>
                        <li><a class="dropdown-item" type="button">Delete User</a></li>
                        <li><a class="dropdown-item" type="button">Device</a></li>
                      </ul>
                    </div></td> --}}
                    <td>
                      <div class="d-flex">
                        <div class="avtar-30 shadow">
                          <a onclick="GetDeletModal({{ $user['id'] }})"><img class="in-svg"  src="{{asset('assets/images/delete-fill.svg') }}" width="80" alt="" ></a>
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
  {{-- Delete users Modal --}}
  <div class="modal fade" id="DeleteUsereModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered lm__modal-4">
        <input type="hidden" id="delete_user_id">
        <div class="modal-content overflow-hidden">
            <div class="modal-body p-4 text-center position-relative">
                <div class="modal-header p-0"><button class="btn-close" type="button" data-bs-dismiss="modal"
                        aria-label="Close"><span> <img class="in-svg" src="{{asset('assets/images/close.svg')}}"
                                alt=""></span></button></div>
                <div class="z-index-1 position-relative lm_mxw50">
                    <h4 class="text-white">Are you sure you want to delete this User?</h4><button
                        class="btn btn--danger mt-3 title-font rounded-2 py-2" onclick="deleteUser()">Delete</button><button
                        class="btn-close text-white d-block w-100 mt-2 title-font" type="button" data-bs-dismiss="modal"
                        aria-label="Close">Cancel</button>
                </div>
            </div>
        </div>
    </div>
  </div>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/rowreorder/1.4.1/js/dataTables.rowReorder.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

<script>
  // Data Table
$(document).ready(function() {
    var table = $('#user_table').DataTable( {
      dom: 'Bfrtip',
        buttons: [
          {
                extend: 'csv',
                text: 'Download CSV'
            }
        ],
        lengthChange: true,
        // responsive: true,
        scrollX: true,
        fixedHeader: true,
        "lengthMenu": [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
        // "pagingType": "simple",
        "pageLength": 10,  
        // buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
    } );
 
    table.buttons().container()
        .appendTo( '#example_wrapper .col-md-6:eq(0)' );
        
} );
  function GetDeletModal(delete_user_id)
  {
      $("#delete_user_id").val(delete_user_id);
      $('#DeleteUsereModal').modal('show');
  }
  /// start code to delete user data ////
  function deleteUser() {
    let url = '{{ route("delete.account", [":id"]) }}';
    var id = $("#delete_user_id").val();
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
            $("#delete_user_id").val('');
            $('#DeleteUsereModal').modal('hide');
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
/// End code to delete user data //////

</script>
@endsection
