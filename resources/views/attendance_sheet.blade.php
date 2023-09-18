@extends('layouts.main', ['title' => 'Attendance Sheet'])

@section('content')
    <link href="{{ asset('css/consecutive-absences.css') }}" rel="stylesheet">

    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <h4 class="page-title">Attendance Sheet</h4>
                    <ul class="breadcrumbs">
                        <li class="nav-home">
                            <a href="{{ route('home')}}">
                                <i class="flaticon-home"></i>
                            </a>
                        </li>
                        <li class="separator">
                            <i class="flaticon-right-arrow"></i>
                        </li>
                        <li class="nav-item">
                            Attendance Sheet
                        </li>
                    </ul>
                </div>
                <div class="row row-card-no-pd">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-head-row">
                                    <h4 class="card-title">Overview</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="jumbotron jumbotron-thin fbutton">
                                    <form action="{{ route('attendance.sheet') }}" method="GET">
                                        <div class="row filter-less-mb">
                                            <div class="col-md-5">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group form-group-default">
                                                            <label>From</label>
                                                            <input type="date" name="start_date" class="form-control"
                                                                value="{{ request('start_date') ? request('start_date') : date('Y-m-d') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-group-default">
                                                            <label>To</label>
                                                            <input type="date" name="end_date" class="form-control"
                                                                value="{{ request('end_date') ? request('end_date') : date('Y-m-d') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="btn-group">
                                                    <button type="submit" class="btn btn-primary btn-lg fbutton">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                    <button type="button" onclick="printTable()" class="btn btn-warning btn-lg fbutton">
                                                        <i class="fa fa-print"></i>
                                                    </button>
                                                    <a href="{{ route('attendance.export', ['start_date' => $selectedStartDate, 'end_date' => $selectedEndDate]) }}" class="">
                                                        <button type="button" class="btn btn-success btn-lg fbutton">
                                                            <i class="fa fa-file-excel"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="table-responsive">
                                    <table id="attendance-sheet" class="table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                @foreach ($nonMakeupSchedules as $schedule)
                                                    <th>{{ $schedule->date }}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($members as $member)
                                                <tr>
                                                    <td>{{ $member->first_name }} {{ $member->last_name }}</td>
                                                    @foreach ($nonMakeupSchedules as $schedule)
                                                        <td>
                                                            @if ($attendanceData[$member->id]['non_makeup'][$schedule->id] === 'Present')
                                                                <span class="text-success">&#10004;</span> {{-- Green check mark --}}
                                                            @elseif ($attendanceData[$member->id]['non_makeup'][$schedule->id] === 'Absent')
                                                                <span class="text-danger">&#10008;</span> {{-- Red cross mark --}}
                                                            @elseif ($attendanceData[$member->id]['non_makeup'][$schedule->id] === 'Makeup')
                                                                <span class="text-warning">&#10004;</span> {{-- Orange check mark --}}
                                                            @endif
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row row-card-no-pd">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-head-row">
                                    <h4 class="card-title">Makeup Schedules</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="makeup-attendance-sheet" class="table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                @foreach ($makeupSchedules as $schedule)
                                                    <th>{{ $schedule->date }}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($members as $member)
                                                <tr>
                                                    <td>{{ $member->first_name }} {{ $member->last_name }}</td>
                                                    @foreach ($makeupSchedules as $schedule)
                                                        <td>
                                                            @if ($attendanceData[$member->id]['makeup'][$schedule->id] === 'Present')
                                                                <span class="text-success">&#10004;</span> {{-- Green check mark --}}
                                                            @elseif ($attendanceData[$member->id]['makeup'][$schedule->id] === 'Absent')
                                                                <span class="text-danger">&#10008;</span> {{-- Red cross mark --}}
                                                            @elseif ($attendanceData[$member->id]['makeup'][$schedule->id] === 'Makeup')
                                                                <span class="text-warning">&#10004;</span> {{-- Orange check mark --}}
                                                            @endif
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row row-card-no-pd">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-head-row">
                                    <h4 class="card-title">Summary</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="summary" class="table">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Attended</th>
                                                <th>Absent</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($nonMakeupSchedules as $schedule)
                                                <tr>
                                                    <td>{{ date('m-d-Y', strtotime($schedule->date)) }}</td>
                                                    <td>{{ $schedule->attendances()->count() }}</td>
                                                    <td>{{ $members->count() - $schedule->attendances()->count() }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                    </div>
                </div>
            </div>
        </div>
    <script>
        $(document).ready(function() {
            $('#attendance-sheet').DataTable();
            $('#makeup-attendance-sheet').DataTable();
        });
    </script>
    <script>
        // Function to highlight consecutive absences
        function highlightConsecutiveAbsences() {
        const tableRows = document.querySelectorAll('table#attendance-sheet tbody tr');

        let minConsecutiveAbsent = 3;

        // Load initial value from local storage
        const initialMinConsecutiveAbsent = localStorage.getItem('minConsecutiveAbsent');
        if (initialMinConsecutiveAbsent !== null) {
            minConsecutiveAbsent = parseInt(initialMinConsecutiveAbsent);
        }

        tableRows.forEach(row => row.classList.remove('consecutive-absent'));

        for (let i = 0; i < tableRows.length; i++) {
            const cells = tableRows[i].querySelectorAll('td');
            let currentAbsentCount = 0;
            let longestStreak = 0;
            let currentStreakStart = -1;
            let longestStreakStart = -1;

            for (let j = 1; j < cells.length; j++) {
                const attendedCell = cells[j].textContent.trim();

                // Check if the cell contains a checkmark, crossmark, or makeup checkmark
                const isAbsent = attendedCell === '✘';

                if (isAbsent) {
                    currentAbsentCount++;
                    if (currentAbsentCount >= minConsecutiveAbsent && currentStreakStart === -1) {
                        currentStreakStart = j - minConsecutiveAbsent;
                    }
                    // Update the longest streak if the current streak is longer
                    if (currentAbsentCount > longestStreak) {
                        longestStreak = currentAbsentCount;
                        longestStreakStart = currentStreakStart;
                    }
                } else {
                    currentAbsentCount = 0;
                    currentStreakStart = -1;
                }

                if (currentAbsentCount >= minConsecutiveAbsent) {
                    // Apply the class `consecutive-absent` to the cells corresponding to the streak
                    for (let k = 0; k < minConsecutiveAbsent; k++) {
                        cells[j - k].classList.add('consecutive-absent');
                    }
                }
            }

            // Apply the class `consecutive-absent` to the cells corresponding to the longest streak
            if (longestStreak >= minConsecutiveAbsent) {
                for (let k = 1; k < longestStreak; k++) {
                    cells[longestStreakStart + k].classList.add('consecutive-absent');
                }
            }
        }
    }

        // Call the function when the page is ready
        document.addEventListener('DOMContentLoaded', () => {
            highlightConsecutiveAbsences();
        });

    </script>
    
    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        $('#date_filter').click(function() {
            applyDateRangeFilter();
        });
        function applyDateRangeFilter() {
            const startDate = document.getElementById('startDateFilter').value;
            const endDate = document.getElementById('endDateFilter').value;
            window.location.href = '{{ route("attendance.sheet") }}?start_date=' + startDate + '&end_date=' + endDate;
        }
    </script>

    <script>
        function printTable() {
            var attendance_table = $('#attendance-sheet').DataTable();
            attendance_table.page.len(-1).draw();
            var attendance_table2 = $('#makeup-attendance-sheet').DataTable();
            attendance_table2.page.len(-1).draw();

            // Open a new window for printing
            const printWindow = window.open('', '_blank');

            // Generate the content to print
            const table = document.querySelector('#attendance-sheet');
            const tableContent = table.cloneNode(true); // Clone the table with its content
            
            const table2 = document.querySelector('#makeup-attendance-sheet');
            const table2Content = table2.cloneNode(true); // Clone the table with its content
            
            const table3 = document.querySelector('#summary');
            const table3Content = table3.cloneNode(true); // Clone the table with its content


            // Set the content in the new window after CSS files have loaded
            printWindow.document.write('<html><head><title>Attendance Sheet</title>');
            printWindow.document.write('<link rel="stylesheet" href="{{asset('css/app.css')}}" type="text/css">');
            printWindow.document.write('<link rel="stylesheet" href="{{asset('css/consecutive-absences.css')}}" type="text/css">');
            printWindow.document.write('</head><body>');
            printWindow.document.write('<h1>Attendance</h1>');
            printWindow.document.write(tableContent.outerHTML); // Use the modified table content
            printWindow.document.write('<hr class="hr" />');
            printWindow.document.write('<h2>Makeup</h2>');
            printWindow.document.write(table2Content.outerHTML); // Use the modified table content
            printWindow.document.write('<hr class="hr" />');
            printWindow.document.write('<h2>Summary</h2>');
            printWindow.document.write(table3Content.outerHTML); // Use the modified table content
            printWindow.document.write('</body></html>');

            setTimeout(() => {
                // Print the new window
                printWindow.print();

                // Close the new window after printing
                printWindow.close();
            }, 2000); // Adjust the delay as needed (1 second delay in this example)
        }
    </script>
@endsection
