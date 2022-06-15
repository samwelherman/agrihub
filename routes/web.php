<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

use App\Http\Controller\FarmerController;
use App\Http\Controller\GroupController;
use App\Http\Controller\MemberController;
use App\Http\Controller\LandController;
use App\Http\Controller\SupplierController;
use App\Http\Controller\ProductController;
use App\Http\Controller\UnitController;
use App\Http\Controller\PurchaseController;
use App\Http\Controller\SalesController;
use App\Http\Controller\Single_warehouseController;
use App\Http\Controller\Orders_Client_ManipulationsController;
use App\Http\Controller\Warehouse_backendController;

//use ;
use App\Models\Counter;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/',"HomeController@index");

/*
Route::group(['prefix'=>'farmer'],function()
{
    Route::get('register','FarmerController@register');
});
*/


//my rooot


// start farming routes
Route::resource('/farming_cost','farming\Farming_costController');
Route::resource('/cost_centre','farming\Cost_CentreController');
Route::resource('/farming_process','farming\Farming_processController');
Route::resource('/crop_type','farming\CropTypeController');
Route::resource('/seed_type','farming\FeedTypeController');
Route::resource('/farm_program','farming\FarmProgramController');
Route::resource('/crops_monitoring','farming\Crops_MonitoringController');
Route::resource('/register_assets','farming\Farmer_assetsController');
Route::resource('/lime_base','farming\LimeBaseController');
Route::get('/landview',"farming\Farmer_assetsController@index1" );
Route::get('/landdelete/{$id}',"farming\Farmer_assetsController@destroy2" );
Route::get('getFarm',"farming\Farmer_assetsController@getFarm" );

Route::resource('seeds_type',"farming\Seeds_TypesController" );
Route::resource('pesticide_type',"farming\PesticideTypeController" );
Route::get('download',array('as'=>'download','uses'=>'farming\Crops_MonitoringController@download'));
// end farming routes

// start crop life cycle routes
Route::resource('irrigation','CropLifeCycle\IrrigationController');
// end crop life cycle routes


// start shop routes
Route::resource('items', 'shop\ItemsController');
Route::resource('purchase','shop\PurchaseController');
Route::get('findPrice', 'shop\PurchaseController@findPrice');  
Route::resource('sales','shop\SalesController');
Route::resource('payments', 'shop\PaymentsController');
Route::resource('invoice_payment', 'shop\Invoice_paymentController');
Route::resource('invoicepdf', 'shop\PDFController');
Route::get('pdfview',array('as'=>'pdfview','uses'=>'PDFController@pdfview'));

//Orders Routes
Route::resource('orders','orders\OrdersController');
Route::any('quotationList','orders\OrdersController@quotationList');
Route::any('quotationDetails/{id}','orders\OrdersController@quotationDetails');

//Seasson Routes
Route::resource('/seasson','farming\SeassonController');
Route::resource('/cropslifecycle','farming\CropsLifeCycleController');
Route::any('editLifeCycle',array('as'=>'editLifeCycle','uses'=>'farming\CropsLifeCycleController@editLifeCycle'));
Route::any('deleteLifeCycle',array('as'=>'deleteLifeCycle','uses'=>'farming\CropsLifeCycleController@deleteLifeCycle'));
Route::get('findFarm',"farming\SeassonController@findFarm" );
Route::get('findLime',"farming\CropsLifeCycleController@findLime" );
Route::get('findSeed',"farming\CropsLifeCycleController@findSeed" );
Route::get('findPesticide',"farming\CropsLifeCycleController@findPesticide" );
Route::get('monitorModal', 'farming\CropsLifeCycleController@discountModal');
Route::post('save_monitor', 'farming\CropsLifeCycleController@save_monitor')->name('monitor.save');

Route::get('/home',"HomeController@index" );
Route::get('farmer','FarmerController@index');
//Route::post('save','FarmerController@store');
Route::get('farmer/{id}/edit','FarmerController@edit');
//Route::resource('farmer','FarmerController');
Route::post('farmer/update/{id}','FarmerController@update');
Route::post('farmer/save','FarmerController@store');
Route::get('farmer/{id}/delete','FarmerController@destroy');
Route::get('farmer/{id}/show','FarmerController@show');
Route::get('findRegion', 'FarmerController@findRegion');  
Route::get('findDistrict', 'FarmerController@findDistrict');  
Route::get('assign_farmer','FarmerController@assign_farmer');
Route::post('save_farmer', 'FarmerController@save_farmer')->name('farmer.save');
Route::get('farmerModal', 'FarmerController@discountModal');


