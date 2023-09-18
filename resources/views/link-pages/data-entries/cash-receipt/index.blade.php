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
                        Cash Receipt
                    </li>
                </ul>
               
            </div>
            <div class="row row-card-no-pd">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">

                                <h4 class="card-title">List of Cash Receipt</h4>
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
                                <table id="recieptTable" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Payee</th>
                                            <th>Receipt #</th>
                                            <th>Amount</th>
                                            <th>Type of Payment</th>
                                            <th>Mode Of Payment</th>
                                            <th>Remarks</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($receipts as $receipt)
                                            
                                        
                                            <tr>
                                               <td>{{strtoupper($receipt->date)}}</td>
                                               <td>{{strtoupper($receipt->user->last_name.', '.$receipt->user->first_name.' '. $receipt->user->middle_initial)}} </td>
                                               <td>{{strtoupper($receipt->id)}}</td>
                                               <td>{{strtoupper($receipt->amount)}}.00</td>
                                               <td>{{strtoupper($receipt->type_of_payment)}}</td>
                                               <td>{{strtoupper($receipt->mode_of_payment)}}</td>
                                               <td>{{$receipt->remarks}}</td>
                                               <td class="d-flex justify-content-center align-items-center gap-2">
                                                    <a href="{{route('cash.edit',$receipt->id)}}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                                    <form action="{{route('cash.delete',$receipt->id)}}" method="POST" class="d-inline">
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
