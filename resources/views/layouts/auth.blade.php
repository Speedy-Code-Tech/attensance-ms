<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
    <script src="{{ asset('js/jquery-3.6.1.min.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/atlantis.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/jrey.css')}}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        body[data-background-color=bg2] {
            background: #FFF;
        }
        
        .c-theme-bg {
            background-color: #F1B20D !important;
        }
        
        .c-theme-text {
            color: #0D9FB6 !important;
        }
        
        .btn-border.btn-info {
            color: #F1B20D !important;
            border: 1px solid #F1B20D !important;
        }
        </style>
</head>
<body data-background-color="bg2">
    <div id="app">

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!--   Core JS Files   -->
    {{-- <script src="{{asset('js/core/jquery.3.2.1.min.js')}}"></script> --}}
    <script src="{{asset('js/core/popper.min.js')}}"></script>
    <script src="{{asset('js/core/bootstrap.min.js')}}"></script>
{{-- 
    <!-- jQuery UI -->
    <script src="{{asset('js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js')}}"></script>
    <script src="{{asset('js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js')}}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{asset('js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>

    <!-- Moment JS -->
    <script src="{{asset('js/plugin/moment/moment.min.js')}}"></script>

    <!-- Chart JS -->
    <script src="{{asset('js/plugin/chart.js/chart.min.js')}}"></script>

    <!-- jQuery Sparkline -->
    <script src="{{asset('js/plugin/jquery.sparkline/jquery.sparkline.min.js')}}"></script>

    <!-- Chart Circle -->
    <script src="{{asset('js/plugin/chart-circle/circles.min.js')}}"></script>

    <!-- Datatables -->
    <script src="{{asset('js/plugin/datatables/datatables.min.js')}}"></script>

    <!-- Bootstrap Notify -->
    <script src="{{asset('js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>

    <!-- Bootstrap Toggle -->
    <script src="{{asset('js/plugin/bootstrap-toggle/bootstrap-toggle.min.js')}}"></script>

    <!-- jQuery Vector Maps -->
    <script src="{{asset('js/plugin/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{asset('js/plugin/jqvmap/maps/jquery.vmap.world.js')}}"></script>

    <!-- Google Maps Plugin -->
    <script src="{{asset('js/plugin/gmaps/gmaps.js')}}"></script>

    <!-- Dropzone -->
    <script src="{{asset('js/plugin/dropzone/dropzone.min.js')}}"></script>

    <!-- Fullcalendar -->
    <script src="{{asset('js/plugin/fullcalendar/fullcalendar.min.js')}}"></script>

    <!-- DateTimePicker -->
    <script src="{{asset('js/plugin/datepicker/bootstrap-datetimepicker.min.js')}}"></script>

    <!-- Bootstrap Tagsinput -->
    <script src="{{asset('js/plugin/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}"></script>

    <!-- Bootstrap Wizard -->
    <script src="{{asset('js/plugin/bootstrap-wizard/bootstrapwizard.js')}}"></script>

    <!-- jQuery Validation -->
    <script src="{{asset('js/plugin/jquery.validate/jquery.validate.min.js')}}"></script>

    <!-- Summernote -->
    <script src="{{asset('js/plugin/summernote/summernote-bs4.min.js')}}"></script>

    <!-- Select2 -->
    <script src="{{asset('js/plugin/select2/select2.full.min.js')}}"></script>

    <!-- Sweet Alert -->
    <script src="{{asset('js/plugin/sweetalert/sweetalert.min.js')}}"></script>

    <!-- Owl Carousel -->
    <script src="{{asset('js/plugin/owl-carousel/owl.carousel.min.js')}}"></script>

    <!-- Magnific Popup -->
    <script src="{{asset('js/plugin/jquery.magnific-popup/jquery.magnific-popup.min.js')}}"></script>

    <!-- Atlantis JS -->
    <script src="{{asset('js/atlantis.min.js')}}"></script> --}}
</body>
</html>
