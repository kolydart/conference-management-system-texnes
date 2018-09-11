<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Color
 *
 * @package App
 * @property string $title
 * @property string $value
*/
class Color extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'value'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        Color::observe(new \App\Observers\UserActionsObserver);
    }
    
}
