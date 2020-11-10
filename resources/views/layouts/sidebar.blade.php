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
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
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
                    <li class="@if(Request::path() === 'admin/users/create') {{'active'}} @endif"><a href="{{route('users.create')}}"><i class="fa fa-circle-o"></i> Add User</a></li>
                    <li class="@if(Request::path() === 'admin/users') {{'active'}} @endif"><a href="{{route('users.index')}}"><i class="fa fa-circle-o"></i> View User</a></li>
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
                    <li class="@if(Request::path() === 'admin/customers/create') {{'active'}} @endif"><a href="{{route('customers.create')}}"><i class="fa fa-circle-o"></i> Add Customer</a></li>
                    <li class="@if(Request::path() === 'admin/customers') {{'active'}} @endif"><a href="{{route('customers.index')}}"><i class="fa fa-circle-o"></i> View Customer</a></li>
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
                    <li class="@if(Request::path() === 'admin/suppliers/create') {{'active'}} @endif"><a href="{{route('suppliers.create')}}"><i class="fa fa-circle-o"></i> Add Supplier</a></li>
                    <li class="@if(Request::path() === 'admin/suppliers') {{'active'}} @endif"><a href="{{route('suppliers.index')}}"><i class="fa fa-circle-o"></i> View Supplier</a></li>
                </ul>
            </li>

            <li class="@if(Request::path() === 'admin/categories') {{'active'}} @endif">
                <a href="{{route('categories.index')}}">
                <i class="fa fa-tag"></i> <span>Categories</span>
                </a>
            </li>

            <li class="@if(Request::path() === 'admin/units') {{'active'}} @endif">
                <a href="{{route('units.index')}}">
                <i class="fa fa-balance-scale"></i> <span>Units</span>
                </a>
            </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>