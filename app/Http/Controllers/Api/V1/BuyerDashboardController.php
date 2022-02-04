<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\User;


use App\Model\ProductGroup;
use App\Model\ShipLocation;
use App\Model\Industry;
use App\Model\PaymentTerms;
use App\Model\ShipMethod;

use App\Model\DeliveryTerm;
use App\Model\Item;
use App\Model\Supplier;
use App\Model\UnitMeasures;
use App\Model\Rfq;
use App\Model\RfqItem;
use App\Model\RfqItemDoc;
use App\Model\RfqItemSend;
use App\Model\SupplierQuotesOnRfqItem;
use App\Model\Country;
use App\Model\State;

use App\Model\SupplierRiskLevel;
use App\Model\PriceSetup;
use App\Model\Company;
use App\Model\RfqStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use Illuminate\Support\Str;
use DB;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;

class BuyerDashboardController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   
	public $successStatus = 200;
    public $errorStatus = 500;
    public $unauthorizedStatus = 401;

    public function __construct() {
        
        $this->successStatus = '200'; //apistatus('success');
        $this->errorStatus = '500'; //apistatus('internalservererror');
        $this->unauthorizedStatus = '401'; //apistatus('unauthorized');   
    }

   
	
	
	public function productGroupList($user_id=null){
      return  $ProductGroup = ProductGroup::where('is_deleted',0)->where('buyer_id',$user_id)->get();
    }
	public function shipLocationList($user_id=null){
      return  $ProductGroup = ShipLocation::where('is_deleted',0)->where('buyer_id',$user_id)->get();
    }
	public function buyerPaymentTermsList($user_id=null){
		
      return  $ProductGroup = PaymentTerms::where('is_deleted',0)->where('buyer_id',$user_id)->get();
    }
	public function shipMethodList($user_id=null){
		
      return  $ProductGroup = ShipMethod::where('is_deleted',0)->where('buyer_id',$user_id)->get();
    }

	public function deliveryTermsList($user_id=null){
		
      return  $ProductGroup = DeliveryTerm::where('is_deleted',NULL)->where('buyer_id',$user_id)->get();
    }
	public function unitMeasuresList($user_id=null){
		
      return  $ProductGroup = UnitMeasures::where('is_deleted',NULL)->where('buyer_id',$user_id)->get();
    }
	public function itemList($user_id=null){
		
     // return  $ProductGroup = Item::where('is_deleted',NULL)->where('buyer_id',$user_id)->get();
	  
	  return DB::table('items')
            ->join('product_groups', 'items.product_group', '=', 'product_groups.id')
            ->join('unit_measures', 'items.unit_measure', '=', 'unit_measures.id')
            ->select('items.*', 'items.product_group', 'product_groups.group_code', 'unit_measures.code')
            ->where('items.is_deleted',NULL)
            ->where('items.buyer_id',$user_id)
            ->get(); 
			
    }
	public function supplierList($user_id=null){
		
      return  $ProductGroup = Supplier::where('is_deleted',NULL)->where('buyer_id',$user_id)->get();
    }
	public function rfqList($user_id=null){
		return  $ProductGroup = Rfq::where('is_deleted',NULL)->where('buyer_id',$user_id)->where('is_draft','!=',1)->orderBy('id','DESC')->get();
    }
	public function draftRfqList($user_id=null){
		return  $ProductGroup = Rfq::where('is_deleted',NULL)->where('is_draft',1)->where('buyer_id',$user_id)->get();
    }
	public function rfqItemList($rfq_id=null){
		
		 	return DB::table('rfq_items')
            ->join('items', 'rfq_items.item_id', '=', 'items.id')
            ->join('product_groups', 'rfq_items.product_group', '=', 'product_groups.id')
           
            ->select('rfq_items.*', 'items.item_number', 'product_groups.group_code')
            ->where('rfq_items.is_deleted',NULL)
            ->where('rfq_items.rfq_id',$rfq_id)
            ->get();
		
	//	return  $ProductGroup = RfqItem::where('is_deleted',NULL)->where('rfq_id',$rfq_id)->get();
    }
	
	
	
	public function productGroupDetails($id){
        return ProductGroup::find($id);
    }
	public function shipLocationDetails($id){
        return ShipLocation::find($id);
    }
	public function paymentTermsDetails($id){
        return PaymentTerms::find($id);
    }
	public function shipMethodDetails($id){
        return ShipMethod::find($id);
    }
	public function deliveryTermsDetails($id){
        return DeliveryTerm::find($id);
    }
	public function unitMeasuresDetails($id){
        return UnitMeasures::find($id);
    }
	public function itemDetails($id){
        return Item::find($id);
    }
	public function supplierDetails($id){
        return Supplier::find($id);
    }
	public function rfqDetails($id){
        return Rfq::find($id);
    }
	public function rfqItemDetails($id){
		
		return DB::table('rfq_items')
            ->join('items', 'rfq_items.rfq_id', '=', 'items.id')
            ->join('product_groups', 'rfq_items.product_group', '=', 'product_groups.id')
            ->select('rfq_items.*', 'items.item_number', 'product_groups.group_code')
            ->where('rfq_items.is_deleted',NULL)
            ->where('rfq_items.id',$id)
            ->get(); 
		
        return RfqItem::find($id);
    }
	



     /**
     * @method submitaddProductGroupFormApi
     * @desc manage business course data in category array
     * @return category with course data array
     */
    public function submitaddProductGroupFormApi(Request $request){
		
        $input = $request->all();
		
		
		
        $message = ProductGroup::apiSubmitRules($request->all());
        
		if($message == ""){
			try {
				
				
				$saveData['id']             = $input['id'];
				
				
				if(empty($saveData['id'])){
                    $user = ProductGroup::create($request->all());

                    $success['message'] = 'Product group saved successfully';
                }else{
                  
                   $user = ProductGroup::where('id', $saveData['id'])
                    ->update($request->all());

                    $success['message'] = 'Product group updated successfully';
                }
				
				
				
				
				
				//$user = ProductGroup::create($request->all());
				//$success['message'] = 'Product group saved successfully';
				$success['success'] = 'success';
			
				$success['data'] =  $user;
				   
				
				return response()->json($success, $this->successStatus);
			} catch (\Exception $e){
				$error['error'] = $e->getMessage();
				return response()->json($error, $this->errorStatus);
			}
		}else {
           
            $error['error'] = $message;
            return response()->json($error, $this->successStatus);
        }
	
        
    }
	
	
    /**
     * @method submitaddProductGroupFormApi
     * @desc manage business course data in category array
     * @return category with course data array
     */
    public function submitaddShipLocationFormApi(Request $request){
		
        $input = $request->all();
		
		
		
        $message = ShipLocation::apiSubmitRules($request->all());
        
		if($message == ""){
			try {
				
				$saveData['id']             = $input['id'];
				
				
				if(empty($saveData['id'])){
                    $user = ShipLocation::create($request->all());

                    $success['message'] = 'Ship location saved successfully';
                }else{
                  
                   $user = ShipLocation::where('id', $saveData['id'])
                    ->update($request->all());

                    $success['message'] = 'Ship location updated successfully';
                }
				
				
				//$user = ShipLocation::create($request->all());
				//$success['message'] = 'Ship location saved successfully';
				$success['success'] = 'success';
			
				$success['data'] =  $user;
				   
				
				return response()->json($success, $this->successStatus);
			} catch (\Exception $e){
				$error['error'] = $e->getMessage();
				return response()->json($error, $this->errorStatus);
			}
		}else {
           
            $error['error'] = $message;
            return response()->json($error, $this->successStatus);
        }
	
        
    }
    /**
     * @method submitaddProductGroupFormApi
     * @desc manage business course data in category array
     * @return category with course data array
     */
    public function submitpaymentTermsFormApi(Request $request){
		
        $input = $request->all();
		
		
		
        $message = PaymentTerms::apiSubmitRules($request->all());
        
		if($message == ""){
			try {
				
				$saveData['id']             = $input['id'];
				
				if(empty($saveData['id'])){
                    $user = PaymentTerms::create($request->all());

                    $success['message'] = 'Payment terms saved successfully';
                }else{
                  
                   $user = PaymentTerms::where('id', $saveData['id'])
                    ->update($request->all());
                 //   print_r($saveData); die;

                    $success['message'] = 'Payment terms updated successfully';
                }
				
				
				//$user = PaymentTerms::create($request->all());
				//$success['message'] = 'Payment terms saved successfully';
				$success['success'] = 'success';
				
				$success['data'] =  $user;
				   
				
				return response()->json($success, $this->successStatus);
			} catch (\Exception $e){
				$error['error'] = $e->getMessage();
				return response()->json($error, $this->errorStatus);
			}
		}else {
           
            $error['error'] = $message;
            return response()->json($error, $this->successStatus);
        }
	
        
    }
    /**
     * @method submitaddProductGroupFormApi
     * @desc manage business course data in category array
     * @return category with course data array
     */
    public function submitaddShipMethodFormApi(Request $request){
		
        $input = $request->all();
		
        $message = ShipMethod::apiSubmitRules($request->all());
        
		if($message == ""){
			try {
				
				
				$saveData['id']             = $input['id'];
				
				
				if(empty($saveData['id'])){
                    $user = ShipMethod::create($request->all());

                    $success['message'] = 'Ship method saved successfully';
                }else{
                  
                   $user = ShipMethod::where('id', $saveData['id'])
                    ->update($request->all());

                    $success['message'] = 'Ship method updated successfully';
                }
				
				
				//$user = ShipMethod::create($request->all());
				//$success['message'] = 'Ship method saved successfully';
				$success['success'] = 'success';
			
				$success['data'] =  $user;
				   
				
				return response()->json($success, $this->successStatus);
			} catch (\Exception $e){
				$error['error'] = $e->getMessage();
				return response()->json($error, $this->errorStatus);
			}
		}else {
           
            $error['error'] = $message;
            return response()->json($error, $this->successStatus);
        }
	
        
    }
	/**
     * @method submitaddProductGroupFormApi
     * @desc manage business course data in category array
     * @return category with course data array
     */
    public function submitaddDeliveryTermFormApi(Request $request){
		
        $input = $request->all();
		
        $message = DeliveryTerm::apiSubmitRules($request->all());
        
		if($message == ""){
			try {
				
				
				$saveData['id']             = $input['id'];
				
				
				if(empty($saveData['id'])){
                    $user = DeliveryTerm::create($request->all());

                    $success['message'] = 'Delivery term saved successfully';
                }else{
                  
                   $user = DeliveryTerm::where('id', $saveData['id'])
                    ->update($request->all());

                    $success['message'] = 'Delivery term updated successfully';
                }
				
				
				//$user = DeliveryTerm::create($request->all());
				//$success['message'] = 'Ship method saved successfully';
				$success['success'] = 'success';
			
				$success['data'] =  $user;
				   
				
				return response()->json($success, $this->successStatus);
			} catch (\Exception $e){
				$error['error'] = $e->getMessage();
				return response()->json($error, $this->errorStatus);
			}
		}else {
           
            $error['error'] = $message;
            return response()->json($error, $this->successStatus);
        }
    }
	/**
     * @method submitaddProductGroupFormApi
     * @desc manage business course data in category array
     * @return category with course data array
     */
    public function submitaddUnitMeasuresFormApi(Request $request){
		
        $input = $request->all();
		
        $message = UnitMeasures::apiSubmitRules($request->all());
        
		if($message == ""){
			try {
				
				
				$saveData['id']             = $input['id'];
				
				
				if(empty($saveData['id'])){
                    $user = UnitMeasures::create($request->all());

                    $success['message'] = 'Unit measures saved successfully';
                }else{
                  
                   $user = UnitMeasures::where('id', $saveData['id'])
                    ->update($request->all());

                    $success['message'] = 'Unit measures updated successfully';
                }
				
				
				//$user = UnitMeasures::create($request->all());
				//$success['message'] = 'Ship method saved successfully';
				$success['success'] = 'success';
			
				$success['data'] =  $user;
				   
				
				return response()->json($success, $this->successStatus);
			} catch (\Exception $e){
				$error['error'] = $e->getMessage();
				return response()->json($error, $this->errorStatus);
			}
		}else {
           
            $error['error'] = $message;
            return response()->json($error, $this->successStatus);
        }
    }
	/**
     * @method submitaddProductGroupFormApi
     * @desc manage business course data in category array
     * @return category with course data array
     */
    public function submitaddItemFormApi(Request $request){
		
        $input = $request->all();
		
        $message = Item::apiSubmitRules($request->all());
        
		if($message == ""){
			try {
				
				
				$saveData['id']             = $input['id'];
				
				
				if(empty($saveData['id'])){
                    $user = Item::create($request->all());

                    $success['message'] = 'Item saved successfully';
                }else{
                  
                   $user = Item::where('id', $saveData['id'])
                    ->update($request->all());

                    $success['message'] = 'Item updated successfully';
                }
				
				
				//$user = Item::create($request->all());
				//$success['message'] = 'Ship method saved successfully';
				$success['success'] = 'success';
			
				$success['data'] =  $user;
				   
				
				return response()->json($success, $this->successStatus);
			} catch (\Exception $e){
				$error['error'] = $e->getMessage();
				return response()->json($error, $this->errorStatus);
			}
		}else {
           
            $error['error'] = $message;
            return response()->json($error, $this->successStatus);
        }
    }
	
	/**
     * @method submitaddProductGroupFormApi
     * @desc manage business course data in category array
     * @return category with course data array
     */
    public function submitaddSupplierFormApi(Request $request){
		
        $input = $request->all();
		
        $message = Supplier::apiSubmitRules($request->all());
        
		if($message == ""){
			try {
				
				$saveData['id']             = $input['id'];
				
				if(empty($saveData['id'])){
					
					$userData['name']           = $input['company_name'];
					$userData['email']          = $input['email'];
					$userData['role_id']        = '4';

						
					if($userData['role_id'] =='4'){
					  $userData['temp_password']  = '123456';
					  
					}
				   
					$insertedId = $id 	= 	User::create($userData)->id;
					if($userData['role_id'] =='4'){
						$saveData2['encoded_id']  = base64_encode($id);
						
						$user = User::where('id', $id)
						->update($saveData2);
					}
					
					
					
					$input['user_id'] = $insertedId;
					 
                    $user = Supplier::create($input);
					
					
					$data = array(
						'name'      =>  $input['company_name'],
						'message'   =>   "Your temp pass is ".$userData['temp_password']
					);
					
					$buyer_company_name = $this->get_buyer_company_name($input['buyer_id']);
					
					$to_name = $input['company_name'];
					$to_email = $input['email'];
					$data = array('name'=>$input['email'],'message2' => "Hello ".$input['company_name'].", <br><br>".$buyer_company_name." have added you as their supplier on QuoteSide.com. <br><br> Congratulations! Your account is ready to use.Please click the link below or copy and paste in your browser. <br> <br> https://quoteside.com/supplier/registration/".$saveData2['encoded_id']." <br><br> Please use the following login details to login in: <br><br>Email : ".$input['email']." <br>Temporary Password : ".$userData['temp_password']." <br><br>If you face any problem,please write back to us.<br><br>Thank you! <br><br><br>Team QuoteSide");
					Mail::send('email.new-user-create', $data, function($message) use ($to_name, $to_email) {
					$message->to($to_email, $to_name)
					->subject('Your Supplier Account on Quoteside');
					$message->from('demo231993@gmail.com','QuoteSide.com');
					});
						
						

                    $success['message'] = 'Supplier saved successfully';
                }else{
				
					$userData['name']           = $input['company_name'];
					$userData['email']          = $input['email'];
					
					$user = User::where('id', $input['user_id'])
                    ->update($userData);
					
					
                   $user = Supplier::where('id', $saveData['id'])
                    ->update($request->all());

                    $success['message'] = 'Supplier updated successfully';
                }
				
				
				//$user = Supplier::create($request->all());
				//$success['message'] = 'Ship method saved successfully';
				$success['success'] = 'success';
			
				$success['data'] =  $user;
				   
				
				return response()->json($success, $this->successStatus);
			} catch (\Exception $e){
				$error['error'] = $e->getMessage();
				return response()->json($error, $this->errorStatus);
			}
		}else {
           
            $error['error'] = $message;
            return response()->json($error, $this->successStatus);
        }
    }
	
	public function get_buyer_company_name($buyer_id){
		$userData = User::find($buyer_id);
		
		$companyData = Company::find($userData['company_name']);
		return $companyData['name'];
	}
	
	/**
     * @method submitaddProductGroupFormApi
     * @desc manage business course data in category array
     * @return category with course data array
     */
    public function submitaddRfqFormApi(Request $request){
		
        $input = $request->all();
		
        $message = Rfq::apiSubmitRules($request->all());
        
		if($message == ""){
			try {
				$saveData['id']             = $input['id'];
				
				if(empty($saveData['id'])){
                    $user = Rfq::create($request->all())->id;

                    $success['message'] = 'Rfq saved successfully';
					$insertedId = $user;
                }else{
                  
                   $user = Rfq::where('id', $saveData['id'])
                    ->update($request->all());

                    $success['message'] = 'Rfq updated successfully';
					$insertedId = $saveData['id'];
                }
				
				
				
				$success['success'] = 'success';
				$success['data'] =  $user;
				$success['insertedID'] =  $insertedId;
				return response()->json($success, $this->successStatus);
			} catch (\Exception $e){
				$error['error'] = $e->getMessage();
				return response()->json($error, $this->errorStatus);
			}
		}else {
           
            $error['error'] = $message;
            return response()->json($error, $this->successStatus);
        }
    }
	
	/**
     * @method submitaddProductGroupFormApi
     * @desc manage business course data in category array
     * @return category with course data array
     */
    public function submitaddRfqItemFormApi(Request $request){
		
        $input = $request->all();
		
        $message = RfqItem::apiSubmitRules($request->all());
        
		if($message == ""){
			try {
				$saveData['id']             = $input['id'];
				
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
                }
				$success['success'] = 'success';
				$success['data'] =  $user;
				return response()->json($success, $this->successStatus);
			} catch (\Exception $e){
				$error['error'] = $e->getMessage();
				return response()->json($error, $this->errorStatus);
			}
		}else {
           
            $error['error'] = $message;
            return response()->json($error, $this->successStatus);
        }
    }
	
	
	
	public function buyerdeleteByID(Request $request){
        $input = $request->all();

        $model =    $input['model'];
        if($input['model'] != "User"){
            $appPrefix = "App\Model";
        }else{
            $appPrefix = "App";
        }
		

        $modelName  = $appPrefix.'\\'.$model;

        $id     =   $input['id'];
        
        try {
		 if($model == "Company"){
			 $modelName::where('id', $id)
            ->update([
                'is_deleted' => '1'
                ]);
				
				RfqRange::where('assigned_to', $id)
            ->update([
                'assigned_to' => NULL
                ]);
				Company::where('id', $id)
            ->update([
                'rfq_range' => NULL
                ]);
				
		 }else{
			 $modelName::where('id', $id)
            ->update([
                'is_deleted' => '1'
                ]);
		 }
            $success['message'] = 'Deleted successfully';
            $success['success'] = 'success';
        

            return response()->json($success, $this->successStatus);
        } catch (\Exception $e){
            $error['error'] = $e->getMessage();
            return response()->json($error, $this->errorStatus);
        }
    }
	
	
	public function submitaddUserApi(Request $request){
        $input = $request->all();
		
        $message = User::apiSubmitRules($request->all());
        
        if($message == ""){
            try {

                $saveData['name']           = $input['name'];
                $saveData['phone']          = $input['phone'];
                $saveData['email']          = $input['email'];
                $saveData['company_name']   = $input['company_name'];
                $saveData['role_id']        = $input['role_id'];
                $saveData['buyer_id']        = $input['buyer_id'];

                $saveData['id']             = $input['id'];
				
				

                if(empty($saveData['id'])){
					
					if($saveData['role_id'] =='3'){
					  $saveData['temp_password']  = '123456';
					  
					}
                   
					$id 	= 	User::create($saveData)->id;
					if($saveData['role_id'] =='3'){
						$saveData2['encoded_id']  = base64_encode($id);
						
						$user = User::where('id', $id)
						->update($saveData2);
					}
                    $success['message'] = 'User saved successfully';
					
					
					
					$data = array(
						'name'      =>  $saveData['name'],
						'message'   =>   "Your temp pass is ".$saveData['temp_password']
					);
					
					$to_name = $saveData['name'];
					$to_email = $saveData['email'];
					$data = array('name'=>$saveData['email'],'message2' => "Hello ".$saveData['name'].", <br><br>Thank you for showing interest in QuoteSide.com. <br><br> Congratulations! Your account is ready to use.Please click the link below or copy and paste in your browser. <br> <br> https://quoteside.com/buyer/registration/".$saveData2['encoded_id']." <br><br> Please use the following login details to login in: <br><br>Email : ".$saveData['email']." <br>Temporary Password : ".$saveData['temp_password']." <br><br>If you face any problem,please write back to us.<br><br>Thank you! <br><br><br>Team QuoteSide");
					Mail::send('email.new-user-create', $data, function($message) use ($to_name, $to_email) {
					$message->to($to_email, $to_name)
					->subject('Your QuoteSide Account is Ready');
					$message->from('demo231993@gmail.com','QuoteSide.com');
					});
					
		
	  
                }else{
                  
                   $user = User::where('id', $saveData['id'])
                    ->update($saveData);
                 //   print_r($saveData); die;

                    $success['message'] = 'User updated successfully';
                }
                
                $success['success'] = 'success';
            
                $success['data'] =  $user;

                return response()->json($success, $this->successStatus);
            } catch (\Exception $e){
                $error['error'] = $e->getMessage();
                return response()->json($error, $this->errorStatus);
            }
        }else {
           
            $error['error'] = $message;
            return response()->json($error, $this->successStatus);
        }
       
    }
	
	
	public function userList($user_id){
		
			return $result =  DB::table('users')
			->where('users.role_id', '3')
			->where('users.buyer_id', $user_id)
			->where('users.is_deleted', 0)
			
			->select('users.*')
			->get();
	

    }
	
	
	
	public function sendRfqSupplierFormApi(Request $request){
        $input = $request->all();
		
            try {
				$suppliers = explode(",",$input['supplier']);
				if(isset($suppliers) && !empty($suppliers)){
					foreach($suppliers as $each){
						$saveData['supplier_id']        = $each;
						$saveData['rfq_items']          = $input['rfq_items'];
						$_SESSION['rfq_id'] 			= $saveData['rfq_id'] = $input['rfq_id'];
						$saveData['buyer_id']        	= $input['buyer_id'];
						
						$id 	= 	RfqItemSend::create($saveData)->id;
						
						$supplierDetails = Supplier::find($each);

						$userData = User::find($input['buyer_id']);
		
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
					
					$rfq_id = $input['rfq_id'];
					
					$rfqData['status'] = 0;
					$rfqData['is_draft'] = 1;
					Rfq::where('id', $_SESSION['rfq_id'])
                    ->update($rfqData);
				}
                
                    $success['message'] = 'RFQ has been successfully sent to the selected supplier(s).';
					
				/* 	
					
					$data = array(
						'name'      =>  $saveData['name'],
						'message'   =>   "Your temp pass is ".$saveData['temp_password']
					);
					
					$to_name = $saveData['name'];
					$to_email = $saveData['email'];
					$data = array('name'=>$saveData['email'],'message2' => "Hello ".$saveData['name'].", <br><br>Thank you for showing interest in QuoteSide.com. <br><br> Congratulations! Your account is ready to use.Please click the link below or copy and paste in your browser. <br> <br> https://quoteside.com/buyer/registration/".$saveData2['encoded_id']." <br><br> Please use the following login details to login in: <br><br>Email : ".$saveData['email']." <br>Temporary Password : ".$saveData['temp_password']." <br><br>If you face any problem,please write back to us.<br><br>Thank you! <br><br><br>Team QuoteSide");
					Mail::send('email.new-user-create', $data, function($message) use ($to_name, $to_email) {
					$message->to($to_email, $to_name)
					->subject('Your QuoteSide Account is Ready');
					$message->from('demo231993@gmail.com','QuoteSide.com');
					}); */
					
		
                
                $success['success'] = 'success';
            
			

                return response()->json($success, $this->successStatus);
            } catch (\Exception $e){
                $error['error'] = $e->getMessage();
                return response()->json($error, $this->errorStatus);
            }
        
       
    }
	
	public function rfqItemSendList($rfq_id){
		return $result =  DB::table('rfq_item_send')
			->where('rfq_item_send.rfq_id', $rfq_id)
			->join('suppliers', 'rfq_item_send.supplier_id', '=', 'suppliers.id')
			->join('rfqs', 'rfq_item_send.rfq_id', '=', 'rfqs.id')
			->select('rfq_item_send.*','suppliers.company_name','suppliers.email','rfqs.rfq_id')
			->get();
	}
	public function rfqItemSendListForSupplier($rfq_id,$supplier_id){
		return $result =  DB::table('rfq_item_send')
			->where('rfq_item_send.supplier_id', $supplier_id)
			->where('rfq_item_send.rfq_id', $rfq_id)
			->join('suppliers', 'rfq_item_send.supplier_id', '=', 'suppliers.id')
			->join('rfqs', 'rfq_item_send.rfq_id', '=', 'rfqs.id')
			->select('rfq_item_send.*','suppliers.company_name','rfqs.rfq_id')
			->get();
	}
	public function rfqItemSendListForSupplierPanel($supplier_id){
		 return $result =  DB::table('rfq_item_send')
			->where('rfq_item_send.supplier_id', $supplier_id)
			->join('suppliers', 'rfq_item_send.supplier_id', '=', 'suppliers.id')
			->join('rfqs', 'rfq_item_send.rfq_id', '=', 'rfqs.id')
			->select('rfq_item_send.*','rfq_item_send.status as rfq_item_send_status','suppliers.company_name','rfqs.rfq_id','rfqs.status as rfq_status','rfq_item_send.rfq_id as rfqid')
			->get();
			
			
			
	}
	public function rfqItemSendDetailForSupplierPanel($supplier_id,$rfqid){
		return $result =  DB::table('rfq_item_send')
			->where('rfq_item_send.supplier_id', $supplier_id)
			->where('rfq_item_send.rfq_id', $rfqid)
			->join('suppliers', 'rfq_item_send.supplier_id', '=', 'suppliers.id')
			->join('rfqs', 'rfq_item_send.rfq_id', '=', 'rfqs.id')
			->select('rfq_item_send.*','suppliers.company_name','rfqs.rfq_id','rfqs.status as rfq_status','rfq_item_send.rfq_id as rfqid')
			->get();
	}
	
	public function submititemQuoteFormApi(Request $request){
        $input = $request->all();
		
            try {
				$i=0;
					foreach($input['rfq_item_send_id'] as $eachitem){
						$saveData['rfq_item_send_id']   = $eachitem;
						$saveData['supplier_id']   = $input['supplier_id'];
						$saveData['rfq_id']          = $input['rfq_id'][$i];
						$saveData['rfq_items']          = $input['rfq_items'][$i];
						if(isset($input['quotes'][$i]) && !empty($input['quotes'][$i])){
							$saveData['quotes']          	= $input['quotes'][$i];
						}else{
							$saveData['quotes']          	= 0;
						}
						
						
						$id 	= 	SupplierQuotesOnRfqItem::create($saveData)->id;
						
							
						 $rfq_id = $input['rfq_id'][$i];
						 $rfq_items = $input['rfq_items'][$i];
						
						/* $rfqData['status'] = 2;
						Rfq::where('id', $rfq_id)
						->update($rfqData); */
						
						$rfqData['status'] = 1;
						RfqItemSend::where('rfq_id', $rfq_id)->where('supplier_id', $input['supplier_id'])
						->update($rfqData); 
							
						
						$i++;
					}
					
					
					$rfqData['is_revise'] = 0;
					RfqItemSend::where('rfq_id', $input['rfq_id'][0])->where('supplier_id', $input['supplier_id'])->update($rfqData);
		
					

                    $success['message'] = 'Your Quote has been submitted successfully';
					
				/* 	
					
					$data = array(
						'name'      =>  $saveData['name'],
						'message'   =>   "Your temp pass is ".$saveData['temp_password']
					);
					
					$to_name = $saveData['name'];
					$to_email = $saveData['email'];
					$data = array('name'=>$saveData['email'],'message2' => "Hello ".$saveData['name'].", <br><br>Thank you for showing interest in QuoteSide.com. <br><br> Congratulations! Your account is ready to use.Please click the link below or copy and paste in your browser. <br> <br> https://quoteside.com/buyer/registration/".$saveData2['encoded_id']." <br><br> Please use the following login details to login in: <br><br>Email : ".$saveData['email']." <br>Temporary Password : ".$saveData['temp_password']." <br><br>If you face any problem,please write back to us.<br><br>Thank you! <br><br><br>Team QuoteSide");
					Mail::send('email.new-user-create', $data, function($message) use ($to_name, $to_email) {
					$message->to($to_email, $to_name)
					->subject('Your QuoteSide Account is Ready');
					$message->from('demo231993@gmail.com','QuoteSide.com');
					}); */
					
		
                
                $success['success'] = 'success';
            
			

                return response()->json($success, $this->successStatus);
            } catch (\Exception $e){
                $error['error'] = $e->getMessage();
                return response()->json($error, $this->errorStatus);
            }
        
       
    }
	public function cancelSendRfq(Request $request){
        $input = $request->all();
		
            try {
					$saveData['status']   = 1;
					

					Rfq::where('id', $input['id'])
                    ->update($saveData);
                $success['success'] = 'success';
            
			

                return response()->json($success, $this->successStatus);
            } catch (\Exception $e){
                $error['error'] = $e->getMessage();
                return response()->json($error, $this->errorStatus);
            }
        
       
    }
	public function statusChangeofQuote(Request $request){
        $input = $request->all();
		
            try {
					$saveData['status']   = $input['status'];
					//$saveData['rfq_id']   = $input['rfq_id'];
					//$saveData['supplier_id']   = $input['supplier_id'];
					

					SupplierQuotesOnRfqItem::where('rfq_id', $input['rfq_id'])->where('supplier_id', $input['supplier_id'])
                    ->where('rfq_items', $input['supplier_quotes_on_rfq_items_id'])
                    ->update($saveData);
					
					if($input['status'] == 1){
						$saveData1['status']   = 2;
						SupplierQuotesOnRfqItem::where('rfq_id', $input['rfq_id'])->where('supplier_id', '!=',$input['supplier_id'])
						->where('rfq_items', $input['supplier_quotes_on_rfq_items_id'])
						->update($saveData1);
					}else{
						
					}
					
					
					$rfqitemcount = SupplierQuotesOnRfqItem::where('rfq_id', $input['rfq_id'])->count();
					$rfqrejectcount = SupplierQuotesOnRfqItem::where('rfq_id', $input['rfq_id'])->where('status','!=', 0)->count();
					
					
					
                $success['success'] = 'success';
            if($input['status'] ==1){ // For accept
				if($rfqitemcount == $rfqrejectcount){
					$saveData['status']   = 1;

					Rfq::where('id', $input['rfq_id'])
					->update($saveData);
				}
				
				$success['message'] = 'Accepted successfully';
			}else{
				
				if($rfqitemcount == $rfqrejectcount){
					$saveData['status']   = 1;

					Rfq::where('id', $input['rfq_id'])
					->update($saveData);
				}
				$success['message'] = 'Rejected successfully';
			}
			
			 

                return response()->json($success, $this->successStatus);
            } catch (\Exception $e){
                $error['error'] = $e->getMessage();
                return response()->json($error, $this->errorStatus);
            }
        
       
    }
	
	public function getCountryList(){
		return Country::get();
	}
	public function getStateList($country_id=null){
		if($country_id == ""){
			$country_id = "231";
		}
		return State::where('country_id',$country_id)->get();
	}
	
	
	
}
