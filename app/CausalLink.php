<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CausalLink extends Model
{
    //use SoftDeletes;

    protected $table = 'causal_link';

    public $timestamps = true;

    protected $fillable = [
        'causing_action',
        'caused_action_rule',
        'min',
        'max',
		'updated_by',
        'deleted_by'
    ];

    protected $guarded = [];

    public function causedActionRule() {
        return $this->belongsTo('App\ActionRule', 'caused_action_rule', 'id');
    }

    public function causingAction() {
        return $this->belongsTo('App\Action', 'causing_action', 'id');
    }

    public function updatedBy() {

        return $this->belongsTo('App\Users', 'updated_by', 'id');
    }

    public function deletedBy() {

        return $this->belongsTo('App\Users', 'deleted_by', 'id');
    }
}
