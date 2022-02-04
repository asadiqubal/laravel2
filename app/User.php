<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'users';
    
    protected $fillable = [
        'buyer_id','encoded_id','name', 'email', 'password', 'temp_password','phone','company_name','role_id','price','discount','subscription_id','payment_id','payment_status'
    ];
    
   
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this
            ->belongsToMany('App\Role')
            ->withTimestamps();
    }

    public function users()
    {
        return $this
            ->belongsToMany('App\User')
            ->withTimestamps();
    }

    public function authorizeRoles($roles)
    {
      if ($this->hasAnyRole($roles)) {
        return true;
      }
      abort(401, 'This action is unauthorized.');
    }

    public function hasAnyRole($roles)
    {
      if (is_array($roles)) {
        foreach ($roles as $role) {
          if ($this->hasRole($role)) {
            return true;
          }
        }
      } else {
        if ($this->hasRole($roles)) {
          return true;
        }
      }
      return false;
    }

    public function hasRole($role)
    {
      if ($this->roles()->where('name', $role)->first()) {
        return true;
      }
      return false;
    }
	 /**
     *
     *  Login rules
     */
    public static function apiLoginRules($data) {
        
        $error = '';

        if (empty($data['email'])) {

            $error = "Username is required.";

        }else if (empty($data['password'])) {

            $error = "Password is required.";

        }
        if (!empty($data['email']) && !empty($data['password'])) {
            
            if (!self::checkUserExist($data)) {
                $error = "User does not exist.";
            }
            
        }
		

        return $error;
    }
	
	 /**
     * @method checkUserExist
     *  get user data based on email or phone
     *
     */
    public static function checkUserExist($params){
        
        $data = self::where('email',$params['email'])->get();
        
        if ($data->count()>0) {
            return true;
        }else{
            return false;
        }
    }


    public static function apiSubmitRules($data) {
       
      $error = '';

      if (empty($data['name'])) {

          $error = "name is required.";

      }else if (empty($data['email'])) {

          $error = "email is required.";

      }else if (empty($data['phone'])) {

          $error = "phone is required.";

      }
  

      return $error;
  }
}
