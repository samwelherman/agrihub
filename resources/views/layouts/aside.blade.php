<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="">
                <?php
                  $settings= App\Models\System::first();
                  //$settings= App\Models\System::all()->where('added_by',auth()->user()->user_id);
?>
                <img alt="image" src="{{url('public/assets/img/logo')}}/{{$settings->picture}}" class="header-logo" />
                <span class="logo-name"></span>
            </a>
        </div>
        <ul class="sidebar-menu active show">
            @can('manage-dashboard')
            <li class="dropdown {{  request()->is('/dashboard') ? 'active' : '' }}">
                <a href="/"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
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
                    @can('view-farmer')
                    <li><a class="nav-link" href="{{url('assign_farmer/')}}">{{__('farmer.assign_farmer')}}</a></li>
                    @endcan
                </ul>
            </li>
            @endcan

            @can('manage-farming')
            <li class="dropdown">

                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="command"></i><span>{{__('farming.farming')}}</span></a>
                <ul class="dropdown-menu">
                    @can('manage-farming')
                    <li><a class="nav-link" href="{{url('crop_type')}}">Crop Type</a></li>
                    @endcan
                    @can('manage-farming')
                    <li><a class="nav-link" href="{{url('seed_type')}}">Seed Type</a></li>
                    @endcan
                    @can('manage-farming')
                    <li><a class="nav-link" href="{{url('pesticide_type')}}">Pesticide Type</a></li>
                    @endcan
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
                    <li><a class="nav-link" href="{{url('farming_process')}}">GAP</a></li>
                    @endcan
                    @can('view-crop-monitoring')
                    <li><a class="nav-link" href="{{url('crops_monitoring')}}">{{__('farming.crop_monitoring')}}</a>
                    </li>
                    @endcan
                    @can('manage-farming')
                    <li><a class="nav-link" href="{{url('lime_base')}}">Lime Base</a></li>
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

            @can('manage-orders')
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>Cargo
                        Management</span></a>
                <ul class="dropdown-menu">
                    @can('view-cargo-list')
                    <li><a class="nav-link" href="{{url('pacel_list')}}">Item List</a></li>
                    @endcan
                    @can('view-cargo-client-list')
                    <li><a class="nav-link" href="{{url('client')}}">Client List</a></li>
                    @endcan
                    @can('view-cargo-quotation')
                    <li><a class="nav-link" href="{{url('pacel_quotation')}}">Quotation</a></li>
                    @endcan
                    @can('manage-cargo-invoice')
                    <li><a class="nav-link" href="{{url('pacel_invoice')}}">Invoice</a></li>
                    @endcan
                    @can('view-cargo-mileage')
                    <li><a class="nav-link" href="{{url('mileage')}}">Mileage List</a></li>
                    @endcan
                </ul>
            </li>
            @endcan

            @can('manage-logistic-orders')
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>Cargo
                        Tracking</span></a>
                <ul class="dropdown-menu">
                    @can('view-cargo-collection')
                    <li><a class="nav-link" href="{{url('collection')}}"> Cargo List</a></li>
                    @endcan
                    @can('view-cargo-loading')
                    <li><a class="nav-link" href="{{url('loading')}}"> Loading</a></li>
                    @endcan
                    @can('view-cargo-offloading')
                    <li><a class="nav-link" href="{{url('offloading')}}"> Offloading</a></li>
                    @endcan
                    @can('view-cargo-delivering')
                    <li><a class="nav-link" href="{{url('delivering')}}">Delivery</a></li>
                    @endcan
                    @can('view-cargo-activity')
                    <li><a class="nav-link" href="{{url('activity')}}">Track Logistic Activity</a></li>
                    @endcan
                    @can('view-cargo-order_report')
                    <li><a class="nav-link" href="{{url('order_report')}}">Uplift Report</a></li>
                    @endcan
                    @can('view-cargo-truck_mileage')
                    <li><a class="nav-link" href="{{url('truck_mileage')}}">Return Truck Fuel & Mileage</a></li>
                    @endcan
                </ul>
            </li>
            @endcan

            @can('manage-courier')
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>Courier
                        Management</span></a>
                <ul class="dropdown-menu">
                    @can('view-courier_list')
                    <li><a class="nav-link" href="{{url('courier_list')}}">Item List</a></li>
                    @endcan
                    @can('view-courier_client')
                    <li><a class="nav-link" href="{{url('courier_client')}}">Client List</a></li>
                    @endcan
                    @can('view-courier_quotation')
                    <li><a class="nav-link" href="{{url('courier_quotation')}}">Quotation</a></li>
                    @endcan
                    @can('view-courier_invoice')
                    <li><a class="nav-link" href="{{url('courier_invoice')}}">Invoice</a></li>
                    @endcan
                </ul>
            </li>
            @endcan

            @can('manage-courier')
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>Courier
                        Tracking</span></a>
                <ul class="dropdown-menu">
                    @can('courier_collection')
                    <li><a class="nav-link" href="{{url('courier_collection')}}"> Courier Collection</a></li>
                    @endcan
                    @can('courier_loading')
                    <li><a class="nav-link" href="{{url('courier_loading')}}"> Courier Loading</a></li>
                    @endcan
                    @can('courier_offloading')
                    <li><a class="nav-link" href="{{url('courier_offloading')}}"> Courier Offloading</a></li>
                    @endcan
                    @can('courier_delivering')
                    <li><a class="nav-link" href="{{url('courier_delivering')}}"> Courier Delivery</a></li>
                    @endcan
                    @can('courier_activity')
                    <li><a class="nav-link" href="{{url('courier_activity')}}">Track Courier Activity</a></li>
                    @endcan
                    @can('courier_activity')
                    <li><a class="nav-link" href="{{url('courier_activity')}}"> Courier Uplift Report</a></li>
                    @endcan
                </ul>
            </li>
            @endcan
            @can('manage-payroll')
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="command"></i><span>Payroll</span></a>
                <ul class="dropdown-menu">
                    @can('salary_template')
                    <li><a class="nav-link" href="{{url('payroll/salary_template')}}"> Salary Template</a></li>
                    @endcan
                    @can('manage_salary')
                    <li><a class="nav-link" href="{{url('payroll/manage_salary')}}"> Manage Salary</a></li>
                    @endcan
                    @can('employee_salary_list')
                    <li><a class="nav-link" href="{{ url('payroll/employee_salary_list') }}"> Employee Salary List</a>
                    </li>
                    @endcan
                    @can('make_payment')
                    <li><a class="nav-link" href="{{url('payroll/make_payment')}}">Make Payment</a></li>
                    @endcan
                    @can('generate_payslip')
                    <li><a class="nav-link" href="{{url('payroll/generate_payslip')}}">Generate Payslip</a></li>
                    @endcan
                    @can('payroll_summary')
                    <li><a class="nav-link" href="{{url('payroll/payroll_summary')}}">Payroll Summary</a></li>
                    @endcan
                    @can('advance_salary')
                    <li><a class="nav-link" href="{{url('payroll/advance_salary')}}">Advance Salary</a></li>
                    @can('employee_loan')
                    <li><a class="nav-link" href="{{url('payroll/employee_loan')}}">Employee Loan</a></li>
                    @endcan
                    @can('overtime')
                    <li><a class="nav-link" href="{{url('payroll/overtime')}}">Overtime</a></li>
                    @endcan
                    @can('nssf')
                    <li><a class="nav-link" href="{{url('payroll/nssf')}}">Social Security (NSSF) </a></li>
                    @endcan
                    @can('tax')
                    <li><a class="nav-link" href="{{url('payroll/tax')}}">Tax </a></li>
                    @endcan
                    @can('nhif')
                    <li><a class="nav-link" href="{{url('payroll/nhif')}}">Health Contribution</a></li>
                    @endcan
                    @can('wcf')
                    <li><a class="nav-link" href="{{url('payroll/wcf')}}">WCF Contribution</a></li>
                    @endcan
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
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>Truck &
                        Driver</span></a>
                <ul class="dropdown-menu">
                    @can('view-truck')
                    <li><a class="nav-link" href="{{url('truck')}}">Truck Management</a></li>
                    @endcan
                    @can('view-driver')
                    <li><a class="nav-link" href="{{url('driver')}}">Driver Management</a></li>
                    @endcan
                    @can('view-fuel')
                    <li><a class="nav-link" href="{{url('fuel')}}"><i data-feather="command"></i>Fuel Control</a></li>
                    @endcan
                </ul>
            </li>
            @endcan

            @can('manage-inventory')
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>Tire
                        Management</span></a>
                <ul class="dropdown-menu">
                    @can('view-tyre_brand')
                    <li><a class="nav-link" href="{{url('tyre_brand')}}">Tire Brand</a></li>
                    @endcan
                    @can('view-purchase_tyre')
                    <li><a class="nav-link" href="{{url('purchase_tyre')}}">Purchase Tire</a></li>
                    @endcan
                    @can('view-tyre_list')
                    <li><a class="nav-link" href="{{url('tyre_list')}}">Tire List</a></li>
                    @endcan
                    @can('view-assign_truck')
                    <li><a class="nav-link" href="{{url('assign_truck')}}">Assign Truck</a></li>
                    @endcan
                    @can('view-tyre_return')
                    <li><a class="nav-link" href="{{url('tyre_return')}}">Good Return</a></li>
                    @endcan
                    @can('view-tyre_reallocation')
                    <li><a class="nav-link" href="{{url('tyre_reallocation')}}">Good Reallocation</a></li>
                    @endcan
                    @can('view-tyre_disposal')
                    <li><a class="nav-link" href="{{url('tyre_disposal')}}">Good Disposal</a></li>
                    @endcan
                </ul>
            </li>
            @endcan


            @can('manage-inventory')
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="command"></i><span>Inventory</span></a>
                <ul class="dropdown-menu">
                    @can('view-location')
                    <li><a class="nav-link" href="{{url('location')}}">Location</a></li>
                    @endcan
                    @can('view-inventory')
                    <li><a class="nav-link" href="{{url('inventory')}}">Inventory Items</a></li>
                    @endcan
                    @can('view-fieldstaff')
                    <li><a class="nav-link" href="{{url('fieldstaff')}}">Field Staff</a></li>
                    @endcan
                    @can('view-purchase_inventory')
                    <li><a class="nav-link" href="{{url('purchase_inventory')}}">Purchase Inventory</a></li>
                    @endcan
                    @can('view-inventory_list')
                    <li><a class="nav-link" href="{{url('inventory_list')}}">Inventory List</a></li>
                    @endcan
                    @can('view-maintainance')
                    <li><a class="nav-link" href="{{url('maintainance')}}">Maintainance</a></li>
                    @endcan
                    @can('view-service')
                    <li><a class="nav-link" href="{{url('service')}}">Service</a></li>
                    @endcan
                    @can('view-service')
                    <li><a class="nav-link" href="{{url('service')}}">Good Issue</a></li>
                    @endcan
                    @can('view-good_return')
                    <li><a class="nav-link" href="{{url('good_return')}}">Good Return</a></li>
                    @endcan
                    @can('view-good_return')
                    <li><a class="nav-link" href="{{url('good_return')}}">Good Movement</a></li>
                    @endcan
                    @can('view-good_reallocation')
                    <li><a class="nav-link" href="{{url('good_reallocation')}}">Good Reallocation</a></li>
                    @endcan
                    @can('view-good_disposal')
                    <li><a class="nav-link" href="{{url('good_disposal')}}">Good Disposal</a></li>
                    @endcan
                </ul>
            </li>
            @endcan

            @can('view-leave')
            <li><a class="nav-link" href="{{url('leave')}}"><i data-feather="command"></i>Leave Management</a></li>
            @endcan
            @can('view-training')
            <li><a class="nav-link" href="{{url('training')}}"><i data-feather="command"></i>Training</a></li>
            @endcan

            @can('manage-transaction')
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="command"></i><span>Transactions</span></a>
                <ul class="dropdown-menu">
                    @can('deposit')
                    <li class=""><a class="nav-link" href="{{ url('deposit') }}">Deposit</a></li>
                    @endcan
                    @can('expenses')
                    <li class=" "><a class="nav-link" href="{{ url('expenses') }}">Expenses</a></li>
                    @endcan
                    @can('bank_statement')
                    <li class=""><a class="nav-link" href="{{ url('accounting/bank_statement') }}">Bank Statement</a>
                    </li>
                    @endcan
                    @can('bank_reconciliation')
                    <li class=" "><a class="nav-link" href="{{ url('accounting/bank_reconciliation') }}">Bank
                            Reconciliation</a></li>
                    @endcan
                    can('reconciliation_report')
                    <li class=" "><a class="nav-link" href="{{ url('accounting/reconciliation_report') }}">Bank
                            Reconciliation Report</a></li>
                    @endcan
                </ul>
            </li>
            @endcan


            @can('manage-gl-setup')
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>GL
                        SETUP</span></a>
                <ul class="dropdown-menu">
                    @can('view-class_account')
                    <li class=""><a class="nav-link" href="{{ url('class_account') }}">Class Account </a></li>
                    @endcan
                    @can('view-group_account')
                    <li class=" "><a class="nav-link" href="{{ url('group_account') }}">Group Account</a></li>
                    @endcan
                    @can('view-account_codes')
                    <li class=""><a class="nav-link" href="{{ url('account_codes') }}">Account Codes</a></li>
                    @endcan
                    @can('view-chart_of_account')
                    <li class=""><a class="nav-link" href="{{ url('chart_of_account') }}">Chart of Accounts </a></li>
                    @endcan

                </ul>
            </li>
            @endcan

            @can('manage-accounting')
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="command"></i><span>Accounting</span></a>
                <ul class="dropdown-menu">
                    @can('manual_entry')
                    <li class=""><a class="nav-link" href="{{ url('accounting/manual_entry') }}">Journal Entry</a></li>
                    @endcan
                    @can('journal')
                    <li class=" "><a class="nav-link" href="{{ url('accounting/journal') }}">Journal Entry Report</a>

                    </li>
                    @endcan
                    @can('ledger')
                    <li class=""><a class="nav-link" href="{{ url('accounting/ledger') }}">Ledger</a></li>
                    @endcan
                    @can('trial_balance')
                    <li class=""><a class="nav-link" href="{{url('financial_report/trial_balance')}}">Trial Balance </a>
                    </li>
                    @endcan
                    @can('income_statement')
                    <li class=""><a class="nav-link" href="{{url('financial_report/income_statement')}}">Income
                            Statement</a></li>
                    @endcan
                    @can('balance_sheet')
                    <li class=""><a class="nav-link" href="{{url('financial_report/balance_sheet')}}">Balance Sheet </a>
                    </li>
                    @endcan

                </ul>
            </li>
            @endcan


            
            <li class="dropdown{{ request()->is('setting/*') ? 'active' : '' }}">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="command"></i><span>{{__('permission.access_control')}}</span></a>
                <ul class="dropdown-menu">
                    
                    <li class="{{ request()->is('setting/roleGroup') ? 'active' : '' }}"><a class="nav-link"
                            href="{{url('roles')}}">
                            {{__('permission.roles')}}</a>
                    </li>
                    
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
                    <li class=""><a class="nav-link" href="{{url('departments')}}">Departments
                        </a></li>
                    @endcan

                    @can('view-user')
                    <li class=""><a class="nav-link" href="{{url('designations')}}">Designations
                        </a></li>
                    @endcan

                    @can('view-user')
                    <li class="{{ request()->is('users') ? 'active' : '' }}"><a class="nav-link"
                            href="{{url('users')}}">{{__('permission.user')}}
                            Management</a></li>
                    @endcan


                </ul>
            </li>
           


    </aside>
</div>