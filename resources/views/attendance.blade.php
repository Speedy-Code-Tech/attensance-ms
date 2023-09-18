<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{asset('images/favicon/favicon.ico')}}" type="image/x-icon">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ 'Attendance' }}</title>
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

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <style>
        /* @font-face {
            font-family: 'Nesobrite';
            src: url('thefont.ttf');
        }
        .nesobrite {
            font-family: 'Nesobrite' !important;
        } */
        body[data-background-color=bg2] {
            background: #F1B20D;
        }
        
        .c-theme-bg {
            background-color: #364741 !important;
        }
        
        .c-theme-text {
            color: #364741 !important;
        }
        
        .btn-border.btn-info {
            color: #364741 !important;
            border: 1px solid #364741 !important;
        }
        
        .text-darkgreen {
            color: #364741 !important;
        }
        
        .btn-green1 {
            background: #319D86 !important;
            border: 1px solid #319D86 !important;
            color: #fff;
        }
        
        .btn-green1:hover {
            background: #364741 !important;
            border: 1px solid #364741 !important;
        }
        
        html {
            overflow-y: hidden;
        }
        
        html {
            overflow-x: hidden;
        }
        
        .clock {
            font-size: 70px;
            font-weight: bolder;
        }
        
        .date {
            font-size: 35px;
            letter-spacing: 0.5px;
            line-height: 0.3;
        }
        
        .summary-title {
            font-size: 24px;
        }
        
        .summary-desc {
            font-size: 54.5px;
            letter-spacing: 1.4px;
            line-height: 0.3;
            font-weight: bolder;
        }
        
        .img-recent {
            width: 100px;
            height: 100px;
        }
        
        .profile-pic {
            width: 484px;
            height: 484px;
        }
        
        .text-blue {
            color: #F1B20D !important;
        }
        
        .text-light-blue {
            color: #232524 !important;
        }
        
        .bg-blue {
            background-color: #F1B20D;
        }
        
        .bg-light-main {
            background-color: #232524;
            padding: 0;
            border-radius: none;
            color: #fff;
        }
        
        .student-details {
            background-color: #232524;
            padding: 0.49rem 1.25rem;
        }
        
        .announcement-title {
            font-size: 30px;
            font-weight: bolder;
            letter-spacing: 2.4px;
            background-color: #505050;
        }
        
        .error_msg {
            font-size: 20px;
            font-weight: bolder;
            letter-spacing: 2.4px;
        }
        
        .announcement-desc {
            font-size: 25px;
        }
        
        .jumbotron {
            padding: 0rem 0rem;
            border-radius: 0rem;
        }
        
        .student-details-sm {
            background-color: #232524;
            padding: 0.05rem 0.25rem;
        }
        
        #rfid {
            background: #F1B20D;
            border-color: #F1B20D;
            width: 1px;
        }
        
        .attd_text {
            font-size: 35px !important;
        }
        </style>
</head>
        
