<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('public/assets/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->name}}</p>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="@if(Request::path() === '/home') {{'active'}} @endif">
                <a href="{{route('home')}}">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>

            <li class="treeview @if(Request::path() === 'admin/users/create' || Request::path() === 'admin/users' || request()->is('admin/users/*/edit')) {{'active'}} @endif">
                <a href="#">
                <i class="fa fa-users"></i> <span>Users</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li class="@if(Request::path() === 'admin/users/create') {{'active'}} @endif"><a href="{{route('users.create')}}"><i class="fa fa-plus"></i> Add User</a></li>
                    <li class="@if(Request::path() === 'admin/users') {{'active'}} @endif"><a href="{{route('users.index')}}"><i class="fa fa-list"></i> View User</a></li>
                </ul>
            </li>

            <li class="treeview @if(Request::path() === 'admin/purchases/create' || Request::path() === 'admin/purchases' || Request::path() === 'admin/purchase-payments/create' || Request::path() === 'admin/purchase-payments' || Request::path() === 'admin/purchase-returns' || request()->is('admin/purchases/*')  || request()->is('admin/purchase-returns/*') || request()->is('admin/purchase-payments/*/edit')) {{'active'}} @endif">
                <a href="#">
                <i class="fa fa-shopping-cart"></i> <span>Purchases</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li class="@if(Request::path() === 'admin/purchases/create') {{'active'}} @endif"><a href="{{route('purchases.create')}}"><i class="fa fa-plus"></i> New Purchase</a></li>
                    <li class="@if(Request::path() === 'admin/purchases') {{'active'}} @endif"><a href="{{route('purchases.index')}}"><i class="fa fa-list"></i> View Purchase</a></li>
                    <li class="@if(Request::path() === 'admin/purchase-payments/create') {{'active'}} @endif"><a href="{{route('purchase-payments.create')}}"><i class="fa fa-plus"></i> New Purchase payment</a></li>
                    <li class="@if(Request::path() === 'admin/purchase-payments') {{'active'}} @endif"><a href="{{route('purchase-payments.index')}}"><i class="fa fa-list"></i> View Purchase payment</a></li>
                    <li class="@if(Request::path() === 'admin/purchase-returns') {{'active'}} @endif"><a href="{{URL::to('admin/purchase-returns')}}"><i class="fa fa-undo"></i> View Purchase return</a></li>
                </ul>
            </li>

            <li class="treeview @if(Request::path() === 'admin/sales/create' || Request::path() === 'admin/sales' || Request::path() === 'admin/sale-payments/create' || Request::path() === 'admin/sale-payments' || Request::path() === 'admin/sale-returns' || request()->is('admin/sale-returns/*') || request()->is('admin/sales/*') || request()->is('admin/sale-payments/*/edit')) {{'active'}} @endif">
                <a href="#">
                <i class="fa fa-exchange"></i> <span>sales</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li class="@if(Request::path() === 'admin/sales/create') {{'active'}} @endif"><a href="{{route('sales.create')}}"><i class="fa fa-plus"></i> New Sale</a></li>
                    <li class="@if(Request::path() === 'admin/sales') {{'active'}} @endif"><a href="{{route('sales.index')}}"><i class="fa fa-list"></i> View Sale</a></li>
                    <li class="@if(Request::path() === 'admin/sale-payments/create') {{'active'}} @endif"><a href="{{route('sale-payments.create')}}"><i class="fa fa-plus"></i> New Sale payment</a></li>
                    <li class="@if(Request::path() === 'admin/sale-payments') {{'active'}} @endif"><a href="{{route('sale-payments.index')}}"><i class="fa fa-list"></i> View Sale payment</a></li>

                    <li class="@if(Request::path() === 'admin/sale-returns') {{'active'}} @endif"><a href="{{URL::to('admin/sale-returns')}}"><i class="fa fa-undo"></i> View sale return</a></li>
                </ul>
            </li>

            <li class="treeview @if(Request::path() === 'admin/customers/create' || Request::path() === 'admin/customers' || request()->is('admin/customers/*/edit')) {{'active'}} @endif">
                <a href="#">
                <i class="fa fa-user"></i> <span>Customers</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li class="@if(Request::path() === 'admin/customers/create') {{'active'}} @endif"><a href="{{route('customers.create')}}"><i class="fa fa-plus"></i> Add Customer</a></li>
                    <li class="@if(Request::path() === 'admin/customers') {{'active'}} @endif"><a href="{{route('customers.index')}}"><i class="fa fa-list"></i> View Customer</a></li>
                </ul>
            </li>

            <li class="treeview @if(Request::path() === 'admin/suppliers/create' || Request::path() === 'admin/suppliers' || request()->is('admin/suppliers/*/edit')) {{'active'}} @endif">
                <a href="#">
                <i class="fa fa-user"></i> <span>Suppliers</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li class="@if(Request::path() === 'admin/suppliers/create') {{'active'}} @endif"><a href="{{route('suppliers.create')}}"><i class="fa fa-plus"></i> Add Supplier</a></li>
                    <li class="@if(Request::path() === 'admin/suppliers') {{'active'}} @endif"><a href="{{route('suppliers.index')}}"><i class="fa fa-list"></i> View Supplier</a></li>
                </ul>
            </li>

            <li class="treeview @if(Request::path() === 'admin/products/create' || Request::path() === 'admin/products' || Request::path() === 'admin/categories' || Request::path() === 'admin/stocks' || Request::path() === 'admin/units' || request()->is('admin/products/*/edit')) {{'active'}} @endif">
                <a href="#">
                <i class="fa fa-product-hunt"></i> <span>Products</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li class="@if(Request::path() === 'admin/products/create') {{'active'}} @endif"><a href="{{route('products.create')}}"><i class="fa fa-plus"></i> Add Product</a></li>

                    <li class="@if(Request::path() === 'admin/products') {{'active'}} @endif"><a href="{{route('products.index')}}"><i class="fa fa-list"></i> View Product</a></li>

                    <li class="@if(Request::path() === 'admin/categories') {{'active'}} @endif"><a href="{{route('categories.index')}}"><i class="fa fa-tag"></i> <span>Categories</span></a></li>

                    <li class="@if(Request::path() === 'admin/units') {{'active'}} @endif"><a href="{{route('units.index')}}"><i class="fa fa-balance-scale"></i> <span>Units</span></a></li>
                    <li class="@if(Request::path() === 'admin/stocks') {{'active'}} @endif"><a href="{{route('product.stock')}}"><i class="fa fa-server"></i> <span>Stocks</span></a></li>
                </ul>
            </li>

            
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>