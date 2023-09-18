{{-- resources/views/attendance_logs/index.blade.php --}}

@extends('layouts.main', ['title' => 'Attendance Logs'])

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Attendance Logs</h4>
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
                        Attendance Logs
                    </li>
                </ul>
            </div>
            <div class="row row-card-no-pd">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <h4 class="card-title">List of Attendance Logs</h4>
                                <div class="btn-group ml-auto">
                                    <a href="{{ route('attendance-logs.create') }}">
                                    <button id="btnAdd" class="btn btn-warning">
                                        <i class="fa fa-plus"></i>
                                        Add Manual Log
                                    </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="jumbotron jumbotron-thin fbutton">
                                <form action="{{ route('attendance-logs.index') }}" method="GET">
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
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table id="attendance-logs" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Member</th>
                                            <th>Time In</th>
                                            <th>Schedule</th>
                                            <th>Logged By</th>
                                            <th>Method</th>
                                            <th>Notes</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($attendanceLogs as $attendanceLog)
                                            <tr>
                                                <td>{{ $attendanceLog->member->first_name . ' ' . $attendanceLog->member->last_name }}</td>
                                                <td>{{ $attendanceLog->attended_at }}</td>
                                                <td>
                                                    <a href="{{route('schedules.show', $attendanceLog->schedule->id)}}">
                                                        {{ $attendanceLog->schedule->date }}
                                                    </a>
                                                </td>
                                                <td>{{ $attendanceLog->user->username }}</td>
                                                <td>{{ $attendanceLog->method }}</td>
                                                <td>{{ $attendanceLog->notes }}</td>
                                                <td>
                                                    <a href="{{ route('attendance-logs.edit', $attendanceLog->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                                    <form action="{{ route('attendance-logs.destroy', $attendanceLog->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this attendance log?')"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                </td>
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
    <script>
        $(document).ready(function() {
            $('#attendance-logs').DataTable({
                "order": [[1, "desc"]]
            });
        });
    </script>

    <script>
        function printTable() {
            var attendance_logs = $('#attendance-logs').DataTable();
            attendance_logs.page.len(-1).draw();

            // Open a new window for printing
            const printWindow = window.open('', '_blank');

            // Generate the content to print
            const table = document.querySelector('.table');
            const tableContent = table.cloneNode(true); // Clone the table with its content

            // Loop through each row and remove the last cell (last column) except for the header row
            const rows = tableContent.getElementsByTagName('tr');
            for (let i = 0; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName('td');
                if (cells.length > 0) {
                    rows[i].removeChild(cells[cells.length - 1]); // Remove the last cell (last column)
                }
            }

            // Set the content in the new window
            printWindow.document.write('<html><head><title>Schedules List</title>');
            printWindow.document.write('<link rel="stylesheet" href="{{asset('css/app.css')}}" type="text/css">');
            printWindow.document.write('</head><body>');
            printWindow.document.write(tableContent.outerHTML); // Use the modified table content
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
