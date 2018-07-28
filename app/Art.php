<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Art
 *
 * @package App
 * @property string $title
*/
class Art extends Model
{
    use SoftDeletes;

    
    protected $fillable = ['title'];
    

    public static function boot()
    {
        parent::boot();

        Art::observe(new \App\Observers\UserActionsObserver);
    }

    public static function storeValidation($request)
    {
        return [
            'title' => 'max:191|nullable'
        ];
    }

    public static function updateValidation($request)
    {
        return [
            'title' => 'max:191|nullable'
        ];
    }

    

    
    
    
}
