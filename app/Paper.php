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
 * @property string $name
 * @property string $email
 * @property string $attribute
 * @property string $status
 * @property string $informed
*/
class Paper extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    protected $fillable = ['title', 'type', 'duration', 'name', 'email', 'attribute', 'status', 'informed'];
    protected $hidden = [];
    
    
    
    public function art()
    {
        return $this->belongsToMany(Art::class, 'art_paper')->withTrashed();
    }
    
    public function assign()
    {
        return $this->belongsToMany(User::class, 'paper_user');
    }
    
    public function reviews() {
        return $this->hasMany(Review::class, 'paper_id');
    }
}
