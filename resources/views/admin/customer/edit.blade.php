@extends('layouts.app')
@section('title', 'Customer Update')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Dashboard
            <small>Version 2.0</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('customers.index')}}"><i class="fa fa-group"></i> Customers</a></li>
            <li class="active">Customer Update</li>
        </ol>
    </section>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Content Header (customer header) -->
                <div class="box box-info box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Customer Update</h3>
                        <div class="box-tools pull-right">
                            <a href="{{route('customers.index')}}" class="btn btn-sm bg-orange"><i class="fa fa-list"></i> Customer List</a>
                        </div>      
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <br>
                        @include('includes.errormessage')
                        <form action="{{route('customers.update',$customer_info->id)}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="control-label col-md-2">Name</label>
                                <div class="col-sm-9">
                                    <input name="name" placeholder="name" class="form-control" required="" type="text" value="{{ $customer_info->name }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">E-mail Address</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" placeholder="E-mail Address" name="email" value="{{$customer_info->email}}">
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Phone</label>
                                <div class="col-sm-9">
                                    <input name="phone" placeholder="Phone" class="form-control" required="" type="text" value="{{ $customer_info->phone }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Area</label>
                                <div class="col-sm-9">
                                    <input name="area" placeholder="Area" class="form-control" required="" type="text" value="{{ $customer_info->area }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Address</label>
                                <div class="col-sm-9">
                                    <textarea name="address" rows="3" class="form-control" placeholder="Address" style="resize: vertical;">{{$customer_info->address}}</textarea>
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Credit limit</label>
                                <div class="col-sm-9">
                                    <input name="credit_limit" placeholder="Credit limit" class="form-control" required="" type="number" value="{{ $customer_info->credit_limit }}">
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
                                    <img src="{{asset($customer_info->photo)}}" alt="customer Photo" id="customer_photo" style="width: 200px; height: 200px;">
                                    <br> <br>
                                    <button type="reset" class="btn btn-sm bg-red">Cancel</button>
                                    <button type="submit" class="btn btn-sm btn-info">Update</button>
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