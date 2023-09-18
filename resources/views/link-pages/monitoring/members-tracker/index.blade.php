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
                        Members Tracker
                    </li>
                </ul>
               
            </div>
            <div class="row row-card-no-pd">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">

                                <h4 class="card-title">List of Member</h4>
                                <div class="btn-group ml-auto">
                                    <a href="{{route('cash.create')}}">
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
                                <table id="memberTable" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Member ID</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Type</th>
                                            <th>Latest Rotary</th>
                                            <th>Payment Of</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                        @foreach ($mem as $item)
                                        <tr>
                                            <td>{{$item->rotary_id}}</td>
                                            <td>{{strtoupper($item->last_name.', '.$item->first_name)}} @if ($item->middle_initial!==''){{$item->middle_initial}} @endif</td>
                                            <td class="@if ($item->is_active==='active')
                                                text-success
                                                @else
                                                text-danger
                                            @endif">{{strtoupper($item->is_active)}}</td>
                                            <td>{{strtoupper($item->user->role)}}</td>
                                            <td></td>
                                            <td>@if ($item->payment!=NULL)
                                                {{strtoupper($item->payment->mode_of_payment)}}
                                            @endif</td>
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
        $('#memberTable').DataTable();
    });
</script>
@endsection