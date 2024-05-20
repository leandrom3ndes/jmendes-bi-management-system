<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

use App\Http\Resources\QueryParameterResource;
use App\Http\Resources\TemplateResource;
use App\Http\Resources\UserEvaluatedExpressionResource;
use App\Http\Resources\TransactionTypeResource;
use App\Http\Resources\TransactionStateResource;
use App\Http\Resources\PropertyResource;
use App\Http\Resources\PropertyValueResource;
use App\Http\Resources\ValueResource;
use App\Http\Resources\EntTypeResource;
use App\Http\Resources\QueryResource;
use App\Http\Resources\ConstantResource;
use App\Http\Resources\ActionRuleResource;

use App\ActionRule;
use App\Action;
use App\ActionHasTemplate;
use App\ActionName;
use App\ActionProp;
use App\Condition;
use App\ConditionHasUserEvaluatedExpression;
use App\FormCompute;
use App\CausalLink;
use App\CompEvaluatedExpression;
use App\QueryHasTerm;
use App\Template;
use App\TemplateModal;
use App\TemplateText;
use App\TemplateToast;
use App\Term;
use App\AssignExpression;
use App\ComputeExpression;
use App\ComputeExpressionHasTerm;
use App\Constant;
use App\ConstantName;
use App\TermHasComputeExpression;
use App\TermHasConstant;
use App\TermHasPropAllowedValue;
use App\TermHasProperty;
use App\TermHasPropRefValue;
use App\TermHasQuery;
use App\TermHasValue;
use App\UserEvaluatedExpression;
use App\UserEvaluatedExpressionText;
use App\ValidationCond;
use App\ValidationCondHasTemplate;

class BlocklyController extends Controller
{
    public function getTransactionTypes(Request $request)
    {
        $langId = $request->user()->language_id;
        $transactionTypes = DB::table('transaction_type')
            ->join('transaction_type_name', 'transaction_type.id', '=', 'transaction_type_name.transaction_type_id')
            ->join('language', 'transaction_type_name.language_id', '=', 'language.id')
            ->select('transaction_type_name.*', 'transaction_type.*')
            ->where('language.id', '=', $langId)->whereNull('transaction_type.deleted_at')
            ->get();

        return TransactionTypeResource::collection($transactionTypes);
    }

    public function getTransactionStates(Request $request)
    {
        $langId = $request->user()->language_id;
        $transactionStates = DB::table('t_state')
            ->join('t_state_name','t_state.id','=','t_state_name.t_state_id')
            ->join('language','t_state_name.language_id','=','language.id')
            ->select('t_state.*','t_state_name.*')
            ->where('language.id','=',$langId)->whereNull('t_state.deleted_at')
            ->get();

        return TransactionStateResource::collection($transactionStates);
    }

    public function getPropertiesFromEntType(Request $request, $entType)
    {
        $langId = $request->user()->language_id;
        $properties = DB::table('property')
            ->join('property_name','property.id','=','property_name.property_id')
            ->join('language','property_name.language_id','=','language.id')
            ->select('property.*','property_name.*')
            ->where([
                ['language.id','=',$langId],
                ['property.ent_type_id','=',$entType],
                ])->whereNull('property.deleted_at')
            ->get();

        return PropertyResource::collection($properties);
    }

    public function getProperty(Request $request, $propertyId)
    {
        $langId = $request->user()->language_id;
        $property = DB::table('property')
            ->join('property_name','property.id','=','property_name.property_id')
            ->join('language','property_name.language_id','=','language.id')
            ->select('property.*','property_name.*')
            ->where([
                ['language.id','=',$langId],
                ['property.id','=',$propertyId],
            ])->whereNull('property.deleted_at')
            ->get();

        return PropertyResource::collection($property);
    }

    public function getPropertyValues(Request $request, $property)
    {
        $langId = $request->user()->language_id;
        $properties = DB::table('prop_allowed_value')
            ->join('prop_allowed_value_name','prop_allowed_value.id','=','prop_allowed_value_name.p_a_v_id')
            ->join('language','prop_allowed_value_name.language_id','=','language.id')
            ->select('prop_allowed_value.*','prop_allowed_value_name.*')
            ->where([
                ['language.id','=',$langId],
                ['prop_allowed_value.property_id','=',$property],
                ])->whereNull('prop_allowed_value.deleted_at')
            ->get();

        return PropertyValueResource::collection($properties);
    }

    public function getFkPropertyValues(Request $request, $FkPropertyId)
    {
        $langId = $request->user()->language_id;
        $propertyValues = DB::table('value')
            ->select('value.*')
            ->where([
                ['property_id','=',$FkPropertyId],
                ['language_id','=',$langId]
            ])
            ->whereNull('deleted_at')
            ->get();

        return ValueResource::collection($propertyValues);
    }

    public function getEntTypes(Request $request)
    {
        $langId = $request->user()->language_id;
        $entTypes = DB::table('ent_type')
            ->join('ent_type_name','ent_type.id','=','ent_type_name.ent_type_id')
            ->join('language','ent_type_name.language_id','=','language.id')
            ->select('ent_type.*','ent_type_name.*')
            ->where('language.id','=',$langId)->whereNull('ent_type.deleted_at')
            ->get();

        return EntTypeResource::collection($entTypes);
    }

    public function getTemplates(Request $request)
    {
        $langId = $request->user()->language_id;
        $templates = DB::table('template')
            ->join('template_text','template.id','=','template_text.template_id')
            ->join('language','template_text.language_id','=','language.id')
            ->select('template.*', 'template_text.*')
            ->where('language.id','=',$langId)->whereNull('template.deleted_at')
            ->get();

        return TemplateResource::collection($templates);
    }

    public function getUserEvaluatedExpressions(Request $request)
    {
        $langId = $request->user()->language_id;
        $userEvaluatedExpressions = DB::table('user_evaluated_expression')
            ->join('user_evaluated_expression_text','user_evaluated_expression.id','=','user_evaluated_expression_text.user_evaluated_expression_id')
            ->join('language','user_evaluated_expression_text.language_id','=','language.id')
            ->select('user_evaluated_expression.*', 'user_evaluated_expression_text.*')
            ->where('language.id','=',$langId)->whereNull('user_evaluated_expression.deleted_at')
            ->get();

        return UserEvaluatedExpressionResource::collection($userEvaluatedExpressions);
    }

    public function getQueries(Request $request)
    {
        $langId = $request->user()->language_id;
        $queries = DB::table('query')
            ->join('query_name','query.id','=','query_name.query_id')
            ->join('language','query_name.language_id','=','language.id')
            ->select('query_name.*')
            ->where('language.id','=',$langId)->whereNull('query.deleted_at')
            ->get();

        return QueryResource::collection($queries);
    }

    public function getConstants(Request $request)
    {
        $langId = $request->user()->language_id;
        $constants = DB::table('constant')
            ->join('constant_name','constant.id','=','constant_name.constant_id')
            ->join('language','constant_name.language_id','=','language.id')
            ->select('constant.*','constant_name.*')
            ->where('language.id','=',$langId)->whereNull('constant.deleted_at')
            ->get();

        return ConstantResource::collection($constants);
    }

    public function getActionRules(Request $request)
    {
        $langId = $request->user()->language_id;
        $actionRules = DB::table('action_rule')
            ->join('transaction_type_name','action_rule.transaction_type_id','=','transaction_type_name.transaction_type_id')
            ->join('t_state_name','action_rule.t_state_id','=','t_state_name.t_state_id')
            ->select('action_rule.*','t_state_name.*','transaction_type_name.*')
            ->where([
                ['t_state_name.language_id','=',$langId],
                ['transaction_type_name.language_id','=',$langId],
            ])->whereNotNull('action_rule.blockly_xml')
            ->get();

        return ActionRuleResource::collection($actionRules);
    }

    public function getQueryParameters(Request $request, $queryID)
    {
        $langId = $request->user()->language_id;
        $parameters = DB::table('query')
            ->join('query_has_parameter','query.id','=','query_has_parameter.query_id')
            ->join('property','property.id','=','query_has_parameter.property_id')
            ->join('property_name','property_name.property_id','=','query_has_parameter.property_id')
            ->join('ent_type_name','ent_type_name.ent_type_id','=','property.ent_type_id')
            ->join('language', function($join) {
                $join->on('language.id', '=', 'property_name.language_id');
                $join->on('language.id', '=', 'ent_type_name.language_id');
            })
            ->select('query.id',
                'query_has_parameter.property_id',
                'property_name.name AS property_name',
                'property.ent_type_id AS ent_type_id',
                'ent_type_name.name AS ent_type_name',
                'language.id AS language_id'
            )
            ->where([
                ['query.id','=',$queryID],
                ['language.id','=',$langId]
            ])
            ->get();

        return QueryParameterResource::collection($parameters);
    }

