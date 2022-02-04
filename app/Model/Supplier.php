<?php
namespace App\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Supplier extends Authenticatable
{
      use Notifiable;



    const Active = 1;
    const Inactive = 0;

    protected $table = 'suppliers';
    
    protected $fillable = ["user_id","buyer_id","company_name","company_contact_name","email","street_address","city","state","zipcode","country","supplier_risk_level","is_deleted"];
	
	
	 /**
     *
     *  Login rules
     */
	 
	  
	  
			
			
    public static function apiSubmitRules($data) {
       
        $error = '';

        if (empty($data['company_name'])) {

            $error = "Company name is required.";

        }
        if (empty($data['company_contact_name'])) {

            $error = "Company contact name is required.";

        }
        if (empty($data['email'])) {

            $error = "Email is required.";

        }
		

        return $error;
    }
    
    
}
