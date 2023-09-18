@extends('layouts.main', ['title' => 'Cash Receipt'])


@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <form action="{{route('cashdis.store')}}" method="POST">
                @csrf
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
                                    <h4 class="card-title">Create Cash Disbursement</h4>
                                    <button type="submit" id="btncashsave" class="btn btn-light-main btn-round ml-auto">
                                        <i class="fa fa-save"></i>
                                        Create
                                    </button>
                                    
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row p-3 pb-0 mb-0">
                                    <div class="col-md-10">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="form-group form-group-default @error('name') border border-danger @enderror">
                                                    <label >Name</label>
                                                    <select name="name" class="form-control">
                                                        @foreach($member as $data)
                                                        <option value="{{$data->rotary_id}}">{{$data->last_name}}, {{$data->first_name}} {{$data->middle_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('name')
                                                <div class="text-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group form-group-default @error('type') border border-danger @enderror">
                                                    <label >Type</label>
                                                    <select name="type" class="form-control">
                                                        <option value="admin">Admin</option>
                                                        <option value="member">Member</option>
                                                    </select>
                                                </div>
                                                @error('type')
                                                <div class="text-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group form-group-default @error('fund_used') border border-danger @enderror">
                                                    <label >Fund Used</label>
                                                    <select name="fund_used" class="form-control">
                                                        <option value="gcash">Gcash</option>
                                                        <option value="check">Check</option>
                                                        <option value="cash">Cash</option>
                                                    </select>
                                                </div>
                                                @error('fund_used')
                                                <div class="text-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group form-group-default @error('check') border border-danger @enderror">
                                                    <label >Check No.</label>
                                                    <input type="text" name="check" class="form-control" placeholder="123456">
                                                </div>
                                                @error('check')
                                                <div class="text-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group form-group-default @error('amount') border border-danger @enderror">
                                                    <label >Amount</label>
                                                    <input type="text" name="amount" class="form-control" placeholder="123456.00">
                                                </div>
                                                @error('amount')
                                                <div class="text-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group form-group-default @error('expense') border border-danger @enderror">
                                                    <label >Expense Type</label>
                                                    <select name="expense" class="form-control">
                                                        <option value="petty">Petty Cash</option>
                                                        <option value="miscellaneous">Miscellaneous</option>
                                                        <option value="salary">Salary</option>
                                                    </select>
                                                </div>
                                                @error('expense')
                                                <div class="text-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group form-group-default @error('remarks') border border-danger @enderror">
                                                    <label >Remarks</label>
                                                    <input type="text" name="remarks" class="form-control" placeholder="Remarks">
                                                </div>
                                                @error('remarks')
                                                <div class="text-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row p-3 pt-0 mt-0 pb-0 mb-0">
                                    <div class="col-md-10 ">
                                        
                                       
                                            <div class=" form-group form-group-default @error('description') border border-danger @enderror">
                                                <label >Description</label>
                                                <textarea name="description" id="" cols="30" rows="4" class="form-control" placeholder="Description"></textarea>    
                                            </div>
                                            @error('description')
                                            <div class="text-danger">{{$message}}</div>
                                            @enderror
                                       
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


@endsection