    public function getProperties(Request $request)
    {
        $langId = $request->user()->language_id;
        $properties = DB::table('property')
            ->join('property_name','property_name.property_id','=','property.id')
            ->join('language','property_name.language_id','=','language.id')
            ->select('property.*','property_name.*')
            ->where('language.id','=',$langId)->whereNull('property.deleted_at')
            ->get();

        return PropertyResource::collection($properties);
    }

    public function getAllFkPropertyValues(Request $request)
    {
        $langId = $request->user()->language_id;
        $values = DB::table('value')
            ->select('value.*')
            ->where('language_id','=',$langId)
            ->whereNull('deleted_at')
            ->get();

        return ValueResource::collection($values);
    }

    public function getPropAllowedValues(Request $request)
    {
        $langId = $request->user()->language_id;
        $propAllowedValues = DB::table('prop_allowed_value')
            ->join('prop_allowed_value_name','prop_allowed_value_name.p_a_v_id','=','prop_allowed_value.id')
            ->join('language','prop_allowed_value_name.language_id','=','language.id')
            ->select('prop_allowed_value_name.*','prop_allowed_value.*')
            ->where('language.id','=',$langId)->whereNull('prop_allowed_value.deleted_at')
            ->get();

        return PropertyValueResource::collection($propAllowedValues);
    }

    public function storeActionRule(Request $request)
    {

        // Get user id and language
        $langId = $request->user()->language_id;
        $userId = $request->user()->id;

        DB::beginTransaction();
        try {
            $blockly_XML = $request->input('blockly_xml');
            // Action Rule to be stored in the action ruled table
            $action_rule = new ActionRule;
            $action_rule->t_state_id = $request->input('t_state_id');
            $action_rule->transaction_type_id = $request->input('transaction_type_id');
            $action_rule->blockly_code = $request->input('blockly_code');
            $action_rule->preview = $request->input('preview');

            $action_rule->updated_by = $userId;
            $action_rule->save();

            // Action rule id to be used in the actions
            $action_rule_id = $action_rule->id;
            $actions = $request->input('actions');

            $blockly_XML = $this->storeActions ($blockly_XML, $actions, $action_rule_id, null, $userId, $langId);

            $action_rule->blockly_xml = $blockly_XML;
            $action_rule->save();

            DB::commit();
            $success = 'true';
            // all good
        } catch (\Exception $e) {
            $success = 'false';
            DB::rollback();
        }
        return $success;
    }

