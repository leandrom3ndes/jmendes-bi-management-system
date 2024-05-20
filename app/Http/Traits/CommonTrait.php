<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 03/07/2018
 * Time: 15:42
 */

namespace App\Http\Traits;

use App\Action;
use App\TransactionState;
use Response;


trait CommonTrait
{
    public function getTransactionState($transaction_id, $t_state_id)
    {

        dd($transaction_id);
        $trans_state = TransactionState::where('transaction_id', $transaction_id)
            ->where('t_state_id', $t_state_id)
            ->first();

        return $trans_state;
    }

    public function getActionsForAR($transaction_type_id, $t_state_id)
    {
        $actions = Action::whereHas("ActionRule", function($q) use ($transaction_type_id, $t_state_id) {
                $q->where("transaction_type_id", $transaction_type_id)
                    ->where("t_state_id", $t_state_id);
            })
            ->orderBy('order', 'asc')
            ->get();

        return $actions;
    }
}