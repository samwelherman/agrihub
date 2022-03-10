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
Route::resource('/crops_monitoring','farming\Crops_MonitoringController');
Route::resource('/register_assets','farming\Farmer_assetsController');
Route::get('/landview',"farming\Farmer_assetsController@index1" );
Route::get('/landdelete/{$id}',"farming\Farmer_assetsController@destroy2" );
Route::get('/getFarm/',"farming\Farmer_assetsController@getFarm" );
Route::get('download',array('as'=>'download','uses'=>'farming\Crops_MonitoringController@download'));
// end farming routes


// start shop routes
Route::resource('items', 'shop\ItemsController');
Route::resource('purchase','shop\PurchaseController');
Route::get('findPrice', 'shop\PurchaseController@findPrice');  
Route::resource('sales','shop\SalesController');
Route::resource('payments', 'shop\PaymentsController');
Route::resource('invoice_payment', 'shop\Invoice_paymentController');
Route::resource('invoicepdf', 'shop\PDFController');
Route::get('pdfview',array('as'=>'pdfview','uses'=>'shop\PDFController@pdfview'));

//Orders Routes
Route::resource('orders','orders\OrdersController');
Route::any('quotationList','orders\OrdersController@quotationList');
Route::any('quotationDetails/{id}','orders\OrdersController@quotationDetails');

//Seasson Routes
Route::resource('/seasson','farming\SeassonController');
Route::resource('/cropslifecycle','farming\CropsLifeCycleController');
Route::any('editLifeCycle',array('as'=>'editLifeCycle','uses'=>'farming\CropsLifeCycleController@editLifeCycle'));




Route::get('/home',"HomeController@index" );
Route::get('farmer','FarmerController@index');
//Route::post('save','FarmerController@store');
Route::get('farmer/{id}/edit','FarmerController@edit');
//Route::resource('farmer','FarmerController');
Route::post('farmer/update/{id}','FarmerController@update');
Route::post('farmer/save','FarmerController@store');
Route::get('farmer/{id}/delete','FarmerController@destroy');
Route::get('farmer/{id}/show','FarmerController@show');

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
Route::post('addinsurance/save','WarehouseController@storeInsurance');
Route::post('addfarmeraccount/save','WarehouseController@storeFarmerAccount');
Route::post('deposity/save','WarehouseController@storedeposity');
Route::post('withdraw/save','WarehouseController@storewithdraw');
Route::resource('singlewarehouse','Single_warehouseController');

// make crops orders
Route::resource('crops_order','Client_OrderController');
Route::resource('manipulation','Orders_Client_ManipulationsController');


Route::resource('permissions', 'PermissionController');
Route::resource('roles', 'RoleController');

Route::resource('users', 'UsersController');
Route::resource('clients', 'ClientController');

Route::resource('system', 'SystemController');