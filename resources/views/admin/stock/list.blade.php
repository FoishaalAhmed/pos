@extends('layouts.app')
@section('title', 'Stock List')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Dashboard
            <small>Version 2.0</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('products.index')}}"><i class="fa fa-group"></i> Products</a></li>
            <li class="active">Stock</li>
        </ol>
    </section>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Content Header (user header) -->
                <div class="box box-teal box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Stock list</h3>
                        <div class="box-tools pull-right">
                        	<a href="{{route('products.create')}}" class="btn btn-sm bg-green"><i class="fa fa-plus"></i> New Product</a>
                        </div>		
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                    	@include('includes.errormessage')
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">Sl.</th>
                                    <th style="width: 55%;">Product</th>
                                    <th style="width: 15%;">Stock</th>
                                    <th style="width: 10%;">Sell</th>
                                    <th style="width: 15%;">Available</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stocks as $key => $stock)
                                <tr>
                                    <td>{{$loop->index + 1}}</td>
                                    <td>{{$stock->product}}</td>
                                    <td>{{$stock->total_quanity}} {{$stock->unit}}</td>
                                    <td>{{$stock->sale_quantity}} {{$stock->unit}}</td>
                                    <td>{{$stock->total_quanity - $stock->sale_quantity}} {{$stock->unit}}</td>
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