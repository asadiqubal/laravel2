<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Auth;
use Session;
use App\Exports\UserExport;
use App\Exports\CompanyExport;

use App\User;
use App\Model\Industry;
use App\Model\PaymentTerms;
use App\Model\PriceSetup;
use App\Model\Country;
use App\Model\SupplierRiskLevel;
//use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
class AdminController extends Controller
{
	
    public function __construct()
    {
		
        $this->middleware('auth');
      //  $this->middleware('role:ROLE_ADMIN');
    }

    /*public function export() 
	{
		return Excel::download(new userExport, 'company_users.xlsx');
	}
    public function exportCompany() 
	{
		return Excel::download(new CompanyExport, 'company.xlsx');
	}
	*/
	
    public function dashboard()
    { 
        $http = new \GuzzleHttp\Client();

		$response = $http->get(''.env('APP_URL').'api/v1/companyUserList');
	
		$result = json_decode((string)$response->getBody(),true);

		$response2 = $http->get(''.env('APP_URL').'api/v1/companyList');
		
		$result2 = json_decode((string)$response2->getBody(),true);

		$data['company_count'] = count($result2);
		$data['user_count'] = count($result);

        return view('admin.dashboard',$data);
    }
	
    public function addCompanyUser()
    { 
		$http = new \GuzzleHttp\Client();

		$response = $http->get(''.env('APP_URL').'api/v1/companyList');
	
		$result = json_decode((string)$response->getBody(),true);

		$data['comapany_list'] = $result;

        return view('admin.add-company-users',$data);
    }
	public function editCompanyUser($id=null)
    { 
		$http = new \GuzzleHttp\Client();

		$response = $http->get(''.env('APP_URL').'api/v1/companyList');
	
		$result = json_decode((string)$response->getBody(),true);

		$response1 = $http->get(''.env('APP_URL').'api/v1/userDetails/'.$id);
	
		$userData = json_decode((string)$response1->getBody(),true);

		$data['comapany_list'] = $result;
		$data['userdetails'] = $userData;
		$data['id'] = $id;
        return view('admin.edit-company-users',$data);
    }
	
    public function companyUserList($company=null)
    { 
		if(isset($_GET['company']) && !empty($_GET['company'])){
			$_GET['company'] = $_GET['company'];
		}else{
			$_GET['company'] = "";
		}
		try{

			$http = new \GuzzleHttp\Client();

			$response = $http->get(''.env('APP_URL').'api/v1/companyUserList?company='.$_GET['company']);
			
			/* $response = $http->get(''.env('APP_URL').'api/v1/companyUserList?',[
				'headers'=>[
					'Authorization'=>'Bearer'.session()->get('token.access_token')
				],
				'query'=>[
					'company'=>$company
				]
			]); */
			
			
			
			
			$result = json_decode((string)$response->getBody(),true);
			
        }catch(\Exception $e){
			$result = "";
           // return redirect()->back()->with('error','Please fill all required fileds.');
        } 
		$response1 = $http->get(''.env('APP_URL').'api/v1/companyList');
	
		$result1 = json_decode((string)$response1->getBody(),true);
		$data['comapany_list'] = $result1;
		$data['company_user_list'] = $result;
        return view('admin.companies-user-list',$data);
    }

    public function addCompany()
    { 
		$http = new \GuzzleHttp\Client();
		$response = $http->get(''.env('APP_URL').'api/v1/paymenttermsList');
		$result = json_decode((string)$response->getBody(),true);
        

		$response2 = $http->get(''.env('APP_URL').'api/v1/industryList');
		$result2 = json_decode((string)$response2->getBody(),true);
		
		$response3 = $http->get(''.env('APP_URL').'api/v1/notAssignedRfqRangeList');
		$result3 = json_decode((string)$response3->getBody(),true);
		
		$response4 = $http->get(''.env('APP_URL').'api/v1/priceList');
		
		$result4 = json_decode((string)$response4->getBody(),true);
		
		
		$countryres = $http->get(''.env('APP_URL').'api/v1/getCountryList/');
		$country = json_decode((string)$countryres->getBody(),true);
		
		$stateres = $http->get(''.env('APP_URL').'api/v1/getStateList/231');
		$state = json_decode((string)$stateres->getBody(),true);
		
		
		$data['countryList'] = $country;
		$data['stateList'] = $state;
		
		
		$data['payment_terms'] = $result;
		$data['rfqrange_list'] = $result3;
		$data['pricesetp_list'] = $result4;
		$data['industry_list'] = $result2;
		$data['country_list'] = Country::countryList();
		
		

        return view('admin.add-company',$data);
    }

