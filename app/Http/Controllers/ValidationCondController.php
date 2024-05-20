<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ValidationCond;
use DB;

class ValidationCondController extends Controller
{
    public function index(Request $request)
    {
        return ValidationCond::all();
    }

    public function store(Request $request)
    {
        $validation_cond = ValidationCond::create($request->all());

    }

    public function show($id)
    {
        return ValidationCond::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $validation_cond_existent = ValidationCond::findOrFail($id);

        $validation_cond_existent->update($request->all());
    }

    public function destroy($id)
    {
        $validation_cond_existent = ValidationCond::findOrFail($id);

        $validation_cond_existent->delete();
    }

    // Função que permite obter as validações para um dado action prop através do seu id e da lingaugem do utilizador
    public function getValidationConditionsFromActionProp(Request $request, $actionPropID){

         $langId = $request->user()->language_id;

        $validation_conditions = DB::table('validation_cond')
                    ->join('validation_cond_has_template', 'validation_cond_has_template.validation_cond_id', '=', 'validation_cond.id')
                    ->join('template', 'validation_cond_has_template.template_id', '=', 'template.id')
                    ->join('template_text', 'template_text.template_id', '=', 'template.id')
                    ->join('language', 'language.id', '=', 'template_text.language_id')
                    ->join('action_prop', 'action_prop.id', '=', 'validation_cond.action_prop_id')
                    ->select('validation_cond.id AS id', 'validation_cond.type AS type', 'validation_cond.action_prop_id AS action_prop_id', 'validation_cond.param_1 AS param_1', 'validation_cond.param_2 AS param_2', 'validation_cond.custom_validation AS custom_validation', 'validation_cond.negative AS neg', 'template_text.text as error_text')
                    ->where([['validation_cond.action_prop_id', '=', $actionPropID], ['language.id', '=', $langId]])
                    ->get();

        return $validation_conditions;
    }

    public function getValidationConditionsFromActionPropOtherLang(Request $request, $actionPropID, $langId){

        $validation_conditions = DB::table('validation_cond')
                    ->join('validation_cond_has_template', 'validation_cond_has_template.validation_cond_id', '=', 'validation_cond.id')
                    ->join('template', 'validation_cond_has_template.template_id', '=', 'template.id')
                    ->join('template_text', 'template_text.template_id', '=', 'template.id')
                    ->join('language', 'language.id', '=', 'template_text.language_id')
                    ->join('action_prop', 'action_prop.id', '=', 'validation_cond.action_prop_id')
                    ->select('validation_cond.id AS id', 'validation_cond.type AS type', 'validation_cond.action_prop_id AS action_prop_id', 'validation_cond.param_1 AS param_1', 'validation_cond.param_2 AS param_2', 'validation_cond.custom_validation AS custom_validation', 'validation_cond.negative AS neg', 'template_text.text as error_text')
                    ->where([['validation_cond.action_prop_id', '=', $actionPropID], ['language.id', '=', $langId]])
                    ->get();

        return $validation_conditions;
    }
}
