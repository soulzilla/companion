<?php

namespace App\Modules\Advantage\Requests;

use App\Models\Advantage;
use Illuminate\Foundation\Http\FormRequest;

class AdvantageRequest extends FormRequest
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
            Advantage::COLUMN_NAME => 'required|string',
            'map_id' => 'required|integer',
            'type' => 'required|integer',
            'group_type' => 'nullable|integer',
            'description' => 'nullable|string',
            'video_url' => 'required|string',
        ];
    }
}
