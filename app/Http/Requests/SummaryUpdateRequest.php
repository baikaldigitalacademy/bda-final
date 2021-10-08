<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SummaryUpdateRequest extends FormRequest
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
            "name" => "required|string|min:1|max:256",
            "email" => ["required", "email", "min:1", "max:256", Rule::unique('summaries', "email")->ignore($this->id)],
            "date" => "required|date",
            // TODO на сервер приходят теги, но текста нет
            "skills" => "required|string|min:1|max:2000",
            // TODO на сервер приходят теги, но текста нет
            "description" => "required|string|min:1|max:8000",
            // TODO на сервер приходят теги, но текста нет
            "experience" => "required|string|min:1|max:10000",
            "position_id" => "required|integer|min:1|exists:positions,id",
            "level_id" => "nullable|integer|min:1|exists:levels,id",
            "status_id" => "required|integer|min:1|exists:summary_statuses,id"
        ];
    }
}