    public function storeActions ($blockly_XML, $actions, $action_rule_id, $par_action_id, $userId, $langId) {

        // Saving the previous action, we can establish its next_action_id from the current action.
        // We can also set the current action's previous_action_id from it.
        $previous_action = null;

        foreach ($actions as $input_action) {

                $action = new Action;
                $action->action_rule_id = $action_rule_id;
                $action->type = $input_action["type"];
                if ($par_action_id) {
                    $action->par_action_id = $par_action_id;
                }
                if ($previous_action) {
                    $action->prev_action_id = $previous_action->id;
                }
                $action->updated_by = $userId;
                $action->save();

                if ($previous_action) {
                    $previous_action->next_action_id = $action->id;
                    $previous_action->save();
                }

                // Save the current action as the next iteration's previous_action
                $previous_action = $action;

            // In case action is of type causal link
            if ($action->type == 'causal_link'){

                // Create an entry in the causal link table
                $causal_link = new CausalLink;
                $causal_link->causing_action = $action->id;

                // If transaction type and state already exist in an action rule, we get its id
                $caused_action_transaction_type_id = $input_action["caused_action_trans_type_id"];
                $caused_action_transaction_state_id = $input_action["caused_action_t_state_id"];

                $existing_caused_action = DB::table('action_rule')
                    ->select('*')
                    ->where([
                        ['transaction_type_id','=',$caused_action_transaction_type_id],
                        ['t_state_id','=',$caused_action_transaction_state_id],
                    ])->whereNull('deleted_at')
                    ->first();

                if ($existing_caused_action) {
                    $caused_action_rule_id = $existing_caused_action->id;
                } else {
                    // If the action rule is non existent, we create it
                    $caused_action_rule = new ActionRule;
                    $caused_action_rule->t_state_id = $caused_action_transaction_state_id;
                    $caused_action_rule->transaction_type_id = $caused_action_transaction_type_id;

                    $caused_action_rule->updated_by = $userId;
                    $caused_action_rule->save();

                    $caused_action_rule_id = $caused_action_rule->id;
                }

                // Fill the last fields of the casual link record and save it in the DB
                $causal_link->caused_action_rule = $caused_action_rule_id;
                $causal_link->min = $input_action["min"];
                $causal_link->max = $input_action["max"];
                $causal_link->updated_by = $userId;
                $causal_link->save();

                // In case action if of type assign expression
            }  else if($action->type == 'assign_expression') {

                // Term which will be associated with the respective input
                $term = new Term;
                $term->updated_by = $userId;
                $term->save();

                // Get the id of the property that is on the left of the block
                $left_property_id = $input_action["left_property"]["id"];

                // Get the id of the term inserted in the DB
                $term_id = $term->id;

                // Check what type of term/property_value we have on the right input of the block
                $has_constant_term = isset($input_action["constant_term"]);
                $has_property_value = isset($input_action["property_value_term"]);
                $has_property_term = isset($input_action["property_term"]);
                $has_query_term = isset($input_action["query_term"]);
                $has_value_term = isset($input_action["value_term"]);
                $has_compute_expression_term = isset($input_action["compute_expression_term"]);

                // Store the term that we have in the right side of block in the DB respective tables
                if ($has_constant_term) {
                    $blockly_XML = $this->storeConstantTerm($blockly_XML, $input_action["constant_term"], $term_id, $userId, $langId);
                }
                else if ($has_property_value) {
                    $this->storePropertyValueTerm($input_action["property_value_term"], $term_id, $userId);
                }
                else if ($has_property_term) {
                    $this->storePropertyTerm($input_action["property_term"], $term_id, $userId);
                }
                else if ($has_query_term) {
                    $blockly_XML = $this->storeQueryTerm($blockly_XML, $input_action["query_term"], $term_id, $userId, $langId);
                }
                else if ($has_value_term) {
                    $this->storeValueTerm($input_action["value_term"], $term_id, $userId);
                }
                else if($has_compute_expression_term) {
                    $blockly_XML = $this->storeComputeExpressionTerm($blockly_XML, $input_action["compute_expression_term"], $term_id, $userId, $langId);
                }

                // Create a record in the assign_expression table in the DB
                $assign_expression = new AssignExpression;
                $assign_expression->property_id = $left_property_id;
                $assign_expression->term_id = $term_id;
                $assign_expression->action_id = $action->id;
                $assign_expression->updated_by = $userId;
                $assign_expression->save();

                // In case action is of type 'user_output'
            }  else if($action->type == 'user_output') {

                // Get the template related info
                $input_template = $input_action["template"];
                // Check if the template is new or an existing one
                $is_new_expression = isset($input_template["text"]);
                // If it's a new template, create one record each in the DB in the template and template_text table
                if ($is_new_expression) {

                    $template = new Template;
                    $template->type = $input_template["type"];
                    $template->updated_by = $userId;
                    $template->save();

                    // Get the id of the template created to use it after in action_has_template
                    $template_id = $template->id;

                    $template_text = new TemplateText;
                    $template_text->template_id = $template_id;
                    $template_text->language_id = $langId;
                    $template_text->name = $input_template["name"];
                    $template_text->text = $input_template["text"];
                    $template_text->updated_by = $userId;
                    $template_text->save();

                    // To be used in the function that will be a part of the 'NEW->EXISTING' XML transformation
                    $template_class = null;
                    $template_extra_field1 =  null;
                    $template_extra_field2 = null;

                    // Save the extra information of the new templates
                    // If it's a modal template, create a new record in the template_modal table to store its extra info
                    if ($template->type == 'modal') {

                        $template_modal = new TemplateModal;
                        $template_modal->template_id = $template_id;
                        $template_modal->language_id = $langId;
                        $template_modal->header_text = $input_template["header"];
                        $template_modal->button_text = $input_template["button"];
                        $template_modal->updated_by = $userId;
                        $template_modal->save();

                        // To be used in the function that will be a part of the 'NEW->EXISTING' XML transformation
                        $template_extra_field1 =  $template_modal->header_text;
                        $template_extra_field2 = $template_modal->button_text;

                    } else if ($template->type == 'toast') {

                        // If it's a toast template, create a new record in the template_toast table to store its extra info
                        $template_toast = new TemplateToast;
                        $template_toast->template_id = $template_id;
                        $template_toast->language_id = $langId;
                        $template_toast->class = $input_template["class"];

                        // To be used in the function that will be a part of the 'NEW->EXISTING' XML transformation
                        $template_class = $template_toast->class;

                        // If it's a custom toast, save the colour and title text info to be used in the toast
                        if ($template_toast->class == 'custom') {
                            $template_toast->colour = $input_template["colour"];
                            $template_toast->title_text = $input_template["title"];

                            // To be used in the function that will be a part of the 'NEW->EXISTING' XML transformation
                            $template_extra_field1 = $template_toast->colour;
                            $template_extra_field2 = $template_toast->title_text;
                        }

                        $template_toast->updated_by = $userId;
                        $template_toast->save();
                    }

                    $hasHTMLCode = $input_template["hasHTML"];
                    $openedEditor = $input_template["openedEditor"];
                    // Replace the 'NEW' part of the XML code with an 'EXISTING', as the template is now created
                    $current_code = $this->getCurrentBlockCode ('action_user_output', $hasHTMLCode, $openedEditor, $template_text->text,
                        $template_text->name, $template->type, $template_class, $template_extra_field1, $template_extra_field2,
                        null, null, null, null);
                    $replacement_code = $this->getReplacementBlockCode ('action_user_output', $template_id,
                        null, null, null, null);
                    $blockly_XML = $this->replaceNewWithExistingCode ($blockly_XML, $current_code, $replacement_code);

                } else {
                    // If it's an existing template, get its id
                    $template_id = $input_template["id"];
                }

                // Insert record in the action_has_template table in the DB
                $action_has_template = new ActionHasTemplate;
                $action_has_template->action_id = $action->id;
                $action_has_template->template_id = $template_id;
                $action_has_template->updated_by = $userId;
                $action_has_template->save();

                // In case action if of type 'user_input'
            } else if ($action->type == 'user_input') {

                // Get the properties to be shown in the form
                $properties = $input_action["properties"];
                $orderActionProp = 1;

                // Create a record in action name table for the user input action - needed for the forms
                $action_name = new ActionName;
                $action_name->action_id = $action->id;
                $action_name->language_id = $langId;
                $action_name->name = $input_action["name"];
                $action_name->updated_by = $userId;
                $action_name->save();

                // Store each property and its associated info
                foreach ($properties as $input_property) {
                    $property_id = $input_property["id"];
                    $mandatory = $input_property["mandatory"];
                    // Create an entry in the 'action prop' table that associates the property and the user input action
                    $action_prop = new ActionProp;
                    $action_prop->action_id = $action->id;
                    $action_prop->prop_id = $property_id;
                    $action_prop->mandatory = $mandatory;
                    $action_prop->order = $orderActionProp;
                    $action_prop->updated_by = $userId;
                    $action_prop->save();

                    // As the 3 fields of 'form compute', 'enable condition' and 'validation condition' are optional
                    // We firstly check which ones the property has and we need to store
                    $property_has_form_compute = isset($input_property["form_compute"]);
                    $property_has_enable_condition = isset($input_property["enable_condition"]);
                    $property_has_validation_conditions = isset($input_property["validation_conditions"]);

                    // If it has form compute defined, store the json logic in the 'form compute' table
                    if ($property_has_form_compute) {
                        $form_compute = new FormCompute;
                        $form_compute->action_prop_id = $action_prop->id;
                        $form_compute->json_logic = $input_property["form_compute"]["json_logic"];
                        $form_compute->updated_by = $userId;
                        $form_compute->save();
                    }

                    // If it has an enable condition, it'll store the condition and all its inputs
                    if ($property_has_enable_condition) {
                        $input_enable_condition = $input_property["enable_condition"];

                        // Create a new entry in the 'condition' table to store the enable condition
                        $blockly_XML = $this->storeCondition($blockly_XML, $input_enable_condition, $action->id, $userId, $langId);
                    }

                    // If it has validation conditions, we store them all with its info
                    if ($property_has_validation_conditions) {
                        $validation_conditions = $input_property["validation_conditions"];
                        // Every validation condition is processed and stored
                        foreach($validation_conditions as $validation_condition) {
                            // Check if the current validation condition has these fields that change depending on type
                            $has_param_1 = isset($validation_condition["param_1"]);
                            $has_param_2 = isset($validation_condition["param_2"]);
                            $has_custom_validation = isset($validation_condition["custom_validation"]);

                            // Store the info of the validation condition, including the optional elements is applicable
                            $validation_cond = new ValidationCond;
                            $validation_cond->type = $validation_condition["type"];
                            $validation_cond->action_prop_id = $action_prop->id;
                            $validation_cond->negative = $validation_condition["negative"];

                            if ($has_param_1) {
                                $validation_cond->param_1 = $validation_condition["param_1"];
                            }
                            if ($has_param_2) {
                                $validation_cond->param_2 = $validation_condition["param_2"];
                            }
                            if ($has_custom_validation) {
                                $validation_cond->custom_validation = $validation_condition["custom_validation"];
                            }

                            $validation_cond->updated_by = $userId;
                            $validation_cond->save();

                            // Check if the user output template to be used is an existing one
                            $validation_condition_template = $validation_condition["template"];
                            $template_exists = isset($validation_condition_template["id"]);

                            // If it's a new one
                            if (!$template_exists) {
                                // Creates an entry in the template table with type validation warning
                                $new_template = new Template;
                                $new_template->type = 'validation_warning';
                                $new_template->updated_by = $userId;
                                $new_template->save();

                                // Also creates an entry in the template text table containig the text specified by the user
                                $new_template_text = new TemplateText;
                                $new_template_text->template_id = $new_template->id;
                                $new_template_text->language_id = $langId;
                                $new_template_text->name = $validation_condition_template["text"];
                                $new_template_text->text = $validation_condition_template["text"];
                                $new_template_text->updated_by = $userId;
                                $new_template_text->save();

                                // Gets the template id that will be needed to associate it to the validation condition
                                $validation_condition_template_id = $new_template->id;

                                // For the replacing of the 'NEW' -> 'EXISTING'
                                $param_1 = null;
                                $param_2 = null;
                                $negative = null;
                                $validation_type_XML = $this->transformValidationType($validation_condition["type"]);

                                if ($validation_condition["negative"]) {
                                    $negative = 'TRUE';
                                } else {
                                    $negative = 'FALSE';
                                }

                                // In the block, the field 'term1' refers to table parameters 'param1' or 'custom validation'
                                if ($has_param_1) {
                                    $param_1 = $validation_condition["param_1"];
                                } else if ($has_custom_validation) {
                                    $param_1 = $validation_condition["custom_validation"];
                                }
                                if ($has_param_2) {
                                    $param_2 = $validation_condition["param_2"];
                                }

                                // Replace the 'NEW' part of the XML code with an 'EXISTING', as the val cond template is now created
                                $current_code = $this->getCurrentBlockCode ('validation_condition_user_output', null, null,
                                    $validation_condition_template["text"],null, null,
                                    null, null, null,
                                    $validation_type_XML, $negative, $param_1, $param_2);
                                header('Content-Type: application/json');
                                $replacement_code = $this->getReplacementBlockCode ('validation_condition_user_output', $new_template->id,
                                    $validation_type_XML, $negative, $param_1, $param_2);
                                $blockly_XML = $this->replaceNewWithExistingCode ($blockly_XML, $current_code, $replacement_code);

                            } else {
                                // If it's an existing template, get its id
                                $validation_condition_template_id = $validation_condition_template["id"];
                            }
                            // Finally, associate the template to the validation condition
                            $validation_cond_has_template = new ValidationCondHasTemplate;
                            $validation_cond_has_template->template_id = $validation_condition_template_id;
                            $validation_cond_has_template->validation_cond_id = $validation_cond->id;
                            $validation_cond_has_template->updated_by = $userId;
                            $validation_cond_has_template->save();
                        }

                    }
                    $orderActionProp += 1;
                }

            } else if ($action->type == 'if') {

                // Get the info on the condition and actions present in the if block
                $if_condition = $input_action["ifCondition"];
                $input_then_action = $input_action["thenAction"];
                $has_else_action = isset($input_action["elseAction"]);

                // Store the if condition
                $blockly_XML = $this->storeCondition($blockly_XML, $if_condition, $action->id, $userId, $langId);

                // Create an entry in the Action Table for the then action, associating it with the if action (par_action_id)
                $then_action = new Action;
                $then_action->action_rule_id = $action_rule_id;
                $then_action->type = 'then';
                $then_action->par_action_id = $action->id;
                $then_action->updated_by = $userId;
                $then_action->save();

                // Store the action associated with the then action
                $blockly_XML = $this->storeActions ($blockly_XML, $input_then_action, $action_rule_id, $then_action->id, $userId, $langId);

                if ($has_else_action) {

                    // If it has an else action specified, get that action
                    $input_else_action = $input_action["elseAction"];

                    // Create an entry in the Action Table for the else action, associating it with the if action (par_action_id)
                    $else_action = new Action;
                    $else_action->action_rule_id = $action_rule_id;
                    $else_action->type = 'else';
                    $else_action->par_action_id = $action->id;

                    $else_action->updated_by = $userId;
                    $else_action->save();

                    // Store the action associated with the else action
                    $blockly_XML = $this->storeActions ($blockly_XML, $input_else_action, $action_rule_id, $else_action->id, $userId, $langId);

                }

            } else if ($action->type == 'while') {

                // Get the info on the condition and action present in the while block
                $while_condition = $input_action["whileCondition"];
                $input_do_action = $input_action["doAction"];

                // Store the while condition
                $blockly_XML = $this->storeCondition($blockly_XML, $while_condition, $action->id, $userId, $langId);

                // Store the do Action, associating it with the while entry
                $blockly_XML = $this->storeActions ($blockly_XML, $input_do_action, $action_rule_id, $action->id, $userId, $langId);

            }
        }
        return $blockly_XML;
    }

