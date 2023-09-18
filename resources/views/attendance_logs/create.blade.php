{{-- resources/views/attendance_logs/create.blade.php --}}

@extends('layouts.main', ['title' => 'Add Attendance Log'])

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <form action="{{ route('attendance-logs.store') }}" method="POST">
                @csrf

                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Add Manual Attendance</h4>
                            <button type="submit" id="btnsave" class="btn btn-light-main btn-round ml-auto">
                                <i class="fa fa-save"></i>
                                Add
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row p-3">
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-12 my-3">
                                        <span class="bg-light-main btn-block text-white">ATTENDANCE DETAILS</span>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group form-group-default">
                                            <label><span class="text-danger">*</span> Member</label>
                                            <select name="member_id" id="member_id" class="form-control" required>
                                                <option value="">Select Member</option>
                                                @foreach ($members as $member)
                                                    <option value="{{ $member->id }}">{{ $member->first_name }} {{ $member->last_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('member_id')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group form-group-default">
                                            <label><span class="text-danger">*</span> Schedule</label>
                                            <select name="schedule_id" id="schedule_id" class="form-control" required>
                                                <option value="">Select Schedule</option>
                                                @foreach ($schedules as $schedule)
                                                    <option value="{{ $schedule->id }}">{{ $schedule->date }}</option>
                                                @endforeach
                                            </select>
                                            @error('schedule_id')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group form-group-default">
                                            <label><span class="text-danger">*</span> Attended At</label>
                                            <input type="datetime-local" name="attended_at" id="attended_at" class="form-control"
                                                placeholder="Middle name" value="{{ old('attended_at') }}">
                                                @error('attended_at')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group form-group-default">
                                            <label>Notes</label>
                                            <input type="text" name="notes" id="notes" class="form-control" placeholder="Notes" value="{{ old('notes') }}">
                                                @error('notes')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
