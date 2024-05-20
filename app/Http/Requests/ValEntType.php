<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValEntType extends FormRequest
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
            'name' => 'required|max:200',
            'state' => 'required',
            'transaction_type_id' => 'required|integer'
        ];
    }

    public function rules_translate()
    {
        return [
            //
            'name' => 'required|max:200'
        ];
    }
}
