<?php

namespace App\Modules\Map\Requests;

use App\Models\Map;
use Illuminate\Foundation\Http\FormRequest;

class MapRequest extends FormRequest
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
            Map::COLUMN_NAME => 'required|string',
            'canonical' => 'required|string',
            'logo' => 'required|string',
            'background_image' => 'required|string',
            'positions_image' => 'required|string',
            'weight' => 'required|integer',
            'practice_map' => 'nullable|string',
            'practice_preview' => 'nullable|string',
        ];
    }
}
