<div class="main-panel">
    <div class="content">
        <div class="page-inner">
    @if ($successMessage)
        <div class="alert alert-success">{{ $successMessage }}</div>
    @endif
    <form action="{{ $formAction }}" method="POST" enctype="multipart/form-data" onsubmit="setProfilePictureValue()">
        @csrf
        @method('PUT')

        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">{{ $cardTitle }}</h4>
                    <button type="submit" id="btnsave" class="btn btn-light-main btn-round ml-auto">
                        <i class="fa fa-save"></i>
                        Update
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row p-3">
                    <div class="col-md-3">
                        <div class="col-md-12 mb-3">
                            <div id="dp_uploaded">
                                <img id="profilePicturePreview" src="{{ $member->profile_picture ? asset('storage/' . $member->profile_picture) : asset('images/create_hope.jpg') }}" class="img-thumbnail w-100 profilepic" alt="Profile Picture">
                            </div>
                            <div id="uploading" style="display: none;">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                            <button type="button" class="btn btn-light-main btn-sm btn-block" style="display:block;height:30px;" onclick="document.getElementById('upload_dp').click()">UPLOAD PICTURE</button>
                            <input type='file' name="profile_picture" id="upload_dp" style="display:none">
                            <input type="hidden" id="dp" value="">
                            <div class="col-md-12 mt-1 p-none">
                                <small><b>Note:</b> png, jpg</small>
                            </div>
                            @error('profile_picture')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-12 my-3">
                                <span class="bg-light-main btn-block text-white">BASIC DETAILS</span>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group form-group-default">
                                    <label><span class="text-danger">*</span> First Name</label>
                                    <input type="text" name="first_name" id="first_name" class="form-control"
                                        placeholder="First name" value="{{ old('first_name', $member->first_name) }}" required>
                                        @error('first_name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group form-group-default">
                                    <label> Middle Initial</label>
                                    <input type="text" name="middle_initial" id="middle_initial" class="form-control"
                                        placeholder="Middle name" value="{{ old('middle_initial', $member->middle_initial) }}">
                                        @error('middle_initial')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group form-group-default">
                                    <label><span class="text-danger">*</span> Last Name</label>
                                    <input type="text" name="last_name" id="last_name" class="form-control"
                                        placeholder="Last name" value="{{ old('last_name', $member->last_name) }}" required>
                                        @error('last_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group form-group-default">
                                    <label> Birthday</label>
                                    <input type="date" name="birthday" id="birthday" class="form-control"
                                        placeholder="Birthday" value="{{ old('birthday', $member->birthday) }}">
                                        @error('birthday')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group form-group-default">
                                    <label> Gender</label>
                                    <select name="gender" class="form-control">
                                        <option value="">Select Gender</option>
                                        <option value="male" {{ old('gender', $member->gender) === 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ old('gender', $member->gender) === 'female' ? 'selected' : '' }}>Female</option>
                                        <option value="other" {{ old('gender', $member->gender) === 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('gender')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group form-group-default">
                                    <label> Mobile Number</label>
                                    <input type="text" name="mobile_number" id="mobile_number" class="form-control"
                                        placeholder="09xxxxxxxxx" value="{{ old('mobile_number', $member->mobile_number) }}">
                                        @error('mobile_number')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group form-group-default">
                                    <label><span class="text-danger">*</span> Email</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        placeholder="john@example.com" value="{{ old('email', $member->user->email) }}" required>
                                        @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group form-group-default">
                                    <label> Address</label>
                                    <input type="text" name="address" id="address" class="form-control"
                                        placeholder="221B Baker St." value="{{ old('address', $member->address) }}">
                                        @error('address')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 my-3">
                                <span class="bg-light-main btn-block text-white">MEMBER DETAILS</span>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group form-group-default">
                                    <label><span class="text-danger">*</span> Member ID</label>
                                    <input type="text" name="rotary_id" id="rotary_id" class="form-control"
                                    value="{{ old('rotary_id', $member->rotary_id) }}">
                                    @error('rotary_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group form-group-default">
                                    <label> Joined At</label>
                                    <input type="date" name="member_at" id="member_at" class="form-control"
                                        placeholder="Joined At" value="{{ old('member_at', $member->member_at) }}">
                                        @error('member_at')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                            </div>
                            @if (auth()->user()->isAdmin())
                            <div class="col-sm-4">
                                <div class="form-group form-group-default">
                                    <label><span class="text-danger">*</span> Role</label>
                                    <select name="role" class="form-control">
                                        <option value="">Select Role</option>
                                        <option value="admin" {{ old('role', $member->user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="staff" {{ old('role', $member->user->role) === 'staff' ? 'selected' : '' }}>Staff</option>
                                        <option value="member" {{ old('role', $member->user->role) === 'member' ? 'selected' : '' }}>Member</option>
                                    </select>
                                    @error('role')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            @endif
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12 my-3">
                                <span class="bg-light-main btn-block text-white">LOGIN CREDENTIALS</span>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                    <label>Username</label>
                                    @if (auth()->user()->isAdmin())
                                        <input type="text" name="username" value="{{ old('username', $member->user->username) }}" class="form-control">
                                    @elseif (auth()->user()->isMember())
                                        <input type="text" name="username" class="form-control" value="{{ old('username', $member->user->username) }}" disabled>
                                    @endif
                                        
                                        @error('username')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                    <label>Password</label>
                                    <input type="password" name="password" value="{{ old('password', null) }}" class="form-control">
            
                                    @error('password')
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
            formData.append('profile_picture', input.files[0]);

            // Show loading spinner while uploading
            uploading.style.display = 'block';
            profilePicturePreview.style.display = 'none';

            // Make an AJAX request to upload the file
            axios.post('/upload-profile-picture', formData)
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
            profilePicturePreview.src = "{{ $member->profile_picture ? asset('storage/' . $member->profile_picture) : asset('images/create_hope.jpg') }}";
            document.getElementById('dp').value = "{{ $member->profile_picture ?: '' }}";
        }
    }

    // Call the function when the file input field changes
    document.getElementById('upload_dp').addEventListener('change', function () {
        updateProfilePicturePreview(this);
    });
</script>

<script>
    function setProfilePictureValue() {
        const input = document.getElementById('upload_dp');
        const hiddenInput = document.getElementById('dp');

        // Check if a file has been selected
        if (input.files && input.files[0]) {
            const reader = new FileReader();

            // Set the value of the hidden input to the file content
            reader.onload = function (e) {
                hiddenInput.value = e.target.result;
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

{{-- <script>
    // Function to update the profile picture preview
    function updateProfilePicturePreview(input) {
        const previewContainer = document.getElementById('profilePictureContainer');
        const previewImage = document.getElementById('profilePicturePreview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                previewImage.setAttribute('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        } else {
            // If no file is selected, show the default message
            previewImage.setAttribute('src', '');
        }
    }

    // Call the function when the file input field changes
    document.getElementById('profile_picture').addEventListener('change', function () {
        updateProfilePicturePreview(this);
    });
</script> --}}
