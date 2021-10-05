<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminSummaryStatusRequest extends FormRequest
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
        $unique = "unique:summary_statuses,name";

        if( $this->summary_status ){
            $unique .= ",{$this->summary_status->id}";
        }

        return [
            "name" => "$unique|string|min:1"
        ];
    }
}
