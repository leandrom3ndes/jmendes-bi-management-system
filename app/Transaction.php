<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    protected $table = 'transaction';

    public $timestamps = true;

    protected $fillable = [
        'transaction_type_id',
        'state',
        'status',
        'process_id',
		'updated_by',
        'deleted_by'
        
    ];

    protected $guarded = [];

    public function process() {
        return $this->belongsTo('App\Process', 'process_id', 'id');
    }

    public function transactionType() {
        return $this->belongsTo('App\TransactionType', 'transaction_type_id', 'id');
    }

    public function transactionStates() {
        return $this->hasMany('App\TransactionState', 'transaction_id', 'id');
    }

    public function entities() {
        return $this->hasMany('App\Entity', 'transaction_id', 'id');
    }

    public function users() {
        return $this->belongsToMany('App\Users', 'user_is_owner_of_transaction', 'transaction_id', 'users_id');
    }

    public function updatedBy() {

        return $this->belongsTo('App\Users', 'updated_by', 'id');
    }

    public function deletedBy() {

        return $this->belongsTo('App\Users', 'deleted_by', 'id');
    }
}
