<?php
namespace App\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Rfq extends Authenticatable
{
      use Notifiable;
	const UPDATED_AT = null;


    const Active = 1;
    const Inactive = 0;

    protected $table = 'rfqs';
    
    protected $fillable = ["buyer_id","rfq_id", "payment_term", "ship_method", "ship_location", "rfq_response_dead_line","dead_line_time", "set_email_reminder", "date_of_reminder", "is_deleted","status"];
	
	
	 
	
			
    public static function apiSubmitRules($data) {
       
        $error = '';

        if (empty($data['rfq_id'])) {

            $error = "RFQ ID is required.";

        }else if (empty($data['payment_term'])) {

            $error = "payment term is required.";

        }else if (empty($data['ship_method'])) {

            $error = "Ship method is required.";

        }
		

        return $error;
    }
    
    
}
