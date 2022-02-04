<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\User;


use App\Model\RfqRange;
use App\Model\Industry;
use App\Model\PaymentTerms;
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


class AdminDashboardController extends Controller {
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

    /**
     * @method dashboard
     * @desc user dashboard
     * @return course data array, accouncement data array
     */
    public function dashboard(Request $request){
       
        $data = $request->all();
        $user_type_id = User::getUserTypeId($data['id']);
        if ($user_type_id == 7) {
            $business_courses = $this->getBusinessCourses();
        }
        
        $indivi_courses = $this->getIndividualCourses();
      
        $success['success'] =  ___('data_set');
        $success['pages']['about'] = url("/about_us");
        $success['pages']['contact'] = url("/contact_us");
        $success['pages']['privecy'] = url("/privacy_policy");
        $success['pages']['terms_conditions'] = url("/terms_conditions");

        $categories = Category::getActiveCategories();
        array_unshift($categories ,array('key' => 0, 'title' => 'All Courses'));
  
        if ($user_type_id == 7) {
            $courses = $this->manageBusinessCourses($categories, $business_courses, $data['id']);
            $courses = $this->manageIndividualCourses($courses, $indivi_courses, $data['id']);
        } else {
            $courses = $this->manageIndividualCourses($categories, $indivi_courses, $data['id']);
        }
        $announcement_data = Announcement::getAllAnnouncement($user_type_id);
        $announcement_data = $this->manageAnnouncementData($announcement_data, $data['id']);
        foreach($announcement_data as $key => $announcement){
			$announcement_data[$key]['event_date_time'] = date('dS, M Y - h:i A', strtotime($announcement->event_date_time));
		}
        $videoList = Videos::getPublishedVideo();
        $success['data']['announcements'] =  $announcement_data;
        $success['data']['categories']    =  $courses;        
        $success['data']['video_uploaded']=  $announcement_data;
        $success['data']['video_list'] =  $videoList;
        $success['data']['my_courses']    =  UserCourse::getUserCourses($data['id']);
        return response()->json($success, $this->successStatus);
    }

