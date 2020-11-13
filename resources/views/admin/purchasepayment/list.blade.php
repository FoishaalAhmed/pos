@extends('layouts.app')

@section('title', 'Purchase payment list')

@section('content')
	<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Dashboard
            <small>Version 2.0</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('purchases.index')}}"><i class="fa fa-shopping-cart"></i> Purchases</a></li>
            <li><a href="{{route('purchase-payments.index')}}"><i class="fa fa-money"></i> Purchase payments</a></li>
            <li class="active">List</li>
        </ol>
    </section>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Content Header (user header) -->
                <div class="box box-purple box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Purchase payments list</h3>
                        <div class="box-tools pull-right">
                        	<a href="{{route('purchase-payments.create')}}" class="btn btn-sm bg-green"><i class="fa fa-plus"></i> New purchase payments</a>
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
                                    <th style="width: 10%;">Supplier</th>
                                    <th style="width: 15%;">User</th>
                                    <th style="width: 15%;">Paid</th>
                                    <th style="width: 10%;">Due</th>
                                    <th style="width: 10%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($purchase_payments as $key => $payment)
                                <tr>
                                    <td>{{$loop->index + 1}}</td>
                                    <td>{{date('d M, Y', strtotime($payment->date))}}</td>
                                    <td>{{$payment->supplier}}</td>
                                    <td>{{$payment->user}}</td>
                                    <td>{{$payment->paid}}</td>
                                    <td>{{$payment->due}}</td>
                                    <td>
                                    	<a class="btn btn-sm bg-purple" href="{{route('purchase-payments.edit',$payment->id)}}"><span class="fa fa-edit"></span></a>

                                    	<form action="{{route('purchase-payments.destroy',$payment->id)}}" method="post" style="display: none;" id="delete-form-{{$payment->id}}">
                                            @csrf
                                            {{method_field('DELETE')}}
                                        </form>
                                        <a class="btn btn-sm bg-red" href="" onclick="if(confirm('Are You Sure To Delete?')){
                                            event.preventDefault();
                                            getElementById('delete-form-{{$payment->id}}').submit();
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