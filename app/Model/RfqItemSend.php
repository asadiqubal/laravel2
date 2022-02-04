<?php
namespace App\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class RfqItemSend extends Authenticatable
{
      use Notifiable;



    const Active = 1;
    const Inactive = 0;

    protected $table = 'rfq_item_send';
    
    protected $fillable = ["buyer_id","rfq_id","supplier_id","rfq_items","is_revise","status"];
	
    
}
