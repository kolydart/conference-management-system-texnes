<?php
namespace App;

use App\Availability;
use App\Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\LogOptions;

/**
 * Class Color
 *
 * @package App
 * @property string $title
 * @property string $value
*/
class Color extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'value'];
    protected $hidden = [];
    
    use \Spatie\Activitylog\Traits\LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty();
    }
    
    public function sessions(){
        if(request('show_deleted') == 1)
            return $this->hasMany(Session::class, 'color_id')->withTrashed();
        else
            return $this->hasMany(Session::class, 'color_id');
    }
    
    
    public function availabilities()
    {
        if(request('show_deleted') == 1)
            return $this->hasMany(Availability::class, 'room_id')->withTrashed();
        else
            return $this->hasMany(Availability::class, 'room_id');
        
    }


}
