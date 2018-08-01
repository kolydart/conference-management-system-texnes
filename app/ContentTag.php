<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class ContentTag
 *
 * @package App
 * @property string $title
 * @property string $slug
*/
class ContentTag extends Model
{
	use LogsActivity;
	/** log dirty fillable */
	protected static $logFillable = true;	    
	protected static $logOnlyDirty = true;			

    protected $fillable = ['title', 'slug'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        ContentTag::observe(new \App\Observers\UserActionsObserver);
    }
    
}
