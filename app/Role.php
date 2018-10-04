<?php
namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class Role
 *
 * @package App
 * @property string $title
*/
class Role extends Model
{
	use LogsActivity;
	/** log dirty fillable */
	protected static $logFillable = true;	    
	protected static $logOnlyDirty = true;			

    protected $fillable = ['title'];
    protected $hidden = [];
    
    
    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }
    
}
