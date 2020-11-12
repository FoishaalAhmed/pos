@extends('layouts.app')
@section('title', 'Purchase List')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Dashboard
            <small>Version 2.0</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('purchases.index')}}"><i class="fa fa-group"></i> Purchases</a></li>
            <li class="active">List</li>
        </ol>
    </section>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Content Header (user header) -->
                <div class="box box-purple box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Purchase list</h3>
                        <div class="box-tools pull-right">
                        	<a href="{{route('purchases.create')}}" class="btn btn-sm bg-green"><i class="fa fa-plus"></i> New purchase</a>
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
                                    <th style="width: 15%;">Subtotal</th>
                                    <th style="width: 10%;">Total</th>
                                    <th style="width: 20%;">Note</th>
                                    <th style="width: 10%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($purchases as $key => $purchase)
                                <tr>
                                    <td>{{$loop->index + 1}}</td>
                                    <td>{{$purchase->date}}</td>
                                    <td>{{$purchase->supplier}}</td>
                                    <td>{{$purchase->user}}</td>
                                    <td>{{$purchase->subtotal}}</td>
                                    <td>{{$purchase->total}}</td>
                                    <td>{{$purchase->note}}</td>
                                    <td>
                                    	<a class="btn btn-sm btn-success" href="{{route('purchases.show',$purchase->id)}}"><span class="fa fa-eye"></span></a>

                                    	<form action="{{route('purchases.destroy',$purchase->id)}}" method="post" style="display: none;" id="delete-form-{{$purchase->id}}">
                                            @csrf
                                            {{method_field('DELETE')}}
                                        </form>
                                        <a class="btn btn-sm bg-red" href="" onclick="if(confirm('Are You Sure To Delete?')){
                                            event.preventDefault();
                                            getElementById('delete-form-{{$purchase->id}}').submit();
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