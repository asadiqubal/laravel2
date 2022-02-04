<?php
namespace App\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class DeliveryTerm extends Authenticatable
{
      use Notifiable;



    const Active = 1;
    const Inactive = 0;

    protected $table = 'delivery_terms';
    
    protected $fillable = ["buyer_id","termcode","description","notes","is_deleted"];
	
	
	 /**
     *
     *  Login rules
     */
	 
	  
	  
			
			
    public static function apiSubmitRules($data) {
       
        $error = '';

        if (empty($data['termcode'])) {

            $error = "Term code is required.";

        }
        if (empty($data['description'])) {

            $error = "Description is required.";

        }
		

        return $error;
    }
    
    
}