	public function editCompany($id=null)
    { 
		$http = new \GuzzleHttp\Client();
		$response = $http->get(''.env('APP_URL').'api/v1/paymenttermsList');
		$result = json_decode((string)$response->getBody(),true);
        

		$response2 = $http->get(''.env('APP_URL').'api/v1/industryList');
		$result2 = json_decode((string)$response2->getBody(),true);
		
		$response3 = $http->get(''.env('APP_URL').'api/v1/notAssignedRfqRangeList?id='.$id);
		$result3 = json_decode((string)$response3->getBody(),true);

		$response1 = $http->get(''.env('APP_URL').'api/v1/companydetails/'.$id);
	
		$companydetails = json_decode((string)$response1->getBody(),true);
		
		$response4 = $http->get(''.env('APP_URL').'api/v1/priceList');
		
		$result4 = json_decode((string)$response4->getBody(),true);
		//dd($companydetails); die;
		
		$response5 = $http->get(''.env('APP_URL').'api/v1/userDetailsbyCompanyId/'.$id);
	
		$userData = json_decode((string)$response5->getBody(),true);
		
		$countryres = $http->get(''.env('APP_URL').'api/v1/getCountryList/');
		$country = json_decode((string)$countryres->getBody(),true);
		
		$stateres = $http->get(''.env('APP_URL').'api/v1/getStateList/231');
		$state = json_decode((string)$stateres->getBody(),true);
		
		
		$data['countryList'] = $country;
		$data['stateList'] = $state;
		
		$data['payment_terms'] = $result;
		$data['rfqrange_list'] = $result3;
		$data['industry_list'] = $result2;
		$data['pricesetp_list'] = $result4;
		$data['userData'] = $userData;
		$data['country_list'] = Country::countryList();
		$data['companydetails'] = $companydetails;
		$data['id'] = $id;

        return view('admin.edit-company',$data);
    }

    public function companyList()
    { 
		try{

			$http = new \GuzzleHttp\Client();

			$response = $http->get(''.env('APP_URL').'api/v1/companyList');
		
			$result = json_decode((string)$response->getBody(),true);
			
        }catch(\Exception $e){
			$result = "";
           // return redirect()->back()->with('error','Please fill all required fileds.');
        } 
		//dd($result); die;
		$data['company_list'] = $result;
        return view('admin.companies-list',$data);
    }
    public function industries()
    { 
		try{
			$http = new \GuzzleHttp\Client();
			$response = $http->get(''.env('APP_URL').'api/v1/industryList');
			$result = json_decode((string)$response->getBody(),true);
        }catch(\Exception $e){
			$result = "";
           // return redirect()->back()->with('error','Please fill all required fileds.');
        } 
		$data['industries'] = $result;
        return view('admin.industries',$data);
    }
    public function paymentsTerms()
    { 
		try{

			$http = new \GuzzleHttp\Client();

			$response = $http->get(''.env('APP_URL').'api/v1/paymenttermsList');
		
			$result = json_decode((string)$response->getBody(),true);
			
        }catch(\Exception $e){
			$result = "";
           // return redirect()->back()->with('error','Please fill all required fileds.');
        } 

		$data['payment_terms'] = $result;
        return view('admin.payments-terms',$data);
    }
	public function supplierRiskLevel()
    { 
		try{

			$http = new \GuzzleHttp\Client();

			$response = $http->get(''.env('APP_URL').'api/v1/supplierRiskLevelList');
		
			$result = json_decode((string)$response->getBody(),true);
			
        }catch(\Exception $e){
			$result = "";
           // return redirect()->back()->with('error','Please fill all required fileds.');
        } 

		$data['risk_level'] = $result;
        return view('admin.supplier-risk-level',$data);
    }
    public function roles()
    { 
        if(Auth::user()){
			 $userId = Auth::user()->id;
			 if(!empty($userId)){
				// return redirect()->route('home');
			 }
		}
        return view('admin.roles');
    }
    public function rfqRange()
    { 
		$http = new \GuzzleHttp\Client();
        $response3 = $http->get(''.env('APP_URL').'api/v1/rfqRangeList');
		$result3 = json_decode((string)$response3->getBody(),true);
		$data['rfq_range_list'] = $result3;
        return view('admin.rfq-range',$data);
    }
    public function rfqStatusList()
    { 
        $http = new \GuzzleHttp\Client();
        $response3 = $http->get(''.env('APP_URL').'api/v1/rfqStatusList');
		$result3 = json_decode((string)$response3->getBody(),true);
		$data['rfq_status_list'] = $result3;
        return view('admin.rfq-status',$data);
    }
    public function rfqRangeList()
    { 
		$http = new \GuzzleHttp\Client();
		$response3 = $http->get(''.env('APP_URL').'api/v1/rfqRangeList');
		$result3 = json_decode((string)$response3->getBody(),true);
		$data['rfq_range_list'] = $result3;
        
        return view('admin.rfq-range-list',$data);
    }
    public function submitRfqRangeApi(Request $request)
    { 
	
     	try{

			$http = new \GuzzleHttp\Client();
		
			$sequence    = $request->sequence_letter;
			$start_from = $request->start_from;
			$end_to = $request->end_to;

			$response = $http->post(''.env('APP_URL').'api/v1/submitrfqrange?',[
				'headers'=>[
					'Authorization'=>'Bearer'.session()->get('token.access_token')
				],
				'query'=>[
					'sequence_letter'=>$sequence,
					'start_from'=>$start_from,
					'end_to'=>$end_to
				]
			]);
			$result = json_decode((string)$response->getBody(),true);
			
			return redirect()->back()->with('success',$result['message']);
			
			

        }catch(\Exception $e){
            return redirect()->back()->with('error','Please fill all required fileds.');
        } 
    }

