@include('layouts.seo_meta_script')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <style>
            .lm__header-logo .lm-logo {
               margin-top: 35px 
            }
        </style>
</head>
<body data-sidebar="dark">

    <!-- Page Content -->
        @yield('content')
    <!-- Script -->
</body>
        @include('layouts.base.script')
        
        @yield('js')
</html>
