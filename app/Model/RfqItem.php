<?php
namespace App\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class RfqItem extends Authenticatable
{
      use Notifiable;
	const UPDATED_AT = null;


    const Active = 1;
    const Inactive = 0;

    protected $table = 'rfq_items';
    
    protected $fillable = ["rfq_id", "item_id", "unit", "description", "product_group", "quantity", "delivery_date", "special_instruction", "document", "is_deleted"];
	
	
	 
		
			
    public static function apiSubmitRules($data) {
       
        $error = '';

        if (empty($data['rfq_id'])) {

            $error = "RFQ ID is required.";

        }else if (empty($data['item_id'])) {

            $error = "Item is required.";

        }else if (empty($data['unit'])) {

            $error = "Unit is required.";

        }
		

        return $error;
    }
	
	public function docList(){
		 return $this->hasMany(RfqItemDoc::class);
	}
    
    
}
