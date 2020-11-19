@extends('layouts.app')
@section('title', 'Cost List')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Dashboard
            <small>Version 2.0</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('costs.index')}}"><i class="fa fa-group"></i> Costs</a></li>
            <li class="active">List</li>
        </ol>
    </section>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Content Header (user header) -->
                <div class="box box-teal box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Cost list</h3>
                        <div class="box-tools pull-right">
                        	<a href="{{route('costs.create')}}" class="btn btn-sm bg-green"><i class="fa fa-plus"></i> New Cost</a>
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
                                    <th style="width: 50%;">Note</th>
                                    <th style="width: 15%;">Amount</th>
                                    <th style="width: 15%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($costs as $key => $cost)
                                <tr>
                                    <td>{{$loop->index + 1}}</td>
                                    <td>{{date('d M, Y', strtotime($cost->date))}}</td>
                                    <td>{{$cost->note}}</td>
                                    <td>{{$cost->amount}}</td>
                                    <td>
                                    	<a class="btn btn-sm bg-teal" href="{{route('costs.edit',$cost->id)}}"><span class="glyphicon glyphicon-edit"></span></a>

                                    	<form action="{{route('costs.destroy',$cost->id)}}" method="post" style="display: none;" id="delete-form-{{$cost->id}}">
                                            @csrf
                                            {{method_field('DELETE')}}
                                        </form>
                                        <a class="btn btn-sm bg-red" href="" onclick="if(confirm('Are You Sure To Delete?')){
                                            event.preventDefault();
                                            getElementById('delete-form-{{$cost->id}}').submit();
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