<body data-background-color="bg2">
    <div class="row">
        <div class="col-md-9">
            <div class="row bg-blue mb-2">
                <div class="col-md-2">
                    <img src="{{asset('images/rotary-international-gray.png')}}" class="w-75 m-3" alt="">
                </div>
                <div class="col-md-10">
                    <!-- Time -->
                    <div class="row ">
                        <div class="col-md-6 mt-2 text-white">
                            <!-- Time -->
                            <h1 class="clock">00:00:00</h1>
                            <h3 class="date"><?= date("l, F j, Y",strtotime(date('Y-m-d')))?></h3>
                        </div>
                        <div class="col-md-6 mt-2 text-white">
                            <!-- Summary -->
                            <div class="row">
                                <div class="col-md-4">
                                    <h3 class="summary-title">PRESENT</h3>
                                    <h1 class="summary-desc attendance" id="todayAttendance">{{ $todayAttendance }}</h1>
                                    <h1 class="summary-desc attendance"></h1>
                                </div>
                                <div class="col-md-4">
                                    <h3 class="summary-title">MEMBERS</h3>
                                    <h1 class="summary-desc students" id="totalMembers">{{$totalMembers}}</h1>
                                    <h1 class="summary-desc students"></h1>
                                </div>
                                <div class="col-md-4">
                                    <h3 class="summary-title">ABSENT</h3>
                                    <h1 class="summary-desc absent" id="todayAbsent">
                                        {{ $todayAbsent }}
                                            </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- STUDENT/ATTENDANCE DETAILS -->
            <div class="row" style="padding:0px">
                <div class="col-md-12" style="padding:0px">
                    <h1 class="btn-block text-white text-center p-1 fw-bold announcement-title bg-danger error_msg">
                    </h1>
                </div>
            </div>

            <div class="row bg-primary mt--2">

                <div class="col-md-12 bg-light-main d-flex">
                    <img src="{{ asset('images/create_hope.jpg') }}" class="profile-pic" alt="">
                    <ul class="list-group bg-light-main w-100">
                        <li class="list-group-item student-details text-uppercase fw-bold">Member ID:
                            &nbsp;&nbsp;&nbsp;&nbsp; <span class="attd_text" id="student_id"><span
                                    class="text-light-blue">.</span></span></li>
                        <li class="list-group-item student-details text-uppercase fw-bold">Name:
                            &nbsp;&nbsp;&nbsp;&nbsp; <span class="attd_text" id="name"><span
                                    class="text-light-blue">.</span></span></li>
                        <li class="list-group-item student-details text-uppercase fw-bold">Date:
                            &nbsp;&nbsp;&nbsp;&nbsp; <br> <span class="attd_text" id="date"><span
                                    class="text-light-blue">.</span></span></li>
                        <li class="list-group-item student-details text-uppercase fw-bold">Time IN:
                            &nbsp;&nbsp;&nbsp;&nbsp; <br> <span class="attd_text" id="time_in"><span
                                    class="text-light-blue">.</span></span></li>
                    </ul>
                </div>
            </div>

            <input type="text" name="qr" id="qr" autofocus>
                {{-- style=" position: absolute;left: 0px;top: 0px;z-index:-100"> --}}

            <!-- ANNOUNCEMENT -->
            {{-- <div class="row" style="padding:0px">
                <div class="col-md-12" style="padding:0px">
                    <h1 class="btn-block text-white text-center p-1 fw-bold announcement-title">ANNOUNCEMENT</h1>
                </div>
                <div class="col-md-12">
                    <p class="btn-block text-white text-center p-2 announcement-desc">Title
                    </p>
                    <br>
                </div>
                <!-- <video id="scanner" width="100%" height="auto"></video> -->

                <!-- <p id="result"></p> -->
            </div> --}}

        </div>
        <div class="col-md-3 p-2 pr-4 bg-white" style="height:100vh">
            <!-- Recent -->
            <h1 class="text-white mb-4 text-blue fw-bold">RECENT</h1>
            <div class="recent" id="attendance-list">
                @foreach ($attendances as $attendance)
                    
                <div class="jumbotron mt--4 pr-3 pl-3">
                    <div class="row">
                        <div class="col-md-12 bg-light-main d-flex">
                            <img src="{{ asset('images/create_hope.jpg') }}" class="img-recent" alt="">
                            <ul class="list-group bg-light-main w-100" style="font-size: 12.1px;">
                                <li class="list-group-item student-details-sm">Member ID: &nbsp;&nbsp;&nbsp; <span
                                        class="ml-auto" id="">
                                        {{ $attendance->member->rotary_id}}
                                    </span></li>
                                <li class="list-group-item student-details-sm">Name: &nbsp;&nbsp;&nbsp; <span
                                        class="ml-auto" id="">
                                        {{ $attendance->member->first_name . ' ' . $attendance->member->last_name}}
                                        </li>
                                        <li class="list-group-item student-details-sm">Date: &nbsp;&nbsp;&nbsp; <span
                                        class="ml-auto" id="">
                                        {{ $attendance->created_at->format('Y-m-d') }}
                                    </li>
                                    <li class="list-group-item student-details-sm">Time IN: &nbsp;&nbsp;&nbsp;<span
                                        class="ml-auto" id="">
                                        {{ $attendance->created_at->format('H:i:s') }}
                                        </li>
                                    </ul>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!--   Core JS Files   -->
    <script src="{{asset('js/core/popper.min.js')}}"></script>
    <script src="{{asset('js/core/bootstrap.min.js')}}"></script>
        
</body>
<script>
// Function to format a timestamp as date (e.g., "YYYY-MM-DD")
function formatDate(timestamp) {
    const date = new Date(timestamp);
    return date.toLocaleDateString('en-US', { year: 'numeric', month: '2-digit', day: '2-digit' });
}

// Function to format a timestamp as time (e.g., "HH:MM:SS")
function formatTime(timestamp) {
    const date = new Date(timestamp);
    return date.toLocaleTimeString('en-US', { hour12: false, hour: '2-digit', minute: '2-digit', second: '2-digit' });
}

