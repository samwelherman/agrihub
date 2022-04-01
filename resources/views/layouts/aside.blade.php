<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="">
                <?php
$settings= App\Models\System::first();
?>
                <img alt="image" src="{{url('public/assets/img/logo')}}/{{$settings->picture}}" class="header-logo" />
                <span class="logo-name"></span>
            </a>
        </div>
        <ul class="sidebar-menu active show">
            @can('manage-dashboard')
            <li class="dropdown {{  request()->is('/dashboard') ? 'active' : '' }}">
                <a href=""><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
            </li>
            @endcan
            @can('manage-farmer')
            <li class="dropdown {{  request()->is('farmer/') ? 'active' : '' }} ">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="command"></i><span>{{__('farmer.farmer')}}</span></a>
                <ul class="dropdown-menu">
                    @can('view-farmer')
                    <li class="{{ request()->routeIs('farmer.*')? 'active': ''}} active"><a class="nav-link"
                            href="{{url('farmer/')}}">{{__('farmer.manage_farmer')}}</a></li>
                    @endcan
                    @can('view-group')
                    <li><a class="nav-link" href="{{url('manage-group')}}">{{__('farmer.manage_group')}}</a></li>
                    @endcan
                </ul>
            </li>
            @endcan

            @can('manage-farming')
            <li class="dropdown">

                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="command"></i><span>{{__('farming.farming')}}</span></a>
                <ul class="dropdown-menu">
                    @can('view-farmer-assets')
                    <li><a class="nav-link" href="{{url('register_assets')}}">{{__('farming.farmer_assets')}}</a></li>
                    @endcan
                    @can('view-farming-cost')
                    <li><a class="nav-link" href="{{url('farming_cost')}}">{{__('farming.farming_cost')}}</a></li> 
                    @endcan
                    @can('view-cost-centre')
                    <li><a class="nav-link" href="{{url('cost_centre')}}">{{__('farming.cost_centre')}}</a></li>
                    @endcan
                    @can('view-farming-process')
                    <li><a class="nav-link" href="{{url('farming_process')}}">{{__('farming.farming_process')}}</a></li>
                    @endcan
                    @can('view-crop-monitoring')
                    <li><a class="nav-link" href="{{url('crops_monitoring')}}">{{__('farming.crop_monitoring')}}</a>
                    </li>
                    @endcan
                    @can('view-manage_seasson')
                    <li><a class="nav-link" href="{{url('seasson')}}">{{__('farming.manage_seasson')}}</a></li>
                    @endcan
                </ul>

            </li>
            @endcan

            @can('manage-farming')
            @endcan
            
            @can('manage-orders')
            <li class="dropdown">

                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="command"></i><span>{{__('ordering.orders')}}</span></a>
                <ul class="dropdown-menu">
                    @can('view-order_list')
                    <li><a class="nav-link" href="{{url('orders')}}">{{__('ordering.order_list')}}</a></li>
                    @endcan
                    @can('view-quotation-list')
                    <li><a class="nav-link" href="{{url('quotationList')}}">{{__('ordering.quotationList')}}</a></li>
                    @endcan
                     <li><a class="nav-link" href="{{url('crops_order')}}">Create Order</a></li>

                </ul>

            </li>
            @endcan

            @can('manage-logistic-orders')
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="command"></i><span>Parcel Management</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{url('pacel_list')}}">Item List</a></li>
                    <li><a class="nav-link" href="{{url('pacel_quotation')}}">Quotation</a></li>                   
                    <li><a class="nav-link" href="{{url('pacel_invoice')}}">Invoice</a></li>
                </ul>
            </li>
            @endcan

            @can('manage-logistic-orders')
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="command"></i><span>Logistic Tracking</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{url('collection')}}"> Collection</a></li>
                    <li><a class="nav-link" href="{{url('loading')}}"> Loading</a></li>
                    <li><a class="nav-link" href="{{url('offloading')}}"> Offloading</a></li>
                    <li><a class="nav-link" href="{{url('delivering')}}">Delivery</a></li>
                    <li><a class="nav-link" href="{{url('activity')}}">Track Logistic Activity</a></li>
                    
                </ul>
            </li>
            @endcan

            @can('manage-warehouse')
            <li><a class="nav-link" href="{{url('warehouse')}}"><i data-feather="command"></i>Warehouse</a></li>
            @endcan

            @can('manage-logistic')
            <li><a class="nav-link" href="{{url('routes')}}"><i data-feather="command"></i>Routes</a></li>
            @endcan

            @can('manage-shop')
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="command"></i><span>{{__('shop.shop')}}</span></a>
                <ul class="dropdown-menu">
                    @can('view-supplier')
                    <li><a class="nav-link" href="{{url('manage/supplier')}}">{{__('shop.manage_supplier')}}</a></li>
                    @endcan
                    @can('view-product')
                    <li><a class="nav-link" href="{{url('items')}}">{{__('shop.manage_product')}}</a></li>
                    @endcan
                    @can('view-purchase')
                    <li><a class="nav-link" href="{{url('purchase')}}">{{__('shop.purchase')}}</a></li>
                    @endcan
                    @can('view-sales')
                    <li><a class="nav-link" href="{{('sales')}}">{{__('shop.sales')}}</a></li>
                    @endcan

                </ul>
            </li>
            @endcan

            @can('manage-logistic')
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="command"></i><span>Logistic</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{url('truck')}}">Truck Management</a></li>
                    <li><a class="nav-link" href="{{url('driver')}}">Driver Management</a></li>
                </ul>
            </li>
            @endcan

            @can('manage-logistic')
            <li><a class="nav-link" href="{{url('fuel')}}"><i data-feather="command"></i>Fuel Control</a></li>
           
            @endcan

            @can('manage-inventory')
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="command"></i><span>Tyre Management</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{url('tyre_brand')}}">Tyre Brand</a></li>
                    <li><a class="nav-link" href="{{url('purchase_tyre')}}">Purchase Tyre</a></li>
                    <li><a class="nav-link" href="{{url('tyre_list')}}">Tyre List</a></li>
                    <li><a class="nav-link" href="{{url('assign_truck')}}">Assign Truck</a></li>
                    <li><a class="nav-link" href="{{url('tyre_return')}}">Good Return</a></li>
                    <li><a class="nav-link" href="{{url('tyre_reallocation')}}">Good Reallocation</a></li>
                    <li><a class="nav-link" href="{{url('tyre_disposal')}}">Good Disposal</a></li>
                </ul>
            </li>
            @endcan

            
            @can('manage-inventory')
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="command"></i><span>Inventory</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{url('location')}}">Location</a></li>
                    <li><a class="nav-link" href="{{url('inventory')}}">Inventory Items</a></li>
                    <li><a class="nav-link" href="{{url('fieldstaff')}}">Field Staff</a></li>
                    <li><a class="nav-link" href="{{url('purchase_inventory')}}">Purchase Inventory</a></li>
                    <li><a class="nav-link" href="{{url('maintainance')}}">Maintainance</a></li>
                    <li><a class="nav-link" href="{{url('service')}}">Service</a></li>
                    <li><a class="nav-link" href="{{url('good_issue')}}">Good Issue</a></li>
                    <li><a class="nav-link" href="{{url('good_return')}}">Good Return</a></li>
                    <li><a class="nav-link" href="{{url('good_movement')}}">Good Movement</a></li>
                    <li><a class="nav-link" href="{{url('good_reallocation')}}">Good Reallocation</a></li>
                    <li><a class="nav-link" href="{{url('good_disposal')}}">Good Disposal</a></li>
                </ul>
            </li>
            @endcan

            @can('manage-access-control')
            <li class="dropdown{{ request()->is('setting/*') ? 'active' : '' }}">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="command"></i><span>{{__('permission.access_control')}}</span></a>
                <ul class="dropdown-menu">
                    @can('view-roles')
                    <li class="{{ request()->is('setting/roleGroup') ? 'active' : '' }}"><a class="nav-link"
                            href="{{url('roles')}}">
                            {{__('permission.roles')}}</a>
                    </li>
                    @endcan
                    @can('view-permission')
                    <li class="{{ request()->is('setting/roleGroup') ? 'active' :''}} "><a class="nav-link"
                            href="{{ url('permissions')}}">{{__('permission.permissions')}}</a>

                    </li>
                    @endcan
                    @can('view-user')
                    <li class=""><a class="nav-link" href="{{ url('system')}}">{{__('permission.system_setings')}}</a>

                    </li>
                    @endcan
                    @can('view-user')
                    <li class="{{ request()->is('users') ? 'active' : '' }}"><a class="nav-link"
                            href="{{url('users')}}">{{__('permission.user')}}
                            Management</a></li>
                    @endcan


                </ul>
            </li>
            @endcan


    </aside>
</div>