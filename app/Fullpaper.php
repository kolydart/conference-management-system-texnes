<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

/**
 * Class Fullpaper
 *
 * @package App
 * @property string $paper
 * @property string $description
*/
class Fullpaper extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    protected $fillable = ['description', 'paper_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        Fullpaper::observe(new \App\Observers\UserActionsObserver);
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
