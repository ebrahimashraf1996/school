<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ColumnStoreRequest extends FormRequest
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
            'name' => 'required',
            'slug' => 'required',
            'column_degree' => 'required|numeric',
            'description' => 'required',
            'type' => 'required',
            'classId' => 'required',

        ];
    }
    public function messages()
    {
        return [
            'required' => 'هذا الحقل مطلوب',
            'numeric' => 'هذا الحقل يجب ان يكون ارقام',
        ];
    }

}
