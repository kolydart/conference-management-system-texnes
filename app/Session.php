<?php
namespace App;

use App\Paper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Session
 *
 * @package App
 * @property string $title
 * @property string $room
 * @property string $start
 * @property time $duration
 * @property string $chair
*/
class Session extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'start', 'duration', 'chair', 'room_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        Session::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setRoomIdAttribute($input)
    {
        $this->attributes['room_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setStartAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['start'] = Carbon::createFromFormat(config('app.date_format') . ' H:i:s', $input)->format('Y-m-d H:i:s');
        } else {
            $this->attributes['start'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getStartAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format') . ' H:i:s');

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $input)->format(config('app.date_format') . ' H:i:s');
        } else {
            return '';
        }
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setDurationAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['duration'] = Carbon::createFromFormat('H:i:s', $input)->format('H:i:s');
        } else {
            $this->attributes['duration'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getDurationAttribute($input)
    {
        if ($input != null && $input != '') {
            return Carbon::createFromFormat('H:i:s', $input)->format('H:i:s');
        } else {
            return '';
        }
    }
    
    public function room()
    {
        if(request('show_deleted') == 1)
            return $this->belongsTo(Room::class, 'room_id')->withTrashed();
        else
            return $this->belongsTo(Room::class, 'room_id');
    }

    public function papers(){
        if(request('show_deleted') == 1)
            return $this->hasMany(Paper::class, 'session_id')->withTrashed();
        else        
            return $this->hasMany(Paper::class, 'session_id');
    }
    
}
