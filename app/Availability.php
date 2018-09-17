<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Availability
 *
 * @package App
 * @property string $color
 * @property string $start
 * @property string $end
 * @property string $room
 * @property text $notes
*/
class Availability extends Model
{
    use SoftDeletes;

    protected $fillable = ['start', 'end', 'notes', 'color_id', 'room_id'];
    protected $hidden = [];

    use \Spatie\Activitylog\Traits\LogsActivity;
    protected static $logFillable = true;       
    protected static $logOnlyDirty = true;    
    
    
    public static function boot()
    {
        parent::boot();

        Availability::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setColorIdAttribute($input)
    {
        $this->attributes['color_id'] = $input ? $input : null;
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
    public function setEndAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['end'] = Carbon::createFromFormat(config('app.date_format') . ' H:i:s', $input)->format('Y-m-d H:i:s');
        } else {
            $this->attributes['end'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getEndAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format') . ' H:i:s');

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $input)->format(config('app.date_format') . ' H:i:s');
        } else {
            return '';
        }
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setRoomIdAttribute($input)
    {
        $this->attributes['room_id'] = $input ? $input : null;
    }
    
    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id')->withTrashed();
    }
    
    public function room()
    {
        if(request('show_deleted') == 1)
            return $this->belongsTo(Room::class, 'room_id')->withTrashed();
        else
            return $this->belongsTo(Room::class, 'room_id');
        
    }
    
}
