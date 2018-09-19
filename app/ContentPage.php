<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class ContentPage
 *
 * @package App
 * @property string $title
 * @property string $alias
 * @property text $page_text
 * @property text $excerpt
 * @property string $featured_image
*/
class ContentPage extends Model
{
   use LogsActivity;
    /** log dirty fillable */
   protected static $logFillable = true;       
   protected static $logOnlyDirty = true;          

    protected $fillable = ['title', 'alias', 'page_text', 'excerpt', 'featured_image'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        ContentPage::observe(new \App\Observers\UserActionsObserver);
    }
    
    public function category_id()
    {
        return $this->belongsToMany(ContentCategory::class, 'content_category_content_page');
    }
    
    public function tag_id()
    {
        return $this->belongsToMany(ContentTag::class, 'content_page_content_tag');
    }
    
}
