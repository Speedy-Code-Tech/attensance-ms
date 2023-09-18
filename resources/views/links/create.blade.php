@extends('layouts.main', ['title' => 'Add Link'])

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <form action="{{ route('links.store') }}" method="POST">
                @csrf

                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Add Link</h4>
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
                                        <span class="bg-light-main btn-block text-white">LINK DETAILS</span>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group form-group-default">
                                            <label><span class="text-danger">*</span> Name</label>
                                            <input type="text" name="title" id="title" class="form-control"
                                                placeholder="ex. Cash Distribution" value="{{ old('title') }}" required>
                                                @error('title')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group form-group-default">
                                            <label><span class="text-danger">*</span> URL</label>
                                            <input type="text" name="url" id="url" class="form-control"
                                                placeholder="" value="{{ old('url') }}" required>
                                                @error('url')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group form-group-default">
                                            <label><span class="text-danger">*</span> Category</label>
                                            <select name="category" class="form-control">
                                                <option value="">Select Category</option>
                                                <option value="financial" {{ old('category') === 'financial' ? 'selected' : '' }}>Financial</option>
                                            </select>
                                            @error('category')
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