Route::post('group/{id}/update','GroupController@update');
Route::get('manage-group','GroupController@index');
Route::post('group/save','GroupController@store');
Route::get('group/{id}/delete','GroupController@destroy');

Route::get('farmer/group/{id}/add','MemberController@index');
Route::get('farmer/group/','MemberController@show');

route::post('save','MemberController@store');

route::get('land','LandController@index');
route::post('land/save','LandController@store');
route::get('land/{id}/delete','LandController@destroy');
route::post('land/{id}/edit','LandController@update');
//oute::get('test',[App\Http\Livewire\Counter::class, 'render']);


//livewire
Route::view('contacts', 'contacts');
Route::view('test','livewiretest');
Route::view('input-order','agrihub.iorder');

//supplier
Route::view('manage/group','agrihub.manage-group');

Route::get('manage/supplier','shop\SupplierController@index');
Route::post('supplier/save','shop\SupplierController@store');
Route::get('supplier/{id}/delete','shop\SupplierController@destroy');
Route::post('supplier/{id}/edit','shop\SupplierController@store');

//product
Route::get('manage/product','ProductController@index');
Route::post('product/save','ProductController@store');
Route::post('product/{id}/edit','ProductController@update');
Route::get('product/{id}/delete','ProductController@destroy');

//input order management
//Route::get('purchase/','PurchaseController@index');
Route::post('input/add','PurchaseController@store');
Route::get('get',"PurchaseController@create");
Route::post('ajax-posts/{id}/edit','PurchaseController@edit');
Route::get('order/{id}/{product}/{purchase}/delete','PurchaseController@destroy');
Route::post('order/{id}/update','PurchaseController@update');
Route::get('purchase/{id}/product','PurchaseController@show');
//output order managemnet

Route::post('sales/add','SalesController@store');
Route::get('get/sales',"SalesController@create");
Route::get('sales/{id}/{product}/{sale}/delete','SalesController@destroy');
Route::get('sales/{id}/product','SalesController@show');
// warehouse management
Route::get('warehouse','WarehouseController@index');
Route::post('warehouse/save','WarehouseController@store');
Route::get('warehouse/{id}/show','WarehouseController@show');
Route::resource('singlewarehouse','Single_warehouseController');
Route::resource('warehouse_backend','warehouse\Warehouse_backendController');


// make crops orders
Route::resource('crops_order','Client_OrderController');
Route::resource('manipulation','Orders_Client_ManipulationsController');

//  logistic routes
//  logistic-truck routes
Route::resource('truck', 'Truck\TruckController');
Route::get('truck_sticker/{id}', 'Truck\TruckController@sticker')->name('truck.sticker');
Route::get('truck_insurance/{id}', 'Truck\TruckController@insurance')->name('truck.insurance');
Route::any('truck_fuel_report/{id}', 'Truck\TruckController@fuel')->name('truck.fuel');
Route::any('truck_route/{id}', 'Truck\TruckController@route')->name('truck.route');
Route::resource('sticker', 'Truck\StickerController');
Route::resource('truckinsurance', 'Truck\TruckInsuranceController');
Route::get('sdownload',array('as'=>'sdownload','uses'=>'Truck\StickerControllerr@sdownload'));
Route::get('tdownload',array('as'=>'tdownload','uses'=>'ruck\TruckInsuranceController@tdownload'));

//  logistic-driver routes
Route::resource('driver', 'Driver\DriverController');
Route::get('driver_licence/{id}', 'Driver\DriverController@licence')->name('driver.licence');
Route::get('driver_performance/{id}', 'Driver\DriverController@performance')->name('driver.performance');
Route::resource('licence', 'Driver\LicenceController');
Route::resource('performance', 'Driver\PerformanceController');
Route::get('ldownload',array('as'=>'ldownload','uses'=>'Driver\LicenceController@ldownload'));
Route::get('pdownload',array('as'=>'pdownload','uses'=>'Driver\PerformanceController@pdownload'));
Route::any('driver_fuel_report/{id}', 'Driver\DriverController@fuel')->name('driver.fuel');
Route::any('driver_route/{id}', 'Driver\DriverController@route')->name('driver.route');

