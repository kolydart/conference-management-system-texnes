<?php
namespace App;

use App\Paper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class Art
 *
 * @package App
 * @property string $title
*/
class Art extends Model
{
	use LogsActivity;
	/** log dirty fillable */
	protected static $logFillable = true;	    
	protected static $logOnlyDirty = true;
    public $table = "arts";

    use SoftDeletes;

    protected $fillable = ['title'];
    protected $hidden = [];
    
    
    public function papers()
    {
        if(request('show_deleted') == 1)
            return $this->belongsToMany(Paper::class, 'art_paper')->withTrashed();
        else
            return $this->belongsToMany(Paper::class, 'art_paper');
    }
    
}
