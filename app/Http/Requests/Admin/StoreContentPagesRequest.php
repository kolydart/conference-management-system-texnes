<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreContentPagesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'alias' => 'required|unique:content_pages,alias,'.$this->route('content_page'),
            'category_id' => 'required',
            'category_id.*' => 'exists:content_categories,id',
            'featured_image' => 'nullable|mimes:png,jpg,jpeg,gif',
            'tag_id.*' => 'exists:content_tags,id',
        ];
    }
}
