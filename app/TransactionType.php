<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionType extends Model
{
    //use SoftDeletes;

    protected $table = 'transaction_type';

    public $timestamps = true;

    protected $fillable = [
        'state',
        'process_type_id',
		'init_proc',
        'executer',
        'auto_activate',
        'freq_activate',
        'when_activate',
		'updated_by',
        'deleted_by'

    ];

    protected $guarded = [];


    public function executerActor() {
        return $this->belongsTo('App\Actor', 'executer', 'id');
    }

    public function iniciatorActor() {
        return $this->belongsToMany('App\Actor', 'actor_iniciates_t');
    }

    public function entType() {
        return $this->hasMany('App\EntType', 'transaction_type_id', 'id');
    }

    public function transactions() {
        return $this->hasMany('App\Transaction', 'transaction_type_id', 'id');
    }

    //já nao aponta para a tabela causal link mas sim para a action rule
    public function causedTransaction() {
        return $this->hasMany('App\CausalLink', 'caused_action_rule', 'id');
    }

    //já nao aponta para a tabela causal link mas sim para a action
    public function causingTransaction() {
        return $this->hasMany('App\CausalLink', 'causing_action', 'id');
    }

    public function processType() {
        return $this->belongsTo('App\ProcessType', 'process_type_id', 'id');
    }

    public function waitedTransaction() {
        return $this->hasMany('App\WaitingLink', 'waited_t', 'id');
    }

    public function waitingTransaction() {
        return $this->hasMany('App\WaitingLink', 'waiting_transaction', 'id');
    }

    public function language() {
        return $this->belongsToMany('App\Language', 'transaction_type_name', 'transaction_type_id', 'language_id')->withPivot('t_name', 'rt_name', 'created_at', 'updated_at', 'deleted_at');
    }

    public function updatedBy() {

        return $this->belongsTo('App\Users', 'updated_by', 'id');
    }

    public function deletedBy() {

        return $this->belongsTo('App\Users', 'deleted_by', 'id');
    }

}
