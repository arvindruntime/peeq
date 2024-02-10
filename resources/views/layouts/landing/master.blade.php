<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="X-UA-Compatible" content="IE=7">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PEEQ</title>
  <link rel="shortcut icon" href="{{ asset('landing/assets/images/favicon1.ico')}}" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <link rel="stylesheet" href="{{ asset('landing/style.css')}}">
  <script src="{{ asset('landing/assets/js/jquery-3.6.0.min.js') }}"></script>
</head>

<body>
    @include('layouts.landing.header')
    <!-- Page Content -->
    @yield('content')
    <!-- Script -->
</body>
        @include('layouts.landing.footer')
        @include('layouts.landing.script')
        
        @yield('js')
</html>