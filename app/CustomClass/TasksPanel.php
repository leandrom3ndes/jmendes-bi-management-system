<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 08/01/2019
 * Time: 18:40
 */

namespace App\CustomClass;


use App\ActionLog;
use App\ActorIniciatesT;
use App\Process;
use App\ProcessName;
use App\ProcessType;
use App\ProcessTypeName;
use App\RoleHasActor;
use App\RoleHasUser;
use App\TransactionState;
use App\TransactionType;
use App\TransactionTypeName;
use App\TStateName;
use App\Users;
use DB;

class TasksPanel
{
    use \App\Http\Traits\CommonTrait;

    var $user_id;
    var $lang_id;

    var $all_transactions_unfinished;
    var $all_transactions_finished;

    function __construct($user_id, $lang_id)
    {
        $this->user_id = $user_id;
        $this->lang_id = $lang_id;


        //obtain all the transactions initiated, executed and delegated
        $transactions = $this->getAllInicTrans()->merge($this->getAllExecTrans());
        $transactionsAll = $transactions->merge($this->getAllDelegatedTrans())->unique();

        //filter all the transactions obtaining only the completed transactions
        $this->all_transactions_finished = $this->getOnlyFinishedTrans($transactionsAll)->values();

        //get all the transactions ids from the completed transactions
        $trans_finished_ids = array();
        foreach($this->all_transactions_finished as $trans_finished)
        {
            $trans_finished_ids[] = $trans_finished->transaction_id;
        }

        //remove the completed transactions from the collection of the unfinished transactions
        $this->all_transactions_unfinished = $transactionsAll->whereNotIn('transaction_id', $trans_finished_ids)->values();
    }

    private function getOnlyFinishedTrans($transactions)
    {
        $filteredTransactions = $transactions->filter(function ($valueTransaction, $keyTransaction) {
            return $valueTransaction->max_t_state_id == 5;
        });

        $unfinished_transactions = array();
        foreach($filteredTransactions as $filTransaction)
        {
            $transState = $this->getTransactionState($filTransaction->transaction_id, $filTransaction->max_t_state_id);

            $filteredTransactions = $transactions->filter(function ($valueTransaction, $keyTransaction) {
                return $valueTransaction->max_t_state_id == 5;
            });

            $actionsForAR = $this->getActionsForAR($filTransaction->transaction_type_id, $filTransaction->max_t_state_id);
            //dd($actionsForAR->last());

            //Actions is not empty because there is actions for that specific Action Rule
            if ($actionsForAR->isNotEmpty())
            {
                //verify if action id inside transaction state is the last action of that particular t_state_id
                //these are the transactions not completed
                if ($transState->action_id !== $actionsForAR->last()->id)
                {
                    $unfinished_transactions[] = $filTransaction->transaction_id;
                    //dd(true);
                }
            }
        }

        //remove the transactions that are not completed
        $filteredTransactions = $filteredTransactions->whereNotIn('transaction_id', $unfinished_transactions);

        return $filteredTransactions;
    }

    private function getAllInicTrans()
    {
        $user_id = $this->user_id;
        $language_id = $this->lang_id;


        $get_user = Users::find($user_id);


//        $iniciatorTransactions = DB::table('transaction')
//            ->join('transaction_state', 'transaction_state.transaction_id', '=', 'transaction.id')
//            ->join('t_state', 't_state.id', '=', 'transaction_state.t_state_id')
//            ->join('t_state_name', 't_state.id', '=', 't_state_name.t_state_id')
//            ->join('process', 'transaction.process_id', '=', 'process.id')
//            ->join('process_type', 'process_type.id', '=', 'process.process_type_id')
//            ->join('transaction_type', 'transaction_type.id', '=', 'transaction.transaction_type_id')
//            ->join('actor_iniciates_t', 'actor_iniciates_t.transaction_type_id', '=', 'transaction_type.id')
//            ->select('process_type.id as process_type_id','process.id as process_id','transaction.id as transaction_id',
//                DB::raw('max(t_state.id) as max_t_state_id'),
//                'transaction_type.id as transaction_type_id')
//            ->where('t_state_name.language_id','=', $this->lang_id)
//            ->whereIn('actor_iniciates_t.actor_id', function ($query) use ($user_id) {
//                $query->select('actor_id')->from('role_has_actor')
//                    ->whereIn('role_id',function ($query) use ($user_id) {
//                        $query->select('role_id')->from('role_has_user')
//                            ->where('user_id', '=', $user_id);
//                    });
//            });

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
                                foreach($transactions as $transaction){
                                    $transactionState = TransactionState::where('transaction_id', $transaction->id)->first();

                                    if($transactionState){
                                        $transactionState->t_state_created_at = $transactionState->created_at->format('d-m-y - H:i:s');
                                        $transactionState->name = TStateName::where('t_state_id', $transactionState->t_state_id)->where('language_id', $language_id)->first()->name;
                                    }


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

//        dd($userInitatedTransactions);


//        $actorInitiatesTs = collect();
//        foreach($actorRoles as $actorRole){
//            $aIT = ActorIniciatesT::where('actor_id', $actorRole->actor_id)->get();
//            $actorInitiatesTs->add($aIT);
//        }



//        $transactionTypes  = collect();
//        foreach($actorInitiatesTs[0] as $actorInitiatesT){
//            $tT = TransactionType::where('id', $actorInitiatesT->transaction_type_id)->get();
//            $transactionTypes->add($tT);
//        }




//IMPORTANTE -> VER MAIS TARDE


//        if ($get_user->user_type === "external" && $get_user->entity_id !== "null")
//        {
//            $entity_id = $get_user->entity_id;
//            $iniciatorTransactions = $iniciatorTransactions->whereIn('process.updated_by', function ($query) use ($entity_id) {
//                $query->select('users.id')->from('users')->where('users.entity_id', '=', $entity_id);
//            });
//        }



//FIM IMPORTANTE



//        $iniciatorTransactions =  $iniciatorTransactions->groupBy('transaction_type_id','transaction_id','process_id','process_type_id')
//            ->get();

//        foreach($iniciatorTransactions as $iniciatorTransaction)
//        {
//            $iniciatorTransaction->process_type_name = ProcessTypeName::where('process_type_id','=',$iniciatorTransaction->process_type_id)->where('language_id','=',$this->lang_id)->first()->name;
//            $iniciatorTransaction->process_name = ProcessName::where('process_id','=',$iniciatorTransaction->process_id)->where('language_id','=',$this->lang_id)->first()->name;
//            $iniciatorTransaction->t_name = TransactionTypeName::where('transaction_type_id','=',$iniciatorTransaction->transaction_type_id)->where('language_id','=',$this->lang_id)->first()->t_name;
//            $iniciatorTransaction->created_at = TransactionState::where('transaction_id','=',$iniciatorTransaction->transaction_id)->latest()->first()->created_at->format('d-m-y - H:i:s');
//        }


        return $userInitatedTransactions;
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
    //END GET ALL COMPLETED TASKS

}