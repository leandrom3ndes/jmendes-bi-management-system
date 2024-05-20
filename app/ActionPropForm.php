<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActionPropForm extends Model
{
    protected $table = 'action_prop_form';
    protected $fillable = [
        'action_prop_id',
        'form_id',
        'lang_id',
        'updated_by',
        'deleted_by'
    ];

    protected $guarded = [];

    public function updatedBy() {

        return $this->belongsTo('App\Users', 'updated_by', 'id');
    }

    public function deletedBy() {

        return $this->belongsTo('App\Users', 'deleted_by', 'id');
    }

}
