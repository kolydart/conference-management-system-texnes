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
 * @property string $type
 * @property string $wifi
 * @property integer $capacity
*/
class Room extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'description', 'type', 'wifi', 'capacity'];
    protected $hidden = [];
    
    

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setCapacityAttribute($input)
    {
        $this->attributes['capacity'] = $input ? $input : null;
    }
    
}
