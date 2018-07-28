<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Art
 *
 * @package App
 * @property string $name
*/
class Art extends Model
{
    use SoftDeletes;

    
    protected $fillable = ['name'];
    

    public static function boot()
    {
        parent::boot();

        Art::observe(new \App\Observers\UserActionsObserver);
    }

    public static function storeValidation($request)
    {
        return [
            'name' => 'max:191|required'
        ];
    }

    public static function updateValidation($request)
    {
        return [
            'name' => 'max:191|required'
        ];
    }

    

    
    
    
}
