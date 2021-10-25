<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRoleRequest extends FormRequest
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
        $unique = "unique:roles,name";

        if( $this->role ){
            $unique .= ",{$this->role->id}";
        }

        return [
            "name" => "$unique|string|min:1"
        ];
    }
}
