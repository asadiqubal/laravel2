<?php
namespace App\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class ShipLocation extends Authenticatable
{
      use Notifiable;



    const Active = 1;
    const Inactive = 0;

    protected $table = 'ship_location';
    
    protected $fillable = ["companyname","contactname","st_address","city","state","country","zipcode","buyer_id"];
	
	
	 /**
     *
     *  Login rules
     */
	 
	  
	  
			
			
    public static function apiSubmitRules($data) {
       
        $error = '';

        if (empty($data['companyname'])) {

            $error = "Company name is required.";

        }
        if (empty($data['contactname'])) {

            $error = "Contact name is required.";

        }
		

        return $error;
    }
    
    
}
