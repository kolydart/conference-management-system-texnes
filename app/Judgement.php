<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\FilterByUser;

/**
 * Class Judgement
 *
 * @package App
 * @property string $user
 * @property string $paper
 * @property string $judgement
 * @property text $comment
*/
class Judgement extends Model
{
    use SoftDeletes, FilterByUser;

    
    protected $fillable = ['judgement', 'comment', 'user_id', 'paper_id'];
    

    public static function storeValidation($request)
    {
        return [
            'user_id' => 'integer|exists:users,id|max:4294967295|required',
            'paper_id' => 'integer|exists:papers,id|max:4294967295|required',
            'judgement' => 'in:Approve,Neutral,Reject|max:191|required',
            'comment' => 'max:65535|nullable'
        ];
    }

    public static function updateValidation($request)
    {
        return [
            'user_id' => 'integer|exists:users,id|max:4294967295|required',
            'paper_id' => 'integer|exists:papers,id|max:4294967295|required',
            'judgement' => 'in:Approve,Neutral,Reject|max:191|required',
            'comment' => 'max:65535|nullable'
        ];
    }

    

    
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function paper()
    {
        return $this->belongsTo(Paper::class, 'paper_id')->withTrashed();
    }
    
    
}
