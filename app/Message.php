<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class Message
 *
 * @package App
 * @property string $paper
 * @property string $name
 * @property string $title
 * @property string $email
 * @property text $body
*/
class Message extends Model
{
    use LogsActivity;
    /** log dirty fillable */
    protected static $logFillable = true;       
    protected static $logOnlyDirty = true;          

    use SoftDeletes;

    protected $fillable = ['name', 'title', 'email', 'body', 'paper_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        Message::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setPaperIdAttribute($input)
    {
        $this->attributes['paper_id'] = $input ? $input : null;
    }
    
    public function paper()
    {
        return $this->belongsTo(Paper::class, 'paper_id')->withTrashed();
    }
    
}
