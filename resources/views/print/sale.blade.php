

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Sale Invoice Print</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body onload="window.print();">
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-6">
                                <img src="{{ asset('public/images/logo.png') }}" width="150px" height="100px" alt="">
                            </div>
                            <div class="col-6" style="margin-top: 40px; text-align: right;" >
                                <p style="margin: 0px;" >Phone:  01712-198823</p>
                                <p style="margin: 0px;" >College Rd, Gopalganj, Bangladesh</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <hr style="margin: 1px;" >
                        <p style="font-size:25px; font-weight: 900; text-align: center; margin: 0px; " >  Sale Invoice  </p>
                        <hr style="margin: 1px;" >
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="left-side">
                                    <p style="margin-bottom: 1px;">Name : {{$customer->name}}</p>
                                    <p style="margin-bottom: 1px;">Mobile : {{$customer->phone}}</p>
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-4">
                                <div class="right-side" style="margin-top: 20px;" >
                                    <p style="margin-bottom: 1px;">Date : {{date('d M, Y')}}</p>
                                    <p style="margin-bottom: 1px;">Invoice No : {{$sale->invoice}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered">
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
                            @foreach ($sale_details as $detail)
                                <tr>
                                  <td>{{$loop->index + 1}}</td>
                                  <td>{{$detail->product}}</td>
                                  <td>{{$detail->quantity}}</td>
                                  <td>{{$detail->rate}}</td>
                                  <td style="text-align: right;">{{$detail->total}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-6" style="margin-top: 5px;" >
                            
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-4">
                                            <p style="margin: 0px;" >sub-total </p>
                                        </div>
                                        <div class="col-2">
                                            <p style="margin: 0px;" >=</p>
                                        </div>
                                        <div class="col-6" style="text-align: right;">
                                            <p style="margin: 0px;" >{{$sale->subtotal}} ৳</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-4">
                                            <p style="margin: 0px;" >Vat ({{$sale->vat_percentage}}%) </p>
                                            <p style="margin: 0px;" >Discount ({{$sale->discount_percentage}}%)</p>
                                        </div>
                                        <div class="col-2">
                                            <p style="margin: 0px;" >=</p>
                                            <p style="margin: 0px;" >=</p>
                                        </div>
                                        <div class="col-6" style="text-align: right;">
                                            <p style="margin: 0px;" >{{$sale->vat}} ৳</p>
                                            <p style="margin: 0px;" >{{$sale->discount}} ৳</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-4">
                                            <p style="margin: 0px;" >Total Amount  </p>
                                        </div>
                                        <div class="col-2">
                                            <p style="margin: 0px;" >=</p>
                                        </div>
                                        <div class="col-6" style="text-align: right;">
                                            <p style="margin: 0px;" >{{$sale->total}} ৳</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-4">
                                            <p style="margin: 0px;" >Recive Amount</p>
                                        </div>
                                        <div class="col-2">
                                            <p style="margin: 0px;" >=</p>
                                        </div>
                                        <div class="col-6" style="text-align: right;">
                                            <p style="margin: 0px;" >{{$sale_payment->total_paid}} ৳</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-4">
                                            <p style="margin: 0px;" >Due Amount</p>
                                        </div>
                                        <div class="col-2">
                                            <p style="margin: 0px;" >=</p>
                                        </div>
                                        <div class="col-6" style="text-align: right;">
                                            <p style="margin: 0px;" >{{$sale->total - $sale_payment->total_paid}} ৳</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container" style="margin-top: 50px;">
            <div class="border" style="height: 3px solid black;" ></div>
            <div class="row">
                <div class="col-12" style="text-align: center; margin-top: 100px; " >
                    <p style="font-size: 10px;" > © Copyright by <span style="font-size: 10px;text-decoration: none; color: tomato;"><a href="#" style="font-size: 10px;text-decoration: none; color: tomato;"> APON_GHAR </a></span></p>
                    <p style="font-size: 10px;" >© Design And Developed By ICT Bangla Bd</p>
                </div>
            </div>
        </div>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>

