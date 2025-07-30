<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class ContentCategory
 *
 * @package App
 * @property string $title
 * @property string $slug
*/
class ContentCategory extends Model
{
	use HasFactory, LogsActivity;
	/** log dirty fillable */
	protected static $logFillable = true;	    
	protected static $logOnlyDirty = true;			

    protected $fillable = ['title', 'slug'];
    protected $hidden = [];
    
    
    
}