// inventory routes
Route::resource('location', 'Inventory\LocationController');

Route::resource('inventory', 'Inventory\InventoryController');

Route::resource('fieldstaff', 'Inventory\FieldStaffController');

Route::resource('purchase_inventory', 'Inventory\PurchaseInventoryController');
Route::get('findInvPrice', 'Inventory\PurchaseInventoryController@findPrice'); 
Route::get('approve/{id}', 'Inventory\PurchaseInventoryController@approve')->name('inventory.approve'); 
Route::get('cancel/{id}', 'Inventory\PurchaseInventoryController@cancel')->name('inventory.cancel'); 
Route::get('receive/{id}', 'Inventory\PurchaseInventoryController@receive')->name('inventory.receive'); 
Route::get('make_payment/{id}', 'Inventory\PurchaseInventoryController@make_payment')->name('inventory.pay'); 
Route::get('inv_pdfview',array('as'=>'inv_pdfview','uses'=>'Inventory\PurchaseInventoryController@inv_pdfview'));
Route::get('order_payment/{id}', 'orders\OrdersController@order_payment')->name('order.pay');
Route::get('inventory_list', 'Inventory\PurchaseInventoryController@inventory_list');
Route::resource('inventory_payment', 'Inventory\InventoryPaymentController');
Route::resource('order_payment', 'orders\OrderPaymentController');

Route::resource('maintainance', 'Inventory\MaintainanceController');
Route::get('change_m_status/{id}', 'Inventory\MaintainanceController@approve')->name('maintainance.approve'); 

Route::resource('service', 'Inventory\ServiceController');
Route::get('change_s_status/{id}', 'Inventory\ServiceController@approve')->name('service.approve');

Route::resource('good_issue', 'Inventory\GoodIssueController');
Route::get('findIssueService', 'Inventory\GoodIssueController@findService');

Route::resource('good_movement', 'Inventory\GoodMovementController');
Route::resource('good_reallocation', 'Inventory\GoodReallocationController');
Route::resource('good_disposal', 'Inventory\GoodDisposalController');

Route::resource('good_return', 'Inventory\GoodReturnController');
Route::get('findReturnService', 'Inventory\GoodReturnController@findService');

//tracking
Route::get('collection', 'Activity\OrderMovementController@collection')->name('order.collection');
Route::get('loading', 'Activity\OrderMovementController@loading')->name('order.loading');
Route::get('offloading', 'Activity\OrderMovementController@offloading')->name('order.offloading');
Route::get('delivering', 'Activity\OrderMovementController@delivering')->name('order.delivering');
Route::resource('order_movement', 'Activity\OrderMovementController');
Route::get('findTruck', 'Activity\OrderMovementController@findTruck');  
Route::resource('activity', 'Activity\ActivityController');
Route::get('order_report', 'Activity\OrderMovementController@report')->name('order.report');
Route::get('findReport', 'Activity\OrderMovementController@findReport');
Route::get('findExp', 'Activity\OrderMovementController@findPrice');  
Route::get('truck_mileage', 'Activity\OrderMovementController@return')->name('order.return');
//fuel
Route::resource('fuel', 'Fuel\FuelController');
Route::get('addRoute', 'Fuel\FuelController@route');
Route::resource('routes', 'RouteController');
Route::get('fuel_approve/{id}', 'Fuel\FuelController@approve')->name('fuel.approve');
Route::get('discountModal', 'Fuel\FuelController@discountModal');

//leave
Route::resource('leave', 'Leave\LeaveController');
Route::post('addCategory', 'Leave\LeaveController@category');
Route::get('leave_approve/{id}', 'Leave\LeaveController@approve')->name('leave.approve');
Route::get('leave_reject/{id}', 'Leave\LeaveController@reject')->name('leave.reject');

//training
Route::resource('training', 'Training\TrainingController');
Route::get('training_start/{id}', 'Training\TrainingController@start')->name('training.start');
Route::get('training_approve/{id}', 'Training\TrainingController@approve')->name('training.approve');
Route::get('training_reject/{id}', 'Training\TrainingController@reject')->name('training.reject');


