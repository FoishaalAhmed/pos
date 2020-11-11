@extends('layouts.app')
@section('title', 'Product update')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Dashboard
            <small>Version 2.0</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('products.index')}}"><i class="fa fa-group"></i> Products</a></li>
            <li class="active">Product update</li>
        </ol>
    </section>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Content Header (product header) -->
                <div class="box box-teal box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Product update</h3>
                        <div class="box-tools pull-right">
                            <a href="{{route('products.index')}}" class="btn btn-sm bg-green"><i class="fa fa-list"></i> Product list</a>
                        </div>      
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <br>
                        @include('includes.errormessage')
                        <form action="{{route('products.update', $product->id)}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label col-md-2">Name</label>
                                        <div class="col-sm-10">
                                            <input name="name" placeholder="name" class="form-control" required="" type="text" value="{{ $product->name }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label col-md-2">Category</label>
                                        <div class="col-sm-10">
                                            <select name="category_id" class="form-control select2" style="width: 100%;" id="">
                                                @foreach ($categories as $key => $category)
                                                    <option value="{{$category->id}}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label col-md-2">Buy</label>
                                        <div class="col-sm-10">
                                            <input name="buy_price" placeholder="Buy Price" class="form-control" required="" type="number" value="{{ $product->buy_price }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label col-md-2">Sell</label>
                                        <div class="col-sm-10">
                                            <input name="sell_price" placeholder="Sell Price" class="form-control" required="" type="number" value="{{ $product->sell_price }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label col-md-2">Vat</label>
                                        <div class="col-sm-10">
                                            <input name="vat" placeholder="Vat Percentage" class="form-control" required="" type="text" value="{{ $product->vat }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label col-md-2">Photo</label>
                                        <div class="col-sm-10">
                                            <input type="file" name="photo" onchange="readPicture(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label col-md-1">Description</label>
                                        <div class="col-sm-11">
                                            <textarea name="description" placeholder="Product Description" class="form-control" id="" rows="5">{{ $product->description }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <center>
                                    <img src="{{ asset($product->photo) }}" alt="product Photo" id="product_photo" style="width: 200px; height: 200px;">
                                    <br> <br>
                                    <button type="reset" class="btn btn-sm bg-red">Reset</button>
                                    <button type="submit" class="btn btn-sm bg-teal">Save</button>
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

<script>
    // profile picture change
    function readPicture(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
    
          reader.onload = function (e) {
            $('#product_photo')
            .attr('src', e.target.result)
            .width(200)
            .height(200);
        };
    
        reader.readAsDataURL(input.files[0]);
    }
    }
    
</script>