@extends('layouts.main', ['title' => 'Edit Schedule'])

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <form action="{{ route('schedules.update', $schedule->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Edit Schedule</h4>
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
                                        <span class="bg-light-main btn-block text-white">SCHEDULE DETAILS</span>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group form-group-default">
                                            <label> Name</label>
                                            <input type="text" name="name" id="name" class="form-control"
                                                placeholder="ex. Rotary Weekly Meeting #01" value="{{ old('name', $schedule->name) }}" required>
                                                @error('name')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group form-group-default">
                                            <label><span class="text-danger">*</span> Date</label>
                                            <input type="date" name="date" id="date" class="form-control"
                                                placeholder="" value="{{ old('date', $schedule->date) }}" required>
                                                @error('date')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group form-group-default">
                                            <label> Is Makeup</label>  
                                            <select name="is_makeup" class="form-control">
                                                <option value="0" {{ old('is_makeup', $schedule->is_makeup) == '0' ? 'selected' : '' }}>No</option>
                                                <option value="1" {{ old('is_makeup', $schedule->is_makeup) == '1' ? 'selected' : '' }}>Yes</option>
                                            </select>                         
                                                @error('is_makeup')
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
