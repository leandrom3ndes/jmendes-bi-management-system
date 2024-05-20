<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExternalIntegration extends Model
{
    use SoftDeletes;

    protected $table = 'external_integration';

    public $timestamps = true;

    protected $fillable = [
        'ent_type_id',
		't_state_id',
        'name',
		'task',
		'state',
		'updated_by',
        'deleted_by'
    ];

    protected $guarded = [];

	public function t_states() {
        return $this->belongsTo('App\TStates', 't_state_id', 'id');
    }
	
	public function ent_types() {
        return $this->belongsTo('App\EntType', 'ent_type_id', 'id');
    }
	
    public function updatedBy() {

        return $this->belongsTo('App\Users', 'updated_by', 'id');
    }

    public function deletedBy() {

        return $this->belongsTo('App\Users', 'deleted_by', 'id');
    }
}
