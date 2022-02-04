<?php
namespace App\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class State extends Authenticatable
{

    const Active = 1;
    const Inactive = 2;

    protected $table = 'tbl_states';
    
    protected $fillable = ["code","name","country_id"];
	
	
    
}
