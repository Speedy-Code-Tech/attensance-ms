@extends('layouts.main', ['title' => 'Schedules'])

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Schedules</h4>
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
                        Schedules
                    </li>
                </ul>
            </div>
            <div class="row row-card-no-pd">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <h4 class="card-title">List of Schedules</h4>
                                <div class="btn-group ml-auto">
                                    <a href="{{ route('schedules.create') }}">
                                    <button id="btnAdd" class="btn btn-warning">
                                        <i class="fa fa-plus"></i>
                                        Add
                                    </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="jumbotron jumbotron-thin fbutton">
                                <form action="{{ route('schedules.index') }}" method="GET">
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
                                <table id="schedulesTable" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Name</th>
                                            <th>Is Makeup</th>
                                            <th>Attendees</th>
                                            <th>Absents</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($schedules as $schedule)
                                            <tr>
                                                <td>{{ $schedule->date }}</td>
                                                <td>{{ $schedule->name }}</td>
                                                <td>{{ $schedule->is_makeup ? 'Yes' : 'No' }}</td>
                                                <td>{{ $schedule->attendances()->count() }}</td>
                                                <td>{{ $members->count() - $schedule->attendances()->count() }}</td>
                                                <td>
                                                    <a href="{{ route('schedules.show', $schedule->id) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                                    <a href="{{ route('schedules.edit', $schedule->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                                    <form action="{{ route('schedules.destroy', $schedule->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this schedule?')"><i class="fa fa-trash"></i></button>
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
            $('#schedulesTable').DataTable();
        });
    </script>
    
    <script>
        function printTable() {
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

            // Print the new window
            printWindow.print();

            // Close the new window after printing
            printWindow.close();
        }
    </script>
@endsection
