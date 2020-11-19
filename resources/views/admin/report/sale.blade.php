@extends('layouts.app')

@section('title', 'Sale Report')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Dashboard
            <small>Version 2.0</small>
        </h1>
        <ol class="breadcrumb">
            <li class="active">Sale Report</li>
        </ol>
    </section>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Content Header (customer header) -->
                <div class="box box-primary box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Sale Report</h3>
                        <div class="box-tools pull-right">
                        	
                        </div>		
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <br>
                    	@include('includes.errormessage')
                    	<form action="{{route('sale.report')}}" method="get" class="form-horizontal" enctype="multipart/form-data">
                    		@csrf
                    		<div class="col-md-4">
                    			<div class="form-group">
                    				<div class="col-md-12">
                                		<label>Customer</label>
                                    	<select name="customer_id" class="form-control select2" id="" style="width: 100%">
                                    		<option value="">Select customer</option>
                                    		@foreach ($customers as $customer)
                                    			<option value="{{$customer->id}}">{{$customer->name}}</option>
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
	                        	<button type="submit" class="btn btn-sm btn-primary form-control">Save</button>
	                        </div>
                        </form>

                        @if (isset ($sale_report))
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                      <th style="width: 5%;">Sl.</th>
                                      <th style="width: 15%;">Date</th>
                                      <th style="width: 15%;">User</th>
                                      <th style="width: 15%;">Customer</th>
                                      <th style="width: 30%;">Note</th>
                                      <th style="width: 10%;">Amount</th>
                                      <th style="width: 10%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sale_report as $value)
                                        <tr>
                                          <td>{{$loop->index+1}}</td>
                                          <td>{{date('d M, Y', strtotime($value->date))}}</td>
                                          <td>{{$value->user}}</td>
                                          <td>{{$value->customer}}</td>
                                          <td>{{$value->note}}</td>
                                          <td>{{$value->total}}</td>
                                          <td>
                                              <a href="{{route('sales.show',$value->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                          </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
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