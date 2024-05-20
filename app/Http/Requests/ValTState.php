<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValTState extends FormRequest
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
                //
            'language.0.pivot.name' => 'required|max:45'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'language.0.pivot.name.required' => 'Necessário preencher o nome'
        ];
    }
}
