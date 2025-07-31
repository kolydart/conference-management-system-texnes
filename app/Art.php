<?php
namespace App;

use App\Paper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

/**
 * Class Art
 *
 * @package App
 * @property string $title
*/
class Art extends Model
{
	use HasFactory, LogsActivity;
    public $table = "arts";

    use SoftDeletes;

    protected $fillable = ['title'];
    protected $hidden = [];
    
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty();
    }
    
    
    public function papers()
    {
        if(request('show_deleted') == 1)
            return $this->belongsToMany(Paper::class, 'art_paper')->withTrashed();
        else
            return $this->belongsToMany(Paper::class, 'art_paper');
    }
    
}
