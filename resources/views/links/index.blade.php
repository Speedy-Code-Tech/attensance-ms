@extends('layouts.main', ['title' => 'Links'])

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
                        Links
                    </li>
                </ul>
            </div>
            <div class="row row-card-no-pd">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <h4 class="card-title">List of Links</h4>
                               
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="container-fluid grid_buttons">
                                <div class="buttons">
                                    <p class="titles">Data Entries</p>
                                    <div class="grids">
                                        <a href="{{route('cash.index')}}" class="btn ylwbtn form-control">Cash Receipt</a>
                                        <a href="{{route('cashdis.index')}}" class="btn ylwbtn form-control">Cash Disbursement</a>
                                        <a href="{{route('projectdis.index')}}" class="btn ylwbtn form-control">Project Disbursement</a>
                                        <a href="{{route('petty.index')}}" class="btn ylwbtn form-control">Petty Cash</a>
                                        <a href="{{route('cashadvance.index')}}" class="btn ylwbtn form-control">Cash Advances</a>
                                    </div>
                                </div>
                                <div class="buttons">
                                    <p class="titles">Monitoring</p>
                                    <div class="grids">
                                        <a href="" class="btn ylwbtn form-control">Club Dues Tracker</a>
                                        <a href="{{route('member.index')}}" class="btn ylwbtn form-control">Members Tracker</a>
                                        <a href="" class="btn ylwbtn form-control">Project Attendance</a>
                                        <a href="" class="btn ylwbtn form-control">Club Attendance</a>
                                    </div>
                                </div>
                                <div class="buttons">
                                    <p class="titles">Reports</p>
                                    <div class="grids">
                                        <a href="" class="btn ylwbtn form-control">Statistics</a>
                                        <a href="" class="btn ylwbtn form-control">Bank Reconcilation</a>
                                        <a href="" class="btn ylwbtn form-control">Club Finance Performance</a>
                                        <a href="" class="btn ylwbtn form-control">Club Payables</a>
                                    </div>
                                </div>
                                <div class="buttons">
                                    <p class="titles">Forms</p>
                                    <div class="grids">
                                        <a href="" class="btn ylwbtn form-control">Request Form</a>
                                        <a href="" class="btn ylwbtn form-control">Liquidation Form</a>
                                        <a href="" class="btn ylwbtn form-control">Reimbursement Form</a>
                                    </div>
                                </div>
                            </div>
                        </div>   
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
  
</script>
@endsection
