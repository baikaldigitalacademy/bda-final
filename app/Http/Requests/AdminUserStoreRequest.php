<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUserStoreRequest extends FormRequest
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
        $uniqueLogin = "unique:users,login";

        if( $this->user ){
            $uniqueLogin .= ",{$this->user->id}";
        }

        return [
            "name" => "required|string|min:1",
            "login" => "required|$uniqueLogin|string|min:1",
            "role_id" => "required|int|min:1|exists:roles,id",
            "password" => "required|string|min:8"
        ];
    }
}
