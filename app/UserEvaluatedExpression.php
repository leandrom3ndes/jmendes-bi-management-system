<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserEvaluatedExpression extends Model
{
    use SoftDeletes;

    protected $table = 'user_evaluated_expression';

    public $timestamps = true;

    protected $fillable = [
		'updated_by',
        'deleted_by'
    ];

    protected $guarded = [];

    /*public function arCondition() {

        return $this->belongsTo('App\ArCondition','ar_condition_id', 'id');
    }

    public function action() {

        return $this->belongsTo('App\Action','action_id', 'id');
    }*/

    public function updatedBy() {

        return $this->belongsTo('App\Users', 'updated_by', 'id');
    }

    public function deletedBy() {

        return $this->belongsTo('App\Users', 'deleted_by', 'id');
    }
}
