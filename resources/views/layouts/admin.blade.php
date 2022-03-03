<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('/admin/css/nucleo-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('/admin/css/nucleo-svg.css') }}" rel="stylesheet">
     <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    <link id="pagestyle" href="{{ asset('/admin/css/material-dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('/admin/css/custom.css') }}" rel="stylesheet">
</head>
<body class="g-sidenav-show bg-gray-200">

    <div class="wrapper">
        @include('layouts.inc.sidebar')
        <div class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
            @include('layouts.inc.adminnav')
            <div class="content">
                @yield('content')
            </div>
            @include('layouts.inc.adminfooter')
        </div>
    </div>

    <!--   Core JS Files   -->
    <script src="{{ asset('/admin/js/popper.min.js')}}" ></script>
    <script src="{{ asset('/admin/js/bootstrap.min.js')}}" ></script>
    <script src="{{ asset('/admin/js/perfect-scrollbar.min.js')}}" ></script>
    <script src="{{ asset('/admin/js/smooth-scrollbar.min.js')}}" ></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
          var options = {
            damping: '0.5'
          }
          Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
      </script>

    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('/admin/js/material-dashboard.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    @if(session("status"))
        <script>
            swal("{{session("status")}}");
        </script>
    @endif
    @yield('scripts')
</body>
</html>
