<?php

namespace App\Modules\Command\Requests;

use App\Models\Command;
use Illuminate\Foundation\Http\FormRequest;

class CommandRequest extends FormRequest
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
            Command::COLUMN_NAME => 'required|string',
            'description' => 'required|string',
            'bindable' => 'boolean',
            'weight' => 'integer'
        ];
    }
}
