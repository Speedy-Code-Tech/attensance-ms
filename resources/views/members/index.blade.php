{{-- resources/views/members/index.blade.php --}}

@extends('layouts.main', ['title' => $pageTitle])

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">{{$pageTitle}}</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="{{ route('home')}}">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        System Users
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        {{$pageTitle}}
                    </li>
                </ul>
            </div>
            <div class="row row-card-no-pd">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <h4 class="card-title">List of {{$pageTitle}}</h4>
                                <div class="btn-group ml-auto">
                                    <button id="btnPrint" onclick="printTable()" class="btn btn-secondary">
                                        <i class="fa fa-print"></i>
                                        Print
                                    </button>
                                    <a href="{{ route('members.create') }}">
                                        <button id="btnAdd" class="btn btn-warning">
                                            <i class="fa fa-plus"></i>
                                            Add
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="membersTable" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>QR</th>
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th>Birthday</th>
                                            <th>Joined</th>
                                            <th>Total Years</th>
                                            <th>Rule Of 85</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($members as $member)
                                            <tr>
                                                <td>{{ $member->rotary_id }}</td>
                                                <td>{!! QrCode::size(100)->generate($member->id) !!}</td>
                                                <td>{{ $member->first_name }} {{ $member->last_name }}</td>
                                                <td>
                                                @if ($member->user)
                                                    {{ $member->user->username }}
                                                @else
                                                    N/A
                                                @endif
                                                </td>
                                                <td>{{ $member->birthday }} <span class="text-primary">{{ $member->birthday ? "(". $member->age .")" : null }}</span></td>
                                                <td>{{ $member->member_at }} <span class="text-primary">{{ $member->member_at ? "(". $member->joined_age .")" : null }}</span></td>
                                                <td>{{ $member->joined_age + $member->age }}</td>
                                                <td>{{ $member->isRuleOfEightyFive ? 'Yes' : 'No' }}</td>
                                                <td>
                                                    @if ($member->trashed())
                                                        <form action="{{ route('members.restore', $member->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-success" onclick="return confirm('Are you sure you want to restore this member?')">
                                                                <i class="fa fa-undo"></i> Restore
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('members.delete-permanently', $member->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to permanently delete this member?')">
                                                                <i class="fa fa-trash"></i> Permanently Delete
                                                            </button>
                                                        </form>
                                                    @else
                                                        <a href="{{ route('members.edit', $member->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                                        <form action="{{ route('members.destroy', $member->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this member?')">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </td>
                                                
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <script>
        $(document).ready(function() {
            $('#membersTable').DataTable();
        });
    </script>
    
    <script>
        function printTable() {
            var members_table = $('#membersTable').DataTable();
            members_table.page.len(-1).draw();

            // Open a new window for printing
            const printWindow = window.open('', '_blank');

            // Generate the content to print
            const table = document.querySelector('.table');
            const tableContent = table.cloneNode(true); // Clone the table with its content

            // Loop through each row and remove the last cell (last column) except for the header row
            const rows = tableContent.getElementsByTagName('tr');
            for (let i = 0; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName('td');
                if (cells.length > 0) {
                    rows[i].removeChild(cells[cells.length - 1]); // Remove the last cell (last column)
                }
            }

            // Set the content in the new window
            printWindow.document.write('<html><head><title>Member List</title>');
            printWindow.document.write('<link rel="stylesheet" href="{{asset('css/app.css')}}" type="text/css">');
            printWindow.document.write('</head><body>');
            printWindow.document.write(tableContent.outerHTML); // Use the modified table content
            printWindow.document.write('</body></html>');

            setTimeout(() => {
                // Print the new window
                printWindow.print();

                // Close the new window after printing
                printWindow.close();
            }, 1000); // Adjust the delay as needed (1 second delay in this example)
        }
    </script>
@endsection
