<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConditionHasUserEvaluatedExpression extends Model
{
    use SoftDeletes;

    protected $table = 'condition_has_user_evaluated_expression';

    public $timestamps = true;

    protected $primaryKey = ['condition_id','user_evaluated_expression_id'];
    public $incrementing = false;

    protected $fillable = [
        'condition_id',
        'user_evaluated_expression_id',
        'updated_by',
        'deleted_by'
    ];

    public function condition() {
        return $this->belongsTo('App\Condition', 'condition_id','id');
    }

    public function userEvaluatedExpression() {
        return $this->belongsTo('App\UserEvaluatedExpression','user_evaluated_expression_id','id');
    }

    public function updatedBy() {

        return $this->belongsTo('App\Users', 'updated_by', 'id');
    }

    public function deletedBy() {

        return $this->belongsTo('App\Users', 'deleted_by', 'id');
    }
}
