<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 08/01/2019
 * Time: 18:40
 */

namespace App\CustomClass;


use App\ActionLog;
use App\TransactionState;
use App\TransactionType;
use App\TStateName;
use DB;

class Transaction
{
    use \App\Http\Traits\CommonTrait;

    var $user_id;
    var $lang_id;

    var $cur_t_state_id;
    var $cur_action_id;
    var $cur_action_state;
    var $cur_transaction_state;

    var $transaction_id;
    var $transaction_name;
    var $transaction_type_id;

    var $process_id;
    var $process_name;

    var $action_state;

    var $next_action;
    var $permission_next_action=false;

    var $permissions_inic_exec;
    var $permissions_inic_exec_del;

    function __construct($t_state_id, $transaction_type_id, $transaction_id, $user_id, $lang_id)
    {
        $this->user_id = $user_id;
        $this->lang_id = $lang_id;

        $this->cur_t_state_id = $t_state_id;

        $this->transaction_type_id = $transaction_type_id;
        $this->transaction_id = $transaction_id;

        $this->permissions_inic_exec = $this->isUserInicOrExecOfTrans();



        $this->nextAction();
    }

    private function nextAction()
    {
        $this->cur_transaction_state = $this->getTransactionState($this->transaction_id, $this->cur_t_state_id);

//        dd($this->cur_transaction_state);


        $this->cur_action_id = $this->cur_transaction_state->action_id;
        //$this->permissions_inic_exec_del = $this->isUserDelegatedOfTrans();
        //$this->checkActionStatus();
        $this->getActionForTStateAndTransType();
        //$this->checkPermissionsForTState();

        /*if ($this->permission_next_action === false)
        {
            $t_state = TStateName::where('t_state_id', $this->cur_t_state_id)
                    ->where('language_id', $this->lang_id)
                    ->first();
            $this->next_action = 'Waiting for next t state ' . $t_state->name;
        }*/
        $this->action_state = $this->cur_action_state;
    }

    private function checkActionStatus($action_id)
    {
        $action_log = ActionLog::where('action_id', $action_id)
            ->where('transaction_id', $this->transaction_id)
            ->first();

        if ($action_log)
        {
            if ($action_log->state === 'executed')
            {
                $this->cur_action_state = 'done';
            }
            else
            {
                $this->cur_action_state = 'doing';
            }
            $state = $action_log->state;
        }
        else
        {
            $this->cur_action_state = 'to_do';
            $state = "to be executed";
        }

        return $state;
    }

    public function getActionForTStateAndTransType()
    {
        $States = Array(0=>'Initial', 1=>'Request', 2=>'Promise', 3=>'Execute', 4=>'State', 5=>'Accept');

        for ($t_state_id = $this->cur_t_state_id; $t_state_id < count($States); $t_state_id++)
        {
            //verify permission to see t state before getting all the actions
            $this->permissions_inic_exec_del = $this->isUserDelegatedOfTrans($t_state_id);
            $permission = $this->checkPermissionsForTState($t_state_id);
            /*if ($this->transaction_id === 37 && $t_state_id === 2)
            {
                dd($permission);
            }*/
            if (!$permission)
            {
                $t_state = TStateName::where('t_state_id', $t_state_id)
                    ->where('language_id', $this->lang_id)
                    ->first();
                $this->next_action = trans('dashboard/messages.CURRENT_TASKS_PANEL_NO_PERMISSION_1') .
                    $t_state->name; /*.
                        trans('dashboard/messages.CURRENT_TASKS_PANEL_NO_PERMISSION_2');*/
                break;
            }

            if ($this->cur_action_id === null)
            {
                $search_type = "all";
                $actions_next = $this->getAction($t_state_id, $search_type);

                if ($search_type === 'all')
                {
                    if ($actions_next->isNotEmpty())
                    {
                        $this->next_action = $actions_next->first();
                        $this->checkActionStatus($actions_next->first()->id);
                        break;
                    }
                }
            }
            else
            {
                $search_type = "one";
                $action_next = $this->getAction($t_state_id, $search_type);

                $action_log_state = $this->checkActionStatus($this->cur_action_id);
                if ($action_log_state === 'executed')
                {
                    $search_type = "all";
                    $actions_next = $this->getAction($t_state_id, $search_type);

                    //obter a action seguinte desse t state retirando a action executed
                    $indexOfActionID = null;
                    foreach ($actions_next as $key => $value) {
                        if ($value->id == $this->cur_action_id)
                            $indexOfActionID = $key;
                    }

                    //remove the current and the previous actions
                    $action_next = $actions_next->filter(function ($item, $key) use ($indexOfActionID) {
                        return $key > $indexOfActionID; //return only the action that have the key higher than the key of the current action
                    })->first();

                    if ($action_next && $action_next->type !== 'write_value' && $action_next->type !== 'read_value')
                    {
                        $this->next_action = $actions_next->first();
                        break;
                    }
                }
                else
                {
                    //a action seguinte é essa action
                    $this->next_action = $action_next;
                    break;
                }
            }
        }

        /*if ($this->transaction_id === 37)
            dd($action_next);*/


        //$this->next_action = $action_next;

        //return;
    }

