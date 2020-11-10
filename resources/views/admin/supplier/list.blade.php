@extends('layouts.app')
@section('title', 'supplier List')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Dashboard
            <small>Version 2.0</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('suppliers.index')}}"><i class="fa fa-group"></i> Suppliers</a></li>
            <li class="active">List</li>
        </ol>
    </section>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Content Header (user header) -->
                <div class="box box-danger box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Supplier list</h3>
                        <div class="box-tools pull-right">
                        	<a href="{{route('suppliers.create')}}" class="btn btn-sm bg-green"><i class="fa fa-plus"></i> New supplier</a>
                        </div>		
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                    	@include('includes.errormessage')
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">Sl.</th>
                                    <th style="width: 13%;">Name</th>
                                    <th style="width: 13%;">Email</th>
                                    <th style="width: 10%;">Phone</th>
                                    <th style="width: 14%;">Area</th>
                                    <th style="width: 15%;">Address</th>
                                    <th style="width: 15%;">Company info</th>
                                    <th style="width: 15%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($suppliers as $key => $supplier)
                                <tr>
                                    <td>{{$loop->index + 1}}</td>
                                    <td>{{$supplier->name}}</td>
                                    <td>{{$supplier->email}}</td>
                                    <td>{{$supplier->phone}}</td>
                                    <td>{{$supplier->area}}</td>
                                    <td>{{$supplier->address}}</td>
                                    <td>Name: {{$supplier->company}} <br> Phone: {{$supplier->company_phone}} </td>
                                    <td>
                                    	<a class="btn btn-sm btn-success" href="{{route('suppliers.edit',$supplier->id)}}"><span class="glyphicon glyphicon-edit"></span></a>

                                    	<form action="{{route('suppliers.destroy',$supplier->id)}}" method="post" style="display: none;" id="delete-form-{{$supplier->id}}">
                                            @csrf
                                            {{method_field('DELETE')}}
                                        </form>
                                        <a class="btn btn-sm bg-red" href="" onclick="if(confirm('Are You Sure To Delete?')){
                                            event.preventDefault();
                                            getElementById('delete-form-{{$supplier->id}}').submit();
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