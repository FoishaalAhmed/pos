@extends('layouts.app')
@section('title', 'Purchase details')

@section('content')
	<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
            Dashboard
            <small>Version 2.0</small>
        </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('purchases.index')}}"><i class="fa fa-group"></i> Purchases</a></li>
        <li class="active">Purchase Details</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
        	@include('includes.errormessage')
          <h2 class="page-header">
            <i class="fa fa-globe"></i> POS
            <small class="pull-right">Date: {{date('d/m/Y')}}</small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          User
          <address>
            <strong>{{$user_info->name}}</strong><br>
            <strong>Email:</strong> {{$user_info->email}} <br>
            <strong>Phone:</strong> {{$user_info->phone}} <br>
            <strong>Address:</strong> {{$user_info->address}}
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          Supplier
          <address>
            <strong>{{$supplier_info->name}}</strong><br>
            <strong>Email:</strong> {{$supplier_info->email}} <br>
            <strong>Phone:</strong> {{$supplier_info->phone}} <br>
            <strong>Address:</strong> {{$supplier_info->address}} <br>
            <strong>Company:</strong> {{$supplier_info->company}} <br>
            <strong>Company phone:</strong> {{$supplier_info->company_phone}}
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Invoice #{{$purchase->invoice}}</b><br>
          <br>
          <b>Purchase ID:</b> {{date('Y', strtotime($purchase->date))}}{{$purchase->id}}
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
	            <tr>
	              <th>Serial #</th>
	              <th>Product</th>
	              <th>Qty</th>
	              <th>Rate</th>
	              <th>Total</th>
	            </tr>
            </thead>
            <tbody>
            	@foreach ($purchase_details as $detail)
	            <tr>
	              <td>{{$loop->index + 1}}</td>
	              <td>{{$detail->product}}</td>
	              <td>{{$detail->quantity}}</td>
	              <td>{{$detail->rate}}</td>
	              <td>{{$detail->total}}</td>
	            </tr>
	            @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-9">
          <p class="lead">Payment</p>
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">List</a></li>
              <li><a href="#settings" data-toggle="tab">New payment</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <!-- Post -->
                <table class="table table-striped">
		            <thead>
			            <tr>
			              <th>Serial #</th>
			              <th>Date</th>
			              <th>Paid</th>
			              <th>Due</th>
			            </tr>
		            </thead>
		            <tbody>
		            	@foreach ($purchase_payment as $payment)
			            <tr>
			              <td>{{$loop->index + 1}}</td>
			              <td>{{date('d M, Y', strtotime($payment->date))}}</td>
			              <td>{{$payment->paid}}</td>
			              <td>{{$payment->due}}</td>
			            </tr>
			            @endforeach
		            </tbody>
		        </table>
                <!-- /.post -->
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="settings">
                <form class="form-horizontal" method="post" action="{{route('purchase-payments.store')}}">
                	@csrf
                	
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Date</label>

                    <div class="col-sm-10">
                      <input type="text" autocomplete="off" name="date" class="form-control" id="inputDate" placeholder="Date" value="{{date('d-m-Y')}}">
                      <input type="hidden" name="purchase_id" value="{{$purchase->id}}">
                      <input type="hidden" name="user_id" value="{{$purchase->user_id}}">
                      <input type="hidden" name="supplier_id" value="{{$purchase->supplier_id}}">
                      <input type="hidden" name="invoice" value="{{$purchase->invoice}}">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Paid</label>

                    <div class="col-sm-10">
                      <input type="number" class="form-control" name="paid" id="inputPaid" placeholder="Paid">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Due</label>

                    <div class="col-sm-10">
                      <input type="number" class="form-control" name="due" id="inputDue" placeholder="Due">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-3">
          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Subtotal:</th>
                <td>{{$purchase->subtotal}}</td>
              </tr>
              <tr>
                <th>Tax ({{$purchase->vat_percentage}}%)</th>
                <td>{{$purchase->vat}}</td>
              </tr>
              <tr>
                <th>Discount ({{$purchase->discount_percentage}}%)</th>
                <td>{{$purchase->discount}}</td>
              </tr>
              <tr>
                <th>Total:</th>
                <td>{{$purchase->total}}</td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>
  <!-- /.content-wrapper -->
@endsection

@section('footerSection')

<script>
	 $(function () {
        $('#inputDate').datepicker({
            autoclose:   true,
            changeYear:  true,
            changeMonth: true,
            dateFormat:  "dd-mm-yy",
            yearRange:   "-10:+10"
        });
    });
</script>

@endsection