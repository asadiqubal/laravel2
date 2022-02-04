<?php
namespace App\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class SupplierQuotesOnRfqItem extends Authenticatable
{
      use Notifiable;



    const Active = 1;
    const Inactive = 0;

    protected $table = 'supplier_quotes_on_rfq_items';
    
    protected $fillable = ["supplier_id","rfq_id","rfq_item_send_id","rfq_items","quotes","status"];
	
	
	
    
}
