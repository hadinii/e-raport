<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>@yield('title') | {{config('app.name')}}</title>`

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('adminty\files\assets\images\favicon.ico') }}" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{ asset('adminty\files\bower_components\bootstrap\css\bootstrap.min.css') }}">
    <!-- sweet alert framework -->
    <link rel="stylesheet" type="text/css" href="{{ asset('adminty\files\bower_components\sweetalert\css\sweetalert.css') }}">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{{ asset('adminty\files\assets\icon\icofont\css\icofont.css') }}">
    <!-- j-form css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('adminty\files\assets\pages\j-pro\css\j-forms.css') }}">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="{{ asset('adminty\files\assets\icon\feather\css\feather.css') }}">
    <!-- Data Table Css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('adminty\files\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css') }}">
    <!-- animation nifty modal window effects css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('adminty\files\assets\css\component.css') }}">
    <!-- Notification.css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('adminty\files\assets\pages\notification\notification.css') }}">
    <!-- Date-Dropper css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('adminty\files\bower_components\datedropper\css\datedropper.min.css') }}">
    <!-- Animate.css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('adminty\files\bower_components\animate.css\css\animate.css') }}">
    <!-- Switch component css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('adminty\files\bower_components\switchery\css\switchery.min.css') }}">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('adminty\files\assets\css\style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminty\files\assets\css\jquery.mCustomScrollbar.css') }}">
</head>

<body>

    <!-- Pre-loader start -->
    @include('partials.loader')
    <!-- Pre-loader end -->

    @if ($showNav)
        <div id="pcoded" class="pcoded">
            <div class="pcoded-overlay-box"></div>
            <div class="pcoded-container navbar-wrapper">

                <!-- Navbar start -->
                @include('partials.navbar')
                <!-- Navbar end-->

                <div class="pcoded-main-container">
                    <div class="pcoded-wrapper">

                        <!-- Sidebar start -->
                        @include('partials.sidebar')
                        <!-- Sidebar end -->

                        <div class="pcoded-content">
                            <div class="pcoded-inner-content">
                                <div class="main-body">
                                    @yield('content')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        @yield('content')
    @endif

    <!-- Required Jquery -->
    <script type="text/javascript" src="{{ asset('adminty\files\bower_components\jquery\js\jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('adminty\files\bower_components\jquery-ui\js\jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('adminty\files\bower_components\popper.js\js\popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('adminty\files\bower_components\bootstrap\js\bootstrap.min.js') }}"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="{{ asset('adminty\files\bower_components\jquery-slimscroll\js\jquery.slimscroll.js') }}"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="{{ asset('adminty\files\bower_components\modernizr\js\modernizr.js') }}"></script>
    <!-- notification js -->
    <script type="text/javascript" src="{{ asset('adminty\files\assets\js\bootstrap-growl.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('adminty\files\assets\pages\notification\notification.js') }}"></script>
    <!-- Masking js -->
    <script src="{{ asset('adminty\files\assets\pages\form-masking\inputmask.js') }}"></script>
    <script src="{{ asset('adminty\files\assets\pages\form-masking\jquery.inputmask.js') }}"></script>
    <script src="{{ asset('adminty\files\assets\pages\form-masking\autoNumeric.js') }}"></script>
    <script src="{{ asset('adminty\files\assets\pages\form-masking\form-mask.js') }}"></script>
    <!-- Chart js -->
    <script type="text/javascript" src="{{ asset('adminty\files\bower_components\chart.js\js\Chart.js') }}"></script>
    <!-- amchart js -->
    <script src="{{ asset('adminty\files\assets\pages\widget\amchart\amcharts.js') }}"></script>
    <script src="{{ asset('adminty\files\assets\pages\widget\amchart\serial.js') }}"></script>
    <script src="{{ asset('adminty\files\assets\pages\widget\amchart\light.js') }}"></script>
    <script src="{{ asset('adminty\files\assets\js\jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('adminty\files\assets\js\SmoothScroll.js') }}"></script>
    <script src="{{ asset('adminty\files\assets\js\pcoded.min.js') }}"></script>
    <!-- custom js -->
    <script src="{{ asset('adminty\files\assets\js\vartical-layout.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('adminty\files\assets\pages\dashboard\custom-dashboard.js') }}"></script>
    <script type="text/javascript" src="{{ asset('adminty\files\assets\js\script.min.js') }}"></script>
    @stack('script')
</body>

</html>
