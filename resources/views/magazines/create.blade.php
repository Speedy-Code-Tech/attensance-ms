@extends('layouts.main', ['title' => 'Add Magazine'])

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <form action="{{ route('magazines.store') }}" method="POST" enctype="multipart/form-data" onsubmit="setProfilePictureValue()">
                @csrf

                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Create New Magazine</h4>
                            <button type="submit" id="btnsave" class="btn btn-light-main btn-round ml-auto">
                                <i class="fa fa-save"></i>
                                Create
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row p-3">
                            <div class="col-md-3">
                                <div class="col-md-12 mb-3">
                                    <div id="dp_uploaded">
                                        <img id="profilePicturePreview" src="{{ asset('images/create_hope.jpg') }}" class="img-thumbnail w-100 profilepic" alt="Magazine Thumbnail">
                                    </div>
                                    <div id="uploading" style="display: none;">
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-light-main btn-sm btn-block" style="display:block;height:30px;" onclick="document.getElementById('upload_dp').click()">UPLOAD PICTURE</button>
                                    <input type='file' name="thumbnail" id="upload_dp" style="display:none">
                                    <input type="hidden" id="dp" value="">
                                    <div class="col-md-12 mt-1 p-none">
                                        <small><b>Note:</b> png, jpg</small>
                                    </div>
                                    @error('thumbnail')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
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
                                                placeholder="ex. Abot Tanaw Issue #01" value="{{ old('title') }}" required>
                                                @error('title')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group form-group-default">
                                            <label><span class="text-danger">*</span> Issue Date</label>
                                            <input type="date" name="issue" id="issue" class="form-control"
                                                placeholder="Middle name" value="{{ old('issue') }}">
                                                @error('issue')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group form-group-default">
                                            <label><span class="text-danger">*</span> PDF File</label>
                                            <input type="file" name="pdf" id="pdf" class="form-control"
                                                placeholder="Last name" value="{{ old('pdf') }}" required>
                                                @error('pdf')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group form-group-default">
                                            <label> Description</label>
                                            <textarea name="description" id="description" class="form-control" rows='3'
                                                placeholder="Write what the magazine is all about..." value="{{ old('description') }}">
                                            </textarea>
                                                @error('description')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
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

<script>
    // Function to update the profile picture preview
    function updateProfilePicturePreview(input) {
        const previewContainer = document.getElementById('dp_uploaded');
        const profilePicturePreview = document.getElementById('profilePicturePreview');
        const uploading = document.getElementById('uploading');

        if (input.files && input.files[0]) {
            const formData = new FormData();
            formData.append('thumbnail', input.files[0]);

            // Show loading spinner while uploading
            uploading.style.display = 'block';
            profilePicturePreview.style.display = 'none';

            // Make an AJAX request to upload the file
            axios.post('/upload-thumbnail-picture', formData)
                .then(response => {
                    // Update the profile picture preview with the uploaded image
                    profilePicturePreview.src = response.data.url;
                    document.getElementById('dp').value = response.data.path;

                    // Hide loading spinner and show the profile picture
                    uploading.style.display = 'none';
                    profilePicturePreview.style.display = 'block';
                })
                .catch(error => {
                    // Handle the error
                    console.error(error);

                    // Hide loading spinner and show the default profile picture
                    uploading.style.display = 'none';
                    profilePicturePreview.style.display = 'block';
                });
        } else {
            // If no file is selected, show the default profile picture
            profilePicturePreview.src = "{{ asset('images/create_hope.jpg') }}";
            document.getElementById('dp').value = "{{ '' }}";
        }
    }

    // Call the function when the file input field changes
    document.getElementById('upload_dp').addEventListener('change', function () {
        updateProfilePicturePreview(this);
    });
</script>
@endsection
