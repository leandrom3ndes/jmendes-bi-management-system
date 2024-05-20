<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValProcessType extends FormRequest
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
            'name' => 'required|max:128',
            'state' => 'required',
        ];
    }

    public function rules_translate()
    {
        return [
            //
            'name' => 'required|max:128'
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
            'name.required' => 'Necessário preencher o nome',
            'language_id.required'  => trans("validation_with_attributes.required"),
            'state.required'  => 'Necessário preencher o estado',
        ];
    }
}
