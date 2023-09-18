@extends('layouts.main', ['title' => 'Settings'])

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <h1>Settings</h1>
            <div class="form-group">
                <label for="minConsecutiveAbsent">Minimum Consecutive Absent Days:</label>
                <input type="number" class="form-control" id="minConsecutiveAbsent" value="3" name="minConsecutiveAbsent"/>
                <button id="saveSettingsBtn" class="btn btn-primary mt-3">Save Settings</button>
            </div>
            <form action="{{route('admin.changePassword', Auth::user())}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="newPassword">New Password</label>
                    <input type="password" class="form-control" id="newPassword" name="newPassword"/>
                    <button id="changePasswordBtn" class="btn btn-primary mt-3" type="submit">Change Password</button>
                </div>
            </form>
            @if ($success)
                <div class="alert alert-success">{{ $success }}</div>
            @endif
        </div>
    </div>
</div>

<script>
    // Get the minimum consecutive absent days input and save button elements
    const minConsecutiveAbsentInput = document.getElementById('minConsecutiveAbsent');
    const saveSettingsBtn = document.getElementById('saveSettingsBtn');

    // Event listener for the Save Settings button
    saveSettingsBtn.addEventListener('click', function () {
        // Get the value from the input field
        const minConsecutiveAbsentValue = minConsecutiveAbsentInput.value;

        // Check if the value is valid (you can add more validation if needed)
        if (minConsecutiveAbsentValue !== '' && !isNaN(minConsecutiveAbsentValue)) {
            // Save the value to local storage
            localStorage.setItem('minConsecutiveAbsent', minConsecutiveAbsentValue);
            alert('Settings saved successfully.');
        } else {
            alert('Invalid input. Please enter a valid number.');
        }
    });
</script>

<script>
    // Load initial value from local storage
    const initialMinConsecutiveAbsent = localStorage.getItem('minConsecutiveAbsent');
    if (initialMinConsecutiveAbsent !== null) {
        minConsecutiveAbsentInput.value = initialMinConsecutiveAbsent;
    }
</script>

@endsection
