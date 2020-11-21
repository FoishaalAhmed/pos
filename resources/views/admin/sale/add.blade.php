@extends('layouts.app')
@section('title', 'New sale add')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Dashboard
            <small>Version 2.0</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('sales.index')}}"><i class="fa fa-group"></i> sales</a></li>
            <li class="active">New sale</li>
        </ol>
    </section>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Content Header (sale header) -->
                <div class="box box-6a8d9d box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">New sale</h3>
                        <div class="box-tools pull-right">
                            <a href="{{route('sales.index')}}" class="btn btn-sm bg-purple"><i class="fa fa-list"></i> sale list</a>
                        </div>      
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <br>
                        @include('includes.errormessage')
                        <form action="{{route('sales.store')}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for="">Date</label>
                                            <input type="text" name="date" class="form-control" id="date" placeholder="sale date" required="" value="{{date('d-m-Y')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for="">Invoice</label>
                                            <input type="text" name="invoice" class="form-control" id="invoice" placeholder="sale invoice" value="{{date('Y-m-d-H-i-s')}}" readonly="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for="">User</label>
                                            <select name="user_id" id="" class="form-control select2" style="width: 100%">
                                                <option value="">Select User</option>
                                                @foreach ($users as $key => $user)
                                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <input type="radio" id="other" name="supplier" value="old" checked="">
                                            <label for="other">Old Customer</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-md-12">

                                            <input type="radio" id="other2" name="supplier" value="new">
                                            <label for="other2">New Customer</label>
                                        </div>
                                    </div>
                                </div>
                                <div id="new-supplier" style="display: none;">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label for="">Name</label>
                                                <input type="text" name="name" class="form-control" id="name" placeholder="name" value="{{old('name')}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label for="">Phone</label>
                                                <input type="text" name="phone" class="form-control" id="phone" placeholder="name" value="{{old('phone')}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="old-supplier">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label for="">Customer</label>
                                                <select name="customer_id" id="customer_id" class="form-control select2" style="width: 100%" required="">
                                                    <option value="">Select customer</option>
                                                    @foreach ($customers as $key => $customer)
                                                        <option value="{{$customer->id}}">{{$customer->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for="">Note</label>
                                            <input type="text" name="note" class="form-control" placeholder="Note" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4" id="false-div" style="visibility: hidden;">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for="">Note</label>
                                            <input type="text" class="form-control" placeholder="Note" >
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">

                                <div class="form-group table-responsive">

                                    <table class="table" style="width: 100%;">

                                        <thead>
                                            <tr>
                                                <th style="width: 20%;">Product code</th>

                                                <th style="width: 40%;">Product name</th>

                                                <th style="width: 10%;">Quantity</th>

                                                <th style="width: 15%;">Price</th>

                                                <th style="width: 15%;">Total</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            <input type="hidden" name="showrowid" id="showrowid" value="4">
                                            <?php
                                            
                                            // 61 is the max limit, change to javascript also from botom of the code.

                                            for ($i=1; $i < 11 ; $i++) { ?>
                                                <tr id="trid<?= $i; ?>" style="<?php if($i > 3) echo 'display: none'; ?>">

                                                    <td>

                                                        <input type="text" class="form-control" name="code[]" id="code<?= $i; ?>" placeholder="product code"  onfocusout="getProductDetails(<?= $i; ?>)">

                                                    </td>

                                                    <td>

                                                        <input type="text" class="form-control" id="name<?= $i; ?>" placeholder="product name">

                                                        <input type="hidden" class="form-control" id="product_id<?= $i; ?>" placeholder="product name" name="product_id[]">

                                                    </td>

                                                    <td>

                                                        <input type="number" class="form-control" name="quantity[]" value="1" id="quantity<?= $i; ?>" placeholder="quantity" onchange="amountShow(<?= $i; ?>)">

                                                    </td>

                                                    <td>

                                                        <input type="number" step="0.01" class="form-control" name="rate[]" value="0" id="rate<?= $i; ?>" min="0" placeholder="rate" onchange="amountShow(<?= $i; ?>)">

                                                    </td>

                                                    <td>

                                                        <input type="number" step="0.01" class="form-control" name="price[]" value="0" id="total<?= $i; ?>" min="0" placeholder="total" readonly>

                                                    </td>

                                                </tr>

                                            <?php } ?>

                                            <tr>
                                                <td colspan="4" style="text-align: right; font-size: 18px; font-weight: bold;"> Subtotal</td>
                                                <td>
                                                    <input type="text" readonly id="total_amount_id" name="subtotal">
                                                </td>
                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            </div>
                            </div>
                            <div class="col-md-12">
                                <div class="box box-primary box-solid">
                                    <div class="box-body box-profile">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="">Transport/Labour Cost</label>
                                                    <input type="text" name="extra_cost" class="form-control" id="extra_cost" placeholder="Transport/Labour Cost" value="0" onkeyup="amountShow();">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="" style="margin-left: 15px;">Vat</label>
                                                    <br>
                                                    <div class="col-md-4">
                                                        <input type="text" name="vat_percentage" class="form-control" id="vat_percentage" placeholder="Vat" value="0" onkeyup="amountShow();">
                                                    </div>
                                                    <div class="col-md-2" style="border: 1px solid white; padding: 5px; text-align: center;">%</div>
                                                    <div class="col-md-6">
                                                        <input type="text" name="vat" class="form-control" id="vat" placeholder="Vat" value="0" readonly="">
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="" style="margin-left: 15px;">Discount</label>
                                                    <br>
                                                    <div class="col-md-4">
                                                        <input type="text" name="discount_percentage" class="form-control" id="discount_percentage" placeholder="Discount" value="0" onkeyup="amountShow();">
                                                    </div>
                                                    <div class="col-md-2" style="border: 1px solid white; padding: 5px; text-align: center">%</div>
                                                    <div class="col-md-6">
                                                        <input type="text" name="discount" class="form-control" id="discount" placeholder="Discount" value="0" readonly="">
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="">Total</label>
                                                    <input type="text" name="total" class="form-control" id="net_total" placeholder="Total" value="0" required="" readonly="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="">Paid</label>
                                                    <input type="text" name="paid" class="form-control" id="paid" placeholder="Paid" value="0" required="" onkeyup="amountShow();">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="">Due</label>
                                                    <input type="text" name="due" class="form-control" id="due" placeholder="Due" value="0" required="" readonly="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <center>
                                    <button type="reset" class="btn btn-sm bg-red">Reset</button>
                                    <button type="submit" class="btn btn-sm btn-6a8d9d">Save</button>
                                    <a class="btn btn-info" onclick="makerowvisible();"><i class="fa fa-plus"></i> </a>
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

@section('footerSection')

<script>

    $(function () {
        $('#date').datepicker({
            autoclose:   true,
            changeYear:  true,
            changeMonth: true,
            dateFormat:  "dd-mm-yy",
            yearRange:   "-10:+10"
        });

        $("input[name$='supplier']").click(function() {
            var test = $(this).val();

            if(test == 'new') {
              $("#old-supplier").hide();
              $("#false-div").hide();
              $("#new-supplier").show();
              $("#supplier_id").prop("required", false);
              $("#name").prop("required", true);
              $("#phone").prop("required", true);
            } else {
              $("#old-supplier").show();
              $("#new-supplier").hide(); 
              $("#supplier_id").prop("required", true);              
              $("#name").prop("required", false);
              $("#phone").prop("required", false);
              $("#false-div").show();
            }

        });
    });

    function makerowvisible(){
        
        var nextrownumber = $("#showrowid").val();
        $("#trid"+Number(nextrownumber)).show();
        $("#showrowid").val(Number(nextrownumber)+1);
    }

    function getProductDetails(id) {
        var productCode = $('#code' + id).val();

        var url = '{{route("add.cart")}}';

        $.ajaxSetup({

            headers: {'X-CSRF-Token' : '{{csrf_token()}}'}

        });

        $.ajax({

            url: url,
            method: 'POST',
            data: { 'productCode' : productCode, },

            success: function(data2){

                var data = JSON.parse(data2);
                var quantity = $('#quantity' + id).val();

                var total = data.sell_price * quantity;

                $('#name' + id).val(data.name);
                $('#product_id' + id).val(data.id);
                $('#rate' + id).val(data.sell_price);
                $('#total' + id).val(total);

                var total_amount = 0;

                // same as php for loop from up.

                for(var i = 1; i < 11; i++){

                    var tempamount = $('#total'+i).val(); 
                    total_amount+= Number(tempamount);
                }

                $('#total_amount_id').val(total_amount);

                $('#net_total').val(total_amount);

                //alert(data2);
            },

            error: function(error) {

                console.log(error);
            }


        });
    }

    function amountShow(id) {

        var quantity = $('#quantity' + id).val();
        var rate     = $('#rate' + id).val();
        var total    = quantity * rate ;

        $('#total' + id).val(total);

        var total_amount = 0;

        // same as php for loop from up.

        for(var i = 1; i < 11; i++){

            var tempamount = $('#total'+i).val(); 
            total_amount+= Number(tempamount);
        }

        $('#total_amount_id').val(total_amount);

        var extra_cost     = $('#extra_cost').val();
        var vat_percentage = $('#vat_percentage').val();
        var vat            = (parseInt(total_amount) * parseInt(vat_percentage)) / 100;
        $('#vat').val(vat);

        var discount_percentage = $('#discount_percentage').val();
        var discount            = (parseInt(total_amount) * parseInt(discount_percentage)) / 100;
        $('#discount').val(discount);

        var net_total = (parseInt(total_amount) + parseInt(vat) + parseInt(extra_cost)) - parseInt(discount);
        $('#net_total').val(net_total);
        var paid       = $('#paid').val();
        var due       = parseInt(net_total) - parseInt(paid);

        $('#due').val(due);
    }


</script>
@endsection