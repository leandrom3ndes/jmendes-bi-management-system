<?php

namespace App\Http\Controllers;

use App\ActionLog;
use App\Entity;
use App\Http\Resources\ActionsDashboardResource;
use App\Http\Resources\EntityResource;
use App\Http\Resources\FormResource;
use App\Http\Resources\PropertyResource;
use App\Http\Resources\TemplateModalResource;
use App\Http\Resources\TemplateToastResource;
use App\Template;
use App\Value;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class ARDashboardController extends Controller
{
    public function getActionsFromActionRule (Request $request, $transaction_type_id, $t_state_id)
    {
        // Get the AR associated with the transaction type and state received
        $action_rule = DB::table('action_rule')
            ->where([
                ['transaction_type_id','=',$transaction_type_id],
                ['t_state_id','=',$t_state_id],
            ])->whereNull('deleted_at')
            ->first();
        // Get the AR id so we can search for its actions
        $action_rule_id = $action_rule->id;
        // Get the Actions associated with the AR
        $actions = DB::table('action')
            ->where('action_rule_id','=',$action_rule_id)->whereNull('deleted_at')
            ->get();

        return ActionsDashboardResource::collection($actions);
    }

    public function getFormFromAction (Request $request, $action_id)
    {
        $langId = $request->user()->language_id;
        $form = DB::table('form')
            ->join('form_content','form.id','=','form_content.form_id')
            ->join('language','form_content.language_id','=','language.id')
            ->select('form.*','form_content.*')
            ->where([
                ['language.id', '=', $langId],
                ['form.action_id', '=', $action_id]
            ])->whereNull('form_content.deleted_at')
            ->get();

        return FormResource::collection($form);
    }

    public function storeFormInput (Request $request) {

        $userId = $request->user()->id;
        $langId = $request->user()->language_id;

        DB::beginTransaction();
        try {
            // Get the array that contains the submitted values from the form
            $input_values = $request->input('submittedValues');
            $transaction_id = $request->input('transactionId');
            // For each property filled in the form
            foreach ($input_values as $input_value) {
                // Get the value inserted by the user
                $valueInput = $input_value[1];
                // So we don't store the value of the submit button or properties that weren't filled
                if ($input_value[0] != "submit" && $valueInput) {
                    // Get the property filled in the form
                    $property_id = $input_value[0];
                    // Check if there's already an entity for the current ent_type_id + transaction combination
                    $entity = DB::table('property')
                        ->join('entity','property.ent_type_id','=','entity.ent_type_id')
                        ->select('entity.id')
                        ->where([
                            ['property.id', '=', $property_id],
                            ['entity.transaction_id', '=', $transaction_id]
                        ])->whereNull('entity.deleted_at')
                        ->first();
                    // Get the entity id if there's already one or, if not, create an entity for the ent_type + transaction combination
                    if ($entity) {
                        $entity_id = $entity->id;
                    } else {
                        $ent_type = DB::table('property')
                            ->select('ent_type_id')
                            ->where('id','=',$property_id)
                            ->whereNull('deleted_at')
                            ->first();
                        $ent_type_id = $ent_type->ent_type_id;

                        $entity = new Entity;
                        $entity->ent_type_id = $ent_type_id;
                        $entity->state = 'active';
                        $entity->transaction_id = $transaction_id;
                        $entity->updated_by = $userId;
                        $entity->save();

                        $entity_id = $entity->id;
                    }

                    // Create an entry in the value table to store the value inserted/chosen by the user
                    $value = new Value;
                    $value->entity_id = $entity_id;
                    $value->property_id = $property_id;
                    $value->value = $valueInput;
                    $value->state = 'active';
                    $value->language_id = $langId;
                    $value->updated_by = $userId;
                    $value->save();
                }
            }
            DB::commit();
            $success = true;
            // all good
        } catch (\Exception $e) {
            $success = false;
            DB::rollback();
            // something went wrong
            header('Content-Type: application/json');
            echo json_encode($e);
        }
        return (string) $success;
    }

    // Get executing action in the AR consulting the action_log table
    public function getExecutingAction (Request $request, $transaction_type_id, $t_state_id, $transaction_id)
    {
        // Get the actions associated to the AR
        $actions = $this->getActionsFromActionRule($request, $transaction_type_id, $t_state_id);

        // Get the actions id
        $action_ids = array();
        foreach ($actions as $action) {
            array_push($action_ids, $action->id);
        }

        // Get the actions that have already been executed
        $action_log_executed = DB::table('action_log')
            ->select('action_log.*')
            ->where([
                ['state', '=', 'executed'],
                ['transaction_id', '=', $transaction_id]
            ])
            ->whereIn('action_id',$action_ids)
            ->whereNull('deleted_at')
            ->get();

        // Save the ids of the executed actions in the action log table
        $action_log_executed_ids = array();
        foreach ($action_log_executed as $action_executed) {
            array_push($action_log_executed_ids, $action_executed->action_id);
        }

        // Check in the action log table if user has actions that haven't been completed
        $action_log_executing = DB::table('action_log')
            ->select('action_log.*')
            ->where([
                ['state', '=', 'executing'],
                ['transaction_id', '=', $transaction_id]
            ])
            ->whereIn('action_id',$action_ids)
            ->whereNotIn('action_id', $action_log_executed_ids)
            ->whereNull('deleted_at')
            ->get();

        // If there is an action in the AR waiting for execution, get its id
        if (isset($action_log_executing[0])) {
            $executing_action_id = $action_log_executing[0]->action_id;
        } else {
            $executing_action_id = -1;
        }

        // If there's an action being executed, get the executing action
        $action = DB::table('action')
            ->where('id','=',$executing_action_id)->whereNull('deleted_at')
            ->get();

        return ActionsDashboardResource::collection($action);
    }

    public function storeActionLog (Request $request) {

        $userId = $request->user()->id;

        // Check if there's already a record for this in the action log table
        // For example, when an action already has a executing record and we're tying to execute it again
        $existing_action_log = DB::table('action_log')
            ->select('action_log.*')
            ->where([
                ['state', '=', $request->input('state')],
                ['action_id', '=', $request->input('action_id')],
                ['transaction_id', '=', $request->input('transaction_id')]
            ])
            ->whereNull('deleted_at')
            ->get();

        $success = true;

        // If there isn't a record in the table, we create one
        if (!isset($existing_action_log[0])) {
            DB::beginTransaction();
            try {
                $action_log = new ActionLog;
                $action_log->state = $request->input('state');
                $action_log->action_id = $request->input('action_id');
                $action_log->transaction_id = $request->input('transaction_id');
                $action_log->updated_by = $userId;
                $action_log->save();

                DB::commit();
                $success = true;
                // all good
            } catch (\Exception $e) {
                $success = false;
                DB::rollback();
                // something went wrong
                header('Content-Type: application/json');
                echo json_encode($e);
            }
        }

        return (string) $success;
    }

    public function getTemplateFromAction (Request $request, $action_id)
    {
        $langId = $request->user()->language_id;
        $template = DB::table('action_has_template')
            ->select('action_has_template.template_id')
            ->where('action_has_template.action_id', '=', $action_id)
            ->whereNull('action_has_template.deleted_at')
            ->get();

        $templateId = $template[0]->template_id;

        // Get the template record on the DB so we can see which type it has
        $template = Template::find($templateId);

        if ($template->type == 'modal') {

            $templateModal = DB::table('template')
                ->join('template_text', 'template.id', '=', 'template_text.template_id')
                ->join('template_modal', 'template.id', '=', 'template_modal.template_id')
                ->join('language', 'language.id', '=', 'template_text.language_id')
                ->select('template.id', 'template.type',
                    'template_text.name', 'template_text.text', 'template_text.language_id',
                    'template_modal.header_text', 'template_modal.button_text', 'template_modal.template_id',
                    'template.updated_by', 'template.deleted_by', 'template.updated_at', 'template.created_at')
                ->where([
                    ['language.id', '=', $langId],
                    ['template.id', '=', $templateId]
                ])
                ->whereNull('template.deleted_at')
                ->get();

            return TemplateModalResource::collection($templateModal);

        } else if ($template->type == 'toast') {

            $templateToast = DB::table('template')
                ->join('template_text', 'template.id', '=', 'template_text.template_id')
                ->join('template_toast', 'template.id', '=', 'template_toast.template_id')
                ->join('language', 'language.id', '=', 'template_text.language_id')
                ->select('template.id', 'template.type',
                    'template_text.name', 'template_text.text', 'template_text.language_id',
                    'template_toast.class', 'template_toast.colour', 'template_toast.title_text', 'template_toast.template_id',
                    'template.updated_by', 'template.deleted_by', 'template.updated_at', 'template.created_at')
                ->where([
                    ['language.id', '=', $langId],
                    ['template.id', '=', $templateId]
                ])
                ->whereNull('template.deleted_at')
                ->get();

            return TemplateToastResource::collection($templateToast);
        }
    }

    public function getModalTemplate (Request $request, $template_id)
    {
        $langId = $request->user()->language_id;
        $templateModal = DB::table('template')
            ->join('template_modal','template.id','=','template_modal.template_id')
            ->join('template_text', 'template.id','=','template_text.template_id')
            ->join('language','template_text.language_id','=','language.id')
            ->select('template.*','template_text.*','template_modal.*')
            ->where([
                ['language.id', '=', $langId],
                ['template.id', '=', $template_id]
            ])->whereNull('template.deleted_at')
            ->get();

        return TemplateModalResource::collection($templateModal);
    }

    public function getToastTemplate (Request $request, $template_id)
    {
        $langId = $request->user()->language_id;
        $templateModal = DB::table('template')
            ->join('template_toast','template.id','=','template_toast.template_id')
            ->join('template_text', 'template.id','=','template_text.template_id')
            ->join('language','template_text.language_id','=','language.id')
            ->select('template.*','template_text.*','template_toast.*')
            ->where([
                ['language.id', '=', $langId],
                ['template.id', '=', $template_id]
            ])->whereNull('template.deleted_at')
            ->get();

        return TemplateToastResource::collection($templateModal);
    }

}

?>

