@extends('layouts.app')

@section('title', 'Purchase Report')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Dashboard
            <small>Version 2.0</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('customers.index')}}"><i class="fa fa-group"></i> Customers</a></li>
            <li class="active">New customer</li>
        </ol>
    </section>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Content Header (customer header) -->
                <div class="box box-info box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">New customer</h3>
                        <div class="box-tools pull-right">
                        	
                        </div>		
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <br>
                    	@include('includes.errormessage')
                    	<form action="{{route('purchase.report')}}" method="get" class="form-horizontal" enctype="multipart/form-data">
                    		@csrf
                    		<div class="col-md-4">
                    			<div class="form-group">
                    				<div class="col-md-12">
                                		<label>Supplier</label>
                                    	<select name="supplier_id" class="form-control select2" id="" style="width: 100%">
                                    		<option value="">Select Supplier</option>
                                    		@foreach ($suppliers as $supplier)
                                    			<option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                    			
                                    		@endforeach
                                    	</select>
                    					
                    				</div>
                            </div>
                    		</div>
                    		<div class="col-md-3">
                    			<div class="form-group">
                                <div class="col-sm-12">
                                	<label>Start date</label>
                                    <input type="text" class="form-control" placeholder="start date" name="start_date" value="{{old('start_date')}}" id="start_date" autocomplete="off">
                                    
                                </div>
                            </div>
                    		</div>
                    		<div class="col-md-3">
                    			<div class="form-group">
                                <div class="col-sm-12">
                                	<label>End date</label>
                                    <input type="text" class="form-control" placeholder="end date" name="end_date" value="{{old('end_date')}}" id="end_date" autocomplete="off">
                                    
                                </div>
                            </div>
                    		</div>
                            
                            
                            
	                        <div class="col-md-2">
	                        	<label><br></label>
	                        	<button type="submit" class="btn btn-sm btn-info form-control">Save</button>
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

<script type="text/javascript">
	$(function () {
        $('#start_date, #end_date').datepicker({
            autoclose:   true,
            changeYear:  true,
            changeMonth: true,
            dateFormat:  "dd-mm-yy",
            yearRange:   "-10:+10"
        });
    });
</script>

@endsection