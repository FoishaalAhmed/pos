@extends('layouts.app')
@section('title', 'Customer List')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Dashboard
            <small>Version 2.0</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('customers.index')}}"><i class="fa fa-group"></i> Customers</a></li>
            <li class="active">List</li>
        </ol>
    </section>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Content Header (user header) -->
                <div class="box box-info box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Customer List</h3>
                        <div class="box-tools pull-right">
                        	<a href="{{route('customers.create')}}" class="btn btn-sm bg-orange"><i class="fa fa-plus"></i> New Customer</a>
                        </div>		
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                    	@include('includes.errormessage')
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 4%;">Sl.</th>
                                    <th style="width: 13%;">Name</th>
                                    <th style="width: 13%;">Email</th>
                                    <th style="width: 9%;">Phone</th>
                                    <th style="width: 13%;">Area</th>
                                    <th style="width: 13%;">Address</th>
                                    <th style="width: 13%;">Credit Limit</th>
                                    <th style="width: 9%;">Photo</th>
                                    <th style="width: 13%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $key => $customer)
                                <tr>
                                    <td>{{$loop->index + 1}}</td>
                                    <td>{{$customer->name}}</td>
                                    <td>{{$customer->email}}</td>
                                    <td>{{$customer->phone}}</td>
                                    <td>{{$customer->area}}</td>
                                    <td>{{$customer->address}}</td>
                                    <td>{{$customer->credit_limit}}</td>
                                    
                                    <td>
                                        <img src="{{asset($customer->photo)}}" alt="" style="width: 50px; height: 50px;">
                                        
                                    </td>
                                    <td>
                                    	<a class="btn btn-sm btn-info" href="{{route('customers.edit',$customer->id)}}"><span class="glyphicon glyphicon-edit"></span></a>

                                    	<form action="{{route('customers.destroy',$customer->id)}}" method="post" style="display: none;" id="delete-form-{{$customer->id}}">
                                            @csrf
                                            {{method_field('DELETE')}}
                                        </form>
                                        <a class="btn btn-sm bg-red" href="" onclick="if(confirm('Are You Sure To Delete?')){
                                            event.preventDefault();
                                            getElementById('delete-form-{{$customer->id}}').submit();
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