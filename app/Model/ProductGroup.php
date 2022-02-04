<?php
namespace App\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class ProductGroup extends Authenticatable
{
      use Notifiable;



    const Active = 1;
    const Inactive = 0;

    protected $table = 'product_groups';
    
    protected $fillable = ["group_code","description","notes","buyer_id"];
	
	
	 /**
     *
     *  Login rules
     */
	 
	  
	  
			
			
    public static function apiSubmitRules($data) {
       
        $error = '';

        if (empty($data['group_code'])) {

            $error = "Group code is required.";

        }
        if (empty($data['description'])) {

            $error = "Description is required.";

        }
		

        return $error;
    }
    
    
}
