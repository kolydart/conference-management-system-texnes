<?php
namespace App\Http\Requests\Admin;

use App\Judgement;
use Illuminate\Foundation\Http\FormRequest;

class UpdateJudgementsRequest extends FormRequest
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
        return Judgement::updateValidation($this);
    }
}
