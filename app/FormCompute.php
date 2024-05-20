<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormCompute extends Model
{
    use SoftDeletes;

    protected $table = 'form_compute';

    public $timestamps = true;

    protected $fillable = [
        'action_prop_id',
        'json_logic',
        'updated_by',
        'deleted_by'
    ];

    public function actionProp() {
        return $this->belongsTo('App\ActionProp','action_prop_id','id');
    }

    public function updatedBy() {

        return $this->belongsTo('App\Users', 'updated_by', 'id');
    }

    public function deletedBy() {

        return $this->belongsTo('App\Users', 'deleted_by', 'id');
    }
}
