<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActionProp extends Model
{
    use SoftDeletes;

    protected $table = 'action_prop';

    public $timestamps = true;

    protected $fillable = [
        'action_id',
        'prop_id',
        'mandatory',
        'order',
        'updated_by',
        'deleted_by'
    ];

    public function action() {
        return $this->belongsTo('App\Action','action_id','id');
    }

    public function prop() {
        return $this->belongsTo('App\Property','prop_id','id');
    }

    public function updatedBy() {

        return $this->belongsTo('App\Users', 'updated_by', 'id');
    }

    public function deletedBy() {

        return $this->belongsTo('App\Users', 'deleted_by', 'id');
    }
}
