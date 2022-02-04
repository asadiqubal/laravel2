<?php
namespace App\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class PriceSetup extends Authenticatable
{
      use Notifiable;



    const Active = 1;
    const Inactive = 0;

    protected $table = 'price_setup';
    
    protected $fillable = ["start_from","end_to","price"];
	
	
	 /**
     *
     *  Login rules
     */
	 
	  
	  
			
			
    public static function apiSubmitRules($data) {
       
        $error = '';

        if (empty($data['start_from'])) {

            $error = "start number is required.";

        }
        if (empty($data['price'])) {

            $error = "price is required.";

        }
		

        return $error;
    }
    
    
}
