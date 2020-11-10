@extends('layouts.app')
@section('title', 'User List')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Dashboard
            <small>Version 2.0</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('users.index')}}"><i class="fa fa-group"></i> Users</a></li>
            <li class="active">List</li>
        </ol>
    </section>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Content Header (user header) -->
                <div class="box box-primary box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">User List</h3>
                        <div class="box-tools pull-right">
                        	<a href="{{route('users.create')}}" class="btn btn-sm bg-green"><i class="fa fa-plus"></i> New User</a>
                        </div>		
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                    	@include('includes.errormessage')
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">Sl.</th>
                                    <th style="width: 15%;">Name</th>
                                    <th style="width: 15%;">Username</th>
                                    <th style="width: 15%;">Email</th>
                                    <th style="width: 10%;">Phone</th>
                                    <th style="width: 15%;">Address</th>
                                    <th style="width: 10%;">Photo</th>
                                    <th style="width: 15%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $user)
                                <tr>
                                    <td>{{$loop->index + 1}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->username}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->phone}}</td>
                                    <td>{{$user->address}}</td>
                                    
                                    <td>
                                        <img src="{{asset($user->photo)}}" alt="" style="width: 50px; height: 50px;">
                                        
                                    </td>
                                    <td>
                                    	<a class="btn btn-sm bg-blue" href="{{route('users.edit',$user->id)}}"><span class="glyphicon glyphicon-edit"></span></a>

                                    	<form action="{{route('users.destroy',$user->id)}}" method="post" style="display: none;" id="delete-form-{{ $user->id}}">
                                            @csrf
                                            {{method_field('DELETE')}}
                                        </form>
                                        <a class="btn btn-sm bg-red" href="" onclick="if(confirm('Are You Sure To Delete?')){
                                            event.preventDefault();
                                            getElementById('delete-form-{{ $user->id}}').submit();
                                            }else{
                                            event.preventDefault();
                                            }"><span class="glyphicon glyphicon-trash"></span></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection