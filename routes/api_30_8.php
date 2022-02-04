<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::namespace('Api')->group(function () {
    
    Route::namespace('V1')->prefix('/v1')->group(function () {
        
        Route::post('signup', 'SignupController@register');
        Route::post('login', 'SignupController@login');
        Route::post('logout', 'SignupController@logout');
		Route::post('submitrfqrange', 'AdminDashboardController@submitrfqrange');
        Route::post('submitIndustries', 'AdminDashboardController@submitIndustries');
        Route::post('submitPayment', 'AdminDashboardController@submitPayment');
        Route::post('submitRiskLevel', 'AdminDashboardController@submitRiskLevel');
        Route::post('submitPriceSetup', 'AdminDashboardController@submitPriceSetup');
        Route::post('submitaddcompany', 'AdminDashboardController@submitaddcompany');
        Route::post('submitaddcompanyuser', 'AdminDashboardController@submitaddcompanyuser');
        
        Route::post('submitrfqstatus', 'AdminDashboardController@submitrfqstatus');
        Route::post('changeRfqStatus', 'AdminDashboardController@changeRfqStatus');
        Route::post('deleteByID', 'AdminDashboardController@deleteByID');
        Route::post('updateByID', 'AdminDashboardController@updateByID');
        Route::post('createpassword', 'AdminDashboardController@createpassword');


        Route::get('priceList', 'AdminDashboardController@priceList');
        Route::get('supplierRiskLevelList', 'AdminDashboardController@supplierRiskLevelList');
        Route::get('paymenttermsList', 'AdminDashboardController@paymenttermsList');
        Route::get('industryList', 'AdminDashboardController@industryList');
        Route::get('rfqRangeList', 'AdminDashboardController@rfqRangeList');
        Route::get('notAssignedRfqRangeList', 'AdminDashboardController@notAssignedRfqRangeList');
        Route::get('companyList', 'AdminDashboardController@companyList');
        Route::get('companyUserList', 'AdminDashboardController@companyUserList');
        Route::get('rfqStatusList', 'AdminDashboardController@rfqStatusList');
        Route::get('userDetails/{id}', 'AdminDashboardController@userDetails');
        Route::get('userDetailsbyCompanyId/{id}', 'AdminDashboardController@userDetailsbyCompanyId');
        Route::get('companydetails/{id}', 'AdminDashboardController@companydetails');
        Route::get('pricesetupdetails/{id}', 'AdminDashboardController@pricesetupdetails');
        Route::get('companydetailsByID/{id}', 'AdminDashboardController@companydetailsByID');
        /*
        * all route they will need auth
        */
        Route::group(['middleware' => 'auth:api'], function(){

            // Signup
			
            Route::post('change_password', 'SignupController@changePassword');
            Route::post('edit_profile', 'SignupController@editProfile');

            // Dashboard
            Route::get('dashboard', 'DashboardController@dashboard');
            Route::get('about_us', 'DashboardController@aboutUs');
            Route::get('settiing_list', 'DashboardController@settingsList');

            // User
            Route::get('my_account', 'UsersController@myAccount');
            Route::get('get_user_detail', 'UsersController@userDetails');
            Route::get('contact_us', 'UsersController@contactUs');
            
  
            // Jobs
            Route::match(["GET", "POST"], 'jobs-list', 'JobsController@jobList');
            Route::post('create-job', 'JobsController@createJob');
            Route::post('apply-job', 'JobsController@applyJob');

            // Documents
            Route::apiResource('documents', 'DocumentController');
            Route::post('document-read', 'DocumentController@documentRead');

        });

		
		Route::post('submitaddProductGroupFormApi', 'BuyerDashboardController@submitaddProductGroupFormApi');
		Route::post('submitaddShipLocationFormApi', 'BuyerDashboardController@submitaddShipLocationFormApi');
		Route::post('submitpaymentTermsFormApi', 'BuyerDashboardController@submitpaymentTermsFormApi');
		Route::post('submitaddShipMethodFormApi', 'BuyerDashboardController@submitaddShipMethodFormApi');
		Route::post('submitaddDeliveryTermFormApi', 'BuyerDashboardController@submitaddDeliveryTermFormApi');
		Route::post('submitaddUnitMeasuresFormApi', 'BuyerDashboardController@submitaddUnitMeasuresFormApi');
		Route::post('submitaddItemFormApi', 'BuyerDashboardController@submitaddItemFormApi');
		Route::post('submitaddSupplierFormApi', 'BuyerDashboardController@submitaddSupplierFormApi');
		Route::post('submitaddRfqFormApi', 'BuyerDashboardController@submitaddRfqFormApi');
		Route::post('submitaddRfqItemFormApi', 'BuyerDashboardController@submitaddRfqItemFormApi');
		
		
		Route::get('productGroupList/{id}', 'BuyerDashboardController@productGroupList');
		Route::get('shipLocationList/{id}', 'BuyerDashboardController@shipLocationList');
		Route::get('buyerPaymentTermsList/{id}', 'BuyerDashboardController@buyerPaymentTermsList');
		Route::get('shipMethodList/{id}', 'BuyerDashboardController@shipMethodList');
		Route::get('deliveryTermsList/{id}', 'BuyerDashboardController@deliveryTermsList');
		Route::get('unitMeasuresList/{id}', 'BuyerDashboardController@unitMeasuresList');
		Route::get('itemList/{id}', 'BuyerDashboardController@itemList');
		Route::get('supplierList/{id}', 'BuyerDashboardController@supplierList');
		Route::get('rfqList/{id}', 'BuyerDashboardController@rfqList');
		Route::get('rfqItemList/{id}', 'BuyerDashboardController@rfqItemList');
		 
		
		
		
		Route::get('productGroupDetails/{id}', 'BuyerDashboardController@productGroupDetails');
		Route::get('shipLocationDetails/{id}', 'BuyerDashboardController@shipLocationDetails');
		Route::get('paymentTermsDetails/{id}', 'BuyerDashboardController@paymentTermsDetails');
		Route::get('shipMethodDetails/{id}', 'BuyerDashboardController@shipMethodDetails');
		Route::get('deliveryTermsDetails/{id}', 'BuyerDashboardController@deliveryTermsDetails');
		Route::get('unitMeasuresDetails/{id}', 'BuyerDashboardController@unitMeasuresDetails');
		Route::get('itemDetails/{id}', 'BuyerDashboardController@itemDetails');
		Route::get('supplierDetails/{id}', 'BuyerDashboardController@supplierDetails');
		Route::get('rfqDetails/{id}', 'BuyerDashboardController@rfqDetails');
		Route::get('rfqItemDetails/{id}', 'BuyerDashboardController@rfqItemDetails');
		
		Route::post('submitaddUserApi', 'BuyerDashboardController@submitaddUserApi');
		Route::get('userList/{id}', 'BuyerDashboardController@userList');
		
		Route::post('sendRfqSupplierFormApi', 'BuyerDashboardController@sendRfqSupplierFormApi');
		
		Route::get('rfqItemSendList/{id}', 'BuyerDashboardController@rfqItemSendList');
		
		
		
		Route::get('rfqItemSendListForSupplierPanel/{id}', 'BuyerDashboardController@rfqItemSendListForSupplierPanel');
		Route::get('rfqItemSendListForSupplier/{rfq_id}/{id}', 'BuyerDashboardController@rfqItemSendListForSupplier');
		Route::post('submititemQuoteFormApi', 'BuyerDashboardController@submititemQuoteFormApi');
		Route::post('cancelSendRfq', 'BuyerDashboardController@cancelSendRfq');
		Route::post('statusChangeofQuote', 'BuyerDashboardController@statusChangeofQuote');
		
		
		Route::get('getCountryList', 'BuyerDashboardController@getCountryList');
		Route::get('getStateList/{id}', 'BuyerDashboardController@getStateList');
		
		Route::post('buyerdeleteByID', 'BuyerDashboardController@buyerdeleteByID');
    });
});