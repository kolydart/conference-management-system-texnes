<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Room
 *
 * @package App
 * @property string $title
 * @property text $description
*/
class Room extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'description'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        Room::observe(new \App\Observers\UserActionsObserver);
    }
    
}
