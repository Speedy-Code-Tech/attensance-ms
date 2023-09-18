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
                        Cash Disbursement
                    </li>
                </ul>
               
            </div>
            <div class="row row-card-no-pd">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">

                                <h4 class="card-title">List of Cash Disbursement</h4>
                                <div class="btn-group ml-auto">
                                    <a href="{{route('cashdis.create')}}">
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
                                       <tr>
                                            <th>Date</th>
                                            <th>Type</th>
                                            <th>Request #</th>
                                            <th>Payee</th>
                                            <th>Description</th>
                                            <th>Fund Used</th>
                                            <th>Check No</th>
                                            <th>Amount</th>
                                            <th>Expense Type</th>
                                            <th>Remarks</th>
                                            <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($member as $data)
                                            <tr>
                                                <td>{{$data->date}}</td>
                                                <td>{{$data->type}}</td>
                                                <td></td>
                                                <td>{{$data->payee}} </td>
                                                <td> {{$data->description}}</td>
                                                <td> {{$data->fund_used}}</td>
                                                <td> {{$data->check_no}}</td>
                                                <td> {{$data->amount}}</td>
                                                <td> {{$data->expense_type}}</td>
                                                <td> {{$data->remarks}}</td>
                                                <td class="d-flex justify-content-center align-items-center gap-2">
                                                    <a href="{{route('cashdis.edit',$data->id)}}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                                    <form action="{{route('cashdis.destroy',$data->id)}}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this schedule?')"><i class="fa fa-trash"></i></button>
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
        $('#recieptTable').DataTable();
    });
</script>
@endsection
