<?php
namespace App\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class UnitMeasures extends Authenticatable
{
      use Notifiable;



    const Active = 1;
    const Inactive = 0;

    protected $table = 'unit_measures';
    
    protected $fillable = ["buyer_id","code","description","is_deleted"];
	
	
	 /**
     *
     *  Login rules
     */
	 
	  
	  
			
			
    public static function apiSubmitRules($data) {
       
        $error = '';

        if (empty($data['code'])) {

            $error = "Code is required.";

        }
        if (empty($data['description'])) {

            $error = "Description is required.";

        }
		

        return $error;
    }
    
    
}
