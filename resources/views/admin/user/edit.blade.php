@extends('layouts.app')
@section('title', 'User Update')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Dashboard
            <small>Version 2.0</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('users.index')}}"><i class="fa fa-group"></i> Users</a></li>
            <li class="active">User Update</li>
        </ol>
    </section>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Content Header (user header) -->
                <div class="box box-primary box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">User Update</h3>
                        <div class="box-tools pull-right">
                            <a href="{{route('users.index')}}" class="btn btn-sm bg-green"><i class="fa fa-list"></i> User List</a>
                        </div>      
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <br>
                        @include('includes.errormessage')
                        <form action="{{route('users.update',$user_info->id)}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="control-label col-md-2">Name</label>
                                <div class="col-sm-9">
                                    <input name="name" placeholder="name" class="form-control" required="" type="text" value="{{ $user_info->name }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Username</label>
                                <div class="col-sm-9">
                                    <input name="username" placeholder="Username" class="form-control" required="" type="text" value="{{ $user_info->username }}" readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">E-mail Address</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" placeholder="E-mail Address" name="email" value="{{$user_info->email}}" readonly="">
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Phone</label>
                                <div class="col-sm-9">
                                    <input name="phone" placeholder="Phone" class="form-control" type="text" value="{{ $user_info->phone }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Address</label>
                                <div class="col-sm-9">
                                    <textarea name="address" rows="3" class="form-control" placeholder="Address" style="resize: vertical;">{{$user_info->address}}</textarea>
                                    
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-2">Role</label>
                                <div class="col-sm-9">
                                    <select name="role_id" class="form-control select2" id="" style="width: 100%;"> 
                                        @foreach ($roles as $key => $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                    
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
                                    <img src="{{asset($user_info->photo)}}" alt="user Photo" id="user_photo" style="width: 200px; height: 200px;">
                                    <br> <br>
                                    <button type="reset" class="btn btn-sm bg-red">Cancel</button>
                                    <button type="submit" class="btn btn-sm bg-blue">Update</button>
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
            $('#user_photo')
            .attr('src', e.target.result)
            .width(200)
            .height(200);
        };
    
        reader.readAsDataURL(input.files[0]);
    }
    }
    
</script>