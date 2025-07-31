<?php
namespace App;

use App\Paper;
use App\Session;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;

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
    use HasFactory, \Spatie\Activitylog\Traits\LogsActivity;

    use SoftDeletes;

    protected $fillable = ['title', 'description', 'type', 'wifi', 'capacity'];
    protected $hidden = [];
    
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty();
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
