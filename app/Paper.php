<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
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
 * @property text $bio
 * @property string $status
 * @property string $informed
 * @property integer $order
 * @property integer $capacity
*/
class Paper extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    protected $fillable = ['title', 'type', 'duration', 'name', 'email', 'attribute', 'phone', 'abstract', 'bio', 'status', 'informed', 'order', 'capacity', 'session_id'];
    protected $hidden = [];
    
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setSessionIdAttribute($input)
    {
        $this->attributes['session_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setOrderAttribute($input)
    {
        $this->attributes['order'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setCapacityAttribute($input)
    {
        $this->attributes['capacity'] = $input ? $input : null;
    }
    
    public function art()
    {
        return $this->belongsToMany(Art::class, 'art_paper')->withTrashed();
    }
    
    public function session()
    {
        return $this->belongsTo(Session::class, 'session_id')->withTrashed();
    }
    
    public function assign()
    {
        return $this->belongsToMany(User::class, 'paper_user');
    }
    
}
