<?php

use Illuminate\Support\Facades\Route;

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


// login api

Route::get('login', 'LoginController@login')->name('login');
Route::post('loginApi', 'LoginController@loginApi')->name('loginApi');
Route::get('logout', 'LoginController@logout');


#Route::post('loginApi', [AdminController::class, 'loginApi'])->name('loginApi');


// register api
Route::get('register', [RegisterController::class, 'register'])->name('register');
Route::post('registerApi', [RegisterController::class, 'registerApi'])->name('registerApi');





Route::get('home', 'HomeController@index')->name('home');
Route::get('/', function () {
    return view('welcome');
});






Auth::routes();



Route::group(['prefix' => 'admin'], function() {
	
	Route::get('/dashboard', 'AdminController@dashboard')->name('dashboard');


	Route::get('/add-company-users', 'AdminController@addCompanyUser')->name('add-company-users');
	Route::get('/edit-company-users/{id}', 'AdminController@editCompanyUser')->name('edit-company-users');
	Route::get('/company-user-list', 'AdminController@companyUserList')->name('company-user-list');
	
	Route::get('/add-price', 'AdminController@addPrice')->name('add-price');
	Route::get('/edit-price/{id}', 'AdminController@editPrice')->name('edit-price');
	Route::get('/price-list', 'AdminController@priceList')->name('price-list');
	Route::post('/submitPriceSetupApi', 'AdminController@submitPriceSetupApi')->name('submitPriceSetupApi');


	Route::get('/add-company', 'AdminController@addCompany')->name('add-company');
	Route::get('/edit-company/{id}', 'AdminController@editCompany')->name('edit-company');
	Route::get('/company-list', 'AdminController@companyList')->name('company-list');
	Route::get('/company-details/{id}', 'AdminController@companyDetails')->name('company-details');

	Route::get('/industries', 'AdminController@industries')->name('industries');
	Route::get('/payments-terms', 'AdminController@paymentsTerms')->name('payments-terms');
	Route::get('/supplier-risk-level', 'AdminController@supplierRiskLevel')->name('supplier-risk-level');
	Route::get('/roles', 'AdminController@roles')->name('roles');


	Route::get('/rfq-range', 'AdminController@rfqRange')->name('rfq-range');
	Route::get('/rfq-range-list', 'AdminController@rfqRangeList')->name('rfq-range-list');
	Route::get('/rfq-status', 'AdminController@rfqStatusList')->name('rfq-status');
	Route::post('/submitRfqRangeApi', 'AdminController@submitRfqRangeApi')->name('submitRfqRangeApi');
	Route::post('/submitIndustryApi', 'AdminController@submitIndustryApi')->name('submitIndustryApi');
	Route::post('/submitPaymentApi', 'AdminController@submitPaymentApi')->name('submitPaymentApi');
	Route::post('/submitSupplierRiskLevelApi', 'AdminController@submitSupplierRiskLevelApi')->name('submitSupplierRiskLevelApi');
	Route::post('/submitPriceSetupApi', 'AdminController@submitPriceSetupApi')->name('submitPriceSetupApi');


	
	Route::post('/submitaddCompanyApi', 'AdminController@submitaddCompanyApi')->name('submitaddCompanyApi');
	Route::post('/submitaddCompanyUserApi', 'AdminController@submitaddCompanyUserApi')->name('submitaddCompanyUserApi');
	Route::post('/submitRfqStatusApi', 'AdminController@submitRfqStatusApi')->name('submitRfqStatusApi');
	Route::get('/changeRfqStatus/{status}/{id}', 'AdminController@changeRfqStatus');


	Route::get('/deleteByID/{model}/{id}', 'AdminController@deleteByID');
	Route::get('/updateByID/{model}/{id}/{value}', 'AdminController@updateByID');

	
	Route::get('export', 'AdminController@export');
	Route::get('export-company', 'AdminController@exportCompany');


});




Route::group(['prefix' => 'buyer'], function() {

	Route::post('/submitpassword', 'BuyerController@submitpassword')->name('submitpassword');
	Route::post('/templogin', 'BuyerController@templogin')->name('templogin');
	Route::get('/registration/{id}', 'BuyerController@registration')->name('registration');
	Route::get('/dashboard', 'BuyerController@dashboard')->name('dashboard');
	Route::get('/set-password/{id}', 'BuyerController@setpassword')->name('set-password');
	Route::get('/product-group-list', 'BuyerController@productGroupList')->name('productGroupList');
	Route::get('/add-product-group', 'BuyerController@addProductGroup')->name('addProductGroup');
	Route::get('/add-ship-location', 'BuyerController@addShipLocation')->name('addShipLocation');
	Route::get('/ship-location-list', 'BuyerController@shipLocationList')->name('shipLocationList');
	Route::get('/add-payment-terms', 'BuyerController@addPaymentTerms')->name('addPaymentTerms');
	Route::get('/payment-terms-list', 'BuyerController@paymentTermsList')->name('paymentTermsList');
	Route::get('/add-ship-method', 'BuyerController@addShipMethod')->name('addShipMethod');
	Route::get('/ship-method-list', 'BuyerController@shipMethodList')->name('shipMethodList');
	Route::get('/add-delivery-terms', 'BuyerController@addDeliveryTerms')->name('addDeliveryTerms');
	Route::get('/delivery-terms-list', 'BuyerController@deliveryTermsList')->name('deliveryTermsList');
	
	
	Route::get('/add-unit-measures', 'BuyerController@addUnitMeasures')->name('addUnitMeasures');
	Route::get('/unit-measures-list', 'BuyerController@unitMeasuresList')->name('unitMeasuresList');
	Route::get('/add-item', 'BuyerController@addItem')->name('addItem');
	Route::get('/item-list', 'BuyerController@itemList')->name('itemList');
	Route::get('/add-supplier', 'BuyerController@addSupplier')->name('addSupplier');
	Route::get('/supplier-list', 'BuyerController@supplierList')->name('supplierList');
	Route::get('/create-rfq', 'BuyerController@createRfq')->name('createRfq');
	Route::get('/rfq-list', 'BuyerController@rfqList')->name('rfqList');
	
	
	
	
	
	Route::post('/submitaddProductGroupFormApi', 'BuyerController@submitaddProductGroupFormApi')->name('submitaddProductGroupFormApi');
	Route::post('/submitaddShipLocationFormApi', 'BuyerController@submitaddShipLocationFormApi')->name('submitaddShipLocationFormApi');
	Route::post('/submitpaymentTermsFormApi', 'BuyerController@submitpaymentTermsFormApi')->name('submitpaymentTermsFormApi');
	Route::post('/submitaddShipMethodFormApi', 'BuyerController@submitaddShipMethodFormApi')->name('submitaddShipMethodFormApi');
	
	
	Route::post('/submitaddDeliveryTermFormApi', 'BuyerController@submitaddDeliveryTermFormApi')->name('submitaddDeliveryTermFormApi');
	Route::post('/submitaddUnitMeasuresFormApi', 'BuyerController@submitaddUnitMeasuresFormApi')->name('submitaddUnitMeasuresFormApi');
	Route::post('/submitaddItemFormApi', 'BuyerController@submitaddItemFormApi')->name('submitaddItemFormApi');
	Route::post('/submitaddSupplierFormApi', 'BuyerController@submitaddSupplierFormApi')->name('submitaddSupplierFormApi');
});


