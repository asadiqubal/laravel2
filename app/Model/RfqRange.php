<?php
namespace App\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class RfqRange extends Authenticatable
{
      use Notifiable;
	const UPDATED_AT = null;


    const Active = 1;
    const Inactive = 2;

    protected $table = 'rfq_ranges';
    
    protected $fillable = ["sequence_letter", "start_from", "end_to", "status"];
	
	
	 
	  
    /**
     * Get the user that owns the phone.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
			
			
    public static function apiSubmitRules($data) {
       
        $error = '';

        if (empty($data['sequence_letter'])) {

            $error = "sequence is required.";

        }else if (empty($data['start_from'])) {

            $error = "start_from is required.";

        }else if (empty($data['end_to'])) {

            $error = "end_to is required.";

        }
		

        return $error;
    }
    
    
}
