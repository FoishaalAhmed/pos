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
            <li><a href="{{route('sales.index')}}"><i class="fa fa-group"></i> Sales</a></li>
            <li class="active">New sale</li>
        </ol>
    </section>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Content Header (sale header) -->
                <div class="box box-purple box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">New sale</h3>
                        <div class="box-tools pull-right">
                        	<a href="{{route('sales.index')}}" class="btn btn-sm bg-green"><i class="fa fa-list"></i> Sale list</a>
                        </div>		
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <br>
                    	@include('includes.errormessage')
                    	<form action="{{route('sales.store')}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                    		@csrf
                            <div class="col-md-9">
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
                                            <select name="user_id" id="" class="form-control select2" style="width: 100%" required="">
                                                <option value="">Select User</option>
                                                @foreach ($users as $key => $user)
                                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for="">Customer</label>
                                            <select name="customer_id" id="" class="form-control select2" style="width: 100%" required="">
                                                <option value="">Select customer</option>
                                                @foreach ($customers as $key => $customer)
                                                    <option value="{{$customer->id}}">{{$customer->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for="">Note</label>
                                            <input type="text" name="note" class="form-control" placeholder="Note" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for="">Product</label>
                                            <select id="product_id" class="form-control select2" style="width: 100%" required="">
                                                <option value="">Select Products</option>
                                                @foreach ($products as $product)
                                                    <option value="{{$product->id}}">{{$product->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for="">Quantity</label>
                                            <input type="number" class="form-control" id="quantity" placeholder="sale quantity" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for="">Rate</label>
                                            <input type="text" class="form-control" id="rate" placeholder="sale rate" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for="">Total</label>
                                            <input type="text" class="form-control" id="total" placeholder="sale total" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for=""><br></label>
                                            <button class="btn btn-sm bg-purple form-control" type="button" id="addToCart">Add</button>
                                        </div>
                                    </div>
                                </div>
                                <div id="table"></div>
                            </div>
                            <div class="col-md-3">
                                <div class="box box-primary box-solid">
                                    <div class="box-body box-profile">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label for="">Transport/Labour Cost</label>
                                                <input type="text" name="extra_cost" class="form-control" id="extra_cost" placeholder="Transport/Labour Cost" value="0" onkeyup="calculateTotal();">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label for="">Vat</label>
                                                <br>
                                                <div class="col-md-4">
                                                    <input type="text" name="vat_percentage" class="form-control" id="vat_percentage" placeholder="Vat" value="0" onkeyup="calculateTotal();">
                                                </div>
                                                <div class="col-md-2" style="border: 1px solid white; padding: 5px; text-align: center;">%</div>
                                                <div class="col-md-6">
                                                    <input type="text" name="vat" class="form-control" id="vat" placeholder="Vat" value="0" readonly="">
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label for="">Discount</label>
                                                <br>
                                                <div class="col-md-4">
                                                    <input type="text" name="discount_percentage" class="form-control" id="discount_percentage" placeholder="Discount" value="0" onkeyup="calculateTotal();">
                                                </div>
                                                <div class="col-md-2" style="border: 1px solid white; padding: 5px; text-align: center">%</div>
                                                <div class="col-md-6">
                                                    <input type="text" name="discount" class="form-control" id="discount" placeholder="Discount" value="0" readonly="">
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label for="">Total</label>
                                                <input type="text" name="total" class="form-control" id="net_total" placeholder="Total" value="0" required="" readonly="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label for="">Paid</label>
                                                <input type="text" name="paid" class="form-control" id="paid" placeholder="Paid" value="0" required="" onkeyup="calculateTotal();">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label for="">Due</label>
                                                <input type="text" name="due" class="form-control" id="due" placeholder="Due" value="0" required="" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
	                        <div class="col-md-12">
	                        	<center>
	                        		<button type="reset" class="btn btn-sm bg-red">Reset</button>
	                        		<button type="submit" class="btn btn-sm bg-purple">Save</button>
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
    $('#addToCart').click(function(){

        var product_id = $('#product_id').val();
        var quantity   = $('#quantity').val();
        var rate       = $('#rate').val();
        var total      = $('#total').val();

        var url = '{{route("add.cart")}}';

        $.ajaxSetup({

            headers: {'X-CSRF-Token' : '{{csrf_token()}}'}

        });

        $.ajax({

            url: url,
            method: 'POST',
            data: {

                'product_id' : product_id,
                'quantity'   : quantity,
                'rate'       : rate,
                'total'      : total,
            },

            success: function(data){

                $('#table').html(data);    
            },

            error: function(error) {

                console.log(error);
            }


        });
    });

    function calculateTotal() {  

        var url = '{{route("cart.subtotal")}}';

        $.ajaxSetup({

            headers: {'X-CSRF-Token' : '{{csrf_token()}}'}

        });

        $.ajax({

            url: url,
            method: 'POST',
            success: function(data){

                var extra_cost     = $('#extra_cost').val();
                var vat_percentage = $('#vat_percentage').val();
                var subtotal       = data;
                var subtotal2      = subtotal.replace(',', '');
                var vat            = parseInt(subtotal2) * parseInt(vat_percentage) / 100;

                $('#vat').val(vat);

                var totalWithVat = parseInt(vat) + parseInt(subtotal2);
                var discount_percentage = $('#discount_percentage').val();
                var discount            = parseInt(subtotal2) * parseInt(discount_percentage) / 100;
                $('#discount').val(discount);

                var total = parseInt(totalWithVat) + parseInt(extra_cost) - parseInt(discount);

                $('#net_total').val(total); 

                var paid = $('#paid').val(); 

                var due = parseInt(total) - parseInt(paid);

                $('#due').val(due); 
            },

            error: function(error) {

                console.log(error);
            }


        });
    }

    $(function () {
        $('#date').datepicker({
            autoclose:   true,
            changeYear:  true,
            changeMonth: true,
            dateFormat:  "dd-mm-yy",
            yearRange:   "-10:+10"
        });
    });


</script>
@endsection