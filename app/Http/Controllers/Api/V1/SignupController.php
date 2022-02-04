<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Events\ForgotPassword;
use Illuminate\Support\Str;
use App\User;
use Carbon\Carbon;

class SignupController extends Controller {

    public $successStatus = 200;
    public $errorStatus = 500;
    public $unauthorizedStatus = 401;

    public function __construct() {
        
        $this->successStatus = '200'; //apistatus('success');
        $this->errorStatus = '500'; //apistatus('internalservererror');
        $this->unauthorizedStatus = '401'; //apistatus('unauthorized');   
    }
    /**
    * Register api
    *
    * @return \Illuminate\Http\Response
    */
    public function register(Request $request) {
        
        $input = $request->all();
        $message = User::apiCreateUserRules($input);
        if ($message == '' && !empty($input['sme_number']) && $input['role_id'] == User::SME) {
            $gst_status = $this->_checkValidGSTNumber($input['sme_number']);
            if (!$gst_status) {
                $message = 'Invalid GST Number.';
            }
        }
        if ($message == '') {
            try {
                $request->request->add([
                    'password' => bcrypt($request->get('password')),
                    'status' => User::Inactive
                    ]
                );
                $request['otp'] = $this->generateRandomOtp(6);
                $message = sprintf(___('RegisterPasswordOTPSend'), $request['otp'], getenv('OTP_AUTO_VERIFY_CODE'));
                $request['username'] = $request->get('email');
                $data = User::checkAuthoriseUser($request->all());
                if (is_object($data) && $data->is_phone_verified == null){
                    $this->sendPhoneOTP($message, $data->phone);
                    User::where('email', $data->email)->where('phone', $data->phone)->update(['otp' => $request['otp']]);
                    $success['message'] = ___('Otp_sent');
                    $success['success'] = '';
                    unset($data->otp);
                    $success['data']    =  $data;
                } else if (is_object($data) && $data->is_phone_verified == '1'){
                    $success['error'] = ___('user_already_exist');
                    $success['data'] =  $data;
                } else {
                    $twillo_response = $this->sendPhoneOTP($message, $request->get('phone'));
                    if($twillo_response['status']){
                        $user = User::create($request->all());
                        $success['message'] = ___('User_registration');
                        $success['success'] = '';
                        unset($user->otp);
                        $success['data'] =  $user;
                    } else {
                        $success['error'] = $twillo_response['message'];
                    }
                }  
                return response()->json($success, $this->successStatus);
            } catch (\Exception $e){
                $error['error'] = $e->getMessage();
                return response()->json($error, $this->errorStatus);
            }
        } else {
            $error['error'] = $message;
            return response()->json($error, $this->successStatus);
        }
    }
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request){
		
        $message = User::apiLoginRules($request->all());
        $login_data_array = array();

		$login_data_array['email'] = $request->get('email');
		$login_data_array['password'] = $request->get('password');
         
        if($message == '' && Auth::attempt($login_data_array)){
             User::where('id', Auth::user()->id)
                ->update([
                    'device_type'  =>  $request->get('device_type'),
                    'device_id'    =>  $request->get('device_id')
                    ]);
            $user = Auth::user();
                       
            $success['success'] =  'User_login';
            $success['data'] =  $user;
           // $success['token'] =  $user->createToken('quoteside')->accessToken;

            return response()->json($success, $this->successStatus);
        } else {
            if($message == ''){
                $message = 'username_incorrect';
            }
            $error['error'] = $message;
            return response()->json($error, $this->successStatus);
        }
    }
    /**
    * @method otpVerify
    * @verify otp.
    * 
    */
    public function otpVerify(Request $request){
        $data = $request->all();
        if (isset($data['id']) && !empty($data['id']) && isset($data['otp']) && !empty($data['otp'])) {
            $status = User::otpVerify($data);
            if ($status) {
                $user = User::find($data['id']);
                unset($user->otp);
                $success['success'] = ___('Otp_verified');
                $success['data']    = $user;
                $success['token']   = $user->createToken('LMSWA')->accessToken;
                return response()->json($success, $this->successStatus);
            } else {
                $error['error'] = ___('Otp_expired');
                return response()->json($error, $this->successStatus);
            }
        } else {
            if (empty($data['id'])){
                $error['error'] = ___('userIdRequired');
            }
            if (empty($data['otp'])){
                $error['error'] = ___('otpRequired');
            }
            return response()->json($error, $this->successStatus);
        }
    }
    
    /**
    * @method forgotPassword
    * @send forgot password otp.
    * 
    */
    public function generateRandomOtp($length = 4) {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function forgotPassword(Request $request){

        $data = $request->all();
        $otp = $this->generateRandomOtp(4);
        $user_data  = User::where("status", '1')
                        ->where('email', $data['username'])
                        ->orWhere('phone', $data['username'])
                        ->select("id", "email", "name","phone")
                        ->get();
        if ($user_data->count() > 0) {
            $user_data = $user_data->first();

            $data = event(new ForgotPassword($data['username'], $user_data, $otp));
            
            if($data[0]['status']){
                User::where('id', $user_data->id)->update(["otp" => $otp]);
                $success['success'] = ___('Otp_sent');
                $success['token']   =  $user_data->createToken('LMSWA')->accessToken;
                $success['data']    =  $user_data;
            } else {
                $success['error'] = $data[0]['message'];
            }

            return response()->json($success, $this->successStatus);
        } else {
           $error['error'] = ___('user_not_found');
           return response()->json($error, $this->successStatus);
        }
    }
    /**
    * @method resetPassword
    * @reset password.
    * 
    */
    public function resetPassword(Request $request){

        $data = $request->all();
        $status = User::checkOtpExist($data);
        if (!$status) {
            $error['error'] = ___('Otp_not_exist');
            return response()->json($error, $this->successStatus);
         } 
        $user_data  = User::where("id", $data['id'])
                        ->where('otp', $data['otp'])
                        ->where('updated_at', '>=', Carbon::now()->subMinutes(15)->toDateTimeString())
                        ->select("id", "email", "name")
                        ->get();
        if ($user_data->count() > 0) {
            $user_data = $user_data->first();
            User::where('id', $data["id"])->update(["password" => bcrypt($data["password"]), 'otp' => '']);
            $success['success'] =  ___('Password_reset');
            $success['token']   =  $user_data->createToken('LMSWA')->accessToken;
            return response()->json($success, $this->successStatus);
        } else {
           $error['error'] = ___('Otp_expired');
           return response()->json($error, $this->successStatus);
        }
    
    }
    /**
    * @method reSendOtp
    * @send forgot password otp.
    * 
    */
    public function reSendOtp(Request $request){

        $data = $request->all();
        if(isset($data['otp_length']) && !empty($data['otp_length'])){
            $otp = $this->generateRandomOtp($data['otp_length']);
        } else {
            $otp = $this->generateRandomOtp(6);
        }
        $message = sprintf(___('RegisterPasswordOTPSend'), $otp);
        $user_data  = User::where("id", $data['id'])
                        ->select("id", "email", "name","phone")
                        ->get();
        if ($user_data->count() > 0) {
            $user_data = $user_data->first();
            $twillo_response = $this->sendPhoneOTP($message, $user_data['phone']);      
            if($twillo_response['status']){
                User::where('id', $user_data['id'])->update(["otp" => $otp]);
                $success['success'] = ___('Otp_resent');
                $success['otp']     = $otp;
                $success['data']    = $user_data;
            } else {
                $success['error'] = $twillo_response['message'];
            }
            //event(new ForgotPassword($user_data['email'], $user_data, $otp));

            return response()->json($success, $this->successStatus);
        } else {
           $error['error'] = ___('user_not_found');
           return response()->json($error, $this->successStatus);
        }
    }
    /**
    * @method editProfile
    * @desc user can edit his profile.
    * @return response
    */
    public function editProfile(Request $request){
        if ($request->isMethod("post")) {
            $data = $request->all();
            $check_error = User::apiEditProfileValidation($data);
            if (empty($check_error)) {
               $data = $request->except("_token");
                $user = get_user_info();
                $udpate = $user->update($data);
                if($udpate) {
                    $success['success'] = ___('profile_update');
                    $user = get_user_info();
                    $success['data']    = $user;
                    return response()->json($success, $this->successStatus);
                } else {
                    $error['error'] = ___('profile_not_update');
                    return response()->json($error, $this->successStatus);
                }
            } else {
                $error['error'] = $check_error;
                return response()->json($error, $this->successStatus);
            }
        }
    }
    /**
    * @method changePassword
    * @change password.
    * 
    */
    public function changePassword(Request $request){

        $data        = $request->all();
        $user        = User::getUserDetail($data["id"]);
        $check_error = User::apiChangePasswordValidation($data, $user);

        if (empty($check_error)) {
            $udpate = User::where('id', $data["id"])->update(["password" => bcrypt($data["password"]), 'otp' => '']);
            if($udpate) {
                $success['success'] = ___('password_changed');
                $success['data']    =  $user;
                return response()->json($success, $this->successStatus);
            } else {
                $error['error'] = ___('password_not_changed');
               return response()->json($error, $this->successStatus);
            }
        } else {
            $error['error'] = $check_error;
            return response()->json($error, $this->successStatus);
        }
    
    }
    public function logout(Request $request){
        User::where('id', $request->get('id'))->update(['device_type' => '']);
        Auth::user()->AauthAcessToken()->delete();
        $success['success'] = ___('logout_success');
        return response()->json($success, $this->successStatus);
    }

}
