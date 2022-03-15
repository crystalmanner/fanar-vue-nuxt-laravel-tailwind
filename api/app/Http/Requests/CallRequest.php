<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CallRequest extends FormRequest
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
            "email" => ["nullable", "email"],
            "name" => "nullable",
            "code" => "required",
            "mobile" => "required",
            "page" => "required",
            "apartment_id" => [
                "nullable",
                Rule::exists("apartments", 'id')
            ]
        ];
    }
}
