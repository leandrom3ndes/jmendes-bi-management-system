<?php

namespace App\Http\Controllers;

use App\Form;
use App\FormContent;
use App\ActionPropForm;
use DB;
use Illuminate\Http\Request;
use App\Http\Traits\HTTPResponseTrait;
use App\Http\Traits\OutputTypeResponseTrait;

class FormController extends Controller
{
    use HTTPResponseTrait;

    //Função que permite obter os formulários com base na linguagem do utilizador (utilizado na tabela do editor de formulários)
    public function index(Request $request)
    {
        $langId = $request->user()->language_id;

        $forms = DB::table('form')
            ->join('form_content as f_name', 'form.id', '=', 'f_name.form_id')
            ->join('language', 'language.id', '=', 'f_name.language_id')
            ->join('action_name as a_n', 'a_n.language_id', '=', 'language.id')
            ->join('action as act', function($join) {
                $join->on('act.id', '=', 'a_n.action_id');
                $join->on('act.id', '=', 'form.action_id');
            })
            ->join('action_rule', 'act.action_rule_id', '=', 'action_rule.id')
            ->join('transaction_type as tt', 'tt.id', '=', 'action_rule.transaction_type_id')
            ->join('transaction_type_name as ttm', 'ttm.transaction_type_id', '=', 'tt.id')
            ->select('form.id', 'f_name.name', 'a_n.name AS action_name', 'ttm.t_name AS transaction_name', 'form.updated_at', 'form.created_at')
            ->where([['language.id', '=', $langId],['ttm.language_id', '=', $langId]])->whereNull('form.deleted_at')
            ->get();

        return $forms;
    }

    // Função que permite criar um novo formulário
    public function store(Request $request)
    {
        $form = new Form;
        $formContent = new FormContent;

        DB::beginTransaction();
        try {
            $form->action_id = $request->input('action_id');
            $form->updated_by = auth()->user()->id;
            $form->save();

            $formContent->name = $request->input('name');
            $formContent->form_id = $form->id;
            $formContent->json = '{"components": [{"input":true,"label":"Submit","tableView":false,"key":"submit","size":"md","leftIcon":"","rightIcon":"","block":false,"action":"submit","disableOnInvalid":true,"theme":"primary","type":"button"}]}';
            $formContent->language_id = auth()->user()->language_id;
            $formContent->updated_by = auth()->user()->id;
            $formContent->save();

            DB::commit();
            $success = true;
            // all good
        } catch (\Exception $e) {
            $success = false;
            DB::rollback();
            // something went wrong
        }

        if ($success) {
            return $form->id;
        } else {
            return $this->errorResponse(3, isset($e) ? $e->getMessage() . ' | Code Line: ' . $e->getLine() : null);
        }
    }

    // Função que permite obter um dado formulário com base no seu id e na linguagem do utilizador
    public function show($id)
    {
        $forms = DB::table('form')
            ->join('form_content', 'form.id', '=', 'form_content.form_id')
            ->join('language', 'language.id', '=', 'form_content.language_id')
            ->select('form.id', 'form_content.name', 'form.action_id', 'form_content.json')
            ->where([['language.id', '=', auth()->user()->language_id],['form.id', '=', $id]])
            ->get();

        return $forms;
    }

    // Função que permite atualizar um dado formulário
    public function update(Request $request, $id)
    {
        $form = Form::find($id);

        $langId = $request->user()->language_id;
        $userId = $request->user()->id; //caçar o userId

        DB::beginTransaction();
        try {
            $form->update([
                'action_id' => $request->input('action_id'),
                'updated_by' => $userId
            ]);

            $query = ['form_id' => $form->id, 'language_id' => $langId];
            $form_content = FormContent::where($query)->first();

            if ($form_content != null) {
                $form_content = FormContent::where($query);
                $form_content->update([
                    'name' => $request->input('name')
                ]);
                $form_content->update([
                    'updated_by' => $userId
                ]);
            } else {
                $form_content = new FormContent;

                $form_content->form_id = $form->id;
                $form_content->language_id = $langId;
                $form_content->name = $request->input('name');
                $form_content->updated_by = $userId;

                $form_content->save();
            }

            DB::commit();
            $success = true;
            // all good
        } catch (\Exception $e) {
            $success = false;
            DB::rollback();
            // something went wrong
        }

        if (!$success) {
            return $this->errorResponse(3, isset($e) ? $e->getMessage() . ' | Code Line: ' . $e->getLine() : null);
        }
    }

    // Função que elimina um dado formulário com base no id
    public function destroy(Request $request, $id)
    {

        $form = Form::find($id);

        $langId = $request->user()->language_id;
        $userId = $request->user()->id; //caçar o userId

        $query = ['form_id' => $form->id, 'language_id' => $langId];
        $form_content = FormContent::where($query)->first();

        DB::beginTransaction();
        try {
            $form_content->update([
                'deleted_by' => $userId
            ]);
            $form_content->delete();

            $form->update([
                'deleted_by' => $userId
            ]);
            $form->delete();

            DB::commit();
            $success = true;
        } catch (\Exception $e) {
            $success = false;
            DB::rollback();
        }

        if (!$success) {
            return $this->errorResponse(3, isset($e) ? $e->getMessage() . ' | Code Line: ' . $e->getLine() : null);
        }
    }

