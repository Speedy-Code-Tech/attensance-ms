@extends('layouts.main', ['title' => 'Cash Receipt'])


@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <form action="{{route('cash.saveedit',$data->id)}}" method="POST">
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
                                    <h4 class="card-title">Update Cash Receipt - {{$data->user->rotary_id}}</h4>
                                    <button type="submit" id="btncashsave" class="btn btn-light-main btn-round ml-auto">
                                        <i class="fa fa-save"></i>
                                        Update
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
                                                      
                                                        @foreach($member as $datas)
                                                        <option @if($data->user->rotary_id === $datas->rotary_id) selected  @endif value="{{$datas->rotary_id}}">{{$datas->last_name}}, {{$datas->first_name }} {{$datas->middle_name}}</option>
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
                                                    <input value="{{$data->amount}}" type="text" class="form-control" name="amount" placeholder="0,****">
                                                </div>
                                                @error('amount')
                                                <div class="text-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group form-group-default @error('type_of_payment') border border-danger @enderror">
                                                    <label >Type of Payment</label>
                                                    <select name="type_of_payment" id="" class="form-control">
                                                        <option @if($data->type_of_payment == 'DUES' ) selected  @endif value="DUES">DUES</option>
                                                        <option @if($data->type_of_payment == 'Fines and' ) selected  @endif value="Fines and">Fines and</option>
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
                                                        <option @if($data->mode_of_payment == 'GCASH' ) selected  @endif value="gcash">GCASH</option>
                                                        <option @if($data->mode_of_payment == 'cash' ) selected  @endif value="cash">CASH</option>
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
                                            <textarea name="remarks" id="" class="form-control" cols="30" rows="6" placeholder="Description"> {{$data->remarks}} </textarea>
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