<?php
namespace App;

use App\Paper;
use App\Review;
use Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class User
 *
 * @package App
 * @property string $name
 * @property string $email
 * @property string $checkin
 * @property string $phone
 * @property string $attribute
 * @property string $password
 * @property string $role
 * @property string $remember_token
 * @property tinyInteger $approved
*/
class User extends Authenticatable
{
    use LogsActivity;
    /** log dirty fillable */
    protected static $logFillable = true;       
    protected static $logOnlyDirty = true;          

    use Notifiable;
    protected $fillable = ['name', 'email', 'checkin', 'phone', 'attribute', 'password', 'remember_token', 'approved', 'role_id'];
    protected $hidden = ['password', 'remember_token'];
    
    
    
    /**
     * Hash password
     * @param $input
     */
    public function setPasswordAttribute($input)
    {
        if ($input)
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
    }
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setRoleIdAttribute($input)
    {
        $this->attributes['role_id'] = $input ? $input : null;
    }
    
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
    

    public function sendPasswordResetNotification($token)
    {
       $this->notify(new ResetPassword($token));
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'user_id');
    }

    public function assign()
    {
        return $this->belongsToMany(Paper::class, 'paper_user');
    }

    public function attend() {
        return $this->belongsToMany(Paper::class, 'attend');
    }
    
    public function scopeAttendees($query){
        return $query->where('role_id',7);
    }
}
