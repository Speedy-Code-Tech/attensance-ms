@extends('layouts.main', ['title' => 'Home'])

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @auth
                        @if (Auth::user()->isAdmin())
                            <h3>Hello Admin, Welcome to the Dashboard!</h3>
                            <p>Here are some insights about the attendance system:</p>
                            <ul>
                                <li>Total number of members: {{ $totalMembers }}</li>
                                <li>Total number of schedules: {{ $totalSchedules }}</li>
                                <li>Total number of attendances logged: {{ $totalAttendances }}</li>
                            </ul>
                        @elseif (Auth::user()->isStaff())
                            <h3>Hello Staff, Welcome to the Dashboard!</h3>
                            <p>Here are some insights about the attendance system:</p>
                            <ul>
                                <li>Total number of members: {{ $totalMembers }}</li>
                                <li>Total number of schedules: {{ $totalSchedules }}</li>
                                <li>Total number of attendances logged: {{ $totalAttendances }}</li>
                                <li>Total number of makeup schedules: {{ $totalMakeupSchedules }}</li>
                            </ul>
                        @else
                            <h3>Hello {{ Auth::user()->username }}, Welcome to the Dashboard!</h3>
                            <p>Here are some insights about your attendance:</p>
                            <ul>
                                <li>Total number of meetings: {{ $totalSchedules }}</li>
                                <li>Number of days attended: {{ $daysAttended }}</li>
                                <li>Number of days absent: {{ $daysAbsent }}</li>
                            </ul>
                        @endif
                    @endauth

                    @guest
                        <p>{{ __('You are not logged in!') }}</p>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="main-panel">
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Dashboard</h2>
                        <h5 class="text-white op-7 mb-2">Blessed Day, {{ Auth::user()->role }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            <div class="row mt--2">
                    <div class="col-xs-12 col-md-12">
                    <div class="card full-height">
                        <div class="card-body">
                            <div class="card-title">Summary & Statistics</div>
                            
                            <div class="d-flex flex-wrap justify-content-around pt-4">

                                <div class="col-xs-12 col-md-4">
                                    <div class="card card-stats card-round">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-5">
                                                    <div class="icon-big text-center">
                                                        <i class="fas fas fa-users text-danger"></i>
                                                    </div>
                                                </div>
                                                <div class="col-7 col-stats">
                                                    <div class="numbers">
                                                        <p class="card-category">MEMBERS</p>
                                                        <h4 class="card-title">{{ $totalMembers }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-md-4">
                                    <div class="card card-stats card-round">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-5">
                                                    <div class="icon-big text-center">
                                                        <i class="fas fas fa-calendar-alt text-danger"></i>
                                                    </div>
                                                </div>
                                                <div class="col-7 col-stats">
                                                    <div class="numbers">
                                                        <p class="card-category">SCHEDULES</p>
                                                        <h4 class="card-title">{{ $totalSchedules }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-md-4">
                                    <div class="card card-stats card-round">
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-5">
                                                    <div class="icon-big text-center">
                                                        <i class="fas fas fa-clock text-danger"></i>
                                                    </div>
                                                </div>
                                                <div class="col-7 col-stats">
                                                    <div class="numbers">
                                                        <p class="card-category">ATTENDANCES LOGGED</p>
                                                        <h4 class="card-title">
                                                            {{ $totalAttendances }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if ($todaySchedule)    
                                <div class="col-xs-12 col-md-4">
                                    <div class="card card-stats card-round">
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-5">
                                                    <div class="icon-big text-center">
                                                        <i class="fas fas fa-user-tie text-danger"></i>
                                                    </div>
                                                </div>
                                                <div class="col-7 col-stats">
                                                    <div class="numbers">
                                                        <p class="card-category">PRESENT (Today)</p>
                                                        <h4 class="card-title">
                                                            {{ $todayAttendance }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xs-12 col-md-4">
                                    <div class="card card-stats card-round">
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-5">
                                                    <div class="icon-big text-center">
                                                        <i class="fas fas fa-user-tie text-danger"></i>
                                                    </div>
                                                </div>
                                                <div class="col-7 col-stats">
                                                    <div class="numbers">
                                                        <p class="card-category">ABSENT (Today)</p>
                                                        <h4 class="card-title">
                                                            {{ $todayAbsent }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
                <!-- ANALYTICS -->
                
                <!-- Display bar chart for attendance data -->
                <h2>Attendance Status by Schedule</h2>
                <canvas id="attendanceChart" width="400" height="100"></canvas>
            
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/plugin/chart.js/chart.min.js') }}"></script>
{{-- <?php echo $scheduleData ?> --}}


<script>
    // Bar chart data
    var ctx = document.getElementById('attendanceChart').getContext('2d');
    var labels = @json($scheduleLabels); // An array of schedule labels
    var data = @json($scheduleData); // An array of attendance data corresponding to each schedule

    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Attended',
                data: data.attended,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }, {
                label: 'Absent',
                data: data.absent,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

@endsection
l