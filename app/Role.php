<?php
namespace App;

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
    
    
    public static function boot()
    {
        parent::boot();

        Role::observe(new \App\Observers\UserActionsObserver);
    }
    
}
