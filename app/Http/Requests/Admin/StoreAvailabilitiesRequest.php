<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreAvailabilitiesRequest extends FormRequest
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
            'color_id' => 'required',
            'start' => 'required|date_format:'.config('app.date_format').' H:i:s',
            'end' => 'required|date_format:'.config('app.date_format').' H:i:s',
        ];
    }
}