    /**
     * @method submitrfqrange
     * @desc manage business course data in category array
     * @return category with course data array
     */
    public function submitrfqrange(Request $request){
        $input = $request->all();
		
        $message = RfqRange::apiSubmitRules($request->all());
        
		if($message == ""){
			try {
				$user = RfqRange::create($request->all());
				$success['message'] = 'RFQ range saved successfully';
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
     * @method submitIndustries
     * @desc manage business course data in category array
     * @return category with course data array
     */
    public function submitIndustries(Request $request){
        $input = $request->all();
		
       // $message = Industry::apiSubmitRules($request->all());
     
        try {
           
            foreach($input['name'] as $eachterms){
                 $saveData['name'] = $eachterms;
                 $user = Industry::create($saveData);
             }
             
            $success['message'] = 'Industry saved successfully';
            $success['success'] = 'success';
        
            $success['data'] =  $user;
                
            
            return response()->json($success, $this->successStatus);
        } catch (\Exception $e){
            $error['error'] = $e->getMessage();
            return response()->json($error, $this->errorStatus);
        }
		
	
        
    }

     /**
     * @method submitPayment
     * @desc manage business course data in category array
     * @return category with course data array
     */
    public function submitPayment(Request $request){
        $input = $request->all();
		//print_r($input['name']); die;
        //$message = Industry::apiSubmitRules($request->all());
        
          
        try {
            foreach($input['name'] as $eachterms){
               // print_r($eachterms);die;
                $saveData['name'] = $eachterms;
                $user = PaymentTerms::create($saveData);
            }
            
            $success['message'] = 'Payment terms saved successfully';
            $success['success'] = 'success';
        
            $success['data'] =  $user;
                
            
            return response()->json($success, $this->successStatus);
        } catch (\Exception $e){
            $error['error'] = $e->getMessage();
            return response()->json($error, $this->errorStatus);
        }
    
	
        
    }
     /**
     * @method submitRiskLevel
     * @desc manage business course data in category array
     * @return category with course data array
     */
    public function submitRiskLevel(Request $request){
        $input = $request->all();
		//print_r($input['name']); die;
        //$message = Industry::apiSubmitRules($request->all());
        
          
        try {
            foreach($input['name'] as $eachterms){
               // print_r($eachterms);die;
                $saveData['name'] = $eachterms;
                $user = SupplierRiskLevel::create($saveData);
            }
            
            $success['message'] = 'Supplier risk level saved successfully';
            $success['success'] = 'success';
        
            $success['data'] =  $user;
                
            
            return response()->json($success, $this->successStatus);
        } catch (\Exception $e){
            $error['error'] = $e->getMessage();
            return response()->json($error, $this->errorStatus);
        }
    
	
        
    }
	/**
     * @method submitRiskLevel
     * @desc manage business course data in category array
     * @return category with course data array
     */
    public function submitPriceSetup(Request $request){
         $input = $request->all();
		
        $message = PriceSetup::apiSubmitRules($request->all());
        
        if($message == ""){
            try {
				if(isset($input['end_to']) && !empty($input['end_to'])){
					$input['end_to'] = $input['end_to'];
				}else{
					$input['end_to'] = 0;
				}
                $saveData['start_from']           = $input['start_from'];
                $saveData['end_to']          = $input['end_to'];
                $saveData['price']          = $input['price'];

                $saveData['id']             = $input['id'];


                if(empty($saveData['id'])){
                    $user = PriceSetup::create($saveData);

                    $success['message'] = 'Price Setup saved successfully';
                }else{
                  
                   $user = PriceSetup::where('id', $saveData['id'])
                    ->update($saveData);
                 //   print_r($saveData); die;

                    $success['message'] = 'Price Setup updated successfully';
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

    public function submitaddcompany(Request $request){
        $input = $request->all();
		
        $message = Company::apiSubmitRules($request->all());
        $id = $input['id'];
        if($message == ""){

            if(empty( $id)){
                $message = Company::isAllReadyAssign($request->all());
            }else{
                $message =  "";
            }
             
            
            if(!empty($message)){
                $error['message'] = $message;
               
                $error['error'] = $message;
            
                $error['data'] =  '';
                return response()->json($error, $this->successStatus);
            }else{
                try {

                    $id = $input['id'];
					
					
					
                    if(empty($id)){
                        $user = Company::create($input);
                    
                        $insertedId = $user->id;
						
						
						$saveData['name']           = $input['name'];
						$saveData['phone']          = $input['phone'];
						$saveData['email']          = $input['email'];
						$saveData['price']          = $input['price'];
						$saveData['discount']       = $input['discount'];
						$saveData['company_name']   = $insertedId;
						$saveData['role_id']        = '2';

							
						if($saveData['role_id'] =='2'){
						  $saveData['temp_password']  = '123456';
						  
						}
					   
						$id 	= 	User::create($saveData)->id;
						if($saveData['role_id'] =='2'){
							$saveData2['encoded_id']  = base64_encode($id);
							
							$user = User::where('id', $id)
							->update($saveData2);
						}
						$success['message'] = 'Company user saved successfully';
						
						
						
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
							
				
						
						
                        $success['message'] = 'Company saved successfully';
                    }else{
						
						$saveData['id']             = $input['user_id'];
						
						
						$vvvv = [
							'name'=>$input['name'],
							'email'=>$input['email'],
							'phone'=>$input['phone'],
							'contact_name'=>$input['contact_name'],
							'website'=>$input['website'],
							'no_of_users'=>$input['no_of_users'],
							
							'city'=>$input['city'],
							'state'=>$input['state'],
							'zip_code'=>$input['zip_code'],
							'country'=>$input['country'],
							'address'=>$input['address'],
							'payment_term'=>$input['payment_term'],
							'industry'=>$input['industry'],
							'rfq_range'=>$input['rfq_range'],
							'id'=>$input['id']
						];
						
                        $user = Company::where('id', $input['id'])
                        ->update($vvvv);
						
						$saveData['name']           = $input['name'];
						$saveData['phone']          = $input['phone'];
						$saveData['email']          = $input['email'];
						$saveData['price']          = $input['price'];
						$saveData['discount']       = $input['discount'];
						
						
						$insertedId   =  $input['id'];

						//$saveData['id']             = $input['user_id'];
					
						 $user = User::where('id', $input['user_id'])
							->update($saveData);
							
							
                        $success['message'] = 'Company updated successfully';
                    }
                    
                    RfqRange::where('assigned_to', $id)
                    ->update([
                        'assigned_to' => NULL
                        ]);
                    
                    RfqRange::where('id', $input['rfq_range'])
                    ->update([
                        'assigned_to' => $insertedId
                        ]);

                   
                    $success['success'] = 'success';
                
                    $success['data'] =  $user;
                        
                    
                    return response()->json($success, $this->successStatus);
                } catch (\Exception $e){
                    $error['error'] = $e->getMessage();
                    return response()->json($error, $this->errorStatus);
                }
            }
            
        }else {
           
            $error['error'] = $message;
            return response()->json($error, $this->successStatus);
        }
       
    }


    public function submitaddcompanyuser(Request $request){
        $input = $request->all();
		
        $message = User::apiSubmitRules($request->all());
        
        if($message == ""){
            try {

                $saveData['name']           = $input['name'];
                $saveData['phone']          = $input['phone'];
                $saveData['email']          = $input['email'];
                $saveData['company_name']   = $input['company_name'];
                $saveData['role_id']        = $input['role_id'];

                $saveData['id']             = $input['id'];
				
				

                if(empty($saveData['id'])){
					
					if($saveData['role_id'] =='2'){
					  $saveData['temp_password']  = '123456';
					  
					}
                   
					$id 	= 	User::create($saveData)->id;
					if($saveData['role_id'] =='2'){
						$saveData2['encoded_id']  = base64_encode($id);
						
						$user = User::where('id', $id)
						->update($saveData2);
					}
                    $success['message'] = 'Company user saved successfully';
					
					
					
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

                    $success['message'] = 'Company user updated successfully';
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


    public function submitrfqstatus(Request $request){
        $input = $request->all();
		
        $message = RfqStatus::apiSubmitRules($request->all());
        
        if($message == ""){
            try {
				
				 foreach($input['name'] as $eachterms){
					 $saveData['name'] = $eachterms;
					 $user = RfqStatus::create($saveData);
				
				 }
				 
                

                $success['message'] = 'RFQ Status saved successfully';
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



    public function paymenttermsList(){
      return  $payment_terms = PaymentTerms::where('is_deleted',0)->get();
    }
	public function supplierRiskLevelList(){
      return  $risk_level = supplierRiskLevel::where('is_deleted',0)->get();
    }
    public function industryList(){
        return  $industries = Industry::where('is_deleted',0)->get();
    }
    public function rfqRangeList(){
       // return  $rfqrange = RfqRange::get();

        return $result =  DB::table('rfq_ranges')
       
        ->Leftjoin('companies', 'rfq_ranges.id', '=', 'companies.rfq_range')
        ->select('rfq_ranges.*','companies.name AS company_name')
        ->get();


    }
    public function notAssignedRfqRangeList(){
       if(isset($_GET['id']) && !empty($_GET['id'])){
        return  $rfqrange = RfqRange::where('rfq_ranges.assigned_to',$_GET['id'])->orWhere('rfq_ranges.assigned_to',NULL)->get();
       }else{
        return  $rfqrange = RfqRange::Where('rfq_ranges.assigned_to',NULL)->get();
       }
        
 
        /* return $result =  DB::table('rfq_ranges')
         ->where('rfq_ranges.assigned_to', 'NULL')
         ->select('rfq_ranges.*')
         ->get();*/
 
 
     }
    public function companyList(){
        //return  $company = Company::get();
        return $result =  DB::table('companies')
        ->where('companies.is_deleted', 0)
        ->join('rfq_ranges', 'companies.rfq_range', '=', 'rfq_ranges.id')
        ->join('industries', 'companies.industry', '=', 'industries.id')
        //->join('payment_terms', 'companies.payment_term', '=', 'payment_terms.id')
        ->select('companies.*', 'rfq_ranges.sequence_letter', 'rfq_ranges.start_from', 'rfq_ranges.end_to', 'rfq_ranges.assigned_to','industries.name AS industry_name')
        ->get();



    }
    public function companyUserList(Request $request){
		
		$input = $request->all();
		//echo $_GET['company']; die;
       // return  $user = User::where('role_id','2')->get();
	//echo $company; die;
	if(isset($input['company']) && !empty($input['company'])){
		return $result =  DB::table('users')
        ->where('users.role_id', '2')
        ->where('users.is_deleted', 0)
        ->where('users.company_name', $input['company'])
        ->join('companies', 'users.company_name', '=', 'companies.id')
       
        ->select('users.*','companies.name AS company_name')
        ->get();
	}else{
		return $result =  DB::table('users')
        ->where('users.role_id', '2')
        ->where('users.is_deleted', 0)
        ->join('companies', 'users.company_name', '=', 'companies.id')
       
        ->select('users.*','companies.name AS company_name')
        ->get();
	}
        

    }
    public function rfqStatusList(){
        return  $user = rfqStatus::get();
    }

    public function priceList(){
        return  $user = PriceSetup::where('is_deleted',NULL)->get();
    }

    public function changeRfqStatus(Request $request){
        $input = $request->all();
		
        $id     =   $input['id'];
        $status =   $input['status'];


        try {

            $saveData['status']   =     $input['status'];

           
            RfqStatus::where('id', $id)
            ->update([
                'status' => $status
                ]);



            $success['message'] = 'RFQ Status changed successfully';
            $success['success'] = 'success';
        

            return response()->json($success, $this->successStatus);
        } catch (\Exception $e){
            $error['error'] = $e->getMessage();
            return response()->json($error, $this->errorStatus);
        }
       
       
    }

    public function deleteByID(Request $request){
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

    public function userDetails($id){
        return User::find($id);

    }
	public function userDetailsbyCompanyId($id){
        return User::where('company_name',$id)->first();

    }
    public function companydetails($id){
        return Company::find($id);

    }
    public function pricesetupdetails($id){
        return PriceSetup::find($id);

    }

    public function updateByID(Request $request){
        $input = $request->all();

        $model =    $input['model'];
        if($input['model'] != "User"){
            $appPrefix = "App\Model";
        }else{
            $appPrefix = "App";
        }
		

        $modelName  = $appPrefix.'\\'.$model ;

        $id     =   $input['id'];
        $name     =   $input['name'];
        try {

         
            $modelName::where('id', $id)
            ->update([
                'name' => $name
                ]);



            $success['message'] = 'Updated successfully';
            $success['success'] = 'success';
        

            return response()->json($success, $this->successStatus);
        } catch (\Exception $e){
            $error['error'] = $e->getMessage();
            return response()->json($error, $this->errorStatus);
        }
       
       
    }

    public function companydetailsByID($id){
        return $result =  DB::table('companies')
        ->where('companies.id', $id)
        ->join('rfq_ranges', 'companies.rfq_range', '=', 'rfq_ranges.id')
        ->join('industries', 'companies.industry', '=', 'industries.id')
      //  ->join('payment_terms', 'companies.payment_term', '=', 'payment_terms.id')
        ->select('companies.*', 'rfq_ranges.sequence_letter', 'rfq_ranges.start_from', 'rfq_ranges.end_to', 'rfq_ranges.assigned_to','industries.name AS industry_name')
        ->get();

    }
	
	
	public function createpassword(Request $request){
        $input = $request->all();

      
        $password     =   $input['password'];
        $user_id     =   $input['user_id'];
		$password = $password;
		$hashedPassword = Hash::make($password);

        try {

         
            User::where('encoded_id', $user_id)
            ->update([
                'password' => $hashedPassword,
                'temp_password' => '',
                ]);
            $success['message'] = 'Updated successfully';
            $success['success'] = 'success';
        

            return response()->json($success, $this->successStatus);
        } catch (\Exception $e){
            $error['error'] = $e->getMessage();
            return response()->json($error, $this->errorStatus);
        }
       
       
    }
	
	public function getrfqStatusList(){
        return  $user = rfqStatus::where('status','1')->get();
    }
}
