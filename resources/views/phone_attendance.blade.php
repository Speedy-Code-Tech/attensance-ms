<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{asset('images/favicon/favicon.ico')}}" type="image/x-icon">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ 'QR Scanner - Rotary Club of Tanauan' }}</title>
    <link rel="icon" href="{{asset('images/favicon/favicon.ico')}}" type="image/x-icon">

    <script src="https://cdn.jsdelivr.net/npm/quagga"></script>

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
    <link rel="stylesheet" href="{{asset('css/jrey.css')}}">
    <link rel="stylesheet" href="{{asset('css/qr-code-scanner.css')}}">

    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div id="qr-reader">
        <video id="qr-video" width="100%" height="auto"></video>
        <canvas id="qr-canvas"></canvas>
    </div>
    <div id="qr-reader-results"></div>

    <h2>Today's Attendance</h2>
    <ul id="attendance-list">
        @if (isset($todayAttendance) && !empty($todayAttendance))
            @foreach ($todayAttendance as $attendance)
            <li>
                <span>{{$attendance->member->last_name}}</span>
                <span>{{$attendance->attended_at}}</span>
            </li>
            @endforeach
        @else
            <li>No attendance records found for today.</li>
        @endif
    
    </ul>
</body>

<script src="{{asset('js/core/bootstrap.min.js')}}"></script>
<script src="{{asset('js/core/popper.min.js')}}"></script>
<script src="{{asset('js/qr-code-scanner.js')}}"></script>
</html>
