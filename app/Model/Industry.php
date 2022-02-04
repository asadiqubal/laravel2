<?php
namespace App\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Industry extends Authenticatable
{
      use Notifiable;



    const Active = 1;
    const Inactive = 2;

    protected $table = 'industries';
    
    protected $fillable = ["name"];
	
	
	 /**
     *
     *  Login rules
     */
	 
	  
	  
			
			
    public static function apiSubmitRules($data) {
       
        $error = '';

        if (empty($data['name'])) {

            $error = "name is required.";

        }
		

        return $error;
    }
    
    
}
