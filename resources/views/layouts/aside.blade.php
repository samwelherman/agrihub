<div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href=""> 
<?php
//$settings= App\Models\System::first();
?>
<img alt="image"src="{{url('public/assets/img/logo')}}/" class="header-logo" /> <span
                class="logo-name"></span>
            </a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown {{  request()->is('/dashboard') ? 'active' : '' }}">
            <a href=""><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
            </li>
             <li class="dropdown">
          <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>Farmer</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{url('farmer/')}}">Manage Farmer</a></li>
            <li><a class="nav-link" href="{{url('manage-group')}}">Manage Goup</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>Farmer Asset</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{url('land')}}">Manage land asset</a></li>
            <li><a class="nav-link" href="portfolio.html">Manage other assets</a></li>
      
      </ul>
            </li>
            
         <li class="dropdown">
         
          <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>{{__('farming.farming')}}</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{url('register_assets')}}">Farmer Assets</a></li>
            <li><a class="nav-link" href="{{url('farming_cost')}}">Farming Cost</a></li>
            <li><a class="nav-link" href="{{url('cost_centre')}}">Cost Centre</a></li>
            <li><a class="nav-link" href="{{url('farming_process')}}">Farming Process</a></li>
              <li><a class="nav-link" href="{{url('crops_monitoring')}}">Crops Monitoring</a></li>
          </ul>
            
         </li>
         <li class="dropdown">
         
         <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>{{__('ordering.orders')}}</span></a>
         <ul class="dropdown-menu">
           <li><a class="nav-link" href="{{url('orders')}}">{{__('ordering.order_list')}}</a></li>
           <li><a class="nav-link" href="{{url('farming_cost')}}">Farming Cost</a></li>
           <li><a class="nav-link" href="{{url('cost_centre')}}">Cost Centre</a></li>
           <li><a class="nav-link" href="{{url('farming_process')}}">Farming Process</a></li>
             <li><a class="nav-link" href="{{url('crops_monitoring')}}">Crops Monitoring</a></li>
         </ul>
           
        </li>
         <li><a class="nav-link" href="{{url('warehouse')}}"><i data-feather="command"></i>Warehouse</a></li>

            
            
        <li class="dropdown">
          <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>Shop</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{url('manage/supplier')}}">Manage Supplier</a></li>
            <li><a class="nav-link" href="{{url('items')}}">Manage Product/Items</a></li>

            <li><a class="nav-link" href="{{url('purchase')}}">Purchase</a></li>
            <li><a class="nav-link" href="{{('sales')}}">sales</a></li>
           
          </ul>
        </li>
 
 
          
         
            <li class="dropdown{{ request()->is('setting/*') ? 'active' : '' }}">
            <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>Access Control</span></a>
              <ul class="dropdown-menu">

                    <li class="{{ request()->is('setting/roleGroup') ? 'active' : '' }}"><a  class="nav-link" href="{{url('roles')}}">
                            Roles</a>
                    </li>

                  

                   
                    <li class="{{ request()->is('setting/roleGroup') ? 'active' :''}} "><a class="nav-link"
                            href="{{ url('permissions')}}">Permissions</a>

                    </li>
                
                  
                
                    <li class=""><a class="nav-link"
                            href="{{ url('system')}}">System Settings</a>

                    </li>
                 

                    <li class="{{ request()->is('users') ? 'active' : '' }}"><a class="nav-link"  href="{{url('users')}}">User
                            Management</a></li>

                            <li class="{{ request()->is('clients') ? 'active' : '' }}"><a class="nav-link" href="{{ url('clients')}}">Registered clients
                            </a></li>
                   
                </ul>
            </li>
        
           
        </aside>
      </div>