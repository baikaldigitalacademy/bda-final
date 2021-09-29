<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SummaryGetAllRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            "name" => "string",
            "email" => "string",
            "position_id" => "integer|min:1",
            "level_id" => "integer|min:1",
            "date_start" => "date",
            "date_end" => "date",
            "status_id" => "integer|min:1"
        ];
    }
}
