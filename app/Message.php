<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Message
 *
 * @package App
 * @property string $paper
 * @property string $name
 * @property string $title
 * @property string $email
 * @property text $body
*/
class Message extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'title', 'email', 'body', 'paper_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        Message::observe(new \App\Observers\UserActionsObserver);
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
