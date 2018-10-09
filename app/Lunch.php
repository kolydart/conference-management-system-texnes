<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Lunch
 *
 * @package App
 * @property string $email
 * @property text $menu
*/
class Lunch extends Model
{
    use SoftDeletes;

    protected $fillable = ['email', 'menu'];
    protected $hidden = [];
    
    
    
}
