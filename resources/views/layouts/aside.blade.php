<div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href=""> 
<?php
$settings= App\Models\System::first();
?>
<img alt="image"src="{{url('public/assets/img/logo')}}/{{$settings->picture}}" class="header-logo" /> <span
                class="logo-name"></span>
            </a>
          </div>
          <ul class="sidebar-menu active show">
            @can('view-dashboard')
            <li class="dropdown {{  request()->is('/dashboard') ? 'active' : '' }}">
            <a href=""><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
            </li>
            @endcan
             <li class="dropdown {{  request()->is('farmer/') ? 'active' : '' }} ">
          <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>Farmer</span></a>
          <ul class="dropdown-menu">
            <li class="{{ request()->routeIs('farmer.*')? 'active': ''}} active"><a class="nav-link" href="{{url('farmer/')}}">Manage Farmer</a></li>
            <li><a class="nav-link" href="{{url('manage-group')}}">Manage Goup</a></li>
          </ul>
        </li>

        @can('view-farming') 
         <li class="dropdown">
         
          <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>{{__('farming.farming')}}</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{url('register_assets')}}">{{__('farming.farmer_assets')}}</a></li>
            <li><a class="nav-link" href="{{url('farming_cost')}}">{{__('farming.farming_cost')}}</a></li>
            <li><a class="nav-link" href="{{url('cost_centre')}}">{{__('farming.cost_centre')}}</a></li>
            <li><a class="nav-link" href="{{url('farming_process')}}">{{__('farming.farming_process')}}</a></li>
              <li><a class="nav-link" href="{{url('crops_monitoring')}}">{{__('farming.crop_monitoring')}}</a></li>
              <li><a class="nav-link" href="{{url('seasson')}}">{{__('farming.manage_seasson')}}</a></li>
          </ul>
            
         </li>
         @endcan
        
         <li class="dropdown">
         
         <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>{{__('ordering.orders')}}</span></a>
         <ul class="dropdown-menu">
           <li><a class="nav-link" href="{{url('orders')}}">{{__('ordering.order_list')}}</a></li>
           <li><a class="nav-link" href="{{url('quotationList')}}">{{__('ordering.quotationList')}}</a></li>
           
         </ul>
           
        </li>
        
        @can('view-werehouse')
         <li><a class="nav-link" href="{{url('warehouse')}}"><i data-feather="command"></i>Warehouse</a></li>
         @endcan
            
            
        <li class="dropdown">
          <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>Shop</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{url('manage/supplier')}}">Manage Supplier</a></li>
            <li><a class="nav-link" href="{{url('items')}}">Manage Product/Items</a></li>
            <li><a class="nav-link" href="{{url('purchase')}}">Purchase</a></li>
            <li><a class="nav-link" href="{{('sales')}}">sales</a></li>
           
          </ul>
        </li>
 
 
               
        <li class="dropdown">
          <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>Logistic</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{url('truck')}}">Truck Management </a></li>
            <li><a class="nav-link" href="{{url('driver')}}">Driver Management </a></li>
          </ul>
        </li>

        <li class="dropdown">
          <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>Inventory</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{url('location')}}">Location </a></li>
            <li><a class="nav-link" href="{{url('inventory')}}">Inventory Items</a></li>
            <li><a class="nav-link" href="{{url('fieldstaff')}}">Field Staff</a></li>
            <li><a class="nav-link" href="{{url('purchase_inventory')}}">Purchase Inventory </a></li>
            <li><a class="nav-link" href="{{url('maintainance')}}">Maintainance</a></li>
            <li><a class="nav-link" href="{{url('service')}}">Services </a></li>
            <li><a class="nav-link" href="{{url('good_issue')}}">Good Issue </a></li>
            <li><a class="nav-link" href="{{url('good_return')}}">Good Return</a></li>
            <li><a class="nav-link" href="{{url('good_movement')}}">Good Movement </a></li>
            <li><a class="nav-link" href="{{url('good_reallocation')}}">Good Reallocation</a></li>
            <li><a class="nav-link" href="{{url('good_disposal')}}">Good Disposal </a></li>
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