<?php

namespace App\Modules\Training\Requests;

use App\Models\Training;
use Illuminate\Foundation\Http\FormRequest;

class TrainingRequest extends FormRequest
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
            Training::COLUMN_NAME => 'required|string',
            'workshop_url' => 'required|string',
            'weight' => 'required|integer'
        ];
    }
}
