<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EnableCondition extends Model
{
    use SoftDeletes;

    protected $table = 'enable_condition';

    public $timestamps = true;

    protected $primaryKey = ['action_prop_id','condition_id'];
    public $incrementing = false;

    protected $fillable = [
        'action_prop_id',
        'condition_id',
        'updated_by',
        'deleted_by'
    ];

    public function actionProp() {
        return $this->belongsTo('App\ActionProp','action_prop_id','id');
    }

    public function condition() {
        return $this->belongsTo('App\Condition','condition_id','id');
    }

    public function updatedBy() {

        return $this->belongsTo('App\Users', 'updated_by', 'id');
    }

    public function deletedBy() {

        return $this->belongsTo('App\Users', 'deleted_by', 'id');
    }
}