    private function getAction($t_state_id, $search_type)
    {
        if ($search_type === 'all')
        {
            $action_next = DB::table('action')
                ->join('action_name', 'action_name.action_id', '=', 'action.id')
                ->join('action_rule', 'action_rule.id', '=', 'action.action_rule_id')
                ->select('action.*', 'action_name.*')
                ->where('action_rule.transaction_type_id', '=', $this->transaction_type_id)
                ->where('action_rule.t_state_id', '=', $t_state_id)
                ->where('action_name.language_id', '=', $this->lang_id)
                //->whereNotIn('action.type', ['write_value'])
                ->orderBy('action.order', 'asc')
                ->get();
        }
        else if ($search_type === 'one')
        {
            $action_next = DB::table('action')
                ->join('action_name', 'action_name.action_id', '=', 'action.id')
                ->join('action_rule', 'action_rule.id', '=', 'action.action_rule_id')
                ->select('action.*', 'action_name.*')
                ->where('action_rule.transaction_type_id','=', $this->transaction_type_id)
                ->where('action_rule.t_state_id','=', $t_state_id)
                ->where('action_name.language_id','=', $this->lang_id)
                ->where('action.id', $this->cur_action_id)
                //->whereNotIn('action.type', ['write_value'])
                ->orderBy('action.order', 'asc')
                ->first();
        }

        return $action_next;
    }

    private function checkPermissionsForTState($t_state_id)
    {
            if ((($this->permissions_inic_exec['isInicActorTrans'] === true)
                && ($this->permissions_inic_exec['isExecActorTrans'] === false)
                && (($t_state_id === 0) || ($t_state_id === 1) || ($t_state_id === 5)))
                ||
                (($this->permissions_inic_exec['isInicActorTrans'] === false)
                    && ($this->permissions_inic_exec['isExecActorTrans'] === true)
                    && (($t_state_id === 2) || ($t_state_id === 3) || ($t_state_id === 4)))
                ||
                (($this->permissions_inic_exec['isInicActorTrans'] === true)
                    && ($this->permissions_inic_exec['isExecActorTrans'] === true)
                    && (($t_state_id >= 0) || ($t_state_id <= 5)))
                ||
                ((($this->permissions_inic_exec_del['isInicDelActorTrans'] === true)
                        || ($this->permissions_inic_exec_del['isExecDelActorTrans'] === true)))
            )
            {
                $this->permission_next_action = true;
            }
            else
            {
                $this->permission_next_action = false;
            }

        return $this->permission_next_action;
        /*if ($this->transaction_id === 37)
            dd($this->permission_next_action);*/
    }

    private function isUserInicOrExecOfTrans()
    {
        $user_id = $this->user_id;
        $lang_id = $this->lang_id;

        $inicActorTrans = TransactionType::with(['iniciatorActor.role.user' => function($query) use ($user_id) {
            $query->where('user_id', $user_id);
        }, 'language' => function($query) use ($lang_id) {
            $query->where('id', $lang_id);
        }])->whereHas('iniciatorActor.role.user', function ($query) use ($user_id){
            return $query->where('user_id', $user_id);
        })->where('id',$this->transaction_type_id)
            ->get();

        $execActorTrans = TransactionType::with(['executerActor.role.user' => function($query) use ($user_id) {
            $query->where('user_id', $user_id);
        }, 'language' => function($query) use ($lang_id) {
            $query->where('id', $lang_id);
        }])->whereHas('executerActor.role.user', function ($query) use ($user_id){
            return $query->where('user_id', $user_id);
        })->where('id',$this->transaction_type_id)
            ->get();

        $arrayResult = array('isInicActorTrans' => !$inicActorTrans->isEmpty(), 'isExecActorTrans' => !$execActorTrans->isEmpty());

        return $arrayResult;
    }

    private function isUserDelegatedOfTrans($t_state_id)
    {
        $user_id = $this->user_id;
        $tstates = array();
        $tstates[] = $t_state_id;

        $inicActorTrans = TransactionType::whereHas('iniciatorActor.role.delegates_role.delegated_role.user', function ($query) use ($user_id){
            return $query->where('user_id', $user_id);
        })->whereHas('iniciatorActor.role.delegates_role.t_state', function ($query) use ($tstates){
            return $query->whereIn('id', $tstates);
        })
            ->where('id',$this->transaction_type_id)
            ->get();

        $execActorTrans = TransactionType::whereHas('executerActor.role.delegates_role.delegated_role.user', function ($query) use ($user_id){
            return $query->where('user_id', $user_id);
        })->whereHas('executerActor.role.delegates_role.t_state', function ($query) use ($tstates){
            return $query->whereIn('id', $tstates);
        })
            ->where('id',$this->transaction_type_id)
            ->get();

        $arrayResult = array('isInicDelActorTrans' => !$inicActorTrans->isEmpty(),
            'isExecDelActorTrans' => !$execActorTrans->isEmpty());

        return $arrayResult;
    }

}