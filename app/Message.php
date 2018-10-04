<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Message
 *
 * @package App
 * @property string $name
 * @property string $email
 * @property string $title
 * @property string $paper
 * @property text $body
*/
class Message extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'email', 'title', 'body', 'paper_id'];
    protected $hidden = [];
    
    

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
