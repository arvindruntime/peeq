@extends('layouts.admin.master')
@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/admin-dash.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.4.1/css/rowReorder.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">

<main class="main-content admin-dash" id="main">
  <section class="lm__dash-con lm_admin-temp pb-3">
    <span class="lm_vec"><img class="light"
      src="{{asset('assets/images/light.png')}}" alt=""><img class="dark" src="{{asset('assets/images/dark.png')}}" alt=""></span>
    <div class="container">
      <div class="row">
        {{-- 1 --}}
        <div class="col col-xl-5 mb-3">
          <div class="card lm_analytics-card text-bg-dark border-0 h-100">
            {{-- image --}}
            {{-- <img src="{{asset('assets/images/Sign in.jpg')}}" class="card-img" alt="..."> --}}
            <div class="row">
              <div class="col-12">
                <div class="row justify-content-center justify-content-sm-between align-items-center">
                  {{-- Main title --}}
                  <div class="col-sm-9 order-2 order-sm-1">
                    <h5 class="mb-0">Website Analytics</h5>
                    {{-- <p class="mb-4 text-dark">Total 28.5% Conversion Rate</p> --}}
                    <h6 class="mt-0 mt-md-3 mb-4">Spending</h6>
                    <div class="d-flex gap-5">
                      {{-- list 1 --}}
                      <ul class="list-unstyled mb-0">
                        <li class="d-flex flex-wrap mb-4 align-items-center">
                          {{-- <a class="d-flex align-items-center" href="{{ route('admin.users.index') }}"> --}}
                            <p class="mb-0 me-2 text-bg">{{ $userCount }}</p>
                            <p class="mb-0 text-dark">Users</p>
                          {{-- </a> --}}
                        </li>
                        <li class="d-flex align-items-center mb-2">
                          <p class="mb-0 me-2 text-bg">{{ $coachesCount }}</p>
                          <p class="mb-0 text-dark">Coaches</p>
                        </li>
                      </ul>
                      {{-- list 2 --}}
                      <ul class="list-unstyled mb-0">
                        <li class="d-flex mb-4 align-items-center">
                          {{-- <a class="d-flex align-items-center" href="{{ route('posts.index') }}"> --}}
                            <p class="mb-0 me-2 text-bg">{{ $postCount }}</p>
                            <p class="mb-0 text-dark">Posts</p>
                          {{-- </a> --}}
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <p class="mb-0 me-2 text-bg">{{ $articleCount }}</p>
                            <p class="mb-0 text-dark">Article</p>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-sm-3 order-1">
                    <div class="img-wrapper d-flex justify-content-center">
                      <img src="{{asset('assets/images/rocket.png')}}" alt="">
                    </div>

                  </div>

                </div>
               
              </div>
            </div>
          </div>
        </div>
        <div class="col col-md-12 col-xl-7">
          <div class="row">
            {{-- 2 --}}
            <div class="col col-md-6 mb-3">
              <div class="card card-overview shadow border-0 h-100">
                  <div class="d-block">
                    <div class="d-flex justify-content-between">
                      <small class="title-font">Sales Overview</small>
                      <p class="card-text text-green">${{ $totalAmount }}</p>
                    </div>
                    {{-- <h5 class="mb-1">$42.5k</h5> --}}
                  </div>
                  {{-- body --}}
                  <div class="card-body p-0 pt-5">
                    <div class="row">
                      <div class="col-4">
                        <div class="d-flex gap-2 align-items-center mb-2">
                          <span class="badge bg-dark-light-10 p-1 rounded-circle shadow-none avtar-40 cart-svg">
                            <img class="in-svg" src="{{asset('assets/images/dashboard-course.svg')}}" alt="">
                          </span>
                          <p class="mb-0">Courses</p>
                        </div>
                        <h5 class="mb-0 pt-3 text-nowrap">${{ $totalBuyCourseAmount }}</h5>
                        <small class="text-muted">{{ number_format($courseBuyPercentage, 2) }}%</small>
                      </div>
                      <div class="col-4">
                        <div class="divider divider-vertical">
                          <div class="divider-text">
                            <span class="badge-divider-bg bg-label-secondary">VS</span>
                          </div>
                        </div>
                      </div>
                      <div class="col-4 text-end">
                        <div class="d-flex gap-2 justify-content-end align-items-center mb-2">
                          <p class="mb-0">Membership</p>
                          <span class="badge bg-primary-light-10 p-1 rounded-circle shadow-none avtar-40 link-svg">
                            <img class="in-svg" src="{{asset('assets/images/dashboard-membership.svg')}}" alt="">
                          </span>
                        </div>
                        <h5 class="mb-0 pt-3 text-nowrap ms-lg-n3 ms-xl-0">${{ $totalMembershipAmount }}</h5>
                        <small class="text-muted">{{ number_format($membershipBuyPercentage, 2) }}%</small>
                      </div>
                    </div>
                    <div class="d-flex align-items-center mt-4">
                      {{-- progress --}}
                      <div class="progress w-100" style="height: 8px;">
                        <div class="progress-bar bg-green" style="width: {{ $courseBuyPercentage }}%;" role="progressbar" aria-valuenow="{{ $courseBuyPercentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
            {{-- 3 --}}
            <div class="col col-md-6 mb-3">
              <div class="card card-revenue border-0 shadow h-100">
                <div class="card-body p-0">
                  <div class="d-flex gap-2 justify-content-between align-items-center">
                    
                    <div class="card-icon d-flex gap-2 align-items-center">
                      <span class="badge bg-label-success rounded-pill bg-green-light-10 p-2 avtar-40 revenue-svg">
                       <img class="in-svg" src="{{asset('assets/images/graph.svg')}}" alt="">
                      </span>
                      <div class="d-block">
                        <h5 class="mb-0">${{ $revenueData['totalRevenue'] }}</h5>
                        {{-- 57.5k --}}
                      </div>
                    </div>
                    <small class="title-font">Revenue Generated</small>
                  </div>
                  <div class="chart-container" style="position: relative; height:200px;">
                    <canvas class="mt-3 mychart" id="RevenueGenerated"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col col-xl-12">
          <div class="card card-data border-0 shadow h-100">
            <div class="d-flex flex-wrap gap-2 justify-content-between ">
              <h5 class="mb-0">User Transaction History</h5>
              <ul class="nav nav-pills nav-transaction" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="pills-course-tab" data-bs-toggle="pill" data-bs-target="#pills-course" type="button" role="tab" aria-controls="pills-course" aria-selected="true">Course History</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="pills-session-tab" data-bs-toggle="pill" data-bs-target="#pills-session" type="button" role="tab" aria-controls="pills-session" aria-selected="false">Session History</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="pills-plan-tab" data-bs-toggle="pill" data-bs-target="#pills-plan" type="button" role="tab" aria-controls="pills-plan" aria-selected="false">Plan History</button>
                </li>
              </ul>
            </div>
            <div class="tab-content history_tbl" id="pills-tabContent">
              {{-- Course Table --}}
              <div class="tab-pane fade show active" id="pills-course" role="tabpanel" aria-labelledby="pills-course-tab" tabindex="0">
                <div class="table-responsive">
                  <table id="example" class="table table-responsive table-borderless table-striped">
                    <thead>
                      <tr class="bg-light align-middle">
                          {{-- <th scope="col" width="5%"><input class="form-check-input" type="checkbox"></th> --}}
                          <th scope="col" width="5%">#</th>
                          <th scope="col" width="10%">Name</th>
                          <th scope="col" width="35%">Course Name</th>
                          <th scope="col" width="5%">Amount</th>
                          <th scope="col" width="5%">Transaction</th>
                          <th scope="col" width="5%">Device</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php $counter = 1; @endphp
                      @foreach ($courseTransactions as $transaction)
                      @if($transaction->user)
                      <tr class="align-middle">
                          <td>{{ $counter }}</td>
                          <td>{{ $transaction->user->first_name }} {{ $transaction->user->last_name }}</td>
                          <td>{{ $transaction->course->course_name ?? ''}}</td>
                          {{-- <td>${{ $transaction->final_amount }}</td> --}}
                          <td>
                            @if ($transaction->payment_status === 1)
                              <span style="color: green;">${{ $transaction->final_amount }}</span>
                            @else
                              <span style="color: red;">${{ $transaction->final_amount }}</span>
                            @endif
                          </td>
                          <td>
                            @if ($transaction->created_at)
                                {{ $transaction->created_at->format('Y-m-d') }}
                            @else
                                No date available
                            @endif
                          </td>
                          <td>{{ $transaction->device_type }}</td>
                      </tr>
                      @php $counter++; @endphp
                      @endif
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              {{-- Session Table --}}
              <div class="tab-pane fade" id="pills-session" role="tabpanel" aria-labelledby="pills-session-tab" tabindex="0">
                <div class="table-responsive">
                  <table id="example_session" class="table table-responsive table-borderless table-striped">
                    <thead>
                      <tr class="bg-light align-middle">
                          {{-- <th scope="col" width="5%"><input class="form-check-input" type="checkbox"></th> --}}
                          <th scope="col" width="5%">#</th>
                          <th scope="col" width="10%">Name</th>
                          <th scope="col" width="35%">Session Name</th>
                          <th scope="col" width="5%">Amount</th>
                          <th scope="col" width="5%">Transaction</th>
                          <th scope="col" width="5%">Device</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php $counter = 1; @endphp
                      @foreach ($sessionTransactions as $sessionTransaction)
                      @if($sessionTransaction->user)
                      <tr class="align-middle">
                          <td>{{ $counter }}</td>
                          <td>{{ $sessionTransaction->user->first_name }} {{ $sessionTransaction->user->last_name }}</td>
                          <td>{{ $sessionTransaction->session->session_name ?? ''}}</td>
                          <td>
                            @if ($sessionTransaction->payment_status === 1)
                              <span style="color: green;">${{ $sessionTransaction->final_amount }}</span>
                            @else
                              <span style="color: red;">${{ $sessionTransaction->final_amount }}</span>
                            @endif
                          </td>
                          <td>
                            @if ($sessionTransaction->created_at)
                                {{ $sessionTransaction->created_at->format('Y-m-d') }}
                            @else
                                No date available
                            @endif
                          </td>
                          <td>{{ $sessionTransaction->device_type }}</td>
                      </tr>
                      @php $counter++; @endphp
                      @endif
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              {{-- Plan Table --}}
              <div class="tab-pane fade" id="pills-plan" role="tabpanel" aria-labelledby="pills-plan-tab" tabindex="0">
                <div class="table-responsive">
                  <table id="example_plan" class="table table-responsive table-borderless table-striped">
                    <thead>
                      <tr class="bg-light align-middle">
                          {{-- <th scope="col" width="5%"><input class="form-check-input" type="checkbox"></th> --}}
                          <th scope="col" width="5%">#</th>
                          <th scope="col" width="10%">User Name</th>
                          <th scope="col" width="50%">Plan Name</th>
                          <th scope="col" width="5%">Plan Type</th>
                          <th scope="col" width="5%">Plan Amount</th>
                          <th scope="col" width="5%">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php $counter = 1; @endphp
                      @foreach ($planTransactions as $planTransaction)
                      @if($planTransaction->user)
                      <tr class="align-middle">
                          <td>{{ $counter }}</td>
                          <td>{{ $planTransaction->user->first_name }} {{ $planTransaction->user->last_name }}</td>
                          <td>{{ $planTransaction->plan->plan_title }}</td>
                          <td>{{ $planTransaction->plan->plan_type }}</td>
                          <td>${{ $planTransaction->final_amount }}</td>
                          <td>
                            @if ($planTransaction->payment_status === 1)
                              <span style="color: green;">Active</span>
                            @else
                              <span style="color: red;">Inactive</span>
                            @endif
                          </td>
                      </tr>
                      @php $counter++; @endphp
                      @endif
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              </div>
            </div>
            

          </div>
        </div>
      </div>
    </div>
  </section>
  
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/rowreorder/1.4.1/js/dataTables.rowReorder.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

