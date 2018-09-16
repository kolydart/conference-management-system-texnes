<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class Subscription
 *
 * @package App
 * @property string $user
 * @property string $paper
 * @property tinyInteger $appeared
*/
class Subscription extends Model
{
    use SoftDeletes;

    protected $fillable = ['appeared', 'user_id', 'paper_id'];
    protected $hidden = [];
    
    use LogsActivity;
    protected static $logFillable = true;       
    protected static $logOnlyDirty = true;

    public static function boot()
    {
        parent::boot();

        Subscription::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setUserIdAttribute($input)
    {
        $this->attributes['user_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setPaperIdAttribute($input)
    {
        $this->attributes['paper_id'] = $input ? $input : null;
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function paper()
    {
        return $this->belongsTo(Paper::class, 'paper_id')->withTrashed();
    }
    
}
