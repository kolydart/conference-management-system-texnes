<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class Art
 *
 * @package App
 * @property string $title
*/
class Art extends Model
{
	use LogsActivity;
	/** log dirty fillable */
	protected static $logFillable = true;	    
	protected static $logOnlyDirty = true;			

    use SoftDeletes;

    protected $fillable = ['title'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        Art::observe(new \App\Observers\UserActionsObserver);
    }
    
}