<script>
  // const ctx = document.getElementById('RevenueGenerated');
  // new Chart(ctx, {
  //   type: 'bar',
    
  //   data: {
  //     labels: ['01-02','03-04','05-06','07-08','09-10','11-12' ],
  //     datasets: [{
  //   label: 'Bar chart',
  //   data: [16,32,48,64,80,100],
  //   backgroundColor: [
  //     'rgba(255, 99, 132, 0.2)',
  //     'rgba(255, 159, 64, 0.2)',
  //     'rgba(255, 205, 86, 0.2)',
  //     'rgba(75, 192, 192, 0.2)',
  //     'rgba(54, 162, 235, 0.2)',
  //     'rgba(153, 102, 255, 0.2)',
  //     'rgba(201, 203, 207, 0.2)'
  //   ],
  //   borderColor: [
  //     'rgb(255, 99, 132)',
  //     'rgb(255, 159, 64)',
  //     'rgb(255, 205, 86)',
  //     'rgb(75, 192, 192)',
  //     'rgb(54, 162, 235)',
  //     'rgb(153, 102, 255)',
  //     'rgb(201, 203, 207)'
  //   ],
  //   borderWidth: 1
  //   }]
  //   },
  
  // });
  
  
///// start RevenueGenerated chart code
  const revenueData = @json($revenueData);
    // Extract date and revenue values
  const labels11 = revenueData.labels; // Replace with your date labels array
  const revenueValues = revenueData.revenueValues; // Replace with your revenue values array
  const ctx = document.getElementById('RevenueGenerated');
  new Chart(ctx, {
      type: 'bar',
      data: {
          labels: labels11, // Set the date labels here
          datasets: [{
              label: 'Revenue Generated',
              data: revenueValues, // Set the revenue data here
              backgroundColor: [
                  'rgba(255, 99, 132, 0.2)'
              ],
              borderColor: [
                  'rgb(255, 99, 132)'
              ],
              borderWidth: 1
          }]
      },
      options: {
          scales: {
              y: {
                  beginAtZero: true
              }
          }
      }
  });

  ///// start Browser Usage chart code
    const ctxt2 = document.getElementById('browserUsage');
    const countryData = @json($browserUsage);
    // Extract country names and counts
    
    const labels = countryData.map(item => item.signup_date);
    // console.log(labels);
    const dataCounts = countryData.map(item => item.total_signups);
    new Chart(ctxt2, {
      type: 'line',
      
      data: {
      labels: labels,
      datasets: [{
      label: 'Number of signups between the date of this month',
      data: dataCounts,
      fill: false,
      borderColor: 'rgb(75, 192, 192)',
      hoverOffset: 4
    }]
      },
    });
  ///// end Browser Usage chart code
  
  
  
