<?php
  
namespace App\Imports;
  
use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Auth;
use App\Model\Item;

class itemsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
	
		if(isset($row[1]) && !empty($row[1])){
			
			
			$input['item_number'] 		= $row[0];
			$input['revision_number'] 	= $row[1];
			$input['description'] 		= $row[2];
			$input['unit_measure'] 		= $row[3];
			$input['product_group'] 	= $row[4];
			$input['part_number'] 		= $row[5];
			$input['notes'] 			= $row[6];
			$input['buyer_id'] 			= Auth::user()->id;
			
			
			
			
			return $user = Item::create($input);
			
		}
		
    }
}