    public function storeConstantTerm ($blockly_XML, $constant_term, $term_id, $userId, $langId) {
        // Check whether it is a new or existing constant
        $type = $constant_term["type"];
        // If it's an existing constant, we get the id
        if ($type == 'existingConstant') {
            $constant_id = $constant_term["constant_id"];
        } else {
            // If it's a new constant, we create it and then get its id
            $constant = new Constant;
            $constant->value_type = $constant_term["value_type"];
            $constant->value = $constant_term["value"];
            $constant->updated_by = $userId;
            $constant->save();
            $constant_id = $constant->id;
            // We also create a register for its name
            $constant_name = new ConstantName;
            $constant_name->constant_id = $constant_id;
            $constant_name->language_id = $langId;
            $constant_name->name = $constant_term["name"];
            $constant_name->updated_by = $userId;
            $constant_name->save();

            // Replace the 'NEW' part of the XML code with an 'EXISTING', as the constant is now created
            $current_code = $this->getCurrentBlockCode ('constant', null, null,
                $constant_term["value"],$constant_term["name"], strtoupper($constant_term["value_type"]),
                null, null, null, null, null, null, null);
            $replacement_code = $this->getReplacementBlockCode ('constant', $constant_id,
                null, null, null, null);
            $blockly_XML = $this->replaceNewWithExistingCode ($blockly_XML, $current_code, $replacement_code);
        }
        // Create a new entry in the term has constant table
        $term_has_constant = new TermHasConstant;
        $term_has_constant->term_id = $term_id;
        $term_has_constant->constant_id = $constant_id;
        $term_has_constant->updated_by = $userId;
        $term_has_constant->save();

        return $blockly_XML;
    }

    public function storePropertyValueTerm ($property_value_term, $term_id, $userId) {
        // Get the table that the property value comes from
        $value_origin_table = $property_value_term["table"];

        // As it can come through table prop allowed value or table value (prop ref), we act accordingly
        if ($value_origin_table == 'prop_allowed_value') {
            $term_has_prop_allowed_value = new TermHasPropAllowedValue;
            $term_has_prop_allowed_value->term_id = $term_id;
            $term_has_prop_allowed_value->prop_allowed_value_id = $property_value_term["id"];
            $term_has_prop_allowed_value->updated_by = $userId;
            $term_has_prop_allowed_value->save();
        } else {
            $term_has_prop_ref_value = new TermHasPropRefValue;
            $term_has_prop_ref_value->term_id = $term_id;
            $term_has_prop_ref_value->prop_ref_value_id = $property_value_term["id"];
            $term_has_prop_ref_value->updated_by = $userId;
            $term_has_prop_ref_value->save();
        }
    }

    public function storePropertyTerm ($property_term, $term_id, $userId) {
        // Create an entry in the 'term has property' table
        $term_has_property = new TermHasProperty;
        $term_has_property->term_id = $term_id;
        $term_has_property->property_id = $property_term["id"];
        $term_has_property->updated_by = $userId;
        $term_has_property->save();
    }

    public function storeValueTerm ($value_term, $term_id, $userId) {
        // Create an entry in the 'term has value' table
        $term_has_value = new TermHasValue;
        $term_has_value->term_id = $term_id;
        $term_has_value->value_type = $value_term["value_type"];
        $term_has_value->value = $value_term["value"];
        $term_has_value->updated_by = $userId;
        $term_has_value->save();
    }

    public function storeQueryTerm ($blockly_XML, $query_term, $term_id, $userId, $langId) {
        // Create an entry in the 'term has query' table
        $term_has_query = new TermHasQuery;
        $term_has_query->term_id = $term_id;
        $term_has_query->query_id = $query_term["query_id"];
        $term_has_query->updated_by = $userId;
        $term_has_query->save();
        // When using a query as a term, we may have to specify the terms that correspond to its parameters
        // Check if the query has constant terms as parameters
        $has_constant_terms = isset($query_term["constant_term"]);
        // Is so, create a term and an entry in the 'query has term' table accordingly
        if ($has_constant_terms) {
            foreach ($query_term["constant_term"] as $input_constant_term) {
                $term = new Term;
                $term->updated_by = $userId;
                $term->save();
                $blockly_XML = $this->storeConstantTerm($blockly_XML, $input_constant_term, $term->id, $userId, $langId);
                $query_has_term = new QueryHasTerm;
                $query_has_term->term_has_query_id = $term_has_query->id;
                $query_has_term->term_id = $term->id;
                $query_has_term->property_id = $input_constant_term["propertyIdQueryTerm"];
                $query_has_term->updated_by = $userId;
                $query_has_term->save();
            }
        }
        // Check if the query has property terms as parameters
        $has_property_terms = isset($query_term["property_term"]);
        // Is so, create a term and an entry in the 'query has term' table accordingly
        if ($has_property_terms) {
            foreach ($query_term["property_term"] as $input_property_term) {
                $term = new Term;
                $term->updated_by = $userId;
                $term->save();
                $this->storePropertyTerm($input_property_term, $term->id,$userId);
                $query_has_term = new QueryHasTerm;
                $query_has_term->term_has_query_id = $term_has_query->id;
                $query_has_term->term_id = $term->id;
                $query_has_term->property_id = $input_property_term["propertyIdQueryTerm"];
                $query_has_term->updated_by = $userId;
                $query_has_term->save();
            }
        }
        // Check if the query has query terms as parameters
        $has_query_terms = isset($query_term["query_term"]);
        // Is so, create a term and an entry in the 'query has term' table accordingly
        if ($has_query_terms) {
            foreach ($query_term["query_term"] as $input_query_term) {
                $term = new Term;
                $term->updated_by = $userId;
                $term->save();
                $blockly_XML = $this->storeQueryTerm($blockly_XML, $input_query_term, $term->id,$userId, $langId);
                $query_has_term = new QueryHasTerm;
                $query_has_term->term_has_query_id = $term_has_query->id;
                $query_has_term->term_id = $term->id;
                $query_has_term->property_id = $input_query_term["propertyIdQueryTerm"];
                $query_has_term->updated_by = $userId;
                $query_has_term->save();
            }
        }
        // Check if the query has value terms as parameters
        $has_value_terms = isset($query_term["value_term"]);
        // Is so, create a term and an entry in the 'query has term' table accordingly
        if ($has_value_terms) {
            foreach ($query_term["value_term"] as $input_value_term) {
                $term = new Term;
                $term->updated_by = $userId;
                $term->save();
                $this->storeValueTerm($input_value_term, $term->id,$userId);
                $query_has_term = new QueryHasTerm;
                $query_has_term->term_has_query_id = $term_has_query->id;
                $query_has_term->term_id = $term->id;
                $query_has_term->property_id = $input_value_term["propertyIdQueryTerm"];
                $query_has_term->updated_by = $userId;
                $query_has_term->save();
            }
        }
        // Finally, check if the query has compute expression terms as parameters
        $has_compute_expression_terms = isset($query_term["compute_expression_term"]);
        // Is so, create a term and an entry in the 'query has term' table accordingly
        if ($has_compute_expression_terms) {
            foreach ($query_term["compute_expression_term"] as $input_compute_expression_term) {
                $term = new Term;
                $term->updated_by = $userId;
                $term->save();
                $blockly_XML = $this->storeComputeExpressionTerm($blockly_XML, $input_compute_expression_term, $term->id, $userId, $langId);
                $query_has_term = new QueryHasTerm;
                $query_has_term->term_has_query_id = $term_has_query->id;
                $query_has_term->term_id = $term->id;;
                $query_has_term->property_id = $input_compute_expression_term["propertyIdQueryTerm"];
                $query_has_term->updated_by = $userId;
                $query_has_term->save();
            }
        }
        return $blockly_XML;
    }

