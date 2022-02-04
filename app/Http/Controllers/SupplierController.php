<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Model\PriceSetup;
use App\Model\Company;
use App\Model\Supplier;
use GuzzleHttp\Client;
use Auth;
use Session;
use App\User;
use App\Model\SupplierQuotesOnRfqItem;
use App\Model\RfqItemSend;

class SupplierController extends Controller
{
    public function __construct()
    {
     $this->middleware('auth')->except('registration','templogin','setpassword','submitpassword');
       //$this->middleware('role:ROLE_SUPERADMIN');
    }

    public function registration($id)
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
        return view('supplier.welcome',$data);
    }
	
	public function templogin(Request $request)
    {
       $password = $request['password'];
       $email = $request['email'];
	   
	   $data = User::where('email',$email)->where('temp_password',$password)->get();
        
		if ($data->count()>0) {
			
			return redirect('supplier/set-password/'.$data[0]['encoded_id']);
				
			
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
		return view('supplier.setpassword',$data);
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
	}
	
	public function dashboard()
    {
		$user_id = Auth::user()->id;
		$http = new \GuzzleHttp\Client();
		$supplierData = Supplier::where('user_id',$user_id)->first();
		
		$supplier_id = $supplierData['id'];
		$response1 = $http->get(''.env('APP_URL').'api/v1/rfqItemSendListForSupplierPanel/'.$supplier_id);
		$result1 = json_decode((string)$response1->getBody(),true);
		$data['item_list'] = count($result1);
		
		
        return view('supplier.dashboard',$data);
    }
	
	
	public function rfqList(){
		$user_id = Auth::user()->id;
		$http = new \GuzzleHttp\Client();
		$supplierData = Supplier::where('user_id',$user_id)->first();
		
		$supplier_id = $supplierData['id'];
		$response1 = $http->get(''.env('APP_URL').'api/v1/rfqItemSendListForSupplierPanel/'.$supplier_id);
		$result1 = json_decode((string)$response1->getBody(),true);
		$item_list = $result1;
		/*  echo "<pre>";
			print_r($item_list); die;
		 */ 

		return view('supplier.rfq-list', array(
		     
            'item_list' => $item_list,
            'id' => $user_id,
			                       
        ));
	}
	
	public function rfqItemSendDetails($id=null){
		$user_id = Auth::user()->id;
		$http = new \GuzzleHttp\Client();
		$supplierData = Supplier::where('user_id',$user_id)->first();
		
		$supplier_id = $supplierData['id'];
		$response1 = $http->get(''.env('APP_URL').'api/v1/rfqItemSendDetailForSupplierPanel/'.$supplier_id.'/'.$id);
		$result1 = json_decode((string)$response1->getBody(),true);
		$item_list = $result1;
		
		$response5 = $http->get(''.env('APP_URL').'api/v1/rfqDetails/'.$id);
		$details = json_decode((string)$response5->getBody(),true);
		
		return view('supplier.rfq-item-send-details', array(
		     
            'details' => $details,
            'item_list' => $item_list,
            'id' => $id,
			                       
        ));
		
		
	}
	
	public function submititemQuoteFormApi(Request $request){
		
		$http = new \GuzzleHttp\Client();
		
		 
		/* echo "<pre>";
		print_r($request->quote);
		print_r($request->rfq_items);
		print_r($request->rfq_item_send_id);

		die; */
		$user_id = Auth::user()->id;
		$supplierData = Supplier::where('user_id',$user_id)->first();
		
		$supplier_id = $supplierData['id'];
		
		$rfq_item_send_id   = $request->rfq_item_send_id;
		$k=0;
		
		$is_revise = RfqItemSend::where('rfq_id', $request->rfq_id[0])->where('supplier_id', $supplier_id)->first();
		
		
		if($is_revise['is_revise'] == 0){
			foreach($rfq_item_send_id as $eachitem){
				
				$record_compare = SupplierQuotesOnRfqItem::where('rfq_id',$request->rfq_id[$k])->where('rfq_items',$request->rfq_items[$k])->where('supplier_id','!=',Auth::user()->id)->first();
				
				if(isset($record_compare['quotes']) && $record_compare['quotes'] < $request->quote[$k]){
					$_SESSION['quote'][] = $request->quote[$k];
					$_SESSION['rfq_items'][] = $request->rfq_items[$k];
					$_SESSION['rfq_id']= $request->rfq_id[$k];
				}
				/* echo "<pre>";
				print_r($record_compare['quotes']);
				die; */
				$k++;
			}
		}
		
		//echo $request->rfq_item_send_id[0]; die;
		if(isset($_SESSION['rfq_items']) && !empty($_SESSION['rfq_items'])){
			$supplier_id = $supplierData['id'];
			$response1 = $http->get(''.env('APP_URL').'api/v1/rfqItemSendDetailForSupplierPanel/'.$supplier_id.'/1');
			$result1 = json_decode((string)$response1->getBody(),true);
			$item_list = $result1;
			
			
			$returnHTML = view('supplier.rfq_items_form')->with('rfq_items', $_SESSION['rfq_items'])->with('quote', $_SESSION['quote'])->with('item_list', $item_list[0]['id'])->with('rfq_id', $_SESSION['rfq_id'])->renderSections()['content'];
			
			
            return response()->json(array('success' => true, 'html'=>$returnHTML));


		}else{
			
		}
		
		
		try{

			$http = new \GuzzleHttp\Client();
			$quote    			= $request->quote;
			$rfq_items    		= $request->rfq_items;
			$rfq_item_send_id   = $request->rfq_item_send_id;
			$rfq_id   = $request->rfq_id;
			
			
			$response = $http->post(''.env('APP_URL').'api/v1/submititemQuoteFormApi?',[
				'headers'=>[
					'Authorization'=>'Bearer'.session()->get('token.access_token')
				],
				'query'=>[
					'quotes'=>$quote,
					'supplier_id'=>$supplier_id,
					'rfq_items'=>$rfq_items,
					'rfq_id'=>$rfq_id,
					'rfq_item_send_id'=>$rfq_item_send_id
				]
			]);
			$result = json_decode((string)$response->getBody(),true);
			
			//return redirect()->back()->with('success',$result['message']);
			
			return response()->json(array('success' => $result['message'],'html'=>1));
			
        }catch(\Exception $e){
         return redirect()->back()->with('error','Please fill all required fileds.');
        } 
	}
	
	
	public function submititemQuoteFormApiPopup(Request $request){
		
		
		$user_id = Auth::user()->id;
		$supplierData = Supplier::where('user_id',$user_id)->first();
		
		$supplier_id = $supplierData['id'];
		
		$rfq_item_send_id   = $request->rfq_item_send_id;
		
		
		try{

			$http = new \GuzzleHttp\Client();
			$quote    			= $request->quote;
			$rfq_items    		= $request->rfq_items;
			$rfq_item_send_id   = $request->rfq_item_send_id;
			$rfq_id   = $request->rfq_id;
			
			
			$response = $http->post(''.env('APP_URL').'api/v1/submititemQuoteFormApi?',[
				'headers'=>[
					'Authorization'=>'Bearer'.session()->get('token.access_token')
				],
				'query'=>[
					'quotes'=>$quote,
					'supplier_id'=>$supplier_id,
					'rfq_items'=>$rfq_items,
					'rfq_id'=>$rfq_id,
					'rfq_item_send_id'=>$rfq_item_send_id
				]
			]);
			$result = json_decode((string)$response->getBody(),true);
			
			return redirect()->back()->with('success',$result['message']);
			
        }catch(\Exception $e){
         return redirect()->back()->with('error','Please fill all required fileds.');
        } 
	}
	
	public function submititemQuoteFormForReviseApi(Request $request){
		
		
		 $user_id = Auth::user()->id;
		$supplierData = Supplier::where('user_id',$user_id)->first();
		
		$supplier_id = $supplierData['id'];
		
		 $rfq_id   = $request->rfq_id;
		$rfq_item_send_id   = $request->rfq_item_send_id;
		
		$rfqData['is_revise'] = 1;
		RfqItemSend::where('rfq_id', $rfq_id)->where('supplier_id', $supplier_id)->update($rfqData);
		
		if(isset($_SESSION['rfq_items']) && !empty($_SESSION['rfq_items'])){
				unset($_SESSION['rfq_items']);
		}
		
		echo "1"; die;
		
	}
	
}