// tyre routes
Route::resource('tyre_brand', 'Tyre\TyreBrandController');
Route::get('tyre_list', 'Tyre\PurchaseTyreController@tyre_list');
Route::resource('purchase_tyre', 'Tyre\PurchaseTyreController');
Route::get('findTyrePrice', 'Tyre\PurchaseTyreController@findPrice'); 
Route::get('tyre_approve/{id}', 'Tyre\PurchaseTyreController@approve')->name('purchase_tyre.approve'); 
Route::get('tyre_cancel/{id}', 'Tyre\PurchaseTyreController@cancel')->name('purchase_tyre.cancel'); 
Route::get('tyre_receive/{id}', 'Tyre\PurchaseTyreController@receive')->name('purchase_tyre.receive'); 
Route::get('make_tyre_payment/{id}', 'Tyre\PurchaseTyreController@make_payment')->name('purchase_tyre.pay'); 
Route::get('tyre_pdfview',array('as'=>'tyre_pdfview','uses'=>'Tyre\PurchaseTyreController@tyre_pdfview'));
Route::resource('tyre_payment', 'Tyre\TyrePaymentController');
Route::get('assign_truck', 'Tyre\PurchaseTyreController@assign_truck')->name('purchase_tyre.assign');
Route::get('tyreModal', 'Tyre\PurchaseTyreController@discountModal');
Route::post('save_truck', 'Tyre\PurchaseTyreController@save_truck')->name('purchase_tyre.save');
Route::resource('tyre_reallocation', 'Tyre\TyreReallocationController');
Route::get('tyre_reallocation_approve/{id}', 'Tyre\TyreReallocationController@approve')->name('tyre_reallocation.approve'); 
Route::resource('tyre_disposal', 'Tyre\TyreDisposalController');
Route::get('tyre_disposal_approve/{id}', 'Tyre\TyreDisposalController@approve')->name('tyre_disposal.approve'); 
Route::resource('tyre_return', 'Tyre\TyreReturnController');
Route::get('findTyreDetails', 'Tyre\TyreReturnController@findPrice'); 
Route::get('tyre_return_approve/{id}', 'Tyre\TyreReturnController@approve')->name('tyre_return.approve'); 
Route::get('addSupp', 'Tyre\PurchaseTyreController@addSupp');

//pacel
Route::resource('pacel_list', 'Pacel\PacelListController');
Route::resource('client', 'ClientController');
Route::resource('pacel_quotation', 'Pacel\PacelController');
Route::get('pacel_invoice', 'Pacel\PacelController@invoice')->name('pacel.invoice');
Route::get('findPacelPrice', 'Pacel\PacelController@findPrice'); 
Route::get('pacel_approve/{id}', 'Pacel\PacelController@approve')->name('pacel.approve'); 
Route::get('pacel_cancel/{id}', 'Pacel\PacelController@cancel')->name('pacel.cancel');  
Route::get('make_pacel_payment/{id}', 'Pacel\PacelController@make_payment')->name('pacel.pay'); 
Route::get('pacel_pdfview',array('as'=>'pacel_pdfview','uses'=>'Pacel\PacelController@pacel_pdfview'));
Route::resource('pacel_payment', 'Pacel\PacelPaymentController');
Route::get('pacelModal', 'Pacel\PacelController@discountModal');
Route::post('newdiscount', 'Pacel\PacelController@newdiscount');
Route::get('addSupplier', 'Pacel\PacelController@addSupplier');
Route::get('addRoute', 'Pacel\PacelController@addRoute');
Route::resource('mileage_payment', 'MileagePaymentController');
Route::get('mileage', 'MileagePaymentController@mileage')->name('mileage'); ;
Route::resource('routes', 'RouteController');
Route::get('mileageModal', 'MileagePaymentController@discountModal');
Route::get('mileage_approve/{id}', 'MileagePaymentController@approve')->name('mileage.approve');



//courier
Route::resource('courier_list', 'Courier\CourierListController');
Route::resource('courier_client', 'Courier\CourierClientController');
Route::resource('courier_quotation', 'Courier\CourierController');
Route::get('courier_invoice', 'Courier\CourierController@invoice')->name('courier.invoice');
Route::get('findCourierPrice', 'Courier\CourierController@findPrice'); 
Route::get('courier_approve/{id}', 'Courier\CourierController@approve')->name('courier.approve'); 
Route::get('courier_cancel/{id}', 'Courier\CourierController@cancel')->name('courier.cancel');  
Route::get('make_courier_payment/{id}', 'Courier\CourierController@make_payment')->name('courier.pay'); 
Route::get('courier_pdfview',array('as'=>'courier_pdfview','uses'=>'Courier\CourierController@courier_pdfview'));
Route::resource('courier_payment', 'Courier\CourierPaymentController');
Route::get('courierModal', 'Courier\CourierController@discountModal');
Route::post('newCourierDiscount', 'Courier\CourierController@newdiscount');
Route::get('addCourierSupplier', 'Courier\CourierController@addSupplier');
Route::get('addCourierRoute', 'Courier\CourierController@addRoute');

