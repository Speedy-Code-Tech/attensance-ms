{{-- resources/views/attendance_logs/edit.blade.php --}}

@extends('layouts.main', ['title' => 'Edit Attendance Log'])

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
        <form action="{{ route('attendance-logs.update', $attendance->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Edit Attendance</h4>
                            <button type="submit" id="btnsave" class="btn btn-light-main btn-round ml-auto">
                                <i class="fa fa-save"></i>
                                Update
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
                                                    <option value="{{ $member->id }}" {{ old('member_id', $attendance->member_id) === $member->id ? 'selected' : '' }}>{{ $member->first_name }} {{ $member->last_name }}</option>
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
                                                    <option value="{{ $schedule->id }}" {{ old('schedule_id', $attendance->schedule_id) === $schedule->id ? 'selected' : '' }}>{{ $schedule->date }}</option>
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
                                                placeholder="Middle name" value="{{ old('attended_at', $attendance->attended_at) }}" disabled>
                                                @error('attended_at')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group form-group-default">
                                            <label>Notes</label>
                                            <input type="text" name="notes" id="notes" class="form-control" placeholder="Notes" value="{{ old('notes', $attendance->notes) }}">
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
