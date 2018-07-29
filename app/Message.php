<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Message
 *
 * @package App
 * @property string $paper
 * @property string $address
 * @property string $name
 * @property text $body
*/
class Message extends Model
{
    use SoftDeletes;

    
    protected $fillable = ['address', 'name', 'body', 'paper_id'];
    

    public static function boot()
    {
        parent::boot();

        Message::observe(new \App\Observers\UserActionsObserver);
    }

    public static function storeValidation($request)
    {
        return [
            'paper_id' => 'integer|exists:papers,id|max:4294967295|nullable',
            'address' => 'email|max:191|required',
            'name' => 'max:191|required',
            'body' => 'max:65535|required'
        ];
    }

    public static function updateValidation($request)
    {
        return [
            'paper_id' => 'integer|exists:papers,id|max:4294967295|nullable',
            'address' => 'email|max:191|required',
            'name' => 'max:191|required',
            'body' => 'max:65535|required'
        ];
    }

    

    
    
    public function paper()
    {
        return $this->belongsTo(Paper::class, 'paper_id')->withTrashed();
    }
    
    
}
