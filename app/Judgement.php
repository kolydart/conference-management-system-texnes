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
 * @property string $created_by
*/
class Judgement extends Model
{
    use SoftDeletes, FilterByUser;

    
    protected $fillable = ['judgement', 'comment', 'paper_id', 'created_by_id'];
    

    public static function storeValidation($request)
    {
        return [
            'paper_id' => 'integer|exists:papers,id|max:4294967295|required',
            'judgement' => 'in:Approve,Neutral,Reject|max:191|required',
            'comment' => 'max:65535|nullable',
            'created_by_id' => 'integer|exists:users,id|max:4294967295|nullable'
        ];
    }

    public static function updateValidation($request)
    {
        return [
            'paper_id' => 'integer|exists:papers,id|max:4294967295|required',
            'judgement' => 'in:Approve,Neutral,Reject|max:191|required',
            'comment' => 'max:65535|nullable',
            'created_by_id' => 'integer|exists:users,id|max:4294967295|nullable'
        ];
    }

    

    
    
    public function paper()
    {
        return $this->belongsTo(Paper::class, 'paper_id')->withTrashed();
    }
    
    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
    
    
}