//courier tracking
Route::get('courier_collection', 'Courier\CourierMovementController@collection')->name('courier.collection');
Route::get('courier_loading', 'Courier\CourierMovementController@loading')->name('courier.loading');
Route::get('courier_offloading', 'Courier\CourierMovementController@offloading')->name('courier.offloading');
Route::get('courier_delivering', 'Courier\CourierMovementController@delivering')->name('courier.delivering');
Route::resource('courier_movement', 'Courier\CourierMovementController'); 
Route::resource('courier_activity', 'Courier\CourierActivityController');
Route::get('courier_report', 'Courier\CourierMovementController@report')->name('courier.report');
Route::get('findCourierReport', 'Courier\CourierMovementController@findReport');

//GL SETUP
Route::resource('class_account', 'ClassAccountController');
Route::resource('group_account', 'GroupAccountController');
Route::resource('account_codes', 'AccountCodesController');
Route::resource('system', 'SystemController');
Route::resource('chart_of_account', 'ChartOfAccountController');
Route::resource('expenses', 'ExpensesController');
Route::get('expenses_approve/{id}', 'ExpensesController@approve')->name('expenses.approve');
Route::resource('deposit', 'DepositController');
Route::get('deposit_approve/{id}', 'DepositController@approve')->name('deposit.approve');

//route for reports
Route::group(['prefix' => 'accounting'], function () {

    Route::any('trial_balance', 'AccountingController@trial_balance');
    Route::any('ledger', 'AccountingController@ledger');
    Route::any('journal', 'AccountingController@journal');
    Route::get('manual_entry', 'AccountingController@create_manual_entry');
    Route::post('manual_entry/store', 'AccountingController@store_manual_entry');
    Route::any('bank_statement', 'AccountingController@bank_statement');
    Route::any('bank_reconciliation', 'AccountingController@bank_reconciliation');
    Route::any('reconciliation_report', 'AccountingController@reconciliation_report')->name('reconciliation.report');;
    Route::post('save_reconcile', 'AccountingController@save_reconcile')->name('reconcile.save');
});


