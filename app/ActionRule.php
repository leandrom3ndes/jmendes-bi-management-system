<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActionRule extends Model
{
    use SoftDeletes;

    protected $table = 'action_rule';

    public $timestamps = true;

    protected $fillable = [
        't_state_id',
        'transaction_type_id',
        'blockly_xml',
        'blockly_code',
        'preview',
		'updated_by',
        'deleted_by'
    ];

    protected $guarded = [];

    public function tState() {

        return $this->belongsTo('App\TState','t_state_id', 'id');
    }

    public function transactionType() {

        return $this->belongsTo('App\TransactionType','transaction_type_id', 'id');
    }

    public function actions() {
        return $this->hasMany('App\Action', 'action_rule_id', 'id');
    }

    public function updatedBy() {

        return $this->belongsTo('App\Users', 'updated_by', 'id');
    }

    public function deletedBy() {

        return $this->belongsTo('App\Users', 'deleted_by', 'id');
    }
}
