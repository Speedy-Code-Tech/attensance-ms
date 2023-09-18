<!-- resources/views/magazines/show.blade.php -->

@extends('layouts.main', ['title' => $magazine->title])

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">{{ $magazine->title }}</h4>
                        <a href="{{ route('magazines.edit', $magazine->id) }}" class="btn btn-light-main btn-round ml-auto"><i class='fa fa-edit'></i></a>
                        <form action="{{ route('magazines.destroy', $magazine->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-round ml-auto" onclick="return confirm('Are you sure you want to delete this magazine?')"><i class='fa fa-trash'></i></button>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row p-3">
                        <div class="col-md-3">
                            <div class="col-md-12 mb-3">
                                <div id="dp_uploaded">
                                    <img id="profilePicturePreview" src="{{ $magazine->thumbnail_path ? asset('storage/' . $magazine->thumbnail_path) : asset('images/create_hope.jpg') }}" class="img-thumbnail w-100 profilepic" alt="Magazine Thumbnail">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-12 my-3">
                                    <span class="bg-light-main btn-block text-white">MAGAZINE DETAILS</span>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-group-default">
                                        <label><span class="text-danger">*</span> Title</label>
                                        <input type="text" name="title" id="title" class="form-control"
                                            placeholder="ex. Abot Tanaw Issue #01" value="{{ $magazine->title }}" disabled>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-group-default">
                                        <label><span class="text-danger">*</span> Issue Date</label>
                                        <input type="date" name="issue" id="issue" class="form-control"
                                            placeholder="Middle name" value="{{ $magazine->issue }}" disabled>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-group-default">
                                        <label><span class="text-danger">*</span> PDF File</label>
                                        <a href="{{ asset('storage/' . $magazine->pdf_path) }}" target="_blank">View PDF</a>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group form-group-default">
                                        <label> Description</label>
                                        <textarea disabled name="description" id="description" class="form-control" rows='3'
                                            placeholder="Write what the magazine is all about..." value="{{ $magazine->description }}">
                                        </textarea>
                                    </div>
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
