<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePapersRequest extends FormRequest
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
            'title' => 'required|max:512',
            'duration' => 'required|max:256',
            'abstract' => 'required',
            'age' => 'required|max:256',
            'capacity' => 'max:2147483647|nullable|numeric',
            'objectives' => 'required',
            'materials' => 'required',
            'description' => 'required|max:6000',
            'evaluation' => 'required',
            'keywords' => 'required|max:256',
            'video' => 'url',
            'images' => 'image',
        ];

    }
}
