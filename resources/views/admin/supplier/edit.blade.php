@extends('layouts.app')
@section('title', 'Supplier update')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Dashboard
            <small>Version 2.0</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('suppliers.index')}}"><i class="fa fa-group"></i> Suppliers</a></li>
            <li class="active">Supplier Update</li>
        </ol>
    </section>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Content Header (supplier header) -->
                <div class="box box-danger box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">New supplier</h3>
                        <div class="box-tools pull-right">
                            <a href="{{route('suppliers.index')}}" class="btn btn-sm bg-green"><i class="fa fa-list"></i> Supplier list</a>
                        </div>      
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <br>
                        @include('includes.errormessage')
                        <form action="{{route('suppliers.update',$supplier_info->id)}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="control-label col-md-2">Name</label>
                                <div class="col-sm-9">
                                    <input name="name" placeholder="name" class="form-control" required="" type="text" value="{{ $supplier_info->name }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">E-mail Address</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" placeholder="E-mail Address" name="email" value="{{$supplier_info->email}}">
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Phone</label>
                                <div class="col-sm-9">
                                    <input name="phone" placeholder="Phone" class="form-control" required="" type="text" value="{{ $supplier_info->phone }}" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Area</label>
                                <div class="col-sm-9">
                                    <input name="area" placeholder="area" class="form-control" type="text" value="{{ $supplier_info->area }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Address</label>
                                <div class="col-sm-9">
                                    <textarea name="address" rows="3" class="form-control" placeholder="Address" style="resize: vertical;">{{$supplier_info->address}}</textarea>
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Company</label>
                                <div class="col-sm-9">
                                    <input name="company" placeholder="Company" class="form-control" type="text" value="{{ $supplier_info->company }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Company phone</label>
                                <div class="col-sm-9">
                                    <input name="company_phone" placeholder="Company phone" class="form-control" type="text" value="{{ $supplier_info->company_phone }}">
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
                                    <img src="{{asset($supplier_info->photo)}}" alt="supplier Photo" id="supplier_photo" style="width: 200px; height: 200px;">
                                    <br> <br>
                                    <button type="reset" class="btn btn-sm bg-red">Reset</button>
                                    <button type="submit" class="btn btn-sm bg-green">Save</button>
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
            $('#supplier_photo')
            .attr('src', e.target.result)
            .width(200)
            .height(200);
        };
    
        reader.readAsDataURL(input.files[0]);
    }
    }
    
</script>