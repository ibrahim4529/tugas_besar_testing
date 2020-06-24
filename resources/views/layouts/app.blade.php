<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>TokoOnline | @yield('title') </title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/atlantis.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fonts.min.css') }}">
    @stack('css')
</head>
<body @guest class="login" @endguest>
<div class="wrapper @guest wrapper-login @endguest">
    @guest
        @yield('content')
    @else
        <div class="main-header">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="blue">

                <a href="#" class="logo">
                    <img src="{{ asset('img/logo.svg') }}" alt="navbar brand" class="navbar-brand"
                         width="85%">
                </a>
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
                        data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <i class="icon-menu"></i>
                    </span>
                </button>
                <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
                <div class="nav-toggle">
                    <button class="btn btn-toggle toggle-sidebar">
                        <i class="icon-menu"></i>
                    </button>
                </div>
            </div>
            <!-- End Logo Header -->

            <!-- Navbar Header -->
            <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
                <div class="container-fluid">
                    <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                        <li class="nav-item dropdown hidden-caret">
                            <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                                <span class="notification">4</span>
                            </a>
                            <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                                <li>
                                    <div class="dropdown-title">You have 4 new notification</div>
                                </li>
                                <li>
                                    <div class="notif-scroll scrollbar-outer">
                                        <div class="notif-center">
                                            <a href="#">
                                                <div class="notif-icon notif-primary"><i class="fa fa-user-plus"></i>
                                                </div>
                                                <div class="notif-content">
                                                    <span class="block">
                                                        New user registered
                                                    </span>
                                                    <span class="time">5 minutes ago</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <a class="see-all" href="javascript:void(0);">See all notifications<i
                                            class="fa fa-angle-right"></i> </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown hidden-caret">
                            <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"
                               aria-expanded="false">
                                <div class="avatar-sm">
                                    <img src="{{ asset('img/profile.jpg') }}" alt="..."
                                         class="avatar-img rounded-circle">
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-user animated fadeIn">
                                <div class="dropdown-user-scroll scrollbar-outer">
                                    <li>
                                        <div class="user-box">
                                            <div class="avatar-lg"><img src="{{ asset('img/profile.jpg') }}"
                                                                        alt="image profile" class="avatar-img rounded">
                                            </div>
                                            <div class="u-text">
                                                <h4>Admin</h4>
                                                <p class="text-muted"></p><a href="profile.html"
                                                                             class="btn btn-xs btn-secondary btn-sm">View
                                                    Profile</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                              style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </div>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- End Navbar -->
        </div>

        <!-- Sidebar -->
        @include('layouts.partials.nav')
    <!-- End Sidebar -->
        <div class="main-panel">
            <div class="container">
                @yield('content')
            </div>

            @include('layouts.partials.footer')
        </div>

    @endguest
</div>
{{-- Core Js For Theme --}}
<script src="{{ asset('js/core/jquery.3.2.1.min.js') }}"></script>
<script src="{{ asset('js/core/popper.min.js') }}"></script>
<script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js')}}"></script>
<script src="{{ asset('js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js')}}"></script>

<!-- jQuery Scrollbar -->
<script src="{{ asset('js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>

<!-- Moment JS -->
<script src="{{ asset('js/plugin/moment/moment.min.js')}}"></script>

<!-- Chart JS -->
<script src="{{ asset('js/plugin/chart.js/chart.min.js')}}"></script>
{{--
<!-- jQuery Sparkline -->
<script src="{{ asset('js/plugin/jquery.sparkline/jquery.sparkline.min.js')}}"></script>

<!-- Chart Circle -->
<script src="{{ asset('js/plugin/chart-circle/circles.min.js')}}"></script> --}}

<!-- Datatables -->
<script src="{{ asset('js/plugin/datatables/datatables.min.js')}}"></script>

<!-- Bootstrap Notify -->
<script src="{{ asset('js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>

<!-- Bootstrap Toggle -->
<script src="{{ asset('js/plugin/bootstrap-toggle/bootstrap-toggle.min.js')}}"></script>

<!-- jQuery Vector Maps -->
{{-- <script src="{{ asset('js/plugin/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{ asset('js/plugin/jqvmap/maps/jquery.vmap.world.js')}}"></script> --}}

{{-- <!-- Google Maps Plugin -->
<script src="{{ asset('js/plugin/gmaps/gmaps.js')}}"></script>

<!-- Dropzone -->
<script src="{{ asset('js/plugin/dropzone/dropzone.min.js')}}"></script>

<!-- Fullcalendar -->
<script src="{{ asset('js/plugin/fullcalendar/fullcalendar.min.js')}}"></script> --}}

<!-- DateTimePicker -->
<script src="{{ asset('js/plugin/datepicker/bootstrap-datetimepicker.min.js')}}"></script>

<!-- Bootstrap Tagsinput -->
<script src="{{ asset('js/plugin/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}"></script>
{{--
<!-- Bootstrap Wizard -->
<script src="{{ asset('js/plugin/bootstrap-wizard/bootstrapwizard.js')}}"></script> --}}

<!-- jQuery Validation -->
<script src="{{ asset('js/plugin/jquery.validate/jquery.validate.min.js')}}"></script>

{{-- <!-- Summernote -->
<script src="{{ asset('js/plugin/summernote/summernote-bs4.min.js')}}"></script> --}}

<!-- Select2 -->
<script src="{{ asset('js/plugin/select2/select2.full.min.js')}}"></script>

<!-- Sweet Alert -->
<script src="{{ asset('js/plugin/sweetalert/sweetalert.min.js')}}"></script>

{{-- <!-- Owl Carousel -->
<script src="{{ asset('js/plugin/owl-carousel/owl.carousel.min.js')}}"></script> --}}

<!-- Magnific Popup -->
<script src="{{ asset('js/plugin/jquery.magnific-popup/jquery.magnific-popup.min.js')}}"></script>

<!-- Atlantis JS -->
<script src="{{ asset('js/atlantis.min.js')}}"></script>
@stack('js')
</body>
</html>
