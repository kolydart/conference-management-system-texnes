<?php
namespace App;

use App\Session;
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
    
    public function sessions(){
        if(request('show_deleted') == 1)
        	return $this->hasMany(Session::class, 'room_id')->withTrashed();
        else    	
        	return $this->hasMany(Session::class, 'room_id');
    }
    
}
