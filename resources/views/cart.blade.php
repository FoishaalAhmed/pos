
<table id="example1" class="table table-bordered table-striped table_th_teal">
    <thead>
        <tr>
            <th style="width: 5%;">Sl.</th>
            <th style="width: 55%;">Name</th>
            <th style="width: 15%;">Quantity</th>
            <th style="width: 15%;">Rate</th>
            <th style="width: 15%;">Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cart as $key => $value)
        <tr>
            <td>{{$loop->index + 1}}</td>
            <td>{{$value->name}}</td>
            <td>{{$value->qty}}</td>
            <td>{{$value->price}}</td>
            <td>{{$value->total}}</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="4" style="text-align: right;"><b>Subtotal</b></td>
            <td>{{Cart::subtotal()}}</td>
        </tr>
    </tbody>
</table>
