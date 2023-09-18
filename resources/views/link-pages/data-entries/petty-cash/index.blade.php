@extends('layouts.main', ['title' => 'Cash Receipt'])


@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Links</h4>
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
                        <a href="links">Links</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        Petty Cash
                    </li>
                </ul>
               
            </div>
            <div class="row row-card-no-pd">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">

                                <h4 class="card-title">List of Petty Cash</h4>
                                <div class="btn-group ml-auto">
                                    <a href="">
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
                                <table id="recieptTable" class="display table table-striped table-hover">
                                    <thead>
                                       {{-- CODE HERE --}}
                                    </thead>
                                    <tbody>
                                        {{-- CODE HERE --}}
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
        $('#recieptTable').DataTable();
    });
</script>
@endsection
