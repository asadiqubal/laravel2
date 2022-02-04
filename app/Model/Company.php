<?php
namespace App\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class Company extends Authenticatable
{
      use Notifiable;



    const Active = 1;
    const Inactive = 2;

    protected $table = 'companies';
    
    protected $fillable = ["name","email","phone","address","payment_term","industry","rfq_range","contact_name","website","no_of_users","city","state","zip_code","country"];
	
	
	 /**
     *
     *  Login rules
     */
    public function rfqrange()
    {
        return $this->hasOne(RfqRange::class);
    }

	  
    public static function isAllReadyAssign($data){
        $resulr = DB::table('companies')
        ->where('companies.rfq_range', $data['rfq_range'])
        ->select('companies.*')
        ->get();
      
        if(count($resulr) > 0){
            return "Already Assign this RFQ range";
        }else{
            return "";
        }
    }
			
			
    public static function apiSubmitRules($data) {
       
        $error = '';

        if (empty($data['name'])) {

            $error = "name is required.";

        }
        
        if (empty($data['address'])) {

            $error = "address is required.";

        }
        
        
        
        if (empty($data['industry'])) {

            $error = "industry is required.";

        }
        
        if (empty($data['rfq_range'])) {

            $error = "Rfq range is required.";

        }
		

        return $error;
    }
    
    
}