	/**
	 * Function for submit Industries
	 */
	public function submitIndustryApi(Request $request)
    { 
	
		try{
			$http = new \GuzzleHttp\Client();
		
			$name    = $request->name;
			
			
			$response = $http->post(''.env('APP_URL').'api/v1/submitIndustries?',[
				'headers'=>[
					'Authorization'=>'Bearer'.session()->get('token.access_token')
				],
				'query'=>[
					'name'=>$name
				]
			]);
			$result = json_decode((string)$response->getBody(),true);
		
			
			return redirect()->back()->with('success',$result['message']);
			
			

        }catch(\Exception $e){
            return redirect()->back()->with('error','Please enter name of industry.');
        } 
    }

	/**
	 * Function for submit submitPaymentApi
	 */
	public function submitPaymentApi(Request $request)
    { 
		
		try{
			$http = new \GuzzleHttp\Client();
		
			$name    = $request->name;
			
			
			$response = $http->post(''.env('APP_URL').'api/v1/submitPayment?',[
				'headers'=>[
					'Authorization'=>'Bearer'.session()->get('token.access_token')
				],
				'query'=>[
					'name'=>$name
				]
			]);
			$result = json_decode((string)$response->getBody(),true);
		
			
			return redirect()->back()->with('success',$result['message']);
			
			

        }catch(\Exception $e){
            return redirect()->back()->with('error','Please enter name of payment terms.');
        } 
    }
	/**
	 * Function for submit submitSupplierRiskLevelApi
	 */
	public function submitSupplierRiskLevelApi(Request $request)
    { 
		
		try{
			$http = new \GuzzleHttp\Client();
		
			$name    = $request->name;
			
			
			$response = $http->post(''.env('APP_URL').'api/v1/submitRiskLevel?',[
				'headers'=>[
					'Authorization'=>'Bearer'.session()->get('token.access_token')
				],
				'query'=>[
					'name'=>$name
				]
			]);
			$result = json_decode((string)$response->getBody(),true);
		
			
			return redirect()->back()->with('success',$result['message']);
			
			

        }catch(\Exception $e){
            return redirect()->back()->with('error','Please enter name of risk level.');
        } 
    }
	
	
	 public function addPrice()
    { 

        return view('admin.add-price');
    }

	public function editPrice($id=null)
    { 
		$http = new \GuzzleHttp\Client();
	
		$response1 = $http->get(''.env('APP_URL').'api/v1/pricesetupdetails/'.$id);
	
		$pricesetupdetails = json_decode((string)$response1->getBody(),true);
		//dd($companydetails); die;

		$data['pricesetupdetails'] = $pricesetupdetails;
		$data['id'] = $id;

        return view('admin.edit-price',$data);
    }

