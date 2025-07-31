<?php
namespace App;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

/**
 * Class Role
 *
 * @package App
 * @property string $title
*/
class Role extends Model
{
	use HasFactory, LogsActivity;			

    protected $fillable = ['title'];
    protected $hidden = [];
    
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty();
    }
    
    
    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }
    
}
