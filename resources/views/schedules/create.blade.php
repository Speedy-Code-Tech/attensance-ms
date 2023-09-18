@extends('layouts.main', ['title' => 'Add Schedule'])

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <form action="{{ route('schedules.store') }}" method="POST">
                @csrf

                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Add Schedule</h4>
                            <button type="submit" id="btnsave" class="btn btn-light-main btn-round ml-auto">
                                <i class="fa fa-save"></i>
                                Create
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
                                                placeholder="ex. Rotary Weekly Meeting #01" value="{{ old('name') }}" required>
                                                @error('name')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group form-group-default">
                                            <label><span class="text-danger">*</span> Date</label>
                                            <input type="date" name="date" id="date" class="form-control"
                                                placeholder="First name" value="{{ old('date') }}" required>
                                                @error('date')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group form-group-default">
                                            <label> Is Makeup</label>
                                            <input type="checkbox" name="is_makeup" id="is_makeup" class="form-control"
                                                placeholder="Middle name" value="{{ old('is_makeup', 1) }}">
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
