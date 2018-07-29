<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\FilterByUser;

/**
 * Class Judgement
 *
 * @package App
 * @property string $paper
 * @property string $judgement
 * @property text $comment
 * @property string $user
*/
class Judgement extends Model
{
    use SoftDeletes, FilterByUser;

    
    protected $fillable = ['judgement', 'comment', 'paper_id', 'user_id'];
    

    public static function boot()
    {
        parent::boot();

        Judgement::observe(new \App\Observers\UserActionsObserver);
    }

    public static function storeValidation($request)
    {
        return [
            'paper_id' => 'integer|exists:papers,id|max:4294967295|required',
            'judgement' => 'in:Approve,Neutral,Reject|max:191|required',
            'comment' => 'max:65535|nullable',
            'user_id' => 'integer|exists:users,id|max:4294967295|required'
        ];
    }

    public static function updateValidation($request)
    {
        return [
            'paper_id' => 'integer|exists:papers,id|max:4294967295|required',
            'judgement' => 'in:Approve,Neutral,Reject|max:191|required',
            'comment' => 'max:65535|nullable',
            'user_id' => 'integer|exists:users,id|max:4294967295|required'
        ];
    }

    

    
    
    public function paper()
    {
        return $this->belongsTo(Paper::class, 'paper_id')->withTrashed();
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    
}
