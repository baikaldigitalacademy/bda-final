<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUserRequest extends FormRequest
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
        $uniqueName = "unique:users,name";
        $uniqueLogin = "unique:users,login";

        if( $this->user ){
            $uniqueName .= ",{$this->user->id}";
            $uniqueLogin .= ",{$this->user->id}";
        }

        return [
            "name" => "$uniqueName|string|min:1",
            "login" => "$uniqueLogin|string|min:1",
            "role_id" => "exists:roles,id",
            "password" => "nullable|string|min:3"
        ];
    }
}
