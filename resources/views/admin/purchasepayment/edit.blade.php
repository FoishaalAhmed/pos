@extends('layouts.app')
@section('title', 'Update purchase payments')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Dashboard
            <small>Version 2.0</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('purchases.index')}}"><i class="fa fa-shopping-cart"></i> Purchases</a></li>
            <li><a href="{{route('purchase-payments.index')}}"><i class="fa fa-money"></i> Purchase payments</a></li>
            <li class="active">Update</li>
        </ol>
        </ol>
    </section>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Content Header (supplier header) -->
                <div class="box box-purple box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Update purchase payments</h3>
                        <div class="box-tools pull-right">
                        	<a href="{{route('purchase-payments.index')}}" class="btn btn-sm bg-green"><i class="fa fa-list"></i> Purchase payments list</a>
                        </div>		
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <br>
                    	@include('includes.errormessage')
                    	<form action="{{route('purchase-payments.update',$purchase_payment->id)}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                    		@csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="control-label col-md-2">Date</label>
                                <div class="col-sm-9">
                                    <input name="date" placeholder="date" class="form-control" required="" type="text" value="{{ $purchase_payment->date }}" id="date" autocomplete="off">

                                    <input name="purchase_id" type="hidden" value="1" >
                                    <input name="invoice" type="hidden" value="{{date('Y-m-d-H-i-s')}}" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">User</label>
                                <div class="col-sm-9">
                                    <select name="user_id" class="form-control select2" style="width: 100%" id="user_id" required="">
                                        <option value="">Select User</option>
                                        @foreach ($users as $user)
                                            <option value="{{$user->id}}" @if ($purchase_payment->user_id == $user->id) {{'selected'}}
                                            @endif>{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Supplier</label>
                                <div class="col-sm-9">
                                    <select name="supplier_id" class="form-control select2" style="width: 100%" id="supplier_id" required="">
                                        <option value="">Select supplier</option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{$supplier->id}}" @if ($purchase_payment->supplier_id == $supplier->id) {{'selected'}}
                                            @endif>{{$supplier->name}}</option>
                                        @endforeach
                                    </select>
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Paid</label>
                                <div class="col-sm-9">
                                    <input name="paid" placeholder="paid" class="form-control" required="" type="number" value="{{ $purchase_payment->paid }}" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Due</label>
                                <div class="col-sm-9">
                                    <input name="due" placeholder="due" class="form-control" required="" type="number" value="{{ $purchase_payment->due }}" >
                                </div>
                            </div>
	                        <div class="col-md-12">
	                        	<center>
	                        		<button type="reset" class="btn btn-sm bg-red">Cancel</button>
	                        		<button type="submit" class="btn btn-sm bg-purple">Update</button>
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