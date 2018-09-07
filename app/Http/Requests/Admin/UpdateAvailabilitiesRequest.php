<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAvailabilitiesRequest extends FormRequest
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
            
            'room_id' => 'required',
            'type' => 'required',
            'start' => 'required|date_format:'.config('app.date_format').' H:i:s',
            'end' => 'required|date_format:'.config('app.date_format').' H:i:s',
        ];
    }
}
