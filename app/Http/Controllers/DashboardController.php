<?php

namespace App\Http\Controllers;

use App\ActionRule;
use App\ActionTemplate;
use App\ActorIniciatesT;
use App\CausalLink;
use App\DActTemplate;
use App\Entity;
use App\ExternalIntegration;
use App\Process;
use App\ProcessType;
use App\ProcessName;
use App\ProcessTypeName;
use App\Property;
use App\PropertyCanReadEntType;
use App\PropertyCanReadProperty;
use App\Role;
use App\RoleHasActor;
use App\RoleHasUser;
use App\Transaction;
use App\TransactionAck;
use App\TransactionType;
use App\TransactionTypeName;
use App\TransactionState;
use App\TState;
use App\Users;
use App\WaitingLink;
use App\User;
use App\EntityName;
use App\Value;
use App\EntType;
use App\Language;
use App\TStateName;
use App\PropertyName;
use App\Actor;
use App\PropAllowedValue;
use App\Action;
use App\ActionLog;
use Illuminate\Http\Request;
use Illuminate\Notifications\Channels\BroadcastChannel;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Storage;
use DB;
use Response;
use Exception;
use Config;
use App\Events\TransactionEvent;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use DOMDocument;
use DOMXPath;

use Illuminate\Support\Facades\Auth;
use App\Services\ExternalIntegrationInterface;

class User_pusher
{
    public $user;
    public $message;
}

class ActionN
{
    public $flow_type;
    public $type;
    public $par_action_id;
}

class DashboardController extends Controller
{
    //
    private $url_text;

    //fixo
    private $user_id;
    private $lang_id;
    private $lang_id_fallback_locale;
    //fixo

//    public function __construct(ExternalIntegrationInterface $ext_int)
//    {
//        parent::__construct();
//        $this->user_id = Config::get('config_app.user_id');
//        $this->ext_int = $ext_int;
//
//        $this->middleware(function ($request, $next) {
//            //$this->url_text = Config::get('app.locale');
//            //Fixo
//            $this->lang_id = $this->auth_user_language_id;
//            //fixo
//            $this->url_text = Language::find($this->lang_id)->slug;
//
//            //fixo
//            $this->user_id = $this->auth_user_id;
//            $this->lang_id_fallback_locale = $this->app_langid_fallback_locale;
//            //fixo
//
//            return $next($request);
//        });


//    }

    public function index(Request $request)
    {
        $userId = $request->user()->id;
        $langId = $request->user()->language_id;
        $transactions = $this->getTransTypeUserCanInit($userId,$langId);
        $transactionsAll = $this->getTransTypeUserCanInitFromDelegation($userId,$langId)->merge($transactions);
        foreach ($transactionsAll as $t){
            $t->t_name = $t->language[0]->pivot->t_name;
            $t->rt_name = $t->language[0]->pivot->rt_name;
        }
        return response()->json($transactionsAll);
    }

    public function getTransTypeUserCanInit($userId, $langId)
    {
        $transactions = TransactionType::with(['iniciatorActor.role.user' => function($query) use ($userId) {
            $query->where('user_id', $userId);
        }, 'language' => function($query) use ($langId) {
            $query->where('id', $langId);
        }])->whereHas('iniciatorActor.role.user', function ($query) use ($userId) {
            return $query->where('user_id', $userId);
        })->whereHas('language', function($query) use ($langId) {
            $query->where('id', $langId);
        })->get();

        $transactions->map(function ($transaction) {
            $transaction['is_del'] = false;
            return $transaction;
        });

        //->doesntHave('causedTransaction')
        //return response()->json($transactions);
        return $transactions;
    }

    public function getTransTypeUserCanInitFromDelegation($userId,$langId)
    {
        $tstate = 1;

        $transactions = TransactionType::with(['iniciatorActor.role.delegates_role.delegated_role.user' => function($query) use ($userId) {
            $query->where('user_id', $userId);
        }, 'language' => function($query) use ($langId) {
            $query->where('id', $langId);
        }])->whereHas('iniciatorActor.role.delegates_role.delegated_role.user', function ($query) use ($userId) {
            return $query->where('user_id', $userId);
        })->whereHas('iniciatorActor.role.delegates_role.t_state', function ($query) use ($tstate){
            return $query->where('id', $tstate);
        })->whereHas('language', function($query) use ($langId) {
            $query->where('id', $langId);
        })->get();

        $transactions->map(function ($transaction) {
            $transaction['is_del'] = true;
            return $transaction;
        });

        return $transactions;
    }

    public function getAllInicTransactions(Request $request){

        $user_id = $request->user()->id;

        $language_id = $request->user()->language_id;

        $userRoles = RoleHasUser::where('user_id', $user_id)->get();

        $userInitatedTransactions = collect();

        foreach($userRoles as $userRole){
            $actorRoles = RoleHasActor::where('role_id', $userRole->role_id)->get();

            foreach($actorRoles as $actorRole){
                $actorInitiatesTs = ActorIniciatesT::where('actor_id', $actorRole->actor_id)->get();

                foreach($actorInitiatesTs as $actorInitiatesT){
                    $transactionTypes = TransactionType::where('id', $actorInitiatesT->transaction_type_id)->get();

                    foreach($transactionTypes as $transactionType){
                        $transactionType->t_name = TransactionTypeName::where('transaction_type_id', $transactionType->id)->where('language_id', $language_id)->first()->t_name;
                        $processTypes = ProcessType::where('id', $transactionType->process_type_id)->get();

                        foreach($processTypes as $processType){
                            $processType->name = ProcessTypeName::where('process_type_id', $processType->id)->where('language_id', $language_id)->first()->name;
                            $processes = Process::where('process_type_id', $processType->id)->get();

                            foreach($processes as $process){
                                $process->name = ProcessName::where('process_id', $process->id)->where('language_id', $language_id)->first()->name;
                                $transactions = \App\Transaction::where('process_id', $process->id)->get();

//                                dd($transactions);
                                foreach($transactions as $transaction){
                                    $transactionState = TransactionState::where('transaction_id', $transaction->id)->first();

                                    if($transactionState){
                                        $transactionState->t_state_created_at = $transactionState->created_at->format('d-m-y - H:i:s');
                                        $transactionState->name = TStateName::where('t_state_id', $transactionState->t_state_id)->where('language_id', $language_id)->first()->name;
                                    }

                                    $transaction->t_state_id =  $transactionState->t_state_id;
                                    $transaction->t_state_name =  $transactionState->name;
                                    $transaction->process_name = $process->name;
                                    $transaction->process_type_name = $processType->name;
                                    $transaction->transaction_type_name = $transactionType->t_name;
                                    $userInitatedTransactions->push($transaction);
                                }
                            }
                        }
                    }

                }
            }
        }
//IMPORTANTE -> VER MAIS TARDE
//        $get_user = Users::find($user_id);

//        if ($get_user->user_type === "external" && $get_user->entity_id !== "null")
//        {
//            $entity_id = $get_user->entity_id;
//            $iniciatorTransactions = $iniciatorTransactions->whereIn('process.updated_by', function ($query) use ($entity_id) {
//                $query->select('users.id')->from('users')->where('users.entity_id', '=', $entity_id);
//            });
//        }
//FIM IMPORTANTE
        return response()->json($userInitatedTransactions);
    }

    public function isUserInicOrExecOfTrans($id, $option = null,$userId,$langId)
    {
        $user_id = $userId;
        $url_text = $langId;
        $inicActorTrans = TransactionType::with(['iniciatorActor.role.user' => function($query) use ($user_id) {
            $query->where('user_id', $user_id);
        }, 'language' => function($query) use ($url_text) {
            $query->where('slug', $url_text);
        }])->whereHas('iniciatorActor.role.user', function ($query) use ($user_id){
            return $query->where('user_id', $user_id);
        })->where('id',$id)->get();

        $execActorTrans = TransactionType::with(['executerActor.role.user' => function($query) use ($user_id) {
            $query->where('user_id', $user_id);
        }, 'language' => function($query) use ($url_text) {
            $query->where('slug', $url_text);
        }])->whereHas('executerActor.role.user', function ($query) use ($user_id){
            return $query->where('user_id', $user_id);
        })->where('id',$id)->get();

        $arrayResult = array('isInicActorTrans' => !$inicActorTrans->isEmpty(), 'isExecActorTrans' => !$execActorTrans->isEmpty());

        if ($option === null)
            return response()->json($arrayResult);
        else
            return $arrayResult;
    }