    public function storeComputeExpressionTerm ($blockly_XML, $compute_expression_term, $term_id, $userId, $langId) {
        // Create an entry in the 'compute expression' table with its operator
        $compute_expression = new ComputeExpression;
        $compute_expression->operator = $compute_expression_term["operator"];
        $compute_expression->updated_by = $userId;
        $compute_expression->save();

        // Associate the term to the compute expression
        $term_has_compute_expression = new TermHasComputeExpression;
        $term_has_compute_expression->term_id = $term_id;
        $term_has_compute_expression->compute_expression_id = $compute_expression->id;
        $term_has_compute_expression->updated_by = $userId;
        $term_has_compute_expression->save();

        // Associate the corresponding terms in the compute expression
        // Check if the compute expression has constant terms
        $expression_has_constant_terms = isset($compute_expression_term["constant_term"]);
        // If so, creates a term and an entry in the table 'compute expression has term' to associate them
        if ($expression_has_constant_terms) {
            foreach ($compute_expression_term["constant_term"] as $input_constant_term) {
                $term = new Term;
                $term->updated_by = $userId;
                $term->save();
                $blockly_XML = $this->storeConstantTerm($blockly_XML, $input_constant_term, $term->id,$userId, $langId);
                $compute_expression_has_term = new ComputeExpressionHasTerm;
                $compute_expression_has_term->compute_expression_id = $compute_expression->id;
                $compute_expression_has_term->term_id = $term->id;
                $compute_expression_has_term->order = $input_constant_term["order"];
                $compute_expression_has_term->updated_by = $userId;
                $compute_expression_has_term->save();
            }
        }
        // Checks if the compute expression has property terms
        $expression_has_property_terms = isset($compute_expression_term["property_term"]);
        // If so, creates a term and an entry in the table 'compute expression has term' to associate them
        if ($expression_has_property_terms) {
            foreach ($compute_expression_term["property_term"] as $input_property_term) {
                $term = new Term;
                $term->updated_by = $userId;
                $term->save();
                $this->storePropertyTerm($input_property_term, $term->id,$userId);
                $compute_expression_has_term = new ComputeExpressionHasTerm;
                $compute_expression_has_term->compute_expression_id = $compute_expression->id;
                $compute_expression_has_term->term_id = $term->id;
                $compute_expression_has_term->order = $input_property_term["order"];
                $compute_expression_has_term->updated_by = $userId;
                $compute_expression_has_term->save();
            }
        }
        // Checks if the compute expression has query terms
        $expression_has_query_terms = isset($compute_expression_term["query_term"]);
        // If so, creates a term and an entry in the table 'compute expression has term' to associate them
        if ($expression_has_query_terms) {
            foreach ($compute_expression_term["query_term"] as $input_query_term) {
                $term = new Term;
                $term->updated_by = $userId;
                $term->save();
                $blockly_XML = $this->storeQueryTerm($blockly_XML, $input_query_term, $term->id,$userId, $langId);
                $compute_expression_has_term = new ComputeExpressionHasTerm;
                $compute_expression_has_term->compute_expression_id = $compute_expression->id;
                $compute_expression_has_term->term_id = $term->id;
                $compute_expression_has_term->order = $input_query_term["order"];
                $compute_expression_has_term->updated_by = $userId;
                $compute_expression_has_term->save();
            }
        }
        // Checks if the compute expression has value terms
        $expression_has_value_terms = isset($compute_expression_term["value_term"]);
        // If so, creates a term and an entry in the table 'compute expression has term' to associate them
        if ($expression_has_value_terms) {
            foreach ($compute_expression_term["value_term"] as $input_value_term) {
                $term = new Term;
                $term->updated_by = $userId;
                $term->save();
                $this->storeValueTerm($input_value_term, $term->id,$userId);
                $compute_expression_has_term = new ComputeExpressionHasTerm;
                $compute_expression_has_term->compute_expression_id = $compute_expression->id;
                $compute_expression_has_term->term_id = $term->id;
                $compute_expression_has_term->order = $input_value_term["order"];
                $compute_expression_has_term->updated_by = $userId;
                $compute_expression_has_term->save();
            }
        }
        // Checks if the compute expression has compute expression terms
        $expression_has_compute_expression_terms = isset($compute_expression_term["compute_expression_term"]);
        // If so, creates a term and an entry in the table 'compute expression has term' to associate them
        if ($expression_has_compute_expression_terms) {
            foreach ($compute_expression_term["compute_expression_term"] as $input_compute_expression_term) {
                $term = new Term;
                $term->updated_by = $userId;
                $term->save();
                $blockly_XML = $this->storeComputeExpressionTerm($blockly_XML, $input_compute_expression_term, $term->id,$userId, $langId);
                $compute_expression_has_term = new ComputeExpressionHasTerm;
                $compute_expression_has_term->compute_expression_id = $compute_expression->id;
                $compute_expression_has_term->term_id = $term->id;
                $compute_expression_has_term->order = $input_compute_expression_term["order"];
                $compute_expression_has_term->updated_by = $userId;
                $compute_expression_has_term->save();
            }
        }
        return $blockly_XML;
    }

    public function storeCondition ($blockly_XML, $input_condition, $action_id, $userId, $langId) {
        // Create a new entry in the 'condition' table to store the input condition
        $condition = new Condition;
        $condition->type = $input_condition["type"];
        $condition->action_id = $action_id;
        $condition->updated_by = $userId;
        $condition->save();

        // Check what kind of inputs the condition has - user evaluated / comp evaluated / sub conditions
        $condition_has_user_evaluated_expressions = isset($input_condition["user_evaluated_expressions"]);
        $condition_has_comp_evaluated_expressions = isset($input_condition["comp_evaluated_expressions"]);
        $condition_has_sub_conditions = isset($input_condition["conditions"]);

        // Depending on what it has, store all of the information for every input inside the condition
        if ($condition_has_user_evaluated_expressions) {
            foreach ($input_condition["user_evaluated_expressions"] as $uee_input) {
                $blockly_XML = $this->storeUserEvaluatedExpressionInputCondition($blockly_XML, $uee_input, $condition->id, $userId, $langId);
            }
        }
        if ($condition_has_comp_evaluated_expressions) {
            foreach ($input_condition["comp_evaluated_expressions"] as $cee_input) {
                $blockly_XML = $this->storeCompEvaluatedExpressionInputCondition($blockly_XML, $cee_input, $condition->id, $userId, $langId);
            }
        }
        if ($condition_has_sub_conditions) {
            foreach ($input_condition["conditions"] as $sub_condition) {
                $blockly_XML = $this->storeSubConditionInputCondition($blockly_XML, $sub_condition, $condition->id, $action_id, $userId, $langId);
            }
        }
        return $blockly_XML;
    }

