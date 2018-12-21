<?php
namespace App;

use App\Fullpaper;
use App\Message;
use App\Subscription;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jedrzej\Searchable\SearchableTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

/**
 * Class Paper
 *
 * @package App
 * @property string $title
 * @property string $type
 * @property string $duration
 * @property string $session
 * @property string $name
 * @property string $email
 * @property string $attribute
 * @property string $phone
 * @property text $abstract
 * @property text $bio
 * @property string $status
 * @property string $informed
 * @property integer $order
 * @property integer $capacity
 * @property text $objectives
 * @property text $materials
 * @property text $description
 * @property text $evaluation
 * @property string $video
 * @property text $bibliography
 * @property tinyInteger $lab_approved
*/
class Paper extends Model implements HasMedia
{
    use LogsActivity;
    /** log dirty fillable */
    protected static $logFillable = true;       
    protected static $logOnlyDirty = true;          

    use SoftDeletes, HasMediaTrait;

    protected $fillable = ['title', 'type', 'duration', 'name', 'email', 'attribute', 'phone', 'abstract', 'bio', 'status', 'informed', 'order', 'capacity', 'objectives', 'materials', 'description', 'evaluation', 'video', 'bibliography', 'lab_approved', 'session_id'];
    protected $hidden = [];
    
    use SearchableTrait;
    public $searchable = ['type'];


    /**
     * Set to null if empty
     * @param $input
     */
    public function setSessionIdAttribute($input)
    {
        $this->attributes['session_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setOrderAttribute($input)
    {
        $this->attributes['order'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setCapacityAttribute($input)
    {
        $this->attributes['capacity'] = $input ? $input : null;
    }
    
    public function art()
    {
        if(request('show_deleted') == 1)
            return $this->belongsToMany(Art::class, 'art_paper')->withTrashed();
        else
            return $this->belongsToMany(Art::class, 'art_paper');
    }
    
    public function session()
    {
        if(request('show_deleted') == 1)
            return $this->belongsTo(Session::class, 'session_id')->withTrashed();
        else
            return $this->belongsTo(Session::class, 'session_id');
    }
    
    public function assign()
    {
        return $this->belongsToMany(User::class, 'paper_user');
    }
    
    public function reviews() {
        return $this->hasMany(Review::class, 'paper_id');
    }

    public function messages()
    {
        if(request('show_deleted') == 1)
            return $this->hasMany(Message::class, 'paper_id')->withTrashed();
        else
            return $this->hasMany(Message::class, 'paper_id');
    }


    public function fullpapers(){
        if(request('show_deleted') == 1)
            return $this->hasMany(Fullpaper::class,'paper_id')->withTrashed();
        else
            return $this->hasMany(Fullpaper::class,'paper_id');
        
    }

    public function scopeOrderByAttribute($query){
        return $query->orderByRaw("FIELD(attribute , 'Μέλος ΔΕΠ','Μέλος ΕΕΠ','Μέλος ΕΔΙΠ','Διδάκτωρ / Ερευνητής','Υποψήφιος Διδάκτωρ','Μεταπτυχιακός/ή Φοιτητής/τρια','Προπτυχιακός/ή Φοιτητής/τρια','Στέλεχος Εκπαίδευσης','Εκπαιδευτικός Πρωτοβάθμιας Εκπαίδευσης','Εκπαιδευτικός Δευτεροβάθμιας Εκπαίδευσης','Καλλιτέχνης') ASC");
    }

    public function scopeAccepted($query){
        return $query->where('status','accepted');
    }
    
    public function attend() {
        return $this->belongsToMany(User::class, 'attend');
    }
    
    public function scopeLab($query){
        return $query->whereRaw('type LIKE "Εργαστήριο%"');
    }
    
    /**
     * max users allowed to attend
     * combine paper's $this->capacity with $room->capacity
     * first, remove any empty values (null,'')
     * @return [type] [description]
     */
    public function capacity(){
        $max_capacity = 50;
        if(!isset($this->session->room->capacity) || (!$this->capacity && !$this->session->room->capacity))
            return $max_capacity;
        return min(array_diff([$this->capacity,$this->session->room->capacity], ["",null]));
    }
    
    /**
     * get free seats
     * @return int > 0
     */
    public function getAvailabilityAttribute() {
        $result = $this->capacity() - $this->attend()->count();
        return  $result > 0 ? $result : 0 ;
    }

}