// /- myDoughnutchart
const ctxt = document.getElementById('myDoughnutchart');
  new Chart(ctxt, {
    type: 'doughnut',
    data: {
    // labels: ['01-02','03-04','05-06','07-08','09-10','11-12' ],
    datasets: [{
    label: 'My First Dataset',
    data: [300, 50, 100,80],
    backgroundColor: [
      'rgb(255, 99, 132)',
      'rgb(54, 162, 235)',
      'rgb(255, 205, 86)',
      'rgb(15,34, 56)',
      'rgb(17, 209, 71)',
      'rgb(115, 103, 240)',
    ],
    hoverOffset: 4
  }]
    },
  });

</script>
<script>
// Data Table
$(document).ready(function() {
    var table1 = $('#example').DataTable( {
        lengthChange: true,
        "lengthMenu": [1, 2, 3, 4, 5],
        "pageLength": 5,  
    } );
    
    var table2 = $('#example_session').DataTable({
      lengthChange: true,
      lengthMenu: [1, 2, 3, 4, 5],
      pageLength: 5,
    });
    
    // DataTable for the second table
    var table3 = $('#example_plan').DataTable({
        lengthChange: true,
        lengthMenu: [1, 2, 3, 4, 5],
        pageLength: 5,
    });

    table.buttons().container()
    .appendTo( '#example_wrapper .col-md-6:eq(0)' );

    
    

  // loader on tab change
  // Handle tab 1 click
  $("#pills-area-tab").click(function() {
    showLoader();
    setTimeout(function() {
      hideLoader();
    }, 1000); // Hide loader after 2 seconds (adjust as needed)
  });

  // Handle tab 2 click
  $("#pills-doughnut-tab").click(function() {
    showLoader();
    setTimeout(function() {
      hideLoader();
    }, 1000); // Hide loader after 2 seconds (adjust as needed)
  });

  function showLoader() {
    $(".overlay.dark").css("display", "flex");
  }

  function hideLoader() {
    $(".overlay.dark").css("display", "none");
  }
 
  // Wait for the document to be ready
  setTimeout(function() {
    $(".overlay.dark").css("display", "none"); // Change the CSS property to 'none' after 1 seconds
  }, 1000); // 1000 milliseconds = 1 seconds
        
} );
</script>
@endsection
  