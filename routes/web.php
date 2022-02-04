<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

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

Route::get('/forgot-password', function () {
    return view('auth.passwords.email');
})->middleware('guest')->name('password.request');


Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');



Route::get('home', 'HomeController@index')->name('home');
Route::get('about-us', 'HomeController@aboutUs')->name('about-us');

Route::get('contact', 'HomeController@contact')->name('contact');
Route::post('/submitContact', 'HomeController@submitContact')->name('submitContact');
Route::post('/submitscheduleDemo', 'HomeController@submitscheduleDemo')->name('submitscheduleDemo');


Route::get('features', 'HomeController@features')->name('features');
Route::get('industry-news', 'HomeController@industryNews')->name('industry-news');
Route::get('pricing', 'HomeController@pricing')->name('pricing');
Route::get('schedule-demo', 'HomeController@scheduleDemo')->name('schedule-demo');Route::get('/', function () {
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

	Route::get('getPriceForUserList/{id}', 'AdminController@getPriceForUserList');
});




Route::group(['prefix' => 'buyer'], function() {

	Route::post('/submitpassword', 'LoginController@submitpassword')->name('submitpassword');
	Route::post('/templogin', 'LoginController@templogin')->name('templogin');
	Route::get('/registration/{id}', 'LoginController@registration')->name('registration');
	
	Route::get('/set-password/{id}', 'LoginController@setpassword')->name('set-password');
	Route::get('/link-expired', 'LoginController@linkExired')->name('link-expired');
	
	Route::get('/dashboard', 'BuyerController@dashboard')->name('dashboard');
	
	Route::get('/product-group-list', 'BuyerController@productGroupList')->name('productGroupList');
	Route::get('/edit-product-group/{id}', 'BuyerController@editProductGroup')->name('editProductGroup');
	Route::get('/add-product-group', 'BuyerController@addProductGroup')->name('addProductGroup');
	
	Route::get('/add-ship-location', 'BuyerController@addShipLocation')->name('addShipLocation');
	Route::get('/edit-ship-location/{id}', 'BuyerController@editShipLocation')->name('editShipLocation');
	Route::get('/ship-location-list', 'BuyerController@shipLocationList')->name('shipLocationList');
	
	Route::get('/add-payment-terms', 'BuyerController@addPaymentTerms')->name('addPaymentTerms');
	Route::get('/edit-payment-terms/{id}', 'BuyerController@editPaymentTerms')->name('editPaymentTerms');
	Route::get('/payment-terms-list', 'BuyerController@paymentTermsList')->name('paymentTermsList');
	
	Route::get('/add-ship-method', 'BuyerController@addShipMethod')->name('addShipMethod');
	Route::get('/edit-ship-method/{id}', 'BuyerController@editShipMethod')->name('editShipMethod');
	Route::get('/ship-method-list', 'BuyerController@shipMethodList')->name('shipMethodList');
	
	Route::get('/add-delivery-terms', 'BuyerController@addDeliveryTerms')->name('addDeliveryTerms');
	Route::get('/edit-delivery-terms/{id}', 'BuyerController@editDeliveryTerms')->name('editDeliveryTerms');
	Route::get('/delivery-terms-list', 'BuyerController@deliveryTermsList')->name('deliveryTermsList');
	
	
	Route::get('/add-unit-measures', 'BuyerController@addUnitMeasures')->name('addUnitMeasures');
	Route::get('/edit-unit-measures/{id}', 'BuyerController@editUnitMeasures')->name('editUnitMeasures');
	Route::get('/unit-measures-list', 'BuyerController@unitMeasuresList')->name('unitMeasuresList');
	
	Route::get('/add-item', 'BuyerController@addItem')->name('addItem');
	Route::get('/edit-item/{id}', 'BuyerController@editItem')->name('editItem');
	Route::get('/item-list', 'BuyerController@itemList')->name('itemList');
	
	Route::get('/add-supplier', 'BuyerController@addSupplier')->name('addSupplier');
	Route::get('/edit-supplier/{id}', 'BuyerController@editSupplier')->name('editSupplier');
	Route::get('/supplier-list', 'BuyerController@supplierList')->name('supplierList');
	
	Route::get('/create-rfq', 'BuyerController@createRfq')->name('createRfq');
	Route::get('/edit-rfq/{id}', 'BuyerController@editRfq')->name('editRfq');
	Route::get('/view-rfq/{id}', 'BuyerController@viewRfq')->name('viewRfq');
	Route::get('/rfq-list', 'BuyerController@rfqList')->name('rfqList');
	Route::get('/draft-rfq-list', 'BuyerController@draftRfqList')->name('draftRfqList');
	
	Route::get('/create-rfq-item/{id}', 'BuyerController@createRfqItem')->name('createRfqItem');
	Route::get('/edit-rfq-item/{rfq_id}/{id}', 'BuyerController@editRfqItem')->name('editRfqItem');
	Route::get('/rfq-item-list/{id}', 'BuyerController@rfqItemList')->name('rfqItemList');
	
	
	
	
	
	Route::post('/submitaddProductGroupFormApi', 'BuyerController@submitaddProductGroupFormApi')->name('submitaddProductGroupFormApi');
	Route::post('/submitaddShipLocationFormApi', 'BuyerController@submitaddShipLocationFormApi')->name('submitaddShipLocationFormApi');
	Route::post('/submitpaymentTermsFormApi', 'BuyerController@submitpaymentTermsFormApi')->name('submitpaymentTermsFormApi');
	Route::post('/submitaddShipMethodFormApi', 'BuyerController@submitaddShipMethodFormApi')->name('submitaddShipMethodFormApi');
	Route::post('/submitaddDeliveryTermFormApi', 'BuyerController@submitaddDeliveryTermFormApi')->name('submitaddDeliveryTermFormApi');
	Route::post('/submitaddUnitMeasuresFormApi', 'BuyerController@submitaddUnitMeasuresFormApi')->name('submitaddUnitMeasuresFormApi');
	Route::post('/submitaddItemFormApi', 'BuyerController@submitaddItemFormApi')->name('submitaddItemFormApi');
	Route::post('/submitaddSupplierFormApi', 'BuyerController@submitaddSupplierFormApi')->name('submitaddSupplierFormApi');
	Route::post('/submitaddRfqFormApi', 'BuyerController@submitaddRfqFormApi')->name('submitaddRfqFormApi');
	Route::post('/submitaddRfqItemFormApi', 'BuyerController@submitaddRfqItemFormApi')->name('submitaddRfqItemFormApi');
	
	Route::post('/submitaddUserApi', 'BuyerController@submitaddUserApi')->name('submitaddUserApi');
	Route::get('/add-user', 'BuyerController@addUser')->name('add-user');
	Route::get('/edit-user/{id}', 'BuyerController@editUser')->name('edit-user');
	Route::get('/user-list', 'BuyerController@userList')->name('user-list');
	
	Route::get('/getPaymentStatus', 'BuyerController@getPaymentStatus')->name('getPaymentStatus');
	Route::get('/make-payment', 'BuyerController@makePayment')->name('makePayment');
	
	
	Route::get('/rfq-send-details/{id}', 'BuyerController@rfqSendDetails')->name('rfqSendDetails');
	
	
	Route::post('/add-rfq-item-form/{id}', 'BuyerController@addRfqItemForm')->name('addRfqItemForm');
	Route::post('/get_unit_and_product_group_of_item/{id}', 'BuyerController@get_unit_and_product_group_of_item')->name('get_unit_and_product_group_of_item');
	
	Route::post('/sendRfqSupplierFormApi', 'BuyerController@sendRfqSupplierFormApi')->name('sendRfqSupplierFormApi');
	Route::get('/rfq-item-send-details/{rfq_id}/{id}', 'BuyerController@rfqItemSendDetails')->name('rfq-item-send-details');
	Route::get('/cancel-send-rfq/{id}', 'BuyerController@cancelSendRfq')->name('cancel-send-rfq');
	Route::get('/status-change-quote/{supplier_quotes_on_rfq_items_id}/{rfq_id}/{supplier_id}/{status}', 'BuyerController@statusChangeofQuote')->name('status-change-quote');
	
	Route::get('/ship-details/{id}', 'BuyerController@shipDetails')->name('ship-details');
	
	Route::get('/deleteByID/{model}/{id}', 'BuyerController@deleteByID');
	
	Route::get('/pay/{id}','PaymentController@pay')->name('pay');
	Route::post('/dopay/online', 'PaymentController@handleonlinepay')->name('dopay.online');
	
	
	Route::post('/import-supplier', 'BuyerController@importSupplier')->name('import-supplier');
	Route::post('/import-items', 'BuyerController@importItem')->name('import-items');
	
	
	Route::get('/import-supplier', 'BuyerController@getimportSupplier')->name('import-supplier');
	Route::get('/import-items', 'BuyerController@getimportItem')->name('import-items');
	
	
Route::get('/subscription', 'BuyerController@subscription')->name('subscription');
Route::get('/updateRfqPastDue', 'BuyerController@updateRfqPastDue')->name('updateRfqPastDue');


});

Route::group(['prefix' => 'supplier'], function() {
	
	Route::post('/submititemQuoteFormApi', 'SupplierController@submititemQuoteFormApi')->name('submititemQuoteFormApi');
	Route::post('/submititemQuoteFormForReviseApi', 'SupplierController@submititemQuoteFormForReviseApi')->name('submititemQuoteFormForReviseApi');
	Route::post('/submititemQuoteFormApiPopup', 'SupplierController@submititemQuoteFormApiPopup')->name('submititemQuoteFormApiPopup');
	Route::post('/submitpassword', 'SupplierController@submitpassword')->name('submitpassword');
	Route::post('/templogin', 'SupplierController@templogin')->name('templogin');
	Route::get('/registration/{id}', 'SupplierController@registration')->name('registration');
	Route::get('/dashboard', 'SupplierController@dashboard')->name('dashboard');
	Route::get('/set-password/{id}', 'SupplierController@setpassword')->name('set-password');
	Route::get('/rfq-list', 'SupplierController@rfqList')->name('rfq-list');
	Route::get('/rfq-item-send-details/{id}', 'SupplierController@rfqItemSendDetails')->name('rfq-item-send-details');
	
});
