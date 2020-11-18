@extends('layouts.app')
@section('title', 'New customer add')
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
                        	<a href="{{route('customers.index')}}" class="btn btn-sm bg-orange"><i class="fa fa-list"></i> Customer list</a>
                        </div>		
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <br>
                    	@include('includes.errormessage')
                    	<form action="{{route('customers.store')}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                    		@csrf
                            <div class="form-group">
                                <label class="control-label col-md-2">Name</label>
                                <div class="col-sm-9">
                                    <input name="name" placeholder="name" class="form-control" required="" type="text" value="{{ old('name') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">E-mail Address</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" placeholder="E-mail Address" name="email" value="{{old('email')}}">
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Phone</label>
                                <div class="col-sm-9">
                                    <input name="phone" placeholder="Phone" class="form-control" type="text" value="{{ old('phone') }}" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Area</label>
                                <div class="col-sm-9">
                                    <input name="area" placeholder="area" class="form-control" type="text" value="{{ old('area') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Address</label>
                                <div class="col-sm-9">
                                    <textarea name="address" rows="3" class="form-control" placeholder="Address" style="resize: vertical;">{{old('address')}}</textarea>
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Credit limit</label>
                                <div class="col-sm-9">
                                    <input name="credit_limit" placeholder="Credit limit" class="form-control" type="number" value="{{ old('credit_limit') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Photo</label>
                                <div class="col-sm-9">
                                    <input type="file" name="photo" onchange="readPicture(this)">
                                </div>
                            </div>
	                        <div class="col-md-12">
	                        	<center>
                                    <img src="//placehold.it/200x200" alt="customer Photo" id="customer_photo">
                                    <br> <br>
	                        		<button type="reset" class="btn btn-sm bg-red">Reset</button>
	                        		<button type="submit" class="btn btn-sm btn-info">Save</button>
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

<script>
    // profile picture change
    function readPicture(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
    
          reader.onload = function (e) {
            $('#customer_photo')
            .attr('src', e.target.result)
            .width(200)
            .height(200);
        };
    
        reader.readAsDataURL(input.files[0]);
    }
    }
    
</script>