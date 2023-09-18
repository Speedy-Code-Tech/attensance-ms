@extends('layouts.main', ['title' => 'Magazines'])

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Magazines</h4>
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
                        Magazines
                    </li>
                </ul>
            </div>
            <div class="row row-card-no-pd">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <h4 class="card-title">List of Magazines</h4>
                                <div class="btn-group ml-auto">
                                    <a href="{{ route('magazines.create') }}">
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
                                <table id="magazinesTable" class="display table table-striped table-hover mt-3">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Issue</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($magazines as $magazine)
                                        <tr>
                                            <td>{{ $magazine->title }}</td>
                                            <td>{{ $magazine->issue }}</td>
                                            <td>
                                                <a href="{{ route('magazines.show', $magazine->id) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                                <a href="{{ route('magazines.edit', $magazine->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                                <form action="{{ route('magazines.destroy', $magazine->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this magazine?')"><i class="fa fa-trash"></i></button>
                                                </form>
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
        $('#magazinesTable').DataTable({
                "order": [[1, "desc"]]
            });
    });
</script>
@endsection
