<?php
namespace App;

use App\Fullpaper;
use App\Message;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

/**
 * Class Paper
 *
 * @package App
 * @property string $title
 * @property string $type
 * @property string $duration
 * @property string $session
 * @property string $name
 * @property string $email
 * @property string $attribute
 * @property string $phone
 * @property text $abstract
 * @property string $status
 * @property string $informed
*/
class Paper extends Model implements HasMedia
{
    use LogsActivity;
    /** log dirty fillable */
    protected static $logFillable = true;       
    protected static $logOnlyDirty = true;          

    use SoftDeletes, HasMediaTrait;

    protected $fillable = ['title', 'type', 'duration', 'name', 'email', 'attribute', 'phone', 'abstract', 'status', 'informed', 'session_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        Paper::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setSessionIdAttribute($input)
    {
        $this->attributes['session_id'] = $input ? $input : null;
    }
    
    public function art()
    {
        if(request('show_deleted') == 1)
            return $this->belongsToMany(Art::class, 'art_paper')->withTrashed();
        else
            return $this->belongsToMany(Art::class, 'art_paper');
    }
    
    public function session()
    {
        if(request('show_deleted') == 1)
            return $this->belongsTo(Session::class, 'session_id')->withTrashed();
        else
            return $this->belongsTo(Session::class, 'session_id');
    }
    
    public function assign()
    {
        return $this->belongsToMany(User::class, 'paper_user');
    }
    
    public function reviews() {
        return $this->hasMany(Review::class, 'paper_id');
    }

    public function messages()
    {
        if(request('show_deleted') == 1)
            return $this->hasMany(Message::class, 'paper_id')->withTrashed();
        else
            return $this->hasMany(Message::class, 'paper_id');
    }


    public function fullpapers(){
        if(request('show_deleted') == 1)
            return $this->hasMany(Fullpaper::class,'paper_id')->withTrashed();
        else
            return $this->hasMany(Fullpaper::class,'paper_id');
        
    }
    

}
