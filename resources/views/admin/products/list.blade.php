@extends('layouts.app')
@section('title', 'Product List')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Dashboard
            <small>Version 2.0</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('products.index')}}"><i class="fa fa-group"></i> Products</a></li>
            <li class="active">List</li>
        </ol>
    </section>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Content Header (user header) -->
                <div class="box box-teal box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Product list</h3>
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
                                    <th style="width: 13%;">Name</th>
                                    <th style="width: 10%;">Buy Price</th>
                                    <th style="width: 14%;">Sell Price</th>
                                    <th style="width: 13%;">Vat</th>
                                    <th style="width: 22%;">Description</th>
                                    <th style="width: 10%;">Photo</th>
                                    <th style="width: 13%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $key => $product)
                                <tr>
                                    <td>{{$loop->index + 1}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->buy_price}}</td>
                                    <td>{{$product->sell_price}}</td>
                                    <td>{{$product->vat}}</td>
                                    <td>{{$product->description}}</td>
                                    <td>
                                        <img src="{{asset($product->photo)}}" alt="" style="width: 50px; width: 50px;"> 
                                    </td>
                                    <td>
                                    	<a class="btn btn-sm btn-success" href="{{route('products.edit',$product->id)}}"><span class="glyphicon glyphicon-edit"></span></a>

                                    	<form action="{{route('products.destroy',$product->id)}}" method="post" style="display: none;" id="delete-form-{{$product->id}}">
                                            @csrf
                                            {{method_field('DELETE')}}
                                        </form>
                                        <a class="btn btn-sm bg-red" href="" onclick="if(confirm('Are You Sure To Delete?')){
                                            event.preventDefault();
                                            getElementById('delete-form-{{$product->id}}').submit();
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