    // Função que permite obter as propriedades para um dado id de ação
    public function getPropertiesToAction(Request $request, $id){

        $langId = $request->user()->language_id;

        $properties = DB::table('property')
                    ->join('action_prop', 'property.id', '=', 'action_prop.prop_id')
                    ->join('property_name', 'property.id', '=', 'property_name.property_id')
                    ->select('property.id AS property_id', 'property.value_type', 'action_prop.id AS action_prop_id', 'property_name.name AS property_name', 'property_name.form_field_name')
                    ->where([['action_prop.action_id', '=', $id], ['property_name.language_id', '=', $langId]])
                    ->get();

        return $properties;
    }

    // Função que permite obter uma dada propriedade para um id de ação
    public function getPropertyToAction(Request $request, $idAction, $idProperty){

        $langId = $request->user()->language_id;

        $properties = DB::table('property')
                    ->join('action_prop', 'property.id', '=', 'action_prop.prop_id')
                    ->join('property_name', 'property.id', '=', 'property_name.property_id')
                    ->select('property.id AS property_id', 'property.value_type', 'action_prop.id AS action_prop_id', 'property_name.name AS property_name', 'property_name.form_field_name')
                    ->where([['action_prop.action_id', '=', $idAction], ['property_name.language_id', '=', $langId], ['property.id', '=', $idProperty]])
                    ->get();

        return $properties;
    }

    // Função que permite inserir um actionPropForm (utilizado quando um campo é colocado num formulário)
    public function insertActionPropForm(Request $request){

        $alreadyExists = DB::table('action_prop_form')->select('action_prop_form.id')->where([['action_prop_form.form_id', '=', $request->idForm], ['action_prop_form.action_prop_id', '=', $request->idActionProp], ['action_prop_form.lang_id', '=', auth()->user()->language_id]])->get();

        if (sizeof($alreadyExists) == 0){
            $propForm = new ActionPropForm;
            DB::beginTransaction();
            try {
                $propForm->action_prop_id = $request->idActionProp;
                $propForm->form_id = $request->idForm;
                $propForm->lang_id = auth()->user()->language_id;
                $propForm->updated_by = $request->user()->id;
                $propForm->save();

                DB::commit();
                $success = true;
                // all good
            } catch (\Exception $e) {
                $success = false;
                DB::rollback();
                // something went wrong
            }

            if ($success) {
                return $propForm->id;
            } else {
                return $this->errorResponse(3, isset($e) ? $e->getMessage() . ' | Code Line: ' . $e->getLine() : null);
            }
        }else{
            return -1;
        }

    }

    public function insertActionPropFormOtherLang(Request $request){

        $propForm = new ActionPropForm;
        DB::beginTransaction();
        try {
            $propForm->action_prop_id = $request->idActionProp;
            $propForm->form_id = $request->idForm;
            $propForm->lang_id = $request->idLang;
            $propForm->updated_by = $request->user()->id;
            $propForm->save();

            DB::commit();
            $success = true;
            // all good
        } catch (\Exception $e) {
            $success = false;
            DB::rollback();
            // something went wrong
        }

        if ($success) {
            return $propForm->id;
        } else {
            return $this->errorResponse(3, isset($e) ? $e->getMessage() . ' | Code Line: ' . $e->getLine() : null);
        }

    }

    // Função que permite remover um dado actionPropForm (utilizado quando um dado campo é removido do formulário)
    public function destroyActionPropForm(Request $request, $id)
    {
        $actPropForm = ActionPropForm::find($id);
        $userId = $request->user()->id;

        $property = DB::table('action_prop')
                        ->join('action_prop_form', 'action_prop.id', '=', 'action_prop_form.action_prop_id')
                        ->select('action_prop.prop_id')
                        ->where([['action_prop_form.id', '=', $id]])
                        ->get();

        DB::beginTransaction();
        try {
            $actPropForm->update([
                'deleted_by' => $userId
            ]);
            $actPropForm->delete();

            DB::commit();
            $success = true;
        } catch (\Exception $e) {
            $success = false;
            DB::rollback();
        }

        if (!$success) {
            return $this->errorResponse(3, isset($e) ? $e->getMessage() . ' | Code Line: ' . $e->getLine() : null);
        }else{
            return $property;
        }
    }

    // Função que permite dar update ao json de um formulário
    public function updateJSON(Request $request)
    {
        $userId = $request->user()->id; //caçar o userId
        $langId = $request->user()->language_id;

        $query = ['form_id' => $request->input('id'), 'language_id' => $langId];
        $form_content = FormContent::where($query)->first();

        DB::beginTransaction();
        try {
            $form_content->update([
                'updated_by' => $userId,
                'json' => $request->input('json')
            ]);

            DB::commit();
            $success = true;
            // all good
        } catch (\Exception $e) {
            $success = false;
            DB::rollback();
            // something went wrong
        }

        if (!$success) {
            return $this->errorResponse(3, isset($e) ? $e->getMessage() . ' | Code Line: ' . $e->getLine() : null);
        }
    }

