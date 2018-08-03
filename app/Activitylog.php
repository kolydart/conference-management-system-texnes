<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Activitylog
 *
 * @package App
 * @property string $log_name
 * @property string $causer_type
 * @property string $causer
 * @property string $description
 * @property string $subject_type
 * @property integer $subject_id
 * @property text $properties
*/
class Activitylog extends Model
{
    protected $fillable = ['log_name', 'causer_type', 'description', 'subject_type', 'subject_id', 'properties', 'causer_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        Activitylog::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCauserIdAttribute($input)
    {
        $this->attributes['causer_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setSubjectIdAttribute($input)
    {
        $this->attributes['subject_id'] = $input ? $input : null;
    }
    
    public function causer()
    {
        return $this->belongsTo(User::class, 'causer_id');
    }
    
}
