<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class Fullpaper
 *
 * @package App
 * @property string $paper
 * @property string $description
 * @property string $uuid
*/
class Fullpaper extends Model implements HasMedia
{
    use HasFactory, LogsActivity;
    /** log dirty fillable */
    protected static $logFillable = true;       
    protected static $logOnlyDirty = true;          

    use SoftDeletes, InteractsWithMedia;

    protected $fillable = ['description', 'paper_id'];
    protected $hidden = [];
    
    /**
     *  Setup model event hooks
     */
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) \Illuminate\Support\Str::uuid();
        });
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
