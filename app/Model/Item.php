<?php
namespace App\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Item extends Authenticatable
{
      use Notifiable;



    const Active = 1;
    const Inactive = 0;

    protected $table = 'items';
    
    protected $fillable = ["buyer_id","item_number","revision_number","description","unit_measure","product_group","part_number","notes","is_deleted"];
	
	
	 /**
     *
     *  Login rules
     */
	 
	  
	  
			
			
    public static function apiSubmitRules($data) {
       
        $error = '';

        if (empty($data['item_number'])) {

            $error = "Item number is required.";

        }
        if (empty($data['revision_number'])) {

            $error = "Revision number is required.";

        }
        if (empty($data['description'])) {

            $error = "Description is required.";

        }
		

        return $error;
    }
    
    
}
