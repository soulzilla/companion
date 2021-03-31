<?php

namespace App\Modules\Tip\Requests;

use App\Models\Tip;
use Illuminate\Foundation\Http\FormRequest;

class TipRequest extends FormRequest
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
            Tip::COLUMN_NAME => 'required|string',
            'description' => 'required|string',
        ];
    }
}
