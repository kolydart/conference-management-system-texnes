<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSessionsRequest extends FormRequest
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
            
            'title' => 'required|unique:sessions,title,'.$this->route('session'),
            'room_id' => 'required',
            'start' => 'required|date_format:'.config('app.date_format').' H:i:s',
            'end' => 'nullable|date_format:'.config('app.date_format').' H:i:s',
        ];
    }
}