    public function storeUserEvaluatedExpressionInputCondition ($blockly_XML, $input_uee, $parent_condition_id, $userId, $langId) {
        // Check if the expression to be used is an existing one - case where we get its id
        if ($input_uee["type"] == 'existingExpression') {
            $user_evaluated_expression_id = $input_uee["id"];
        } else {
            // If it's a new one, we create an entry in the 'user evaluated expression' table
            $user_evaluated_expression = new UserEvaluatedExpression;
            $user_evaluated_expression->updated_by = $userId;
            $user_evaluated_expression->save();

            // Also create an entry in 'user evaluated expression text' with the text that the user inserted
            $user_evaluated_expression_text = new UserEvaluatedExpressionText;
            $user_evaluated_expression_text->user_evaluated_expression_id = $user_evaluated_expression->id;
            $user_evaluated_expression_text->language_id = $langId;
            $user_evaluated_expression_text->expression_name = $input_uee["expression_text"];
            $user_evaluated_expression_text->expression_text = $input_uee["expression_text"];
            $user_evaluated_expression_text->updated_by = $userId;
            $user_evaluated_expression_text->save();

            // Get the id of the newly created expression so we can associate it to the condition
            $user_evaluated_expression_id = $user_evaluated_expression->id;

            // Replace the 'NEW' part of the XML code with an 'EXISTING', as the uee is now created
            $current_code = $this->getCurrentBlockCode ('user_evaluated_expression', null, null, $input_uee["expression_text"],
                null, null, null, null, null,
                null, null, null, null);
            $replacement_code = $this->getReplacementBlockCode ('user_evaluated_expression', $user_evaluated_expression->id,
                null, null, null, null);
            $blockly_XML = $this->replaceNewWithExistingCode ($blockly_XML, $current_code, $replacement_code);
        }

        // Associate the entry with the condition in the respective table
        $condition_has_uee = new ConditionHasUserEvaluatedExpression;
        $condition_has_uee->condition_id = $parent_condition_id;
        $condition_has_uee->user_evaluated_expression_id = $user_evaluated_expression_id;
        $condition_has_uee->updated_by = $userId;
        $condition_has_uee->save();

        return $blockly_XML;
    }

    public function storeCompEvaluatedExpressionInputCondition ($blockly_XML, $input_cee, $parent_condition_id, $userId, $langId) {
        // Create an entry in table 'term' that will represent the left input of the block
        $term_1 = new Term;
        $term_1->updated_by = $userId;
        $term_1->save();

        // Get its id to associate with the info of the term
        $term_1_id = $term_1->id;

        // Check what type of term is present in this first term
        $has_term1_constant_term = isset($input_cee["constant_term_1"]);
        $has_term1_value_term = isset($input_cee["value_term_1"]);
        $has_term1_property_term = isset($input_cee["property_term_1"]);
        $has_term1_query_term = isset($input_cee["query_term_1"]);
        $has_term1_compute_expression_term = isset($input_cee["compute_expression_term_1"]);

        // Act accordingly depending on the type of term present
        if ($has_term1_constant_term) {
            $blockly_XML = $this->storeConstantTerm($blockly_XML, $input_cee["constant_term_1"], $term_1_id, $userId, $langId);
        } else if ($has_term1_value_term) {
            $this->storeValueTerm($input_cee["value_term_1"], $term_1_id, $userId);
        } else if ($has_term1_property_term) {
            $this->storePropertyTerm($input_cee["property_term_1"], $term_1_id, $userId);
        } else if ($has_term1_query_term) {
            $blockly_XML = $this->storeQueryTerm($blockly_XML, $input_cee["query_term_1"], $term_1_id, $userId, $langId);
        } else if ($has_term1_compute_expression_term) {
            $blockly_XML = $this->storeComputeExpressionTerm($blockly_XML, $input_cee["compute_expression_term_1"], $term_1_id, $userId, $langId);
        }

        // Create an entry in table 'term' that will represent the right input of the block
        $term_2 = new Term;
        $term_2->updated_by = $userId;
        $term_2->save();

        // Get its id to associate with the info of the term
        $term_2_id = $term_2->id;

        // Check what type of term is present in this second term
        $has_term2_constant_term = isset($input_cee["constant_term_2"]);
        $has_term2_value_term = isset($input_cee["value_term_2"]);
        $has_term2_property_term = isset($input_cee["property_term_2"]);
        $has_term2_query_term = isset($input_cee["query_term_2"]);
        $has_term2_compute_expression_term = isset($input_cee["compute_expression_term_2"]);
        $has_term2_property_value_term = isset($input_cee["property_value_term_2"]);

        // Act accordingly depending on the type of term present
        if ($has_term2_constant_term) {
            $blockly_XML = $this->storeConstantTerm($blockly_XML, $input_cee["constant_term_2"], $term_2_id, $userId, $langId);
        } else if ($has_term2_value_term) {
            $this->storeValueTerm($input_cee["value_term_2"], $term_2_id, $userId);
        } else if ($has_term2_property_term) {
            $this->storePropertyTerm($input_cee["property_term_2"], $term_2_id, $userId);
        } else if ($has_term2_query_term) {
            $blockly_XML = $this->storeQueryTerm($blockly_XML, $input_cee["query_term_2"], $term_2_id, $userId, $langId);
        } else if ($has_term2_compute_expression_term) {
            $blockly_XML = $this->storeComputeExpressionTerm($blockly_XML, $input_cee["compute_expression_term_2"], $term_2_id, $userId, $langId);
        } else if ($has_term2_property_value_term) {
            $this->storePropertyValueTerm($input_cee["property_value_term_2"], $term_2_id, $userId);
        }

        // Create an entry in the 'comp evaluated expression' table that contains all this information
        $comp_evaluated_expression = new CompEvaluatedExpression;
        $comp_evaluated_expression->parent_cond_id = $parent_condition_id;
        $comp_evaluated_expression->logical_operator = $input_cee["logical_operator"];
        $comp_evaluated_expression->term_1_id = $term_1_id;
        $comp_evaluated_expression->term_2_id = $term_2_id;
        $comp_evaluated_expression->updated_by = $userId;
        $comp_evaluated_expression->save();

        return $blockly_XML;
    }

    public function storeSubConditionInputCondition ($blockly_XML, $input_condition, $parent_condition_id, $action_id, $userId, $langId) {
        // Create an entry in the 'condition' table that will represent this sub condition
        $sub_condition = new Condition;
        $sub_condition->type = $input_condition["type"];
        $sub_condition->parent_cond_id = $parent_condition_id;
        $sub_condition->action_id = $action_id;
        $sub_condition->updated_by = $userId;
        $sub_condition->save();

        // Check what kind of inputs are present in this sub-condition
        $condition_has_user_evaluated_expressions = isset($input_condition["user_evaluated_expressions"]);
        $condition_has_comp_evaluated_expressions = isset($input_condition["comp_evaluated_expressions"]);
        $condition_has_sub_conditions = isset($input_condition["conditions"]);

        // Act accordingly with these inputs, associating them with the sub condition
        if ($condition_has_user_evaluated_expressions) {
            foreach ($input_condition["user_evaluated_expressions"] as $uee_input) {
                $blockly_XML = $this->storeUserEvaluatedExpressionInputCondition($blockly_XML, $uee_input, $sub_condition->id, $userId, $langId);
            }
        }
        if ($condition_has_comp_evaluated_expressions) {
            foreach ($input_condition["comp_evaluated_expressions"] as $cee_input) {
                $blockly_XML = $this->storeCompEvaluatedExpressionInputCondition($blockly_XML, $cee_input, $sub_condition->id, $userId, $langId);
            }
        }
        if ($condition_has_sub_conditions) {
            foreach ($input_condition["conditions"] as $condition_input) {
                $blockly_XML = $this->storeSubConditionInputCondition($blockly_XML, $condition_input, $sub_condition->id, $action_id, $userId, $langId);
            }
        }
        return $blockly_XML;
    }

    // Methods to replace, in the XML, the 'NEW' blocks with 'EXISTING' when saving the AR in the DB

