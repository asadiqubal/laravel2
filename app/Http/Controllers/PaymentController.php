<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;
use App\Model\PriceSetup;
use App\User;
use App\Model\Company;
use Auth;
use Session;

class PaymentController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        //$this->middleware('auth'); // later enable it when needed user login while payment
    }

    // start page form after start
    public function pay($id=null) {
		if($id ==""){
		      $message_text = 'There were some issue with the payment. Please try again later.';
                $msg_type = "error_msg"; 
			 return redirect('/buyer/dashboard')->with($msg_type, $message_text);
		}
		$user_id = Auth::user()->id;
		$userdata = User::where('id',$user_id)->first();
		$company_id  = $userdata['company_name'];
		$companyData = Company::where('id',$company_id)->first();
		$data['userdata'] = $userdata;
		$data['companyData'] = $companyData;
		
		$priceDetails = PriceSetup::find($id);
		if(empty($priceDetails)){
		     $message_text = 'There were some issue with the payment. Please try again later.';
                $msg_type = "error_msg"; 
			 return redirect('/buyer/dashboard')->with($msg_type, $message_text);
		}
		//dd($priceDetails->price); die;
		$data['priceDetails'] = $priceDetails;
		$data['subscription_id'] = $id;
        return view('buyer.pay',$data);
    }

    public function handleonlinepay(Request $request) {
        $input = $request->input();
        $user_id = Auth::user()->id;
		
        /* Create a merchantAuthenticationType object with authentication details
          retrieved from the constants file */
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName(env('MERCHANT_LOGIN_ID'));
        $merchantAuthentication->setTransactionKey(env('MERCHANT_TRANSACTION_KEY'));
		
		//dd($input);die;
		
		
        // Set the transaction's refId
        $refId = 'ref' . time();
        $cardNumber = preg_replace('/\s+/', '', $input['cardNumber']);
        
		define("CCNUMBER",$cardNumber);
	//	$creditCard->setCardNumber(CCNUMBER);
			
        // Create the payment data for a credit card
        $creditCard = new AnetAPI\CreditCardType();
        $creditCard->setCardNumber(CCNUMBER);
        $creditCard->setExpirationDate($input['expiration-year'] . "-" .$input['expiration-month']);
        $creditCard->setCardCode($input['cvv']);
		
		



        // Add the payment data to a paymentType object
        $paymentOne = new AnetAPI\PaymentType();
        $paymentOne->setCreditCard($creditCard);

        // Create a TransactionRequestType object and add the previous objects to it
        $transactionRequestType = new AnetAPI\TransactionRequestType();
        $transactionRequestType->setTransactionType("authCaptureTransaction");
        $transactionRequestType->setAmount($input['amount']);
        $transactionRequestType->setPayment($paymentOne);

        // Assemble the complete transaction request
        $requests = new AnetAPI\CreateTransactionRequest();
        $requests->setMerchantAuthentication($merchantAuthentication);
        $requests->setRefId($refId);
        $requests->setTransactionRequest($transactionRequestType);

        // Create the controller and get the response
        $controller = new AnetController\CreateTransactionController($requests);
        $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);

        if ($response != null) {
            // Check to see if the API request was successfully received and acted upon
            if ($response->getMessages()->getResultCode() == "Ok") {
                // Since the API request was successful, look for a transaction response
                // and parse it to display the results of authorizing the card
                $tresponse = $response->getTransactionResponse();

                if ($tresponse != null && $tresponse->getMessages() != null) {
//                    echo " Successfully created transaction with Transaction ID: " . $tresponse->getTransId() . "\n";
//                    echo " Transaction Response Code: " . $tresponse->getResponseCode() . "\n";
//                    echo " Message Code: " . $tresponse->getMessages()[0]->getCode() . "\n";
//                    echo " Auth Code: " . $tresponse->getAuthCode() . "\n";
//                    echo " Description: " . $tresponse->getMessages()[0]->getDescription() . "\n";
                    $message_text = $tresponse->getMessages()[0]->getDescription().", Transaction ID: " . $tresponse->getTransId();
                    $msg_type = "success_msg";    
                    
                   $payment_id =  \App\PaymentLogs::create([                                         
                        'amount' => $input['amount'],
                        'response_code' => $tresponse->getResponseCode(),
                        'transaction_id' => $tresponse->getTransId(),
                        'auth_id' => $tresponse->getAuthCode(),
                        'subscription_id' => $request->subscription_id,
                        'user_id' => $user_id,
                        'message_code' => $tresponse->getMessages()[0]->getCode(),
                        'name_on_card' => trim($input['owner']),
                        'quantity'=>1
                    ])->id;
					
					$userDetails = User::find($user_id);
					
					$saveData['payment_status'] = 1;
					$saveData['payment_id'] = $payment_id;
					$saveData['subscription_id'] =$request->subscription_id;
					$saveData['total_pay'] = $input['amount'];
					User::where('id', $user_id)
                    ->update($saveData);
					
					$company_id = $userDetails->company_name;
					
					$companyDetails = Company::find($company_id);
					
					$comData['no_of_users'] = $input['no_of_users'];
					Company::where('id', $company_id)
                    ->update($comData);
					
                } else {
                    $message_text = 'There were some issue with the payment. Please try again later.';
                    $msg_type = "error_msg";                                    

                    if ($tresponse->getErrors() != null) {
                        $message_text = $tresponse->getErrors()[0]->getErrorText();
                        $msg_type = "error_msg";                                    
                    }
                }
                // Or, print errors if the API request wasn't successful
            } else {
                $message_text = 'There were some issue with the payment. Please try again later.';
                $msg_type = "error_msg";                                    

                $tresponse = $response->getTransactionResponse();

                if ($tresponse != null && $tresponse->getErrors() != null) {
                    $message_text = $tresponse->getErrors()[0]->getErrorText();
                    $msg_type = "error_msg";                    
                } else {
                    $message_text = $response->getMessages()->getMessage()[0]->getText();
                    $msg_type = "error_msg";
                }                
            }
        } else {
            $message_text = "No response returned";
            $msg_type = "error_msg";
        }
        return back()->with($msg_type, $message_text);
    }

}
