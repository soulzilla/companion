<?php

namespace App\Modules\Advertisement\Requests;

use App\Models\Advertisement;
use Illuminate\Foundation\Http\FormRequest;

class AdvertisementRequest extends FormRequest
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
            'url' => 'required|string',
            'image' => 'required|string',
            'starts_at' => 'required|string',
            'ends_at' => 'required|string',
            'position' => 'required|integer'
        ];
    }
}