//route for payroll
Route::group(['prefix' => 'payroll'], function () {

    Route::resource('salary_template', 'Payroll\SalaryTemplateController');
    Route::any('manage_salary','Payroll\ManageSalaryController@getDetails');
Route::get('addTemplate', 'Payroll\ManageSalaryController@addTemplate');
  Route::get('manage_salary_edit/{id}','Payroll\ManageSalaryController@edit')->name('employee.edit');;;;
  Route::delete('manage_salary_delete/{id}','Payroll\ManageSalaryController@destroy')->name('employee.destroy');;;;
    Route::get('employee_salary_list','Payroll\ManageSalaryController@salary_list')->name('employee.salary');;;
    Route::resource('make_payment', 'Payroll\MakePaymentsController');   
  Route::get('make_payment/{user_id}/{departments_id}/{payment_month}', 'Payroll\MakePaymentsController@getPayment')->name('payment'); 
  Route::post('save_payment','Payroll\MakePaymentsController@save_payment')->name('save_payment');;;;
  Route::get('make_payment/{departments_id}/{payment_month}', 'Payroll\MakePaymentsController@viewPayment')->name('view.payment'); 
    Route::resource('advance_salary', 'Payroll\AdvanceController'); 
   Route::get('findAmount', 'Payroll\AdvanceController@findAmount'); 
      Route::get('findMonth', 'Payroll\AdvanceController@findMonth');   
  Route::get('advance_approve/{id}', 'Payroll\AdvanceController@approve')->name('advance.approve'); 
Route::get('advance_reject/{id}', 'Payroll\AdvanceController@reject')->name('advance.reject'); 
Route::resource('employee_loan', 'Payroll\EmployeeLoanController'); 
 Route::get('findLoan', 'Payroll\EmployeeLoanController@findLoan');  
  Route::get('employee_loan_approve/{id}', 'Payroll\EmployeeLoanController@approve')->name('employee_loan.approve'); 
Route::get('employee_loan_reject/{id}', 'Payroll\EmployeeLoanController@reject')->name('employee_loan.reject'); 
   Route::resource('overtime', 'Payroll\OvertimeController'); 
  Route::get('overtime_approve/{id}', 'Payroll\OvertimeController@approve')->name('overtime.approve'); 
Route::get('overtime_reject/{id}', 'Payroll\OvertimeController@reject')->name('overtime.reject'); 
   Route::get('findOvertime', 'Payroll\OvertimeController@findAmount'); 
 Route::any('nssf', 'Payroll\GetPaymentController@nssf'); 
 Route::any('tax', 'Payroll\GetPaymentController@tax'); 
 Route::any('nhif', 'Payroll\GetPaymentController@nhif'); 
 Route::any('wcf', 'Payroll\GetPaymentController@wcf'); 
Route::any('payroll_summary', 'Payroll\GetPaymentController@payroll_summary'); 
 Route::any('generate_payslip', 'Payroll\GetPaymentController@generate_payslip'); 
 Route::any('received_payslip/{id}', 'Payroll\GetPaymentController@received_payslip')->name('payslip.generate'); 
Route::get('payslip_pdfview',array('as'=>'payslip_pdfview','uses'=>'Payroll\GetPaymentController@payslip_pdfview'));

Route::post('save_salary_details',array('as'=>'save_salary_details','uses'=>'Payroll\ManageSalaryController@save_salary_details'));
    Route::get('employee_salary_list',array('as'=>'employee_salary_list','uses'=>'Payroll\ManageSalaryController@employee_salary_list'));
    Route::resource('get_payment2', 'Payroll\GetPayment2Controller');
    Route::resource('make_payment2', 'Payroll\MakePayments2Controller'); 
   //Route::post('make_payment/store{user_id}{departments_id}{payment_month}', 'Payroll\MakePaymentsController@store')->name('make_payment.store'); 
    
});


    Route::group(['prefix' => 'financial_report'], function () {
        Route::any('trial_balance', 'ReportController@trial_balance');
        Route::any('trial_balance/pdf', 'ReportController@trial_balance_pdf');
        Route::any('trial_balance/excel', 'ReportController@trial_balance_excel');
        Route::any('trial_balance/csv', 'ReportController@trial_balance_csv');
        Route::any('ledger', 'ReportController@ledger');
        Route::any('journal', 'ReportController@journal');
        Route::any('income_statement', 'ReportController@income_statement');
        Route::any('income_statement/pdf', 'ReportController@income_statement_pdf');
        Route::any('income_statement/excel', 'ReportController@income_statement_excel');
        Route::any('income_statement/csv', 'ReportController@income_statement_csv');
        Route::any('balance_sheet', 'ReportController@balance_sheet');
        Route::any('balance_sheet/pdf', 'ReportController@balance_sheet_pdf');
        Route::any('balance_sheet/excel', 'ReportController@balance_sheet_excel');
        Route::any('balance_sheet/csv', 'ReportController@balance_sheet_csv');
         Route::any('summary', 'ReportController@summary');
        Route::any('summary/pdf', 'ReportController@summary_pdf');
        Route::any('summary/excel', 'ReportController@summary');
        Route::any('summary/csv', 'ReportController@summary');
        Route::any('cash_flow', 'ReportController@cash_flow');
        Route::any('provisioning', 'ReportController@provisioning');
        Route::any('provisioning/pdf', 'ReportController@provisioning_pdf');
        Route::any('provisioning/excel', 'ReportController@provisioning_excel');
        Route::any('provisioning/csv', 'ReportController@provisioning_csv');
    });

Route::resource('permissions', 'PermissionController');
Route::resource('departments', 'DepartmentController');
Route::resource('designations', 'DesignationController');
Route::resource('roles', 'RoleController');

Route::resource('users', 'UsersController'); 
Route::get('findDepartment', 'UsersController@findDepartment');  
Route::resource('users_details', 'User\UserDetailsController');

Route::resource('clients', 'ClientController');

Route::resource('system', 'SystemController');

//user Details
Route::resource('user_details', 'UserDetailsController');