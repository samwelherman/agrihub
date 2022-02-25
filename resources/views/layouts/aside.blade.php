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
          <a href="#" class="menu-toggle nav-link has-dropdown"><i
              data-feather="briefcase"></i><span>Farmer</span></a>
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
         
          <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>Farming</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{url('register_assets')}}">Farmer Assets</a></li>
            <li><a class="nav-link" href="{{url('farming_cost')}}">Farming Cost</a></li>
            <li><a class="nav-link" href="{{url('cost_centre')}}">Cost Centre</a></li>
            <li><a class="nav-link" href="{{url('farming_process')}}">Farming Process</a></li>
              <li><a class="nav-link" href="{{url('crops_monitoring')}}">Crops Monitoring</a></li>
          </ul>
            
         </li>
         <li><a class="nav-link" href="{{url('warehouse')}}">Warehouse</a></li>

            
            
        <li class="dropdown">
          <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="mail"></i><span>Shop</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{url('manage/supplier')}}">Manage Supplier</a></li>
            <li><a class="nav-link" href="{{url('items')}}">Manage Product/Items</a></li>

            <li><a class="nav-link" href="{{url('purchase')}}">Purchase</a></li>
            <li><a class="nav-link" href="{{('sales')}}">sales</a></li>
           
          </ul>
        </li>
            @can('view-request')
            <li>
                <a href="{{url('pacel/pacel')}}"><i class="fa fa-truck"></i> <span class="nav-label">Quotation</span></a>
            </li>
            @endcan
            @can('view-pacel')
            <li>
                <a href="{{url('invoice2')}}"><i class="fa fa-truck"></i> <span class="nav-label">Manage Invoice</span></a>
            </li>
            @endcan

            @can('view-collection')
            <li>
                <a href="{{url('pacel/collection')}}"><i class="fa fa-truck"></i> <span class="nav-label">Pacel Collection</span></a>
            </li>
            @endcan
            @can('view-loading')
            <li>
                <a href="{{url('loading')}}"><i class="fa fa-truck"></i> <span class="nav-label">Pacel Loading</span></a>
            </li>
            @endcan
            @can('view-offloading')
            <li>
                <a href="{{url('pacel/offloading')}}"><i class="fa fa-truck"></i> <span class="nav-label">Pacel OffLoading</span></a>

            </li>
            @endcan
            
            @can('view-derivering')
            <li>
                <a href="{{url('pacel/deriver')}}"><i class="fa fa-truck"></i> <span class="nav-label">Pacel delivering</span></a>
            </li>
            @endcan
            @can('view-activity')
            <li>
                <a href="{{url('pacel/activity')}}"><i class="fa fa-truck"></i> <span class="nav-label">Track All Activity</span></a>
            </li>
            @endcan
            @can('view-route')
            <li>
                <a href="{{url('route')}}"><i class="fa fa-truck"></i> <span class="nav-label">Create Route</span></a>
            </li>
            @endcan
             @can('view-price')
            <li>
                <a href="{{url('price')}}"><i class="fa fa-truck"></i> <span class="nav-label">Create Items</span></a>
            </li>
            @endcan
            @can('view-report')
            <li>
                <a href="{{url('report')}}"><i class="fa fa-truck"></i> <span class="nav-label">Uplift Report</span></a>
            </li>
            @endcan

                @can('view-report')
            <li class="dropdown{{ request()->is('accounting/*') ? 'active' : '' }}">
            <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>Transactions</span></a>
              <ul class="dropdown-menu">

                    <li class=""><a  class="nav-link" href="{{ url('deposit') }}">Deposit</a></li>
                    <li class=" "><a class="nav-link" href="{{ url('expenses') }}">Expenses</a></li>

                                            
                </ul>
            </li>
          @endcan 

             @can('view-report')
            <li class="dropdown{{ request()->is('accounting/*') ? 'active' : '' }}">
            <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>GL SETUP</span></a>
              <ul class="dropdown-menu">

                    <li class=""><a  class="nav-link" href="{{ url('class_account') }}">Class Account </a></li>
                    <li class=" "><a class="nav-link" href="{{ url('group_account') }}">Group Account</a></li>
                    <li class=""><a class="nav-link"  href="{{ url('account_codes') }}">Account Codes</a></li>
                  <li class=""><a class="nav-link"  href="{{ url('chart_of_account') }}">Chart of Accounts </a></li>
                                            
                </ul>
            </li>
          @endcan 

              @can('view-report')
           <li class="dropdown{{ request()->is('accounting/*') ? 'active' : '' }}">
            <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>Accounting</span></a>
              <ul class="dropdown-menu">

                    <li class=""><a  class="nav-link" href="{{ url('accounting/manual_entry') }}">Journal Entry</a></li>
                    <li class=" "><a class="nav-link"href="{{ url('accounting/journal') }}">Journal Entry Report</a></li>
                    <li class=""><a class="nav-link"  href="{{ url('accounting/ledger') }}">Ledger</a></li>
                  <li class=""><a class="nav-link" href="{{url('financial_report/trial_balance')}}">Trial Balance  </a></li>
                     <li class=""><a class="nav-link"  href="{{url('financial_report/income_statement')}}">Income Statement</a></li>
                  <li class=""><a class="nav-link"  href="{{url('financial_report/balance_sheet')}}">Balance Sheet </a></li>
                                             
                </ul>
            </li>
           @endcan 

 
          
         
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