@extends('layouts.app')
@section('title', 'Update sale payments')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Dashboard
            <small>Version 2.0</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('sales.index')}}"><i class="fa fa-shopping-cart"></i> sales</a></li>
            <li><a href="{{route('sale-payments.index')}}"><i class="fa fa-money"></i> sale payments</a></li>
            <li class="active">Update</li>
        </ol>
        </ol>
    </section>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Content Header (customer header) -->
                <div class="box box-6a8d9d box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Update sale payments</h3>
                        <div class="box-tools pull-right">
                        	<a href="{{route('sale-payments.index')}}" class="btn btn-sm bg-purple"><i class="fa fa-list"></i> Sale payments list</a>
                        </div>		
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <br>
                    	@include('includes.errormessage')
                    	<form action="{{route('sale-payments.update',$sale_payment->id)}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                    		@csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="control-label col-md-2">Date</label>
                                <div class="col-sm-9">
                                    <input name="date" placeholder="date" class="form-control" required="" type="text" value="{{ $sale_payment->date }}" id="date" autocomplete="off">
                                    <input type="hidden" name="sale_id" value="0">
                                    <input type="hidden" name="invoice" value="2020-12-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">User</label>
                                <div class="col-sm-9">
                                    <select name="user_id" class="form-control select2" style="width: 100%" id="user_id">
                                        <option value="">Select User</option>
                                        @foreach ($users as $user)
                                            <option value="{{$user->id}}" @if ($sale_payment->user_id == $user->id) {{'selected'}}
                                            @endif>{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Customer</label>
                                <div class="col-sm-9">
                                    <select name="customer_id" class="form-control select2" style="width: 100%" id="customer_id" required="">
                                        <option value="">Select customer</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{$customer->id}}" @if ($sale_payment->customer_id == $customer->id) {{'selected'}}
                                            @endif>{{$customer->name}}</option>
                                        @endforeach
                                    </select>
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Paid</label>
                                <div class="col-sm-9">
                                    <input name="paid" placeholder="paid" class="form-control" required="" type="number" value="{{ $sale_payment->paid }}" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Due</label>
                                <div class="col-sm-9">
                                    <input name="due" placeholder="due" class="form-control" required="" type="number" value="{{ $sale_payment->due }}" >
                                </div>
                            </div>
	                        <div class="col-md-12">
	                        	<center>
	                        		<button type="reset" class="btn btn-sm bg-red">Cancel</button>
	                        		<button type="submit" class="btn btn-sm btn-6a8d9d">Update</button>
	                        	</center>
	                        </div>
                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footerSection')
    <script>
        $(function () {
            $('#date').datepicker({
                autoclose:   true,
                changeYear:  true,
                changeMonth: true,
                dateFormat:  "dd-mm-yy",
                yearRange:   "-10:+10"
            });
        });
    </script>  
@endsection