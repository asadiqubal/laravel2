<?php
namespace App\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class RfqItemDoc extends Authenticatable
{
      use Notifiable;
	const UPDATED_AT = null;


    const Active = 1;
    const Inactive = 0;

    protected $table = 'rfq_item_documents';
    
    protected $fillable = ["rfq_items_id", "document"];
	
	
	 
		
	
	
    
}
