<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValTransactionType extends FormRequest
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
            't_name' => 'required|max:255',
            'rt_name' => 'required|max:500',
            'state' => 'required',
            'process_type_id' => 'required|integer',
            'init_proc' => 'required',
            'executer' => 'required|integer',
            'auto_activate' => 'required'
        ];
    }

    public function rules_translate()
    {
        return [
            //
            't_name' => 'required|max:255',
            'rt_name' => 'required|max:500'
        ];
    }
}
