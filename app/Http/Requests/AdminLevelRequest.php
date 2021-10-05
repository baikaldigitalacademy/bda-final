<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminLevelRequest extends FormRequest
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
        $unique = "unique:levels,name";

        if( $this->level ){
            $unique .= ",{$this->level->id}";
        }

        return [
            "name" => "$unique|string|min:1"
        ];
    }
}
