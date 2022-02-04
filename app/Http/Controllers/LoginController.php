<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Auth;
use Session;
use App\User;

class LoginController extends Controller
{
    public function __construct()
    {
       // $this->middleware('auth');
      //  $this->middleware('role:ROLE_ADMIN');
    }

    
	public function login()
    {
		if(Auth::user()){
			 $userId = Auth::user()->id;
			 if(!empty($userId)){
				 return redirect()->route('home');
			 }
		}
        return view('admin.login');
    }
    public function loginApi(Request $request)
    { 
     
		$request->validate([
            'email' =>'required|email',
            'password' =>'required',
        ]);
		

		try{

        $http = new \GuzzleHttp\Client();
	
        $email    = $request->email;
        $password = $request->password;

        $response = $http->post(''.env('APP_URL').'api/v1/login?',[
            'headers'=>[
                'Authorization'=>'Bearer'.session()->get('token.access_token')
            ],
            'query'=>[
                'email'=>$email,
                'password'=>$password
            ]
        ]);
			$result = json_decode((string)$response->getBody(),true);
			//dd($result['data']['role_id']); die;
			Auth::loginUsingId($result['data']['id']);
			
			if($result['data']['role_id'] == 1){
			
				return redirect('admin/dashboard');
			
			}else if($result['data']['role_id'] == 2){
			    
			    return redirect('buyer/dashboard');
			    
				//return redirect()->route('buyer/dashboard');
			}else if($result['data']['role_id'] == 3){
			    return redirect('buyer/dashboard');
			//	return redirect()->route('buyer/dashboard');
			}else{
			    return redirect('supplier/dashboard');
			//	return redirect()->route('supplier/dashboard');
			}
			

        }catch(\Exception $e){
            return redirect()->back()->with('loginerror','Invalid login details. Please try again.');
        } 
    }


    
    public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
    }
	
	
	public function registration($id)
    {
		
		$userData = User::where('encoded_id',$id)->get();
	
		if(empty($userData[0]['email'])){
			return redirect('login')->with('error','Invalid user details.');		
		}
		if(empty($userData[0]['temp_password'])){
			return redirect('buyer/link-expired')->with('error','You have already completed your account setup. Click here to go to login page.');		
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
	}
	
	public function linkExired(){
		return view('buyer.link-exired');
	}
}
