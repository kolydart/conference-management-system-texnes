<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 *
 * @package App
 * @property string $title
*/
class Role extends Model
{
    
    protected $fillable = ['title'];
    

    public static function boot()
    {
        parent::boot();

        Role::observe(new \App\Observers\UserActionsObserver);
    }

    public static function storeValidation($request)
    {
        return [
            'title' => 'max:191|nullable',
            'permission' => 'array|nullable',
            'permission.*' => 'integer|exists:permissions,id|max:4294967295|nullable'
        ];
    }

    public static function updateValidation($request)
    {
        return [
            'title' => 'max:191|nullable',
            'permission' => 'array|nullable',
            'permission.*' => 'integer|exists:permissions,id|max:4294967295|nullable'
        ];
    }

    

    
    
    public function permission()
    {
        return $this->belongsToMany(Permission::class, 'permission_role');
    }
    
    
}
