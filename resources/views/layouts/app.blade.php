<!DOCTYPE html>
<html lang="en">
<head>
	@include('layouts.head')
</head>
<body class="hold-transition skin-blue sidebar-mini @if(Request::path() === 'admin/purchases/create' || Request::path() === 'admin/sales/create') {{'sidebar-collapse'}} @endif">
<div class="wrapper">
	@include('layouts.header')
	@include('layouts.sidebar')
    
    @section('content')
      @show

	@include('layouts.footer')
</div>
	
</body>
</html>