    public function priceList()
    { 
		try{

			$http = new \GuzzleHttp\Client();

			$response = $http->get(''.env('APP_URL').'api/v1/priceList');
		
			$result = json_decode((string)$response->getBody(),true);
			
        }catch(\Exception $e){
			$result = "";
           // return redirect()->back()->with('error','Please fill all required fileds.');
        } 
		//dd($result); die;
		$data['price_list'] = $result;
        return view('admin.price-list',$data);
    }
	
	
	/**
	 * Function for submit submitSupplierRiskLevelApi
	 */
	public function submitPriceSetupApi(Request $request)
    { 
		
		try{
			$http = new \GuzzleHttp\Client();
		
			$start_from    = $request->start_from;
			$end_to    		= $request->end_to;
			$price    	= $request->price;
			if(isset($request->id) && !empty($request->id)){
				$id 		= $request->id;
			}else{
				$id 		= '';
			}
			
			
			$response = $http->post(''.env('APP_URL').'api/v1/submitPriceSetup?',[
				'headers'=>[
					'Authorization'=>'Bearer'.session()->get('token.access_token')
				],
				'query'=>[
					'start_from'=>$start_from,
					'end_to'=>$end_to,
					'price'=>$price,
					'id'=>$id
				]
			]);
			$result = json_decode((string)$response->getBody(),true);
		
			
			return redirect()->back()->with('success',$result['message']);
			
			

        }catch(\Exception $e){
            return redirect()->back()->with('error','Please enter required fields.');
        } 
    }

	public function submitaddCompanyApi(Request $request)
    { 
		
		$name    		= 	$request->name;
		$email    		= 	$request->email;
		$phone    		= 	$request->phone;
		$contact_name   = 	$request->contact_name;
		$website    	= 	$request->website;
		$no_of_users    = 	$request->no_of_users;
		$city    		= 	$request->city;
		$state    		= 	$request->state;
		$zip_code    	= 	$request->zip_code;
		$country   	 	= 	$request->country;
		$address 		= $request->address;
		$payment_term 	= $request->payment_term;
		$industry 		= $request->industry;
		$rfq_range 		= $request->rfq_range;
		
		
		$price    		= 	$request->price;
		$discount    	= 	$request->discount;

		if(isset($request->payment_term) && !empty($request->payment_term)){
			$payment_term 	= $request->payment_term;
		}else{
			$payment_term 	= 0;
		}
		if(isset($request->id) && !empty($request->id)){
			$id 		= $request->id;
			
			$user_id  =  User::where('company_name',$id)->first();
			$user_id  =  $user_id['id'];
		
		}else{
			$id 		= '';
			$user_id 		= '';
		}
		
		$vvvv = [
				'name'=>$name,
				'email'=>$email,
				'phone'=>$phone,
				'contact_name'=>$contact_name,
				'website'=>$website,
				'no_of_users'=>$no_of_users,
				'discount'=>$discount,
				'price'=>$price,
				'city'=>$city,
				'state'=>$state,
				'zip_code'=>$zip_code,
				'country'=>$country,
				'address'=>$address,
				'payment_term'=>$payment_term,
				'industry'=>$industry,
				'rfq_range'=>$rfq_range,
				'id'=>$id,
				'user_id'=>$user_id
			];
			/* echo response()->json($vvvv);
		 	echo "<pre>";
			print_r($vvvv); die; */
     	try{
			
			$http = new \GuzzleHttp\Client();
		
			$name    		= 	$request->name;
			$email    		= 	$request->email;
			$phone    		= 	$request->phone;
			$contact_name   = 	$request->contact_name;
			$website    	= 	$request->website;
			$no_of_users    = 	$request->no_of_users;
			$discount    	= 	$request->discount;
			$price    		= 	$request->price;
			$city    		= 	$request->city;
			$state    		= 	$request->state;
			$zip_code    	= 	$request->zip_code;
			$country   	 	= 	$request->country;
			$address 		= 	$request->address;
			$payment_term 	= 	$request->payment_term;
			$industry 		= 	$request->industry;
			$rfq_range 		= 	$request->rfq_range;
			
			if(isset($request->payment_term) && !empty($request->payment_term)){
				$payment_term 	= $request->payment_term;
			}else{
				$payment_term 	= 0;
			}
		
			if(isset($request->id) && !empty($request->id)){
				$id 		= $request->id;
				
				$user_id  =  User::where('company_name',$id)->first();
				$user_id  =  $user_id['id'];
			
			}else{
				$id 		= '';
				$user_id 		= '';
			}
			

			$response = $http->post(''.env('APP_URL').'api/v1/submitaddcompany?',[
				'headers'=>[
					'Authorization'=>'Bearer'.session()->get('token.access_token')
				],
				'query'=>[
					'name'=>$name,
					'email'=>$email,
					'phone'=>$phone,
					'contact_name'=>$contact_name,
					'website'=>$website,
					'no_of_users'=>$no_of_users,
					'discount'=>$discount,
					'price'=>$price,
					'city'=>$city,
					'state'=>$state,
					'zip_code'=>$zip_code,
					'country'=>$country,
					'address'=>$address,
					'payment_term'=>$payment_term,
					'industry'=>$industry,
					'rfq_range'=>$rfq_range,
					'id'=>$id,
					'user_id'=>$user_id
				]
			]);
			$result = json_decode((string)$response->getBody(),true);
			
			if(isset($result['error']) && $result['error']){
				return redirect()->back()->with('error',$result['message']);
			}else{
				return redirect()->back()->with('success',$result['message']);
			}
			
			
        }catch(\Exception $e){
            return redirect()->back()->with('error','Please fill all required fileds.');
        } 
    }


