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
 * @property text $body
 * @property string $user
 * @property string $page
 * @property string $paper
*/
class Message extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'email', 'title', 'body', 'user_id', 'page_id', 'paper_id'];
    protected $hidden = [];
    
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setUserIdAttribute($input)
    {
        $this->attributes['user_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setPageIdAttribute($input)
    {
        $this->attributes['page_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setPaperIdAttribute($input)
    {
        $this->attributes['paper_id'] = $input ? $input : null;
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function page()
    {
        return $this->belongsTo(ContentPage::class, 'page_id');
    }
    
    public function paper()
    {
        return $this->belongsTo(Paper::class, 'paper_id')->withTrashed();
    }
    
}