    // Get the XML Code that represents a 'NEW' part on a block - ex: a new template for user_output
    public function getCurrentBlockCode ($type, $hasHTMLCode, $openedEditor, $value, $name, $value_type, $template_class, $template_extra_field1, $template_extra_field2,  $validation_type, $negation, $param1, $param2) {
        // When is of type user_evaluated_expression, we need the value (text provided by user)
        // When is of type action_user_output, we need the value (text provided by user) and value_type (template type)
        // We also need template_class, template_extra_field1 (header/colour) and template_extra_field2 (button/title)
        // When is of type validation_condition_user_output, we need the value (text provided by user), negation, param1 and param2
        // When is of type constant, we need name, valueType and value
        // If used, validationType and negations must be in CAPS
        $code = '';
        switch ($type) {

            case 'user_evaluated_expression':

                // <xml xmlns="http://www.w3.org/1999/xhtml">
                //  <block type="user_evaluated_expression" id="KMwELV(:ha)qdmPM?5A," x="188" y="208">
                //  <mutation new_expression_input="true" existing_expression_input="false"></mutation>
                //    <field name="choice_expression">NEW</field>
                //    <field name="expression_text">newuee</field>
                //    </block>
                //    </xml>

                $code = '<mutation new_expression_input="true" existing_expression_input="false"></mutation>' .
                    '<field name="choice_expression">NEW</field>'.
                    '<field name="expression_text">'. $value .'</field>';
                break;

            case 'action_user_output':

                // MODAL
                // <xml xmlns="http://www.w3.org/1999/xhtml">
                // <block type="action" id="i_|an3e7IMv?baraik_p" inline="false">
                // <mutation ae_input1="false" ui_input1="false" cl_input1="false" uo_input1="true" uo_existing="false"
                // uo_new_toast="false" uo_new_toast_custom="false"></mutation>
                //      <field name="action">USER_OUTPUT</field>
                //      <field name="choice_template">NEW</field>
                //      <field name="template_type">MODAL</field>
                //      <field name="template_text">insert new text here</field>
                //      <field name="template_header">information</field>
                //      <field name="template_button">continue</field>
                // </block></xml>

                // TOAST
                // <xml xmlns="http://www.w3.org/1999/xhtml">
                // <block type="action" id="i_|an3e7IMv?baraik_p" inline="false">
                // <mutation ae_input1="false" ui_input1="false" cl_input1="false" uo_input1="true" uo_existing="false"
                // uo_new_toast="true" uo_new_toast_custom="true"></mutation>
                //      <field name="action">USER_OUTPUT</field>
                //      <field name="choice_template">NEW</field>
                //      <field name="template_type">TOAST</field>
                //      <field name="template_text">insert new text here</field>
                //      <field name="template_class">CUSTOM</field>
                //      <field name="template_colour">#8080ff</field>
                //      <field name="template_title">notification</field>
                // </block></xml>

                // The 'inline="false">' in the beginning is to be replaced with '>' in the 'EXISTING' block
                // This way, when the block is loaded from XML with 'EXISTING' inputs, they will be set inline

                $code = 'inline="false"><mutation ae_input1="false" ui_input1="false" cl_input1="false" uo_input1="true" uo_existing="false" ';

                if ($value_type == 'modal') {
                    $code .= 'uo_new_toast="false" uo_new_toast_custom="false"></mutation>';
                }
                else if ($value_type == 'toast' && $template_class != 'custom') {
                    $code .= 'uo_new_toast="true" uo_new_toast_custom="false"></mutation>';
                }
                else if ($value_type == 'toast' && $template_class == 'custom') {
                    $code .= 'uo_new_toast="true" uo_new_toast_custom="true"></mutation>';
                }
                $code .= '<field name="action">USER_OUTPUT</field>'.
                '<field name="choice_template">NEW</field>'.
                '<field name="template_name">'.$name.'</field>'.
                '<field name="template_type">'. strtoupper($value_type) .'</field>';

                if ($hasHTMLCode == 'hasNormalText') {
                    $code .= '<field name="template_text">'. $value .'</field>';
               } else if ($hasHTMLCode == 'hasHTMLText' && $openedEditor == 'didnt_open') {
                    $value = htmlspecialchars($value, ENT_QUOTES);
                    $code .= '<field name="template_text">'. $value .'</field>';
                }

               if ($value_type == 'modal') {

                   $code .= '<field name="template_header">'. $template_extra_field1 .'</field>'.
                       '<field name="template_button">'. $template_extra_field2 .'</field>';

               } else if ($value_type == 'toast') {

                   $code .= '<field name="template_class">'. strtoupper($template_class) .'</field>';

                   if ($template_class == 'custom') {
                       $code .= '<field name="template_colour">'. $template_extra_field1 .'</field>'.
                           '<field name="template_title">'. $template_extra_field2 .'</field>';
                   }

                   header('Content-Type: application/json');
                   echo json_encode($code);
               }
                break;

            case 'validation_condition_user_output':

                // <xml xmlns="http://www.w3.org/1999/xhtml">
                // <block type="condition_validation_condition" id=";{ERA2;=w|a-,p?pZxWj" x="149" y="221">
                // <mutation required="true" has1numberinput="false" has1numberinputonlyintegers="false" has2numberinputs="false"
                // hastextinputonly1character="false" hastextinputonly1word="false" hastextinputregexpression="false"
                // hastextinputcustomvalidation="false" co_existing="false"></mutation>
                //      <field name="negation">FALSE</field>
                //      <field name="dropdown_choice">REQUIRED</field>
                //      <field name="choice_template">NEW</field>
                //      <field name="template_field">insert new text here</field>
                // </block></xml>

                $extra_fields = $this->getFieldsConditionValidationCondition($validation_type);
                $required = $extra_fields[0];
                $has1NumberInput = $extra_fields[1];
                $has1NumberInputOnlyIntegers = $extra_fields[2];
                $has2NumberInputs = $extra_fields[3];
                $hasTextInputOnly1Character = $extra_fields[4];
                $hasTextInputOnly1Word = $extra_fields[5];
                $hasTextInputRegExpression = $extra_fields[6];
                $hasTextInputCustomValidation = $extra_fields[7];

                $code = '<mutation required="'. $required .'" has1numberinput="'. $has1NumberInput .'" has1numberinputonlyintegers="'.
                    $has1NumberInputOnlyIntegers .'" has2numberinputs="'. $has2NumberInputs .'" hastextinputonly1character="'.
                    $hasTextInputOnly1Character .'" hastextinputonly1word="'. $hasTextInputOnly1Word .'" hastextinputregexpression="'.
                    $hasTextInputRegExpression .'" hastextinputcustomvalidation="'. $hasTextInputCustomValidation .
                    '" co_existing="false"></mutation>';
                $code .= '<field name="negation">'. $negation .'</field>';
                $code .= '<field name="dropdown_choice">'. $validation_type .'</field>';
                if ($param1) {
                    $code .= '<field name="term1">'. $param1 .'</field>';
                }
                if ($param2) {
                    $code .= '<field name="term2">'. $param2 .'</field>';
                }
                $code .= '<field name="choice_template">NEW</field>'.
                    '<field name="template_field">'. $value .'</field>';
                break;

            case 'constant':

                // <xml xmlns="http://www.w3.org/1999/xhtml">
                // <block type="constant" id="zSQZQ)pF){8P;Tr^}rQO" x="96" y="215">
                // <mutation constantnew="true" constantexisting="false"></mutation>
                //      <field name="choice_constant">NEW</field>
                //      <field name="name">Insert name here</field>
                //      <field name="value_type">STRING</field>
                //      <field name="value">Insert value here</field>
                // </block></xml>

                $code = '<mutation constantnew="true" constantexisting="false"></mutation>'.
                    '<field name="choice_constant">NEW</field>'.
                    '<field name="name">'. $name .'</field>'.
                    '<field name="value_type">'. $value_type .'</field>'.
                    '<field name="value">'. $value .'</field>';
                break;
        }
        return $code;
    }

