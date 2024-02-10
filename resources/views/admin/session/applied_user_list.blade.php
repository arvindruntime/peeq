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
            <h4 class="text-primary mb-0">Applied User List</h4>
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
                    <th scope="col">Payment Status</th>
                    <th scope="col">Session Duration</th>
                    <th scope="col">Session Purchased Date</th>
                    <th scope="col">Session Price</th>

                  </tr>
                </thead>
                <tbody>
                  @foreach ($appliedUserList as $key => $user)
                  <tr>
                    <th scope="row">{{ $key+1 }}</th>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td class="email">{{ $user->email }}</td>
                    <td>{{ $user->payment_status }}</td>
                    <td>{{ $user->session_duration }}</td>                    
                    <td>{{ $user->session_purchased_date }}</td>   
                    <td>{{ $user->session_price }}</td>     
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

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/rowreorder/1.4.1/js/dataTables.rowReorder.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script>
  // Data Table
$(document).ready(function() {
    var table = $('#user_table').DataTable( {
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


</script>
@endsection
