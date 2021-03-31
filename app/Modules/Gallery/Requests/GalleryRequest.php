<?php

namespace App\Modules\Gallery\Requests;

use App\Models\Gallery;
use Illuminate\Foundation\Http\FormRequest;

class GalleryRequest extends FormRequest
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
            Gallery::COLUMN_NAME => 'required|string',
            'published' => 'boolean'
        ];
    }
}
