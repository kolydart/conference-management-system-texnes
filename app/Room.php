<?php
namespace App;

use App\Paper;
use App\Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Room
 *
 * @package App
 * @property string $title
 * @property text $description
 * @property string $type
 * @property string $wifi
 * @property integer $capacity
*/
class Room extends Model
{
    use \Spatie\Activitylog\Traits\LogsActivity;
    protected static $logFillable = true;       
    protected static $logOnlyDirty = true;

    use SoftDeletes;

    protected $fillable = ['title', 'description', 'type', 'wifi', 'capacity'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        Room::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setCapacityAttribute($input)
    {
        $this->attributes['capacity'] = $input ? $input : null;
    }
    
    public function sessions(){
        if(request('show_deleted') == 1)
            return $this->hasMany(Session::class, 'room_id')->withTrashed();
        else        
            return $this->hasMany(Session::class, 'room_id');
    }

    public function papers(){
       	return $this->hasManyThrough(Paper::class, Session::class, 'room_id', 'session_id','id','id');
    }
    
}
