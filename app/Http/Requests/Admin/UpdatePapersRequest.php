<?php
namespace App\Http\Requests\Admin;

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
            
            'art' => 'required',
            'art.*' => 'exists:arts,id',
            'email' => 'required|email',
            'assign.*' => 'exists:users,id',
            'status' => 'required',
            'informed' => 'required',
            'order' => 'max:2147483647|nullable|numeric',
            'capacity' => 'max:2147483647|nullable|numeric',
        ];
    }
}