	public function submitaddCompanyUserApi(Request $request)
    { 
		
		$data = User::where('email',$request->email)->get();
        
		if ($data->count()>0) {
			return redirect()->back()->with('error','This email is in use by another user.');			
			
		}else{
			try{

				$http = new \GuzzleHttp\Client();
			
				$name    		= $request->name;
				$email 			= $request->email;
				$phone 			= $request->phone;
				$company_name 	= $request->company_name;
				$role_id 		= $request->role_id;
				if(isset($request->id) && !empty($request->id)){
					$id 			= $request->id;
				}else{
					$id = "";
				}
				
				$response = $http->post(''.env('APP_URL').'api/v1/submitaddcompanyuser?',[
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

	public function submitRfqStatusApi(Request $request)
    { 
		
     	try{

			$http = new \GuzzleHttp\Client();
			$name    		= $request->name;

			$response = $http->post(''.env('APP_URL').'api/v1/submitrfqstatus?',[
				'headers'=>[
					'Authorization'=>'Bearer'.session()->get('token.access_token')
				],
				'query'=>[
					'name'=>$name
				]
			]);
			$result = json_decode((string)$response->getBody(),true);
			
			return redirect()->back()->with('success',$result['message']);
			
        }catch(\Exception $e){
            return redirect()->back()->with('error','Please fill all required fileds.');
        } 
    }


	public function changeRfqStatus($status,$id){
		try{

			$http = new \GuzzleHttp\Client();
			$status    		= $status;
			$id    		= $id;

			$response = $http->post(''.env('APP_URL').'api/v1/changeRfqStatus?',[
				'headers'=>[
					'Authorization'=>'Bearer'.session()->get('token.access_token')
				],
				'query'=>[
					'status'=>$status,
					'id'=>$id
				]
			]);
			$result = json_decode((string)$response->getBody(),true);
			
			return redirect()->back()->with('success1',$result['message']);
			
        }catch(\Exception $e){
            return redirect()->back()->with('error1','Please fill all required fileds.');
        } 
			
	}

	public function deleteByID($model,$id){
		try{

			$http = new \GuzzleHttp\Client();
			$model    		= $model;
			$id    		= $id;

			$response = $http->post(''.env('APP_URL').'api/v1/deleteByID?',[
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

	public function updateByID($model,$id,$name){
		try{

			$http = new \GuzzleHttp\Client();
			$model    		= $model;
			$id    			= $id;
			$name    		= $name;

			$response = $http->post(''.env('APP_URL').'api/v1/updateByID?',[
				'headers'=>[
					'Authorization'=>'Bearer'.session()->get('token.access_token')
				],
				'query'=>[
					'model'=>$model,
					'id'=>$id,
					'name'=>$name
				]
			]);
			$result = json_decode((string)$response->getBody(),true);
			
			return redirect()->back()->with('success1',$result['message']);
			
        }catch(\Exception $e){
            return redirect()->back()->with('error1','Please fill all required fileds.');
        } 
			
	}

	public function companyDetails ($id){
		$http = new \GuzzleHttp\Client();
		$response1 = $http->get(''.env('APP_URL').'api/v1/companydetailsByID/'.$id);
	
		$companydetails = json_decode((string)$response1->getBody(),true);
	//	dd($companydetails); die;


		$data['companydetails'] = $companydetails;
		$data['id'] = $id;

        return view('admin.company_details',$data);
	}
	
	public function getPriceForUserList ($id){
		$price = PriceSetup::where('id',$id)->first();
	
		$data['price'] = $price['price'];
		
        return view('admin.pricefieldhtml',$data);
	}
	

}	
