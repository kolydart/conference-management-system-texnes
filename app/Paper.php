<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * Class Paper
 *
 * @package App
 * @property string $title
 * @property string $type
 * @property string $duration
 * @property string $name
 * @property string $email
 * @property string $attribute
 * @property string $status
 * @property string $informed
*/
class Paper extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    
    protected $fillable = ['title', 'type', 'duration', 'name', 'email', 'attribute', 'status', 'informed'];
    protected $appends = ['document', 'document_link', 'uploaded_document'];
    protected $with = ['media'];
    

    public static function storeValidation($request)
    {
        return [
            'title' => 'max:191|nullable',
            'art' => 'array|nullable',
            'art.*' => 'integer|exists:arts,id|max:4294967295|nullable',
            'type' => 'in:Εισήγηση,Εργαστήριο: βιωματικές δράσεις,Εργαστήριο: καλές πρακτικές|max:191|nullable',
            'duration' => 'in:20,45,90|max:191|nullable',
            'name' => 'max:191|nullable',
            'email' => 'email|max:191|nullable',
            'attribute' => 'in:Πανεπιστημιακός,Ερευνητής,Μεταπτυχιακός φοιτητής,Εκπαιδευτικός Β/θμιας Εκπ/σης,Εκπαιδευτικός Α/θμιας Εκπ/σης,Καλλιτέχνης,Άλλο|max:191|nullable',
            'document' => 'nullable',
            'document.*' => 'file|nullable',
            'assign' => 'array|nullable',
            'assign.*' => 'integer|exists:users,id|max:4294967295|nullable',
            'status' => 'in:Accepted,Rejected,Pending|max:191|nullable',
            'informed' => 'in: Unaware, Informed|max:191|required'
        ];
    }

    public static function updateValidation($request)
    {
        return [
            'title' => 'max:191|nullable',
            'art' => 'array|nullable',
            'art.*' => 'integer|exists:arts,id|max:4294967295|nullable',
            'type' => 'in:Εισήγηση,Εργαστήριο: βιωματικές δράσεις,Εργαστήριο: καλές πρακτικές|max:191|nullable',
            'duration' => 'in:20,45,90|max:191|nullable',
            'name' => 'max:191|nullable',
            'email' => 'email|max:191|nullable',
            'attribute' => 'in:Πανεπιστημιακός,Ερευνητής,Μεταπτυχιακός φοιτητής,Εκπαιδευτικός Β/θμιας Εκπ/σης,Εκπαιδευτικός Α/θμιας Εκπ/σης,Καλλιτέχνης,Άλλο|max:191|nullable',
            'document' => 'sometimes',
            'document.*' => 'file|nullable',
            'assign' => 'array|nullable',
            'assign.*' => 'integer|exists:users,id|max:4294967295|nullable',
            'status' => 'in:Accepted,Rejected,Pending|max:191|nullable',
            'informed' => 'in: Unaware, Informed|max:191|required'
        ];
    }

    

    public function getDocumentAttribute()
    {
        return [];
    }

    public function getUploadedDocumentAttribute()
    {
        return $this->getMedia('document')->keyBy('id');
    }

    /**
     * @return string
     */
    public function getDocumentLinkAttribute()
    {
        $document = $this->getMedia('document');
        if (! count($document)) {
            return null;
        }
        $html = [];
        foreach ($document as $file) {
            $html[] = '<a href="' . $file->getUrl() . '" target="_blank">' . $file->file_name . '</a>';
        }

        return implode('<br/>', $html);
    }
    
    public function art()
    {
        return $this->belongsToMany(Art::class, 'art_paper')->withTrashed();
    }
    
    public function assign()
    {
        return $this->belongsToMany(User::class, 'paper_user');
    }
    
    
}