    // Get the XML Code that represents an 'EXISTING' part on a block - to replace the 'NEW' part code existing
    public function getReplacementBlockCode ($type, $id, $validation_type, $negation, $param1, $param2) {
        // When is an 'EXISTING' type of block, for every type we need id
        // We also need validationType, negation, param1 and param2 for when it's 'validation_condition_user_output'
        $code = '';
        switch ($type) {

            case 'user_evaluated_expression':

                // <xml xmlns="http://www.w3.org/1999/xhtml">
                // <block type="user_evaluated_expression" id="f$vrzYUI9;cX)f4I)LIK" x="144" y="253">
                // <mutation new_expression_input="false" existing_expression_input="true"></mutation>
                //      <field name="choice_expression">EXISTING</field>
                //      <field name="expression_text">NONE</field>
                // </block></xml>

                $code = '<mutation new_expression_input="false" existing_expression_input="true"></mutation>'.
                    '<field name="choice_expression">EXISTING</field>'.
                    '<field name="expression_text">'. $id .'</field>';
                break;

            case 'action_user_output':

                // <xml xmlns="http://www.w3.org/1999/xhtml">
                // <block type="action" id="i_|an3e7IMv?baraik_p" x="192" y="160">
                // <mutation ae_input1="false" ui_input1="false" cl_input1="false" uo_input1="true" uo_existing="true"
                // uo_new_toast="false" uo_new_toast_custom="false"></mutation>
                //      <field name="action">USER_OUTPUT</field>
                //      <field name="choice_template">EXISTING</field>
                //      <field name="template_text">3</field>
                // </block></xml>
                // The first '>' is to replace the 'inline="false">' that we had in the block with 'NEW' inputs
                // This way, when the block is loaded from XML with 'EXISTING' inputs, they will be set inline

                $code = '><mutation ae_input1="false" ui_input1="false" cl_input1="false" uo_input1="true" uo_existing="true" '.
                    'uo_new_toast="false" uo_new_toast_custom="false"></mutation>'.
                    '<field name="action">USER_OUTPUT</field>'.
                    '<field name="choice_template">EXISTING</field>'.
                    '<field name="template_text">'. $id .'</field>';
                break;

            case 'validation_condition_user_output':

                // <xml xmlns="http://www.w3.org/1999/xhtml">
                // <block type="condition_validation_condition" id="[?aSNV/*COXek;6^GnP`" x="172" y="265">
                // <mutation required="true" has1numberinput="false" has1numberinputonlyintegers="false"
                //  has2numberinputs="false" hastextinputonly1character="false" hastextinputonly1word="false"
                //  hastextinputregexpression="false" hastextinputcustomvalidation="false" co_existing="true"></mutation>
                //      <field name="negation">TRUE</field>
                //      <field name="dropdown_choice">BELONGS_RANGE</field>
                //      <field name="term1">5</field>
                //      <field name="term2">7</field>
                //      <field name="choice_template">NEW</field>
                //      <field name="template_field">Are you ok? Take 1</field>
                // </block></xml>

                $extra_fields = $this->getFieldsConditionValidationCondition($validation_type);
                $required = $extra_fields[0];
                $has1NumberInput = $extra_fields[1];
                $has1NumberInputOnlyIntegers = $extra_fields[2];
                $has2NumberInputs = $extra_fields[3];
                $hasTextInputOnly1Character = $extra_fields[4];
                $hasTextInputOnly1Word = $extra_fields[5];
                $hasTextInputRegExpression = $extra_fields[6];
                $hasTextInputCustomValidation = $extra_fields[7];
                $code = '<mutation required="'. $required .'" has1numberinput="'. $has1NumberInput .'" has1numberinputonlyintegers="'.
                    $has1NumberInputOnlyIntegers .'" has2numberinputs="'. $has2NumberInputs .'" hastextinputonly1character="'.
                    $hasTextInputOnly1Character .'" hastextinputonly1word="'. $hasTextInputOnly1Word .'" hastextinputregexpression="'.
                    $hasTextInputRegExpression .'" hastextinputcustomvalidation="'. $hasTextInputCustomValidation.
                    '" co_existing="true"></mutation>';
                $code .= '<field name="negation">'. $negation .'</field>';
                $code .= '<field name="dropdown_choice">'. $validation_type .'</field>';
                if ($param1) {
                    $code .= '<field name="term1">'. $param1 .'</field>';
                }
                if ($param2) {
                    $code .= '<field name="term2">'. $param2 .'</field>';
                }
                $code .= '<field name="choice_template">EXISTING</field>'.
                    '<field name="template_field">'. $id .'</field>';
                break;

            case 'constant':

                // <xml xmlns="http://www.w3.org/1999/xhtml">
                // <block type="constant" id="zSQZQ)pF){8P;Tr^}rQO" x="126" y="250">
                // <mutation constantnew="false" constantexisting="true"></mutation>
                //      <field name="choice_constant">EXISTING</field>
                //      <field name="constant_choice_dropdown">NONE</field>
                // </block></xml>

                $code = '<mutation constantnew="false" constantexisting="true"></mutation>'.
                    '<field name="choice_constant">EXISTING</field>'.
                    '<field name="constant_choice_dropdown">'. $id .'</field>';
                break;

        }
        return $code;
    }

    public function replaceNewWithExistingCode ($blockly_XML, $current_code, $replacement_code) {
        return str_replace($current_code, $replacement_code, $blockly_XML);
    }

    // Get the fields needed for the XML code, needed for transforming, in case it is a 'validation condition user output'
    public function getFieldsConditionValidationCondition ($type) {
        // <mutation required="true" has1numberinput="false" has1numberinputonlyintegers="false" has2numberinputs="false"
        // hastextinputonly1character="false" hastextinputonly1word="false" hastextinputregexpression="false"
        // hastextinputcustomvalidation="false" co_existing="false"></mutation>
        //   <field name="negation">FALSE</field>
        //   <field name="type">REQUIRED</field>
        //   <field name="choice_template">NEW</field>
        //   <field name="template_field">insert new text here</field>
        $required = var_export($type == 'REQUIRED', true);;
        $has1NumberInput = var_export($type == 'EQUAL_TO' || $type == 'LESS_EQUAL' || $type == 'HIGHER_EQUAL' ||
            $type == 'HIGHER_THAN' || $type == 'LESS_THAN', true);
        $has1NumberInputOnlyIntegers = var_export($type == 'MIN_LENGTH' || $type == 'MAX_LENGTH' || $type == 'MIN_WORD_LENGTH' ||
            $type == 'MAX_WORD_LENGTH', true);
        $has2NumberInputs = var_export($type == 'BELONGS_RANGE', true);
        $hasTextInputOnly1Character = var_export($type == 'HAS_CHARACTER', true);
        $hasTextInputOnly1Word = var_export($type == 'HAS_WORD', true);
        $hasTextInputRegExpression = var_export($type == 'REG_EXPRESSION', true);
        $hasTextInputCustomValidation = var_export($type == 'CUSTOM_VALIDATION', true);
        return [$required, $has1NumberInput, $has1NumberInputOnlyIntegers, $has2NumberInputs, $hasTextInputOnly1Character,
            $hasTextInputOnly1Word, $hasTextInputRegExpression, $hasTextInputCustomValidation];
    }

    // Transform the validation type to what it receives in the XML
    public function transformValidationType ($validation_type) {
        switch ($validation_type) {
            case 'required':
                return 'REQUIRED';
            case 'isNumber':
                return 'IS_NUMBER';
            case 'isInteger':
                return 'IS_INTEGER';
            case 'equalTo':
                return 'EQUAL_TO';
            case 'maxWordLength':
                return 'MAX_WORD_LENGTH';
            case 'lessEqual':
                return 'LESS_EQUAL';
            case 'higherEqual':
                return 'HIGHER_EQUAL';
            case 'higherThan':
                return 'HIGHER_THAN';
            case 'lessThan':
                return 'LESS_THAN';
            case 'minLength':
                return 'MIN_LENGTH';
            case 'belongsRange':
                return 'BELONGS_RANGE';
            case 'maxLength':
                return 'MAX_LENGTH';
            case 'minWordLength':
                return 'MIN_WORD_LENGTH';
            case 'hasCharacter':
                return 'HAS_CHARACTER';
            case 'regExpression':
                return 'REG_EXPRESSION';
            case 'hasWord':
                return 'HAS_WORD';
            case 'isEmail':
                return 'IS_EMAIL';
            case 'isURL':
                return 'IS_URL';
            case 'customValidation':
                return 'CUSTOM_VALIDATION';
        }
        return '';
    }
}
