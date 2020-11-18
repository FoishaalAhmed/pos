@extends('layouts.app')

@section('title', 'Purchase return list')

@section('content')
	<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Dashboard
            <small>Version 2.0</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('purchases.index')}}"><i class="fa fa-shopping-cart"></i> Purchases</a></li>
            <li><a href="{{URL::to('purchase-returns')}}"><i class="fa fa-undo"></i> Purchase returns</a></li>
            <li class="active">List</li>
        </ol>
    </section>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Content Header (user header) -->
                <div class="box box-purple box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Purchase returns list</h3>
                        <div class="box-tools pull-right">
                        	
                        </div>		
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                    	@include('includes.errormessage')
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">Sl.</th>
                                    <th style="width: 15%;">Date</th>
                                    <th style="width: 25%;">Product</th>
                                    <th style="width: 15%;">Supplier</th>
                                    <th style="width: 15%;">User</th>
                                    <th style="width: 15%;">Quantity</th>
                                    <th style="width: 10%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($purchase_returns as $key => $return)
                                <tr>
                                    <td>{{$loop->index + 1}}</td>
                                    <td>{{date('d M, Y', strtotime($return->date))}}</td>
                                    <td>{{$return->product}}</td>
                                    <td>{{$return->supplier}}</td>
                                    <td>{{$return->user}}</td>
                                    <td>{{$return->quantity}}</td>
                                    <td>
                                    	<form action="{{route('purchase-returns-destroy',$return->id)}}" method="post" style="display: none;" id="delete-form-{{$return->id}}">
                                            @csrf
                                            {{method_field('DELETE')}}
                                        </form>
                                        <a class="btn btn-sm bg-red" href="" onclick="if(confirm('Are You Sure To Delete?')){
                                            event.preventDefault();
                                            getElementById('delete-form-{{$return->id}}').submit();
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