    // Função que permite obter o actionPropID através do id do formulário e do id de propriedade
    public function getActionPropIDFromPropID($idForm, $propID){

        $actionPropForm = DB::table('action_prop_form')
                    ->join('action_prop', 'action_prop.id', '=', 'action_prop_form.action_prop_id')
                    ->select('action_prop_form.id AS action_prop_form_id')
                    ->where([['action_prop.prop_id', '=', $propID], ['action_prop_form.form_id', '=', $idForm], ['action_prop_form.lang_id', '=', auth()->user()->language_id]])
                    ->get();

        return $actionPropForm;
    }

    // Função que permite obter o JSON do formulário através do id do mesmo e da linguagem do utilizador
    public function getFormJSON($idForm){

            $JSON = DB::table('form')
                        ->join('form_content', 'form.id', '=', 'form_content.form_id')
                        ->select('form_content.json AS json')
                        ->where([['form.id', '=', $idForm], ['form_content.language_id', '=', auth()->user()->language_id]])
                        ->get();

            return $JSON;
        }

    // Função que permite criar um formulário através da tradução de formulários
    public function createFormOtherLanguage(Request $request)
    {
        $formContent = new FormContent;

        DB::beginTransaction();
        try {
            $formContent->name = $request->input('name');
            $formContent->form_id = $request->input('id');
            $formContent->json = $request->input('json');
            $formContent->language_id = auth()->user()->language_id;
            $formContent->updated_by = auth()->user()->id;
            $formContent->save();

            DB::commit();
            $success = true;
            // all good
        } catch (\Exception $e) {
            $success = false;
            DB::rollback();
            // something went wrong
        }

        if ($success) {
            return $request->input('id');
        } else {
            return $this->errorResponse(3, isset($e) ? $e->getMessage() . ' | Code Line: ' . $e->getLine() : null);
        }
    }

    public function getPropertiesToActionOtherLanguage(Request $request, $id, $langId){

            $properties = DB::table('property')
                        ->join('action_prop', 'property.id', '=', 'action_prop.prop_id')
                        ->join('property_name', 'property.id', '=', 'property_name.property_id')
                        ->select('property.id AS property_id', 'property.value_type', 'action_prop.id AS action_prop_id', 'property_name.name AS property_name', 'property_name.form_field_name')
                        ->where([['action_prop.action_id', '=', $id], ['property_name.language_id', '=', $langId]])
                        ->get();

            return $properties;
        }

    public function getFormAvailableLanguages($formId){

        $languages = DB::table('language')
                    ->select('language.name AS name', 'language.id AS id')
                    ->whereNotIn('id', function($query) use ($formId) {
                            $query->select('form_content.language_id')
                            ->from('form_content')
                            ->where([['form_content.form_id', '=', $formId]]);
                    })->get();

        return $languages;
    }

    // Função que permite obter os formulários que podem ser alvo de tradução (Formulário que existem noutras linguaas que não a lingua do utilizador)
    public function getFormsToTranslate(Request $request)
    {
        $langId = $request->user()->language_id;

        $forms = DB::table('form')
            ->join('form_content as f_name', 'form.id', '=', 'f_name.form_id')
            ->join('language', 'language.id', '=', 'f_name.language_id')
            ->join('action_name as a_n', 'a_n.language_id', '=', 'language.id')
            ->join('action as act', function($join) {
                $join->on('act.id', '=', 'a_n.action_id');
                $join->on('act.id', '=', 'form.action_id');
            })
            ->join('action_rule', 'act.action_rule_id', '=', 'action_rule.id')
            ->join('transaction_type as tt', 'tt.id', '=', 'action_rule.transaction_type_id')
            ->join('transaction_type_name as ttm', 'ttm.transaction_type_id', '=', 'tt.id')
            ->select('form.id', 'language.id as idLanguage', 'f_name.name', 'a_n.name AS action_name', 'ttm.t_name AS transaction_name', 'form.updated_at', 'form.created_at')
            ->where([['ttm.language_id', '=', $langId]])->whereNull('form.deleted_at')
            ->whereNotIn('form.id', function($query) use ($langId) {
                $query->select('form_content.form_id')
                    ->from('form_content')
                    ->where('form_content.language_id', '=', $langId);
            })->get();

        return $forms;
    }

    // Função que permite obter um formulário para tradução através do id de formulário e id de lingua em que ele foi feito.
    public function getFormToTranslate($formId, $langID){
        $forms = DB::table('form')
            ->join('form_content', 'form.id', '=', 'form_content.form_id')
            ->join('language', 'language.id', '=', 'form_content.language_id')
            ->select('form.id', 'form_content.name', 'form.action_id', 'form_content.json')
            ->where([['language.id', '=', $langID],['form.id', '=', $formId]])
            ->get();

        return $forms;
    }

}
