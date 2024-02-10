@include('layouts.seo_meta_script')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/lib/main.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" rel="stylesheet" />
<link rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css"
  integrity="sha512-bYPO5jmStZ9WI2602V2zaivdAnbAhtfzmxnEGh9RwtlI00I9s8ulGe4oBa5XxiC6tCITJH/QG70jswBhbLkxPw=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
{{--
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.css"> --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
<link rel="stylesheet" href="{{ asset('assets/css/green-audio-player.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js" async> </script> --}}
<link rel="stylesheet" href="{{ asset('assets/css/loader.css') }}">
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
@include('layouts.admin.base.script')
  <script>
    function showContent() {
      // Show the auto-load sections
      $('.auto-load').show();
    }
  
    function showLoader(sectionId='') {
      // Show the loader initially
      $('#loader-container-' + sectionId).show();
    }
    
    function hideLoader(sectionId='') {
      // Hide the loader when content is loaded
      $('#loader-container-' + sectionId).hide();
    }
      
    $(document).ready(function() {
      // Show the initial loader
      showLoader();
    
      // Hide the content of all auto-load sections initially
      $('.auto-load').hide();
    
      // Simulate a delay of 2 seconds to demonstrate loading
      setTimeout(function() {
        // Show the content of each auto-load section and hide the loader
        $('.auto-load').each(function() {
          showContent($(this));
        });
        hideLoader();
      }, 500);
    });
  </script>
</head>
<body>
  {{-- Back to top --}}
  <a href="#" id="scroll">
    <span> <img class="in-svg" src="{{ asset('assets/images/backto.svg') }}" alt=""></span>
  </a>
  <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MBGL9CCJ"
  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
  
  <!-- Upper Header -->
  @php $user = Auth::user();@endphp
  @include('layouts.admin.base.header')
  <!-- Left Sidebar -->
  @include('layouts.admin.base.left-sidebar')

  <!-- Loader -->

  <div id="loader-container-" class="loader-container">
    <div class="loadaer-logo">
      <img src="{{ asset('assets/images/dash-logo.svg') }}">
    </div>
    <div class="loader"></div>
  </div>

  @yield('content')
</body>
{{-- this code will check  plan_expired if yes then will show a popup to buy plan --}}
<script type="text/javascript">
  var plan_expired = "{{ sendResponse('')['plan_expired'] }}";  
    if(plan_expired==1)
    {
      $("#subscription").modal('show');
    }
</script>
  <!-- Script -->
  {{-- <div class="ajax-load text-center lm_post-card lm_card-post my-4" style="display:none">
    <div class="spinner-border text-warning" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div> --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  @yield('js')
  
</html>
