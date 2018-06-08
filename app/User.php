<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Notifications\ResetPassword;
use Hash;
use Laravel\Passport\HasApiTokens;

/**
 * Class User
 *
 * @package App
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
*/
class User extends Authenticatable
{
    use Notifiable;
    use HasApiTokens;

    
    protected $fillable = ['name', 'email', 'password', 'remember_token'];
    protected $hidden = ['password', 'remember_token'];

    public static function storeValidation($request)
    {
        return [
            'name' => 'max:191|nullable',
            'email' => 'email|max:191|nullable',
            'password' => 'required',
            'role' => 'array|nullable',
            'role.*' => 'integer|exists:roles,id|max:4294967295|nullable',
            'remember_token' => 'max:191|nullable'
        ];
    }

    public static function updateValidation($request)
    {
        return [
            'name' => 'max:191|nullable',
            'email' => 'email|max:191|nullable',
            'password' => '',
            'role' => 'array|nullable',
            'role.*' => 'integer|exists:roles,id|max:4294967295|nullable',
            'remember_token' => 'max:191|nullable'
        ];
    }

    
    
    
    /**
     * Hash password
     * @param $input
     */
    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }
    
    public function role()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }
    
    
    

    public function sendPasswordResetNotification($token)
    {
       $this->notify(new ResetPassword($token));
    }
}
