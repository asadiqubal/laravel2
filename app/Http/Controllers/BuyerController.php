<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Auth;
use Session;
use App\User;
use App\PaymentLogs;
use App\Model\Company;
use App\Model\Supplier;
use App\Model\RfqItemSend;
use App\Model\RfqItem;
use App\Model\RfqRange;
use App\Model\RfqItemDoc;
use App\Model\Rfq;
use App\Model\Country;
use App\Model\PriceSetup;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

use App\Imports\SuppliersImport;
use App\Imports\itemsImport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use DB;

class BuyerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('role:ROLE_SUPERADMIN');
    }

  /*   public function registration($id)
    {
		
		$userData = User::where('encoded_id',$id)->get();
	
		if(empty($userData[0]['email'])){
			return redirect('login')->with('error','Invalid user details.');		
		}
		if(empty($userData[0]['temp_password'])){
			return redirect('login')->with('error','Expired link.');		
		}
		
		$data['username']=  $userData[0]['email'];
		$data['password']=  $userData[0]['temp_password'];
        return view('buyer.welcome',$data);
    }
	
	public function templogin(Request $request)
    {
       $password = $request['password'];
       $email = $request['email'];
	   
	   $data = User::where('email',$email)->where('temp_password',$password)->get();
        
		if ($data->count()>0) {
			
			return redirect('buyer/set-password/'.$data[0]['encoded_id']);
				
			
		}else{
			return redirect()->back()->with('error','Invalid login details.');		
		}
    }
	
	public function setpassword($id){
	
		 $userid = $id;
		if(empty($userid)){
			return redirect()->back()->with('error','Invalid login details.');	
		}
		$data['userid'] = $userid;
		return view('buyer.setpassword',$data);
	}
	public function submitpassword(Request $request){
		
		try{

			$http = new \GuzzleHttp\Client();
			$password    		= $request->password;
			$cpassword    		= $request->cpassword;
			$user_id    		= $request->user_id;

			$response = $http->post(''.env('APP_URL').'api/v1/createpassword?',[
				'headers'=>[
					'Authorization'=>'Bearer'.session()->get('token.access_token')
				],
				'query'=>[
					'password'=>$password,
					'user_id'=>$user_id
				]
			]);
			$result = json_decode((string)$response->getBody(),true);
			
			return redirect('login')->with('success',$result['message']);
			
        }catch(\Exception $e){
        //    return redirect()->back()->with('error','Please fill all required fileds.');
        } 
	} */
	
	public function dashboard()
    {
		$today = date('Y-m-d');
		//$rfqs = Rfq::where('created_at','<', Carbon::today())->orWhere('created_at','>', Carbon::today())->count();
		$inprocessrfqs = Rfq::where('status',0)->where('is_deleted',NULL)->where('buyer_id',Auth::user()->id)->count();
		$watingrfqs = Rfq::where('status',1)->where('is_deleted',NULL)->where('buyer_id',Auth::user()->id)->count();
		$awardgrfqs = Rfq::where('status',2)->where('is_deleted',NULL)->where('buyer_id',Auth::user()->id)->count();
		$closerfqs = Rfq::where('status',3)->where('is_deleted',NULL)->where('buyer_id',Auth::user()->id)->count();
		$rfqs = Rfq::whereDate('created_at', Carbon::today())->where('is_deleted',NULL)->where('buyer_id',Auth::user()->id)->get();
		$rfqsdue = Rfq::whereDate('rfq_response_dead_line','<', Carbon::today())->where('is_deleted',NULL)->where('buyer_id',Auth::user()->id)->get();
		$data['todayrfq'] = count($rfqs);
		$data['rfqsdue'] = count($rfqsdue);
		$data['inprocessrfqs'] = $inprocessrfqs;
		$data['watingrfqs'] = $watingrfqs;
		$data['awardgrfqs'] = $awardgrfqs;
		$data['closerfqs'] = $closerfqs;


		
        return view('buyer.dashboard',$data);
    }
	public function productGroupList()
    {
       $user_id = Auth::user()->id;
		$http = new \GuzzleHttp\Client();
		$response3 = $http->get(''.env('APP_URL').'api/v1/productGroupList/'.$user_id);
		$result3 = json_decode((string)$response3->getBody(),true);
		$data['product_group_list'] = $result3;
        
        
	   return view('buyer.product-group-list',$data);
    }
	public function addProductGroup()
    {
		$data['details'] = '';
        return view('buyer.add-product-group',$data);
    }
	public function editProductGroup($id=null)
    {
		$http = new \GuzzleHttp\Client();
		$response1 = $http->get(''.env('APP_URL').'api/v1/productGroupDetails/'.$id);
		$details = json_decode((string)$response1->getBody(),true);
		$data['details'] = $details;
		$data['id'] = $id;
        return view('buyer.add-product-group',$data);
    }
	
	
	
	
	public function addShipLocation()
    {
		$http = new \GuzzleHttp\Client();
		$response1 = $http->get(''.env('APP_URL').'api/v1/getCountryList/');
		$country = json_decode((string)$response1->getBody(),true);
		
		$response2 = $http->get(''.env('APP_URL').'api/v1/getStateList/231');
		$state = json_decode((string)$response2->getBody(),true);
		
		
		$data['countryList'] = $country;
		$data['stateList'] = $state;
		
        return view('buyer.add-ship-location',$data);
    }
	public function editShipLocation($id=null)
    {
		$http = new \GuzzleHttp\Client();
		$response1 = $http->get(''.env('APP_URL').'api/v1/shipLocationDetails/'.$id);
		$details = json_decode((string)$response1->getBody(),true);
		$data['details'] = $details;
		$data['id'] = $id;
		
		
		$response3 = $http->get(''.env('APP_URL').'api/v1/getCountryList/');
		$country = json_decode((string)$response3->getBody(),true);
		
		$response2 = $http->get(''.env('APP_URL').'api/v1/getStateList/231');
		$state = json_decode((string)$response2->getBody(),true);
		
		$data['countryList'] = $country;
		$data['stateList'] = $state;
		
        return view('buyer.add-ship-location',$data);
    }
	public function shipLocationList()
    {
		$user_id = Auth::user()->id;
		$http = new \GuzzleHttp\Client();
		$response3 = $http->get(''.env('APP_URL').'api/v1/shipLocationList/'.$user_id);
		$result3 = json_decode((string)$response3->getBody(),true);
		$data['ship_location_list'] = $result3;
		
        return view('buyer.ship-location-list',$data);
    }
	
	
	public function addPaymentTerms()
    {
        return view('buyer.add-payment-terms');
    }
	public function editPaymentTerms($id=null)
    {
		$http = new \GuzzleHttp\Client();
		$response1 = $http->get(''.env('APP_URL').'api/v1/paymentTermsDetails/'.$id);
		$details = json_decode((string)$response1->getBody(),true);
		$data['details'] = $details;
		$data['id'] = $id;
        return view('buyer.add-payment-terms',$data);
    }
	public function paymentTermsList()
    {
		$user_id = Auth::user()->id;
		$http = new \GuzzleHttp\Client();
		$response3 = $http->get(''.env('APP_URL').'api/v1/buyerPaymentTermsList/'.$user_id);
		$result3 = json_decode((string)$response3->getBody(),true);
		$data['payment_term_list'] = $result3;
		
		
        return view('buyer.payment-terms-list',$data);
    }
	
	
	public function addShipMethod()
    {
        return view('buyer.add-ship-method');
    }
	public function editShipMethod($id=null)
    {
		$http = new \GuzzleHttp\Client();
		$response1 = $http->get(''.env('APP_URL').'api/v1/shipMethodDetails/'.$id);
		$details = json_decode((string)$response1->getBody(),true);
		$data['details'] = $details;
		$data['id'] = $id;
        return view('buyer.add-ship-method',$data);
    }
	public function shipMethodList()
    {
		
		$user_id = Auth::user()->id;
		$http = new \GuzzleHttp\Client();
		$response3 = $http->get(''.env('APP_URL').'api/v1/shipMethodList/'.$user_id);
		$result3 = json_decode((string)$response3->getBody(),true);
		$data['ship_method_list'] = $result3;
		
        return view('buyer.ship-method-list',$data);
		
    }
	
	
	public function addDeliveryTerms()
    {
        return view('buyer.add-delivery-terms');
    }
	public function editDeliveryTerms($id=null)
    {
		
		$http = new \GuzzleHttp\Client();

		$response1 = $http->get(''.env('APP_URL').'api/v1/deliveryTermsDetails/'.$id);
	
		$details = json_decode((string)$response1->getBody(),true);

		$data['details'] = $details;
		$data['id'] = $id;
        return view('buyer.add-delivery-terms',$data);
    }
	public function deliveryTermsList()
    {
		$user_id = Auth::user()->id;
		$http = new \GuzzleHttp\Client();
		$response3 = $http->get(''.env('APP_URL').'api/v1/deliveryTermsList/'.$user_id);
		$result3 = json_decode((string)$response3->getBody(),true);
		$data['delivery_term_list'] = $result3;
		
        return view('buyer.delivery-terms-list',$data);
    }
	
	
	public function addUnitMeasures()
    {
        return view('buyer.add-unit-measures');
    }
	public function editUnitMeasures($id=null)
    {
		
		$http = new \GuzzleHttp\Client();

		$response1 = $http->get(''.env('APP_URL').'api/v1/unitMeasuresDetails/'.$id);
	
		$details = json_decode((string)$response1->getBody(),true);


		$data['details'] = $details;
		$data['id'] = $id;
        return view('buyer.add-unit-measures',$data);
    }
	public function unitMeasuresList()
    {
		$user_id = Auth::user()->id;
		$http = new \GuzzleHttp\Client();
		$response3 = $http->get(''.env('APP_URL').'api/v1/unitMeasuresList/'.$user_id);
		$result3 = json_decode((string)$response3->getBody(),true);
		$data['unit_measure_list'] = $result3;
        return view('buyer.unit-measures-list',$data);
    }
	
	
	
	public function addItem()
    {
		$user_id = Auth::user()->id;
		$http = new \GuzzleHttp\Client();
		$response3 = $http->get(''.env('APP_URL').'api/v1/unitMeasuresList/'.$user_id);
		$result3 = json_decode((string)$response3->getBody(),true);
		$data['unit_measure_list'] = $result3;
		
		$user_id = Auth::user()->id;
		$http = new \GuzzleHttp\Client();
		$response1 = $http->get(''.env('APP_URL').'api/v1/productGroupList/'.$user_id);
		$result1 = json_decode((string)$response1->getBody(),true);
		$data['product_group_list'] = $result1;
		
        return view('buyer.add-item',$data);
    }
	public function editItem($id=null)
    {
		
		$http = new \GuzzleHttp\Client();

		$response1 = $http->get(''.env('APP_URL').'api/v1/itemDetails/'.$id);
	
		$details = json_decode((string)$response1->getBody(),true);

		
		$user_id = Auth::user()->id;
		$response3 = $http->get(''.env('APP_URL').'api/v1/unitMeasuresList/'.$user_id);
		$result3 = json_decode((string)$response3->getBody(),true);
		$data['unit_measure_list'] = $result3;
		
		$response2 = $http->get(''.env('APP_URL').'api/v1/productGroupList/'.$user_id);
		$result2 = json_decode((string)$response2->getBody(),true);
		$data['product_group_list'] = $result2;
		
		
		$data['details'] = $details;
		$data['id'] = $id;
        return view('buyer.add-item',$data);
    }
	public function itemList()
    {
		$user_id = Auth::user()->id;
		$http = new \GuzzleHttp\Client();
		$response3 = $http->get(''.env('APP_URL').'api/v1/itemList/'.$user_id);
		$result3 = json_decode((string)$response3->getBody(),true);
		$data['item_list'] = $result3;
		
        return view('buyer.item-list',$data);
    }
	
	
	
	public function addSupplier()
    {
		$http = new \GuzzleHttp\Client();
		$response1 = $http->get(''.env('APP_URL').'api/v1/getCountryList/');
		$country = json_decode((string)$response1->getBody(),true);
		
		$response2 = $http->get(''.env('APP_URL').'api/v1/getStateList/231');
		$state = json_decode((string)$response2->getBody(),true);
		
		
		$data['countryList'] = $country;
		$data['stateList'] = $state;
		
        return view('buyer.add-supplier',$data);
    }
	public function editSupplier($id=null)
    {
		$http = new \GuzzleHttp\Client();
		$response1 = $http->get(''.env('APP_URL').'api/v1/supplierDetails/'.$id);
		$details = json_decode((string)$response1->getBody(),true);
		$data['details'] = $details;
		$data['id'] = $id;
		
		$response3 = $http->get(''.env('APP_URL').'api/v1/getCountryList/');
		$country = json_decode((string)$response3->getBody(),true);
		
		$response2 = $http->get(''.env('APP_URL').'api/v1/getStateList/231');
		$state = json_decode((string)$response2->getBody(),true);
		
		
		$data['countryList'] = $country;
		$data['stateList'] = $state;
		
		
        return view('buyer.add-supplier',$data);
    }
	public function supplierList()
    {
		$user_id = Auth::user()->id;
		$http = new \GuzzleHttp\Client();
		$response3 = $http->get(''.env('APP_URL').'api/v1/supplierList/'.$user_id);
		$result3 = json_decode((string)$response3->getBody(),true);
		$data['supplier_list'] = $result3;
		
        return view('buyer.supplier-list',$data);
    }
	
	
	
	public function createRfq()
    {
		$user_id = Auth::user()->id;
		$http = new \GuzzleHttp\Client();
		
		$rfq 	= 	Rfq::where('buyer_id',$user_id)->get();
		
		$rfq_count = count($rfq);
		
		$response5 = $http->get(''.env('APP_URL').'api/v1/userDetails/'.$user_id);
	
		$userData = json_decode((string)$response5->getBody(),true);
	
		
		$company_id  = $userData['company_name'];
		$companyData = Company::where('id',$company_id)->first();
		
	
		
		$rfq_range  		=  	$companyData['rfq_range'];
		$rfq_range_list 	= 	RfqRange::where('id',$rfq_range)->first();
		
		/* echo "<pre>";
		print_r($rfq_range_list); die; */
		
		$response1 = $http->get(''.env('APP_URL').'api/v1/shipLocationList/'.$user_id);
		$result1 = json_decode((string)$response1->getBody(),true);
		$data['ship_location_list'] = $result1;
				
		$response3 = $http->get(''.env('APP_URL').'api/v1/buyerPaymentTermsList/'.$user_id);
		$result3 = json_decode((string)$response3->getBody(),true);
		$data['payment_term_list'] = $result3;
		
		$response4 = $http->get(''.env('APP_URL').'api/v1/shipMethodList/'.$user_id);
		$result4 = json_decode((string)$response4->getBody(),true);
		$data['ship_method_list'] = $result4;
		
		
		$data['rfq_range_list'] = $rfq_range_list;
		$data['rfq_count'] = $rfq_count+1;
		
		$data['supplier_item_list'] = array();
		
        return view('buyer.create-rfq',$data);
    }
	public function editRfq($id=null)
    {
		$user_id = Auth::user()->id;
		$http = new \GuzzleHttp\Client();
		
		$rfq 	= 	Rfq::where('buyer_id',$user_id)->get();
		
		$rfq_count = count($rfq);
		
		$response5 = $http->get(''.env('APP_URL').'api/v1/userDetails/'.$user_id);
	
		$userData = json_decode((string)$response5->getBody(),true);
	
		
		$company_id  = $userData['company_name'];
		$companyData = Company::where('id',$company_id)->first();
		
	
		
		$rfq_range  		=  	$companyData['rfq_range'];
		$rfq_range_list 	= 	RfqRange::where('id',$rfq_range)->first();
		
		
		$response1 = $http->get(''.env('APP_URL').'api/v1/shipLocationList/'.$user_id);
		$result1 = json_decode((string)$response1->getBody(),true);
		$data['ship_location_list'] = $result1;
				
		$response3 = $http->get(''.env('APP_URL').'api/v1/buyerPaymentTermsList/'.$user_id);
		$result3 = json_decode((string)$response3->getBody(),true);
		$data['payment_term_list'] = $result3;
		
		$response4 = $http->get(''.env('APP_URL').'api/v1/shipMethodList/'.$user_id);
		$result4 = json_decode((string)$response4->getBody(),true);
		$data['ship_method_list'] = $result4;
		
		

		$response5 = $http->get(''.env('APP_URL').'api/v1/rfqDetails/'.$id);
		$details = json_decode((string)$response5->getBody(),true);
		
		$response6 = $http->get(''.env('APP_URL').'api/v1/rfqItemList/'.$id);
		$result6 = json_decode((string)$response6->getBody(),true);
		//$supplierDetails = Supplier::find(2);
		//dd($result6); die;
		$rfq_list = $data['rfq_item_list'] = $result6;
		
		
		
		$response7 = $http->get(''.env('APP_URL').'api/v1/itemList/'.$user_id);
		$result7 = json_decode((string)$response7->getBody(),true);
		$data['item_list'] = $result7;
				
			
		$response8 = $http->get(''.env('APP_URL').'api/v1/productGroupList/'.$user_id);
		$result8 = json_decode((string)$response8->getBody(),true);
		$data['product_group_list'] = $result8;
		
		$response9 = $http->get(''.env('APP_URL').'api/v1/unitMeasuresList/'.$user_id);
		$result9 = json_decode((string)$response9->getBody(),true);
		$data['unit_list'] = $result9;
		
		
		$response10 = $http->get(''.env('APP_URL').'api/v1/supplierList/'.$user_id);
		$result10 = json_decode((string)$response10->getBody(),true);
		$data['supplier_list'] = $result10;
		
		
		
		$data['rfq_range_list'] = $rfq_range_list;
		$data['rfq_count'] = $rfq_count;
		
		$response11 = $http->get(''.env('APP_URL').'api/v1/rfqItemSendList/'.$id);
		$result11 = json_decode((string)$response11->getBody(),true);
		$supplier_item_list = $result11;
		
		$data['supplier_item_list'] = $supplier_item_list;
		
		$data['details'] = $details;
		$data['id'] = $id;
        return view('buyer.create-rfq',$data);
    }
	public function viewRfq($id=null)
    {
		$user_id = Auth::user()->id;
		$http = new \GuzzleHttp\Client();
		
		$rfq 	= 	Rfq::where('buyer_id',$user_id)->get();
		
		$rfq_count = count($rfq);
		
		$response5 = $http->get(''.env('APP_URL').'api/v1/userDetails/'.$user_id);
	
		$userData = json_decode((string)$response5->getBody(),true);
	
		
		$company_id  = $userData['company_name'];
		$companyData = Company::where('id',$company_id)->first();
		
	
		
		$rfq_range  		=  	$companyData['rfq_range'];
		$rfq_range_list 	= 	RfqRange::where('id',$rfq_range)->first();
		
		
		$response1 = $http->get(''.env('APP_URL').'api/v1/shipLocationList/'.$user_id);
		$result1 = json_decode((string)$response1->getBody(),true);
		$data['ship_location_list'] = $result1;
				
		$response3 = $http->get(''.env('APP_URL').'api/v1/buyerPaymentTermsList/'.$user_id);
		$result3 = json_decode((string)$response3->getBody(),true);
		$data['payment_term_list'] = $result3;
		
		$response4 = $http->get(''.env('APP_URL').'api/v1/shipMethodList/'.$user_id);
		$result4 = json_decode((string)$response4->getBody(),true);
		$data['ship_method_list'] = $result4;
		
		

		$response5 = $http->get(''.env('APP_URL').'api/v1/rfqDetails/'.$id);
		$details = json_decode((string)$response5->getBody(),true);
		
		$response6 = $http->get(''.env('APP_URL').'api/v1/rfqItemList/'.$id);
		$result6 = json_decode((string)$response6->getBody(),true);
		//$supplierDetails = Supplier::find(2);
		//dd($result6); die;
		$rfq_list = $data['rfq_item_list'] = $result6;
		
		
		
		$response7 = $http->get(''.env('APP_URL').'api/v1/itemList/'.$user_id);
		$result7 = json_decode((string)$response7->getBody(),true);
		$data['item_list'] = $result7;
				
			
		$response8 = $http->get(''.env('APP_URL').'api/v1/productGroupList/'.$user_id);
		$result8 = json_decode((string)$response8->getBody(),true);
		$data['product_group_list'] = $result8;
		
		$response9 = $http->get(''.env('APP_URL').'api/v1/unitMeasuresList/'.$user_id);
		$result9 = json_decode((string)$response9->getBody(),true);
		$data['unit_list'] = $result9;
		
		
		$response10 = $http->get(''.env('APP_URL').'api/v1/supplierList/'.$user_id);
		$result10 = json_decode((string)$response10->getBody(),true);
		$data['supplier_list'] = $result10;
		
		$response11 = $http->get(''.env('APP_URL').'api/v1/rfqItemSendList/'.$id);
		$result11 = json_decode((string)$response11->getBody(),true);
		$supplier_item_list = $result11;
		
		$data['supplier_item_list'] = $supplier_item_list;
		$data['rfq_range_list'] = $rfq_range_list;
		$data['rfq_count'] = $rfq_count;
		
		
		$data['details'] = $details;
		$data['id'] = $id;
        return view('buyer.view-rfq',$data);
    }
	public function get_unit_and_product_group_of_item($item_id=null){
		
		$user_id = Auth::user()->id;
		$http = new \GuzzleHttp\Client();
		$response5 = $http->get(''.env('APP_URL').'api/v1/itemDetails/'.$item_id);
		$details = json_decode((string)$response5->getBody(),true);
		
		
		$unit_measure   = $data['unit_measure']  	=  $details['unit_measure'];
		$product_group  = $data['product_group']  =  $details['product_group'];
		$description  = $data['description']  =  $details['description'];
		
		$user_id = Auth::user()->id;
		$http = new \GuzzleHttp\Client();
		
		$response1 = $http->get(''.env('APP_URL').'api/v1/itemList/'.$user_id);
		$result1 = json_decode((string)$response1->getBody(),true);
		$item_list = $result1;
		
		
		$response8 = $http->get(''.env('APP_URL').'api/v1/productGroupList/'.$user_id);
		$result8 = json_decode((string)$response8->getBody(),true);
		$product_group_list = $result8;
		
		$response9 = $http->get(''.env('APP_URL').'api/v1/unitMeasuresList/'.$user_id);
		$result9 = json_decode((string)$response9->getBody(),true);
		$unit_list = $result9;
		
		$rfq_id = $item_id;
		$id = "";
		/* return view('buyer.rfq-item-form', array(
		     
            'item_list' => $item_list,
            'unit_list' => $unit_list,
            'product_group_list' => $product_group_list,
            'id' => $id,
            'rfq_id' => $rfq_id,
            'product_group' => $product_group,
            'unit_measure' => $unit_measure,
			                       
        )); */
		
		
		return json_encode($data);
	}
	public function rfqList()
    {
		
		$user_id = Auth::user()->id;
		$http = new \GuzzleHttp\Client();
		
		$response2 = $http->get(''.env('APP_URL').'api/v1/getrfqStatusList/');
		$result2 = json_decode((string)$response2->getBody(),true);
		$data['rfq_status'] = $result2;
		/* echo "<pre>";
		print_r($data['rfq_status']); die;
		 */
		$response1 = $http->get(''.env('APP_URL').'api/v1/itemList/'.$user_id);
		$result1 = json_decode((string)$response1->getBody(),true);
		$data['item_list'] = $result1;
		
		$response10 = $http->get(''.env('APP_URL').'api/v1/supplierList/'.$user_id);
		$result10 = json_decode((string)$response10->getBody(),true);
		$data['supplier_list'] = $result10;
		$data['heading'] = "RFQ List";
		
		$result3 = array();
		if(isset($_GET['status']) && !empty($_GET['status'])){
			$result3 = Rfq::where('is_deleted',NULL)->where('buyer_id',$user_id)->where('is_draft','!=',1)->where('status',$_GET['status'])->orderBy('id','DESC')->get();
			
			$rfq_list = $data['rfq_list'] = $result3;
		
        return view('buyer.rfq-list',$data);
		
		}elseif(isset($_GET['supplier']) && !empty($_GET['supplier'])){
			//$result3 = Rfq::where('is_deleted',NULL)->where('buyer_id',$user_id)->join('')->get();
			
			$result3 = DB::table('rfqs')
            ->join('rfq_item_send', 'rfqs.id', '=', 'rfq_item_send.rfq_id')
            ->select('rfqs.*')
            ->where('rfq_item_send.supplier_id',$_GET['supplier'])
            ->where('rfqs.is_deleted',NULL)
			->where('is_draft','!=',1)
            ->where('rfqs.buyer_id',$user_id)
			->orderBy('id','DESC')
            ->get(); 
			
			$rfq_list = $data['rfq_list'] = $result3;
		
        return view('buyer.rfq-list-supplier-search',$data);
			
		}elseif(isset($_GET['item']) && !empty($_GET['item'])){
			
			
			$result3 = DB::table('rfqs')
            ->join('rfq_item_send', 'rfqs.id', '=', 'rfq_item_send.rfq_id')
            ->select('rfqs.*','rfq_item_send.rfq_items')
			//->whereRaw("find_in_set('rfq_item_send.rfq_items',".$_GET['item'].")")
			->whereRaw("FIND_IN_SET(?, rfq_items) > 0", [$_GET['item']])
            ->where('rfqs.is_deleted',NULL)
			->where('is_draft','!=',1)
            ->where('rfqs.buyer_id',$user_id)
			->orderBy('id','DESC')
            ->get(); 
			
			$rfq_list = $data['rfq_list'] = $result3;
		
        return view('buyer.rfq-list-supplier-search',$data);
		}elseif(isset($_GET['duedate']) && !empty($_GET['duedate'])){
			
			$result3 = Rfq::where('is_deleted',NULL)->where('buyer_id',$user_id)->where('is_draft','!=',1)->where('rfq_response_dead_line','=', $_GET['duedate'])->orderBy('id','DESC')->get();
			
			$rfq_list = $data['rfq_list'] = $result3;
		
        return view('buyer.rfq-list',$data);
		
		}else{
			$response3 = $http->get(''.env('APP_URL').'api/v1/rfqList/'.$user_id);
			$result3 = json_decode((string)$response3->getBody(),true);
			
			
			$rfq_list = $data['rfq_list'] = $result3;
			
        return view('buyer.rfq-list',$data);
		}
		 
		
    }
	
	public function draftRfqList()
    {
		
		$user_id = Auth::user()->id;
		$http = new \GuzzleHttp\Client();
		
		$response2 = $http->get(''.env('APP_URL').'api/v1/getrfqStatusList/');
		$result2 = json_decode((string)$response2->getBody(),true);
		$data['rfq_status'] = $result2;
		/* echo "<pre>";
		print_r($data['rfq_status']); die;
		 */
		$response1 = $http->get(''.env('APP_URL').'api/v1/itemList/'.$user_id);
		$result1 = json_decode((string)$response1->getBody(),true);
		$data['item_list'] = $result1;
		
		$response10 = $http->get(''.env('APP_URL').'api/v1/supplierList/'.$user_id);
		$result10 = json_decode((string)$response10->getBody(),true);
		$data['supplier_list'] = $result10;
		
		
		$result3 = array();
		if(isset($_GET['status']) && !empty($_GET['status'])){
			$result3 = Rfq::where('is_deleted',NULL)->where('buyer_id',$user_id)->where('status',$_GET['status'])->get();
			
			$rfq_list = $data['rfq_list'] = $result3;
		
        return view('buyer.rfq-list',$data);
		
		}elseif(isset($_GET['supplier']) && !empty($_GET['supplier'])){
			//$result3 = Rfq::where('is_deleted',NULL)->where('buyer_id',$user_id)->join('')->get();
			
			$result3 = DB::table('rfqs')
            ->join('rfq_item_send', 'rfqs.id', '=', 'rfq_item_send.rfq_id')
            ->select('rfqs.*')
            ->where('rfq_item_send.supplier_id',$_GET['supplier'])
            ->where('rfqs.is_deleted',NULL)
            ->where('rfqs.buyer_id',$user_id)
            ->get(); 
			
			$rfq_list = $data['rfq_list'] = $result3;
		
        return view('buyer.rfq-list-supplier-search',$data);
			
		}elseif(isset($_GET['item']) && !empty($_GET['item'])){
			
			
			$result3 = DB::table('rfqs')
            ->join('rfq_item_send', 'rfqs.id', '=', 'rfq_item_send.rfq_id')
            ->select('rfqs.*','rfq_item_send.rfq_items')
			//->whereRaw("find_in_set('rfq_item_send.rfq_items',".$_GET['item'].")")
			->whereRaw("FIND_IN_SET(?, rfq_items) > 0", [$_GET['item']])
            ->where('rfqs.is_deleted',NULL)
            ->where('rfqs.status','0')
            ->where('rfqs.buyer_id',$user_id)
            ->get(); 
			
			$rfq_list = $data['rfq_list'] = $result3;
		
        return view('buyer.rfq-list-supplier-search',$data);
		}elseif(isset($_GET['duedate']) && !empty($_GET['duedate'])){
			
			$result3 = Rfq::where('is_deleted',NULL)->where('buyer_id',$user_id)->where('rfq_response_dead_line','=', $_GET['duedate'])->get();
			
			$rfq_list = $data['rfq_list'] = $result3;
		
        return view('buyer.rfq-list',$data);
		
		}else{
			$response3 = $http->get(''.env('APP_URL').'api/v1/draftRfqList/'.$user_id);
			$result3 = json_decode((string)$response3->getBody(),true);
			
			$rfq_list = $data['rfq_list'] = $result3;
		$data['is_draft'] = "1";
		$data['heading'] = "Draft RFQs";
        return view('buyer.rfq-list',$data);
		}
		
		
    }
	
	
	public function createRfqItem($rfq_id=null)
    {
		$user_id = Auth::user()->id;
		$http = new \GuzzleHttp\Client();
		
		$response1 = $http->get(''.env('APP_URL').'api/v1/itemList/'.$user_id);
		$result1 = json_decode((string)$response1->getBody(),true);
		$data['item_list'] = $result1;
				
		$response2 = $http->get(''.env('APP_URL').'api/v1/productGroupList/'.$user_id);
		$result2 = json_decode((string)$response2->getBody(),true);
		$data['product_group_list'] = $result2;
		
		$data['rfq_id'] = $rfq_id;

        return view('buyer.create-rfq-item',$data);
    }
	public function editRfqItem($rfq_id=null,$id=null)
    {
		$user_id = Auth::user()->id;
		$http = new \GuzzleHttp\Client();
		
		$response1 = $http->get(''.env('APP_URL').'api/v1/itemList/'.$user_id);
		$result1 = json_decode((string)$response1->getBody(),true);
		$data['item_list'] = $result1;
		
		$response2 = $http->get(''.env('APP_URL').'api/v1/productGroupList/'.$user_id);
		$result2 = json_decode((string)$response2->getBody(),true);
		$data['product_group_list'] = $result2;

		$response5 = $http->get(''.env('APP_URL').'api/v1/rfqItemDetails/'.$id);
		$details = json_decode((string)$response5->getBody(),true);
		
		$data['details'] = $details;
		$data['id'] = $id;
		$data['rfq_id'] = $rfq_id;
        return view('buyer.create-rfq-item',$data);
    }
	public function rfqItemList($rfq_id=null)
    {
		
		$user_id = Auth::user()->id;
		$http = new \GuzzleHttp\Client();
		$response3 = $http->get(''.env('APP_URL').'api/v1/rfqItemList/'.$rfq_id);
		$result3 = json_decode((string)$response3->getBody(),true);
	//	dd($result3); die;
		$rfq_list = $data['rfq_item_list'] = $result3;
		$rfq_id = $data['rfq_id'] = $rfq_id;
		
        return view('buyer.rfq-item-list',$data);
    }
	
	
	public function submitaddProductGroupFormApi(Request $request)
    {
        try{

			$http = new \GuzzleHttp\Client();
		
			$group_code    = $request->group_code;
			$description = $request->description;
			$notes = $request->notes;
			$buyer_id = Auth::user()->id;
			if(isset($request->id) && !empty($request->id)){
				$id 		= $request->id;
			}else{
				$id 		= '';
			}
			
			
			$response = $http->post(''.env('APP_URL').'api/v1/submitaddProductGroupFormApi?',[
				'headers'=>[
					'Authorization'=>'Bearer'.session()->get('token.access_token')
				],
				'query'=>[
					'group_code'=>$group_code,
					'description'=>$description,
					'notes'=>$notes,
					'id'=>$id,
					'buyer_id'=>$buyer_id
				]
			]);
			$result = json_decode((string)$response->getBody(),true);
			
			return redirect()->back()->with('success',$result['message']);
			
			

        }catch(\Exception $e){
            return redirect()->back()->with('error','Please fill all required fileds.');
        } 
    }
	public function submitaddShipLocationFormApi(Request $request)
    {
        try{

			$http = new \GuzzleHttp\Client();
		
			$companyname    = $request->companyname;
			$contactname = $request->contactname;
			$st_address = $request->st_address;
			$city = $request->city;
			$state = $request->state;
			$country = $request->country;
			$zipcode = $request->zipcode;
			$buyer_id = Auth::user()->id;
			if(isset($request->id) && !empty($request->id)){
				$id 		= $request->id;
			}else{
				$id 		= '';
			}
			
			
			$response = $http->post(''.env('APP_URL').'api/v1/submitaddShipLocationFormApi?',[
				'headers'=>[
					'Authorization'=>'Bearer'.session()->get('token.access_token')
				],
				'query'=>[
					'companyname'=>$companyname,
					'contactname'=>$contactname,
					'st_address'=>$st_address,
					'city'=>$city,
					'state'=>$state,
					'country'=>$country,
					'zipcode'=>$zipcode,
					'id'=>$id,
					'buyer_id'=>$buyer_id
				]
			]);
			$result = json_decode((string)$response->getBody(),true);
			
			return redirect()->back()->with('success',$result['message']);
			
			

        }catch(\Exception $e){
            return redirect()->back()->with('error','Please fill all required fileds.');
        } 
    }
	public function submitpaymentTermsFormApi(Request $request)
    {
        try{

			$http = new \GuzzleHttp\Client();
		
			$name    = $request->name;
			$description = $request->description;
			$buyer_id = Auth::user()->id;
			if(isset($request->id) && !empty($request->id)){
				$id 		= $request->id;
			}else{
				$id 		= '';
			}
			
			$response = $http->post(''.env('APP_URL').'api/v1/submitpaymentTermsFormApi?',[
				'headers'=>[
					'Authorization'=>'Bearer'.session()->get('token.access_token')
				],
				'query'=>[
					'name'=>$name,
					'description'=>$description,
					'id'=>$id,
					'buyer_id'=>$buyer_id
				]
			]);
			$result = json_decode((string)$response->getBody(),true);
			
			return redirect()->back()->with('success',$result['message']);
			
			

        }catch(\Exception $e){
            return redirect()->back()->with('error','Please fill all required fileds.');
        } 
    }
	public function submitaddShipMethodFormApi(Request $request)
    {
        try{

			$http = new \GuzzleHttp\Client();
		
			$name    = $request->name;
			$description = $request->description;
			$notes = $request->notes;
			$buyer_id = Auth::user()->id;
			if(isset($request->id) && !empty($request->id)){
				$id 		= $request->id;
			}else{
				$id 		= '';
			}
			
			
			$response = $http->post(''.env('APP_URL').'api/v1/submitaddShipMethodFormApi?',[
				'headers'=>[
					'Authorization'=>'Bearer'.session()->get('token.access_token')
				],
				'query'=>[
					'name'=>$name,
					'description'=>$description,
					'notes'=>$notes,
					'id'=>$id,
					'buyer_id'=>$buyer_id
				]
			]);
			$result = json_decode((string)$response->getBody(),true);
			
			return redirect()->back()->with('success',$result['message']);
			
			

        }catch(\Exception $e){
            return redirect()->back()->with('error','Please fill all required fileds.');
        } 
    }
	
	public function submitaddDeliveryTermFormApi(Request $request)
    {
        try{

			$http = new \GuzzleHttp\Client();
		
			$termcode    = $request->termcode;
			$description = $request->description;
			$notes = $request->notes;
			$buyer_id = Auth::user()->id;
			if(isset($request->id) && !empty($request->id)){
				$id 		= $request->id;
			}else{
				$id 		= '';
			}
			
			
			$response = $http->post(''.env('APP_URL').'api/v1/submitaddDeliveryTermFormApi?',[
				'headers'=>[
					'Authorization'=>'Bearer'.session()->get('token.access_token')
				],
				'query'=>[
					'termcode'=>$termcode,
					'description'=>$description,
					'notes'=>$notes,
					'id'=>$id,
					'buyer_id'=>$buyer_id
				]
			]);
			$result = json_decode((string)$response->getBody(),true);
			
			return redirect()->back()->with('success',$result['message']);
			
			

        }catch(\Exception $e){
            return redirect()->back()->with('error','Please fill all required fileds.');
        } 
    }
	public function submitaddUnitMeasuresFormApi(Request $request)
    {
        try{

			$http = new \GuzzleHttp\Client();
		
			$code    = $request->code;
			$description = $request->description;
			
			$buyer_id = Auth::user()->id;
			if(isset($request->id) && !empty($request->id)){
				$id 		= $request->id;
			}else{
				$id 		= '';
			}
			
			
			$response = $http->post(''.env('APP_URL').'api/v1/submitaddUnitMeasuresFormApi?',[
				'headers'=>[
					'Authorization'=>'Bearer'.session()->get('token.access_token')
				],
				'query'=>[
					'code'=>$code,
					'description'=>$description,
					'id'=>$id,
					'buyer_id'=>$buyer_id
				]
			]);
			$result = json_decode((string)$response->getBody(),true);
			
			return redirect()->back()->with('success',$result['message']);
			
			

        }catch(\Exception $e){
            return redirect()->back()->with('error','Please fill all required fileds.');
        } 
    }
	public function submitaddItemFormApi(Request $request)
    {
        try{

			$http = new \GuzzleHttp\Client();
		
			$item_number    = $request->item_number;
			$revision_number    = $request->revision_number;
			$description = $request->description;
			$unit_measure = $request->unit_measure;
			$product_group = $request->product_group;
			$part_number = $request->part_number;
			$notes = $request->notes;
			
			$buyer_id = Auth::user()->id;
			if(isset($request->id) && !empty($request->id)){
				$id 		= $request->id;
			}else{
				$id 		= '';
			}
			
			
			$response = $http->post(''.env('APP_URL').'api/v1/submitaddItemFormApi?',[
				'headers'=>[
					'Authorization'=>'Bearer'.session()->get('token.access_token')
				],
				'query'=>[
					'item_number'=>$item_number,
					'revision_number'=>$revision_number,
					'description'=>$description,
					'unit_measure'=>$unit_measure,
					'product_group'=>$product_group,
					'part_number'=>$part_number,
					'notes'=>$notes,
					'id'=>$id,
					'buyer_id'=>$buyer_id
				]
			]);
			$result = json_decode((string)$response->getBody(),true);
			
			return redirect()->back()->with('success',$result['message']);
			
			

        }catch(\Exception $e){
            return redirect()->back()->with('error','Please fill all required fileds.');
        } 
    }
	
	public function submitaddSupplierFormApi(Request $request)
    {
        try{

			$http = new \GuzzleHttp\Client();
		
			$company_name    = $request->company_name;
			$company_contact_name    = $request->company_contact_name;
			$email = $request->email;
			$street_address = $request->street_address;
			$city = $request->city;
			$state = $request->state;
			$zipcode = $request->zipcode;
			$country = $request->country;
			$supplier_risk_level = $request->supplier_risk_level;
			
			$buyer_id = Auth::user()->id;
			
			
			if(isset($request->id) && !empty($request->id)){
				$id 		= $request->id;
			}else{
				$id 		= '';
			}
			
			if(isset($request->user_id) && !empty($request->user_id)){
				$user_id 		= $request->user_id;
			}else{
				$user_id 		= '';
			}
			
			
			$response = $http->post(''.env('APP_URL').'api/v1/submitaddSupplierFormApi?',[
				'headers'=>[
					'Authorization'=>'Bearer'.session()->get('token.access_token')
				],
				'query'=>[
					'company_name'=>$company_name,
					'company_contact_name'=>$company_contact_name,
					'email'=>$email,
					'street_address'=>$street_address,
					'city'=>$city,
					'state'=>$state,
					'zipcode'=>$zipcode,
					'country'=>$country,
					'supplier_risk_level'=>$supplier_risk_level,
					'id'=>$id,
					'user_id'=>$user_id,
					//'buyer_company_name'=>$buyer_company_name,
					'buyer_id'=>$buyer_id
				]
			]);
			$result = json_decode((string)$response->getBody(),true);
			
			return redirect()->back()->with('success',$result['message']);
			
			

        }catch(\Exception $e){
            return redirect()->back()->with('error','Please fill all required fileds.');
        } 
    }
	public function submitaddRfqFormApi(Request $request)
    {
		
        try{

			$http = new \GuzzleHttp\Client();
		
			$rfq_id    = $request->rfq_id;
			$payment_term    = $request->payment_term;
			$ship_method = $request->ship_method;
			$ship_location = $request->ship_location;
			$rfq_response_dead_line = $request->rfq_response_dead_line;
			$dead_line_time = $request->dead_line_time;
			$set_email_reminder = $request->set_email_reminder;
			$date_of_reminder = ''; //$request->date_of_reminder;
			
			
			$buyer_id = Auth::user()->id;
			if(isset($request->id) && !empty($request->id)){
				$id 		= $request->id;
			}else{
				$id 		= '';
			}
			
			
			$response = $http->post(''.env('APP_URL').'api/v1/submitaddRfqFormApi?',[
				'headers'=>[
					'Authorization'=>'Bearer'.session()->get('token.access_token')
				],
				'query'=>[
					'rfq_id'=>$rfq_id,
					'payment_term'=>$payment_term,
					'ship_method'=>$ship_method,
					'ship_location'=>$ship_location,
					'rfq_response_dead_line'=>$rfq_response_dead_line,
					'dead_line_time'=>$dead_line_time,
					'set_email_reminder'=>$set_email_reminder,
					'date_of_reminder'=>$date_of_reminder,
					'id'=>$id,
					'buyer_id'=>$buyer_id
				]
			]);
			$result = json_decode((string)$response->getBody(),true);
			
			return redirect('buyer/edit-rfq/'.$result['insertedID'])->with('success',$result['message'])->with('add_item_ses',1);
			
			

        }catch(\Exception $e){
            return redirect()->back()->with('error','Please fill all required fileds.');
        } 
    }
	public function submitaddRfqItemFormApi(Request $request)
    {
			
			/* if($files=$request->file('document')){ 
		 
				$name=time().'_'.$files->getClientOriginalName();  
				$files->move('public/buyer/document/',$name);            
				$document = $data["document"] = $name;
												
			}else{
				$document  =  $request->document;
			} */
			
			/* if($file = $request->file('document')){
				foreach($file as $file){
					$image_name = md5(rand(1000,10000));
					$ext = strtolower($file->getClientOriginalExtension());
					$image_full_name = $image_name.'.'.$ext;
					$uploade_path = 'public/buyer/document/';
					$image_url = $image_full_name;
					$file->move($uploade_path,$image_full_name);
					$image[] = $image_url;
					
					$saveDoc['document'] = $image_url;
					$saveDoc['rfq_items_id'] = 15;
					
					RfqItemDoc::create($saveDoc);
					
				}
			}
			 */
			$save_exit = $request->save_exit;
			
		$input = $request->all();
			
		$message = RfqItem::apiSubmitRules($request->all());
        
		$buyer_id = Auth::user()->id;
		if(isset($request->id) && !empty($request->id)){
			$id 		= $request->id;
		}else{
			$id 		= '';
		}
		
		if($message == ""){
			try {
				$saveData['id']             = $id;
				
				if(empty($saveData['id'])){
					
					$saveData['rfq_id'] = $request->rfq_id;
					$saveData['item_id'] = $request->item_id;
					$saveData['unit'] = $request->unit;
					$saveData['description'] = $request->description;
					$saveData['product_group'] = $request->product_group;
					$saveData['quantity'] = $request->quantity;
					$saveData['delivery_date'] = $request->delivery_date;
					$saveData['special_instruction'] = $request->special_instruction;
					
					
					
					
                    $insertedID = RfqItem::create($saveData)->id;
					
					
					
					if($file = $request->file('document')){
						foreach($file as $file){
							$image_name = md5(rand(1000,10000));
							$ext = strtolower($file->getClientOriginalExtension());
							$image_full_name = $image_name.'.'.$ext;
							$uploade_path = 'public/buyer/document/';
							$image_url = $image_full_name;
							$file->move($uploade_path,$image_full_name);
							$image[] = $image_url;
							
							$saveDoc['document'] = $image_url;
							$saveDoc['rfq_items_id'] = $insertedID;
							
							RfqItemDoc::create($saveDoc);
							
						}
					}
					
					
					
					
                    $success['message'] = 'RFQ Item saved successfully';
					
			
					$result['save_exit'] = 1;
					if(isset($save_exit) && !empty($save_exit)){
						$_SESSION['save_exit'] = "1";
					}
					if(isset($save_exit) && !empty($save_exit)){
						return redirect()->back()->with('success','RFQ Item saved successfully')->with('save_exit',1);
					}else{
						return redirect()->back()->with('success','RFQ Item saved successfully')->with('add_item_ses',1);
					}
					
					
                }else{
					
					$saveData['rfq_id'] = $request->rfq_id;
					$saveData['item_id'] = $request->item_id;
					$saveData['unit'] = $request->unit;
					$saveData['description'] = $request->description;
					$saveData['product_group'] = $request->product_group;
					$saveData['quantity'] = $request->quantity;
					$saveData['delivery_date'] = $request->delivery_date;
					$saveData['special_instruction'] = $request->special_instruction;
					
					
                   $user = RfqItem::where('id', $saveData['id'])
                    ->update($saveData);
					
					
					if($file = $request->file('document')){
						foreach($file as $file){
							$image_name = md5(rand(1000,10000));
							$ext = strtolower($file->getClientOriginalExtension());
							$image_full_name = $image_name.'.'.$ext;
							$uploade_path = 'public/buyer/document/';
							$image_url = $image_full_name;
							$file->move($uploade_path,$image_full_name);
							$image[] = $image_url;
							
							$saveDoc['document'] = $image_url;
							$saveDoc['rfq_items_id'] = $saveData['id'];
							
							RfqItemDoc::create($saveDoc);
							
						}
					}

                    $success['message'] = 'RFQ Item updated successfully';
					
					
					if(isset($save_exit) && !empty($save_exit)){
						$_SESSION['save_exit'] = "1";
					}
					if(isset($save_exit) && !empty($save_exit)){
						return redirect()->back()->with('success','RFQ Item updated successfully')->with('save_exit',1);
					}else{
						return redirect()->back()->with('success','RFQ Item updated successfully')->with('add_item_ses',1);
					}
					
					
                }
				/* $success['success'] = 'success';
				$success['data'] =  $user;
				return response()->json($success, $this->successStatus); */
			} catch (\Exception $e){
				$error['error'] = $e->getMessage();
				return response()->json($error, $this->errorStatus);
			}
		}else {
           
            $error['error'] = $message;
            return response()->json($error, $this->successStatus);
        }
			
			
			
			
        /* try{

			$http = new \GuzzleHttp\Client();
		
			$rfq_id    = $request->rfq_id;
			$item_id    = $request->item_id;
			$unit = $request->unit;
			$description = $request->description;
			$product_group = $request->product_group;
			$quantity = $request->quantity;
			$delivery_date = $request->delivery_date;
			$special_instruction = $request->special_instruction;
			$document = $request->file('document'); //$document;
			$save_exit = $save_exit;
			
			
			$buyer_id = Auth::user()->id;
			if(isset($request->id) && !empty($request->id)){
				$id 		= $request->id;
			}else{
				$id 		= '';
			}
			
			
			$response = $http->post(''.env('APP_URL').'api/v1/submitaddRfqItemFormApi?',[
				'headers'=>[
					'Authorization'=>'Bearer'.session()->get('token.access_token')
				],
				'query'=>[
					'rfq_id'=>$rfq_id,
					'item_id'=>$item_id,
					'unit'=>$unit,
					'description'=>$description,
					'product_group'=>$product_group,
					'quantity'=>$quantity,
					'delivery_date'=>$delivery_date,
					'special_instruction'=>$special_instruction,
					'document'=>$document,
					'id'=>$id,
				]
			]);
			$result = json_decode((string)$response->getBody(),true);
			
			$result['save_exit'] = 1;
			if(isset($save_exit) && !empty($save_exit)){
				$_SESSION['save_exit'] = "1";
			}
			if(isset($save_exit) && !empty($save_exit)){
				return redirect()->back()->with('success',$result['message'])->with('save_exit',1);
			}else{
				return redirect()->back()->with('success',$result['message'])->with('add_item_ses',1);
			}
			
			
			

        }catch(\Exception $e){
            return redirect()->back()->with('error','Please fill all required fileds.');
        }  */
    }
	
	public function deleteByID($model,$id){
		
		try{

			$http = new \GuzzleHttp\Client();
			$model    		= $model;
			$id    		= $id;

			$response = $http->post(''.env('APP_URL').'api/v1/buyerdeleteByID?',[
				'headers'=>[
					'Authorization'=>'Bearer'.session()->get('token.access_token')
				],
				'query'=>[
					'model'=>$model,
					'id'=>$id
				]
			]);
			$result = json_decode((string)$response->getBody(),true);
			
			return redirect()->back()->with('success1',$result['message']);
			
        }catch(\Exception $e){
            return redirect()->back()->with('error1','Please fill all required fileds.');
        } 
			
	}
	
	
	public function submitaddUserApi(Request $request)
    { 
		if(isset($request->id) && !empty($request->id)){
			$id 			= $request->id;
		}else{
			$id = "";
		}
		
		if(isset($request->company_name) && !empty($request->company_name)){
			$company_name 			= $request->company_name;
		}else{
			$company_name = "";
		}
		
		
		$data = User::where('email',$request->email)->get();
      
	  
	  
		if (($data->count()>0) && ($data[0]['id'] != $id)) {
			return redirect()->back()->with('error','This email is in use by another user.');			
			
		}else{
			try{

				$http = new \GuzzleHttp\Client();
			
				$name    		= $request->name;
				$email 			= $request->email;
				$phone 			= $request->phone;
				$company_name 	= $company_name;
				$role_id 		= $request->role_id;
				
				$buyer_id = Auth::user()->id;
				
				
				if(isset($request->id) && !empty($request->id)){
					$id 			= $request->id;
				}else{
					$id = "";
				}
				
				$response = $http->post(''.env('APP_URL').'api/v1/submitaddUserApi?',[
					'headers'=>[
						'Authorization'=>'Bearer'.session()->get('token.access_token')
					],
					'query'=>[
						'name'=>$name,
						'email'=>$email,
						'phone'=>$phone,
						'temp_password'=>rand(),
						'company_name'=>$company_name,
						'role_id'=>$role_id,
						'buyer_id'=>$buyer_id,
						'id'=>$id
					]
				]);
				$result = json_decode((string)$response->getBody(),true);
			
				return redirect()->back()->with('success',$result['message']);
				
			}catch(\Exception $e){
				
				return redirect()->back()->with('error','Please fill all required fileds.');
			}
		}
		
     	 
    }
	
	 public function addUser()
    { 
		$http = new \GuzzleHttp\Client();

		$response = $http->get(''.env('APP_URL').'api/v1/companyList');
	
		$result = json_decode((string)$response->getBody(),true);

		$data['comapany_list'] = $result;
		$data['country_list'] = Country::countryList();
        return view('buyer.add-users',$data);
    }
	public function editUser($id=null)
    { 
		$http = new \GuzzleHttp\Client();

		$response = $http->get(''.env('APP_URL').'api/v1/companyList');
	
		$result = json_decode((string)$response->getBody(),true);

		$response1 = $http->get(''.env('APP_URL').'api/v1/userDetails/'.$id);
	
		$userData = json_decode((string)$response1->getBody(),true);

		$data['comapany_list'] = $result;
		$data['userdetails'] = $userData;
		$data['id'] = $id;
		$data['country_list'] = Country::countryList();
        return view('buyer.add-users',$data);
    }
	
	public function userList()
    { 
		
		$user_id = Auth::user()->id;
		$http = new \GuzzleHttp\Client();
		$response3 = $http->get(''.env('APP_URL').'api/v1/userList/'.$user_id);
		$result3 = json_decode((string)$response3->getBody(),true);
	//	dd($result3); die;
		$data['company_user_list'] = $result3;
		
		
		$data['comapany_list'] = $result3;

        return view('buyer.user-list',$data);
    }
	
	
	public function getPaymentStatus(){
		$user_id = Auth::user()->id;
		$userData = User::where('id',$user_id)->first();
		
		$payment_status = $userData->payment_status;
		$payment_id = $userData->payment_id;
	
		
		if($payment_status == '' || empty($payment_status)){
			$error['redirect'] = 1;
			$error['error'] = 'Please complete your paymant status';
			$error['href'] = url('/buyer/make-payment');
			return response()->json($error);
		}else{
		    if($payment_id == '' || empty($payment_id)){
		         $error['redirect'] = 0;
    			$error['error'] = 'Please complete your paymant status';
    			$error['href'] = '';
    			return response()->json($error);
		    }else{
		        $payment_date = PaymentLogs::where('id',$payment_id)->first();
		        
		        $date1 = $payment_date['created_at'];
		        $date2 = date('Y-m-d');
		        
	            $date1_ts = strtotime($date1);
                $date2_ts = strtotime($date2);
                $diff = $date2_ts - $date1_ts;
                $days = round($diff / 86400);
                if($days > 365){
                    $error['redirect'] = 1;
        			$error['error'] = 'Please complete your paymant status';
        			$error['href'] = url('/buyer/make-payment');
        			return response()->json($error);
                }else{
                    $error['redirect'] = 0;
        			$error['error'] = 'Please complete your paymant status';
        			$error['href'] = '';
        			return response()->json($error);
                }
		        
		        
		    }
			
		}
		
	}
	
	public function makePayment(){
		$user_id = Auth::user()->id;
		
		
		$price = PriceSetup::where('is_deleted',NULL)->get();
	
		$data['price_list'] = $price;
		$data['userid'] = $user_id;
		
		$userdata = User::where('id',$user_id)->first();
		$company_id  = $userdata['company_name'];
		$companyData = Company::where('id',$company_id)->first();
		$data['userdata'] = $userdata;
		$data['companyData'] = $companyData;
		return view('buyer.make-payment',$data);
	}
	
	
	public function addRfqItemForm($id=null){
		
				
		$user_id = Auth::user()->id;
		$http = new \GuzzleHttp\Client();
		
		$response1 = $http->get(''.env('APP_URL').'api/v1/itemList/'.$user_id);
		$result1 = json_decode((string)$response1->getBody(),true);
		$item_list = $result1;
		
		
		$response8 = $http->get(''.env('APP_URL').'api/v1/productGroupList/'.$user_id);
		$result8 = json_decode((string)$response8->getBody(),true);
		$product_group_list = $result8;
		
		$response9 = $http->get(''.env('APP_URL').'api/v1/unitMeasuresList/'.$user_id);
		$result9 = json_decode((string)$response9->getBody(),true);
		$unit_list = $result9;
		
		$rfq_id = $id;
		$id = "";
		return view('buyer.rfq-item-form', array(
		     
            'item_list' => $item_list,
            'unit_list' => $unit_list,
            'product_group_list' => $product_group_list,
            'id' => $id,
            'rfq_id' => $rfq_id,
			                       
        ));
	}
	
	
	
	public function sendRfqSupplierFormApi(Request $request)
    {
		if(isset($request->rfq_items) && !empty($request->rfq_items)){
			$rfq_items = implode(",",$request->rfq_items);
		}else{
			return redirect()->back()->with('error','Please add atleast one RFQ item.');
		}
		
		
		if(isset($request->supplier) && !empty($request->supplier)){
			$supplier    = implode(",",$request->supplier);
		}else{
			return redirect()->back()->with('error','Please select atleast one supplier.');
		}
			
			
			
			
			$_SESSION['rfq_id'] =  $rfq_id = $request->rfq_id;
			$buyer_id = Auth::user()->id;
			
			$suppliers = explode(",",$supplier);
				if(isset($suppliers) && !empty($suppliers)){
					foreach($suppliers as $each){
						$saveData['supplier_id']        = $each;
						$saveData['rfq_items']          = $rfq_items;
						$rfqIDd = $saveData['rfq_id']          	= $rfq_id;
						$saveData['buyer_id']        	= $buyer_id;
						
						$id 	= 	RfqItemSend::create($saveData)->id;
						
						$supplierDetails = Supplier::find($each);

						$userData = User::find($buyer_id);
		
						$companyData = Company::find($userData['company_name']);
						$get_buyer_company_name =  $companyData['name'];
						
						
						
						$to_name = $supplierDetails['company_name'];
						$to_email = $supplierDetails['email'];
						//$get_buyer_company_name = $this->get_buyer_company_name($input['buyer_id']);
						
						$data = array('name'=>$supplierDetails['email'],'message2' => "Hello ".$supplierDetails['company_name'].", <br><br>You have received a Request for Quote from ".$get_buyer_company_name.". Please click the link below or copy and paste in your browser to register and submit your quote. <br> <br> https://quoteside.com/supplier/rfq-item-send-details/".$id."<br><br>Thank you! <br><br><br>Team QuoteSide");
						 Mail::send('email.new-user-create', $data, function($message) use ($to_name, $to_email) {
						$message->to($to_email, $to_name)
						->subject("Request for Quote #".$_SESSION['rfq_id']."");
						$message->from('demo231993@gmail.com','QuoteSide.com');
						});
						
						
					}
					
					
					$rfqData['status'] = 0;
					$rfqData['is_draft'] = 0;
					Rfq::where('id', $_SESSION['rfq_id'])
                    ->update($rfqData);
					return redirect()->back()->with('success',"RFQ has been successfully sent to the selected supplier(s).");
				}else{
					return redirect()->back()->with('error','Please select atleast one supplier.');
				}
       /*  try{

			$http = new \GuzzleHttp\Client();
			
			
			$response = $http->post(''.env('APP_URL').'api/v1/sendRfqSupplierFormApi?',[
				'headers'=>[
					'Authorization'=>'Bearer'.session()->get('token.access_token')
				],
				'query'=>[
					'supplier'=>$supplier,
					'rfq_items'=>$rfq_items,
					'rfq_id'=>$rfq_id,
					'buyer_id'=>$buyer_id
				]
			]);
			$result = json_decode((string)$response->getBody(),true);
			
			return redirect()->back()->with('success',$result['message']);
			
			

        }catch(\Exception $e){
            return redirect()->back()->with('error','Please select atleast one supplier.');
        }  */
    }
	
	public function rfqSendDetails($id=null){
		$user_id = Auth::user()->id;
		$http = new \GuzzleHttp\Client();
		
		$response1 = $http->get(''.env('APP_URL').'api/v1/rfqItemSendList/'.$id);
		$result1 = json_decode((string)$response1->getBody(),true);
		$item_list = $result1;
		
		
		
		if(isset($item_list[0]['rfq_id']) && !empty($item_list[0]['rfq_id'])){
			$rfqDetails = Rfq::where('rfq_id',$item_list[0]['rfq_id'])->first();
		}else{
			$rfqDetails = '';
		}

		return view('buyer.rfq-item-send-list', array(
		     
            'item_list' => $item_list,
            'rfqDetails' => $rfqDetails,
            'id' => $id,
			                       
        ));
	}
	
	public function rfqItemSendDetails($rfq_id=null,$supplier_id=null){
		$user_id = Auth::user()->id;
		$http = new \GuzzleHttp\Client();
		
		
		/* 
		$supplierDetails = Supplier::find(1);
					
			
		
		 $id =1;
			$userData = User::find($user_id);

			$companyData = Company::find($userData['company_name']);
			$get_buyer_company_name =  $companyData['name'];
			
			
			
			$to_name = $supplierDetails['company_name'];
			$to_email = $supplierDetails['email'];
			//$get_buyer_company_name = $this->get_buyer_company_name($input['buyer_id']);
			
			$data = array('name'=>$supplierDetails['email'],'message2' => "Hello ".$supplierDetails['company_name'].", <br><br>You have received a Request for Quote from ".$get_buyer_company_name.". Please click the link below or copy and paste in your browser to register and submit your quote. <br> <br> https://quoteside.com/supplier/rfq-item-send-details/".$id."<br><br>Thank you! <br><br><br>Team QuoteSide");
		echo "<pre>";
		print_r($data); die; */
		
		$response1 = $http->get(''.env('APP_URL').'api/v1/rfqItemSendListForSupplier/'.$rfq_id.'/'.$supplier_id);
		$result1 = json_decode((string)$response1->getBody(),true);
		$item_list = $result1;
		
		if(isset($item_list[0]['rfq_id']) && !empty($item_list[0]['rfq_id'])){
			$rfqDetails = Rfq::where('rfq_id',$item_list[0]['rfq_id'])->first();
		}else{
			$rfqDetails = '';
		}
		
		
		return view('buyer.rfq-item-send-details', array(
		     
            'item_list' => $item_list,
            'rfqDetails' => $rfqDetails,
            'supplier_id' => $supplier_id,
			                       
        ));
		
		
	}
	
	public function cancelSendRfq($id=null){
		 try{

			$http = new \GuzzleHttp\Client();
			$response = $http->post(''.env('APP_URL').'api/v1/cancelSendRfq?',[
				'headers'=>[
					'Authorization'=>'Bearer'.session()->get('token.access_token')
				],
				'query'=>[
					'id'=>$id
				]
			]);
			$result = json_decode((string)$response->getBody(),true);
			
			return redirect()->back()->with('success',$result['message']);

        }catch(\Exception $e){
            return redirect()->back()->with('error','Please fill all required fileds.');
        } 
	}
	public function statusChangeofQuote($supplier_quotes_on_rfq_items_id=null,$rfq_id=null,$supplier_id=null,$status=null){
		 try{

			$http = new \GuzzleHttp\Client();
			$response = $http->post(''.env('APP_URL').'api/v1/statusChangeofQuote?',[
				'headers'=>[
					'Authorization'=>'Bearer'.session()->get('token.access_token')
				],
				'query'=>[
					'supplier_quotes_on_rfq_items_id'=>$supplier_quotes_on_rfq_items_id,
					'rfq_id'=>$rfq_id,
					'supplier_id'=>$supplier_id,
					'status'=>$status
				]
			]);
			$result = json_decode((string)$response->getBody(),true);
			
			return redirect()->back()->with('success',$result['message']);

        }catch(\Exception $e){
            return redirect()->back()->with('error','Please fill all required fileds.');
        } 
	}
	
	
	public function shipDetails($id=null)
    {
		$http = new \GuzzleHttp\Client();
		$response1 = $http->get(''.env('APP_URL').'api/v1/shipLocationDetails/'.$id);
		$details = json_decode((string)$response1->getBody(),true);
		$data['details'] = $details;
		$data['id'] = $id;
		
		
		$response3 = $http->get(''.env('APP_URL').'api/v1/getCountryList/');
		$country = json_decode((string)$response3->getBody(),true);
		
		$response2 = $http->get(''.env('APP_URL').'api/v1/getStateList/231');
		$state = json_decode((string)$response2->getBody(),true);
		
		$data['countryList'] = $country;
		$data['stateList'] = $state;
		
        return view('buyer.ship-location-detail',$data);
    }
	
	
	 /**
    * @return \Illuminate\Support\Collection
    */
    public function getimportSupplier() 
    {
        return view('buyer.import-supplier');
    }
	 /**
    * @return \Illuminate\Support\Collection
    */
    public function getimportItem() 
    {
         return view('buyer.import-item');
    }
	
	
	
	 /**
    * @return \Illuminate\Support\Collection
    */
    public function importSupplier() 
    {
        Excel::import(new SuppliersImport,request()->file('file'));
           
      return redirect()->back()->with('success',"Import Successfully");
    }
	 /**
    * @return \Illuminate\Support\Collection
    */
    public function importItem() 
    {
        Excel::import(new itemsImport,request()->file('file'));
           
        return redirect()->back()->with('success',"Import Successfully");
    }
	 /**
    * @return \Illuminate\Support\Collection
    */
    public function subscription() 
    {
		$data = array();
		
	$userDetails = 	$data['userDetails'] = User::where('id',Auth::user()->id)->first(); 
		$data['subscription_id'] = $userDetails['subscription_id'];
		if(isset($userDetails['subscription_id']) && !empty($userDetails['subscription_id'])){
		    $data['subscription_id'] = $userDetails['subscription_id'];
		    
		    $data['subscription_details'] = PriceSetup::where('id',$userDetails['subscription_id'])->first();
		    
		    $data['payment_logs'] = PaymentLogs::where('user_id',Auth::user()->id)->get();
		}
        return view('buyer.subscription',$data);
    }
	
	public function updateRfqPastDue(){
		$rfqs = Rfq::get();
		
		
		if(count($rfqs) > 0){
			foreach($rfqs as $each){
				 $duedate = $each['rfq_response_dead_line'].' '.$each['dead_line_time'];
				
				$startdate = $duedate;
				$expire = strtotime($startdate);
				$today = strtotime("today midnight");
 
				if($today >= $expire){
					$saveData['status']   = 3;

					Rfq::where('id', $each['id'])
				->update($saveData);
				} else {
					
				}
			}
			echo "Status Updated";
		}
		
	}
}
