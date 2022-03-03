<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    <link href="{{ asset('/frontend/css/bootstrap@5.13.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/frontend/css/custom.css') }}" rel="stylesheet">
    {{-- owl carousel --}}
    <link href="{{ asset('/frontend/css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/frontend/css/owl.theme.default.min.css') }}" rel="stylesheet">
    {{-- jQuery autoComplete --}}
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    {{-- google fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital@1&display=swap" rel="stylesheet">
        <style>

    </style>
</head>
<body >
        @include('layouts.inc.frontnav')
        <div class="content">
            @yield('content')
        </div>
        <div class="whatsapp-chat">
            <a href="https://wa.me/+201007217557?text=I'm%20interested%20in%20your%20car%20for%20sale" target="_blank">
                <img src="{{asset('assets/images/whatsapp.png')}}" alt="whatsaap logo" height="80px" width="80px">
            </a>
        </div>

    <!--   Core JS Files   -->
    <script src="{{ asset('/frontend/js/jquery-3.6.0.min.js')}}" ></script>
    <script src="{{ asset('/frontend/js/bootstrap@5.1.3.bundle.min.js')}}" ></script>
    <script src="{{ asset('/frontend/js/owl.carousel.min.js')}}" ></script>
        <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/620cbd4da34c2456412686a5/1fs0s6uac';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();
    </script>
    <!--End of Tawk.to Script-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    {{-- jQuery autoComplete --}}
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script>

            var availableTags = [];

            $.ajax({
                method: "GET",
                url: "/product-list",
                success: function (response) {
                    startAutoComplete(response);
                    console.log(response);
                },
            });
            function startAutoComplete(availableTags) {

            $( "#search-bar" ).autocomplete({
                source: availableTags
            });
            }
        </script>
    @if(session("status"))
        <script>
            swal("{{session("status")}}");
        </script>
    @endif
    <script src="{{ asset('/frontend/js/checkout.js')}}" ></script>
    @yield('scripts')
</body>
</html>
