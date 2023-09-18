@extends('layouts.main', ['title' => $schedule->date])

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">{{ $schedule->name }} | {{ $schedule->date }} {{ $schedule->is_makeup ? '(Makeup Schedule)' : null }}</h4>
                        <a href="{{ route('schedules.edit', $schedule->id) }}" class="btn btn-light-main btn-round ml-auto"><i class='fa fa-edit'></i></a>
                        <form action="{{ route('schedules.destroy', $schedule->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-round ml-auto" onclick="return confirm('Are you sure you want to delete this schedule?')"><i class='fa fa-trash'></i></button>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row p-3">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                @if ($attendanceLogs->count() > 0)
                                    <table id="attendance-logs" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Member</th>
                                                <th>Attended At</th>
                                                <th>Logged By</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($attendanceLogs as $attendanceLog)
                                                <tr>
                                                    <td>{{ $attendanceLog->member->first_name }} {{ $attendanceLog->member->last_name }}</td>
                                                    <td>{{ $attendanceLog->attended_at }}</td>
                                                    <td>{{ $attendanceLog->user->username }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <p>No attendance logs found for this schedule.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#attendance-logs').DataTable();
        });
    </script>
@endsection
