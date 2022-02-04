<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
	
   // protected $redirectTo = 'about'; //RouteServiceProvider::ABOUT;
	
	
	public function redirectTo() {
	  $role = \Auth::user()->role_id; 
	  
	  switch ($role) {
		case '1':
		  return '/admin/dashboard';
		  break;
		case '2':
		  return '/buyer/dashboard';
		  break; 
		case '3':
		  return '/buyer/dashboard';
		  break; 
		case '4':
		  return '/supplier/dashboard';
		  break; 

		default:
		  return '/supplier/dashboard'; 
		break;
	  }
	}

	
	
	
	
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
	
	
	
}
