@extends('layouts.app')
@section('title', 'New cost add')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Dashboard
            <small>Version 2.0</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('costs.index')}}"><i class="fa fa-group"></i> Costs</a></li>
            <li class="active">New cost</li>
        </ol>
    </section>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Content Header (cost header) -->
                <div class="box box-teal box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">New cost</h3>
                        <div class="box-tools pull-right">
                        	<a href="{{route('costs.index')}}" class="btn btn-sm bg-green"><i class="fa fa-list"></i> Cost list</a>
                        </div>		
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <br>
                    	@include('includes.errormessage')
                    	<form action="{{route('costs.store')}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                    		@csrf
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label col-md-2">Date</label>
                                        <div class="col-sm-10">
                                            <input name="date" placeholder="Date" class="form-control" required="" type="text" value="{{ old('date') }}" autocomplete="off" id="date">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label col-md-2">Amount</label>
                                        <div class="col-sm-10">
                                            <input name="amount" placeholder="Amount" class="form-control" required="" type="number" value="{{ old('amount') }}" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label col-md-1">Note</label>
                                        <div class="col-sm-11">
                                            <textarea name="note" placeholder="Cost note" class="form-control" id="" rows="5">{{ old('note') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
	                        <div class="col-md-12">
	                        	<center>
	                        		<button type="reset" class="btn btn-sm bg-red">Reset</button>
	                        		<button type="submit" class="btn btn-sm bg-teal">Save</button>
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

