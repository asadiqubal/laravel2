<?php
  
namespace App\Imports;
  
use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Auth;
use App\Model\Supplier;

class SuppliersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
	
		if(isset($row[1]) && !empty($row[1])){
			
			
			$userData['name']           = $row[0];
			$userData['email']          = $row[1];
			$userData['phone']          = $row[2];
			$userData['role_id']        = '4';

				
			if($userData['role_id'] =='4'){
			  $userData['temp_password']  = '123456';
			  
			}
		   
			$insertedId = $id 	= 	User::create($userData)->id;
			if($userData['role_id'] =='4'){
				$saveData2['encoded_id']  = base64_encode($id);
				
				$user = User::where('id', $id)
				->update($saveData2);
			}
			
			
			
			$input['user_id'] = $insertedId;
			 
			
			$input['company_name'] 				= $row[0];
			$input['email'] 					= $row[1];
			$input['company_contact_name'] 		= $row[3];
			$input['street_address'] 			= $row[4];
			$input['city'] 						= $row[5];
			$input['state'] 					= $row[6];
			$input['zipcode'] 					= $row[8];
			$input['country'] 					= $row[7];
			$input['supplier_risk_level'] 		= $row[9];
			$input['user_id'] 					= $insertedId;
			$input['buyer_id'] 					= Auth::user()->id;
			
			
			
			
			return $user = Supplier::create($input);
			
			
				 /* echo "<pre>";
			print_r($saveUser); die; */
			//return  User::create($saveUser);
		}
		
    }
}
