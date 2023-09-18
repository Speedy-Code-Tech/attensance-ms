<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{asset('images/favicon/favicon.ico')}}" type="image/x-icon">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ? $title . ' - Rotary Club of Tanauan' : 'Rotary Club' }}</title>
    <link rel="icon" href="{{asset('images/favicon/favicon.ico')}}" type="image/x-icon">

    <script src="{{asset('js/plugin/webfont/webfont.min.js')}}"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: ['{{asset('css/fonts.css')}}']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/core/jquery.3.2.1.min.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/atlantis.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/demo.css')}}">
    <link rel="stylesheet" href="{{asset('css/jrey.css')}}">
    <link rel="stylesheet" href="{{asset('css/select2.css')}}">
    <link rel="stylesheet" href="{{asset('css/preloader.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
</head>
<style>
    .logo-header {
        background: #F1B20D !important;
    }
    
    .navbar-header {
        background: #232524 !important;
    }
    
    .sidebar,
    .sidebar[data-background-color=white] {
        background: #F1B20D !important;
    }
    
    .sidebar .user .info a>span,
    .sidebar[data-background-color=white] .user .info a>span {
        color: #323232;
    }
    
    .sidebar .user .info a>span .user-level,
    .sidebar[data-background-color=white] .user .info a>span .user-level {
        color: #323232;
    }
    
    .sidebar .nav .nav-section .text-section,
    .sidebar[data-background-color=white] .nav .nav-section .text-section {
        color: #323232;
    }
    
    .sidebar .nav>.nav-item a p,
    .sidebar[data-background-color=white] .nav>.nav-item a p {
        color: #323232;
    }
    
    .sidebar .nav>.nav-item a i,
    .sidebar[data-background-color=white] .nav>.nav-item a i {
        color: #323232;
    }
    
    .sidebar.sidebar-style-2 .nav.nav-primary>.nav-item.active>a {
        background: #323232 !important;
    }
    
    .navbar .navbar-nav .notification {
        background-color: #686868;
    }
    
    
    
    .btn-secondary {
        background: #F1B20D !important;
        border-color: #F1B20D !important;
    }
    
    .bg-secondary {
        background: #F1B20D !important;
    }
    
    
    .btn-secondary:hover {
        background: #24b3ca !important;
        border-color: #24b3ca !important;
    }
    
    .c-theme-bg {
        background-color: #F1B20D !important;
    }
    
    .c-theme-text {
        color: #F1B20D !important;
    }
    
    
    .br-0 {
        border-radius: 0px !important;
    }
    
    .bg-success {
        background-color: #007E35 !important;
    }
    
    
    .btn-light {
        background: #f8f9fa !important;
        border-color: transparent;
    }
    
    .form-control:disabled,
    .form-control[readonly] {
        border-color: #d4d4d4 !important;
    }
    
    .add-media:hover span i {
        font-size: 35px;
        transition: 1s;
    }
    
    .jumbotron-thin {
        padding: 1rem 1rem;
    }
    
    /* FILTERS */
    .filter-less-mb {
        margin-bottom: -10px !important;
    }
    
    .filter-action-btn {
        height: 80%;
    }
    
    /* FILTERS */
    
    
    .sidebar .nav.nav-primary>.nav-item a:focus i,
    .sidebar .nav.nav-primary>.nav-item a:hover i,
    .sidebar .nav.nav-primary>.nav-item a[data-toggle=collapse][aria-expanded=true] i,
    .sidebar[data-background-color=white] .nav.nav-primary>.nav-item a:focus i,
    .sidebar[data-background-color=white] .nav.nav-primary>.nav-item a:hover i,
    .sidebar[data-background-color=white] .nav.nav-primary>.nav-item a[data-toggle=collapse][aria-expanded=true] i {
        color: #fff !important;
    }
    
    .bg-blue {
        background: #F1B20D !important;
    }
    
    .bg-black {
        background: #F1B20D !important;
    }
    
    .sidebar .nav>.nav-item a,
    .sidebar[data-background-color=white] .nav>.nav-item a {
        color: #323232;
    }
    
    .modal-header {
        background-color: #323232 !important;
    }
    
    .btn-black {
        background: #F1B20D !important;
        border-color: #F1B20D !important;
        color: #fff;
    }
    
    .bg-primary-gradient {
        background: #1572e8 !important;
        background: -webkit-linear-gradient(legacy-direction(-45deg), #06418e, #1572e8) !important;
        background: linear-gradient(-45deg, #505050, #505050) !important;
    }
    
    .bg-light-main {
        background-color: #F1B20D;
        border-radius: none;
    }
    
    .btn-light-main {
        background: #F1B20D !important;
        border: 1px solid #F1B20D !important;
        color: #fff;
    }
    </style>
<body data-background-color="bg1">
    <div class="wrapper">
        
        @include('layouts.sidebar', ['firstName' => Auth::user()->role == 'member' ? Auth::user()->member->first_name : Auth::user()->username, 
        'lastName' => Auth::user()->role == 'member' ? Auth::user()->member->last_name : '',
        'profilePicture' => Auth::user()->role == 'member' ? Auth::user()->member->profile_picture : null,
        'role' => Auth::user()->role,
        'pageTitle' => $title
        ])
        
        @yield('content')
    </div>

    <script src="{{asset('js/core/popper.min.js')}}"></script>
    <script src="{{asset('js/core/bootstrap.min.js')}}"></script>
</body>
<!-- jQuery UI -->
<script src="{{ asset('js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>

<!-- jQuery Scrollbar -->
<script src="{{ asset('js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

<!-- SELECT BOX -->
<script src="{{ asset('js/bootstrap-select.min.js') }}"></script>

<!-- Datatables -->
<script src="{{ asset('js/plugin/datatables/datatables.min.js') }}"></script>

	<!-- Select2 -->
	<script src="{{ asset('js/plugin/select2/select2.full.min.js') }}"></script>

	<!-- Sweet Alert -->
	<script src="{{ asset('js/plugin/sweetalert/sweetalert.min.js') }}"></script>

	<!-- Atlantis JS -->
	<script src="{{ asset('js/atlantis.js') }}"></script>

	<script src="{{ asset('js/setting-demo.js') }}"></script>
@include('layouts.preloader')
</html>