// Function to update student details
function updateDetails(data) {
    document.getElementById('student_id').textContent = data.member.rotary_id;
    document.getElementById('name').textContent = `${data.member.first_name} ${data.member.last_name}`;
    document.getElementById('date').textContent = formatDate(data.attendance.created_at);
    document.getElementById('time_in').textContent = formatTime(data.attendance.created_at);

    // Show the details section
    document.querySelector('.bg-primary').style.display = 'block';

    // Hide details section after a delay (adjust the delay as needed)
    setTimeout(() => {
        document.getElementById('student_id').textContent = '.';
        document.getElementById('name').textContent = '.';
        document.getElementById('date').textContent = '.';
        document.getElementById('time_in').textContent = '.';
    }, 5000); // 5000 milliseconds = 5 seconds
}

// Handle QR code scanning
function handleQRCodeScanned(decodedText) {
    // Send a POST request to the server
    $.ajax({
        type: "ajax",
        method: "post",
        url: "attendance/log",
        data: {
            member_id: decodedText,
        },
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        async: false,
        dataType: "text",
        success: function (response) {
            var data = JSON.parse(response);
            console.log(data)
            updateDetails(data)
        },
        error: function (xhr, status, error) {
            var errorMessage = "Something went wrong";
            if (xhr.status === 404) {
                errorMessage = JSON.parse(xhr.responseText).message;
            }
            alert(errorMessage);
        },
    });
}

$("#qr").on('keypress', function(e) {
    if (e.which == 13) {
        let member_id = $(this).val();
        handleQRCodeScanned(member_id);
    }
})    
</script>

<script>
    // Update summary data
    function updateSummaryData(data) {
        document.getElementById('todayAttendance').textContent = data.total_attendances;
        document.getElementById('totalMembers').textContent = data.total_members;
        document.getElementById('todayAbsent').textContent = data.total_absents;
    }

    function updateAttendanceList() {
        // Make an AJAX request to fetch updated attendance data
        fetch('/get-recent-attendances')  // Replace with your actual API endpoint
            .then(response => response.json())
            .then(data => {
                console.log(data)
                updateSummaryData(data);
                const attendances = data.attendances;
                const attendanceList = document.getElementById('attendance-list');
                attendanceList.innerHTML = ''; // Clear existing list

                // Populate the attendance list with updated data
                attendances.forEach(attendance => {
                    const listItem = document.createElement('div');
                    listItem.className = 'jumbotron mt--4 pr-3 pl-3';
                    // Construct the list item content using attendance data
                    listItem.innerHTML = `
                        <div class="col-md-12 bg-light-main d-flex">
                                <img src="{{ asset('images/create_hope.jpg') }}" class="img-recent" alt="">
                                <ul class="list-group bg-light-main w-100" style="font-size: 12.1px;">
                                    <li class="list-group-item student-details-sm">Member ID: &nbsp;&nbsp;&nbsp; <span
                                            class="ml-auto" id="">
                                            ${attendance.member.rotary_id}
                                        </span></li>
                                    <li class="list-group-item student-details-sm">Name: &nbsp;&nbsp;&nbsp; <span
                                            class="ml-auto" id="">
                                            ${attendance.member.first_name} ${attendance.member.last_name}
                                            </li>
                                            <li class="list-group-item student-details-sm">Date: &nbsp;&nbsp;&nbsp; <span
                                            class="ml-auto" id="">
                                            ${formatDate(attendance.created_at)}
                                        </li>
                                        <li class="list-group-item student-details-sm">Time IN: &nbsp;&nbsp;&nbsp;<span
                                            class="ml-auto" id="">
                                            ${formatTime(attendance.created_at)}
                                            </li>
                                        </ul>
                            </div>
                    `;
                    attendanceList.appendChild(listItem);
                });
            })
            .catch(error => {
                console.error('Error fetching attendance data:', error);
            });
    }

    // Call the updateAttendanceList function initially and at intervals (e.g., every 10 seconds)
    updateAttendanceList();
    setInterval(updateAttendanceList, 10000); // Update every 10 seconds
</script>

<script>
    // Function to update the clock element with the current time
    function updateClock() {
        const clockElement = document.querySelector('.clock');
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        const currentTime = `${hours}:${minutes}:${seconds}`;
        clockElement.textContent = currentTime;
    }

    // Update the clock initially and every second thereafter
    updateClock();
    setInterval(updateClock, 1000);
</script>
        
</html>