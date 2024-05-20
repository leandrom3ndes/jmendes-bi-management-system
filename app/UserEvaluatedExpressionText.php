<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserEvaluatedExpressionText extends Model
{
    use SoftDeletes;

    protected $table = 'user_evaluated_expression_text';

    public $timestamps = true;

    protected $primaryKey = ['user_evaluated_expression_id','language_id'];
    public $incrementing = false;

    protected $fillable = [
        'user_evaluated_expression_id',
        'language_id',
        'expression_name',
        'expression_text',
        'updated_by',
        'deleted_by'
    ];

    public function userEvaluatedExpression() {
        return $this->belongsTo('App\UserEvaluatedExpression','user_evaluated_expression','id');
    }

    public function language() {
        return $this->belongsTo('App\Language','language_id','id');
    }

    public function updatedBy() {

        return $this->belongsTo('App\Users', 'updated_by', 'id');
    }

    public function deletedBy() {

        return $this->belongsTo('App\Users', 'deleted_by', 'id');
    }
}
