@extends('layouts.main', ['title' => 'Cash Receipt'])


@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <form action="{{route('cash.store')}}" method="POST">
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
                            Cash Receipt
                        </li>
                    </ul>
                
                    
                </div>
                <div class="row row-card-no-pd">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-head-row">
                                    <h4 class="card-title">Create Cash Receipt</h4>
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
                                                <div class="form-group form-group-default @error('rotaryid') border border-danger @enderror">
                                                    <label >Name</label>
                                                    
                                                    <select name="rotaryid" id="" class="form-control">
                                                        @foreach($member as $data)
                                                        <option value="{{$data->rotary_id}}">{{$data->last_name}}, {{$data->first_name}} {{$data->middle_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('rotaryid')
                                                <div class="text-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group form-group-default @error('amount') border border-danger @enderror">
                                                    <label >Amount</label>
                                                    <input value="{{old('amount')}}" type="text" class="form-control" name="amount" placeholder="0,****">
                                                </div>
                                                @error('amount')
                                                <div class="text-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group form-group-default @error('type_of_payment') border border-danger @enderror">
                                                    <label >Type of Payment</label>
                                                    <select name="type_of_payment" id="" class="form-control">
                                                        <option value="DUES">DUES</option>
                                                        <option value="Fines and">Fines and</option>
                                                    </select>
                                                </div>
                                                @error('type_of_payment')
                                                <div class="text-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group form-group-default @error('mode_of_payment') border border-danger @enderror">
                                                    <label >Mode of Payment</label>
                                                    <select name="mode_of_payment" id="" class="form-control">
                                                        <option value="gcash">GCASH</option>
                                                        <option value="cash">CASH</option>
                                                    </select>
                                                </div>
                                                @error('mode_of_payment')
                                                <div class="text-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="row p-3 pb-0 mb-0">
                                    <div class="col-md-10">
                                        <div class="row">
                                            <textarea name="remarks" id="" class="form-control" cols="30" rows="6" placeholder="Description"></textarea>
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


@endsection