    //verify if a specific transaction and t state is waiting for another transaction to continue/advance
    public function isTrAndStWaitingForAnotherTr(Request $request, $type=null, $trans_type_id=null, $process_id=null, $option = null)
    {
        if ($option === null)
        {
            $t_state_id = $request->input('t_state_id');
            $trans_id = $request->input('transaction_type_id');
            $proc_id = $request->input('process_id');
        }
        else
        {
            $t_state_id = $type;
            $trans_id = $trans_type_id;
            $proc_id = $process_id;
        }

        $waitinglinks = WaitingLink::where('waiting_t',$trans_id)->where('waiting_act',$t_state_id)->get();

        $existsAllTransactions = true;
        $transactionsLacking = array();
        \Log::debug("process_id ". $proc_id);
        if ($proc_id !== null) {
            if ($waitinglinks !== null) {
                foreach ($waitinglinks as $waitinglink) {
                    //\Log::debug($waitinglink);
                    foreach ($waitinglink->waitedT->processType->processes as $keyProcess => $valueProcess) {
                        //\Log::debug($valueProcess);
                        if ($valueProcess->id != $proc_id) {
                            $waitinglink->waitedT->processType->processes->forget($keyProcess);
                        } else {
                            foreach ($valueProcess->transactions as $keyTransaction => $valueTransaction) {
                                //obter apenas as transacções que são do tipo de transacção da waited t (transacção que tem de ser executada antes da waiting t)
                                if ($valueTransaction->transaction_type_id != $waitinglink->waitedT->id) //$value contem toda a informação do objecto id,etc
                                {
                                    $valueProcess->transactions->forget($keyTransaction);
                                } else {
                                    foreach ($valueTransaction->transactionStates as $keyTState => $valueTState) {
                                        if ($valueTState->t_state_id != $waitinglink->waited_act) {
                                            $valueTransaction->transactionStates->forget($keyTState);
                                        } else {
                                            /*if ($valueTState->entities->isEmpty()) {
                                                $valueProcess->transactions->forget($keyTransaction);
                                            }*/
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                foreach ($waitinglinks as $waitinglink) {
                    foreach ($waitinglink->waitedT->processType->processes as $keyProcess => $valueProcess) { //verificar a condição de waitinglink max
                        if ($valueProcess->transactions->count() >= $waitinglink->min) {
                            foreach ($valueProcess->transactions as $keyTransaction => $valueTransaction) {
                                if ($valueTransaction->transactionStates->isEmpty()) {
                                    $array = array(
                                        "transaction_type_id" => $waitinglink->waitedT->id,
                                        "t_state_id" => $waitinglink->waited_act
                                    );
                                    array_push($transactionsLacking, $array);
                                    $existsAllTransactions = false;
                                    break 2;
                                }
                            }
                        }
                        else
                        {
                            $array = array(
                                "transaction_type_id" => $waitinglink->waitedT->id,
                                "t_state_id" => $waitinglink->waited_act
                            );
                            array_push($transactionsLacking, $array);
                            $existsAllTransactions = false;
                            break 1; //o mesmo que break;
                        }
                    }

                    if ($waitinglink->waitedT->processType->processes->isEmpty()) {
                        /*$transactionsLacking = $this->array_push_assoc($transactionsLacking, 'transaction_type_id', $waitinglink->waitedT->id);
                        $transactionsLacking = $this->array_push_assoc($transactionsLacking, 't_state_id', $waitinglink->waited_act);*/
                        $array = array(
                            "transaction_type_id" => $waitinglink->waitedT->id,
                            "t_state_id" => $waitinglink->waited_act
                        );

                        array_push($transactionsLacking, $array);

                        $existsAllTransactions = false;
                    }
                }
            }
        }

        //\Log::debug($transactionsLacking);
        $transactionsLacking = $this->array_to_object($transactionsLacking);
        foreach ($transactionsLacking as $keyTransactionLacking => $transactionLacking)
        {
            //\Log::debug($transactionsLacking);
            $transactionLacking->transaction_type_name = TransactionTypeName::where('transaction_type_id','=',$transactionLacking->transaction_type_id)->where('language_id','=',$this->lang_id)->first()->t_name;
            $transactionLacking->t_state_name = TStateName::where('t_state_id','=',$transactionLacking->t_state_id)->where('language_id','=',$this->lang_id)->first()->name;
        }

        $data = array(
            'empty' => $existsAllTransactions,
            'dataTransactionsLacking' => $transactionsLacking,
            'data' => $waitinglinks
        );

        if ($option === null)
            return response()->json($data, $existsAllTransactions == false ? 400 : 200); //400 vai para o catch, 200 vai para o then
        else
            return $data;
    }

    public function isUserDelegatedOfTrans($id, $tstate, $option = null, $userId)
    {
        $user_id = $userId;

        $inicActorTrans = TransactionType::whereHas('iniciatorActor.role.delegates_role.delegated_role.user', function ($query) use ($user_id){
            return $query->where('user_id', $user_id);
        })->whereHas('iniciatorActor.role.delegates_role.t_state', function ($query) use ($tstate){
            return $query->where('id', $tstate);
        })
            ->where('id',$id)
            ->get();

        $execActorTrans = TransactionType::whereHas('executerActor.role.delegates_role.delegated_role.user', function ($query) use ($user_id){
            return $query->where('user_id', $user_id);
        })->whereHas('executerActor.role.delegates_role.t_state', function ($query) use ($tstate){
            return $query->where('id', $tstate);
        })
            ->where('id',$id)
            ->get();

        //return response()->json($execActorTrans);

        $arrayResult = array('isInicActorTrans' => !$inicActorTrans->isEmpty(), 'isExecActorTrans' => !$execActorTrans->isEmpty());
        //$arrayResult = array('isInicActorTrans' => $inicActorTrans, 'isExecActorTrans' => $execActorTrans);

        if ($option === null)
            return response()->json($arrayResult);
        else
            return $arrayResult;
    }

    //obtain all the actions from a specific transaction type id and t state id
    private function getActionsFromTState($t_state_id, $trans_type_id)
    {
        $actions = Action::with('arConditions.compEvaluatedExpressions.property1')
            ->with('arConditions.compEvaluatedExpressions.values1')
            ->with('arConditions.userEvaluatedExpressions')
            ->with('arConditions.compEvaluatedExpressions.property2')
            ->with('compEvaluatedExpressions.values1')
            ->with('compEvaluatedExpressions.property1')
            ->with('compEvaluatedExpressions.property2')
            ->with('causalLink.causedActionRule.tState')
            ->with('causalLink.causedActionRule.transactionType')
            ->whereHas('actionRule', function ($query) use ($t_state_id, $trans_type_id) {
                $query->where('t_state_id', $t_state_id)->where('transaction_type_id', $trans_type_id);
            })
            ->orderBy('order','asc')
            ->get();

        return $actions;
    }

    private function updateActionLogInActionAndTransaction($action_id, $transaction_id)
    {
        $action_log_existent = ActionLog::where('action_id', $action_id)
            ->where('transaction_id', $transaction_id)->first();
        if ($action_log_existent)
        {
            $action_log_existent->state = 'executed';
            $action_log_existent->save();
        }
    }

    private function my_operator($a, $b, $char) {
        switch($char) {
            case '=': return $a == $b;
            case '!=': return $a != $b;
            case '<': return $a < $b;
            case '>' : return $a > $b;
        }
    }

    //alterado já com as action rules
    public function getProps($transtype_id, $type, $proc_id, $option = null, $userId)
    {
        $url_text = $this->url_text;
        $user_id = $userId;

        //verify if the user is external or internal
        $getUser = User::find($user_id);

        //verify if the transaction_type_id and t_state_id have properties associated to the action
        $existPropertiesForAction = Property::whereHas('action.actionRule', function ($query) use ($type, $transtype_id) {
            return $query->where('t_state_id', $type)->where('transaction_type_id', $transtype_id);
        })
            ->get();

        $props = null;

        //if exists properties for that particular transaction_type_id and t_state
        //get all properties using the transaction_type_id and t_state_id
        if ($existPropertiesForAction->isNotEmpty()) {
            //get all properties using the transaction_type_id and t_state_id
            $props = Property::with(['entType' => function ($query) use ($transtype_id, $type) {
                $query->where('transaction_type_id', $transtype_id);
            }, 'entType.language' => function ($query) use ($url_text) {
                $query->where('slug', $url_text);
            }, 'language' => function ($query) use ($url_text) {
                $query->where('slug', $url_text);
            }, 'propAllowedValues.language' => function ($query) use ($url_text) {
                $query->where('slug', $url_text);
            }, 'propAllowedValues.entType', 'fkProperty.language' => function ($query) use ($url_text) {
                $query->where('slug', $url_text)->orderBy('name', 'asc');
            }, 'units.language' => function ($query) use ($url_text) {
                $query->where('slug', $url_text)->orderBy('name', 'asc');
            }, 'fkProperty.values' => function ($query) use ($getUser) {
                //$query->where('entity_id', $getUser->entity_id);
                if ($getUser->user_type == "external") {
                    $query->whereHas('updatedBy', function ($query) use ($getUser) {
                        return $query->where('entity_id', $getUser->entity_id);
                    });
                }
            }])->whereHas('action.actionRule', function ($query) use ($transtype_id, $type) {
                return $query->where('transaction_type_id', $transtype_id)->where('t_state_id', $type);
            })->orderBy('form_field_order', 'asc')->get();


            $data = array(
                'data' => $props
            );
        }
        else
        {
            $data = array(
                'data' => null
            );
        }

        if ($option === null)
            return response()->json($data, $data['data'] !== null ? 200 : 400);
        else
            return $data;
    }


    //analyze each action and deciding what to do next
    //for example, a action of type IF needs to be evaluated and goes to a THEN or a ELSE (if exists)
    //inside a action of type THEN there is one or more actions that are going to be executed on server or need user input
    //to complete/run/execute the action
    private function analyzeActions($actions, $trans_type_id, $t_state, $proc_id, $trans_id, $langId, $userId){
        $actionNext = new ActionN;
        $actionNextWanted = new ActionN;
        $dataFromActions = array();

        $actionsArr = $actions->toArray();
        foreach ($actions as $keyAction => $valueAction) {
            $dataFromActions['action_id'] = $valueAction->id;
            if (isset($actions[$keyAction+1])) {
                $dataFromActions['action_next_id'] = $actions[$keyAction+1]->id; // next element
            } else {
                $dataFromActions['action_next_id'] = null;
            }
            $dataFromActions['transaction_id'] = $trans_id;
            $dataFromActions['process_id'] = $proc_id;
            $dataFromActions['order'] = $valueAction->order;

            \Log::debug('keyaction ' . $keyAction . ' | ' . $valueAction->type);
            if (($valueAction->type === 'else' || $valueAction->type === 'then') && ($keyAction == 0)) {
                $par_action_id = $valueAction->id;
                unset($actions[$keyAction]);
                foreach ($actions as $keyActionRemoved => $valueActionRemoved) {
                    if ($valueActionRemoved->par_action_id === $par_action_id)
                        unset($actions[$keyActionRemoved]);
                }

                if ($actions->count() === 0) {
                    break;
                }
            }

            if (isset($par_action_id)) {
                if ($par_action_id === $valueAction->par_action_id || $par_action_id === $valueAction->id)
                    continue;
            }



            if ($actionNext->type !== null) {
                \Log::debug("VARIABLES IS NEXT ACTION WANTED -> " . $actionNext->type . ' | next action wanted -> ' . $actionNextWanted->type);
                $isNextActionWanted = $this->isNextActionWanted($actionNext, $actionNextWanted);
                \Log::debug("analyze actions ID -> " . $valueAction->id . ' | next action wanted -> ' .$isNextActionWanted);
                if (!$isNextActionWanted) {
                    \Log::debug("não é a action pretendida");
                    //(isset($actions[$keyAction+1]) || array_key_exists($keyAction+1, $actions))
                    if (array_key_exists($keyAction+1, $actionsArr))
                    {
                        $actionNext->type = $actions[$keyAction+1]->type;
                        $actionNext->par_action_id = $actions[$keyAction+1]->par_action_id;
                    }
                    //quer dizer que o else pode não existir logo deve continuar em frente.
                    continue;
                }
            }

            if ($actions->count() > 1) {
                if (array_key_exists($keyAction+1, $actionsArr)) {
                    $actionNext->type = $actions[$keyAction + 1]->type;
                    $actionNext->par_action_id = $actions[$keyAction+1]->par_action_id;
                    \Log::debug("entrou action next");
                }
            } else {
                $actionNext = null;
            }


//specify data -> criar nova transação

            switch($valueAction->type) {
                case 'if':
                    $results_ar_conditions = array();
                    \Log::debug("entrou if");

                    foreach ($valueAction->arConditions as $ar_condition)
                    {


                        if ($ar_condition->compEvaluatedExpressions !== null)
                        {
                            $property1_value = Value::where('property_id', $ar_condition->compEvaluatedExpressions[0]->property_id1)
                                ->whereHas('entity.transaction', function ($query) use ($proc_id) {
                                    $query->where('process_id', $proc_id);
                                })
                                ->first()->value;

                            if ($ar_condition->compEvaluatedExpressions[0]->property_id2 !== null)
                            {
                                $property2_value = Value::where('property_id', $ar_condition->compEvaluatedExpressions[0]->property_id2)
                                    ->whereHas('entity.transaction', function ($query) use ($proc_id) {
                                        $query->where('process_id', $proc_id);
                                    })
                                    ->first()->value;

                                \Log::debug($property1_value . " " . $ar_condition->compEvaluatedExpressions[0]->operator . " " . $property2_value);
                                //obter valor retornado da expressão, true ou false
                                $value_expression = $this->my_operator($property1_value, $property2_value, $ar_condition->compEvaluatedExpressions[0]->operator);
                            }
                            else //a comparação é feita entre o valor inserido no property id1 e value_id1 ou value
                            {
                                if ($ar_condition->compEvaluatedExpressions[0]->value_id1 !== null)
                                {
                                    $value = $ar_condition->compEvaluatedExpressions[0]->value_id1;
                                }
                                else
                                {
                                    $value = $ar_condition->compEvaluatedExpressions[0]->value1;
                                }

                                $value_expression = $this->my_operator($property1_value, $value, $ar_condition->compEvaluatedExpressions[0]->operator);
                            }

                            //adicionar os ands e ors no array
                            if (count($valueAction->arConditions) !== 1)
                            {
                                if ($ar_condition->type !== 'Comp Expression')
                                    array_push($results_ar_conditions, strtolower($ar_condition->type));
                            }

                            array_push($results_ar_conditions, intval($value_expression));
                        }
                        else //its informal expressions
                        {

                        }
                    }


                    \Log::debug($results_ar_conditions);

                    //verificar os ands e ors de todas as condições do IF
                    $complete_expression = '';
                    foreach ($results_ar_conditions as $result_ar_condition)
                    {
                        $complete_expression .= $result_ar_condition . ' ';
                    }

                    $language = new ExpressionLanguage();
                    $result = $language->evaluate($complete_expression);

                    //\Log::debug('RESULTADO = '. $complete_expression);
                    if ($result)
                        $actionNextWanted->type = 'then';
                    else
                        $actionNextWanted->type = 'else';

                    //\Log::debug('ACTION NEXT WANTED = '. $actionNextWanted->flow_type);
                    break;
                case 'specify_data':
                    $allProperties = $this->getProps($trans_type_id, $t_state, $proc_id, 1, $userId);
                    $dataFromActions['specify_data'] = $allProperties;
                    break 2;
                case 'C-ACT':
                    //dd("é c-act");
                    $causallinks = $this->getCausalLinksOfAction($valueAction->id);
                    $dataFromActions['C_ACT'] = $causallinks;
                    break 2;
                case 'WRITE_VALUE':
                    $dataFromActions['WRITE_VALUE'] = $valueAction->compEvaluatedExpressions;
                    break 2;
                case 'PRODUCE_DOCUMENT':
                    //produzir documento com o template
                    $action_template = $this->getTemplatesForAction($valueAction->id, $langId);

                    $data = array("action_id"=> $valueAction->id,
                        "action_template"=> $action_template->first(),
                        "transaction_id"=> $trans_id
                    );

                    $dataFromActions['PRODUCE_DOCUMENT'] = $data;
                    break 2;
                case 'then' || 'else':
                    \Log::debug("then | else");
                    $actionNextWanted->par_action_id = $valueAction->id;
                    $actionNextWanted->type = 'if|specify_data|C-ACT|WRITE_VALUE|PRODUCE_DOCUMENT';
                    break;
            }
        }

        return $dataFromActions;
    }

    //the system use the actions to determine the flow of them, in this function it's decided if the next action from the group
    // of actions is the expected one
    private function isNextActionWanted($actionNext, $actionNextWanted)
    {
        //dd(stristr($actionNextWanted->flow_type, $actionNext->flow_type));
        //\Log::debug('FUNCTION isnextactionwanted ACTION NEXT FLOW TYPE' . $actionNext->flow_type . ' | ACTION NEXT WANTED FLOW TYPE ' . $actionNextWanted->flow_type);
        if ((stristr($actionNextWanted->type, $actionNext->type) !== false)
            && $actionNext->par_action_id === $actionNextWanted->par_action_id
        )
        {
            \Log::debug('isnextactionwanted TRUE');
            return true;
        }

        return false;
    }

    //get all action templates from a specific action id
    private function getTemplatesForAction($action_id, $langId){
        $templatesAction = ActionTemplate::with(['language' => function($query)  use ($langId) {
            $query->where('language_id', $langId);
        }])
            ->where('action_id', $action_id)
            ->whereHas('language', function($query) use ($langId) {
                $query->where('language_id', $langId);
            })
            ->get();

        return $templatesAction;
    }

    private function saveTransactionsAndStateIntoDB($trans_type_id, $transaction_id, $process_id, $valueState){
        $paramsEmptyActions = array();
        $paramsEmptyActions['trans_type_id'] = $trans_type_id;
        $paramsEmptyActions['transaction_id'] = $transaction_id;
        $paramsEmptyActions['process_id'] = $process_id;
        $paramsEmptyActions['valueState'] = $valueState;
        $data1['emptyActions'] = $paramsEmptyActions;
        //inserir na tabela transaction uma instância e na transaction state
        //verificar se existe uma transaction e uma transaction state
        //verificar se existe uma entidade na entity, se nao existir, inserir
        //verificar se transaction_id é nulo então criar instância na transaction e na transaction state
        $data = $this->interpretActionsOnServer($data1);

        return $data;
    }

    public function startNewTransaction(Request $request){
        $States = Array(0=>'Initial', 1=>'Request', 2=>'Promise', 3=>'Execute', 4=>'State', 5=>'Accept');
        $trans_type_id = $request->input('id');
        $transaction_id = null;
        $action_id = null;
        $userId = $request->user()->id;
        $langId = $request->user()->language_id;
        //get the last transaction state with the last updated and t_state_id with a specific transaction id
//        $transaction_state = TransactionState::with('transaction')
////            ->where('transaction_id', $transaction_id)
////            ->orderBy('updated_at', 'desc')
////            ->orderBy('t_state_id', 'desc')
////            ->first();
        //if the transaction state doesnt exist then its the first state (initial) of the transaction
//        if (!$transaction_state)
//        {
            $t_state = array_search('Initial', $States);
            $process_id = $request->input('process_type_id'); //obtain the process id from input
//        }
//        else
//        {
//            //if the transaction state exists then obtain the last t_state, process id and action id
//            $t_state = $transaction_state->t_state_id;
//            $process_id = $transaction_state->transaction->process->id;
//            $action_id = $transaction_state->action_id;
//
//            //get the last action with type spec_data
//            $action_last = Action::where('type', 'specify_data')
//                ->where('id', $action_id)
//                ->first();
//
//            //if the transaction state dont have action_id filled in the database then the action last is considered to be null
//            // because we need the last action executed/opened on that specific transaction and if
//            // the field action_id on the transaction obtained above is null, then there isn't a last action
//            if ($transaction_state->action_id === null)
//            {
//                $action_last = null;
//            }
//
//            //if the last action is spec_data and the same action id is filled on the last transaction state then,
//            //there is a need to verify if the all the properties from spec_data are filled in the database
//            //$checkAllInputProperties = true;
//            if ($action_last)
//            {
//                //dd($action_last);
//                //get all properties with mandatory required and state active from a specific action id (the last action)
//                $all_props = Property::where('action_id', $action_last->id)
//                    ->where('mandatory', 1)
//                    ->where('state', 'active')
//                    ->get();
//
//                //get all the values that exists on the database for the properties obtain on the above query
//                $all_values_from_props = Value::whereHas('property', function ($query) use ($action_last) {
//                    $query->where('action_id', $action_last->id);
//                })
//                    ->whereHas('entity.transaction', function ($query) use ($process_id, $transaction_id) {
//                        $query->where('process_id', $process_id)->where('id', $transaction_id);
//                    })
//                    ->get();
//
//                //if the number of ocurrences of all the properties from spec_data and the number of ocurrences of
//                // values that already exists on the database for that specific properties are the same then
//                if ($all_props->count() <= $all_values_from_props->count())
//                {
//                    //dd("IGUAIS " . $all_props->count() . ' ' . $all_values_from_props->count());
//                    $checkAllInputProperties = true;
//                    $actionsCurTState = $this->getActionsFromTState($t_state, $trans_type_id); //get all the actions for the actual t_state_id
//                    //if the last action id from the group of actions for that specific t_state is the same of the actual action_id
//                    //then you need to advance to the next t_state
//                    //this happens because the actual action is the last action of this t_state_id,
//                    // so there isn't others actions and so you need to advance to the next t_state_id
//                    if ($actionsCurTState->last()->id === $action_id)
//                    {
//                        $t_state++;
//                    }
//                }
//                else
//                {
//                    //in this case, there are some properties that need to be filled by the user
//                    //this means that the form isn't completly filled
//                    //the variable $checkAllInputProperties is used later on the code
//                    //dd("DIFERENTES " . $all_props->count() . ' ' . $all_values_from_props->count());
//                    $checkAllInputProperties = false;
//                }
//            }
//            else
//            {
//                //get all actions for that particular transaction and t state
//                $actionsCurTState = $this->getActionsFromTState($t_state, $trans_type_id);
//                if ($actionsCurTState->isNotEmpty()) //if exists actions then verify if the last action from that group has the same
//                    //id as the action id from the transaction state
//                {
//                    if ($actionsCurTState->last()->id === $action_id) //this means that we already executed the last action for that
//                        //specific t state and we to advance to the next t state and obtain the others actions
//                    {
//                        $t_state++; //advance to the next t state
//                    }
//                }
//                else //that particular/actual transaction and t state doesnt have actions and so we need to advance to the next t state
//                {
//                    $t_state++; //advance to the next t state
//                }
//            }
//        }



        $arrayResultUserPermission = $this->isUserInicOrExecOfTrans($trans_type_id, 1,$userId,$langId);
        \Log::debug($t_state);
        $canAdvance = false;
        $numberOfTStates = array(); //number of tstate to execute
        $dataArray['actionsDone'] = array();

        if (($arrayResultUserPermission['isInicActorTrans'] === true) && ($arrayResultUserPermission['isExecActorTrans'] === true)
            && ($t_state <= 5)
        )
        {
            $canAdvance = true;
            $numberOfTStates = range($t_state, count($States)-1);
        }
        elseif (($arrayResultUserPermission['isInicActorTrans'] === true) && ($arrayResultUserPermission['isExecActorTrans'] === false)
            && ($t_state === 0 || $t_state === 1 || $t_state === 5))
        {
            $canAdvance = true;
            $numberOfTStates = range($t_state, $t_state === 0 ? 1 : $t_state);
        }
        elseif (($arrayResultUserPermission['isInicActorTrans'] === false) && ($arrayResultUserPermission['isExecActorTrans'] === true)
            && ($t_state >= 2 && $t_state <= 4))
        {
            $canAdvance = true;
            $numberOfTStates = range($t_state, count($States) - 2);
        }
        if ($canAdvance === false)
        {
            $arrayResultUserDelegatedPermission = $this->isUserDelegatedOfTrans($trans_type_id, $t_state, 1,$userId);
            if ($arrayResultUserDelegatedPermission['isInicActorTrans'] === true
                || $arrayResultUserDelegatedPermission['isExecActorTrans'] === true)
            {
                $canAdvance = true;
                $numberOfTStates = range($t_state, $t_state);
            }
            //return response()->json($teste);
        }

        foreach ($numberOfTStates as $keyState => $valueState) {
            //if the actual transaction needs informations from others transactions (waiting link)
            // the function returns data to a array
            $dataResult = $this->isTrAndStWaitingForAnotherTr(new Request, $valueState, $trans_type_id, $process_id, 1);

            //if the associative key "empty" is false, then the transaction needs to wait for others transactions
            // this means that the transaction can't advance to the next action or t state
            // send errors explaining that a transaction can't advance
            if ($dataResult['empty'] === false) {
                $dataResult['t_state_id'] = $valueState;
                $dataResult['t_state_name'] = TStateName::where('t_state_id', '=', $valueState)->where('language_id', '=', $langId)->first()->name;
                $dataResult['messageTab1'] = ("Can´t advance to the next task state"); //quando existe transacções a espera de outras através dos waiting links
                $dataResult['messageTab2'] = ("Missing Transaction Type:");
                $dataResult['messageTab3'] = ("State:");
                $dataResult['messageTabError'] = ("Error!"); //o titulo colocado na mensagem de erro do Growl
                $dataResult['messageTabSuccess'] = ("Success!"); //o titulo colocado na mensagem de sucesso do Growl
                $dataResult['messageTabSuccess1'] = ("Loading done successfully");

                array_push($dataArray, $dataResult);

                return response()->json($dataArray, 402);
            }
            else {//the actual transaction does not need to wait for others transactions
                // or there isn't waiting links associated to that transaction and t state
                //get all the actions for the actual transactions
                $actions = $this->getActionsFromTState($valueState, $trans_type_id);
                //if the action id obtained from the HTTP isn't null
                // then obtain the following actions and remove the current action and previous actions
                // and we get the next action that we are going to be using later on
                if ($action_id != null) {
                    //remove the current and the previous actions
                    $indexOfActionID = null;
                    foreach ($actions as $key => $value) {
                        if ($value->id == $action_id)
                            $indexOfActionID = $key;
                    }

                    if ($indexOfActionID !== null) {
                        //Here we use this variable that was previous defined to check if we need to
                        if (isset($checkAllInputProperties)) {
                            if ($checkAllInputProperties === true) {
                                $this->updateActionLogInActionAndTransaction($action_id, $transaction_id);
                                //remove the current and the previous actions
                                $actions = $actions->filter(function ($item, $key) use ($indexOfActionID) {
                                    return $key > $indexOfActionID;
                                });
                            } else {
                                //remove the previous actions and maintain the current action
                                $actions = $actions->filter(function ($item, $key) use ($indexOfActionID) {
                                    return $key >= $indexOfActionID;
                                });
                            }
                        } else {
                            //update action log for others actions except spec_data action
                            $this->updateActionLogInActionAndTransaction($action_id, $transaction_id);

                            //remove the current and the previous actions
                            $actions = $actions->filter(function ($item, $key) use ($indexOfActionID) {
                                return $key > $indexOfActionID;
                            });
                        }
                        $actions = $actions->values(); //rearrange the array indexes
                        \Log::debug("ACTIONS FILTERED" . $actions); //testing log
                    }
                }
                //if for this particular transaction and t state there isn't actions we need to save the state into the table
                // transaction state, this means that we executed this step before and we can keep
                // a log of what t states we already executed/opened
                if ($actions->isEmpty()) {
                    $data = $this->saveTransactionsAndStateIntoDB($trans_type_id, $transaction_id, $process_id, $valueState);
                    array_push($dataArray['actionsDone'], $data['actionsDone']);
                    //update the variables values with the new values obtained from the function interpretactionserver
                    $transaction_id = $data['emptyActions']['transaction_id'];
                    $process_id = $data['emptyActions']['process_id'];
                    $action_id = null;
                    unset($data['emptyActions']);
                } else {//if the actions ins't empty, we interpret, analyze and in some cases execute the actions
                    // a action can be executed on the server without user input or wait for input from the user using the frontend interface
//                    dd("Estou Aqui 884");
                    $data1 = $this->analyzeActions($actions, $trans_type_id, $valueState, $process_id, $transaction_id, $langId, $userId);

                    //execute and interpret the actions and return the ones that need user input to get finished
                    $data = $this->interpretActionsOnServer($data1);

                    //se o action a verificar é um prod_doc desnecessário ir buscar o action template porque este já é obtido no interpretactionsserver
                    //if the current action is prod_doc, there is no need to get the action template because it's exists already
                    // if the current action isn't prod_doc we need to check if there is action templates associated to the current action
                    $action_cur = Action::where('id', $data['action_id'])->first();
                    if ($action_cur->type !== 'PRODUCE_DOCUMENT')
                        //get the actions templates for the current action
                        $dataArray['actionTemplates'] = $this->getTemplatesForAction($data['action_id'], $langId);

                    //only for testing purposes, the actionsDone array just have alerts/notifications
                    // of the actions done/executed by the server in the function interpretactionsonserver
                    if (empty($data['actionsDone'])) {
                        unset($data['actionsDone']);
                    }
                    else {//if there is actions executed on server by the function interpretactionsonserver,
                        // we should add the returned array actionsDone to the array named $dataArray
                        array_push($dataArray['actionsDone'], $data['actionsDone']);
                        $dataArray['actionsDone'] = $this->arrayOfArrayToArrayOfObjects($dataArray['actionsDone']);
                        unset($data['actionsDone']);
                    }

                    //update the associative values of the global variables that are returned to the angularjs HTTP
                    $dataArray['action_id'] = $data['action_id'];
                    $dataArray['order'] = $data['order'];
                    $dataArray['t_state_id'] = $valueState;
                    $dataArray['transaction_id'] = $transaction_id;


                    //dd($data1['action_next_id']);
                    //dd(!isset($numberOfTStates[$keyState+1]));
                    if ($data1['action_next_id'] === null){ //and if in the next t state doesnt exist actions
                        //if there isn't another t state to advance inside the $numberOfTStates array, or
                        // the actual action used isn't a spec_data, c_act e prod_doc
                        // we must return the status 405 indicating that the actual transaction is finished (no more t states or actions)
                        if (!array_key_exists($keyState+1, $numberOfTStates) && !array_key_exists("specify_data", $data) && !array_key_exists("C_ACT", $data) && !array_key_exists("PRODUCE_DOCUMENT", $data))
                            return response()->json($dataArray, 405);
                    }

                    //we must return the status 403 indicating to the frontend (angularjs) that we need to advance to the next action/modal
                    // automatically using recursion
                    if (!array_key_exists("specify_data", $data) && !array_key_exists("C_ACT", $data) && !array_key_exists("PRODUCE_DOCUMENT", $data))
                        return response()->json($dataArray, 403);

                    //send customized messages to the frontend
                    $data['t_state_name'] = TStateName::where('t_state_id', '=', $valueState)->where('language_id', '=', $langId)->first()->name;
                    $data['messageTabSuccess'] = ("Success!"); //o titulo colocado na mensagem de sucesso do Growl
                    $data['messageTabSuccess1'] = ("Loading done successfully");
                    $data['titleTab'] = ("Task Step");

                    //only for testing purposes
                    //insert values that already exists on the database and fill the properties (form)
                    if (isset($checkAllInputProperties)) {
                        if ($checkAllInputProperties === false)
                        {
                            //get the values of the properties already filled
                            foreach ($data['specify_data']['data'] as $keyProp => $valueProp)
                            {
                                $objName = $valueProp->language[0]->pivot->form_field_name . '-' . $valueProp->id;

                                $prop_value = Value::where('property_id', $valueProp->id)
                                    ->whereHas('entity.transaction', function ($query) use ($process_id, $transaction_id) {
                                        $query->where('process_id', $process_id)->where('id', $transaction_id);
                                    })
                                    ->first();

                                if ($prop_value)
                                    $valueProp['fields'] = (object) array($objName => is_numeric($prop_value->value) ? (int)$prop_value->value : $prop_value->value);
                            }
                        }
                    }

                    $dataArray['actionsToDo'] = $data;

                    break;
                }
            }
        }

        //if associative key of array actionsDone isn't empty then convert all values of array to only objects
        if (!empty($dataArray['actionsDone']))
        {
            //convert array to array of objects
            $dataArray['actionsDone'] = $this->arrayOfArrayToArrayOfObjects($dataArray['actionsDone']);
        }

        //if there is no action from type spec_data, c_act or prod_doc then there is no need to wait from user input,
        // all actions done on server
        if (!array_key_exists("specify_data", $data) && !array_key_exists("C_ACT", $data) && !array_key_exists("PRODUCE_DOCUMENT", $data))
            return response()->json($dataArray, 405);
        else
            return response()->json($dataArray);

    }



































    public function nextActionFromTransTypeTState(Request $request)
    {
        $States = Array(0=>'Initial', 1=>'Request', 2=>'Promise', 3=>'Execute', 4=>'State', 5=>'Accept');

        //get inputs data from angularjs http
        $trans_type_id = $request->input('trans_type_id');
        $transaction_id = $request->input('trans_id');
        $action_id = null;

        //get the last transaction state with the last updated and t_state_id with a specific transaction id
        $transaction_state = TransactionState::with('transaction')
            ->where('transaction_id', $transaction_id)
            ->orderBy('updated_at', 'desc')
            ->orderBy('t_state_id', 'desc')
            ->first();

        //if the transaction state doesnt exist then its the first state (initial) of the transaction
        if (!$transaction_state)
    {
        $t_state = array_search('Initial', $States);
        $process_id = $request->input('process_id'); //obtain the process id from input
    }
    else
    {
        //if the transaction state exists then obtain the last t_state, process id and action id
        $t_state = $transaction_state->t_state_id;
        $process_id = $transaction_state->transaction->process->id;
        $action_id = $transaction_state->action_id;

        //get the last action with type spec_data
        $action_last = Action::where('type', 'specify_data')
            ->where('id', $action_id)
            ->first();

        //if the transaction state dont have action_id filled in the database then the action last is considered to be null
        // because we need the last action executed/opened on that specific transaction and if
        // the field action_id on the transaction obtained above is null, then there isn't a last action
        if ($transaction_state->action_id === null)
        {
            $action_last = null;
        }

        //if the last action is spec_data and the same action id is filled on the last transaction state then,
        //there is a need to verify if the all the properties from spec_data are filled in the database
        //$checkAllInputProperties = true;
        if ($action_last)
        {
            //dd($action_last);
            //get all properties with mandatory required and state active from a specific action id (the last action)
            $all_props = Property::where('action_id', $action_last->id)
                ->where('mandatory', 1)
                ->where('state', 'active')
                ->get();

            //get all the values that exists on the database for the properties obtain on the above query
            $all_values_from_props = Value::whereHas('property', function ($query) use ($action_last) {
                $query->where('action_id', $action_last->id);
            })
                ->whereHas('entity.transaction', function ($query) use ($process_id, $transaction_id) {
                    $query->where('process_id', $process_id)->where('id', $transaction_id);
                })
                ->get();

            //if the number of ocurrences of all the properties from spec_data and the number of ocurrences of
            // values that already exists on the database for that specific properties are the same then
            if ($all_props->count() <= $all_values_from_props->count())
            {
                //dd("IGUAIS " . $all_props->count() . ' ' . $all_values_from_props->count());
                $checkAllInputProperties = true;
                $actionsCurTState = $this->getActionsFromTState($t_state, $trans_type_id); //get all the actions for the actual t_state_id
                //if the last action id from the group of actions for that specific t_state is the same of the actual action_id
                //then you need to advance to the next t_state
                //this happens because the actual action is the last action of this t_state_id,
                // so there isn't others actions and so you need to advance to the next t_state_id
                if ($actionsCurTState->last()->id === $action_id)
                {
                    $t_state++;
                }
            }
            else
            {
                //in this case, there are some properties that need to be filled by the user
                //this means that the form isn't completly filled
                //the variable $checkAllInputProperties is used later on the code
                //dd("DIFERENTES " . $all_props->count() . ' ' . $all_values_from_props->count());
                $checkAllInputProperties = false;
            }
        }
        else
        {
            //get all actions for that particular transaction and t state
            $actionsCurTState = $this->getActionsFromTState($t_state, $trans_type_id);
            if ($actionsCurTState->isNotEmpty()) //if exists actions then verify if the last action from that group has the same
                //id as the action id from the transaction state
            {
                if ($actionsCurTState->last()->id === $action_id) //this means that we already executed the last action for that
                    //specific t state and we to advance to the next t state and obtain the others actions
                {
                    $t_state++; //advance to the next t state
                }
            }
            else //that particular/actual transaction and t state doesnt have actions and so we need to advance to the next t state
            {
                $t_state++; //advance to the next t state
            }
        }
    }

        //verify if the user is initiator and/or executer of the actual transaction type
        $arrayResultUserPermission = $this->isUserInicOrExecOfTrans($trans_type_id, 1);
        \Log::debug($t_state);
        $canAdvance = false;
        $numberOfTStates = array(); //number of tstate to execute
        $dataArray['actionsDone'] = array();
        //$dataArray['actionsToDo'] = array();
        /*\Log::debug($arrayResultUserPermission);
        \Log::debug($t_state);*/
        //if the actual t state and the user permissions for that specific transaction type id and
        //decide if the user have permission to manage, alter or advance
        if (($arrayResultUserPermission['isInicActorTrans'] === true) && ($arrayResultUserPermission['isExecActorTrans'] === true)
            && ($t_state <= 5)
        )
        {
            $canAdvance = true;
            $numberOfTStates = range($t_state, count($States)-1);
        }
        elseif (($arrayResultUserPermission['isInicActorTrans'] === true) && ($arrayResultUserPermission['isExecActorTrans'] === false)
            && ($t_state === 0 || $t_state === 1 || $t_state === 5))
        {
            $canAdvance = true;
            $numberOfTStates = range($t_state, $t_state === 0 ? 1 : $t_state);
        }
        elseif (($arrayResultUserPermission['isInicActorTrans'] === false) && ($arrayResultUserPermission['isExecActorTrans'] === true)
            && ($t_state >= 2 && $t_state <= 4))
        {
            $canAdvance = true;
            $numberOfTStates = range($t_state, count($States) - 2);
        }

        if ($canAdvance === false)
        {
            $arrayResultUserDelegatedPermission = $this->isUserDelegatedOfTrans($trans_type_id, $t_state, 1);
            if ($arrayResultUserDelegatedPermission['isInicActorTrans'] === true
                || $arrayResultUserDelegatedPermission['isExecActorTrans'] === true)
            {
                $canAdvance = true;
                $numberOfTStates = range($t_state, $t_state);
            }
            //return response()->json($teste);
        }

        // if the user cant advance then it should throw an message and return the http status 401
        if ($canAdvance === false)
        {
            $dataArray['msg'] = "You don't have permissions to access this transaction state!!!";
            return response()->json($dataArray, 401);
        }

        //\Log::debug('number tstates', $numberOfTStates);
        foreach ($numberOfTStates as $keyState => $valueState) {
            //if the actual transaction needs informations from others transactions (waiting link)
            // the function returns data to a array
            $dataResult = $this->isTrAndStWaitingForAnotherTr(new Request, $valueState, $trans_type_id, $process_id, 1);

            //\Log::debug($dataResult);
            //
            //if the associative key "empty" is false, then the transaction needs to wait for others transactions
            // this means that the transaction can't advance to the next action or t state
            // send errors explaining that a transaction can't advance
            if ($dataResult['empty'] === false) {
                $dataResult['t_state_id'] = $valueState;
                $dataResult['t_state_name'] = TStateName::where('t_state_id', '=', $valueState)->where('language_id', '=', $this->lang_id)->first()->name;
                $dataResult['messageTab1'] = trans("dashboard/modal.Can´t advance to the next task state"); //quando existe transacções a espera de outras através dos waiting links
                $dataResult['messageTab2'] = trans("dashboard/modal., missing Transaction Type:");
                $dataResult['messageTab3'] = trans("dashboard/modal.__ State:");
                $dataResult['messageTabError'] = trans("dashboard/modal.Error!"); //o titulo colocado na mensagem de erro do Growl
                $dataResult['messageTabSuccess'] = trans("dashboard/modal.Success!"); //o titulo colocado na mensagem de sucesso do Growl
                $dataResult['messageTabSuccess1'] = trans("dashboard/modal.Loading done successfully");

                array_push($dataArray, $dataResult);

                return response()->json($dataArray, 402);
            }
            else //the actual transaction does not need to wait for others transactions
                // or there isn't waiting links associated to that transaction and t state
            {
                //get all the actions for the actual transactions
                $actions = $this->getActionsFromTState($valueState, $trans_type_id);

                /*if ($actions->isNotEmpty() && $valueState === 4)
                    return response()->json($actions);*/

                /*\Log::debug("ACTION ID NOT NULL" . $action_id);
                \Log::debug("value state" . $valueState);*/
                /*if ($valueState === 4)
                    return response()->json($actions);*/
                //if the action id obtained from the HTTP isn't null
                // then obtain the following actions and remove the current action and previous actions
                // and we get the next action that we are going to be using later on
                if ($action_id != null)
                {
                    //remove the current and the previous actions
                    $indexOfActionID = null;
                    foreach ($actions as $key => $value) {
                        if ($value->id == $action_id)
                            $indexOfActionID = $key;
                    }

                    //\Log::debug("INDEX OF ACTION ID" . $indexOfActionID);
                    if ($indexOfActionID !== null)
                    {
                        //Here we use this variable that was previous defined to check if we need to
                        if (isset($checkAllInputProperties))
                        {
                            if ($checkAllInputProperties === true)
                            {
                                $this->updateActionLogInActionAndTransaction($action_id, $transaction_id);

                                //remove the current and the previous actions
                                $actions = $actions->filter(function ($item, $key) use ($indexOfActionID) {
                                    return $key > $indexOfActionID;
                                });
                            }
                            else
                            {
                                //remove the previous actions and maintain the current action
                                $actions = $actions->filter(function ($item, $key) use ($indexOfActionID) {
                                    return $key >= $indexOfActionID;
                                });
                            }
                        }
                        else
                        {
                            //update action log for others actions except spec_data action
                            $this->updateActionLogInActionAndTransaction($action_id, $transaction_id);

                            //remove the current and the previous actions
                            $actions = $actions->filter(function ($item, $key) use ($indexOfActionID) {
                                return $key > $indexOfActionID;
                            });
                        }
                        //dd($action_id);
                        $actions = $actions->values(); //rearrange the array indexes
                        \Log::debug("ACTIONS FILTERED" . $actions); //testing log
                    }

                    /*if ($valueState === 4)
                        return response()->json($actions);*/
                    //\Log::debug("ACTION ID nao é nulo ->" . $actions);
                    //return response()->json($actions);
                }

                //\Log::debug($actions);
                //if for this particular transaction and t state there isn't actions we need to save the state into the table
                // transaction state, this means that we executed this step before and we can keep
                // a log of what t states we already executed/opened
                if ($actions->isEmpty())
                {
                    $data = $this->saveTransactionsAndStateIntoDB($trans_type_id, $transaction_id, $process_id, $valueState);
                    array_push($dataArray['actionsDone'], $data['actionsDone']);
                    //update the variables values with the new values obtained from the function interpretactionserver
                    $transaction_id = $data['emptyActions']['transaction_id'];
                    $process_id = $data['emptyActions']['process_id'];
                    $action_id = null;
                    unset($data['emptyActions']);

                    /*if (isset($numberOfTStates[$keyState+1]))
                    {
                        return response()->json($dataArray, 405);
                    }*/
                    //return response()->json($dataArray, 403);
                    /*$data['process_id'] = $process_id;
                    $data['transaction_id'] = $transaction_id;*/
                }
                else //if the actions ins't empty, we interpret, analyze and in some cases execute the actions
                    // a action can be executed on the server without user input or wait for input from the user using the frontend interface
                {
                    $data1 = $this->analyzeActions($actions, $trans_type_id, $valueState, $process_id, $transaction_id);

                    //return response()->json($data1, 403);

                    //execute and interpret the actions and return the ones that need user input to get finished
                    $data = $this->interpretActionsOnServer($data1);

                    //se o action a verificar é um prod_doc desnecessário ir buscar o action template porque este já é obtido no interpretactionsserver
                    //if the current action is prod_doc, there is no need to get the action template because it's exists already
                    // if the current action isn't prod_doc we need to check if there is action templates associated to the current action
                    $action_cur = Action::where('id', $data['action_id'])->first();
                    if ($action_cur->type !== 'PRODUCE_DOCUMENT')
                        //get the actions templates for the current action
                        $dataArray['actionTemplates'] = $this->getTemplatesForAction($data['action_id']);

                    //only for testing purposes, the actionsDone array just have alerts/notifications
                    // of the actions done/executed by the server in the function interpretactionsonserver
                    if (empty($data['actionsDone']))
                    {
                        unset($data['actionsDone']);
                    }
                    else //if there is actions executed on server by the function interpretactionsonserver,
                        // we should add the returned array actionsDone to the array named $dataArray
                    {
                        array_push($dataArray['actionsDone'], $data['actionsDone']);
                        $dataArray['actionsDone'] = $this->arrayOfArrayToArrayOfObjects($dataArray['actionsDone']);
                        unset($data['actionsDone']);
                    }

                    //update the associative values of the global variables that are returned to the angularjs HTTP
                    $dataArray['action_id'] = $data['action_id'];
                    $dataArray['order'] = $data['order'];
                    $dataArray['t_state_id'] = $valueState;
                    $dataArray['transaction_id'] = $transaction_id;

                    //dd($data1['action_next_id']);
                    //dd(!isset($numberOfTStates[$keyState+1]));
                    if ($data1['action_next_id'] === null) //and if in the next t state doesnt exist actions
                    {
                        /*dd($keyState); //keyState is 1
                        dd(array_key_exists($keyState+1, $numberOfTStates));*/
                        //if there isn't another t state to advance inside the $numberOfTStates array, or
                        // the actual action used isn't a spec_data, c_act e prod_doc
                        // we must return the status 405 indicating that the actual transaction is finished (no more t states or actions)
                        if (!array_key_exists($keyState+1, $numberOfTStates) && !array_key_exists("specify_data", $data) && !array_key_exists("C_ACT", $data) && !array_key_exists("PRODUCE_DOCUMENT", $data))
                            return response()->json($dataArray, 405);
                        //$actions = $this->getActionsFromTState($numberOfTStates[$keyState+1], $trans_type_id);
                    }

                    //we must return the status 403 indicating to the frontend (angularjs) that we need to advance to the next action/modal
                    // automatically using recursion
                    if (!array_key_exists("specify_data", $data) && !array_key_exists("C_ACT", $data) && !array_key_exists("PRODUCE_DOCUMENT", $data))
                        return response()->json($dataArray, 403);

                    //send customized messages to the frontend
                    $data['t_state_name'] = TStateName::where('t_state_id', '=', $valueState)->where('language_id', '=', $this->lang_id)->first()->name;
                    $data['messageTabSuccess'] = trans("dashboard/modal.Success!"); //o titulo colocado na mensagem de sucesso do Growl
                    $data['messageTabSuccess1'] = trans("dashboard/modal.Loading done successfully");

                    /*if (array_key_exists("spec_data", $data) || array_key_exists("c_act", $data)) {
                        $data['titleTab'] = trans("dashboard/modal.Task Step");
                    }*/
                    $data['titleTab'] = trans("dashboard/modal.Task Step");

                    //only for testing purposes
                    //insert values that already exists on the database and fill the properties (form)
                    if (isset($checkAllInputProperties))
                    {
                        if ($checkAllInputProperties === false)
                        {
                            //get the values of the properties already filled
                            foreach ($data['specify_data']['data'] as $keyProp => $valueProp)
                            {
                                $objName = $valueProp->language[0]->pivot->form_field_name . '-' . $valueProp->id;

                                $prop_value = Value::where('property_id', $valueProp->id)
                                    ->whereHas('entity.transaction', function ($query) use ($process_id, $transaction_id) {
                                        $query->where('process_id', $process_id)->where('id', $transaction_id);
                                    })
                                    ->first();

                                if ($prop_value)
                                    $valueProp['fields'] = (object) array($objName => is_numeric($prop_value->value) ? (int)$prop_value->value : $prop_value->value);
                            }
                        }
                    }

                    $dataArray['actionsToDo'] = $data;

                    break;
                }
            }
        }

        //if associative key of array actionsDone isn't empty then convert all values of array to only objects
        if (!empty($dataArray['actionsDone']))
        {
            //convert array to array of objects
            $dataArray['actionsDone'] = $this->arrayOfArrayToArrayOfObjects($dataArray['actionsDone']);
        }

        //if there is no action from type spec_data, c_act or prod_doc then there is no need to wait from user input,
        // all actions done on server
        if (!array_key_exists("specify_data", $data) && !array_key_exists("C_ACT", $data) && !array_key_exists("PRODUCE_DOCUMENT", $data))
            return response()->json($dataArray, 405);
        else
            return response()->json($dataArray);
    }




















    public function getAllInicExecTrans(Request $request)
    {
        $userId = $request->user()->id;
        $langId = $request->user()->language_id;

        $transactionsAll_unfinished = new \App\CustomClass\TasksPanel(
            $userId,
            $langId,
            0
        );

        $transactionsAll_finished = new \App\CustomClass\TasksPanel(
            $userId,
            $langId,
            1
        );

        dd($transactionsAll_unfinished);

        foreach ($transactionsAll_unfinished->all_transactions_unfinished as $transaction)
        {
            $new_transaction = new \App\CustomClass\Transaction(
                $transaction->max_t_state_id,
                $transaction->transaction_type_id,
                $transaction->transaction_id,
                $userId,
                $langId
            );

            $transaction->action = $new_transaction->next_action;
            $transaction->action_state = $new_transaction->action_state;
            $transaction->action_id = $new_transaction->cur_action_id;
        }

        //dd($transactionsAll_finished);

        $returnData = array(
            'AllTrans' => $transactionsAll_unfinished->all_transactions_unfinished,
            'AllTransCompleted' => $transactionsAll_finished->all_transactions_finished
        );

        return response()->json($returnData);
    }

    private function getAllInicTrans()
    {
            $user_id = $this->user_id;

            $get_user = Users::find($user_id);

            $iniciatorTransactions = DB::table('transaction')
                ->join('transaction_state', 'transaction_state.transaction_id', '=', 'transaction.id')
                ->join('t_state', 't_state.id', '=', 'transaction_state.t_state_id')
                ->join('t_state_name', 't_state.id', '=', 't_state_name.t_state_id')
                ->join('process', 'transaction.process_id', '=', 'process.id')
                ->join('process_type', 'process_type.id', '=', 'process.process_type_id')
                ->join('transaction_type', 'transaction_type.id', '=', 'transaction.transaction_type_id')
                ->join('actor_iniciates_t', 'actor_iniciates_t.transaction_type_id', '=', 'transaction_type.id')
                ->select('process_type.id as process_type_id','process.id as process_id','transaction.id as transaction_id',
                    DB::raw('max(t_state.id) as max_t_state_id'),
                    'transaction_type.id as transaction_type_id')
                ->where('t_state_name.language_id','=', $this->lang_id)
                ->whereIn('actor_iniciates_t.actor_id', function ($query) use ($user_id) {
                    $query->select('actor_id')->from('role_has_actor')
                        ->whereIn('role_id',function ($query) use ($user_id) {
                            $query->select('role_id')->from('role_has_user')
                                ->where('user_id', '=', $user_id);
                        });
                });

            if ($get_user->user_type === "external" && $get_user->entity_id !== "null")
            {
                $entity_id = $get_user->entity_id;
                $iniciatorTransactions = $iniciatorTransactions->whereIn('process.updated_by', function ($query) use ($entity_id) {
                    $query->select('users.id')->from('users')->where('users.entity_id', '=', $entity_id);
                });
            }
            $iniciatorTransactions =  $iniciatorTransactions->groupBy('transaction_type_id','transaction_id','process_id','process_type_id')
                ->get();

            foreach($iniciatorTransactions as $iniciatorTransaction)
            {
                $iniciatorTransaction->process_type_name = ProcessTypeName::where('process_type_id','=',$iniciatorTransaction->process_type_id)->where('language_id','=',$this->lang_id)->first()->name;
                $iniciatorTransaction->process_name = ProcessName::where('process_id','=',$iniciatorTransaction->process_id)->where('language_id','=',$this->lang_id)->first()->name;
                $iniciatorTransaction->t_name = TransactionTypeName::where('transaction_type_id','=',$iniciatorTransaction->transaction_type_id)->where('language_id','=',$this->lang_id)->first()->t_name;
                $iniciatorTransaction->created_at = TransactionState::where('transaction_id','=',$iniciatorTransaction->transaction_id)->latest()->first()->created_at->format('d-m-y - H:i:s');
            }

            return $iniciatorTransactions;
    }

    private function getAllExecTrans()
    {
            $user_id = $this->user_id;

            $get_user = Users::find($user_id);

            $executerTransactions = DB::table('transaction')
                ->join('transaction_state', 'transaction_state.transaction_id', '=', 'transaction.id')
                ->join('t_state', 't_state.id', '=', 'transaction_state.t_state_id')
                ->join('t_state_name', 't_state.id', '=', 't_state_name.t_state_id')
                ->join('process', 'transaction.process_id', '=', 'process.id')
                ->join('process_type', 'process_type.id', '=', 'process.process_type_id')
                ->join('transaction_type', 'transaction_type.id', '=', 'transaction.transaction_type_id')
                ->select('process_type.id as process_type_id','process.id as process_id', 'transaction.id as transaction_id',
                    DB::raw('max(t_state.id) as max_t_state_id'),
                    'transaction_type.id as transaction_type_id')
                ->where('t_state_name.language_id','=', $this->lang_id)
                ->whereIn('transaction_type.executer', function ($query) use ($user_id) {
                    $query->select('actor_id')->from('role_has_actor')
                        ->whereIn('role_id',function ($query) use ($user_id) {
                            $query->select('role_id')->from('role_has_user')
                                ->where('user_id', '=', $user_id);
                        });
                });

            if ($get_user->user_type === "external" && $get_user->entity_id !== "null")
            {
                $entity_id = $get_user->entity_id;
                $executerTransactions = $executerTransactions->whereIn('process.updated_by', function ($query) use ($entity_id) {
                    $query->select('users.id')->from('users')->where('users.entity_id', '=', $entity_id);
                });
            }
            $executerTransactions =  $executerTransactions->groupBy('transaction_type_id','transaction_id','process_id','process_type_id')
                ->get();

            foreach($executerTransactions as $executerTransaction)
            {
                $executerTransaction->process_type_name = ProcessTypeName::where('process_type_id','=',$executerTransaction->process_type_id)->where('language_id','=',$this->lang_id)->first()->name;
                $executerTransaction->process_name = ProcessName::where('process_id','=',$executerTransaction->process_id)->where('language_id','=',$this->lang_id)->first()->name;
                $executerTransaction->t_name = TransactionTypeName::where('transaction_type_id','=',$executerTransaction->transaction_type_id)->where('language_id','=',$this->lang_id)->first()->t_name;
                $executerTransaction->created_at = TransactionState::where('transaction_id','=',$executerTransaction->transaction_id)->latest()->first()->created_at->format('d-m-y - H:i:s');
            }

            return $executerTransactions;
    }

    private function getAllDelegatedTrans()
    {
        $user_id = $this->user_id;
        $get_user = Users::find($user_id);
        $delegatedTransactions = DB::table('transaction')
            ->join('transaction_state', 'transaction_state.transaction_id', '=', 'transaction.id')
            ->join('t_state', 't_state.id', '=', 'transaction_state.t_state_id')
            ->join('t_state_name', 't_state.id', '=', 't_state_name.t_state_id')
            ->join('process', 'transaction.process_id', '=', 'process.id')
            ->join('process_type', 'process_type.id', '=', 'process.process_type_id')
            ->join('transaction_type', 'transaction_type.id', '=', 'transaction.transaction_type_id')
            ->join('actor_iniciates_t', 'actor_iniciates_t.transaction_type_id', '=', 'transaction_type.id')
            ->select('process_type.id as process_type_id','process.id as process_id','transaction.id as transaction_id',
                DB::raw('max(t_state.id) as max_t_state_id'),
                'transaction_type.id as transaction_type_id')
            ->where('t_state_name.language_id','=', $this->lang_id)
            ->whereIn('actor_iniciates_t.actor_id', function ($query) use ($user_id) {
                $query->select('actor_id')->from('role_has_actor')
                    ->whereIn('role_id',function ($query) use ($user_id) {
                        $query->select('role_id')->from('role_has_user')
                            ->where('user_id', '=', $user_id);
                    });
            })
            ->orWhereIn('transaction_type.executer', function ($query) use ($user_id) {
                $query->select('actor_id')->from('role_has_actor')
                    ->whereIn('role_id',function ($query) use ($user_id) {
                        $query->select('role_id')->from('role_has_user')
                            ->where('user_id', '=', $user_id);
                    });
            });

        if ($get_user->user_type === "external" && $get_user->entity_id !== "null")
        {
            $entity_id = $get_user->entity_id;
            $delegatedTransactions = $delegatedTransactions->whereIn('process.updated_by', function ($query) use ($entity_id) {
                $query->select('users.id')->from('users')->where('users.entity_id', '=', $entity_id);
            });
        }
        $delegatedTransactions =  $delegatedTransactions->groupBy('transaction_type_id','transaction_id','process_id','process_type_id')
            ->get();

        foreach($delegatedTransactions as $delegatedTransaction)
        {
            $delegatedTransaction->process_type_name = ProcessTypeName::where('process_type_id','=',$delegatedTransaction->process_type_id)->where('language_id','=',$this->lang_id)->first()->name;
            $delegatedTransaction->process_name = ProcessName::where('process_id','=',$delegatedTransaction->process_id)->where('language_id','=',$this->lang_id)->first()->name;
            $delegatedTransaction->t_name = TransactionTypeName::where('transaction_type_id','=',$delegatedTransaction->transaction_type_id)->where('language_id','=',$this->lang_id)->first()->t_name;
            $delegatedTransaction->created_at = TransactionState::where('transaction_id','=',$delegatedTransaction->transaction_id)->latest()->first()->created_at->format('d-m-y - H:i:s');
        }

        return $delegatedTransactions;
    }

    //not used with action rules in dashboard
    function uploadFile($fileData64)
    {
        //get the base-64 from data
        $dataFile = $fileData64->data;

        $dataOriginalFileName = $fileData64->fileName;

        $unique_name = md5($dataOriginalFileName . microtime());

        list($type, $dataFile) = explode(';', $dataFile);
        list(, $dataFile) = explode(',', $dataFile);
        $dataFile = base64_decode($dataFile);
        $fileTypeArray = explode('.', $dataOriginalFileName);
        $fileType = $fileTypeArray[count($fileTypeArray)-1];
        $fileNameTypeOriginal = $unique_name . '.' . $fileType;
        Storage::disk('local')->put('public/' . $fileNameTypeOriginal, $dataFile, 'public');
        $path = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix() . '/public/' . $fileNameTypeOriginal;

        return $path;
    }

    function get_numerics ($str) {
        preg_match_all('/\d+/', $str, $matches);
        return $matches[0];
    }

    public function insertPartialData(Request $request)
    {
        //return Response::json(null,200); //teste
        $error=null;
        $collec = json_decode(json_encode($request->all()));

        //return response()->json($collec);

        $dados_return = array();
        DB::beginTransaction();
        try {
            foreach ($collec as $col)
            {
                $transState = TransactionState::where('transaction_id', $col->transaction_id)
                ->where('t_state_id', $col->t_state_id)
                ->get();
                if ($transState->isEmpty())
                {
                    $transactionState = new TransactionState;
                    $transactionState->transaction_id = $col->transaction_id;
                    $transactionState->t_state_id = $col->t_state_id;
                    $transactionState->action_id = $col->action_id;
                    $transactionState->updated_by = $this->user_id;
                    $transactionState->save();
                }
                else
                {
                    //verificar se campo action_id diferente do actualmente recebido, se sim
                    //alterar o action_id para o actuar no $transState
                    $trans_state_existent = $transState->first();
                    if ($trans_state_existent->action_id !== $col->action_id)
                    {
                        $trans_state_existent->action_id = $col->action_id;
                        $trans_state_existent->save();
                    }
                }

                $action_log_existent = ActionLog::where('action_id', $col->action_id)
                    ->where('transaction_id', $col->transaction_id)->get();
                if ($action_log_existent->isEmpty())
                {
                    $action_log = new ActionLog;
                    $action_log->state = 'executing';
                    $action_log->action_id = $col->action_id;
                    $action_log->transaction_id = $col->transaction_id;
                    $action_log->save();
                }

                if ($col->type_asyncr === 'spec_data')
                {
                    $ents = Entity::where('transaction_id', $col->transaction_id)->get();
                    if ($ents->isEmpty())
                    {
                        //inserir nas entity... é preciso obter o ent_type_id
                        $ent_type = EntType::with(['language' => function ($query) {
                            $query->where('id', $this->lang_id);
                        }])->whereHas('language', function ($query) {
                            return $query->where('id', $this->lang_id);
                        })->where('transaction_type_id', $col->transaction_type_id)->first();

                        $entity = new Entity;
                        $entity->ent_type_id = $ent_type->id;
                        $entity->state = "active";
                        $entity->transaction_id = $col->transaction_id;
                        $entity->updated_by = $this->user_id;
                        $entity->save();

                        $entityName = new EntityName;
                        $entityName->entity_id = $entity->id;
                        $entityName->language_id = $this->lang_id; //buscar o language id
                        $entityName->name = $ent_type->language[0]->pivot->name . " " . $entity->id;
                        $entityName->updated_by = $this->user_id;
                        $entityName->save();
                    }


                    //inserir dados na tabela value
                    if ($col->spec_data != null)
                    {
                        foreach ($col->spec_data->propsform as $keyField => $valueField)
                        {
                            if ($valueField->id === $col->prop_id)
                            {
                                $values_exists = Value::where('property_id', $col->prop_id)
                                    ->where('entity_id', $ents->isNotEmpty() ? $ents->first()->id : $entity->id)
                                    ->first();

                                //dd(!$values_exists);
                                if (isset($valueField->fields)) {
                                    if (!$values_exists)
                                        $value = new Value;
                                    else
                                        $value = $values_exists;

                                    if ($valueField->value_type === "enum" && $valueField->form_field_type === "checkbox")
                                    {
                                        foreach ($valueField->fields as $keyPropFieldValue => $propFieldValue)
                                        {
                                            if ($ents->isNotEmpty())
                                            {
                                                $value->entity_id = $ents->first()->id;
                                            }
                                            else
                                            {
                                                $value->entity_id = $entity->id;
                                            }

                                            $value->property_id = $valueField->id;

                                            $value->value = mb_substr($keyPropFieldValue, -1); //obter a ultima posição da string "Tra-1-Local_Destino-2-3": true, neste caso o 3

                                            $value->updated_by = $this->user_id;
                                            $value->save();
                                        }
                                    }
                                    else
                                    {
                                        if ($ents->isNotEmpty())
                                        {
                                            $value->entity_id = $ents->first()->id;
                                        }
                                        else
                                        {
                                            $value->entity_id = $entity->id;
                                        }

                                        $value->property_id = $valueField->id;

                                        $currentValueField = null;
                                        foreach ($valueField->fields as $prop) {
                                            $currentValueField = $prop;
                                            break; // or exit or whatever exits a foreach loop...
                                        }

                                        if ($valueField->value_type === "file") {
                                            //$value->value = $this->uploadFile($currentValueField);
                                        } else {
                                            $value->value = $currentValueField;
                                        }

                                        $value->updated_by = $this->user_id;
                                        $value->save();
                                    }

                                }
                            }
                        }
                    }
                }
                else if ($col->type_asyncr === 'c_act')
                {
                    foreach ($col->c_act->causallinks as $keyCausalLink => $valueCausalLink)
                    {
                        for ($x = 0; $x < $valueCausalLink->numberOfTrs; $x++)
                        {
                            $process_existent = Transaction::where('id', $col->transaction_id)
                                ->first();

                            $transaction = new Transaction;
                            $transaction->transaction_type_id = $valueCausalLink->caused_action_rule->transaction_type
                                ->id;
                            $transaction->state = "active";
                            $transaction->process_id = $process_existent->process_id; //buscar o processo ID
                            $transaction->updated_by = $this->user_id;
                            $transaction->save();

                            $transactionState = new TransactionState;
                            $transactionState->transaction_id = $transaction->id;
                            $transactionState->t_state_id = $valueCausalLink->caused_action_rule->t_state->id;
                            $transactionState->updated_by = $this->user_id;
                            $transactionState->save();
                        }
                    }
                }
            }


            DB::commit();
            $success = true;
        } catch (\Exception $e) {
            $error = $e->getLine() . " " . $e->getMessage();
            $success = false;
            DB::rollback();
        }

        $returnData = array(
            'message' => 'An error occurred!',
            'error' => $error
        );

        if ($success) {
            $getUsers = User::all(['id'])->whereNotIn('id', $this->user_id)->toArray();

            event(new TransactionEvent('Hi there Pusher!', $getUsers));

            if ($collec[0]->process_id !== null)
                $dados_return['process_id'] = $collec[0]->process_id;

            $dados_return['transaction_id'] = $collec[0]->transaction_id;
            $dados_return['prop_id'] = $collec[0]->prop_id;

            //sleep(5);
            return Response::json($dados_return,200);
        }
        else
        {
            return Response::json($returnData, 400);
        }
    }

    public function getSpec($id)
    {
        $url_text = $this->url_text;
        $tstates = TState::with(['language' => function($query) use ($url_text) {
            $query->where('slug', $url_text);
        }])->whereHas('language', function ($query) use ($url_text){
            return $query->where('slug', $url_text);
        })->find($id);

        return response()->json($tstates);
    }







    //convert array to array of objects
    private function arrayOfArrayToArrayOfObjects($array)
    {
        $newArr = array();
        foreach ($array as $subarray) {
            foreach ($subarray as $object) {
                $newArr[] = $object;
            }
        }

        return $newArr;
    }



    private function getCausalLinksOfAction($action)
    {
        $causallinks = CausalLink::with(['causedActionRule.transactionType.language' => function ($query) {
            $query->where('id', $this->lang_id);
        }, 'causedActionRule.tState.language' => function ($query) {
            $query->where('id', $this->lang_id);
        }])->where('causing_action', $action)->orderBy('created_at','desc')->get();

        return $causallinks;
    }

    //run/execute/complete actions on server that doesnt need user input to be completed
    private function interpretActionsOnServer($dataFromActions)
    {
        $dataChanged = $dataFromActions;
        $dataChanged['actionsDone'] = array();

        DB::beginTransaction();
        try {
            if (isset($dataFromActions['C_ACT']) || isset($dataFromActions['WRITE_VALUE'])
                || isset($dataFromActions['PRODUCE_DOCUMENT']))
            {
                $transaction_id = $dataFromActions['transaction_id'];
                $process_id = $dataFromActions['process_id'];
                $action_id = $dataFromActions['action_id'];

                //se é a primeira acção do tstate nao existe ainda trans state e entity
                $action_rule_existent = ActionRule::whereHas('actions', function($q) use ($action_id) {
                    $q->where('id', '=', $action_id);
                })->first();

                $transState = TransactionState::where('transaction_id', $transaction_id)
                    ->where('t_state_id', $action_rule_existent->t_state_id)
                    ->get();
                if ($transState->isEmpty())
                {
                    $transactionState = new TransactionState;
                    $transactionState->transaction_id = $transaction_id;
                    $transactionState->t_state_id = $action_rule_existent->t_state_id;
                    $transactionState->action_id = $action_id;
                    $transactionState->updated_by = $this->user_id;
                    $transactionState->save();
                }
                else
                {
                    //verificar se campo action_id diferente do actualmente recebido, se sim
                    //alterar o action_id para o actuar no $transState
                    $trans_state_existent = $transState->first();
                    if ($trans_state_existent->action_id !== $action_id)
                    {
                        $trans_state_existent->action_id = $action_id;
                        $trans_state_existent->save();
                    }
                }

                $action_log_existent = ActionLog::where('action_id', $action_id)
                    ->where('transaction_id', $transaction_id)->get();
                if ($action_log_existent->isEmpty())
                {
                    $action_log = new ActionLog;
                    $action_log->state = 'executing';
                    $action_log->action_id = $action_id;
                    $action_log->transaction_id = $transaction_id;
                    $action_log->save();
                }

                $ents = Entity::where('transaction_id', $transaction_id)->get();
                if ($ents->isEmpty())
                {
                    $transaction = Transaction::where('id', '=', $transaction_id)->first();

                    //inserir nas entity... é preciso obter o ent_type_id
                    $ent_type = EntType::with(['language' => function ($query) {
                        $query->where('id', $this->lang_id);
                    }])->whereHas('language', function ($query) {
                        return $query->where('id', $this->lang_id);
                    })->where('transaction_type_id', $transaction->transaction_type_id)->first();

                    $entity = new Entity;
                    $entity->ent_type_id = $ent_type->id;
                    $entity->state = "active";
                    $entity->transaction_id = $transaction_id;
                    $entity->updated_by = $this->user_id;
                    $entity->save();

                    $entityName = new EntityName;
                    $entityName->entity_id = $entity->id;
                    $entityName->language_id = $this->lang_id; //buscar o language id
                    $entityName->name = $ent_type->language[0]->pivot->name . " " . $entity->id;
                    $entityName->updated_by = $this->user_id;
                    $entityName->save();
                }
            }

            if (isset($dataFromActions['C_ACT']))
            {
                $data = $dataFromActions['C_ACT'];

                foreach ($data as $actionCAct)
                {
                    if ($actionCAct->min === $actionCAct->max)
                    {
                        for ($i = 1; $i <= (integer)$actionCAct->max; $i++) {
                            //inserir ligações causais nas respectivas tabelas. por fazer acabar IMPORTANTE PROBLEMA
                            $actionRule = ActionRule::where('id', $actionCAct->caused_action_rule)->first();
                            $transaction = new Transaction;
                            $transaction->transaction_type_id = $actionRule->transaction_type_id;
                            $transaction->state = "active";
                            $transaction->process_id = $process_id;
                            $transaction->updated_by = $this->user_id;
                            $transaction->save();

                            $transactionState = new TransactionState;
                            $transactionState->transaction_id = $transaction->id;
                            $transactionState->t_state_id = $actionRule->t_state_id;
                            $transactionState->updated_by = $this->user_id;
                            $transactionState->save();
                        }
                        //executeActionsOnServer

                        $actionDone = new \stdClass();
                        $actionDone->actionType = 'c_act';
                        $actionDone->transactionTypeName = $actionCAct->causedActionRule->transactionType->language->first()->pivot->t_name;
                        $actionDone->tStateName = $actionCAct->causedActionRule->tState->language->first()->pivot->name;
                        $actionDone->numberOfTrs = $actionCAct->min;
                        array_push($dataChanged['actionsDone'], $actionDone);
                    }
                }

                $dataChanged['C_ACT'] = $data->filter(function ($item, $key) {
                    return $item->min !== $item->max;
                });


                //se não existem ligações causais dentro do array c_act, remover a key do array.
                if ($dataChanged['C_ACT']->isEmpty())
                {
                    unset($dataChanged['C_ACT']);
                }
            }
            else if (isset($dataFromActions['WRITE_VALUE'])) //duvida sobre guardar o valor na propriedade e ent type
            {
                //guardar valores directamente na base de dados.
                //se nao existe transaction e process
                $data = $dataFromActions['WRITE_VALUE'];

                $value = new Value;
                $value->entity_id = $ents->isEmpty() ? $entity->id : $ents->first()->id;
                $value->property_id = $data[0]->property_id1;
                $value->state = 'active';

                if ($data[0]->value_id1 !== null)
                {
                    $value->value = $data[0]->value_id1;
                }
                elseif ($data[0]->value1 !== null)
                {
                    $value->value = $data[0]->value1;
                }
                elseif ($data[0]->property_id2 !== null)
                {
                    //obter proc id
                    $property2_value = Value::where('property_id', $data[0]->property_id2)
                        ->whereHas('entity.transaction', function ($query) use ($process_id) {
                            $query->where('process_id', $process_id);
                        })
                        ->get();

                    if ($property2_value->count() === 1)
                    {
                        $value->value = $property2_value->first()->value;
                    }
                    else
                    {
                        $dataChanged['WRITE_VALUE']['info'] = 'More than one value for this property!'; //falta testar
                    }
                }

                if (isset($property2_value))
                {
                    if ($property2_value->count() === 1)
                    {
                        $value->save();
                    }
                }
                else
                {
                    $value->save();
                }

                $actionDone = new \stdClass();
                $actionDone->actionType = 'WRITE_VALUE';
                array_push($dataChanged['actionsDone'], $actionDone);

                $this->updateActionLogInActionAndTransaction($action_id, $transaction_id);
            }
            else if (isset($dataFromActions['PRODUCE_DOCUMENT']))
            {
                //verificar se action template tem variaveis se sim, substituir
                $data = $dataFromActions['PRODUCE_DOCUMENT'];

                $action_template_text = $data['action_template']->language[0]->pivot->text;
                //dd($data['action_template']->language[0]->pivot->text);
                if (stristr($action_template_text, 'variable mceNonEditable') !== false)
                {
                    //existe variaveis, modificar as variaveis
                    $dom = new DOMDocument;
                    $dom->loadHTML($action_template_text);
                    $xpath = new DOMXPath($dom);
                    $nodes = $xpath->query('//*[contains(concat(" ", normalize-space(@class), " "), " variable ")]');
                    foreach($nodes as $span_parent) {
                        $nodes1 = $xpath->query('*[contains(concat(" ", normalize-space(@class), " "), " variable_value ")]', $span_parent);
                        foreach($nodes1 as $span_child)
                        {
                            $variableParts = explode(":", $span_child->nodeValue);
                            $value = $this->getValForPropsToReplaceVarsFromTemplate($variableParts[1], $data['transaction_id']);
                            $span_parent->nodeValue = $value->value;
                        }
                    }

                    $dataChanged['PRODUCE_DOCUMENT']['action_template_text'] = $dom->saveHTML();
                }
                else
                {
                    $dataChanged['PRODUCE_DOCUMENT']['action_template_text'] = $action_template_text;
                }

                //$dataChanged['prod_doc']['action_template_text'] = $prod_doc;
                //dd($dataFromActions);
                //array_push($dataChanged['actionsDone'], $actionDone);
                //dd($dataChanged['actionsDone']);
                //array_push($dataChanged['actionsDone'], $actionDone);
            }
            else if (isset($dataFromActions['emptyActions']))
            {
                $data = $dataFromActions['emptyActions'];
                $transaction_id = $data['transaction_id'];
                $trans_type_id = $data['trans_type_id'];
                $process_id = $data['process_id'];
                $process_type_id = TransactionType::where('id', $trans_type_id)->first()->process_type_id;
                $valueState = $data['valueState'];

                if ($transaction_id === null)
                {
                    if ($process_id === null)
                    {
                        $actionDone = new \stdClass();
                        $actionDone->actionType = 'newProcess';
                        //inserir na tabela process, retornar o process_id
                        $new_process = new Process;
                        $new_process->process_type_id = $process_type_id;
                        $new_process->proc_state = 'execution';
                        $new_process->state = 'active';
                        $new_process->updated_by = $this->user_id;
                        $new_process->save();

                        $process_id = $new_process->id;
                        $dataChanged['emptyActions']['process_id'] = $process_id;

                        $actionDone->processTypeName = ProcessTypeName::where('process_type_id','=',$process_type_id)->where('language_id','=',$this->lang_id)->first()->name;

                        $new_process_name = new ProcessName;
                        $new_process_name->process_id = $new_process->id;
                        $new_process_name->language_id = $this->lang_id;
                        $new_process_name->name = $actionDone->processTypeName . " " . $new_process->id;
                        $new_process_name->updated_by = $this->user_id;
                        $new_process_name->save();

                        array_push($dataChanged['actionsDone'], $actionDone);
                    }


                    $actionDone = new \stdClass();
                    $actionDone->actionType = 'newTransaction&State';

                    $new_transaction = new Transaction;
                    $new_transaction->transaction_type_id = $trans_type_id;
                    $new_transaction->state = 'active';
                    $new_transaction->process_id = $process_id === null ? $new_process->id : $process_id;
                    $new_transaction->updated_by = $this->user_id;
                    $new_transaction->save();
                    $transaction_id = $new_transaction->id;
                    $dataChanged['emptyActions']['transaction_id'] = $transaction_id;

                    $new_transaction_state = new TransactionState;
                    $new_transaction_state->transaction_id = $new_transaction->id;
                    $new_transaction_state->t_state_id = $valueState;
                    $new_transaction_state->updated_by = $this->user_id;
                    $new_transaction_state->save();
                    //inserir instancia na tabela transaction e na tabela transaction state
                }
                else
                {
                    $transaction_states = TransactionState::where('transaction_id', $transaction_id)
                        ->where('t_state_id', $valueState)
                        ->get();

                    if ($transaction_states->isEmpty()) {
                        //inserir o estado na transaction state
                        $new_transaction_state = new TransactionState;
                        $new_transaction_state->transaction_id = $transaction_id;
                        $new_transaction_state->t_state_id = $valueState;
                        $new_transaction_state->save();
                    }
                }

                if (!isset($actionDone))
                {
                    $actionDone = new \stdClass();
                    $actionDone->actionType = 'newTransaction&State';
                }

                $actionDone->transactionTypeName = TransactionTypeName::where('transaction_type_id','=',$trans_type_id)->where('language_id','=',$this->lang_id)->first()->t_name;
                $actionDone->transactionState = TStateName::where('t_state_id','=',$valueState)->where('language_id','=',$this->lang_id)->first()->name;

                array_push($dataChanged['actionsDone'], $actionDone);
            }
            DB::commit();
            //$success = true;
        } catch (\Exception $e) {
            //$success = false;
            DB::rollback();
        }

        return $dataChanged;
    }



    //get each variable from the action template
    // and change the variables on the action template with values that are present on the database tables
    public function replaceVariablesFromTemplate(Request $request)
    {
        $action_template_id = $request->input('action_template_id');
        $transaction_id = $request->input('transaction_id');

        $templateAction = ActionTemplate::find($action_template_id);

        $dom = new DOMDocument;
        $dom->loadHTML($templateAction->text);
        $xpath = new DOMXPath($dom);
        $nodes = $xpath->query('//*[contains(concat(" ", normalize-space(@class), " "), " variable ")]');
        foreach($nodes as $span_parent) {
            $nodes1 = $xpath->query('*[contains(concat(" ", normalize-space(@class), " "), " variable_value ")]', $span_parent);
            foreach($nodes1 as $span_child)
            {
                $variableParts = explode(":", $span_child->nodeValue);
                $value = $this->getValForPropsToReplaceVarsFromTemplate($variableParts[1], $transaction_id);
                $span_parent->nodeValue = $value->value;
            }
        }

        return $dom->saveHTML();
    }

    //change the variables on the action template with values that are present on the database tables
    private function getValForPropsToReplaceVarsFromTemplate($prop_id, $transaction_id)
    {
        $property = Property::find($prop_id);

        $value = Value::where('property_id', $prop_id)
            ->whereHas('entity', function($query) use ($transaction_id) {
                $query->where('transaction_id', $transaction_id);
            })->first();

        if ($property->value_type === 'prop_ref')
        {
            $value = Value::where('property_id', $property->fk_property_id)
                ->where('id', $value->value)
                ->first();
        }

        return $value;
    }



    static public function array_to_object(array $array)
    {
        foreach($array as $key => $value)
        {
            if(is_array($value))
            {
                $array[$key] = self::array_to_object($value);
            }
        }
        return (object)$array;
    }

    private function array_push_assoc($array, $key, $value){
        $array[$key] = $value;
        return $array;
    }

    private function getPropsInfoProp($prop_id, $proc_id)
    {
        $existPropCanReadProp = PropertyCanReadProperty::where('reading_property', $prop_id)->get();

        $transactionsProps = collect();
        if ($existPropCanReadProp->isNotEmpty()) {
            $transactionsPropsEntTypes = DB::table('transaction')
                ->join('transaction_type', 'transaction_type.id', '=', 'transaction.transaction_type_id')
                ->join('entity', 'entity.transaction_id', '=', 'transaction.id')
                ->leftJoin('value', 'value.entity_id', '=', 'entity.id')
                ->join('ent_type', 'ent_type.id', '=', 'entity.ent_type_id')
                ->join('property', 'property.id', '=', 'value.property_id')
                ->join('t_state', 't_state.id', '=', 'property.t_state_id')
                ->join('process', 'process.id', '=', 'transaction.process_id')
                ->select('transaction.id as transaction_id', 'transaction_type.id as transaction_type_id', 't_state.id as t_state_id',
                    'transaction.created_at', 'property.id as property_id', 'value.value')
                ->whereIn('property.id', function($query) use ($prop_id)
                {
                    $query->select('providing_property')->from('property_can_read_property')
                        ->where('reading_property', $prop_id);
                })
                ->where('process.id',$proc_id)->where('process.proc_state', '=', 'execution');

            $transactionsProps = DB::table('transaction')
                ->join('transaction_type', 'transaction_type.id', '=', 'transaction.transaction_type_id')
                ->join('relation', 'relation.transaction_id', '=', 'transaction.id')
                ->leftJoin('value', 'value.entity_id', '=', 'relation.id')
                ->join('rel_type', 'rel_type.id', '=', 'relation.rel_type_id')
                ->join('property', 'property.id', '=', 'value.property_id')
                ->join('t_state', 't_state.id', '=', 'property.t_state_id')
                ->join('process', 'process.id', '=', 'transaction.process_id')
                ->select('transaction.id as transaction_id', 'transaction_type.id as transaction_type_id', 't_state.id as t_state_id',
                    'transaction.created_at', 'property.id as property_id', 'value.value')
                ->whereIn('property.id', function($query) use ($prop_id)
                {
                    $query->select('providing_property')->from('property_can_read_property')
                        ->where('reading_property', $prop_id);
                })
                ->where('process.id',$proc_id)
                ->where('process.proc_state', '=', 'execution')
                ->union($transactionsPropsEntTypes)
                //->orderBy('transaction.created_at', 'desc')
                ->get();

            foreach($transactionsProps as $transactionsProp)
            {
                $transactionsProp->t_name = TransactionTypeName::where('transaction_type_id','=',$transactionsProp->transaction_type_id)->where('language_id','=',$this->lang_id)->first()->t_name;
                $transactionsProp->t_state_name = TStateName::where('t_state_id','=',$transactionsProp->t_state_id)->where('language_id','=',$this->lang_id)->first()->name;
                $transactionsProp->prov_prop_name = PropertyName::where('property_id','=',$transactionsProp->property_id)->where('language_id','=',$this->lang_id)->first()->name;
            }
        }

        return $transactionsProps;
    }

    private function getPropsInfoEntType($prop_id, $proc_id)
    {
        $existPropCanReadEntType = PropertyCanReadEntType::where('reading_property', $prop_id)->get();

        $transactionsEntTypesProps = collect();
        if ($existPropCanReadEntType->isNotEmpty()) {
            $transactionsEntTypesProps = DB::table('transaction')
                ->join('transaction_type', 'transaction_type.id', '=', 'transaction.transaction_type_id')
                ->join('entity', 'entity.transaction_id', '=', 'transaction.id')
                ->leftJoin('value', 'value.entity_id', '=', 'entity.id')
                ->join('ent_type', 'ent_type.id', '=', 'entity.ent_type_id')
                ->join('property', 'property.id', '=', 'value.property_id')
                ->join('t_state', 't_state.id', '=', 'property.t_state_id')
                ->join('process', 'process.id', '=', 'transaction.process_id')
                ->select('transaction.id as transaction_id', 'transaction_type.id as transaction_type_id', 't_state.id as t_state_id',
                    'transaction.created_at', 'property.id as property_id', 'value.value')
                ->whereIn('ent_type.id', function($query) use ($prop_id)
                {
                    $query->select('providing_ent_type')->from('property_can_read_ent_type')
                        ->where('reading_property', $prop_id);
                })
                ->where('process.id',$proc_id)
                ->where('process.proc_state', '=', 'execution')
                ->orderBy('transaction.created_at','desc')
                ->get();

            foreach($transactionsEntTypesProps as $transactionsEntTypesProp)
            {
                $transactionsEntTypesProp->t_name = TransactionTypeName::where('transaction_type_id','=',$transactionsEntTypesProp->transaction_type_id)->where('language_id','=',$this->lang_id)->first()->t_name;
                $transactionsEntTypesProp->t_state_name = TStateName::where('t_state_id','=',$transactionsEntTypesProp->t_state_id)->where('language_id','=',$this->lang_id)->first()->name;
                $transactionsEntTypesProp->prov_prop_name = PropertyName::where('property_id','=',$transactionsEntTypesProp->property_id)->where('language_id','=',$this->lang_id)->first()->name;
            }
        }

        return $transactionsEntTypesProps;
    }


    //provavelmente é possível executar numa só query, verificar essa possibilidade
    public function getAllProcessOfTr($trans_id)
    {
        //verificar se o utilizador é externo ou interno
        $getUser = User::find($this->user_id);

        $getTransType = TransactionType::find($trans_id);
        if ($getUser->user_type == "external") //se é externo é necessário
        {
            $processes = Process::with(['language' => function ($query) {
                $query->where('id', $this->lang_id);
            }])->whereHas('language', function ($query) {
                $query->where('id', $this->lang_id);
            })->whereHas('updatedBy', function ($query) use ($getUser) {
                $query->where('entity_id', $getUser->entity_id);
            })->where('process_type_id', $getTransType->process_type_id)->where('proc_state', 'execution')->get();
        }
        else
        {
            //se é interno então faz esta parte
            $processes = Process::with(['language' => function ($query) {
                $query->where('id', $this->lang_id);
            }])->whereHas('language', function ($query) {
                $query->where('id', $this->lang_id);
            })/*->whereHas('transactions.transactionType.iniciatorActor.role.user', function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
            })*/->whereHas('processType.transactionsTypes.iniciatorActor.role.user', function ($query) {
                $query->where('user_id', $this->user_id);
            })/*->whereHas('processType.transactionsTypes', function ($query) use ($trans_id) {
                $query->where('id', $trans_id);
            })*/->where('process_type_id', $getTransType->process_type_id)->where('proc_state', 'execution')->get(); //->where('flag','execution') adicionar depois de mudar a base de dados
        }

        $processesAlt = $processes->filter(function ($process_item, $process_key) use ($trans_id) {
            $result = $this->verifCanUseProc($trans_id, $process_item->id);
            return $result === true;
        });

        //chamar o método values para reorganizar os indices da colecçao
        return $processesAlt->values();
    }





    public function verifCanUseProc($transaction_type_id, $process_id)
    {
        $canAdvance = false;
        $trans_type_id = $transaction_type_id;
        $proc_id = $process_id;

        //verificar se existem causal links desse transaction type id
        $getCausalLinksFromTransTypeID = CausalLink::with(['causedActionRule' => function ($query) use ($trans_type_id) {
            $query->where('transaction_type_id', $trans_type_id);
        }])->get();

        if ($getCausalLinksFromTransTypeID->isEmpty())
        {
            $canAdvance = true;
        }
        else
        {
            //contar o número de max dos causal links
            if ($getCausalLinksFromTransTypeID->contains('max','*'))
            {
                $maxCausalLink = '*';
            }
            else
            {
                $maxCausalLink = $getCausalLinksFromTransTypeID->sum('max');
            }

            if ($maxCausalLink !== '*')
            {
                $getExistentTransactionsFromProc = Process::with(['transactions' => function ($query) use ($trans_type_id) {
                    $query->where('transaction_type_id', $trans_type_id);
                }])->where('id', $proc_id)->get();

                $numberExistTrans = $getExistentTransactionsFromProc->first()->transactions->count();

                if ($numberExistTrans >= $maxCausalLink)
                {
                    $canAdvance = false;
                }
                else
                {
                    $canAdvance = true;
                }
            }
            else
            {
                $canAdvance = true;
            }

        }

        return $canAdvance;
    }

    public function transactionAckAll(Request $request)
    {
        $user_id = $this->user_id;
        $transaction_id = $request->input('transaction_id');

        $transaction_state = TransactionState::with(['tState.language' => function($query) {
            $query->where('id', $this->lang_id);
        },'transaction.transactionType.language' => function($query) {
            $query->where('id', $this->lang_id);
        }, 'transactionAck.user'])->whereHas('tState.language')
            ->where('transaction_id', $transaction_id)
            ->orderby('created_at','desc')
            ->orderBy('id', 'desc')
            ->first();

        $transaction_state_id = $transaction_state->id;
        $t_state_id = $transaction_state->t_state_id;

        $transaction_type_id = Transaction::where('id', $transaction_state->transaction_id)->first()->transaction_type_id;

        //verify if the user is initiator and/or executer of the actual transaction type
        $arrayResultUserPermission = $this->isUserInicOrExecOfTrans($transaction_type_id, 1);
        $canAdvance = false;
        //decide if the user have permission to manage, alter or advance
        if (($arrayResultUserPermission['isInicActorTrans'] === true) && ($arrayResultUserPermission['isExecActorTrans'] === true)
            && ($t_state_id <= 5)
        )
        {
            $canAdvance = true;
        }
        elseif (($arrayResultUserPermission['isInicActorTrans'] === true) && ($arrayResultUserPermission['isExecActorTrans'] === false)
            && ($t_state_id === 2 || $t_state_id === 3 || $t_state_id === 4))
        {
            $canAdvance = true;
        }
        elseif (($arrayResultUserPermission['isInicActorTrans'] === false) && ($arrayResultUserPermission['isExecActorTrans'] === true)
            && ($t_state_id === 1 || $t_state_id === 5))
        {
            $canAdvance = true;
        }

        if ($canAdvance === true)
        {
            $existsTransAck = $this->verifTransactionAckExists($transaction_state_id);
            if ($existsTransAck->isEmpty()) {
                $success = $this->insertTransactionAck($transaction_state_id, $user_id);

                $returnData = array(
                    'message' => 'An error occurred!'
                );

                if ($success) {
                    return Response::json(null, 200);
                } else {
                    return Response::json($returnData, 400);
                }
            } else {
                $returnData = array(
                    'message' => 'Transaction Acknowledge already exists!'
                );

                return Response::json($returnData, 401);
            }
        }
        else
        {
            $returnData = array(
                'message' => 'You dont have permission to do Acknowledge!'
            );

            return Response::json($returnData, 401);
        }
    }

    private function verifTransactionAckExists($trans_state_id)
    {
        $transAck = TransactionAck::where('transaction_state_id', $trans_state_id)->get();

        return $transAck;
    }

    private function insertTransactionAck($trans_state_id, $user_id)
    {
        $transaction_ack = new TransactionAck;

        DB::beginTransaction();
        try {
            $transaction_ack->user_id = $user_id;
            $transaction_ack->transaction_state_id = $trans_state_id;
            $transaction_ack->save();

            DB::commit();
            $success = true;
        } catch (\Exception $e) {
            $success = false;
            DB::rollback();
        }

        return $success;
    }







    //CONTINUE TRANSACTIONS WITH ACTION RULES
    public function getStatesFromTransaction($transaction_id)
    {
        $trans = TransactionState::with(['tState.language' => function($query) {
            $query->where('id', $this->lang_id);
        },'transaction.transactionType.language' => function($query) {
            $query->where('id', $this->lang_id);
        }, 'transactionAck.user'])->whereHas('tState.language')
            ->where('transaction_id', $transaction_id)
            ->orderby('created_at','asc')
            ->orderBy('id', 'asc')
            ->get();

        /*$data = array(
            'data' => $trans->isEmpty() ? null : $trans,
            'titleTab' => trans("dashboard/modalTransactionState.TITLE_TAB")
        );*/

        return response()->json($trans);
    }

    //Inicio - Guilherme
    public function externalIntegration($collec, $ent_type_id, $t_state_id)
    {
        //Teste Xisconnect
        $query = ['ent_type_id' => $ent_type_id, 't_state_id' => $t_state_id];
        $external_integration = ExternalIntegration::where($query)->get();
        if(!$external_integration->isEmpty())
            $this->ext_int->connection($collec, $external_integration, 1, 1);

    }
//Fim - Guilherme
}
